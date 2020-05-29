<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Parameters\RPMRange;


class AutomaticTransmission
{
    private const CHARACTERISTICS = [2000, 1000, 1000, 0.5, 2500, 4500, 1500, 0.5, 5000, 0.7, 5000, 5000, 1500, 2000, 3000, 6500, 14];

    private Shifter      $shifter;
    private EngineSensor $engine;

    private RPMRange $RPMRange;

    public function __construct(Shifter $shifter, EngineSensor $engine)
    {
        $this->shifter = $shifter;
        $this->engine  = $engine;

        $this->RPMRange = RPMRange::fromValues(self::CHARACTERISTICS[2], self::CHARACTERISTICS[4]);
    }

    public function adjustGearRatio(): void
    {
        $currentRPM = $this->engine->rpm();

        if ($currentRPM->isHigherThan($this->RPMRange->max())) {
            $this->shifter->gearUp();
        } elseif ($currentRPM->isLowerThan($this->RPMRange->min())) {
            $this->shifter->gearDown();
        }
    }
}
