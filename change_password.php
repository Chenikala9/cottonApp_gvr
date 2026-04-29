<?php 
include 'header.php'; 
include 'db.php';

if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit;
}

$msg = "";

if(isset($_POST['change'])){
    $old = $_POST['old_password'];
    $new = $_POST['new_password'];

    // check old password
    $res = $conn->query("SELECT * FROM admin WHERE username='{$_SESSION['admin']}' AND password='$old'");

    if($res->num_rows){
        // update new password
        $conn->query("UPDATE admin SET password='$new' WHERE username='{$_SESSION['admin']}'");
        $msg = "✅ Password Updated Successfully";
    }else{
        $msg = "❌ Old Password Wrong";
    }
}
?>

<h2>🔐 Change Password</h2>

<?php if($msg!=""){ ?>
<div style="background:#fff;padding:10px;border-radius:8px;margin:10px 0;">
<?= $msg ?>
</div>
<?php } ?>

<form method="POST">
<input type="password" name="old_password" placeholder="Old Password" required>
<input type="password" name="new_password" placeholder="New Password" required>
<button name="change">Update Password</button>
</form>

<br><br>
<a href="dashboard.php" 
style="display:block;text-align:center;background:#2d89ef;color:white;padding:12px;border-radius:10px;text-decoration:none;">
⬅ Back to Dashboard
</a>

<?php include 'footer.php'; ?>
