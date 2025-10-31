<style>
    #success-notification {
        position: absolute;
        background-color: #2E8B57 !important;
        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 1400px;
        top: 80px;
        left: 280px;
        height: 40px;
        font-weight: bold;
        font-size: large;
    }

    #failure-notification {
        position: absolute;

        color: white;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 1400px;
        top: 80px;
        left: 280px;
        height: 40px;
        font-weight: bold;
        font-size: large;
    }
</style>

<?php
include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");
include_once(DIR_URL . "/CRUD/user.php");

$user_profile_update = new UserCRUD();
$get_user_data_by_id = new UserCRUD();

$userData = $get_user_data_by_id->userDetailsById($con, $_SESSION['user_id']);

if (isset($_POST['userProfileUpdateBtn'])) {

    // print_r($_POST);
    $user_profile_update->updateUser($con, $_POST);
}
?>

<?php
if (isset($_SESSION['success_notification']) && $_SESSION['success_notification'] != "") {
?>
    <div class="alert alert-primary" id="success-notification">
        <?php echo $_SESSION['success_notification'];
        unset($_SESSION['success_notification']);
        ?>
    </div>
<?php } ?>
<?php
if (isset($_SESSION['failure_notification']) && $_SESSION['failure_notification'] != "") {
?>
    <div class="alert alert-danger" id="failure-notification">
        <?php echo $_SESSION['failure_notification'];
        unset($_SESSION['failure_notification']);
        ?>
    </div>
<?php } ?>


<div id="navbar-header-user">
    <div id="title-label-user">
        <img style="width:80px;" src=" <?php echo BASE_URL . "../Images/task_logo.png"; ?>" alt="">
        <h1>Task Management System</h1>
    </div>



    <div>
        <img src="<?php echo BASE_URL . "../Images/user_image.jpeg"  ?>" title="Change Profile" id="user-image" alt=""
            data-bs-toggle="modal" data-bs-target="#userProfileUpdateForm">
        <span style="font-weight: bolder;padding-left:6px"> User</span>
    </div>


    <div id=" logout-btn-div" style=""><a href="<?php echo BASE_URL . "../logout.php" ?>" class="btn btn-danger"
            style="width:140px;font-weight:bolder;margin-top:-1px">Logout</a>
    </div>
</div>

<!-- Modal -->

<div class="modal fade" id="userProfileUpdateForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="">User Profile - Update</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post">
                    <div class="mb-3">
                        <label class="col-form-label">User Name</label>
                        <input type="text" name="user_profile_name" class="form-control" id="user-profile-name">
                    </div>
                    <div class="mb-3">
                        <label class="col-form-label">User Email</label>
                        <input type="email" name="user_profile_email" class="form-control" id="user-profile-email">
                    </div>

                    <div class="mb-3">
                        <label class="col-form-label">User Password</label>
                        <input type="password" name="user_profile_password" class="form-control"
                            id="user-profile-password">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" name="userProfileUpdateBtn" id="userProfileUpdateBtn"
                    class="btn btn-primary">Update</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    setTimeout(() => {
        let failure_alert = document.getElementById("failure-notification")
        if (failure_alert) {
            failure_alert.style.display = "none";
        }
        let success_alert = document.getElementById("success-notification")
        if (success_alert) {
            success_alert.style.display = "none";
        }
    }, 2000);
</script>

<?php

include_once(DIR_URL . "/Includes/footer.php");
?>