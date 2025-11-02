<?php


include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/user.php");


$user_crud = new UserCRUD();





if (isset($_POST['signUpBtn'])) {
    $user_crud->createUser($con, $_POST);
}

if (isset($_POST['userLoginBtn'])) {
    $user_crud->checkUserExist($con, $_POST);
}

?>

<body>
    <div id="userLoginDiv">

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



        <form action="" class="form-control" id="userLoginForm" method="post">
            <!-- <h3 style="font-family:Verdana, Geneva, Tahoma, sans-serif;">Login Form</h1> -->
            <!-- <label for="" class="form-label">Name</label> -->
            <br>
            <div class="form-floating">
                <input type="email" name="userEmail" autocomplete="" id="userEmail" class="form-control"
                    placeholder="Email">
                <label for="">User Email</label>
            </div>
            <br>
            <div class="form-floating">

                <input type="password" name="userPassword" autocomplete="off" id="userPassword" class="form-control"
                    placeholder="password">
                <label for="" class="form-label">Password</label>
            </div>
            <br>
            <button type="submit" class=" btn btn-primary" name="userLoginBtn" id="userLoginBtn">Login</submit>


                <!-- Button trigger modal -->
                <button type="button" style="background: none;border:none;" class="text-primary" data-bs-toggle="modal"
                    data-bs-target="#exampleModal">Create
                    Account</button>
        </form>
        <div class="modal fade" style="margin-top:100px;" id="exampleModal" tabindex="-1"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Sign Up</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post">
                            <div class="mb-3">
                                <label for="user-name" class="col-form-label">User Name</label>
                                <input type="text" class="form-control" required name="signUpUserName" id="signUpUserName">
                            </div>
                            <div class="mb-3">
                                <label for="user-email" class="col-form-label">User Email</label>
                                <input type="email" class=" form-control" required name="signUpUserEmail" id="signUpUserEmail">
                            </div>
                            <div class="mb-3">
                                <label for="user-password" class="col-form-label">Password</label>
                                <input type="text" class="form-control" required name="signUpUserPassword"
                                    id="signUpUserPassword">
                            </div>
                            <hr>
                            <div style="display:flex;gap:10px;justify-content:flex-end;">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="signUpBtn">Sign Up</button>
                            </div>
                            <hr>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div id=" userSignUpDiv" class="modal fade">
                                    <form action="" class="form-control" id="userSignUpForm" method="post">
                                        <div class="form-floating">
                                            <input type="text" name="userName" id="userName" placeholder="Name"
                                                class="form-control">
                                            <label for="">User Name</label>
                                        </div>
                                        <br>
                                        <div class="form-floating">
                                            <input type="email" name="userEmail" id="userEmail" class="form-control"
                                                placeholder="Email">
                                            <label for="">User Email</label>
                                        </div>
                                        <br>
                                        <div class="form-floating">

                                            <input type="password" name="userPassword" id="userPassword"
                                                class="form-control" placeholder="password">
                                            <label for="" class="form-label">Password</label>
                                        </div>
                                        <br>
                                        <button type="submit" class="btn btn-primary" name="userSignUpBtn"
                                            id="userSignUpBtn">Sign Up</button>

                                    </form>
                            </div> -->
    </div>
</body>
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

window.onload = () => {
    document.getElementById('userEmail').focus();
    document.getElementById('userEmail').select();
}

document.getElementById('userEmail').addEventListener('keydown', (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let userPass = document.getElementById('userPassword');
        if (userPass) {
            userPass.focus();
            userPass.select();


        }
    }
})


document.getElementById('userPassword').addEventListener('keydown', (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let userLoginBtn = document.getElementById('userLoginBtn');
        if (userLoginBtn) {
            userLoginBtn.focus();
        }
    }
})
</script>
<?php include_once(DIR_URL . "/Includes/footer.php"); ?>
