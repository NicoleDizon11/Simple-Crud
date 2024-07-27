<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_manager";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    
    $sql = "UPDATE contacts SET name='$name', email='$email', phone='$phone' WHERE id=$id";
    
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    $id = $_GET["id"];
    $sql = "SELECT * FROM contacts WHERE id=$id";
    $result = $conn->query($sql);
    $contact = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Edit Contact</title>
</head>
<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1>Contact Manager</h1>
            </div>
            <nav>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="create.php">Add Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>
    
    <div class="container">
        <h2>Edit Contact</h2>
        <form method="POST" action="update.php">
            <input type="hidden" name="id" value="<?php echo $contact['id']; ?>">
            <input type="text" name="name" value="<?php echo $contact['name']; ?>" required>
            <input type="email" name="email" value="<?php echo $contact['email']; ?>" required>
            <input type="tel" name="phone" value="<?php echo $contact['phone']; ?>" required>
            <input type="submit" value="Update Contact">
        </form>
    </div>
</body>
</html>
