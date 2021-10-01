<?php
// use \AppointmentTransaction as AppointmentTransaction;
include "PatientManager.php";
include "AppointmentManager.php";
include "DoctorManager.php";
include "Appointment.php";
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
                
                case "add":
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

            $manager; 
            switch( $_POST['action'] )
            {
                
                case "add":
                    $manager = new AppointmentManager( new Appointment( null, $_POST['doc_id'], $_POST['patient_id'], $_POST['start-date']." ".$_POST['start-hour'] , $_POST['end-date']." ".$_POST['end-hour'], null, $_POST['cost'], $_POST['insurance'] ), $_POST['action'] );
                    header("Location: ../views/Appointments.php"); 
                break;

                case "delete":
                    $manager = new AppointmentManager( new Appointment( $_POST['value'], null, null, null,null, null,null,null ), $_POST['action'] );
                    if( $manager->deleted() )
                    {
                        header("Location: ../views/Appointments.php"); 
                    }
                break;
                
                case "edit":
                    $manager = new AppointmentManager( new Appointment( $_POST['value'], null, null, null,null, null,null,null ), $_POST['action'] );
                    $rs = $manager->edit()[0];

                    $apID       = $rs['ap_id'];
                    $docID      = $rs['doc_id'];
                    $paID       = $rs['pa_id'];
                    $docName    = $rs['doc_name'];
                    $paName     = $rs['pa_name'];
                    $start      = explode( " ", $rs['start'] );
                    $start_date = formatDate( $start[0] );
                    $start_time = $start[1];
                    $end        = explode( " ", $rs['end'] );
                    $end_date   = formatDate( $end[0] );
                    $end_time   = $end[1];
                    $treament   = $rs['treatment'];
                    $cost       = $rs['cost'];
                    $accord     = $rs['accord'];
                    $value      = $rs['value'];
                    $i_id       = $rs['i_id'];
                    header("Location: ../views/AppointmentRegister.php?id=$apID&docId=$docID&paID=$paID&docName=$docName&paName=$paName&start_date=$start_date&start_time=$start_time&end_date=$end_date&end_time=$end_time&treatment=$treament&cost=$cost&accord=$accord&value=$value&i_id=$i_id&action=editable"); 
                break;
            
                case "editable": 
                    $manager = new AppointmentManager( new Appointment( $_POST['appointid'], $_POST['doc_id'], $_POST['patient_id'], $_POST['start-date']." ".$_POST['start-hour'] , $_POST['end-date']." ".$_POST['end-hour'], null, $_POST['cost'], $_POST['insurance'] ), $_POST['action']  );
                    header("Location: ../views/Appointments.php");
                break;
                    
                case "editTreatment":
                    $manager = new AppointmentManager( new Appointment( $_POST['value'], null, null, null, null, null, null, null ), $_POST['action'] );
                    $text = $manager->getTreatment();
                    var_dump( $text );
                    $id = $_POST['value'];
                    header("Location: ../views/TreatmentEditor.php?id=$id&treatment=$text"); 
                    break;
                case "updateTreatment":
                    // var_dump( $_POST );
                    $manager = new AppointmentManager( new Appointment( $_POST['value'], null,null,null,null,$_POST['treatment'],null,null ), $_POST['action'] );
                    header("Location: ../views/Appointments.php");
                break;
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

function formatDate( $date )
{
    $date = explode( "-", $date );

    $date = $date[2]."/".$date[1]."/".$date[0];
    return $date;
}



