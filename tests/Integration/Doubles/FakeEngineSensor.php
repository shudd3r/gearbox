<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\Doubles;

use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Parameters\RPM;


class FakeEngineSensor implements EngineSensor
{
    private RPM $rpm;

    public function __construct(int $rpm = 1000)
    {
        $this->rpm = new RPM($rpm);
    }

    public function rpm(): RPM
    {
        return $this->rpm;
    }
}
