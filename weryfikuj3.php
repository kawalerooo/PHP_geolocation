<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</HEAD>
<BODY>
<?php
$ipaddress = $_SERVER["REMOTE_ADDR"];
$user = htmlentities($_POST['user'], ENT_QUOTES, "UTF-8");
$pass = htmlentities($_POST['pass'], ENT_QUOTES, "UTF-8");
$link = mysqli_connect("sql304.byetcluster.com", "epiz_32739410", "aF5FWrM5hcy", "epiz_32739410_z2");
if (!$link) {
    echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
}
mysqli_query($link, "SET NAMES 'utf8'");
$result = mysqli_query($link, "SELECT * FROM users WHERE username='$user'");
$rekord = mysqli_fetch_array($result);
if (!$rekord)
{
    mysqli_close($link);
    header('Location: index3.php');
    exit();
} else {
    if ($rekord['password'] == $pass)
    {
        echo "Logowanie Ok. User: {$rekord['username']}. Hasło: {$rekord['password']}";
        session_start();
        $_SESSION['loggedin'] = true;

        $_SESSION['user'] = $user;

        $result2 = mysqli_query($link, "SELECT * FROM goscieportalu WHERE ipaddress='$ipaddress'");
        $rekord2 = mysqli_fetch_array($result2);
        $agent = $_SERVER['HTTP_USER_AGENT'];
        $przegladarka = array('Internet Explorer' => 'MSIE', 'Mozilla Firefox' => 'Firefox', 'Opera' => 'Opera', 'Chrome' => 'Chrome', 'Edge' => 'Edge');
        $system = array('Windows 2000' => 'NT 5.0', 'Windows XP' => 'NT 5.1', 'Windows Vista' => 'NT 6.0', 'Windows 7' => 'NT 6.1',
            'Windows 8' => 'NT 6.2', 'Windows 8.1' => 'NT 6.3', 'Windows 10' => 'NT 10', 'Linux' => 'Linux', 'iPhone' => 'iphone', 'Android' => 'android');
        foreach ($system as $nazwa => $id)
            if (strpos($agent, $id)) $system = $nazwa;
        foreach ($przegladarka as $nazwa => $id)
            if (strpos($agent, $id)) $przegladarka = $nazwa;

        $screenResolution = $_COOKIE['screen_resolution'];
        $browserResolution = $_COOKIE['browser_resolution'];
        $screenColors = $_COOKIE['screen_colors'];
        $cookiesStatus = $_COOKIE['cookies_status'];
        $java = $_COOKIE['java'];
        $browserLanguage = $_COOKIE['browser_language'];


        mysqli_query($link, "INSERT INTO goscieportalu (ipaddress, userbrowser, resoulution, browser_resolution, screen_colors, cookies_status, java_applets_permissions, webbrowser_language, username) VALUES ('$ipaddress', '$przegladarka', '$screenResolution', '$browserResolution', '$screenColors', '$cookiesStatus', '$java', '$browserLanguage', '$user')");
        mysqli_close($link);
        header('Location: index4.php');

    } else {

        mysqli_close($link);
        header('Location: index3.php');
        exit();
    }
}
?>
</BODY>
</HTML>