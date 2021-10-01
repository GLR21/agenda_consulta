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
                                <label for="name">Name:</label>
                            </label>
                        </th>
                        <td>
                            <input class="inputs" placeholder="Name"  value="<?php  if( array_key_exists( 'name', $_GET ) ){ echo $_GET['name']; }?>"  name="name" type="text" id="name">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="email">Email:</label>                        
                        </th>
                        <td>
                            <input class="inputs" placeholder="Email" type="text" value="<?php  if( array_key_exists( 'email', $_GET ) ){ echo $_GET['email']; } ?>" name="email" id="email">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="cpf">CPF:</label>
                        </th>
                        <td>
                            <input class="inputs" placeholder="CPF" type="text" value="<?php  if( array_key_exists( 'cpf', $_GET ) ){ echo $_GET['cpf']; }  ?>" name="cpf" oninput="cpfChange(this.value)" id="cpf">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="rg">RG:</label>                        
                        </th>
                        <td>
                            <input class="inputs" placeholder="RG" maxlength="10" oninput="isInteger(this)" type="text" value="<?php  if( array_key_exists( 'rg', $_GET ) ){ echo $_GET['rg']; }  ?>" name="rg" id="rg">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="birth">BirhDate:</label>
                        </th>
                        <td  >
                            <input class="inputs" placeholder="BirthDate" oninput="validateDateFormat( this, 'dd/MM/yyyy' )"  value="<?php if( array_key_exists(  'birth' ,$_GET) ){ echo $_GET['birth'];  }  ?>" type="text" name="birth" id="birth">
                        </td>
                    </tr>
                    <tr >
                        <th>
                            <label for="age">Age:</label>
                        </th>
                        <td  >
                            <input class="inputs" placeholder="Age" maxlength="3" oninput="isInteger(this)"  type="text" value="<?php  if( array_key_exists( 'age', $_GET ) ){ echo $_GET['age']; }  ?>" name="age" id="age">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="password">Password:</label>                        
                        </th>
                        <td>
                            <input class="inputs"  placeholder="Password" type="password" value="<?php  if( array_key_exists( 'password', $_GET ) ){ echo convert_uuencode( base64_encode(  $_GET['password'] ) ); } ?>" name="password" id="password">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="address">Address:</label>                        
                        </th>
                        <td>
                            <input class="inputs" placeholder="Address" type="text" name="address" value="<?php  if( array_key_exists( 'address', $_GET ) ){ echo $_GET['address']; }  ?>" id="address">
                        </td>
                    </tr>
                    <tr>
                        <th>
                            <label for="obs"> Observations:</label>
                        </th>
                    </tr>
                    <tr >
                        <td colspan='2'>
                            <textarea maxlength="800" class="observation" name="obs"  type="text" name=""   id="obs"><?php  if( array_key_exists( 'obs', $_GET ) ){ echo $_GET['obs']; }  ?></textarea>
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
            <input type='hidden' name='id' value='patient'>
            <input type='hidden' name='action' value="<?php if( array_key_exists( "action", $_GET ) ){ echo $_GET['action'];  } else { echo "add"; } ?>">
            <button id="submit-btn" type="submit" class="submit-btn" >Save</button>
        </form>
    </div>
</body>
<script src="../../js/Patient.js" ></script>
</html>