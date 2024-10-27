<html>

<head>
<style>
        /* Gaya Umum */
        body {
            font-family: monospace;
            background-color: #f0f2f5;
            font-weight: bold;
            color:#250065;
            text-align: center;
        }

        /* Gaya Tabel */
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            font-size: 14px;
            font-weight: bold;
            background-color: #bddcff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #03000d;
        }

        th {
            background-color: #2a0f96;
            color: white;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #9fbbfc;
        }

        /* Gaya Teks Sukses dan Gagal */
        .message {
            margin: 8px auto;
            width: 80%;
            padding: 10px;
            color: white;
            border-radius: 5px;
        }
        /* Gaya Tombol Hapus */
        a {
            color: #ff004c;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>

<body>

    <?php
    // Sesuaikan dengan setting MySQL
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "pgweb8";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['hapus'])) {
        $id_hapus = $_GET['hapus'];
        $sql_hapus = "DELETE FROM pgweb_7b WHERE id = $id_hapus";
        if ($conn->query($sql_hapus) === TRUE) {
            echo "Data dengan ID $id_hapus berhasil dihapus.";
        } else {
            echo "Error: " . $conn->error;
        }
    }


    $sql = "SELECT * FROM pgweb_7b";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1px'><tr>
<th>id</th>
<th>kecamatan</th>
<th>longitude</th>
<th>latitude</th>
<th>luas</th>
<th>jumlah_penduduk</th>
<th>aksi</th>";


        // output data of each row
        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["id"] . "</td><td>" . $row["kecamatan"] . "</td><td>" . $row["longitude"] . "</td><td>" . $row["latitude"] . "</td><td>" . $row["luas"] . "</td><td>" . $row["jumlah_penduduk"] . "</td><td align='right'>" . "<a href='?hapus=" . $row["id"] . "' onclick='return confirm(\"Yakin ingin menghapus data ini?\")'>Hapus</a>" . "</td></tr>";
        }
        echo "</table>";
    } else {
        echo "0 results";
    }
    $conn->close();
    ?>


</body>

</html>