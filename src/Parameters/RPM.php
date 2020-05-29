<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Parameters;

use InvalidArgumentException;


class RPM
{
    private int $rpmValue;

    public function __construct(int $rpmValue)
    {
        if ($rpmValue < 0) {
            throw new InvalidArgumentException();
        }

        $this->rpmValue = $rpmValue;
    }

    public function isHigherThan(RPM $rpm): bool
    {
        return $rpm->compareValue($this->rpmValue) < 0;
    }

    public function isLowerThan(RPM $rpm): bool
    {
        return $rpm->compareValue($this->rpmValue) > 0;
    }

    public function compare(RPM $rpm): int
    {
        return $rpm->compareValue($this->rpmValue) * -1;
    }

    private function compareValue(int $rpmValue): int
    {
        return $this->rpmValue <=> $rpmValue;
    }
}
