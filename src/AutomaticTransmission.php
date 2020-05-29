<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Parameters\RPMRange;


class AutomaticTransmission
{
    private Shifter      $shifter;
    private EngineSensor $engine;
    private RPMRange     $range;

    public function __construct(Shifter $shifter, EngineSensor $engine, RPMRange $range)
    {
        $this->shifter = $shifter;
        $this->engine  = $engine;
        $this->range   = $range;
    }

    public function adjustGearRatio(): void
    {
        $currentRPM = $this->engine->rpm();

        if ($currentRPM->isHigherThan($this->range->max())) {
            $this->shifter->gearUp();
        } elseif ($currentRPM->isLowerThan($this->range->min())) {
            $this->shifter->gearDown();
        }
    }
}
