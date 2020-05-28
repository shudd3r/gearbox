<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Integration\EngineSensor;


class AutomaticTransmission
{
    private const CHARACTERISTICS = [2000, 1000, 1000, 0.5, 2500, 4500, 1500, 0.5, 5000, 0.7, 5000, 5000, 1500, 2000, 3000, 6500, 14];

    private Shifter      $shifter;
    private EngineSensor $engineSensor;

    private float $maxRPM = self::CHARACTERISTICS[4];
    private float $minRPM = self::CHARACTERISTICS[2];

    public function __construct(Shifter $shifter, EngineSensor $engineSensor)
    {
        $this->shifter      = $shifter;
        $this->engineSensor = $engineSensor;
    }

    public function adjustGearRatio(): void
    {
        $currentRPM  = $this->engineSensor->rpm();

        if ($this->isRpmTooHigh($currentRPM)) {
            $this->shifter->gearUp();
        } elseif ($this->isRpmTooLow($currentRPM)) {
            $this->shifter->gearDown();
        }
    }

    private function isRpmTooHigh(float $currentRPM): bool
    {
        return $currentRPM > $this->maxRPM;
    }

    private function isRpmTooLow(float $currentRPM): bool
    {
        return $currentRPM < $this->minRPM;
    }
}
