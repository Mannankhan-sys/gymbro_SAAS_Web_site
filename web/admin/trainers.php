<?php
session_start();
require_once "../config/db.php";
include "includes/header.php";
include "includes/sidebar.php";

$result = $mysqli->query(
"SELECT t.trainer_id, t.name, t.specialization, 
COUNT(u.user_id) AS assigned_users
FROM trainers t
LEFT JOIN users u 
ON u.assigned_trainer = t.trainer_id
GROUP BY t.trainer_id"
);
?>

<h2>Trainer Availability</h2>
<table>
<tr>
<th>Name</th><th>Specialization</th><th>Assigned</th><th>Status</th>
</tr>

<?php while ($row = $result->fetch_assoc()): ?>
<tr>
<td><?= $row['name'] ?></td>
<td><?= $row['specialization'] ?></td>
<td><?= $row['assigned_users'] ?>/10</td>
<td><?= ($row['assigned_users'] < 10) ? "Available" : "Full" ?></td>
</tr>
<?php endwhile; ?>
</table>
</body>
</html>