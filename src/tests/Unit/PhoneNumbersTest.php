<?php

namespace Tests\Unit;

use App\Models\Customer;
use Tests\TestCase;


class PhoneNumbersTest extends TestCase
{

    public function testFetchAllPhoneNumbers()
    {
        $allCustomersCount = Customer::all()->count();

        $response = $this->getJson(route('api.phone-numbers.list'));

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status', 'message',
                'data'  =>  [
                    'data'   => [
                        0   =>  $this->responseStructure()
                    ]
                ]
            ]);

        $this->assertEquals($allCustomersCount, $response['data']['total']);
    }


    public function testFetchPhoneNumbersWithSpecificCountry()
    {
        $params = [
            'country'  =>  'Mozambique'
        ];
        $this->getJson(route('api.phone-numbers.list', $params))
            ->assertStatus(200)
            ->assertJson([
                'data'  =>  ['total'   => 8]
            ])
            ->assertJsonStructure([
                'status', 'message',
                'data'  =>  [
                    'data'   => [
                        0   =>  $this->responseStructure()
                    ]
                ]
            ]);
    }
    
    public function testFetchPhoneNumbersWithOKState()
    {
        $params = [
            'state'  =>  'OK'
        ];
        $this->getJson(route('api.phone-numbers.list', $params))
            ->assertStatus(200)
            ->assertJson([
                'data'  =>  ['total'   => 34]
            ])
            ->assertJsonStructure([
                'status', 'message',
                'data'  =>  [
                    'data'   => [
                        0   =>  $this->responseStructure()
                    ]
                ]
            ]);
    }

    public function testFetchPhoneNumbersWithNOKState()
    {
        $params = [
            'state'  =>  'NOK'
        ];
        $this->getJson(route('api.phone-numbers.list', $params))
            ->assertStatus(200)
            ->assertJson([
                'data'  =>  ['total'   => 7]
            ])
            ->assertJsonStructure([
                'status', 'message',
                'data'  =>  [
                    'data'   => [
                        0   =>  $this->responseStructure()
                    ]
                ]
            ]);
    }
    
    public function testFetchPhoneNumbersWithSpecificPerPage()
    {
        $perPage = 7;
        $params = [
            'perPage'  =>  $perPage
        ];

        $response = $this->getJson(route('api.phone-numbers.list', $params));
        
        $response->assertStatus(200)->assertJsonStructure(['status', 'message','data']);

        $this->assertEquals($perPage, count($response['data']['data']));
    }
    
    public function testFetchPhoneNumbersWithSpecificPaginationPage()
    {
        $page = 3;
        $params = [
            'page'  =>  $page
        ];

        $response = $this->getJson(route('api.phone-numbers.list', $params));
        
        $response->assertStatus(200)->assertJsonStructure(['status', 'message','data']);

        $this->assertEquals($page, $response['data']['current_page']);
    }

    /**
     * Return Structure of response whihc will be got after calling success route
     * @return array
     */
    private function responseStructure()
    {
        return [
            'id',
            'name',
            'phone',
            'country',
            'state',
            'country_code',
        ];
    }
}
