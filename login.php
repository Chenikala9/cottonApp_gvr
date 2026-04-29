<?php include 'header.php'; include 'db.php'; ?>

<h2>Login</h2>

<form method="POST">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button name="login">Login</button>
</form>

<?php
if(isset($_POST['login'])){
    $u=$_POST['username'];
    $p=$_POST['password'];

    $r=$conn->query("SELECT * FROM admin WHERE username='$u' AND password='$p'");

    if($r->num_rows){
        $_SESSION['admin']=$u;
        header("Location: dashboard.php");
    }else{
        echo "<div class='card'>❌ Invalid Login</div>";
    }
}
?>

<?php include 'footer.php'; ?>
