<?php

class Patient
{
    private $id;
    private $name;
    private $password;
    private $age;
    private $birth;
    private $cpf;
    private $rg;
    private $role;
    private $email;
    private $obs;
    private $address;
    

    /**
     * Class constructor.
     */
    public function __construct( $id = null , $name = null , $password  = null, $age = null, $birth = null, $cpf = null, $rg = null, $role = null, $email = null, $obs = null,  $address = null  )
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->password = $password;
        $this->age      = $age;
        $this->birth    = $birth;
        $this->cpf      = $cpf;
        $this->rg       = $rg;
        $this->role     = $role;
        $this->email    = $email;
        $this->obs      = $obs;
        $this->address  = $address;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password != null? $this->password  : "aaaaaaaaaaa";
    }

    public function getAge()
    {
        return $this->age;
    }

    public function getBirthDate()
    {
        
        $date = "";

        if( strpos( $this->birth, "/" ) )
        {
            $date = explode( "/",  $this->birth );
            $date = $date[2]."-".$date[1]."-".$date[0];
        }

        else if( strpos( $this->birth, "-" ) )
        {

            $date  = explode( '-',  $this->birth );
            $date  = $date[2]."/".$date[1]."/".$date[0];
        }
        
        return $date;
    }

    public function getDocument( $option , $both = false )
    {
        $options =  [ $this->rg, $this->cpf ];
    
        if( $both )
        {
            return $options;
        }

        return $options[$option];
    }

    public function getRole()
    {
        return $this->role;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getAddress()
    {
        return $this->address == null ? "" : $this->address;
    }

    public function getObservation()
    {
        return $this->obs;
    }
}