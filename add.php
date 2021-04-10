<?php

require_once realpath("vendor/autoload.php");

$managerObj = new \App\Controller\ManagerController();

// Insert Record in customer table
if (isset($_POST['submit'])) {
    $managerObj->insertData($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "views/inc/header.php"; ?>
<br>

<div class="container">
    <h4 class="text-center">Add Manager</h4>
    <form action="add.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
        </div>
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter username" required="">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
        </div>
        <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
    </form>
</div>

<?php include "views/inc/footer.php"; ?>
</body>
</html>
