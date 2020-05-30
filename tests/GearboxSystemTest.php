<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\GearboxSystem;
use Shudd3r\Gearbox\AutomaticTransmission;
use Shudd3r\Gearbox\Tests\Integration\Doubles;


class GearboxSystemTest extends TestCase
{
    private Doubles\FakeGearboxSystem $system;

    public function testInstantiation()
    {
        $this->assertInstanceOf(GearboxSystem::class, $this->system());
    }

    public function testTransmissionMethod_ReturnsAutomaticTransmission()
    {
        $this->assertInstanceOf(AutomaticTransmission::class, $this->system()->transmission());
    }

    public function testModeChange()
    {
        $this->system()->setEcoMode();
        $this->assertSame($this->system->range, $this->system->defaultRanges->eco());

        $this->system->setSportMode();
        $this->assertSame($this->system->range, $this->system->defaultRanges->sport());

        $this->system->setComfortMode();
        $this->assertSame($this->system->range, $this->system->defaultRanges->comfort());
    }

    protected function system(): GearboxSystem
    {
        return $this->system = new Doubles\FakeGearboxSystem();
    }
}
