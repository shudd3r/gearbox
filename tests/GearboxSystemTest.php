<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\AutomaticTransmission;
use ExternalSystems;
use Gearbox;


class GearboxSystemTest extends TestCase
{
    public function testInstantiation()
    {
        $this->assertInstanceOf(GearboxSystem::class, $this->system());
    }

    public function testTransmissionMethod_ReturnsAutomaticTransmission()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->system()->transmission());
    }

    private function system()
    {
        return new GearboxSystem(new Gearbox(), new ExternalSystems());
    }
}
