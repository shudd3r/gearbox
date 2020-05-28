<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Shifter;

use Shudd3r\Gearbox\Shifter;
use Gearbox;


class ExternalGearboxShifter implements Shifter
{
    private Gearbox $gearbox;

    public function __construct(Gearbox $gearbox)
    {
        $this->gearbox = $gearbox;
    }

    public function gearUp(): void
    {
        if ($this->gearbox->getState() !== 1) { return; }

        $currentGear = $this->gearbox->getCurrentGear();
        if ($currentGear >= $this->gearbox->getMaxDrive()) { return; }

        $this->gearbox->setCurrentGear($currentGear + 1);
    }

    public function gearDown(): void
    {
        if ($this->gearbox->getState() !== 1) { return; }

        $currentGear = $this->gearbox->getCurrentGear();
        if ($currentGear <= 1) { return; }

        $this->gearbox->setCurrentGear($currentGear - 1);
    }
}
