<?php
/**
 * Created by Sebastian Lewandowski<sebasolew@gmail.com>.
 * Date: 12.04.2018
 */

namespace Sebastianlew\Interview\Test;

class HttpTest extends TestCase
{

    protected $data = [
        [
            'name' => 'Produkt 1',
            'amount' => 4,
        ],
        [
            'name' => 'Produkt 2',
            'amount' => 12,
        ],
        [
            'name' => 'Produkt 5',
            'amount' => 0,
        ],
        [
            'name' => 'Produkt 7',
            'amount' => 6,
        ],
        [
            'name' => 'Produkt 8',
            'amount' => 2,
        ],
    ];

    /**
     * Setup the test environment.
     */
    protected function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/../src/migrations');
        \DB::table('products')->insert($this->data);
    }

    /** @test */
    public function it_correctly_returns_products()
    {
        $response = $this->json('GET','/api/products');
        $response->assertStatus(200)->assertJson($this->data);
    }

    /** @test */
    public function it_correctly_returns_specific_product()
    {
        $response = $this->json('GET', '/api/products/1');
        $response->assertStatus(200)->assertJson($this->data[0]);
    }

    /** @test */
    public function it_correctly_creates_product()
    {
        $response = $this->json('POST', '/api/products', $this->data[0]);
        $response->assertStatus(201)->assertJson($this->data[0]);
    }

    /** @test */
    public function it_correctly_deletes_product()
    {
        $response = $this->json('DELETE', '/api/products/1');
        $response->assertStatus(204);

        $foundProduct = \DB::table('products')->find(1);
        $this->assertNull($foundProduct);
    }

    /** @test */
    public function it_correctly_updates_product()
    {
        $modifiedProduct = array_merge($this->data[0], ['name' => 'ChangedName']);
        $response = $this->json('PUT', '/api/products/1', $modifiedProduct);
        $response->assertStatus(200)->assertJson($modifiedProduct);
    }

}