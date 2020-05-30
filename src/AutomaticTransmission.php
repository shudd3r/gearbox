<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\EngineSensor;


class AutomaticTransmission
{
    private GearRatio    $gear;
    private EngineSensor $engine;

    public function __construct(GearRatio $gear, EngineSensor $engine)
    {
        $this->gear   = $gear;
        $this->engine = $engine;
    }

    public function adjustGearRatio(): void
    {
        $this->gear->adjust($this->engine->rpm());
    }
}
