<?php
ob_start();
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
// include_once(DIR_URL . "../Includes/adminNavbar.php");


?>


<body>
    <div id="grid-container-offcanvas">
        <div id="header">

            <?php include_once(DIR_URL . "../Includes/adminNavbar.php"); ?>
        </div>

        <div id="offcanvas"><?php include_once(DIR_URL . "../Includes/sidebar.php"); ?></div>
        <div id="main-content"><?php include_once(DIR_URL . "../Includes/taskManagementDesign.php"); ?></div>
        <div id="developer">Developed by</div>
        <div id="name">Althaf Hussain J</div>
        <div id="contact">
            <ul style="list-style-type:none">
                <li style="text-align:center">9094095610</li>
                <li>althafhussain2k3@gmail.com</li>
            </ul>





        </div>

    </div>


</body>


<?php
include_once(DIR_URL . "/Includes/footer.php");
?>
<?php ob_flush(); ?>