<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link  type="text/css"  rel="stylesheet" href="../../css/appointments.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
<body>
    <?php
        require_once "../services/AppointmentManager.php";

        $manager = new AppointmentManager( null, "getAll" );
        // var_dump( $manager->getAll() );
        $manager = json_encode(  $manager->getAll() );

    ?>

</body>

</html>
<script>

var appointments = <?php echo $manager ?>

var table = document.createElement( 'table' );

var thead = table.appendChild( document.createElement( 'THEAD' ) );

var tr = thead.insertRow();



var td_dname     = document.createElement( 'TD' );
var td_pname     = document.createElement( 'TD' );
var td_start     = document.createElement( 'TD' );
var td_end       = document.createElement( 'TD' );
var td_treatment = document.createElement( 'TD' );
var td_cost      = document.createElement( 'TD' );

td_dname.appendChild( document.createTextNode( 'Doctor:' ) );
td_pname.appendChild( document.createTextNode( 'Patient:' ) );
td_start.appendChild( document.createTextNode( 'Start:' ));
td_end.appendChild( document.createTextNode( 'End:' ));
td_cost.appendChild(document.createTextNode( 'Cost:' ) );
td_treatment.appendChild( document.createTextNode( 'Treatment:' ) );

tr.appendChild( td_dname );
tr.appendChild( td_pname );
tr.appendChild( td_start );
tr.appendChild( td_end  );
tr.appendChild( td_treatment );
tr.appendChild( td_cost );
appointments.forEach( element => 
                                {
                                    

                                    var tr = table.insertRow();

                                    var td_dname     = document.createElement( 'TD' );
                                    var td_pname     = document.createElement( 'TD' );
                                    var td_start     = document.createElement( 'TD' );
                                    var td_end       = document.createElement( 'TD' );
                                    var td_treatment = document.createElement( 'TD' );
                                    var td_cost      = document.createElement( 'TD' );
                                    
                                    // var doc_id       = document.createTextNode( element.doc_id );
                                    var doc_name     = document.createTextNode( element.doc_name );
                                    // var patient_id   = document.createTextNode( element.pa_id );
                                    var patient_name = document.createTextNode( element.pa_name );
                                    var start        = document.createTextNode( element.start );
                                    var end          = document.createTextNode( element.end );
                                    var treatment    = document.createTextNode( element.treatment );
                                    var cost         = document.createTextNode( element.insurance );


                                    // td_did.appendChild( doc_id );
                                    td_dname.appendChild( doc_name );
                                    // td_pid.appendChild( patient_id );
                                    td_pname.appendChild( patient_name );
                                    td_start.appendChild( start );
                                    td_end.appendChild( end );
                                    td_treatment.appendChild( treatment );
                                    td_cost.appendChild( cost );

                                    // tr.appendChild( td_did );
                                    tr.appendChild( td_dname );
                                    // tr.appendChild( td_pid );
                                    tr.appendChild( td_pname );
                                    tr.appendChild( td_start );
                                    tr.appendChild( td_end );
                                    tr.appendChild( td_treatment );
                                    tr.appendChild( td_cost );

                                    document.body.appendChild( table );

                                }
                    );

</script>