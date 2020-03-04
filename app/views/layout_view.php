<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/css/styles.css">
    <title>Test for BeeJee</title>
</head>
<body>
<div class="container login">
    <div class="row">
        <div class="col-md-12 align-right">
            <?php
            if (isset($_SESSION['isadmin']) && $_SESSION['isadmin']===true) {
                echo '<a href="/task/logout">Sign out</a>';
            } else {
                echo '<a href="/task/login">Sign in</a>';
            }
            ?>
        </div>
    </div>
</div>

    <? include('app/views/'.$content); ?>
</body>
</html>