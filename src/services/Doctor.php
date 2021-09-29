<?php

class Doctor
{
    private $id;
    private $name;
    private $email;
    private $crm;
    private $spec;
    private $sector;
    private $password;
    private $appointment_time;
    
    /**
     * Class constructor.
     */
    public function __construct(  $id = null ,  $name = null, $email = null, $crm = null, $spec = null, $sector = null, $password = null, $appointment_time = null )
    {
        $this->id               = $id;
        $this->name             = $name;
        $this->email            = $email;
        $this->crm              = $crm;
        $this->spec             = $spec;
        $this->sector           = $sector;
        $this->password         = $password;
        $this->appointment_time = $appointment_time;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getCRM()
    {
        return $this->crm;
    }

    public function getSpec()
    {
        return $this->spec;
    }

    public function getSector()
    {
        return $this->sector;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getApTime()
    {
        return $this->appointment_time;
    }

}