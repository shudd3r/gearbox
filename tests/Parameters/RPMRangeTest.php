<?php

namespace Shudd3r\Gearbox\Tests\Parameters;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Parameters\RPMRange;
use Shudd3r\Gearbox\Parameters\RPM;
use InvalidArgumentException;


class RPMRangeTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(RPMRange::class, new RPMRange(new RPM(100), new RPM(200)));
        $this->assertInstanceOf(RPMRange::class, RPMRange::fromValues(100, 200));
    }

    public function testInstantiationWithMinHigherThanMax_ThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new RPMRange(new RPM(2000), new RPM(1000));
    }

    public function testAccessorMethods_ReturnCorrectValue()
    {
        $range = new RPMRange($min = new RPM(1000), $max = new RPM(2000));
        $this->assertSame($min, $range->min());
        $this->assertSame($max, $range->max());
    }
}
