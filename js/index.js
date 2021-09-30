window.onload = 
function()
{
    document.getElementById('nav').innerHTML = loadPage( '../../html/navbar.php' );
    var log = document.getElementById( "logoff" );
log.addEventListener('click' , function(){ var form = document.getElementById('logoff-form'); form.submit(); });
};


function loadPage(uri)
{
    var xml = new XMLHttpRequest();
    xml.open( 'GET', uri, false );
    xml.send();
    return xml.responseText;    
}

