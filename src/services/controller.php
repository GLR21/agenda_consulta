<?php
// use \AppointmentTransaction as AppointmentTransaction;
include "PatientManager.php";
include "AppointmentTransaction.php";
include "DoctorManager.php";
if( isset( $_POST ) )
{
    $manager; 

    switch ($_POST['id'])
    {
        case 'login':

            $docCheck = $_POST['isDoc'];
            if( $docCheck )
            {
                $manager = new DoctorManager( new Doctor( null, null, $_POST['email'],null, null,null , $_POST['password'], null), $_POST['id'] );
                $isDoc = $manager->exist(); 
                if( !$isDoc )
                {
                }
                else
                {
                    header( "Location: ../views/Doctors.php" );
                }
            }

            else
            {
                $manager = new PatientManager( new Patient( null ,null, $_POST['password'], null,null,null, null, null , null, null, null) , $_POST['id']  );
                $exist = $manager->exist();
                if( !$exist )
                {
                
                }
                header( "Location: ../views/Patients.php" );
            }

        break;

        case 'patient':
           
            switch( $_POST['action'] )
            {
                case "delete": 
                    $manager = new PatientManager( new Patient( $_POST['value'] ,null, null ,null, null, null,  null,null, null, null ,null  ),$_POST['action'] );
                    if( $manager->delete() )
                    {
                        header('Location: ../views/Patients.php');
                    }
                break;
                
                case "edit":
                    $manager = new PatientManager( new Patient( $_POST['value'], null, null, null, null, null, null,null,null,null,null ) , $_POST['action']);
                    $pat =  $manager->getPatient() ;
                    if(  $pat )
                    {
                        $id = $pat->getId();
                        $name = $pat->getName();
                        $email = $pat->getEmail();
                        $password = $pat->getPassword();
                        $cpf = $pat->getDocument( 0 );
                        $rg = $pat->getDocument( 1 );
                        $address = $pat->getAddress();
                        $age = $pat->getAge();
                        $birth = $pat->getBirthDate();
                        $obs = $pat->getObservation();

                        header("Location: ../views/PatientRegister.php?id=$id&name=$name&email=$email&password=$password&cpf=$cpf&rg=$rg&address=$address&age=$age&birth=$birth&obs=$obs&action=editable");
                    }
                break;
                    
                case "editable":
                    $manager = new PatientManager( new Patient( $_POST['patid'] ,$_POST['name'],  $_POST['password'], $_POST['age'], $_POST['birth'], $_POST['cpf'], $_POST['rg'], 1 , $_POST['email'], $_POST['obs'], $_POST['address']) , $_POST['action'] );
                    if( $manager->isEdited())
                    {
                        header('Location: ../views/Patients.php');
                    }

                break;
                
                default:
                    new PatientManager( new Patient( null ,$_POST['name'], verifyEncoding( $_POST['password'] ), $_POST['age'], $_POST['birth'], $_POST['cpf'], $_POST['rg'], 1 , $_POST['email'], $_POST['obs'], $_POST['address']) , $_POST['action']  );
                    header('Location: ../views/Patients.php');
                break;    
            }

        break;
        
        case 'doc':

            switch( $_POST['action'] )
            {
                case 'delete': 
                    $manager = new DoctorManager( new Doctor( $_POST['value'] ,null , null, null, null, null,null,null ), $_POST['action'] );  
                    if( $manager->deleted() );
                    {
                        header('Location: ../views/Doctors.php');
                        break;
                    }
                break;
                
                case 'edit':
                    $manager = new DoctorManager( new Doctor( $_POST['value'] ,null , null, null, null, null,null,null ), $_POST['action'] ); 
                    $doc = $manager->getDoctor();
                    if( $doc )
                    {   
                        $id = $doc->getId();
                        $name = $doc->getName();
                        $email = $doc->getEmail();
                        $crm = $doc->getCRM();
                        $password = $doc->getPassword();
                        $spec = $doc->getSpec();
                        $aptime = $doc->getApTime();

                        header("Location: ../views/DoctorRegister.php?id=$id&name=$name&email=$email&crm=$crm&spec=$spec&aptime=$aptime&password=$password&action=editable");
                        break;
                    }
                break;
                
                case 'editable':
                    new DoctorManager( new Doctor( $_POST['docid'] , $_POST['name'], $_POST['email'], $_POST['crm'], $_POST['spec'], $_POST['sector'], verifyEncoding( $_POST['password'] ), $_POST['appointment_time'] ), $_POST['action'] );
                    header('Location: ../views/Doctors.php');
                break;
                
                case 'add':
                    
                    new DoctorManager( new Doctor( null , $_POST['name'], $_POST['email'], $_POST['crm'], $_POST['spec'], $_POST['sector'], verifyEncoding( $_POST['password'] ), $_POST['appointment_time'] ), $_POST['action'] );
                    header('Location: ../views/Doctors.php');
                break;
            }
        
        break;

        case "appointment":

            $manager = new AppointmentTransaction();

            $manager->getAll();

            switch( $_POST['action'] )
            {

            }
        
        break;
    }

}

function verifyEncoding( $password )
{
    try
    {
        $password = convert_uudecode( $_POST['password'] );
        $password = base64_decode( $password );
    }

    catch( \Exception $e )
    {
        $password = $_POST['password'];
    }
    return $password;
}








