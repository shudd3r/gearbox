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
        $driver  = $this->driver($initialGear, $rpm);

        $driver->adjustGearRatio();

        $this->assertSame($adjustedGear, $this->shifter->currentGear);
    }

    public function gearRegulation(): array
    {
        $mediumRPM = (int) (self::MIN_RPM + self::MAX_RPM) / 2;

        return [
            'RPM within limit' => [2, $mediumRPM, 2],
            'RPM too high'     => [3, self::MAX_RPM + 100, 4],
            'RPM too low'      => [5, self::MIN_RPM - 100, 4],
        ];
    }

    private function driver(int $gear = 1, int $rpm = 1000): AutomaticTransmission
    {
        $this->shifter = new Doubles\MockedShifter($gear);

        $gearRatio = new GearRatio($this->shifter, RPMRange::fromValues(self::MIN_RPM, self::MAX_RPM));
        return new AutomaticTransmission($gearRatio, new Doubles\FakeEngineSensor($rpm));
    }
}
