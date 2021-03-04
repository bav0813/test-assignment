<?php

namespace Tests\Feature;

use App\Models\Business;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BusinessTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_list_of_businesses_request()
    {
        $response = $this->get('/api/get-businesses');

        $response->assertStatus(200);
    }

    public function test_get_business_request()
    {
        $business=Business::first();
        $response = $this->get('/api/get-business/'.$business->id);

        $response->assertStatus(200);
    }

    public function test_storeBusiness()
    {

        $response = $this->withHeaders([
        ])->post('/api/store-business',
            [
             'name' => 'McDonalds Inc',
             'price' => 15000,
             'city' => 'Edmonton',
                ]);

        $response->assertStatus(201);

    }

    public function test_updateBusiness()
    {

        $response = $this->withHeaders([
        ])->put('/api/update-business',
            [ 'id'=>355,
              'name' => 'Apple Incorporated',
              'price' => 10000,
              'city' => 'Kiev',
            ]);

        $response->assertStatus(201);
    }

    public function test_deleteBusiness()
    {
        $business=Business::first();
        $response = $this->delete('/api/delete-business/'.$business->id);

        $response->assertStatus(200);
    }

}
