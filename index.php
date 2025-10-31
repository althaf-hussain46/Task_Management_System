<?php
include_once("./Config/config.php");
include_once(DIR_URL . "../Includes/header.php");


?>


<body>
    <div id="grid-container">
        <div id="tms_title">
            <h1>Task Management System</h1>

        </div>
        <div id="role_selection_title">
            <h2>Select Your Role</h2>
        </div>
        <div id="role_selection_card">
            <div class="card"
                style="width: 18rem;box-shadow: seagreen 1px 5px 15px 2px;border-radius:25px;margin-top:20px">
                <img style="margin-top:10px;height:255px;border-radius:50%;"
                    src="<?php echo BASE_URL . "/Images/admin_1.jpeg"; ?>" class="card-img-bottom" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center">Admin</h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card’s content.</p> -->
                    <a href="<?php echo BASE_URL . "/Admin/adminLogin.php"; ?>" class="btn btn-success"
                        style="width:250px;">Let's Go</a>
                </div>
            </div>

            <div class="card"
                style="width: 18rem;box-shadow: dodgerblue 1px 5px 15px 2px;border-radius:25px;margin-top:20px;">
                <img src="<?php echo BASE_URL . "/Images/user_image.jpeg"; ?>" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title" style="text-align:center">User</h5>
                    <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                    card’s content.</p> -->
                    <a href="<?php echo BASE_URL . "/User/userLogin.php"; ?>" class="btn btn-primary"
                        style="width:250px;">Let's
                        Go</a>
                </div>
            </div>

        </div>

    </div>


</body>


<?php

include_once(DIR_URL . "/Includes/footer.php");
?>