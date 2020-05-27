<?php declare(strict_types=1);

namespace Shudd3r\Gearbox;

use ExternalSystems;
use Gearbox;


class Dummy
{
    private Gearbox         $gearbox;
    private ExternalSystems $externalSystems;


    public function __construct(Gearbox $gearbox, ExternalSystems $externalSystems)
    {
        $this->gearbox         = $gearbox;
        $this->externalSystems = $externalSystems;
    }
}
