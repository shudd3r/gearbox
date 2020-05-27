<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests;

use PHPUnit\Framework\TestCase;
use Shudd3r\Gearbox\Dummy;
use ExternalSystems;
use Gearbox;


class DummyTest extends TestCase
{
    public function testAutoloadMapping()
    {
        $this->assertInstanceOf(Dummy::class, new Dummy(new Gearbox(), new ExternalSystems()));
    }
}
