<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\ExternalAPI;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Integration\ExternalAPI\ExternalEngineSensor;
use Shudd3r\Gearbox\Integration\EngineSensor;
use ExternalSystems;


class ExternalEngineSensorTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(EngineSensor::class, new ExternalEngineSensor(new ExternalSystems()));
    }

    public function testReturnedCorrectRPMValue()
    {
        $externalSystems = new ExternalSystems();
        $externalSystems->setCurrentRpm($currentRpm = 1000.0);
        $engine = new ExternalEngineSensor($externalSystems);

        $this->assertSame($currentRpm, $engine->rpm());
    }
}
