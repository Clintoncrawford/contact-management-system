<?php
include 'db.php';
$pageTitle = "Submissions";
include 'header.php'; // Include the header
?>

<!DOCTYPE html>
<html>

<head>
    <title>Admin - Submissions</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        $sql = "SELECT name, email, message, date_submitted FROM contacts ORDER BY date_submitted DESC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='submissions-table-container'>";
            echo "<table class='submissions-table'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Message</th>";
            echo "<th>Date</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                echo "<td>" . nl2br(htmlspecialchars($row["message"])) . "</td>";
                echo "<td>" . date("Y-m-d H:i:s", strtotime($row["date_submitted"])) . "</td>";
                echo "</tr>";
            }
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='no-submission'><p>No submissions found.</p></div>";
        }

        $conn->close();
        ?>

        <div class="back-link">
            <a href="index.php">View Contact Form</a>
        </div>
    </div>
</body>

</html>