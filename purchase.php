<?php 
include 'header.php'; 
include 'db.php';

$table = $_GET['table'] ?? '';

if($table == ''){
    die("No table selected");
}

/* INSERT DATA */
if(isset($_POST['save'])){
    $name = $_POST['name'];
    $weight = $_POST['weight'];
    $rate = $_POST['rate'];
    $total = $weight * $rate;
    $date = date("Y-m-d");

    $conn->query("INSERT INTO `$table` 
    (farmer_name, weight, rate, total, created_at)
    VALUES ('$name','$weight','$rate','$total','$date')");
}

/* FETCH DATA */
$res = $conn->query("SELECT * FROM `$table` ORDER BY id DESC");
?>

<h3>📁 <?= $table ?></h3>

<!-- ADD ENTRY -->
<form method="POST">
<input name="name" placeholder="Farmer Name" required>
<input name="weight" placeholder="Weight" required>
<input name="rate" placeholder="Rate" required>
<button name="save">➕ Add Entry</button>
</form>

<!-- TABLE VIEW -->
<div style="overflow-x:auto;">
<table>
<tr>
<th>Name</th>
<th>Weight</th>
<th>Rate</th>
<th>Total</th>
<th>Date</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
if($res->num_rows == 0){
    echo "<tr><td colspan='7'>No data found</td></tr>";
}

while($row = $res->fetch_assoc()){
$statusColor = ($row['paid_status']=="Paid") ? "green" : "red";

echo "<tr>
<td>{$row['farmer_name']}</td>
<td>{$row['weight']}</td>
<td>{$row['rate']}</td>
<td>{$row['total']}</td>
<td>{$row['created_at']}</td>

<td style='color:$statusColor'>
{$row['paid_status']}
</td>

<td>
<a href='update_status.php?id={$row['id']}&table=$table'>🔄</a>
<a href='update_delete.php?id={$row['id']}&table=$table'>✏️</a>
</td>
</tr>";
}
?>
</table>
</div>

<br>
<a href="dashboard.php">⬅ Back</a>

<?php include 'footer.php'; ?>
