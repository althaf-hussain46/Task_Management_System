<style>
#projectTable {
    position: absolute;
    top: 267px;
    left: 900px;
    height: 419px;
    max-width: 780px;
    overflow-y: scroll;
    overflow-x: hidden;
    background-color: white;
}

#projectForm {

    /* box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px; */
    box-shadow: seagreen 1px 5px 15px 5px;
    /* #7FFFD4 */
    /* box-shadow: #2E8B57 1px 5px 15px 5px; */
    border-radius: 20px;
    height: 600px;
}

#projectName {

    margin-left: -20px;
    font-size: 15px;
    font-weight: bold;
    border: 1px solid #2E8B57;
}

#projectDescription {
    font-size: 15px;
    font-weight: bold;
    border: 1px solid #2E8B57;
}

#assigningUserId {

    width: 237px;
    margin-left: -10px;
    padding-top: 10px;
    font-size: 15px;
    font-weight: bold;
}

#projectTableHeader {
    position: sticky;
    z-index: 1;
    top: 0;

}

#projectTableHeader th {

    background-color: seagreen;
}

/* #projectTableBody:hover {
    background-color: black;
} */

#projectSearchForm {
    position: absolute;
    top: 230px;
    right: 48px;
    width: 760px;
    height: 50px;
    /* border: 1px solid black; */
    background-color: white;
    z-index: 1;
}



#projectSearchBar {
    margin-left: 18px;
    margin-top: -28px;
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


#projectUpdateBtn {
    display: none;
}

#projectUpdateCancelBtn {
    display: none;
}


#success-notification {
    position: absolute;
    background-color: #2E8B57 !important;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1400px;
    top: 80px;
    left: 280px;
    height: 40px;
    font-weight: bold;
    font-size: large;
}

#failure-notification {
    position: absolute;
    background-color: red;
    color: white;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1400px;
    top: 80px;
    left: 280px;
    height: 40px;
    font-weight: bold;
    font-size: large;
}

#projectFormDiv {
    margin-top: 20px;
    /* width: 1500px; */

}

#startDate,
#endDate {
    /* font-size: medium; */
    font-weight: 700;
}
</style>

<?php
ob_start();
// include_once("../Config/config.php");
// include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../Functions/date_functions.php");

$project_form_crud = new ProjectFormCRUD();
$userDetails = new UserCRUD();
$date_methods = new DateFunctions();


$pro_name = "";
$pro_desc = "";
$start_date = "";
$end_date = "";
$selected_user = "";

// if (isset($_SESSION['success_notification'])) {
// } else {
//     $_SESSION['success_notification'] = "";
// }
// if (isset($_SESSION['failure_notification'])) {
// } else {
//     $_SESSION['failure_notification'] = "";
// }

if (isset($_POST['projectSubmitBtn'])) {


    $project_form_crud->createProjectMaster($con, $_POST);
}

if (isset($_POST['projectSearchBtn'])) {

    $_SESSION['project_master_search_result'] = $project_form_crud->projectMasterDetails($con, $_POST['projectSearchBar']);
} else {

    $_SESSION['project_master_search_result'] = $project_form_crud->projectMasterDetails($con, "");
}
if (isset($_GET['delete_id'])) {
    extract($_GET);
    $project_form_crud->deleteProjectMaster($con, $delete_id);
}



if (isset($_GET['edit_id'])) {
    extract($_GET);
    $project_data_by_id = $project_form_crud->projectMasterDetailsById($con, $edit_id)->fetch_assoc();
    $pro_name = $project_data_by_id['project_name'];
    $pro_desc = $project_data_by_id['project_description'];
    $_SESSION['project_master_id'] = $project_data_by_id['project_name_id'];

?>
<style>
#projectUpdateBtn {
    display: block;
}

#projectUpdateCancelBtn {
    display: block;
}

#projectSubmitBtn {
    display: none;
}

#projectBackBtn {
    display: none;
}
</style>
<?php }


if (isset($_POST['projectUpdateBtn'])) {
    $project_form_crud->updateProjectMaster($con, $_POST);
}
?>

<body style="height:200px;">

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
    <div class="alert" id="failure-notification">
        <?php echo $_SESSION['failure_notification'];
            unset($_SESSION['failure_notification']);
            ?>
    </div>
    <?php } ?>

    <div id="projectFormDiv">


        <form action="" method="post" id="projectForm" style="padding-left:10px;">
            <h1 style="text-align:center;word-spacing:10px;letter-spacing:15px">PROJECT MASTER</h1>
            <hr>
            <div style="width:620px;border-right:1px solid #2E8B57">

                <h5 style="font-weight:bolder">Project Details</h5>
                <div>
                    <div class="form-floating" style="width:300px;">
                        <input required class="form-control" type="text" name="projectName" id="projectName"
                            placeholder="Project Name" value="<?php echo $pro_name; ?>">
                        <label for="" style="margin-left:-10px">Project Name</label>
                    </div>
                    <!-- <input class="form-control" type="text" name="projectDescription" id="projectDescription"
                placeholder="Description"> -->
                </div>

                <h5 style="font-weight:bolder">Description</h5>
                <textarea class="form-control" name="projectDescription" id="projectDescription" rows="5" cols="5"
                    placeholder="Project Description"><?php echo $pro_desc; ?></textarea>
                <br>



                <div
                    style="display:flex;gap:10px;margin-top:-10px;border-top:1px solid #2E8B57;border-bottom:1px solid #2E8B57;">

                    <button type="submit" name="projectSubmitBtn" id="projectSubmitBtn" class="btn btn-success">Create
                        Project</button>

                    <a href="<?php echo BASE_URL . "/Admin/adminDashBoard.php"; ?>" id="projectBackBtn"
                        class="btn btn-warning" style="width:140px;color:black">Back</a>

                    <button type="submit" name="projectUpdateBtn" id="projectUpdateBtn"
                        class="btn btn-info">Update</button>
                    <a href="<?php echo BASE_URL . "/Admin/projectForm.php"; ?>" id="projectUpdateCancelBtn"
                        class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <form action="" method="post" id="projectSearchForm">

        <input type="text" name="projectSearchBar" autocomplete="off" id="projectSearchBar" class="form-control"
            placeholder="Search Project">
        <button type="submit" name="projectSearchBtn" class="btn btn-success" hidden></button>

    </form>
    <div id="projectTable">
        <table class="table" style="width:750px;border:1px solid #2E8B57;">
            <thead>
                <tr id="projectTableHeader">
                    <th>S.No</th>
                    <th style="">Project Name</th>
                    <th>Project Description</th>
                    <th>Project Date</th>
                    <th style="">Operations</th>
                </tr>
            </thead>
            <?php if (isset($_SESSION['project_master_search_result']) && $_SESSION['project_master_search_result'] != "") { ?>
            <tbody id="projectTableBody" style="font-size:13px;font-weight:bolder">

                <?php $i = 1;
                    while ($projectMasterData = $_SESSION['project_master_search_result']->fetch_assoc()) {


                    ?>
                <tr>
                    <td><?php echo  $i++ ?></td>
                    <td style="width:150px;"><?php echo $projectMasterData['project_name']; ?></td>
                    <td style="width:300px;">
                        <textarea name="" id="" style="width:250px;border:none;height:44px;font-weight:bolder"
                            readonly> <?php echo $projectMasterData['project_description']; ?></textarea>

                    </td>
                    <td style="width:120px;"><?php echo date("d-m-Y", strtotime($projectMasterData['created_at'])); ?>
                    </td>
                    <td style="height:50px;">
                        <a style="width:45px;font-size:14px;"
                            href="<?php echo BASE_URL . "/Admin/projectMaster.php" ?>?edit_id=<?php echo $projectMasterData['project_name_id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a style="width:60px;font-size:14px;"
                            href="<?php echo BASE_URL . "/Admin/projectMaster.php" ?>?delete_id=<?php echo $projectMasterData['project_name_id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Are You Sure Do You Want To Delete This Project ? - Corresponding All Assigned Task Will Also Be Deleted')">Delete</a>
                    </td>
                </tr>

                <?php } ?>
            </tbody>
            <?php } ?>
        </table>

    </div>
</body>



<style>

</style>
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
</script>

<?php ob_flush(); ?>