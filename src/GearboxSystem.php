<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Parameters\Characteristics;
use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;


abstract class GearboxSystem
{
    private Characteristics $ranges;
    private GearRatio       $gearRatio;

    public function __construct(Characteristics $ranges)
    {
        $this->ranges    = $ranges;
        $this->gearRatio = new GearRatio($this->shifter(), $this->ranges->comfort());
    }

    public function transmission(): AutomaticTransmission
    {
        return new AutomaticTransmission($this->gearRatio, $this->engineSensor());
    }

    public function setEcoMode(): void
    {
        $this->changeRPMRange($this->ranges->eco());
    }

    public function setComfortMode(): void
    {
        $this->changeRPMRange($this->ranges->comfort());
    }

    public function setSportMode(): void
    {
        $this->changeRPMRange($this->ranges->sport());
    }

    abstract protected function shifter(): Shifter;
    abstract protected function engineSensor(): EngineSensor;

    protected function changeRPMRange(RPMRange $range): void
    {
        $this->gearRatio->setRPMRange($range);
    }
}
