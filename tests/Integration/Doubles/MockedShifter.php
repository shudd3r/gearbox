<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Integration\Doubles;

use Shudd3r\Gearbox\Integration\Shifter;


class MockedShifter implements Shifter
{
    public int $currentGear = 3;

    public function __construct(int $currentGear)
    {
        $this->currentGear = $currentGear;
    }

    public function gearUp()
    {
        $this->currentGear++;
    }

    public function gearDown()
    {
        $this->currentGear--;
    }
}
