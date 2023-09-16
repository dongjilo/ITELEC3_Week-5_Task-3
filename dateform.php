<?php

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="./js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body style="background-color: #eee">
<div class="container border mt-5 p-5 bg-light">
    <h1 class="h1">BIRTHDAY CALCULATOR</h1>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form" method="post">
            <label for="txtBrith" class="form-label">Enter your birthdate</label>
            <input type="date" name="txtBirth" id="txtBrith" class="form-control">
            <input type="submit" value="SUBMIT" class="btn btn-primary mt-3">
    </form>
    
    <?php
    if (isset($_POST['txtBrith'])) {
        date_default_timezone_set("Asia/Manila");
        $dateToday = date('Y-m-d');
        $bdate = $_POST['txtBrith'];
        $age = date_diff($dateToday, $bdate);
        echo $age;
    }
    ?>
</div>
</body>
</html>
