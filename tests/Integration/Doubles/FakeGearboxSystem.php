<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\Doubles;

use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Parameters\Characteristics;
use Shudd3r\Gearbox\Tests\Doubles\MockedGearRatio;


class FakeGearboxSystem extends GearboxSystem
{
    public Characteristics $defaultRanges;
    public MockedGearRatio $mockedRatio;

    public function __construct(Characteristics $ranges)
    {
        $this->defaultRanges = $ranges;
        $this->mockedRatio   = $this->mockedRatio();

        parent::__construct($this->defaultRanges, $this->mockedRatio);
    }

    protected function engineSensor(): EngineSensor
    {
        return new FakeEngineSensor();
    }

    private function mockedRatio(): MockedGearRatio
    {
        return new MockedGearRatio(new MockedShifter(1), $this->defaultRanges->comfort());
    }
}
