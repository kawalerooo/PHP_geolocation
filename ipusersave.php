<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<HEAD>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</HEAD>
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

if (!$rekord) {
    mysqli_query($link, "INSERT INTO goscieportalu (ipaddress) VALUES ('$ipaddress')");
    mysqli_close($link);

}

function ip_details($ip)
{
    $json = file_get_contents("http://ipinfo.io/{$ip}/geo");
    $details = json_decode($json);
    return $details;
}

$details = ip_details($ipaddress);

echo "<table border='1'>
<tr>
<th>region</th>
<th>country</th>
<th>city</th>
<th>ioc</th>
<th>ip</th>
</tr>";
echo "<tr>";
echo "<td>" . $details->region . "</td>";
echo "<td>" . $details->country . "</td>";
echo "<td>" . $details->city . "</td>";
echo "<td>" . $details->loc . "</td>";
echo "<td>" . $details->ip . "</td>";
echo "</tr>";
echo "</table>";
echo "<a href='https://www.google.pl/maps/place/$details->loc'>LINK</a> ";
?>
</BODY>
</HTML>