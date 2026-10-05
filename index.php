<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Moje pliki</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="container">

    <h2>Aktualny katalog:</h2>
    <p><?php echo getcwd(); ?></p>

    <?php

    $katalog = "dokumenty";

    if (!file_exists($katalog . "/materialy")) {
        mkdir($katalog . "/materialy");
    }

    $pliki = scandir($katalog);

    ?>

    <h2>ZAWARTOŚĆ KATALOGU</h2>

    <table>
        <tr>
            <th>Nazwa</th>
            <th>Typ</th>
        </tr>

        <?php
        foreach ($pliki as $plik) {

            if ($plik != "." && $plik != "..") {

                $sciezka = $katalog . "/" . $plik;

                if (is_file($sciezka)) {
                    $typ = "PLIK";
                } elseif (is_dir($sciezka)) {
                    $typ = "KATALOG";
                } else {
                    $typ = "INNY";
                }

                echo "<tr>";
                echo "<td>$plik</td>";
                echo "<td>$typ</td>";
                echo "</tr>";
            }
        }
        ?>
    </table>

    <h2>Utwórz nowy katalog</h2>

    <form method="post">
        <input type="text" name="nowy_katalog" placeholder="Nazwa katalogu" required>
        <button type="submit">Utwórz</button>
    </form>

    <?php

    if (isset($_POST["nowy_katalog"])) {

        $nowy = $katalog . "/" . $_POST["nowy_katalog"];

        if (!file_exists($nowy)) {
            mkdir($nowy);
            echo "<p class='success'>Katalog został utworzony.</p>";
        } else {
            echo "<p class='error'>Taki katalog już istnieje.</p>";
        }
    }

    ?>

</div>

</body>
</html>