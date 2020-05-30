<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\AutomaticTransmission;
use Shudd3r\Gearbox\Parameters\Characteristics;
use Shudd3r\Gearbox\Parameters\RPMRange;
use Shudd3r\Gearbox\Tests\Integration\Doubles;


class GearboxSystemTest extends TestCase
{
    private const RANGES = [[1000, 2000], [1000, 2500], [1500, 5000]];

    public function testInstantiation()
    {
        $this->assertInstanceOf(GearboxSystem::class, $this->system());
    }

    public function testTransmissionMethod_ReturnsAutomaticTransmission()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->system()->transmission());
    }

    public function testModeChange()
    {
        $system = $this->system();
        $this->assertSame($system->defaultRanges->comfort(), $system->mockedRatio->capturedRange);

        $system->setEcoMode();
        $this->assertSame($system->defaultRanges->eco(), $system->mockedRatio->capturedRange);

        $system->setComfortMode();
        $this->assertSame($system->defaultRanges->comfort(), $system->mockedRatio->capturedRange);

        $system->setSportMode();
        $this->assertSame($system->defaultRanges->sport(), $system->mockedRatio->capturedRange);
    }

    protected function system(): Doubles\FakeGearboxSystem
    {
        return new Doubles\FakeGearboxSystem(new Characteristics(
            RPMRange::fromValues(...self::RANGES[0]),
            RPMRange::fromValues(...self::RANGES[1]),
            RPMRange::fromValues(...self::RANGES[2])
        ));
    }
}
