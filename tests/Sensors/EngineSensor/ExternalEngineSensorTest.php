<?php

namespace Shudd3r\Gearbox\Tests\Sensors\EngineSensor;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Sensors\EngineSensor\ExternalEngineSensor;
use Shudd3r\Gearbox\Sensors\EngineSensor;
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
