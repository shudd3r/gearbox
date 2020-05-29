<?php declare(strict_types=1);

namespace Shudd3r\Gearbox\Integration\ExternalAPI;

use Shudd3r\Gearbox\Integration\EngineSensor;
use Shudd3r\Gearbox\Parameters\RPM;
use ExternalSystems;


class ExternalEngineSensor implements EngineSensor
{
    private ExternalSystems $externalSystems;

    public function __construct(ExternalSystems $externalSystems)
    {
        $this->externalSystems = $externalSystems;
    }

    public function rpm(): RPM
    {
        return new RPM((int) $this->externalSystems->getCurrentRpm());
    }
}
