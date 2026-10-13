<?php

include "db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);
    $phone = trim($_POST['phone']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    if ($name == "" || $phone == "") {
        die("Name and Phone are required.");
    }

    $stmt = mysqli_prepare(
        $conn,
        "INSERT INTO contacts (name, phone, email, address)
         VALUES (?, ?, ?, ?)"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "ssss",
        $name,
        $phone,
        $email,
        $address
    );

    if (mysqli_stmt_execute($stmt)) {

        header("Location: index.php");

        exit();

    } else {

        echo "Error: " . mysqli_error($conn);

    }

    mysqli_stmt_close($stmt);
}

?>