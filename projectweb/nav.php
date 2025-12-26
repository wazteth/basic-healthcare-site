<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle : 'Health Promotion Board - Work Life Balance'; ?></title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>
    <nav>
        <div class="logo">HPB</div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="register.php">Register</a>
            <?php if (isset($logged_in) && $logged_in): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="admin_login.php">Login for Admin</a>
                <?php endif; ?>
            <a href="events.php">Events</a>
            <a href="contact.php">Contact</a>
        </div>
    </nav>
</body>

</html>