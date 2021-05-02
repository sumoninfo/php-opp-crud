<?php
session_start();
require_once realpath("../../vendor/autoload.php");

use App\Controller\ManagerController;
use App\Controller\MemberController;

$managerObj = new ManagerController();
$memberObj = new MemberController();
$manager_managers = [];
$showId = '';
// Edit managers record
if (isset($_GET['showId']) && !empty($_GET['showId'])) {
    $showId = $_GET['showId'];
    $manager = $managerObj->show($showId);
    $manager_managers = $managerObj->managerByMembers($showId);
}
// Delete record from members table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $manager_id = $_GET['manager_id'];
    $memberObj->destroy($deleteId, $manager_id);
}


?>
<!DOCTYPE html>
<html lang="en">
<?php include "../inc/header.php"; ?>
<br>
<br>

<div class="container">
    <?php if (isset($_SESSION['message'])): ?>
        <div class="alert alert-success alert-dismissible">
            <button type='button' class='close' data-dismiss='alert'>&times;</button>
		  <?php echo $_SESSION['message']; ?>
        </div>
    <?php endif; ?>
    <?php unset($_SESSION['message']); ?>

    <h4><strong><?php echo $manager['name']; ?></strong> members
        <a href="../member/create.php?manager_id=<?php echo $manager['id']; ?>" class="btn btn-primary"
           style="float:right;">Add New Member</a>
        <a href="../../index.php" class="btn btn-warning mr-1"
           style="float:right;">Back</a>
    </h4>
    <table class="table table-hover">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
	   <?php if ($manager_managers != null): ?>
		  <?php foreach ($manager_managers as $member) : ?>
                <tr>
                    <td><?php echo $member['id'] ?></td>
                    <td><?php echo $member['name'] ?></td>
                    <td><?php echo $member['email'] ?></td>
                    <td><?php echo $member['phone'] ?></td>
                    <td>
                        <a href="../member/edit.php?editId=<?php echo $member['id'] ?>" style="color:green">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                        <a href="show.php?deleteId=<?php echo $member['id'] ?>&manager_id=<?php echo $showId ?>"
                           style="color:red"
                           onclick="confirm('Are you sure want to delete this record')">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                    </td>
                </tr>
		  <?php endforeach; ?>
	   <?php else: ?>
            <tr>
                <td class="text-center" colspan="5"><strong>No data found!</strong></td>
            </tr>
	   <?php endif; ?>
        </tbody>
    </table>
</div>
<?php include "../inc/footer.php"; ?>
</body>
</html>
