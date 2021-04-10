<?php
require_once realpath("vendor/autoload.php");

use App\Controller\ManagerController;

// Delete record from managers table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $managerObj = new ManagerController();
    $deleteId = $_GET['deleteId'];
    $managerObj->destroy($deleteId);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "views/inc/header.php"; ?>
<br>
<br>

<div class="container">
    <?php
    if (isset($_GET['msg1']) == "insert") {
	   echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
             Added successfully
            </div>";
    }
    if (isset($_GET['msg2']) == "update") {
	   echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Updated successfully
            </div>";
    }
    if (isset($_GET['msg3']) == "delete") {
	   echo "<div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert'>&times;</button>
              Deleted successfully
            </div>";
    }
    ?>
    <h4>Managers List
        <a href="create.php" class="btn btn-primary" style="float:right;">Add New Record</a>
    </h4>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Username</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
	   <?php
	   $managers = $managerObj->displayData();
	   if ($managers != null) {
		  foreach ($managers as $manager) {
			 ?>
                <tr>
                    <td><?php echo $manager['id'] ?></td>
                    <td><?php echo $manager['name'] ?></td>
                    <td><?php echo $manager['email'] ?></td>
                    <td><?php echo $manager['username'] ?></td>
                    <td>
                        <a href="edit.php?editId=<?php echo $manager['id'] ?>" style="color:green">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                        <a href="index.php?deleteId=<?php echo $manager['id'] ?>" style="color:red"
                           onclick="confirm('Are you sure want to delete this record')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
		  <?php }
	   } ?>
        </tbody>
    </table>
</div>
<?php include "views/inc/footer.php"; ?>
</body>
</html>
