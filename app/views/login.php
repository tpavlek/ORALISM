<!doctype html>                                                                   
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ORALISM Login</title>
</head>
<body>
    <form>
        User Name: <input type='text' name='userName'><br>
        Password: <input type='password' name='password'><br>
        <input type='submit' value='Login' formaction='<?php echo $submit ?>' formmethod='post'>
        <?php echo $message ?>
    </form>
</body>
</html>
