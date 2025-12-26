<?php
session_start();
$pageTitle = "Admin Dashboard";
$logged_in = true;
include('nav.php');
include('dbconnect.php');
if (isset($_POST['delete'])) {   //accept id to delete
    $id = $_POST['delete'];

    //db connect

    //delete query
    $sql = "delete from users where id=$id";
    if (mysqli_query($con, $sql)) {
        echo "<script>window.location.href='admin_dashboard.php'</script>";
    }
}
?>
<body class="body">
    <div class="content">
    <?php
    if (isset($_POST['edit'])) {
        //accept id to edit
        $id = $_POST['edit'];

        //db connect

        //edit query
        
        $sql = "select * from users where id = " . $id;
        $result = mysqli_query($con, $sql);
        echo "<form action =$_SERVER[PHP_SELF] method=post>";
        echo "<table class='responsive-table'>";
        while ($record = mysqli_fetch_array($result)) {
            echo "<input type=hidden name=id value=".$record['id'].">";
            echo "<tr><td>Name</td><td><input type=text name=name value=".$record['name']
            ."></td></tr>";
            echo "<tr><td>Email</td><td><input type=text name=email value=".$record['email']
            ."></td></tr>";
            echo "<tr><td>Phone</td><td><input type=text name=phone value=".$record['phone']
            ."></td></tr>";
            echo "<tr><td>Event</td><td><input type=text name=event value=".$record['event_id']
            ."></td></tr>";
            echo "<tr><td colspan=2><center><input type=submit name=sub value=Update></center></td></tr>";
            
        }
        echo "</table></form>";
    }
    ?>
</div>
</body>

<?php
include('footer.php');
if(isset($_POST['sub'])){
    //accept id,name,address,roll,ph
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $event = $_POST['event'];

    $sql = "update users set name = '$name', email = '$email', phone = '$phone', event_id = '$event' where id='$id'";
    mysqli_query($con,$sql);
    header('location:admin_dashboard.php');
    //db connect
    //update query
    //query execute
}
?>