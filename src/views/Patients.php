<?php

// require '../PatientManager.php';

require_once "../services/PatientManager.php";

$getAll = new PatientManager( null, 'getAll' ); 

$allarr = [];

foreach( $getAll->getResultSet() as $patient )
{
    $patientArr = 
    [
        "id" => $patient->getId(),
        "name" => $patient->getName(),
        "email" => $patient->getEmail(),
        "password" => $patient->getPassword(),
        "address" => $patient->getAddress(),
        "age" => $patient->getAge(),
        "birth" => $patient->getBirthDate(),
        "cpf" => $patient->getDocument( 1 ),
        "rg" => $patient->getDocument( 0 ),
        "role" => $patient->getRole(),
        "obs" => $patient->getObservation()

    ];
    array_push( $allarr, $patientArr );
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../../css/show.css">
    <link rel="shortcut icon" href="../../resources/care.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patients</title>
</head>
<body>
    <div id="nav" ></div>
    <div class="main" >
        <table class="user_table" id='user_table'; " > 
            <thead>
                <tr>
                    <th>
                        Name:          
                    </th>
                    <th>
                        Email:          
                    </th>
                    <th>
                        Password:          
                    </th>
                    <th>
                        Address:          
                    </th>
                    <th>
                        Age:          
                    </th>
                    <th>
                        Birtdate:          
                    </th>
                    <th>
                        CPF:          
                    </th>
                    <th>
                        RG:          
                    </th>
                    <th>
                        Role:          
                    </th>
                    <th>
                        Obs:          
                    </th>
                </tr>
            </thead>
            <tbody>
                             
            </tbody>
        </table>
    </div>
</body>
</html>
<script src="../../js/index.js" ></script>
<script>

var patients;



patients = <?php echo json_encode( $allarr ); ?>;

if(  patients.length <= 0)
{
    var table = document.getElementById('user_table');
    table.setAttribute( 'class', 'user_table-hidden' );

}

else
{

    patients.forEach(element =>
    {
        var tbodyRef = document.getElementById('user_table').getElementsByTagName('tbody')[0];
        // Insert a row at the end of table
        var newRow = tbodyRef.insertRow();

        // Insert a cell at the end of the row
        var row1 = newRow.insertCell();
        row1.appendChild( document.createTextNode( element.name) );

        var row2 = newRow.insertCell();
        row2.appendChild( document.createTextNode( element.email) );

        var row3 = newRow.insertCell();
        row3.appendChild( document.createTextNode( element.password) );

        var row4  = newRow.insertCell();
        row4.appendChild( document.createTextNode( element.address)  );

        var row5 = newRow.insertCell();
        row5.appendChild(  document.createTextNode( element.age)  );

        var row6 = newRow.insertCell();
        row6.appendChild(  document.createTextNode( element.birth)  );

        var row7 = newRow.insertCell();
        row7.appendChild( document.createTextNode( element.cpf)  );

        var row8 = newRow.insertCell();
        row8.appendChild(  document.createTextNode( element.rg)  );

        var row9 = newRow.insertCell();
        row9.appendChild( document.createTextNode( element.role)  );

        var row10 = newRow.insertCell();
        row10.appendChild( document.createTextNode( element.obs)  );

        var row11 = newRow.insertCell();
        var form = document.createElement('FORM');
        form.setAttribute( 'action', '../services/controller.php' );
        form.setAttribute( 'method', 'POST' );
        
        var input = document.createElement( 'INPUT' );
        input.setAttribute( 'type', 'hidden' );
        input.setAttribute( 'name', 'id' );
        input.setAttribute( 'value', 'patient' );

        var input2 = document.createElement( 'INPUT' );

        input2.setAttribute( 'type', 'hidden' );
        input2.setAttribute( 'name', 'action' );
        input2.setAttribute( 'value', 'edit' );

        var input3 = document.createElement( 'INPUT' );

        input3.setAttribute( 'type', 'hidden' );
        input3.setAttribute( 'name', 'value' );
        input3.setAttribute( 'value', element.id );

        form.appendChild( input );
        form.appendChild( input2 );
        form.appendChild( input3 );
        

        var btn = document.createElement('BUTTON');

        btn.innerText = "Edit";
        btn = document.createElement('BUTTON');
        btn.innerText = "Edit";
        btn.setAttribute( 'name', 'edit' );
        btn.setAttribute( 'id', element.id );
        btn.setAttribute( 'type', 'submit' );
        form.appendChild( btn );
        row11.appendChild( form );
        
        var row12 = newRow.insertCell();

        var form = document.createElement('FORM');
        form.setAttribute( 'action', '../services/controller.php' );
        form.setAttribute( 'method', 'POST' );
        
        var input = document.createElement( 'INPUT' );
        input.setAttribute( 'type', 'hidden' );
        input.setAttribute( 'name', 'id' );
        input.setAttribute( 'value', 'patient' );

        var input2 = document.createElement( 'INPUT' );

        input2.setAttribute( 'type', 'hidden' );
        input2.setAttribute( 'name', 'action' );
        input2.setAttribute( 'value', 'delete' );

        var input3 = document.createElement( 'INPUT' );

        input3.setAttribute( 'type', 'hidden' );
        input3.setAttribute( 'name', 'value' );
        input3.setAttribute( 'value', element.id );

        form.appendChild( input );
        form.appendChild( input2 );
        form.appendChild( input3 );
        
        var btn = document.createElement('BUTTON');
        btn.innerText = "Delete";
        btn.setAttribute( 'id', element.id );
        btn.setAttribute( 'type', 'submit' );
        form.appendChild( btn );
        
        
        row12.appendChild( form );

    });
}

</script>