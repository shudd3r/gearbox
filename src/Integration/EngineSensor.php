<?php

namespace Shudd3r\Gearbox\Integration;


interface EngineSensor
{
    public function rpm(): float;
}
