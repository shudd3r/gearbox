<?php

namespace Shudd3r\Gearbox\Sensors;


interface EngineSensor
{
    public function rpm(): float;
}
