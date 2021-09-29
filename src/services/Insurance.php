<?php

class Insurance
{

    private $id;
    private $accord;
    private $value;

    /**
     * Class constructor.
     */
    public function __construct( $id = null, $accord = null , $value = null )
    {
        $this->id = $id;
        $this->accord = $accord;
        $this->value  = $value;
    }
    
    /**
     * getId
     *
     * @return void
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * getAccord
     *
     * @return void
     */
    public function getAccord()
    {
        return $this->accord;
    }
    
    /**
     * getValue
     *
     * @return void
     */
    public function getValue()
    {
        return $this->value;
    }
}