<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;
use Shudd3r\Gearbox\Parameters\RPM;


class GearRatio
{
    private Shifter      $shifter;
    private RPMRange     $range;

    public function __construct(Shifter $shifter, RPMRange $range)
    {
        $this->shifter = $shifter;
        $this->range   = $range;
    }

    public function adjust(RPM $rpm): void
    {
        if ($rpm->isHigherThan($this->range->max())) {
            $this->shifter->gearUp();
        } elseif ($rpm->isLowerThan($this->range->min())) {
            $this->shifter->gearDown();
        }
    }

    public function setRPMRange(RPMRange $range): void
    {
        $this->range = $range;
    }
}
