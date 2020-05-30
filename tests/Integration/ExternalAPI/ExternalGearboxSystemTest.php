<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\ExternalAPI;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Integration\ExternalAPI\ExternalGearboxSystem;
use Shudd3r\Gearbox\AutomaticTransmission;
use Shudd3r\Gearbox\GearboxSystem;
use ExternalSystems;
use Gearbox;


class ExternalGearboxSystemTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(GearboxSystem::class, $this->system());
    }

    public function testTransmissionMethod_ReturnsAutomaticTransmission()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->system()->transmission());
    }

    private function system(): GearboxSystem
    {
        return new ExternalGearboxSystem(new Gearbox(), new ExternalSystems());
    }
}
