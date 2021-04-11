<?php

require_once realpath("vendor/autoload.php");

use App\Controller\MemberController;

// Insert Record in members table
if (isset($_POST['submit'])) {
    $obj = new MemberController();
    $obj->store($_POST);
}

?>
<!DOCTYPE html>
<html lang="en">
<?php include "views/inc/header.php"; ?>
<br>

<div class="container">
    <h4 class="text-center">Add Member</h4>
    <form action="create-member.php" method="POST">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="hidden" name="manager_id" value="<?php echo $_GET['manager_id'] ?>">
            <input type="text" class="form-control" name="name" placeholder="Enter name" required="">
        </div>
        <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" name="email" placeholder="Enter email" required="">
        </div>
        <div class="form-group">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" name="phone" placeholder="Enter phone" required="">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required="">
        </div>
        <a href="show.php?showId=<?php echo $_GET['manager_id']; ?>" class="btn btn-warning mr-1">Back</a>
        <input type="submit" name="submit" class="btn btn-primary" style="float:right;" value="Submit">
    </form>
</div>

<?php include "views/inc/footer.php"; ?>
</body>
</html>
