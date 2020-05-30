<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\Doubles;

use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;


class FakeGearboxSystem extends GearboxSystem
{
    public array    $defaultRanges;
    public RPMRange $range;

    public function __construct()
    {
        $this->defaultRanges = [
            self::ECO_MODE     => RPMRange::fromValues(1000, 2000),
            self::COMFORT_MODE => RPMRange::fromValues(1000, 2500),
            self::SPORT_MODE   => RPMRange::fromValues(1500, 5000),
        ];

        parent::__construct($this->defaultRanges);
    }

    protected function shifter(): Shifter
    {
        return new MockedShifter(1);
    }

    protected function engineSensor(): EngineSensor
    {
        return new FakeEngineSensor();
    }

    protected function range(int $mode): RPMRange
    {
        return $this->range = parent::range($mode);
    }
}
