<?php

namespace Shudd3r\Gearbox\Tests\Parameters;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Parameters\RPM;
use InvalidArgumentException;


class RPMTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(RPM::class, new RPM(200));
    }

    public function testInstantiationWithNegativeValue_ThrowsException()
    {
        $this->expectException(InvalidArgumentException::class);
        new RPM(-10);
    }

    /**
     * @dataProvider rpmComparisons
     *
     * @param RPM $rpm
     * @param RPM $comparedRpm
     * @param int $expected
     */
    public function testComparison_ReturnsCorrectValue(RPM $rpm, RPM $comparedRpm, int $expected)
    {
        $this->assertSame($expected, $rpm->compare($comparedRpm));

        $this->assertSame($expected > 0, $rpm->isHigherThan($comparedRpm));
        $this->assertSame($expected < 0, $rpm->isLowerThan($comparedRpm));
    }

    public function rpmComparisons()
    {
        return [
            [new RPM(100), new RPM(200), -1],
            [new RPM(200), new RPM(100), 1],
            [new RPM(100), new RPM(100), 0]
        ];
    }
}
