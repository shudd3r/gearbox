<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Integration\ExternalAPI;

use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\Parameters\Characteristics;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;
use ExternalSystems;
use Gearbox;


class ExternalGearboxSystem extends GearboxSystem
{
    private const CHARACTERISTICS = [2000, 1000, 1000, 0.5, 2500, 4500, 1500, 0.5, 5000, 0.7, 5000, 5000, 1500, 2000, 3000, 6500, 14];

    private Gearbox         $gearbox;
    private ExternalSystems $externalSystems;

    public function __construct(Gearbox $gearbox, ExternalSystems $externalSystems, Characteristics $ranges = null)
    {
        $this->gearbox         = $gearbox;
        $this->externalSystems = $externalSystems;

        parent::__construct($ranges ?? $this->defaultRanges());
    }

    protected function shifter(): Shifter
    {
        return new ExternalGearboxShifter($this->gearbox);
    }

    protected function engineSensor(): EngineSensor
    {
        return new ExternalEngineSensor($this->externalSystems);
    }

    private function defaultRanges(): Characteristics
    {
        return new Characteristics(
            RPMRange::fromValues(self::CHARACTERISTICS[1], self::CHARACTERISTICS[0]),
            RPMRange::fromValues(self::CHARACTERISTICS[2], self::CHARACTERISTICS[4]),
            RPMRange::fromValues(self::CHARACTERISTICS[6], self::CHARACTERISTICS[8])
        );
    }
}
