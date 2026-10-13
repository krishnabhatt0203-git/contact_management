<?php

include "db.php";

$result = mysqli_query($conn, "SELECT * FROM contacts ORDER BY id DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Contact Management System</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<div class="container">

    <h1>Contact Management System</h1>

    <div class="form-box">

        <h2>Add New Contact</h2>

        <form action="add.php" method="POST" onsubmit="return validateForm()">

            <label>Name</label>
            <input type="text" id="name" name="name"
                   placeholder="Enter your name">

            <label>Phone</label>
            <input type="text" id="phone" name="phone"
                   placeholder="Enter phone number">

            <label>Email</label>
            <input type="email" id="email" name="email"
                   placeholder="Enter email">

            <label>Address</label>
            <textarea id="address" name="address"
                      placeholder="Enter address"></textarea>

            <button type="submit">Add Contact</button>

        </form>

    </div>


    <div class="table-box">

        <h2>Contact List</h2>

        <table>

            <thead>

                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Action</th>
                </tr>

            </thead>

            <tbody>

            <?php

            if (mysqli_num_rows($result) > 0) {

                while ($row = mysqli_fetch_assoc($result)) {

            ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>

                    <td><?php echo htmlspecialchars($row['name']); ?></td>

                    <td><?php echo htmlspecialchars($row['phone']); ?></td>

                    <td><?php echo htmlspecialchars($row['email']); ?></td>

                    <td><?php echo htmlspecialchars($row['address']); ?></td>

                    <td>

                        <a class="edit-btn"
                           href="edit.php?id=<?php echo $row['id']; ?>">
                           Edit
                        </a>

                        <a class="delete-btn"
                           href="delete.php?id=<?php echo $row['id']; ?>"
                           onclick="return confirmDelete();">
                           Delete
                        </a>

                    </td>

                </tr>

            <?php

                }

            } else {

            ?>

                <tr>

                    <td colspan="6">
                        No contacts found.
                    </td>

                </tr>

            <?php

            }

            ?>

            </tbody>

        </table>

    </div>

</div>

<script src="script.js"></script>

</body>
</html>
