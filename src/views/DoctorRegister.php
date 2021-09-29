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
                        <h1>Doctor Register</h1>
                    </div>
                </thead>
                <tbody  >
                    <tr>
                        <th >
                            <label for="name">Name:</label>
                        </th>
                        <td>
                            <input class="inputs" placeholder="Name" name="name" type="text" value="<?php if( array_key_exists( 'name',  $_GET ) ) {  echo $_GET['name'];  } ?>" id="name">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="email">Email:</label>                        
                        </th>
                        <td>
                            <input class="inputs" placeholder="Email" type="text" name="email" value="<?php if( array_key_exists( 'email',  $_GET ) ) {  echo $_GET['email'];  } ?>" id="email">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="crm">CRM:</label>
                        </th>
                        <td>
                            <input class="inputs" placeholder="crm" type="text"  name="crm"  value="<?php if( array_key_exists( 'crm',  $_GET ) ) {  echo $_GET['crm'];  } ?>" id="crm">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="spec">Specialization:</label>                        
                        </th>
                        <td>
                            <input class="inputs" placeholder="Specialization" type="text" value="<?php if( array_key_exists( 'spec',  $_GET ) ) {  echo $_GET['spec'];  } ?>" name="spec" id="spec">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="sector">Sector:</label>
                        </th>
                        <td  >
                            <select class="sector-selection" name="sector" id="sector">
                                <option value="">-- Select --</option>
                                <option value="Nutrition">Nutrition</option>
                                <option value="Dermatology">Dermatology</option>
                                <option value="Radiology">Radiology</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="password">Password:</label>                        
                        </th>
                        <td>
                            <input class="inputs"  placeholder="Password" value="<?php if( array_key_exists( 'password',  $_GET ) ) {  echo convert_uuencode( base64_encode($_GET['password']) );  } ?>" type="password" name="password" id="password">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="appointment_time">Appointment Time:</label>                        
                        </th>
                        <td>
                            <input  class="inputs" placeholder="Appointment Time" oninput="isInteger(this)" type="text" value="<?php if( array_key_exists( 'aptime',  $_GET ) ) {  echo $_GET['aptime'];  } ?>" name="appointment_time" id="appointment_time">
                        </td>
                    </tr>
                </tbody>
            </table>
            <input type='hidden' name='id' value='doc'>
            <?php 
                if (array_key_exists( 'id', $_GET ) )
                {
                    echo '<input type="hidden" name="docid" value="'. $_GET['id'] . '">';
                }
            ?>
            <input type="hidden" name="action" value="<?php if( array_key_exists( 'action', $_GET ) ){  echo  $_GET['action']; } else { echo 'add'; } ?>">
            <button style="margin-top: 1em;" id="submit-btn" type="submit" class="submit-btn" >Save</button>
        </form>
    </div>
</body>
<script src="../../js/Patient.js" ></script>
</html>