<?php

include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");

?>

<body>
    <div id="userLoginDiv">
        <form action="" class="form-control" id="userLoginForm">
            <!-- <h3 style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Login Form</h1> -->
            <!-- <label for="" class="form-label">Name</label> -->
            <br>
            <div class="form-floating">
                <input type="text" name="userName" id="userName" class="form-control" placeholder="Name">
                <label for="">User Name</label>
            </div>
            <br>
            <div class="form-floating">

                <input type="password" name="userPassword" id="userPassword" class="form-control"
                    placeholder="password">
                <label for="" class="form-label">Password</label>
            </div>
            <br>
            <submit class="btn btn-primary" id="userLoginBtn">Login</submit>
        </form>
    </div>
</body>

<?php include_once(DIR_URL . "/Includes/footer.php"); ?>