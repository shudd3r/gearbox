<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\Tests\Integration\Doubles;
use Shudd3r\Gearbox\AutomaticTransmission;


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

    protected function system(): GearboxSystem
    {
        return new Doubles\FakeGearboxSystem();
    }
}
