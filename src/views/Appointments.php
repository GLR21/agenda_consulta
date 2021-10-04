
<?php
        require_once "../services/AppointmentManager.php";
        $manager = new AppointmentManager( null, "getAll" );
        $manager = json_encode(  $manager->getAll() );
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="../../../favicon.ico" type="image/x-icon">
    <link  type="text/css"  rel="stylesheet" href="../../css/appointments.css?v2">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointments</title>
</head>
<body>
    <div id="nav"></div>
    <div id="content" class="content" >
        <div class="search-area" >
            <label for="search-bar"><span>Search:</span></label>
            <input class="search-bar" onkeyup="search( this.value )" type="text" name="search-bar" id="search-bar">
        </div>
    </div>
    
</body>

</html>
<script src="../../js/index.js" ></script>
<script src="../../js/appointments.js" ></script>
<script>
    
    var appointments = <?php echo isset( $manager ) ? $manager : json_encode(null) ?>;
    loadAppointments( appointments );

</script>