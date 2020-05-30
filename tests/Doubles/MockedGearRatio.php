<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Doubles;

use Shudd3r\Gearbox\GearRatio;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;


class MockedGearRatio extends GearRatio
{
    public RPMRange $capturedRange;

    public function __construct(Shifter $shifter, RPMRange $range)
    {
        parent::__construct($shifter, $this->capturedRange = $range);
    }

    public function setRPMRange(RPMRange $range): void
    {
        parent::setRPMRange($this->capturedRange = $range);
    }
}
