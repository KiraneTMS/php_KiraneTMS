<?php
$conn = new mysqli("localhost", "root", "", "testdb");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$searchName = '';
$searchAddress = '';
$searchHobby = '';

if (isset($_POST['search'])) {
    $searchName = $conn->real_escape_string($_POST['searchName']);
    $searchAddress = $conn->real_escape_string($_POST['searchAddress']);
    $searchHobby = $conn->real_escape_string($_POST['searchHobby']);
}

$sql = "SELECT p.id, p.nama, p.alamat, GROUP_CONCAT(h.hobi SEPARATOR ', ') AS hobi
        FROM person p
        LEFT JOIN hobi h ON p.id = h.person_id
        WHERE p.nama LIKE '%$searchName%' 
        AND p.alamat LIKE '%$searchAddress%' 
        AND (h.hobi LIKE '%$searchHobby%' OR h.hobi IS NULL)
        GROUP BY p.id";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Person dan Hobi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: #333;
        }
        button {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #4cae4c;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
            border-radius: 8px;
            overflow: hidden;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
            color: #333;
            border-bottom: 1px solid rgba(0, 0, 0, 1);
        }
        tr:hover {
            background-color: #f5f5f5;
        }
        .modal {
            display: none; 
            position: fixed; 
            z-index: 1; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgb(0,0,0);
            background-color: rgba(0,0,0,0.4); 
            padding-top: 60px;
        }
        .modal-content {
            background-color: #fefefe;
            margin: 5% auto; 
            padding: 20px;
            border: 1px solid #888;
            width: 80%; 
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Daftar Person dan Hobi</h1>

    <button id="searchBtn">SEARCH</button>

    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Pencarian</h2>
            <form method="POST" action="">
                <input type="text" id="searchName" name="searchName" placeholder="Cari Nama" value="<?php echo $searchName; ?>">
                <input type="text" id="searchAddress" name="searchAddress" placeholder="Cari Alamat" value="<?php echo $searchAddress; ?>">
                <input type="text" id="searchHobby" name="searchHobby" placeholder="Cari Hobi" value="<?php echo $searchHobby; ?>">
                <button type="submit" name="search">SUBMIT</button>
            </form>
        </div>
    </div>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Hobi</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nama']}</td>
                        <td>{$row['alamat']}</td>
                        <td>{$row['hobi']}</td>
                      </tr>";
            }
        } else {
            echo "<tr><td colspan='4'>Tidak ada data ditemukan</td></tr>";
        }
        ?>
    </table>

    <?php $conn->close(); ?>

    <script>
        var modal = document.getElementById("myModal");
        var btn = document.getElementById("searchBtn");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function() {
            document.getElementById("searchName").value = "";
            document.getElementById("searchAddress").value = "";
            document.getElementById("searchHobby").value = "";
            modal.style.display = "block";
        }

        span.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
