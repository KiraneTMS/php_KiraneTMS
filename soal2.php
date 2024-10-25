<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        $_SESSION['name'] = $_POST['name'];
    } elseif (isset($_POST['age'])) {
        $_SESSION['age'] = $_POST['age'];
    } elseif (isset($_POST['hobby'])) {
        $_SESSION['hobby'] = $_POST['hobby'];
    }
}

$step = isset($_SESSION['hobby']) ? 4 : (isset($_SESSION['age']) ? 3 : (isset($_SESSION['name']) ? 2 : 1));
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Multi-Step Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        h2 {
            color: #333;
        }

        form {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 22px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #5cb85c;
            color: white;
            border: none;
            padding: 10px 15px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #4cae4c;
        }

        a {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<?php if ($step == 1): ?>
    <h2>Step 1: Input Your Name</h2>
    <form action="" method="POST">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" value="Submit">
    </form>

<?php elseif ($step == 2): ?>
    <h2>Step 2: Input Your Age</h2>
    <form action="" method="POST">
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        <input type="submit" value="Submit">
    </form>

<?php elseif ($step == 3): ?>
    <h2>Step 3: Input Your Hobby</h2>
    <form action="" method="POST">
        <label for="hobby">Hobby:</label>
        <input type="text" id="hobby" name="hobby" required>
        <input type="submit" value="Submit">
    </form>

<?php elseif ($step == 4): ?>
    <h2>Results</h2>
    <p>Name: <?php echo htmlspecialchars($_SESSION['name']); ?></p>
    <p>Age: <?php echo htmlspecialchars($_SESSION['age']); ?></p>
    <p>Hobby: <?php echo htmlspecialchars($_SESSION['hobby']); ?></p>
    <a href="?reset=1">Start Over</a>

    <?php
    if (isset($_GET['reset'])) {
        session_unset();
        session_destroy();
        header("Location: soal2.php");
        exit();
    }
    ?>
<?php endif; ?>

</body>
</html>
