<style>
#usersListContainer {
    margin-top: 30px;
    /* border: 1px solid black; */
    height: 580px;
    box-shadow: seagreen 1px 5px 15px 5px;
    border-radius: 20px;

}



#usersTableDiv {

    /* border: 1px solid #2E8B57; */
    /* padding-top: 50px; */
    height: 380px;
    margin-top: 100px;
    overflow-y: scroll;
    /* background-color: white; */
    /* z-index: 50 !important; */


}


#usersTable {
    margin-left: 100px;
    width: 1200px;
    border: 1px solid #2E8B57;
    height: 100px;


}





#usersTableHeader th {
    background-color: seagreen;
    height: 50px;

    position: sticky;
    z-index: 1;
    top: 0;
}

/* #usersTableBody:hover {
    background-color: black;
} */

#usersSearchForm {
    display: flex;
    /* justify-content: space-between; */
    gap: 41px;
    position: absolute;
    top: 230px;
    left: 380px;
    width: 1300px;
    height: 90px;
    background-color: white;

}



#usersSearchBar {
    /* margin-left: 18px; */
    /* margin-top: 15px; */
    padding-left: 50px;
    font-size: 15px;
    font-weight: bold;
    width: 250px;
    height: 55px;
    border-radius: 5px;
    border: 1px solid seagreen;
    background-image:
        url('../Images/search_image2.jpg');
    background-repeat: no-repeat;
    background-size: 30px;
    /* background-color:
        white; */
    background-position-y: 10px;
    background-position-x: 10px;

}


#usersSearchBtn {

    height: 55px;
    width: 180px;
}


/* #usersSearchBar:focus {
    border-radius: 10px;
    border: 1px solid #2E8B57;
    width: 240px;
    padding-left: 50px;
    border: none;
    color: white;
} */
</style><?php


        include_once("../Config/config.php");
        include_once(DIR_URL . "../Connection/dbConnection.php");
        include_once(DIR_URL . "../Includes/header.php");
        include_once(DIR_URL . "../CRUD/user.php");



        $usersDetails = new UserCRUD();


        if (isset($_POST['usersSearchBtn'])) {
            $_SESSION['users_search_result'] = $usersDetails->userDetailsForAdminDashBoard($con, $_POST['usersSearchBar']);
        } else {

            $_SESSION['users_search_result'] = $usersDetails->userDetailsForAdminDashBoard($con, "");
        }

        ?>

<body>

    <div id="usersListContainer">
        <h1 style="text-align:center;letter-spacing:10px;"> USERS LIST </h1>
        <hr style="border:2px solid #2E8B57">
        <form action="" method="post" id="usersSearchForm">
            <div style="display:flex;gap:20px;justify-content:flex-end;
            width:820px;">
                <input type="text" name="usersSearchBar" autocomplete="off" id="usersSearchBar" class="form-control"
                    placeholder="Search User/Email">
                <button type="submit" name="usersSearchBtn" id="usersSearchBtn" class="btn btn-success">Search</button>

            </div>

        </form>

        <div id="usersTableDiv">
            <table class="table" id="usersTable">
                <thead id="usersTableHeader">
                    <tr>
                        <th>S.No</th>
                        <th>User Name</th>
                        <th>Email User</th>
                    </tr>
                </thead>
                <?php if (isset($_SESSION['users_search_result']) && $_SESSION['users_search_result'] != "") { ?>
                <tbody id="usersTableBody">

                    <?php $i = 1;

                        while ($projectData = $_SESSION['users_search_result']->fetch_assoc()) {

                        ?>
                    <tr>
                        <td><?php echo  $i++ ?></td>
                        <td><?php echo $projectData['user_name']; ?>
                        </td>
                        <td><?php echo $projectData['user_email']; ?></td>
                    </tr>

                    <?php } ?>
                </tbody>
                <?php } ?>
            </table>

        </div>
    </div>

</body>
<script>

</script>
<?php

include_once(DIR_URL . "../Includes/footer.php");
?>