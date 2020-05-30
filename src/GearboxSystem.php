<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;


abstract class GearboxSystem
{
    public function transmission(): AutomaticTransmission
    {
        return new AutomaticTransmission($this->shifter(), $this->engineSensor(), $this->range());
    }

    abstract protected function shifter(): Shifter;
    abstract protected function engineSensor(): EngineSensor;
    abstract protected function range(): RPMRange;
}
