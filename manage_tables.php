<?php 
include 'header.php'; 
include 'db.php';

$message = "";

/* CREATE TABLE */
if(isset($_POST['create'])){

    // sanitize input
    $raw = $_POST['name'];
    $name = "purchase_" . preg_replace("/[^a-zA-Z0-9_]/","", $raw);

    $sql = "CREATE TABLE `$name` (
        id INT AUTO_INCREMENT PRIMARY KEY,
        farmer_name VARCHAR(100),
        weight DECIMAL(10,2),
        rate DECIMAL(10,2),
        total DECIMAL(10,2),
        paid_status ENUM('Paid','Not Paid') DEFAULT 'Not Paid',
        created_at DATE
    )";

    if($conn->query($sql)){
        $message = "✅ Table Created: $name";
    }else{
        $message = "❌ Error: " . $conn->error;
    }
}
?>

<h2>➕ Create New Table</h2>

<!-- MESSAGE -->
<?php if($message != ""){ ?>
<div style="background:#fff;padding:10px;border-radius:8px;margin:10px 0;">
    <?= $message ?>
</div>
<?php } ?>

<!-- FORM -->
<form method="POST">
<input name="name" placeholder="Enter name (example: 20260503)" required>
<button name="create">Create Table</button>
</form>

<!-- BACK BUTTON -->
<br><br>
<a href="dashboard.php" 
style="display:block;text-align:center;background:#2d89ef;color:white;padding:12px;border-radius:10px;text-decoration:none;">
⬅ Back to Dashboard
</a>

<?php include 'footer.php'; ?>
