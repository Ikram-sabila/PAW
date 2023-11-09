<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gambar</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <section class="awal" id="awal">
        <div class="container">
            <div class="judul">
                <h3 class="Hawal">Welcome to Brawivent</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis eligendi esse a autem ipsum aut nisi, aperiam officia ab natus, magnam deserunt repudiandae?</p>
                <button class="button">Know More</button>
            </div>
        </div>
    </section>
    <section>
        <div class="gallery">
            <?php
            // Menghubungkan ke basis data
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "paw";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            // Mengambil data gambar dan judul dari tabel 'lomba'
            $sql = "SELECT gambar, judul FROM lomba";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Menampilkan data dalam elemen HTML
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="image-container">';
                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row["gambar"]) . '" alt="' . $row["judul"] . '">';
                    echo '<p>' . $row["judul"] . '</p>';
                    echo '</div>';
                }
            } else {
                echo "0 results";
            }
            $conn->close();
            ?>
        </div>
    </section>
</body>
</html>
