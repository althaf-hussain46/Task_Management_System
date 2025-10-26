<?php
include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");
?>

<div style="background-color:aquamarine;height:680px;margin-top:-10px">
    <ul style="list-style-type:none;">
        <li style="font-size:larger;font-weight:bolder;">
            <i class="fa-solid fa-house" style="margin-left:-20px">
            </i><a href="" style="text-decoration: none;color:black;padding-left:-40px"> Dash Board</a>
        </li>

    </ul>
    <a class="btn" data-bs-toggle="collapse" data-bs-target="#management" style="font-size:larger;font-weight:bolder"><i
            class="fa-solid fa-list-check"></i> Management </a>
    <div class="collapse" id="management" style="background-color:aliceblue">
        <ul style="font-size:larger;font-weight:bolder;list-style-type:none;margin-left:-10px;color:black;">
            <li style="padding-top:10px"><i class="fa-solid fa-table-list"></i><a
                    href="<?php echo BASE_URL."/ADMIN/projectForm.php" ?>" style="text-decoration:none;color:black">
                    Project</a>
            </li>
            <li style="padding-top:10px;"><i class="fa-solid fa-list-ol"></i><a href=""
                    style="text-decoration:none;color:black;margin-left:2px;"> Project List</a></li>
            <li style="padding-top:10px;"><a href="" style="text-decoration:none;color:black"><i
                        class="bi bi-list-task"></i>
                    Task</a></li>
        </ul>
    </div>
</div>


<?php include_once(DIR_URL . "/Includes/footer.php"); ?>