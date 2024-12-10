<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PHP CRUD Form</title>
    <script>
        function validateForm() {
            var name = document.forms["userForm"]["name"].value;
            var email = document.forms["userForm"]["email"].value;
            var age = document.forms["userForm"]["age"].value;
            var emailPattern = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
            
            if (name == "" || email == "" || age == "") {
                alert("All fields must be filled out");
                return false;
            }
            if (!email.match(emailPattern)) {
                alert("Please enter a valid email");
                return false;
            }
            if (isNaN(age) || age < 1) {
                alert("Please enter a valid age");
                return false;
            }
            return true;
        }
    </script>
</head>
<body>

<h2>User Form</h2>
<form name="userForm" action="crud_form.php" method="POST" onsubmit="return validateForm();">
    <label for="name">Name:</label>
    <input type="text" id="name" name="name"><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email"><br><br>

    <label for="age">Age:</label>
    <input type="number" id="age" name="age"><br><br>

    <button type="submit" name="action" value="insert">Insert</button>
    <button type="submit" name="action" value="update">Update</button>
    <button type="submit" name="action" value="delete">Delete</button>
    <button type="submit" name="action" value="select">Select</button>
</form>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "user_management";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
$action = isset($_POST['action']) ? $_POST['action'] : '';

// Handle each action
switch ($action) {
    case 'insert':
        if ($name && $email && $age) {
            $stmt = $conn->prepare("INSERT INTO users (name, email, age) VALUES (?, ?, ?)");
            $stmt->bind_param("ssi", $name, $email, $age);
            $stmt->execute();
            echo "<p>Record inserted successfully</p>";
            $stmt->close();
        } else {
            echo "<p>All fields are required for insert.</p>";
        }
        break;

    case 'update':
        if ($name && $email && $age) {
            $stmt = $conn->prepare("UPDATE users SET age = ? WHERE name = ? AND email = ?");
            $stmt->bind_param("iss", $age, $name, $email);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<p>Record updated successfully</p>";
            } else {
                echo "<p>No matching record found to update.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>All fields are required for update.</p>";
        }
        break;

    case 'delete':
        if ($email) {
            $stmt = $conn->prepare("DELETE FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            if ($stmt->affected_rows > 0) {
                echo "<p>Record deleted successfully</p>";
            } else {
                echo "<p>No matching record found to delete.</p>";
            }
            $stmt->close();
        } else {
            echo "<p>Email is required for delete.</p>";
        }
        break;

    case 'select':
        $sql = "SELECT id, name, email, age FROM users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "<h3>User Records</h3>";
            while ($row = $result->fetch_assoc()) {
                echo "ID: " . $row["id"] . " - Name: " . $row["name"] . " - Email: " . $row["email"] . " - Age: " . $row["age"] . "<br>";
            }
        } else {
            echo "<p>No records found</p>";
        }
        break;

    default:
        // Do nothing if action is empty or not specified
        break;
}

$conn->close();
?>

</body>
</html>

