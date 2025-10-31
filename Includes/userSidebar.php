<?php
include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");
?>

<div style="background-color:#DAEDFF;height:680px;margin-top:-10px">
    <ul style="list-style-type:none;">
        <li style="font-size:larger;font-weight:bolder;">
            <i class="fa-solid fa-house" style="margin-left:-20px">
            </i><a href="<?php echo BASE_URL . "/User/userDashBoard.php"; ?>"
                style="text-decoration: none;color:black;padding-left:-40px">
                DashBoard</a>


        </li>
    </ul>

</div>


<?php include_once(DIR_URL . "/Includes/footer.php"); ?>