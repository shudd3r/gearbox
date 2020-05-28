<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\AutomaticTransmission;
use Shudd3r\Gearbox\Tests\Integration\Doubles;


class AutomaticTransmissionTest extends TestCase
{
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
    public function testGearRatioIsAdjustedToCurrentRPM(int $initialGear, float $rpm, int $adjustedGear)
    {
        $shifter = new Doubles\MockedShifter($initialGear);
        $driver  = $this->driver($shifter, $rpm);

        $driver->adjustGearRatio();

        $this->assertSame($adjustedGear, $shifter->currentGear);
    }

    public function gearRegulation(): array
    {
        return [
            'RPM within limit' => [2, 2000, 2],
            'RPM too high'     => [3, 2600, 4],
            'RPM too low'      => [5, 900, 4],
        ];
    }

    private function driver(Doubles\MockedShifter $shifter, float $rpm = 1000.0): AutomaticTransmission
    {
        return new AutomaticTransmission($shifter, new Doubles\FakeEngineSensor($rpm));
    }
}
