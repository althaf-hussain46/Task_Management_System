<?php
include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");
?>

<div style="background-color:#CAF5D7;height:680px;margin-top:-10px">
        <ul style="list-style-type:none;">
                <li style="font-size:larger;font-weight:bolder;">
                        <i class="fa-solid fa-house" style="margin-left:-20px">
                        </i><a href="<?php echo BASE_URL . "/Admin/adminDashBoard.php"; ?>"
                                style="text-decoration: none;color:black;padding-left:-40px">
                                DashBoard</a>
                </li>

        </ul>
        <a class="btn" data-bs-toggle="collapse" data-bs-target="#management" style="font-size:larger;font-weight:bolder"><i
                        class="fa-solid fa-list-check"></i> Management </a>
        <div class="collapse" id="management" style="background-color:aliceblue;">
                <ul style="font-size:larger;font-weight:bolder;list-style-type:none;margin-left:-30px;color:black;">

                        <li style="padding-top:10px"><i class="fa-solid fa-table-list"></i><a
                                        href="<?php echo BASE_URL . "/Admin/projectMaster.php" ?>" style="text-decoration:none;color:black">
                                        Project Master</a>
                        </li>
                        <li style="padding-top:10px"><i class="fa-solid fa-table-list"></i><a
                                        href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>" style="text-decoration:none;color:black">
                                        Assign Project</a>
                        </li>
                        <li style="padding-top:10px;"><i class="fa-solid fa-list-ol"></i><a
                                        href="<?php echo BASE_URL . "/Admin/projectList.php"; ?>"
                                        style="text-decoration:none;color:black;margin-left:2px;"> Assigned Projects</a></li>
                        <li style="padding-top:10px;"><a href="<?php echo BASE_URL . "/Admin/taskManagement.php"; ?>"
                                        style="text-decoration:none;color:black"><i class="bi bi-list-task"></i>
                                        Task</a></li>
                </ul>
        </div>
</div>


<?php include_once(DIR_URL . "/Includes/footer.php"); ?>