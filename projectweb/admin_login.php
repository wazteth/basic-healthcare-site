<?php
session_start();
$pageTitle = "Admin Login";
include('dbconnect.php');
include('nav.php');
if(isset($_SESSION['adminname'])){
    header('location:admin_dashboard.php?already');
}
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = 'Invalid form submission';
    } else {
        try {
            $sql = "SELECT * FROM admins WHERE username='$username' AND password='$password'";
            $result = mysqli_query($con, $sql);
            $flag = false;
            while ($record = mysqli_fetch_array($result)) {
                $id = $record['id'];
                $name = $record['username'];
                $password = $record['password'];
                $_SESSION['adminname'] = $name;
                // echo $id.$name.$password;
                $flag = true;
            }

            if (!$flag) {
                // redirection another page
                header('location:login.php?fail');
            }
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['adminname'] = $username;
                header('Location: admin_dashboard.php');
                exit;
            } else {
                header('Location: admin_login.php?fail');
            }
        } catch (PDOException $e) {
            $error = 'Database error';
        }
    }
}

// Generate CSRF token
$_SESSION['csrf_token'] = bin2hex(random_bytes(32));
?>

<body class="body">
    <div class="login-box">
        <?php if ($error): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token'] ?>">
            <b style="display: flex;justify-content: center;">Admin Login Form</b>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <?php if (isset($_GET['fail'])) {
                echo "<p style=color:#a60c0c>Login unsuccessful. Please try again!</p>  ";
            }
            ?>
        </form>
    </div>
</body>
<?php
include('footer.php');
?>