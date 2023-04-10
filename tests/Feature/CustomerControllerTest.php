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

        $response->assertStatus(201);

        $this->assertEquals(1,$customers->count());
        $this->assertEquals('Premier client',$customer->name);
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
        $response->assertSessionHasErrors(['name','tel']);
    }
    /**
     * @test
     */
    public  function itUpdatesCustomer(){
        $this->seed();

        $customer=Customer::first();

        $response = $this->put('api/customers/'.$customer->id, [
            'name' => 'Nom édité',
            'tel' => '07xxxxxxxxxx',
            'is_favourite' => true,
        ]);
        $updatedCustomer=Customer::find($customer->id);

        $response->assertOk();

        $this->assertEquals('Nom édité', $updatedCustomer->name);
    }
    /**
     * @test
     */
    public function itDeletesACustomer(){
        $this->seed();
        $customer=Customer::first();
        $response=$this->delete('/api/customers/'.$customer->id);

        $response->assertNoContent();
        $this->assertEquals(14, Customer::count());
    }

}
