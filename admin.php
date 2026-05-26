<?php
include 'php/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Admin Panel - AAU Clubs</title>
  <link rel="stylesheet" href="style.css">

  <style>
    body {
      font-family: Arial;
      background: #f4f4f4;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
      background: white;
    }

    th, td {
      padding: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }

    th {
      background: #222;
      color: white;
    }

    tr:nth-child(even) {
      background: #f9f9f9;
    }
  </style>
</head>

<body>

<h1>AAU Clubs - Admin Dashboard</h1>

<table>
  <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Club</th>
    <th>Role</th>
    <th>Created At</th>
  </tr>

<?php
$sql = "SELECT * FROM users ORDER BY id DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['full_name']}</td>
            <td>{$row['email']}</td>
            <td>{$row['club']}</td>
            <td>{$row['role']}</td>
            <td>{$row['created_at']}</td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='6'>No users found</td></tr>";
}
?>

</table>

</body>
</html>