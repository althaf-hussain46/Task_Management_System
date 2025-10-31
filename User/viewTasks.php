<style>

</style>
<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");



?>


<body>
    <div id="grid-container-offcanvas-user">
        <div id="header-user">

            <?php include_once(DIR_URL . "../Includes/userNavbar.php"); ?>
        </div>

        <div id="offcanvas-user"><?php include_once(DIR_URL . "../Includes/userSidebar.php"); ?>
        </div>
        <div id="main-content-user"><?php include_once(DIR_URL . "../Includes/viewTasksContent.php"); ?></div>
        <div id="developer-user">Developed by</div>
        <div id="name-user">Althaf Hussain J</div>
        <div id="contact-user">
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