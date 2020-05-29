<?php

namespace Shudd3r\Gearbox\Integration;

use Shudd3r\Gearbox\Parameters\RPM;


interface EngineSensor
{
    public function rpm(): RPM;
}
