<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\AutomaticTransmission;
use Shudd3r\Gearbox\Parameters\RPMRange;
use Shudd3r\Gearbox\GearRatio;
use Shudd3r\Gearbox\Tests\Integration\Doubles;


class AutomaticTransmissionTest extends TestCase
{
    private const MIN_RPM = 1000;
    private const MAX_RPM = 2500;

    private Doubles\MockedShifter $shifter;
    private GearRatio             $gearRatio;

    public function testInstantiation()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->driver());
    }

    /**
     * @dataProvider gearRegulation
     *
     * @param int $initialGear
     * @param int $rpm
     * @param int $adjustedGear
     */
    public function testGearRatioIsAdjustedToCurrentRPM(int $initialGear, int $rpm, int $adjustedGear)
    {
        $driver = $this->driver($initialGear, $rpm);

        $driver->adjustGearRatio();

        $this->assertSame($adjustedGear, $this->shifter->currentGear);
    }

    public function gearRegulation(): array
    {
        return [
            'RPM within limit' => [2, self::MIN_RPM, 2],
            'RPM too high'     => [3, self::MAX_RPM + 100, 4],
            'RPM too low'      => [5, self::MIN_RPM - 100, 4],
        ];
    }

    public function testGearRatioRPMRangeCanBeChanged()
    {
        $driver = $this->driver($initialGear = 4, self::MIN_RPM);
        $driver->adjustGearRatio();
        $this->assertSame($initialGear, $this->shifter->currentGear);

        $this->gearRatio->setRPMRange(RPMRange::fromValues(self::MIN_RPM + 100, self::MAX_RPM));

        $driver->adjustGearRatio();
        $this->assertSame($initialGear - 1, $this->shifter->currentGear);
    }

    private function driver(int $gear = 1, int $rpm = 1000): AutomaticTransmission
    {
        $this->shifter   = new Doubles\MockedShifter($gear);
        $this->gearRatio = new GearRatio($this->shifter, RPMRange::fromValues(self::MIN_RPM, self::MAX_RPM));

        return new AutomaticTransmission($this->gearRatio, new Doubles\FakeEngineSensor($rpm));
    }
}
