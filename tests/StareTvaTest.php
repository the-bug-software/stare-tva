<?php

namespace TheBugSoftware\StareTva\Tests;

use TheBugSoftware\StareTva\StareTva;
use PHPUnit\Framework\TestCase;
use TheBugSoftware\StareTva\Exceptions\CuiLimitException;
use TheBugSoftware\StareTva\Exceptions\ValidateException;

class StareTvaTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->tva = new StareTva();
    }

    /** @test */
    public function it_should_return_an_instance_of_class()
    {
        $response = $this->tva->for(14399840, date('Y-m-d'));

        $this->assertInstanceOf(StareTva::class, $response);
    }

    /** @test */
    public function it_should_return_success_true()
    {
        $response = $this->tva->for(14399840, date('Y-m-d'))->get();

        $response = json_decode($response);

        $this->assertTrue($response->success);
    }

    /** @test */
    public function it_should_return_an_array_of_many_results()
    {
        $response = $this->tva->for(14399840, date('Y-m-d'))
            ->for(30232096, date('Y-m-d'))
            ->get();

        $response = json_decode($response);

        $this->assertGreaterThan(1, count($response->items));
    }

    /** @test */
    public function it_should_throw_validate_exception_error()
    {
        $this->expectException(ValidateException::class);

        $cuis = $this->tva->for('30232096', date('Y-m-d'))->cuis = [];
        $this->tva->get();
    }

    /** @test */
    public function it_should_throw_cui_limit_exception_error()
    {
        $this->expectException(CuiLimitException::class);

        $limit = 500;

        for ($i = 0; $i < $limit; $i++) {
            $this->tva->for('30232096', date('Y-m-d'));
        }

        $this->tva->get();
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
