<html lang="en">
<head>
    <link rel="shortcut icon" href="../../resources/care.png" type="image/x-icon">
    <link  type="text/css"  rel="stylesheet" href="../../css/treatmentEditor.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="container" >
        <form action="../services/controller.php" method="post">
            <div>
                <h1 class="title">Treatment Editor</h1>
                <textarea name="treatment" id="" maxlength="4000" class="editor" ><?php if( $_GET['treatment'] !=null  ){ echo $_GET['treatment'] ;  } else { echo "Describe the patient's treatment..."; } ?></textarea>
            </div>
            <button type="submit" id="submit-btn" class="submit-btn" ><span>Save</span></button>
            <input type="hidden" name="id" value="appointment" >
            <input type="hidden" name="action" value="updateTreatment" >
            <input type="hidden" name="value" value="<?php echo $_GET['id'] ?>">
        </form>
    </div>
</body>
<script type="text/javascript" >

var btn = document.getElementById( 'submit-btn' );


btn.addEventListener( 'click', function()
{
    setTimeout(() =>
    {
        
        this.style.backgroundColor = '#2ae904';
    }, 100);

    this.style.backgroundColor = '#25cc04';
} );
</script>
</html>