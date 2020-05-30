<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Integration\Shifter;
use Shudd3r\Gearbox\Parameters\RPMRange;


abstract class GearboxSystem
{
    protected const ECO_MODE     = 0;
    protected const COMFORT_MODE = 1;
    protected const SPORT_MODE   = 2;

    private array     $ranges;
    private GearRatio $gearRatio;

    public function __construct(array $ranges)
    {
        $this->ranges    = $ranges;
        $this->gearRatio = new GearRatio($this->shifter(), $this->range(self::COMFORT_MODE));
    }

    public function transmission(): AutomaticTransmission
    {
        return new AutomaticTransmission($this->gearRatio, $this->engineSensor());
    }

    public function setEcoMode(): void
    {
        $this->changeRPMRange(self::ECO_MODE);
    }

    public function setComfortMode(): void
    {
        $this->changeRPMRange(self::COMFORT_MODE);
    }

    public function setSportMode(): void
    {
        $this->changeRPMRange(self::SPORT_MODE);
    }

    abstract protected function shifter(): Shifter;
    abstract protected function engineSensor(): EngineSensor;

    protected function range(int $mode): RPMRange
    {
        return $this->ranges[$mode] ?? reset($this->ranges);
    }

    private function changeRPMRange(int $mode): void
    {
        $this->gearRatio->setRPMRange($this->range($mode));
    }
}
