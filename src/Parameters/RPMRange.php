<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Parameters;

use InvalidArgumentException;


class RPMRange
{
    private RPM $min;
    private RPM $max;

    public function __construct(RPM $min, RPM $max)
    {
        if ($min->isHigherThan($max)) {
            throw new InvalidArgumentException();
        }

        $this->min = $min;
        $this->max = $max;
    }

    public static function fromValues(int $min, int $max): self
    {
        return new self(new RPM($min), new RPM($max));
    }

    public function min(): RPM
    {
        return $this->min;
    }

    public function max(): RPM
    {
        return $this->max;
    }
}
