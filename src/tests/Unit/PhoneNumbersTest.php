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
                        0   =>  $this->responseStructure()
                    ]
                ]
            ]);
    }


    public function testFetchPhonesWithSpecificCountry()
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
    
    public function testFetchPhonesWithOKState()
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

    public function testFetchPhonesWithNOKState()
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
    
    public function testFetchPhonesWithSpecificPerPage()
    {
        $perPage = 7;
        $params = [
            'perPage'  =>  $perPage
        ];

        $response = $this->getJson(route('api.phone-numbers.list', $params));
        
        $response->assertStatus(200)->assertJsonStructure(['status', 'message','data']);

        $this->assertEquals($perPage, count($response['data']['data']));
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
