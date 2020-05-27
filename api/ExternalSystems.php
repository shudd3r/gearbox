<?php

class ExternalSystems
{
    private float $currentRpm;
    private float $angularSpeed = 150;
    private Lights $lights;

    public function __construct()
    {
        $this->lights = new Lights();
    }

    public function getCurrentRpm(): float
    {
        //sciagnij RPM z dostepnego miejsca
        return $this->currentRpm;
    }

    public function setCurrentRpm(float $currentRpm): void
    {
        $this->currentRpm = $currentRpm;
    }

    public function getAngularSpeed(): float
    {
        return $this->angularSpeed;
    }

    public function setAngularSpeed(float $angularSpeed): void
    {
        $this->angularSpeed = $angularSpeed;
    }

    public function getLights(): Lights
    {
        return $this->lights;
    }

}