<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\AutomaticTransmission;
use ExternalSystems;
use Gearbox;


class AutomaticTransmissionTest extends TestCase
{
    public function testInstantiation()
    {
        $driver = new AutomaticTransmission(new Gearbox(), new ExternalSystems());
        $this->assertInstanceOf(AutomaticTransmission::class, $driver);
    }

    public function testCurrentRPMIsWithinRange_AdjustGearRatio_KeepsCurrentGearUnchanged()
    {
        $driver = new AutomaticTransmission($gearbox = new Gearbox(), $externalSystems = new ExternalSystems());
        $externalSystems->setCurrentRpm(1500);
        $gearbox->setGearBoxCurrentParams([1, $initialGear = 2]);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear, $gearbox->getCurrentGear());
    }

    public function testCurrentRPMIsTooAboveMaximum_AdjustGearRatio_CurrentGearIsIncreased()
    {
        $driver = new AutomaticTransmission($gearbox = new Gearbox(), $externalSystems = new ExternalSystems());
        $externalSystems->setCurrentRpm(2600);
        $gearbox->setMaxDrive(6);
        $gearbox->setGearBoxCurrentParams([1, $initialGear = 2]);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear + 1, $gearbox->getCurrentGear());
    }

    public function testCurrentGearIsNotIncreasedBeyondMaxDrive()
    {
        $driver = new AutomaticTransmission($gearbox = new Gearbox(), $externalSystems = new ExternalSystems());
        $externalSystems->setCurrentRpm(2100);
        $gearbox->setMaxDrive(6);
        $gearbox->setGearBoxCurrentParams([1, $initialGear = 6]);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear, $gearbox->getCurrentGear());
    }

    public function testCurrentRPMIsTooBelowMinimum_AdjustGearRatio_CurrentGearIsDecreased()
    {
        $driver = new AutomaticTransmission($gearbox = new Gearbox(), $externalSystems = new ExternalSystems());
        $externalSystems->setCurrentRpm(900);
        $gearbox->setMaxDrive(6);
        $gearbox->setGearBoxCurrentParams([1, $initialGear = 2]);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear - 1, $gearbox->getCurrentGear());
    }

    public function testCurrentGearIsNotDecreasedBelowFirstGear()
    {
        $driver = new AutomaticTransmission($gearbox = new Gearbox(), $externalSystems = new ExternalSystems());
        $externalSystems->setCurrentRpm(900);
        $gearbox->setMaxDrive(6);
        $gearbox->setGearBoxCurrentParams([1, $initialGear = 1]);

        $driver->adjustGearRatio();

        $this->assertSame($initialGear, $gearbox->getCurrentGear());
    }
}
