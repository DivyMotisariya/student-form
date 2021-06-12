<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>User Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="./login.js"></script>
</head>

<body>
    <a id="logged" hidden><?php if(isset($_COOKIE['logged'])) {echo $_COOKIE['logged'] . ' ' . $_SESSION['logged'];}; ?></a>
    <div class="text-center">
        <form id='frmLogin' method="post" onsubmit="return checkLogin()">
            <!-- USER NAME -->
            <hr style="width: 0;">
            <input type="text" placeholder="Username" autocomplete="off" name="userid" id="userid" />
            <hr style="width: 0;">
            <!-- PASSWORD -->
            <input type="password" placeholder="Password" autocomplete="off" name="userpwd" id="userpwd" />
            <hr style="width: 0;">
            <button class="btn-primary btn-sm" type="submit" id="login">Login</button>
        </form>
    </div>
</body>

</html>