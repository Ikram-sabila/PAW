<?php require
    "koneksiMVC.php";?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Gambar</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .container {
            max-width: 1200px;
            padding: 0 60px;
        }

        .awal {
            background-image: url("https://images.unsplash.com/photo-1558174685-430919a96c8d?q=80&w=1471&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D");
            background-size: cover;
            min-height: 100vh;
        }

        .judul {
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .Hawal {
            font-size: 24px;
            margin-bottom: 10px;
        }

        .button {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* CSS untuk Image Container */
        .image-container {
            position: relative;
            overflow: hidden;
            width: 300px;
            height: 300px;
            margin: 10px;
            /* Tambahkan margin jika diinginkan */
            float: left;
            /* Agar gambar berada dalam satu baris */
            background-color: #B4BDFF;
            display: flex;
            flex-direction: column;
            /* Membuat container menjadi flex column */
            justify-content: center;
            align-items: center;

        }

        /* CSS untuk Gambar di dalam Kontainer */
        .image-container img {
            width: 90%;
            height: 100%;
            object-fit: cover;
            display: block;
            margin: auto;
            /* Menengahkan gambar di dalam flex container */
            padding-top: 20px;
            padding-bottom: 10px;
            border-radius: 10%;
        }

        /* Gaya tambahan untuk tata letak dan desain lainnya */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
            padding: 20px;
        }

        .judul {
            text-align: center;
        }

        .gallery {
            margin-top: 20px;
            text-align: center;
        }

        .pa {
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <section class="awal" id="awal">
        <div class="container">
            <div class="judul">
                <h3 class="Hawal">Welcome to Brawivent</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Reiciendis eligendi esse a autem ipsum aut
                    nisi, aperiam officia ab natus, magnam deserunt repudiandae?</p>
                <button class="button">Know More</button>
            </div>
        </div>
    </section>
    <section>
        <div class="gallery">
            <?php

            // Mengambil data gambar dan judul dari tabel 'lomba'
            $sql = "SELECT gambar, judul FROM lomba";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="image-container">';
                    echo '<img src="' . $row["gambar"] . '" alt="' . $row["judul"] . '">';
                    echo '<p class="pa">' . $row["judul"] . '</p>';
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