<style>
#navbar-header {

    color: white;
    margin-top: -10px;
    display: flex;
    width: 100%;
    height: 80px;
    /* border: 1px solid white; */
}

#title-label {
    display: flex;
    width: 160%;
    margin-top: -10px
        /* border: 1px solid red; */
}

#admin-image {

    width: 40%;
    border-radius: 50%;
    display: flex;
    flex-direction: column;
    margin-top: -10px;
    /* border: 1px solid black; */

}

#logout-btn-div {

    width: 20%;
    /* border: 1px solid yellow; */
    display: flex;
    justify-content: end;

}
</style>

<?php
include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");

?>

<div id="navbar-header">
    <div id="title-label">
        <img style="width:80px;" src=" <?php echo BASE_URL."../Images/task_logo.png";?>" alt="">
        <h1>Task Management System</h1>

    </div>
    <div><img src="<?php echo BASE_URL . "../Images/admin_image.jpeg"  ?>" id="admin-image" alt="">
        <span style="font-weight: bolder;"> Admin</span>
    </div>
    <div id="logout-btn-div" style=""><a href="<?php echo BASE_URL . "../logout.php" ?>" class="btn btn-danger"
            style="width:140px;font-weight:bolder;margin-top:-1px">Logout</a>
    </div>
</div>



<?php

include_once(DIR_URL . "/Includes/footer.php");
?>