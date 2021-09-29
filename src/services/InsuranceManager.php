<?php

use \Insurance as Insurance;
use \InsuranceTransaction as InsuranceTransaction;

require_once "Insurance.php";
require_once "InsuranceTransaction.php";

class InsuranceManager
{

    private $all;

    /**
     * Class constructor.
    */
    public function __construct( Insurance $insurance = null, $action = null )
    {
        $this->doAction( $insurance, $action  );
    }

    public function doAction( Insurance $insurance = null, $action = null )
    {
      switch( $action )
        {
            case "add":
                //TODO
            break;

            case "getAll":
                $transaction = new InsuranceTransaction();
                $this->all = $transaction->getAll();
            break;
        }
    }

    public function getAll()
    {
        return $this->all;
    }
}