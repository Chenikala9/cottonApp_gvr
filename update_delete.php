<?php include 'header.php'; include 'db.php';

$id=$_GET['id'];
$table=$_GET['table'];

if(isset($_POST['update'])){
    $n=$_POST['name'];
    $w=$_POST['weight'];
    $r=$_POST['rate'];
    $t=$w*$r;

    $conn->query("UPDATE `$table` SET 
        farmer_name='$n',
        weight='$w',
        rate='$r',
        total='$t'
        WHERE id=$id");

    header("Location: purchase.php?table=$table");
}

if(isset($_GET['delete'])){
    $conn->query("DELETE FROM `$table` WHERE id=$id");
    header("Location: purchase.php?table=$table");
}

$row=$conn->query("SELECT * FROM `$table` WHERE id=$id")->fetch_assoc();
?>

<h2>Edit Record</h2>

<form method="POST">
<input name="name" value="<?= $row['farmer_name'] ?>">
<input name="weight" value="<?= $row['weight'] ?>">
<input name="rate" value="<?= $row['rate'] ?>">
<button name="update">Update</button>
</form>

<a href="?id=<?=$id?>&table=<?=$table?>&delete=1">❌ Delete</a>

<?php include 'footer.php'; ?>
