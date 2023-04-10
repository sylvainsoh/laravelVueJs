<?php

namespace Tests\Feature;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function itListCustomers()
    {
        $this->seed();

        $response = $this->get('/api/customers');

        $response->assertOk();
        $this->assertCount(15, $response->json('data'));
        $this->assertNotNull($response->json('data')[0]['tel']);
    }

    /**
     * @test
     */
    public function itCreateCustomer()
    {
        $response = $this->post('/api/customers',
            [
                'name' => 'Premier client',
                'tel' => '06xxxxxxxx',
                'is_favourite' => true
            ]
        );

        $customers=Customer::all();
        $customer=Customer::first();

        $this->assertEquals(1,$customers->count());
        $this->assertEquals('Premier client',$customer->name);
        $response->assertOk();
    }
    /**
     * @test
     */
    public function itValidatesFields(){
        $response = $this->post('/api/customers',
            [
                'name' => '',
                'tel' => '',
                'is_favourite' => ''
            ]
        );

        $response->assertSessionHasErrors(['name','tel','is_favourite']);
    }

}
