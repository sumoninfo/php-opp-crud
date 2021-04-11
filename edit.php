<?php

require_once realpath("vendor/autoload.php");

use App\Controller\ManagerController;

$managerObj = new ManagerController();
// Edit managers record
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $manager = $managerObj->show($editId);
}

// Update Record in managers table
if (isset($_POST['update'])) {
    $managerObj->update($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "views/inc/header.php"; ?>
<br>

<div class="container">
    <h4 class="text-center">Edit Manager</h4>
    <form action="edit.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" name="uname" value="<?php echo $manager['name']; ?>" required="">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="uemail" value="<?php echo $manager['email']; ?>" required="">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="upname" value="<?php echo $manager['phone']; ?>"
                   required="">
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $manager['id']; ?>">
            <a href="index.php" class="btn btn-warning pu;ll-left">Back</a>
            <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
        </div>
    </form>
</div>
<?php include "views/inc/footer.php"; ?>
</body>
</html>
