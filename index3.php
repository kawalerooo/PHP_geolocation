<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<script>
    document.cookie = "screen_resolution=" + screen.width + "x" + screen.height;
    document.cookie = "browser_resolution=" + window.innerWidth + "x" + window.innerHeight;
    document.cookie = "screen_colors=" + screen.colorDepth;
    document.cookie = "cookies_status=" + navigator.cookieEnabled;
    document.cookie = "java=" + navigator.javaEnabled;
    document.cookie = "browser_language=" + navigator.language;
</script>
<BODY>
Formularz logowania
<form method="post" action="weryfikuj3.php">
    Login:<input type="text" name="user" maxlength="20" size="20"><br>
    Hasło:<input type="password" name="pass" maxlength="20" size="20"><br>
    <input type="submit" value="Send"/>
</form>
</BODY>
</HTML>