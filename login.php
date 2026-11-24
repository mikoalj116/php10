<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST["login"];
    $haslo = $_POST["haslo"];

    if ($login == "admin" && $haslo == "1234") {
        $_SESSION["login"] = $login;
        header("Location: wyniki.php");
        exit();
    } else {
        $komunikat = "Błędny login lub hasło";
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zaloguj się</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Portal laboratorium</h1>
</header>

<main class="logowanie">
    <h2>Zaloguj sie do systemu</h2>

    <form action="login.php" method="post">
    <label for="login">Login:</label>
    <input type="text" id="login" name="login">

    <label for="haslo">Hasło:</label>
    <input type="password" id="haslo" name="haslo">

    <input type="submit" value="Zaloguj">
</form>

    <?php
    session_start();

    if (isset($_POST['login']) && isset($_POST['haslo'])) {

    $login = $_POST['login'];
    $haslo = $_POST['haslo'];

    if ($login == "admin" && $haslo == "TajneHaslo321*") {
        $_SESSION['uzytkownik'] = $login;

        header("Location: wyniki.php");
        exit();
    }
    }
    ?>
</main>

<footer>
    <p>Wykonal: Tom Pearl</p>
</footer>

</body>
</html>