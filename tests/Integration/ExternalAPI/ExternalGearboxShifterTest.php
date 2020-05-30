<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\ExternalAPI;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Integration\ExternalAPI\ExternalGearboxShifter;
use Shudd3r\Gearbox\Integration\Shifter;
use Gearbox;


class ExternalGearboxShifterTest extends TestCase
{
    private const MAX_GEAR = 6;

    public function testInstantiation()
    {
        $this->assertInstanceOf(Shifter::class, $this->shifter(new Gearbox()));
    }

    public function testGearUpIncreasesGearInGearbox()
    {
        $shifter = $this->shifter($gearbox = new Gearbox(), $currentGear = 3);
        $this->assertSame($currentGear, $gearbox->getCurrentGear());

        $shifter->gearUp();

        $this->assertSame($currentGear + 1, $gearbox->getCurrentGear());
    }

    public function testGearIsNotIncreasedBeyondHighestGear()
    {
        $shifter = $this->shifter($gearbox = new Gearbox(), self::MAX_GEAR);
        $this->assertSame(self::MAX_GEAR, $gearbox->getCurrentGear());

        $shifter->gearUp();

        $this->assertSame(self::MAX_GEAR, $gearbox->getCurrentGear());
    }

    public function testGearDownDecreasesGearInGearbox()
    {
        $shifter = $this->shifter($gearbox = new Gearbox(), $currentGear = 3);
        $this->assertSame($currentGear, $gearbox->getCurrentGear());

        $shifter->gearDown();

        $this->assertSame($currentGear - 1, $gearbox->getCurrentGear());
    }

    public function testGearIsNotDecreasedBelowFirstGear()
    {
        $shifter = $this->shifter($gearbox = new Gearbox(), 1);
        $this->assertSame(1, $gearbox->getCurrentGear());

        $shifter->gearDown();

        $this->assertSame(1, $gearbox->getCurrentGear());
    }

    public function testGearsWontBeChangedInNonDriveGearboxState()
    {
        $gearbox = new Gearbox();
        $gearbox->setMaxDrive(self::MAX_GEAR);
        $shifter = new ExternalGearboxShifter($gearbox);

        foreach (range(2, 4) as $state) {
            $gearbox->setGearBoxCurrentParams([$state, $initialGear = 3]);

            $shifter->gearUp();
            $this->assertSame($initialGear, $gearbox->getCurrentGear());

            $shifter->gearDown();
            $this->assertSame($initialGear, $gearbox->getCurrentGear());
        }
    }

    private function shifter(Gearbox $gearbox, int $gear = 1): Shifter
    {
        $gearbox->setMaxDrive(self::MAX_GEAR);
        $gearbox->setGearBoxCurrentParams([1, $gear]);

        return new ExternalGearboxShifter($gearbox);
    }
}
