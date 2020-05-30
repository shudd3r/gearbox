<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\Doubles;

use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;


class FakeGearboxSystem extends GearboxSystem
{
    protected function shifter(): Shifter
    {
        return new MockedShifter(1);
    }

    protected function engineSensor(): EngineSensor
    {
        return new FakeEngineSensor();
    }

    protected function range(): RPMRange
    {
        return RPMRange::fromValues(1000, 2500);
    }
}
