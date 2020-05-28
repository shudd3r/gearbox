<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Tests\Doubles;

use Shudd3r\Gearbox\Shifter;


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
