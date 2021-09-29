<?php

    require_once "Conection.php";
    include "Patient.php";
    class PatientTransaction
    {
        
         

        
        /**
         * addPatient
         *
         * @param  mixed $name
         * @param  mixed $email
         * @param  mixed $cpf
         * @param  mixed $rg
         * @param  mixed $age
         * @param  mixed $password
         * @param  mixed $address
         * @param  mixed $obs
         * @param  mixed $birth
         * @param  mixed $role
         * @return void
         */
        public static function addPatient(  $name, $email, $cpf, $rg, $age, $password, $address, $obs, $birth, $role )
        {
            
            try 
            {
                $database = Conection::load();
                $sql = "INSERT INTO patient ( name, password, age, birth_date, cpf, rg, role, email, address, obs  ) values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $prepared = $database->prepare( $sql );
                $prepared->execute( [ $name,  $password , $age, $birth, $cpf, $rg, $role, $email, $address, $obs ] );
               
            
            }
            catch (\PDOException $th)
            {
                echo $th->getMessage();
            
            }
            
        }
        
        /**
         * getAll
         *
         * @return void
         */
        public static function  getAll()
        {
            $database = Conection::load();
            $patients = [];

            foreach ($database->query( 'SELECT * FROM PATIENT order by id ') as $key )
            {
                $patient = new Patient( $key['id'] ,  $key['name'] , 
                                        $key['password'], 
                                        $key['age'] == null ? 1 : $key['age'] , 
                                        $key['birth_date'], 
                                        $key['cpf'], 
                                        $key['rg'] , 
                                        $key['role'],
                                        $key['email'],
                                        $key['obs'] == null ? "" : $key['obs'], 
                                        $key['address']  ); 

                array_push(  $patients, $patient );
            }
            
            return $patients;
        }
        
        /**
         * exist
         *
         * @param  mixed $email
         * @param  mixed $password
         * @return mixed
         */
        public function exist( $email ,$password )
        {
            $database = Conection::load();
            $exist = $database->query( "SELECT * FROM PATIENT WHERE email = '$email' and password = '$password' " ); 
            if( $exist )
            {
                $patient = "";
                foreach( $exist as $key )
                {
                    $patient = new Patient( $key['id'] , $key['name'] , 
                    $key['password'], 
                    $key['age'] == null ? 1 : $key['age'] , 
                    $key['birth_date'], 
                    $key['cpf'], 
                    $key['rg'] , 
                    $key['role'],
                    $key['email'],
                    $key['obs'] == null ? "" : $key['obs'], 
                    $key['address']  ); 
                }
                return $patient;
            }

            else
            {
                return false;
            }
        }   
    
        
        /**
         * delete
         *
         * @param  mixed $id
         * @return void
         */
        public function delete( $id )
        {
            $database = Conection::load();
            try
            {
                $prepared = $database->prepare( "Select count( id) from medical_appointment where patient_id = $id" );
                
                $prepared->execute();

                $result = $prepared->fetchAll();
                
                if( $result )
                {
                    $database->exec( "Delete from medical_appointment where patient_id = $id" );
                }

                $database->exec( "Delete from patient where id = $id " );

                return true;
            }

            catch(\PDOException $e )
            {
               echo $e->getMessage();
                
            }
        }
        
        /**
         * edit
         *
         * @param  mixed $id
         * @return void
         */
        public function edit( $id )
        {
            $database = Conection::load();

            $prepared = $database->prepare( "Select * from patient where id = $id" );

            $prepared->execute();

            $result = $prepared->fetchAll();
            
            if( $result )
            {
                $patient = "";
                
                foreach( $result as $key )
                {
                    $patient = new Patient
                    (
                        $key['id'],
                        $key['name'],
                        $key['cpf'],
                        $key['age'],
                        $key['birth_date'],
                        $key['cpf'],
                        $key['rg'],
                        $key['role'],
                        $key['email'],
                        $key['obs'],
                        $key['address']
                    );
                }

                return $patient;
            }
            else
            {
                return false;
            }
        }
        
        /**
         * updatePatient
         *
         * @param  mixed $id
         * @param  mixed $name
         * @param  mixed $email
         * @param  mixed $cpf
         * @param  mixed $rg
         * @param  mixed $age
         * @param  mixed $password
         * @param  mixed $address
         * @param  mixed $obs
         * @param  mixed $birth
         * @return void
         */
        public function updatePatient( $id ,$name, $email, $cpf, $rg, $age, $password, $address, $obs, $birth  )
        {
            try
            {
                $database = Conection::load();

                var_dump( $id );
                $prepared = $database->exec( "
                                                UPDATE Patient 
                                                SET NAME = '$name', 
                                                    PASSWORD = '$password',
                                                    AGE = '$age',
                                                    BIRTH_DATE = '$birth',
                                                    CPF = '$cpf',
                                                    RG = '$rg',
                                                    EMAIL = '$email',
                                                    ADDRESS = '$address',
                                                    OBS = '$obs'
                                                    WHERE ID = $id
                                            ;" );

                return true;
            }

            catch( \PDOException $e )
            {
                // return false;
                echo $e->getMessage();
            }
        }
    }



    