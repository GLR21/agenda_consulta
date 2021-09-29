<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="css/login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body  >
    <div style="float: left;background-color: white;width: 50%; height: 100%;" >
        <div class="centered-div">
            <div style="width: 100%; height: 50%;" >
                <h1 style="text-align: center; padding-top: 1em;">Login</h1>
            </div>
            <form method="POST" action="src/services/controller.php">
                <table>
                    <tbody style="text-align: left;"; >
                        <tr>
                            <th >
                                <label  for="email">Email:</label>
                            </th>
                            <td>
                                <input class="inputs"  type="text" name="email" id="email">
                            </td>
                        </tr>
                        <tr>
                            <th>
                                <label for="password">Password:</label>
                            </th>
                            <td>
                                <input class="inputs"  type="password" name="password" id="password">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input style="margin-left: 9.2em;border-radius: 50%;" type="checkbox" name="isDoc" id="isDoc">
                <label style="text-align: left;margin: 0;font-size: 16px;" for="isDoc">Doctor login?</label>
                <button type="submit" id="submit-btn" class="btn-login">Login</button>
                <input type="hidden" name="id" value="login">
            </form>
        </div>
    </div>
</body>
<script>
    var btn = document.getElementById( 'submit-btn' );
    btn.addEventListener( 'click', function()
    {
        setTimeout(() =>
        {
            
            this.style.backgroundColor = '#009dd1';
        }, 100);

        this.style.backgroundColor = '#007ea8';
    } );
</script>
</html>