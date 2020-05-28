<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\Doubles;

use Shudd3r\Gearbox\Integration\EngineSensor;


class FakeEngineSensor implements EngineSensor
{
    private float $rpm;

    public function __construct(float $rpm = 1000.0)
    {
        $this->rpm = $rpm;
    }

    public function rpm(): float
    {
        return $this->rpm;
    }
}
