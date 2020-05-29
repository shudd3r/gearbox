<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\AutomaticTransmission;
use Shudd3r\Gearbox\Parameters\RPMRange;
use Shudd3r\Gearbox\Tests\Integration\Doubles;


class AutomaticTransmissionTest extends TestCase
{
    private const MIN_RPM = 1000;
    private const MAX_RPM = 2500;

    public function testInstantiation()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->driver(new Doubles\MockedShifter(1)));
    }

    /**
     * @dataProvider gearRegulation
     *
     * @param int   $initialGear
     * @param float $rpm
     * @param int   $adjustedGear
     */
    public function testGearRatioIsAdjustedToCurrentRPM(int $initialGear, int $rpm, int $adjustedGear)
    {
        $shifter = new Doubles\MockedShifter($initialGear);
        $driver  = $this->driver($shifter, $rpm);

        $driver->adjustGearRatio();

        $this->assertSame($adjustedGear, $shifter->currentGear);
    }

    public function gearRegulation(): array
    {
        return [
            'RPM within limit' => [2, self::MIN_RPM + 1, 2],
            'RPM too high'     => [3, self::MAX_RPM + 100, 4],
            'RPM too low'      => [5, self::MIN_RPM - 100, 4],
        ];
    }

    private function driver(Doubles\MockedShifter $shifter, int $rpm = 1000): AutomaticTransmission
    {
        $range  = RPMRange::fromValues(self::MIN_RPM, self::MAX_RPM);
        $sensor = new Doubles\FakeEngineSensor($rpm);

        return new AutomaticTransmission($shifter, $sensor, $range);
    }
}
