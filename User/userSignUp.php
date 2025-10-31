<?php


include_once("../Config/config.php");
include_once(DIR_URL . "../Includes/header.php");

?>

<body>
    <div id="userSignUpDiv">
        <form action="" class="form-control" id="userSignUpForm" method="post">
            <div class="form-floating">
                <input type="text" name="userName" id="userName" placeholder="Name" class="form-control">
                <label for="">User Name</label>
            </div>
            <br>
            <div class="form-floating">
                <input type="email" name="userEmail" id="userEmail" class="form-control" placeholder="Email">
                <label for="">User Email</label>
            </div>
            <br>
            <div class="form-floating">

                <input type="password" name="userPassword" id="userPassword" class="form-control"
                    placeholder="password">
                <label for="" class="form-label">Password</label>
            </div>
            <br>
            <button type="submit" class="btn btn-primary" name="userSignUpBtn" id="userSignUpBtn">Sign Up</button>

        </form>
    </div>
</body>

<?php include_once(DIR_URL . "/Includes/footer.php"); ?>