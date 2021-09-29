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
                        <h1  >Patient Register</h1>
                    </div>
                </thead>
                <tbody  >
                    <tr>
                        <th >
                            <label for="name">
                                <label for="doc">Doctor:</label>
                            </label>
                        </th>
                        <td>
                            <select class="inputs" name="doc" id="doc">
                                <option disabled selected hidden>Select a doctor</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="patient">Patient:</label>                        
                        </th>
                        <td>
                            <select class="inputs" id="patient" name="patient" >
                                <option disabled selected hidden>Select a patient</option>
                           </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="date-start">Date start:</label>
                        </th>
                        <td>
                            <input class="inputs" oninput="validateDateFormat( this, 'dd/MM/yyyy' )" placeholder="Define the appointment's start day"  name="date-start" id="date-start">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="rg">End:</label>                        
                        </th>
                        <td>
                            <input class="inputs" oninput="validateDateFormat( this, 'dd/MM/yyyy' )" placeholder="Define the appointment's end day"  type="text" name="end-date" id="end-date">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="cost">Cost:</label>
                        </th>
                        <td  >
                            <input class="inputs" oninput="inputCost(this)" type="text" name="cost" id="cost">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="insurance">Insurance:</label>
                        </th>
                        <td  >
                            <input class="inputs" placeholder="Select the patient's insurance option"  name="insurance" id="insurance">
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
                if( array_key_exists( "id", $_GET ) )
                {
                    echo '<input type="hidden" name="patid" value="'.  $_GET['id'] . '">';
                }
            ?>
            <input type='hidden' name='id' value='appointment'>
            <input type='hidden' name='action' value="<?php if( array_key_exists( "action", $_GET ) ){ echo $_GET['action'];  } else { echo "add"; } ?>">
            <button id="submit-btn" type="submit" class="submit-btn" >Save</button>
        </form>
    </div>
</body>

<?php
    require_once "../services/PatientManager.php";

    require_once "../services/DoctorManager.php";



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
?>

<script>
    var patient  = <?php echo json_encode( $patients ); ?>

    var doctor   = <?php echo json_encode( $doctors ); ?> 

    patient.forEach( 
        e =>
        {
            var select = document.getElementById( 'patient' );
            var option = document.createElement( "option" );
            option.setAttribute( "name", "patientID" );
            option.setAttribute( "value", e.id );
            option.appendChild( document.createTextNode( e.name ) );
            select.appendChild( option );

        }
    );

    doctor.forEach(
        e =>
        {

            var select = document.getElementById( 'doc' );
            var option = document.createElement( 'option' );
            option.setAttribute( "name", "doctorID" );
            option.setAttribute( "value", e.id );
            option.appendChild( document.createTextNode( e.name ) );
            select.appendChild( option );
        }
    );

    
    function inputCost( el )
    {
    }

</script>
<script src="../../js/Patient.js" ></script>
</html>