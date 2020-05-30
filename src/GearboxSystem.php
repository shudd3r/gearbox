<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Parameters\Characteristics;
use Shudd3r\Gearbox\Integration\EngineSensor;


abstract class GearboxSystem
{
    private Characteristics $ranges;
    private GearRatio       $gearRatio;

    public function __construct(Characteristics $ranges, GearRatio $gearRatio)
    {
        $this->ranges    = $ranges;
        $this->gearRatio = $gearRatio;
    }

    public function transmission(): AutomaticTransmission
    {
        return new AutomaticTransmission($this->gearRatio, $this->engineSensor());
    }

    public function setEcoMode(): void
    {
        $this->gearRatio->setRPMRange($this->ranges->eco());
    }

    public function setComfortMode(): void
    {
        $this->gearRatio->setRPMRange($this->ranges->comfort());
    }

    public function setSportMode(): void
    {
        $this->gearRatio->setRPMRange($this->ranges->sport());
    }

    abstract protected function engineSensor(): EngineSensor;
}
