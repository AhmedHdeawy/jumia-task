<?php

namespace Tests\Unit;

use Tests\TestCase;


class PhoneNumbersTest extends TestCase
{

    public function testFetchAllPhones()
    {
        $this->getJson(route('api.phone-numbers.list'))
            ->assertStatus(200)
            ->assertJsonStructure([
                'status', 'message',
                'data'  =>  [
                    'data'   => [
                        0   =>  [
                            'id',
                            'name',
                            'phone',
                            'country',
                            'state',
                            'country_code',
                        ]
                    ]
                ]
            ]);
    }

}
