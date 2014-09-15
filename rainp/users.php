<?php
    $dbh = mysql_connect('sql.mit.edu', 'landa', 'kkfuerZ1dd');
    if (!$dbh)
       die('Could not connect: ' . mysql_error() . '<br />');

    mysql_select_db("landa+rainp") or die("No database selected.");

    if ($_GET['password'] != 'redacted') exit(); // yes, it's not secure, but this is a quick hack

    $query = "SELECT * FROM users";
    $sql = mysql_query($query);
    while ($obj = mysql_fetch_array($sql)) {
        echo $obj['zipcode'].','.$obj['email'].','.$obj['phone']."\n";
    }
?>
