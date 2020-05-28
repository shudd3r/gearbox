<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\AutomaticTransmission;
use Gearbox;


class AutomaticTransmissionTest extends TestCase
{
    private const MAX_GEAR = 6;

    public function testInstantiation()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->driver(new Gearbox()));
    }

    public function testCurrentRPMIsWithinRange_AdjustGearRatio_KeepsCurrentGearUnchanged()
    {
        $driver = $this->driver($gearbox = new Gearbox(), 1500);
        $gearbox->setCurrentGear($initialGear = 3);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear, $gearbox->getCurrentGear());
    }

    public function testCurrentRPMIsTooAboveMaximum_AdjustGearRatio_CurrentGearIsIncreased()
    {
        $driver = $this->driver($gearbox = new Gearbox(), 2600);
        $gearbox->setCurrentGear($initialGear = 3);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear + 1, $gearbox->getCurrentGear());
    }

    public function testCurrentGearIsNotIncreasedBeyondMaxDrive()
    {
        $driver = $this->driver($gearbox = new Gearbox(), 2600);
        $gearbox->setCurrentGear($initialGear = self::MAX_GEAR);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear, $gearbox->getCurrentGear());
    }

    public function testCurrentRPMIsTooBelowMinimum_AdjustGearRatio_CurrentGearIsDecreased()
    {
        $driver = $this->driver($gearbox = new Gearbox(), 900);
        $gearbox->setCurrentGear($initialGear = 3);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear - 1, $gearbox->getCurrentGear());
    }

    public function testCurrentGearIsNotDecreasedBelowFirstGear()
    {
        $driver = $this->driver($gearbox = new Gearbox(), 900);
        $gearbox->setCurrentGear($initialGear = 1);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear, $gearbox->getCurrentGear());
    }

    private function driver(Gearbox $gearbox, float $rpm = 1000.0): AutomaticTransmission
    {
        $gearbox->setMaxDrive(self::MAX_GEAR);
        $gearbox->setGearBoxCurrentParams([1, 1]);

        return new AutomaticTransmission($gearbox, new Doubles\FakeEngineSensor($rpm));
    }
}
