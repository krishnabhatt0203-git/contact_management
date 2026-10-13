<?php

include "db.php";

if (!isset($_GET['id'])) {

    header("Location: index.php");
    exit();

}

$id = intval($_GET['id']);

$result = mysqli_query(
    $conn,
    "SELECT * FROM contacts WHERE id = $id"
);

if (mysqli_num_rows($result) == 0) {

    die("Contact not found.");

}

$contact = mysqli_fetch_assoc($result);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    if ($name == "" || $phone == "") {

        $error = "Name and Phone are required.";

    } else {

        $stmt = mysqli_prepare(
            $conn,
            "UPDATE contacts
             SET name = ?, phone = ?, email = ?, address = ?
             WHERE id = ?"
        );

        mysqli_stmt_bind_param(
            $stmt,
            "ssssi",
            $name,
            $phone,
            $email,
            $address,
            $id
        );

        if (mysqli_stmt_execute($stmt)) {

            header("Location: index.php");

            exit();

        } else {

            $error = "Error updating contact.";

        }

        mysqli_stmt_close($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Contact</title>

    <link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

    <div class="form-box">

        <h1>Edit Contact</h1>

        <?php

        if (isset($error)) {

            echo "<p class='error'>$error</p>";

        }

        ?>

        <form method="POST">

            <label>Name</label>

            <input type="text"
                   name="name"
                   value="<?php echo htmlspecialchars($contact['name']); ?>"
                   required>


            <label>Phone</label>

            <input type="text"
                   name="phone"
                   value="<?php echo htmlspecialchars($contact['phone']); ?>"
                   required>


            <label>Email</label>

            <input type="email"
                   name="email"
                   value="<?php echo htmlspecialchars($contact['email']); ?>">


            <label>Address</label>

            <textarea name="address"><?php echo htmlspecialchars($contact['address']); ?></textarea>


            <button type="submit">
                Update Contact
            </button>

        </form>

        <a class="back-btn" href="index.php">
            ← Back to Contacts
        </a>

    </div>

</div>

</body>
</html>