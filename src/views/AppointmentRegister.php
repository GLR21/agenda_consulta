<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../../resources/care.png" type="image/x-icon">
    <link  type="text/css"  rel="stylesheet" href="../../css/PatientRegister.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body> 
    <div  class="div-table" >
        <form method="POST" action="../services/controller.php">
            <table  >
                <thead>
                    <div class="title">
                        <h1>Appointment Register</h1>
                    </div>
                </thead>
                <tbody  >
                    <tr>
                        <th >
                            <label for="name">
                                <label for="doc_id">Doctor:</label>
                            </label>
                        </th>
                        <td>
                            <select class="inputs" name="doc_id" id="doc_id">
                                <option disabled selected hidden>Select a doctor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="patient_id">Patient:</label>                        
                        </th>
                        <td>
                            <select class="inputs" id="patient_id" name="patient_id" >
                                <option disabled selected hidden>Select a patient</option>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="start-date">Date start:</label>
                        </th>
                        <td>
                            <input class="inputs" oninput="validateDateFormat( this, 'dd/MM/yyyy' )" placeholder="Define the appointment's start day"  value="<?php echo isset($_GET) ? $_GET['start_date'] : ""; ?>"  name="start-date" id="start-date">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="start-hour">Hour :</label>
                        </th>
                        <td>
                            <input  class="inputs" name="start-hour" value="<?php echo isset($_GET) ? $_GET['start_time'] : ""; ?>" id="start-hour" type="time"">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="rg">End:</label>                        
                        </th>
                        <td>
                            <input class="inputs" oninput="validateDateFormat( this, 'dd/MM/yyyy' )" value="<?php echo isset($_GET) ? $_GET['end_date'] : ""; ?>" placeholder="Define the appointment's end day"  type="text" name="end-date" id="end-date">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="end-hour">Hour :</label>
                        </th>
                        <td>
                            <input  class="inputs" name="end-hour" value="<?php echo isset($_GET) ? $_GET['end_time'] : ""; ?>" id="end-hour" type="time"">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="cost">Cost:</label>
                        </th>
                        <td  >
                            <input class="inputs" oninput="inputCost(this)" type="text" value="<?php echo isset($_GET) ? $_GET['cost'] : ""; ?>" name="cost" id="cost">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="insurance">Insurance:</label>
                        </th>
                        <td  >
                            <select class="inputs" name="insurance" id="insurance">
                                    <option disabled selected hidden>Select the patient's insurance option</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
                if( isset($_GET) )
                {
                    echo '<input type="hidden" name="appointid" value="'.  $_GET['id'] . '">';
                }
            ?>
            <input type='hidden' name='id' value='appointment'>
            <input type='hidden' name="action" value="<?php echo isset( $_GET ) ? $_GET['action'] : 'add' ?>">
            <button id="submit-btn" type="submit" class="submit-btn" >Save</button>
        </form>
    </div>
</body>

<?php
    require_once "../services/PatientManager.php";

    require_once "../services/DoctorManager.php";
    
    require_once "../services/InsuranceManager.php";




    $getAll = new PatientManager( null, 'getAll' ); 

    $patients = [];

    $doctors  = [];

    foreach( $getAll->getResultSet() as $patient )
    {
        $patientArr = 
        [
            "id" => $patient->getId(),
            "name" => $patient->getName(),
        ];
        array_push( $patients, $patientArr );
    }


    $getAll= new DoctorManager( null, 'getAll' );

    foreach( $getAll->getAll() as $doctor )
    {
        $doc = 
        [
            "id" => $doctor->getId(),
            "name" => $doctor->getName()
        ];

        array_push( $doctors, $doc );
    }

    $getAll = new InsuranceManager( null, "getAll" );

    $insurances = [];

    foreach( $getAll->getAll() as $insurance )
    {
        array_push( $insurances,
                                [
                                    "id" =>  $insurance->getId(),
                                    "name" =>  $insurance->getAccord(),
                                    "value" =>  $insurance->getValue(),                        
                                ]  );
    }
?>

<script>
    var doctor   = <?php echo json_encode( $doctors ); ?> ;
    var patient  = <?php echo json_encode( $patients ); ?>;
    var insurances = <?php echo json_encode( $insurances ); ?>;

    var editDoc = <?php if( isset( $_GET ) ){  echo json_encode($_GET['docId']); } ?> == null?  "":  <?php if( isset( $_GET ) ){  echo json_encode($_GET['docId']); } ?> ;
    var editPat = <?php if( isset( $_GET ) ){  echo json_encode($_GET['paID']); } ?> == null?  "":  <?php if( isset( $_GET ) ){  echo json_encode($_GET['paID']); } ?> ;
    var editInsurance = <?php if( isset( $_GET ) ){  echo json_encode($_GET['i_id']); } ?> == null?  "":  <?php if( isset( $_GET ) ){  echo json_encode($_GET['i_id']); } ?> ;

    doctor.forEach(
        e =>
        {

            var select = document.getElementById( 'doc_id' );
            var option = document.createElement( 'option' );
            option.setAttribute( "name", "doctorID" );
            option.setAttribute( "value", e.id );
            option.appendChild( document.createTextNode( e.name ) );
            option.selected = editDoc == e.id;
            select.appendChild( option );
        }
    );

    patient.forEach( 
        e =>
        {
            var select = document.getElementById( 'patient_id' );
            var option = document.createElement( "option" );
            option.setAttribute( "name", "patientID" );
            option.setAttribute( "value", e.id );
            option.appendChild( document.createTextNode( e.name ) );
            option.selected = editPat == e.id;
            select.appendChild( option );

        }
    );

    insurances.forEach(
        e =>
        {

            var select = document.getElementById( 'insurance' );
            var option = document.createElement( 'option' );
            option.setAttribute( "value", e.id );
            option.appendChild( document.createTextNode( e.name ) );
            option.selected = editInsurance == e.id;
            select.appendChild( option );
        }
    );
    

</script>
<script src="../../js/Patient.js" ></script>
</html>