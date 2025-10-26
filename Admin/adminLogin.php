<?php

include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");


if (isset($_POST['adminLoginSubmitBtn'])) {
    extract($_POST);


    $admin_name = "admin";
    $admin_password = "123";

    if ($adminName == $admin_name && $adminPassword == $admin_password) {
        header("Location: " . BASE_URL . "/Admin/adminDashBoard.php");
    } else {
        echo "admin not found";
    }
    // echo "admin name = " . $adminName;
    // echo "<br>";
    // echo "password = " . $adminPassword;
}




?>

<body>
    <div id="adminLoginDiv">
        <form action="" class="form-control" id="adminLoginForm" method="post">
            <!-- <h3 style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Login Form</h1> -->
            <!-- <label for="" class="form-label">Name</label> -->
            <br>
            <div class="form-floating">
                <input type="text" name="adminName" id="adminName" class="form-control" placeholder="Name">
                <label for="">Admin Name</label>
            </div>
            <br>
            <div class="form-floating">

                <input type="password" name="adminPassword" id="adminPassword" class="form-control"
                    placeholder="password">
                <label for="" class="form-label">Password</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="adminLoginSubmitBtn" id="adminLoginBtn">Login</button>
        </form>
    </div>
</body>


<script>
    window.onload = () => {
        let admin = document.getElementById("adminName");
        if (admin) {
            admin.focus();
        }

    }


    document.getElementById("adminName").addEventListener("keydown", (event) => {



        if (event.key == "Enter") {
            event.preventDefault();
            let admin_pass = document.getElementById("adminPassword");
            if (admin_pass) {
                admin_pass.focus();
                admin_pass.select();
            }
        }
    })


    document.getElementById("adminPassword").addEventListener("keydown", (event) => {



        if (event.key == "Enter") {
            event.preventDefault();
            let admin_login_btn = document.getElementById("adminLoginBtn");
            if (admin_login_btn) {
                admin_login_btn.focus();
            }
        }
    })
</script>

<?php include_once(DIR_URL . "/Includes/footer.php"); ?>