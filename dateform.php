<?php
session_start();
$_SESSION['errorMsg'] = '<div class="alert alert-primary alert-dismissible d-flex align-items-center" role="alert">
                          <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Info:"><use xlink:href="#info-fill"/></svg>
                          <div>
                            Please enter dates continue.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                        </div>';
function printDates($dateLoan, $dateDue, $days, $months, $years){
    echo '<div class="alert alert-success alert-dismissible fade show mb-0" role="alert">
          <svg class="bi flex-shrink-0" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
          <strong>Loan is not due yet.</strong>
          <p>Date loan is: ' . $dateLoan -> format('F d, Y') .
         '<br>Due date is: ' . $dateDue -> format('F d, Y') .
         '<br>Number of days until due: ' . $days .
         '<br>Number of months until due: ' . $months .
         '<br>Number of years until due: ' .$years .
         '</p>  
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> 
          </div>';
}

function printDue($dateLoan, $dateDue, $days, $months, $years) {
    echo '<div class="alert alert-danger alert-dismissible fade show mb-0" role="alert">
          <svg class="bi flex-shrink-0" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
          <strong>Loan is due.</strong>
          <p>Date loan is: ' . $dateLoan -> format('F j, Y') .
         '<br>Due date is: ' . $dateDue -> format('F j, Y') .
         '<br>Number of days lapse: ' . $days .
         '<br>Number of months lapse: ' . $months .
         '<br>Number of years lapse: ' . $years .
         '</p>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <title>Loan Calculator</title>
</head>

<body style="background-color: #eee;">

<svg xmlns="http://www.w3.org/2000/svg" class="d-none">
    <symbol id="check-circle-fill" viewBox="0 0 16 16">
        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
    </symbol>
    <symbol id="info-fill" viewBox="0 0 16 16">
        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
    </symbol>
    <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
        <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
    </symbol>
</svg>

    <div class="container d-flex justify-content-center" style="margin-top: 8%;">
        <div class="card border-primary w-50">
            <div class="card-header bg-primary text-white">
                <h1 class="h2 pb-0 pt-2 text-center">Loan Calculator</h1>
            </div>
            <div class="card-body p-3" name="cardbody" id="cardbody">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" class="form" method="post">
                    <div class="mb-2 form-floating">
                        <input type="date" name="txtLoan" id="txtLoan" class="form-control" placeholder="DD/MM/YYYY">
                        <label for="txtLoan">Enter loan date:</label>
                    </div>

                    <div class="mb-2 form-floating">
                        <input type="date" name="txtDue" id="txtDue" class="form-control" placeholder="DD/MM/YYYY">
                        <label for="txtDue">Enter due date:</label>
                    </div>
                    <button type="submit" class="btn btn-success">Check Lapse</button>
                </form>
            <hr>
                <?php
                if (!empty($_POST['txtLoan']) && !empty($_POST['txtDue'])) {
                    unset($_SESSION['errorMsg']);
                    $loanDate = new DateTime($_POST['txtLoan']);
                    $dueDate = new DateTime($_POST['txtDue']);
                    $interval = date_diff($loanDate, $dueDate);
                    $totalMonths = $interval -> format('%m') + $interval -> y * 12;
                    $totalDays = $interval -> days;
                    $totalYears = $interval -> y;
                    $isDue = ($dueDate > $loanDate) ? printDates($loanDate, $dueDate, $totalDays, $totalMonths, $totalYears) : printDue($loanDate, $dueDate, $totalDays, $totalMonths, $totalYears);
                    echo $isDue;
                } elseif (empty($_POST['txtLoan']) || empty($_POST['txtDue'])) {
                    echo $_SESSION['errorMsg'];
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
