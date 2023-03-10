<?php declare(strict_types=1);
session_start();
if (!isset($_SESSION['loggedin']))
{
    header('Location: index3.php');
    exit();
}

echo "Jesteś zalogowany oto twoja";
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<BODY>
<a href ="login_history.php">historia logowania</a>><br />
<font color="#FF0101"><h2 align='center'><a href="logout.php">WYLOGUJ</a></h2><font color="#FF0101">
</BODY>
</HTML>