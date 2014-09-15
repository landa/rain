<?php
    $dbh = mysql_connect('sql.mit.edu', 'landa', 'kkfuerZ1dd');
    if (!$dbh)
       die('Could not connect: ' . mysql_error() . '<br />');

    mysql_select_db("landa+rainp") or die("No database selected.");

    $mobile = str_split($_POST['mobile']);
    $email = $_POST['email'];
    $zipcode = $_POST['zipcode'];

    $phone = "";
    for ($ii = 0; $ii < count($mobile); $ii++) {
        if (is_numeric($mobile[$ii])) $phone .= $mobile[$ii];
    }
    if (substr($phone, 0, 1) == "1") $phone = substr($phone, 1);

    $sql = "INSERT INTO users (zipcode, phone, email) VALUES ('$zipcode', '$phone', '$email')";
    mysql_query($sql);

    header("Location: success.php");
?>
