<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</HEAD>
<script>
    document.cookie = "screen_resolution=" + screen.width + "x" + screen.height;
    document.cookie = "browser_resolution=" + window.innerWidth + "x" + window.innerHeight;
    document.cookie = "screen_colors=" + screen.colorDepth;
    document.cookie = "cookies_status=" + navigator.cookieEnabled;
    document.cookie = "java=" + navigator.javaEnabled;
    document.cookie = "browser_language=" + navigator.language;
</script>
<BODY>
<?php
$ipaddress = $_SERVER["REMOTE_ADDR"];
$link = mysqli_connect("sql304.byetcluster.com", "epiz_32739410", "aF5FWrM5hcy", "epiz_32739410_z2");
if (!$link) {
    echo "Błąd: " . mysqli_connect_errno() . " " . mysqli_connect_error();
}
mysqli_query($link, "SET NAMES 'utf8'");

$result = mysqli_query($link, "SELECT * FROM goscieportalu WHERE ipaddress='$ipaddress'");
$rekord = mysqli_fetch_array($result);
$browser = get_browser(null, true);
$screenResolution = $_COOKIE['screen_resolution'];
$browserResolution = $_COOKIE['browser_resolution'];
$screenColors = $_COOKIE['screen_colors'];
$cookiesStatus = $_COOKIE['cookies_status'];
$java = $_COOKIE['java'];
$browserLanguage = $_COOKIE['browser_language'];

mysqli_query($link, "INSERT INTO goscieportalu (ipaddress, screen_resolution, window_resolution, screen_colors, cookies_status, java, browser_language) VALUES ('$ipaddress', '$screenResolution', '$browserResolution', '$screenColors', '$cookiesStatus', '$java', '$browserLanguage')");
mysqli_close($link);


function ip_details($ip)
{
    $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
    $details = json_decode($json);
    return $details;
}

$details = ip_details($ipaddress);
$agent = $_SERVER['HTTP_USER_AGENT'];


$przegladarka = array('Internet Explorer' => 'MSIE', 'Mozilla Firefox' => 'Firefox', 'Opera' => 'Opera', 'Chrome' => 'Chrome', 'Edge' => 'Edge');
$system = array('Windows 2000' => 'NT 5.0', 'Windows XP' => 'NT 5.1', 'Windows Vista' => 'NT 6.0', 'Windows 7' => 'NT 6.1',
    'Windows 8' => 'NT 6.2', 'Windows 8.1' => 'NT 6.3', 'Windows 10' => 'NT 10', 'Linux' => 'Linux', 'iPhone' => 'iphone', 'Android' => 'android');

foreach ($system as $nazwa => $id)
    if (strpos($agent, $id)) $system = $nazwa;

foreach ($przegladarka as $nazwa => $id)
    if (strpos($agent, $id)) $przegladarka = $nazwa;

echo "<table border='1'>
<tr>
<th>Region</th>
<th>Country</th>
<th>City</th>
<th>Ioc</th>
<th>IP</th>
<th>Browser</th>
<th>System</th>
<th>Screen resolution</th>
<th>Browser resolution</th>
<th>Screen colors</th>
<th>Cookies status</th>
<th>Java applets status</th>
<th>Browser language</th>
</tr>";
echo "<tr>";
echo "<td>" . $details->region . "</td>";
echo "<td>" . $details->country . "</td>";
echo "<td>" . $details->city . "</td>";
echo "<td>" . $details->loc . "</td>";
echo "<td>" . $details->ip . "</td>";
echo "<td>" . $przegladarka . "</td>";
echo "<td>" . $system . "</td>";
echo '<td id="screen_resolution" />';
echo '<td id="window_resolution" />';
echo '<td id="screen_colors" />';
echo '<td id="cookies_status" />';
echo '<td id="java" />';
echo '<td id="browser_language">" />';
echo "</tr>";
echo "</table>";
echo "<a href='https://www.google.pl/maps/place/$details->loc'>LINK</a> ";
?>
</BODY>
<script>
    document.cookie = "screen_resolution=" + screen.width + "x" + screen.height;
    document.cookie = "browser_resolution=" + window.innerWidth + "x" + window.innerHeight;
    document.cookie = "screen_colors=" + screen.colorDepth;
    document.cookie = "cookies_status=" + navigator.cookieEnabled;
    document.cookie = "java=" + navigator.javaEnabled;
    document.cookie = "browser_language=" + navigator.language;
</script>
</HTML>