<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Integration\ExternalAPI;

use Shudd3r\Gearbox\Sensors\EngineSensor;
use ExternalSystems;


class ExternalEngineSensor implements EngineSensor
{
    private ExternalSystems $externalSystems;

    public function __construct(ExternalSystems $externalSystems)
    {
        $this->externalSystems = $externalSystems;
    }

    public function rpm(): float
    {
        return $this->externalSystems->getCurrentRpm();
    }
}
