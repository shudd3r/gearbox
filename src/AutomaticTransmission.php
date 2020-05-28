<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use ExternalSystems;
use Gearbox;


class AutomaticTransmission
{
    private const CHARACTERISTICS = [2000, 1000, 1000, 0.5, 2500, 4500, 1500, 0.5, 5000, 0.7, 5000, 5000, 1500, 2000, 3000, 6500, 14];

    private Gearbox         $gearbox;
    private ExternalSystems $externalSystems;

    private float $maxRPM = self::CHARACTERISTICS[4];
    private float $minRPM = self::CHARACTERISTICS[2];


    public function __construct(Gearbox $gearbox, ExternalSystems $externalSystems)
    {
        $this->gearbox         = $gearbox;
        $this->externalSystems = $externalSystems;
    }

    public function adjustGearRatio(): void
    {
        if ($this->gearbox->getState() !== 1) { return; }

        $currentRPM  = $this->externalSystems->getCurrentRpm();
        $currentGear = $this->gearbox->getCurrentGear();
        if ($this->isRpmTooHigh($currentRPM) && $currentGear < $this->gearbox->getMaxDrive()) {
            $this->gearbox->setCurrentGear($this->gearbox->getCurrentGear() + 1);
        } elseif ($this->isRpmTooLow($currentRPM) && $currentGear > 1) {
            $this->gearbox->setCurrentGear($this->gearbox->getCurrentGear() - 1);
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
