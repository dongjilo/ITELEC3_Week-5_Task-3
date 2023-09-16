<?php
/** date() function
 * d - day of the month
 * D - texttual representation (3 letters) of day
 * j - day of the month witout 0s
 * l - full textual representation of the day
 * N - ISO-8601
 * S - ordinal suffix
 */
date_default_timezone_set('Asia/Manila');
$datetime = date('Y-m-d H-i-s');
$date = date('Y-m-d');
$time = date('H:i A');
$today = date('jS m Y');

echo "$today <br>";

echo "$datetime <br>";
echo "$date <br>";
echo "$time <br>";

/** checkdate() function
 *
 */
var_dump(checkdate(02,29,20));

/**
 * date_create + date_format function
 */
$dateString = "2023-09-7";
$newDate = date_create($dateString);
$add = date_interval_create_from_date_string("-9 months -19 years");
date_add($newDate, $add);
$dateFormat = date_format($newDate, 'F j, Y');
echo "<br> $dateFormat <br>";

/**
 * date_diff function
 */

$dateOne = date_create("2023-09-13");
$dateTwo = date_create("2004-09-13");
$diff = date_diff($dateOne, $dateTwo);
echo $diff -> format("%Y years");


