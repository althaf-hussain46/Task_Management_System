<style>
#projectUpdateBtn {
    display: none;
}

#projectUpdateCancelBtn {
    display: none;
}

#failure-notification,
#success-notification {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 1500px;
    left: 10px;
    height: 40px;
    font-weight: bold;
    font-size: large;
}

#projectFormDiv {
    margin-top: 50px;
}
</style>

<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../Includes/adminNavbar.php");
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


    $project_form_crud->createProject($con, $_POST);
}

if (isset($_POST['projectSearchBtn'])) {
    echo $_POST['projectSearchBar'];
    $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, $_POST['projectSearchBar']);
} else {

    $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, "");
}
if (isset($_GET['delete_id'])) {
    extract($_GET);
    $project_form_crud->deleteProject($con, $delete_id);
}



if (isset($_GET['edit_id'])) {
    extract($_GET);
    $project_data_by_id = $project_form_crud->projectDetailsById($con, $edit_id)->fetch_assoc();
    $pro_name = $project_data_by_id['project_name'];
    $pro_desc = $project_data_by_id['description'];
    $start_date    = $project_data_by_id['start_date'];
    $end_date      = $project_data_by_id['end_date'];
    $selected_user = $project_data_by_id['assigned_user_id'];
    $_SESSION['pro_id'] = $project_data_by_id['project_id'];

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
    $project_form_crud->updateProject($con, $_POST);
}
?>

<body>

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

    <div id="projectFormDiv">


        <form action="" method="post" id="projectForm" style="padding-left:10px;">
            <h1>Project Management</h1>
            <hr>
            <div>
                <div class="form-floating" style="width:300px;">
                    <input required class="form-control" type="text" name="projectName" id="projectName"
                        placeholder="Project Name" value="<?php echo $pro_name; ?>">
                    <label for="">Project Name</label>
                </div>
                <!-- <input class="form-control" type="text" name="projectDescription" id="projectDescription"
                placeholder="Description"> -->
            </div>
            <br>
            <textarea class="form-control" name="projectDescription" id="projectDescription" rows="5" cols="5"
                placeholder="Project Description"><?php echo $pro_desc; ?></textarea>

            <br>
            <div style="display: flex;gap:20px;">
                <div class="form-floating">
                    <input required class="form-control" type="date" name="startDate" id="startDate"
                        placeholder="Start Date" value="<?php echo $start_date; ?>">
                    <label for="">Start Date</label>
                </div>
                <div class="form-floating">
                    <input required class="form-control" type="date" name="endDate" id="endDate" placeholder="End Date"
                        value="<?php echo $end_date; ?>">
                    <label for="">End Date</label>
                </div>

                <div class="form-floating">
                    <select required name="assigningUserId" id="assigningUserId" class="form-control">
                        <!-- dummy user names later i will connect with database
                        and get user from the users table-->
                        <option value="">--select user--</option>
                        <?php
                        $userDetailsFetched =  $userDetails->userDetails($con);

                        while ($userData = $userDetailsFetched->fetch_assoc()) { ?>
                        <option value="<?php echo $userData['user_id'] ?>"
                            <?php echo ($selected_user == $userData['user_id']) ? "selected" : "" ?>>
                            <?php echo $userData['user_email'] ?>
                        </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div style=" display:flex;gap:10px;">

                <button type="submit" name="projectSubmitBtn" id="projectSubmitBtn" class="btn btn-success">Create
                    Project</button>
                <a href="<?php echo BASE_URL . "/Admin/adminDashBoard.php"; ?>" id="projectBackBtn"
                    class="btn btn-warning">Back</a>

                <button type="submit" name="projectUpdateBtn" id="projectUpdateBtn" class="btn btn-info">Update</button>
                <a href="<?php echo BASE_URL . "/Admin/projectForm.php"; ?>" id="projectUpdateCancelBtn"
                    class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>
    <form action="" method="post" id="projectSearchForm">

        <input type="text" name="projectSearchBar" id="projectSearchBar" class="form-control"
            onfocus="applySearchText(event)">
        <button type="submit" name="projectSearchBtn" class="btn btn-success" hidden></button>

    </form>
    <div id="projectTable">

        <table class="table">
            <thead>
                <tr id="projectTableHeader">
                    <th>S.No</th>
                    <th>Project Name</th>
                    <th>Assigned User</th>
                    <th>Dead Line</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <?php if (isset($_SESSION['project_search_result']) && $_SESSION['project_search_result'] != "") { ?>
            <tbody id="projectTableBody">

                <?php $i = 1;
                    $current_date =  date("Y-m-d");
                    while ($projectData = $_SESSION['project_search_result']->fetch_assoc()) {
                        $date_diff = $date_methods->date_difference($current_date, $projectData['end_date']);
                        switch ($projectData['end_date']) {
                            case  $current_date < $projectData['end_date'];
                                $color = "green";
                                $status = "Future deadline by " . $date_diff . " days";

                                break;
                            case $current_date ==  $projectData['end_date'];
                                $color = "orange";
                                $status = "Today is the deadline";
                                break;
                            case $current_date   >  $projectData['end_date'];
                                $color = "red";
                                $status = "Deadline passed by " . $date_diff . " days";
                                break;
                        }
                        // if($projectData['end_date'] == $current_date){
                        //     $color = "orange";

                        // }elseif($pro)

                    ?>
                <tr>
                    <td><?php echo  $i++ ?></td>
                    <td><?php echo $projectData['project_name']; ?></td>
                    <td><?php echo $projectData['user_email']; ?>
                    </td>
                    <td><span style="color:<?php echo  $color; ?>;"><?php echo $status; ?> </span>
                        <!-- <div style=" height:10px; width:10px;border:1px solid
                            red;background-color:red;display:flex">
                            sdf
    </div> -->
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?edit_id=<?php echo $projectData['project_id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?delete_id=<?php echo $projectData['project_id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Are You Sure Do You Want To Delete This Project')">Delete</a>
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
    let failure_alert = document.getElementById(" failure-notification")
    if (failure_alert) {
        failure_alert.style.display = "none";
    }
    let success_alert = document.getElementById("success-notification")
    if (success_alert) {
        success_alert.style.display = "none";
    }
}, 2000);

function applySearchText(event) {
    document.getElementById('projectSearchBar').placeholder = "Search Project";
}
</script>
<?php

include_once(DIR_URL . "../Includes/footer.php");
?>