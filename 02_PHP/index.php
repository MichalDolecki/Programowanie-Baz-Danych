<!DOCTYPE html>
<!--
  Wprowadzenie do PHP. Podstawowe operacje.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Wprowadzenie</title>
    </head>
    <body>
        <?php
        // <h1>Hello World!!!</h1>
        echo '<h1>Hello World!!!</h1>';
        $liczba;
        $n = 50;
        $wynik = $n * 2;
        echo $wynik;
        // echo $liczba;
        $wynik = $wynik + 100;
        echo '<br>';
        echo $wynik;
        $wynik += 100;
        $wynik /= 3;
        echo '<br>' . $wynik;
        echo "<br>$wynik";
        echo '<br>$wynik';
        $liczba = 7 / 2;
        echo '<br>' . $liczba;
        $liczba = floor($liczba);
        echo '<br>' . $liczba;
        echo '<br>' . date('Y-m-d');

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "kinomaniak";
        $port = "3307";

        $conn = mysqli_connect(
                $servername, 
                $username, 
                $password, 
                $database, 
                $port
                );

        if (!$conn) {
            die("<p>Nie udało się połączyć z bazą danych!!!"
                    . mysqli_connect_error()."</p>");
        }
        echo "<p>Udało się połączyć z bazą danych!!!</p>";
        
        $sql = "select * from film";
        $result = mysqli_query($conn, $sql);  
        $liczbawierszy = mysqli_num_rows($result);
        if($liczbawierszy == 0){
            echo '<p>Brak danych do wyświetlenia.</p>';
        }else{
            echo "<p>Liczba pobranych wierszy: $liczbawierszy</p>";
            while ($row = mysqli_fetch_assoc($result)){
                echo '<p>Tytuł: ';
                echo $row['tytul_oryginalny'];
                echo '<br>';
                echo 'Rok produkcji: ';
                echo $row['rok_produkcji'];
                echo '<br>';
                echo 'Czas trwania: ';
                echo $row['czas_trwania'];
                echo ' min.</p>';
            }
        } 
        // osoby z BD w akapitach postaci imię nazwisko
        $sql = "SELECT concat(imie,' ',nazwisko) as osoba FROM kinomaniak.osoba";
        $result = mysqli_query($conn, $sql);  
        while ($row = mysqli_fetch_assoc($result)){
                echo '<p>';
                echo $row['osoba'];
                echo '</p>';
        }
        // filmy w tabeli
        ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Lp.</th>
                    <th>Tytuł filmu</th>
                    <th>Rok produkcji</th>
                    <th>Czas trwania [min]</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = 'select * from film';
                $result = mysqli_query($conn, $sql); 
                $numer = 1;
                while ($row = mysqli_fetch_assoc($result)){
                    echo '<tr>';
                    echo '<td>';
                    echo $numer;
                    $numer++;
                    echo '</td>';
                    echo '<td>';
                    echo $row['tytul_oryginalny'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['rok_produkcji'];
                    echo '</td>';
                    echo '<td>';
                    echo $row['czas_trwania'];
                    echo '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>

<!--
    Umieścić w tabelce nazwiska i imiona osób oraz użytkowników posortowane
    alfabetycznie wg nazwisk. Nagłówek tabeli: Lp. | Nazwisko | Imię
-->        
        <?php
        mysqli_close($conn);
        ?>
    </body>
</html>
