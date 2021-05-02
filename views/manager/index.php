<?php
session_start();
require_once realpath("../../vendor/autoload.php");

use App\Controller\ManagerController;

$managerObj = new ManagerController();
$managers = $managerObj->index();
// Delete record from managers table
if (isset($_GET['deleteId']) && !empty($_GET['deleteId'])) {
    $deleteId = $_GET['deleteId'];
    $managerObj->destroy($deleteId);
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
    <h4>Managers List
        <a href="create.php" class="btn btn-primary" style="float:right;">Add New Record</a>
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
        <?php if ($managers != null): ?>
            <?php foreach ($managers as $manager) : ?>
                <tr>
                    <td><?php echo $manager['id'] ?></td>
                    <td><?php echo $manager['name'] ?></td>
                    <td><?php echo $manager['email'] ?></td>
                    <td><?php echo $manager['phone'] ?></td>
                    <td>
                        <a class="btn btn-success" href="show.php?showId=<?php echo $manager['id'] ?>">
                            Add Member</a>&nbsp
                        <a class="btn btn-warning" href="edit.php?editId=<?php echo $manager['id'] ?>">
                            <i class="fa fa-pencil" aria-hidden="true"></i></a>&nbsp
                        <a class="btn btn-danger" href="index.php?deleteId=<?php echo $manager['id'] ?>"
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
