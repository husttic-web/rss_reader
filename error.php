<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            if(isset($_COOKIE['error'])){
                echo $_COOKIE['error'];
                setcookie("error",NULL,time()-3600);
            }
        ?>
    </body>
</html>
