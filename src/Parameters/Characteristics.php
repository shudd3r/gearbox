<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Parameters;


class Characteristics
{
    private RPMRange $ecoModeRange;
    private RPMRange $comfortModeRange;
    private RPMRange $sportModeRange;

    public function __construct(RPMRange $ecoModeRange, RPMRange $comfortModeRange, RPMRange $sportModeRange)
    {
        $this->ecoModeRange     = $ecoModeRange;
        $this->comfortModeRange = $comfortModeRange;
        $this->sportModeRange   = $sportModeRange;
    }

    public function eco(): RPMRange
    {
        return $this->ecoModeRange;
    }

    public function comfort(): RPMRange
    {
        return $this->comfortModeRange;
    }

    public function sport(): RPMRange
    {
        return $this->sportModeRange;
    }
}
