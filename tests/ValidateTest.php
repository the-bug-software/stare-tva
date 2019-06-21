<?php

namespace TheBugSoftware\StareTva\Tests;

use PHPUnit\Framework\TestCase;
use TheBugSoftware\StareTva\Services\Validate;
use TheBugSoftware\StareTva\Exceptions\ValidateException;

class ValidateTest extends TestCase
{
    private $validate;

    public function setUp()
    {
        $this->validate = new Validate();
    }

    /** @test */
    public function it_should_return_true()
    {
        $this->assertTrue($this->validate->cui(14399840));
        $this->assertTrue($this->validate->cui('14399840'));
        $this->assertTrue($this->validate->cui('RO 14399840'));
    }

    /** @test */
    public function it_should_return_false()
    {
        $this->assertFalse($this->validate->cui('lakjaldk'));
        $this->assertFalse($this->validate->cui('0980adaioi09'));
        $this->assertFalse($this->validate->cui('+_+32+DA32e2'));
    }

    /** @test */
    public function it_should_throw_validate_exception_error()
    {
        $this->expectException(ValidateException::class);

        $this->validate->cui('');
    }

    public function tearDown()
    {
        $this->validate = null;
    }
}
