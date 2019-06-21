<?php

namespace TheBugSoftware\StareTva\Tests;

use PHPUnit\Framework\TestCase;
use TheBugSoftware\StareTva\Services\Request;
use TheBugSoftware\StareTva\Exceptions\ResponseException;

class RequestTest extends TestCase
{
    private $client;

    public function setUp()
    {
        $this->client = new Request();
    }

    /** @test */
    public function it_should_assert_if_response_has_message()
    {
        $response = $this->client->get([
            ['cui' => 14399840, 'data' => date('Y-m-d')],
        ]);

        $this->assertArrayHasKey('message', $response);
    }

    /** @test */
    public function it_should_throw_response_exception_error()
    {
        $this->expectException(ResponseException::class);

        $this->client->get([
            ['cui' => 143998403, date('Y-m-d')],
        ]);
    }

    public function tearDown()
    {
        $this->client = null;
    }
}
