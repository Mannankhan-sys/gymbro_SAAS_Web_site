<?php
session_start();
require_once "../config/db.php";
include "includes/header.php";
include "includes/sidebar.php";

$result = $mysqli->query(
"SELECT u.user_id, u.username, u.email, s.plan_name 
 FROM users u 
 LEFT JOIN subscriptions s 
 ON u.subscription_id = s.subscription_id"
);
?>

<h2>Manage Users</h2>
<table>
<tr>
<th>ID</th><th>Name</th><th>Email</th><th>Plan</th><th>Action</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['user_id'] ?></td>
<td><?= $row['username'] ?></td>
<td><?= $row['email'] ?></td>
<td><?= $row['plan_name'] ?></td>
<td>
<a href="delete_user.php?id=<?= $row['user_id'] ?>">Delete</a>
</td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>