<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\ExternalAPI;

use Shudd3r\Gearbox\Tests\GearboxSystemTest;
use Shudd3r\Gearbox\Integration\ExternalAPI\ExternalGearboxSystem;
use ExternalSystems;
use Gearbox;


class ExternalGearboxSystemTest extends GearboxSystemTest
{
    protected function system(): ExternalGearboxSystem
    {
        return new ExternalGearboxSystem(new Gearbox(), new ExternalSystems());
    }
}
