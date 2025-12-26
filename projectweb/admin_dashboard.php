<?php
session_start();
$pageTitle = "Admin Dashboard";
$logged_in = true;
include('dbconnect.php');
include('nav.php'); // Check admin authentication
if (!isset($_SESSION['adminname'])) {
    header('Location: admin_login.php');
    exit;
}

    if(isset($_GET['already'])){
        echo "<p style=color:green>Already Logged in</p>";
    }
    echo $_SESSION['adminname'];
?>

<body class="body">
    <form action="manage.php" method="post">
        <table border="1" class="responsive-table">
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Event</th>
                <th>Actions</th>
            </tr>
            <?php
            $sql = "select * from users";
            $result = mysqli_query($con, $sql);
            while ($record = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>" . $record['name'] . "</td>";
                echo "<td>" . $record['email'] . "</td>";
                echo "<td>" . $record['phone'] . "</td>";
                echo "<td>" . $record['event_id'] . "</td>";
                echo "<td><button type=submit value=" . $record['id'] . " name=delete class='exceptional-button'>DELETE</button>
                  <button type=submit value=" . $record['id'] . " name=edit class='exceptional-button'>Edit</button></td>";
                echo "</tr>";
            }
            ?>
        </table>
    </form>

</body>
<?php
include('footer.php');
?>