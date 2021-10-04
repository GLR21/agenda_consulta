function loadAppointments( appointments )
{
    var table = document.createElement( 'table' );
    table.setAttribute( 'class', "appointments-table" );
    table.setAttribute( 'id', "appointments-table" );

    // var tr = table.insertRow();

    var td_dnameMain     = document.createElement( 'TR' );
    var td_pnameMain     = document.createElement( 'TR' );
    var td_startMain     = document.createElement( 'TR' );
    var td_endMain       = document.createElement( 'TR' );
    var td_treatmentMain = document.createElement( 'TR' );
    var td_costMain      = document.createElement( 'TR' );
    var td_accordMain    = document.createElement( 'TR' );
    var td_editMain      = document.createElement( 'TR' );
    var td_deleteMain    = document.createElement( 'TR' );


    
    var th_dnameMain     = document.createElement( 'SPAN' );
    th_dnameMain.setAttribute( 'class', "span" );

    var th_pnameMain     = document.createElement( 'SPAN' );
    th_pnameMain.setAttribute( 'class', "span" );    
    
    var th_startMain     = document.createElement( 'SPAN' );
    th_startMain.setAttribute( 'class', "span" );

    var th_endMain       = document.createElement( 'SPAN' );
    th_endMain.setAttribute( 'class', "span" );

    var th_treatmentMain = document.createElement( 'SPAN' );
    th_treatmentMain.setAttribute( 'class', "span" );

    var th_costMain      = document.createElement( 'SPAN' );
    th_costMain.setAttribute( 'class', "span" );

    var th_accordMain    = document.createElement( 'SPAN' );
    th_accordMain.setAttribute( 'class', "span" );
    
    var th_editMain      = document.createElement( 'SPAN' );
    th_editMain.setAttribute( 'class', "span" );
    
    var th_deleteMain    = document.createElement( 'SPAN' );
    th_deleteMain.setAttribute( 'class', "span" );


    th_dnameMain.appendChild(   document.createTextNode( 'Doctor:' )      );
    th_pnameMain.appendChild(       document.createTextNode( 'Patient:' ) );
    th_startMain.appendChild(          document.createTextNode( 'Start:' ));
    th_endMain.appendChild(              document.createTextNode( 'End:' ));
    th_treatmentMain.appendChild(     document.createTextNode( 'Treatment:' ) );
    th_costMain.appendChild(            document.createTextNode( 'Cost:' ) );
    th_accordMain.appendChild(        document.createTextNode( 'Accord:' ) );
    th_editMain.appendChild(             document.createTextNode( 'Edit' ) );
    th_deleteMain.appendChild(         document.createTextNode( 'Delete' ) );

    td_dnameMain.appendChild( th_dnameMain );
    td_pnameMain.appendChild( th_pnameMain );
    td_startMain.appendChild( th_startMain );
    td_endMain.appendChild( th_endMain );
    td_treatmentMain.appendChild( th_treatmentMain );
    td_costMain.appendChild( th_costMain );
    td_accordMain.appendChild( th_accordMain );
    td_editMain.appendChild( th_editMain );
    td_deleteMain.appendChild( th_deleteMain );



    table.appendChild( td_dnameMain );
    table.appendChild( td_pnameMain );
    table.appendChild( td_startMain );
    table.appendChild( td_endMain  );
    table.appendChild( td_treatmentMain );
    table.appendChild( td_costMain );
    table.appendChild( td_accordMain );
    table.appendChild( td_editMain );
    table.appendChild( td_deleteMain );

    appointments.forEach
    ( 
        element => 
        {


            

            var td_dname     = document.createElement( 'TD' );
            // td_dname.style.width = "10em";

            var td_pname     = document.createElement( 'TD' );
            // td_pname.style.width = "10em";

            var td_start     = document.createElement( 'TD' );
            // td_start.style.width = "10em";

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
            btn_delete.setAttribute( 'class', "delete-button" );

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
            btn_edit.setAttribute( 'class', "edit-button" );
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
            btnEditTreat.setAttribute( 'class', "view-button"  );
            
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

            var innerTrdname = document.createElement( 'tr' );
            innerTrdname.appendChild( td_dname );
            
            var innerTrpname = document.createElement( 'tr' );
            innerTrpname.appendChild(td_pname );

            var innerTrstart = document.createElement( 'tr' );
            innerTrstart.appendChild( td_start );
            
            var innerTrend = document.createElement( 'tr' );
            innerTrend.appendChild( td_end  );

            var innerTrtreat = document.createElement( 'tr' );
            innerTrtreat.appendChild( td_treatment );

            var innerTrcost = document.createElement( 'tr' );
            innerTrcost.appendChild( td_cost );

            var innerTraccord = document.createElement( 'tr' );
            innerTraccord.appendChild( td_accord );

            var innerTredit = document.createElement( 'tr' );
            innerTredit.appendChild( td_edit );

            var innerTrdelete = document.createElement( 'tr' );
            innerTrdelete.appendChild(td_delete);

            td_dnameMain.appendChild( innerTrdname );
            td_pnameMain.appendChild( innerTrpname );
            td_startMain.appendChild( innerTrstart );
            td_endMain.appendChild( innerTrend );
            td_treatmentMain.appendChild( innerTrtreat );
            td_costMain.appendChild( innerTrcost );
            td_accordMain.appendChild( innerTraccord );
            td_editMain.appendChild( innerTredit );
            td_deleteMain.appendChild( innerTrdelete );

            var content = document.getElementById( 'content' );
            content.appendChild( table )

        }
    );
}


function search( value )
{
    var tbody = document.getElementById('appointments-table').childNodes;
    var filter = value.toUpperCase();
    var lasValue = "";
    lasValue += filter;
    var i = 0;
 

    var rows = tbody;

    
        while( i < rows.length)
        {
            
            var row = rows[i].childNodes;
            var x = 1;
            while ( x < row.length)
            {
                

                if ( value !== "" )
                {
                    var j  = 0;
                    while(  j <  row[x].childNodes.length )
                    {

                        // console.log( row[x].childNodes[j].textContent.toUpperCase() );

                        var includes =  row[x].childNodes[j].textContent != undefined ? row[x].childNodes[j].textContent.toUpperCase().includes( lasValue ) : false;
                
                        if( !includes )
                        {
                            rows[i].style.display = "none";
                            
                        }

                        ++j;
                    }
                
                }
                else
                {
                    rows[i].style.display = "grid";
                    lasValue = "";
                }                

                ++x; 
            }
            ++i;
        }

        console.log( )
        
}
