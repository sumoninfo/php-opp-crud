<?php

require_once realpath("../../vendor/autoload.php");

use App\Controller\MemberController;

$obj = new MemberController();
// Edit managers record
if (isset($_GET['editId']) && !empty($_GET['editId'])) {
    $editId = $_GET['editId'];
    $member = $obj->show($editId);
}

// Update Record in members table
if (isset($_POST['update'])) {
    $obj->update($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "views/inc/header.php"; ?>
<br>

<div class="container">
    <h4 class="text-center">Edit Member</h4>
    <form action="edit.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="hidden" name="umanager_id" value="<?php echo $member['manager_id']; ?>">
            <input type="text" class="form-control" name="uname" value="<?php echo $member['name']; ?>" required="">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="uemail" value="<?php echo $member['email']; ?>" required="">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="upname" value="<?php echo $member['phone']; ?>"
                   required="">
        </div>
        <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $member['id']; ?>">
            <a href="../manager/show.php?showId=<?php echo $member['manager_id']; ?>" class="btn btn-warning mr-1">Back</a>
            <input type="submit" name="update" class="btn btn-primary" style="float:right;" value="Update">
        </div>
    </form>
</div>
<?php include "views/inc/footer.php"; ?>
</body>
</html>
