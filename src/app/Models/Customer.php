<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'phone'];

    protected $appends = ['country', 'country_code'];

    public function getCountryAttribute()
    {
        $code = $this->getCountryCode($this->phone);

        return $this->getCountryName($code);
    }

    public function getCountryCodeAttribute()
    {
        return $this->getCountryCode($this->phone);
    }

    /**
     * @param string $phone
     * 
     * @return string|null
     */
    private function getCountryCode(string $phone)
    {
        if (($start = strpos($phone, '(')) !== false && ($stop = strpos($phone, ')', $start)) !== false) {
            $code = substr($phone, $start, $stop - $start + 1);
            return substr($code, 1, strlen($code) - 2);
        }
        return null;
    }

    /**
     * @param string $code
     * 
     * @return string
     */
    private function getCountryName(string $code)
    {
        if (!$code) {
            return null;
        }

        $countriesCode = config('countries.codes');
        foreach ($countriesCode as $key => $country) {
            if ($country == $code) {
                return $key;
                break;
            }
        }
    }
}
