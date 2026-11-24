<?php
session_start();

if (!isset($_SESSION["login"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Przeglądaj wyniki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<header>
    <h1>Portal laboratorium</h1>

    <p>
        Witaj, <strong><?php echo $_SESSION['uzytkownik']; ?></strong>
    </p>

    <p><a href="wyloguj.php">Wyloguj</a></p>
</header>

<main>
    <h2>Wyniki pacjentów</h2>

    <div class="tabela">
        <table>
            <tr>
                <th>Imię pacjenta</th>
                <th>Nazwisko pacjenta</th>
                <th>PESEL</th>
                <th>Data zlecenia</th>
                <th>Data wykonania</th>
                <th>Wynik</th>
            </tr>

    <?php
    $polaczenie = mysqli_connect("localhost", "root", "", "laboratorium");

    $zapytanie = " SELECT 
    Pacjent.imie,
    Pacjent.nazwisko,
    Pacjent.pesel,
    Zlecenie.data AS data_zlecenia,
    Wynik.data AS data_wykonania,
    Wynik.plik
FROM Pacjent
JOIN Zlecenie ON Pacjent.id = Zlecenie.idPacjent
LEFT JOIN Wynik ON Zlecenie.id = Wynik.idZlecenie";

    $wynik = mysqli_query($polaczenie, $zapytanie);

    while ($wiersz = mysqli_fetch_array($wynik)) {
    echo "<tr>";

echo "<td>" . $wiersz['imie'] . "</td>";
echo "<td>" . $wiersz['nazwisko'] . "</td>";
echo "<td>" . $wiersz['pesel'] . "</td>";
echo "<td>" . $wiersz['data_zlecenia'] . "</td>";
echo "<td>" . $wiersz['data_wykonania'] . "</td>";

echo "<td>";
if (!empty($wiersz['plik'])) {
    echo "<a href='" . htmlspecialchars($wiersz['plik']) .
         "' target='_blank'>wynik</a>";
}
echo "</td>";

    echo "</tr>";
    }

    mysqli_close($polaczenie);
    ?>
            
        </table>
    </div>
</main>

<footer>
    <p>Wykonal: Tom Pearl</p>
</footer>

</body>
</html>