

<?php
        require_once "../services/AppointmentManager.php";

        $manager = new AppointmentManager( null, "getAll" );
        // var_dump( $manager->getAll() );
        $manager = json_encode(  $manager->getAll() );

    ?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link  type="text/css"  rel="stylesheet" href="../../css/appointments.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
<body>
    <div id="nav"></div>
    <div id="content" class="content" ></div>
</body>

</html>
<script src="../../js/index.js" ></script>
<script>

var appointments = <?php echo $manager ?>

var table = document.createElement( 'table' );
table.setAttribute( 'class', "appointments-table" );

var thead = table.appendChild( document.createElement( 'THEAD' ) );

var tr = thead.insertRow();



var td_dname     = document.createElement( 'TD' );
var td_pname     = document.createElement( 'TD' );
var td_start     = document.createElement( 'TD' );
var td_end       = document.createElement( 'TD' );
var td_treatment = document.createElement( 'TD' );
var td_cost      = document.createElement( 'TD' );
var td_accord    = document.createElement( 'TD' );
var td_edit    = document.createElement( 'TD' );
var td_delete    = document.createElement( 'TD' );

td_dname.appendChild( document.createTextNode( 'Doctor:' ) );
td_pname.appendChild( document.createTextNode( 'Patient:' ) );
td_start.appendChild( document.createTextNode( 'Start:' ));
td_end.appendChild( document.createTextNode( 'End:' ));
td_treatment.appendChild( document.createTextNode( 'Treatment:' ) );
td_cost.appendChild(document.createTextNode( 'Cost:' ) );
td_accord.appendChild(document.createTextNode( 'Accord:' ) );
td_edit.appendChild( document.createTextNode( 'Edit' ) );
td_delete.appendChild( document.createTextNode( 'Delete' ) );

tr.appendChild( td_dname );
tr.appendChild( td_pname );
tr.appendChild( td_start );
tr.appendChild( td_end  );
tr.appendChild( td_treatment );
tr.appendChild( td_cost );
tr.appendChild( td_accord );
tr.appendChild( td_edit );
tr.appendChild( td_delete );

appointments.forEach
( 
    element => 
                {
                    var tr = table.insertRow();

                    var td_dname     = document.createElement( 'TD' );
                    td_dname.style.width = "10em";
    
                    var td_pname     = document.createElement( 'TD' );
                    td_pname.style.width = "10em";

                    var td_start     = document.createElement( 'TD' );
                    td_start.style.width = "10em";

                    var td_end       = document.createElement( 'TD' );
                    var td_treatment = document.createElement( 'TD' );
                    var td_cost      = document.createElement( 'TD' );
                    var td_accord      = document.createElement( 'TD' );

                    //ACTIONS
                    var td_delete  = document.createElement( 'TD' );
                    var btn_delete = document.createElement( 'BUTTON' );
                    var input_delete = document.createElement( 'INPUT' );
                    var form_delete = document.createElement( 'FORM' );
                    var action = document.createElement( 'INPUT' );
                    var id = document.createElement( 'INPUT' );

                    form_delete.setAttribute( "method", "POST" );
                    form_delete.setAttribute( 'action', "../services/controller.php" );
                    
                    btn_delete.appendChild( document.createTextNode( 'Delete' ) );
                    btn_delete.setAttribute( "type", "submit" );

                    input_delete.setAttribute( "name", "value" );
                    input_delete.setAttribute( "value", element.ap_id );
                    input_delete.setAttribute( 'type', 'hidden' );

                    action.setAttribute( "name", "action" );
                    action.setAttribute( "value", "delete" );
                    action.setAttribute( "type", "hidden"  );

                    id.setAttribute( 'name', 'id' );
                    id.setAttribute( 'value', "appointment" );
                    id.setAttribute( 'type', 'hidden' );

                    form_delete.appendChild( btn_delete );
                    form_delete.appendChild( input_delete );
                    form_delete.appendChild( action );
                    form_delete.appendChild( id );

                    var td_edit    = document.createElement( 'TD' );
                    var btn_edit   = document.createElement( 'BUTTON' );
                    var form_edit = document.createElement( 'FORM' );
                    var input_edit = document.createElement( 'INPUT' );
                    var action_edit = document.createElement( 'INPUT' );
                    var id_edit = document.createElement( 'INPUT' );

                    form_edit.setAttribute( "method", "POST" );
                    form_edit.setAttribute( 'action', "../services/controller.php" );

                    btn_edit.appendChild( document.createTextNode( 'Edit' ) );
                    btn_edit.setAttribute( "type", "submit" );
                    
                    input_edit.setAttribute( "name", "value" );
                    input_edit.setAttribute( "value", element.ap_id  );
                    input_edit.setAttribute( 'type', 'hidden' );

                    action_edit.setAttribute( "name", "action" );
                    action_edit.setAttribute( "value", "edit" );
                    action_edit.setAttribute( "type", "hidden"  );

                    id_edit.setAttribute( 'name', 'id' );
                    id_edit.setAttribute( 'value', "appointment" );
                    id_edit.setAttribute( 'type', 'hidden' );

                    form_edit.appendChild( btn_edit );
                    form_edit.appendChild( input_edit );
                    form_edit.appendChild( action_edit );
                    form_edit.appendChild( id_edit );

                    var calc = element.cost-( element.cost*( element.value/100 ) );

                    td_dname.appendChild( document.createTextNode( element.doc_name ) );
                    td_pname.appendChild( document.createTextNode( element.pa_name ) );
                    td_start.appendChild( document.createTextNode( element.start ) );
                    td_end.appendChild( document.createTextNode( element.end ) );
                    
                    var formBtnEdit  = document.createElement( 'Form' );
                    var btnEditTreat = document.createElement( 'Button' );
                    var input_action        = document.createElement( 'input' );
                    var idtret = document.createElement( 'input' );
                    var value = document.createElement( 'INPUT' );

                    btnEditTreat.appendChild( document.createTextNode( 'View Treatment' ) );
                    
                    formBtnEdit.setAttribute( "method", "POST" );
                    formBtnEdit.setAttribute( "ACTION", "../services/controller.php");
                    
                    idtret.setAttribute( 'name', 'id' );
                    idtret.setAttribute( 'value', "appointment" );
                    idtret.setAttribute( 'type', 'hidden' );

                    value.setAttribute( "name", "value" );
                    value.setAttribute( "value", element.ap_id  );
                    value.setAttribute( 'type', 'hidden' );

                    input_action.setAttribute( "name", "action" );
                    input_action.setAttribute( "value", "editTreatment" );
                    input_action.setAttribute( "type", "hidden" );
                    
                    formBtnEdit.appendChild(  btnEditTreat );
                    formBtnEdit.appendChild( value );
                    formBtnEdit.appendChild( idtret );
                    formBtnEdit.appendChild( input_action );
                    
                    td_treatment.appendChild( formBtnEdit  );
                    
                    td_cost.appendChild( document.createTextNode( "R$"+calc) );
                    td_accord.appendChild( document.createTextNode( element.accord ) );
                    td_delete.appendChild( form_delete );
                    td_edit.appendChild( form_edit );

                    tr.appendChild( td_dname );
                    tr.appendChild( td_pname );
                    tr.appendChild( td_start );
                    tr.appendChild( td_end );
                    tr.appendChild( td_treatment );
                    tr.appendChild( td_cost );
                    tr.appendChild( td_accord );
                    tr.appendChild( td_edit );
                    tr.appendChild( td_delete );

                    var content = document.getElementById( 'content' );
                    content.appendChild( table )

                }
);

</script>