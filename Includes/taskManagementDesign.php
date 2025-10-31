<style>
    #taskTable {
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

    #projectId {
        border: 1px solid seagreen;
        margin-left: -20px;
        font-size: 15px;
        font-weight: bold;
        width: 270px;
    }

    #taskName {
        border: 1px solid seagreen;
        margin-left: 10px;
        width: 300px;
        font-size: 15px;
        font-weight: bold;
    }

    #taskDescription {
        font-size: 15px;
        font-weight: bold;
        border: 1px solid seagreen;
        margin-left: -17px;
        width: 400px;

    }

    #taskStatus {


        font-size: 15px;
        font-weight: bold;
        border: 1px solid seagreen;
        height: 128px;

        margin-top: 10px;
    }

    #assigningUserId {
        border: 1px solid seagreen;
        width: 237px;
        margin-left: -10px;
        padding-top: 10px;
        font-size: 15px;
        font-weight: bold;
    }

    #taskTableHeader {
        position: sticky;
        z-index: 1;
        top: 0;

    }

    #taskTableHeader th {

        background-color: seagreen;
    }

    #taskTableBody:hover {
        background-color: black;
    }

    #taskSearchForm {
        position: absolute;
        top: 230px;
        right: 48px;
        width: 760px;
        height: 50px;
        /* border: 1px solid black; */
        background-color: white;
        z-index: 1;
    }



    #taskSearchBar {
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

    #taskSearchBar:focus {
        border-radius: 10px;

        border: 1px solid #2E8B57;
        /* width: 220px; */
        padding-left: 50px;
        border: none;
        /* color: white; */

    }

    #taskUpdateBtn {
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






    #taskPriority {
        border: 1px solid seagreen;
        width: 170px;
        margin-left: -10px;

    }

    #taskPriority,
    #deadLine {
        /* font-size: medium; */
        font-weight: 700;
        border: 1px solid seagreen;
    }
</style>

<?php
ob_start();
// include_once("../Config/config.php");
// include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
include_once(DIR_URL . "../CRUD/taskForm.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../Functions/date_functions.php");

$project_form_crud = new ProjectFormCRUD();
$task_form_crud = new TaskFormCRUD();
$userDetails = new UserCRUD();
$date_methods = new DateFunctions();
$user_form_crud = new UserCRUD();
$projectInfo = $project_form_crud->projectNameList($con);
$pro_name = "";
$pro_desc = "";
$start_date = "";
$end_date = "";
$selected_user = "";
$hiddenProjectId = "";
// if (isset($_SESSION['success_notification'])) {
// } else {
//     $_SESSION['success_notification'] = "";
// }
// if (isset($_SESSION['failure_notification'])) {
// } else {
//     $_SESSION['failure_notification'] = "";
// }

if (isset($_POST['taskSubmitBtn'])) {
    // print_r($_POST);

    $task_form_crud->createTask($con, $_POST);
}

if (isset($_POST['taskSearchBtn'])) {

    $_SESSION['task_search_result'] = $task_form_crud->taskDetails($con, $_POST['taskSearchBar']);
} else {

    $_SESSION['task_search_result'] = $task_form_crud->taskDetails($con, "");
}
if (isset($_GET['delete_id'])) {
    extract($_GET);
    $project_form_crud->deleteProject($con, $delete_id);
}
if (isset($_POST['project_name_id_hidden_btn'])) {

    $hiddenProjectId = $_POST['projectId'];
}


if (isset($_GET['edit_id'])) {
    extract($_GET);
    $project_data_by_id = $task_form_crud->taskDetailsById($con, $edit_id)->fetch_assoc();
    $pro_name = $project_data_by_id['project_name'];
    $pro_desc = $project_data_by_id['description'];
    $start_date    = $project_data_by_id['start_date'];
    $end_date      = $project_data_by_id['end_date'];
    $selected_user = $project_data_by_id['assigned_user_id'];
    $_SESSION['pro_id'] = $project_data_by_id['project_id'];

?>


    <style>
        /* #taskUpdateBtn {
    display: block;
}

#projectUpdateCancelBtn {
    display: block;
} */

        #taskSubmitBtn {
            display: none;
        }

        #projectBackBtn {
            display: none;
        }
    </style>
<?php }


if (isset($_POST['taskUpdateBtn'])) {
    $project_form_crud->updateProject($con, $_POST);
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
        <div class="alert alert-danger" id="failure-notification">
            <?php echo $_SESSION['failure_notification'];
            unset($_SESSION['failure_notification']);
            ?>
        </div>
    <?php } ?>

    <div id="projectFormDiv">
        <div style="position: absolute;left:292px;top:245px;">
            <form action="" method="post">

                <div class="form-floating" style="width:350px;">
                    <select onchange="triggerProjectNameIdHiddenBtn()" name="projectId" id="projectId"
                        class="form-control">
                        <option value="0" style="text-align:center">-- Select Project --</option>
                        <?php while ($pData = $projectInfo->fetch_assoc()) {

                        ?>
                            <option value="<?php echo $pData['project_name_id']; ?>"
                                <?php echo ($hiddenProjectId == $pData['project_name_id']) ? 'selected' : ''; ?>>
                                <?php echo $pData['project_name']; ?>
                            </option>
                        <?php } ?>
                    </select>
                    <label for="" style="margin-left:-10px;font-weight: bold;">Project Name</label>
                </div>
                <input type="submit" name="project_name_id_hidden_btn" id="project_name_id_hidden_btn" hidden>

            </form>
        </div>

        <form action="" method="post" id="projectForm" style="padding-left:10px;">
            <input hidden type="text" name="project_name_id_hidden" id="project_name_id_hidden"
                value="<?php echo  $hiddenProjectId; ?>" style="position:absolute;left:698px;top:210px;">
            <h1 style="text-align:center;letter-spacing:10px;">TASK MANAGEMENT</h1>
            <hr>
            <div style="width:620px;border-right:1px solid #2E8B57;">
                <h5 style="font-weight:bolder">Task Details</h5>
                <div style="display:flex;margin-left:270px;">
                    <div class=" form-floating">
                        <input required class="form-control" type="text" name="taskName" id="taskName"
                            placeholder="Task Name">
                        <label for="" style="margin-left:20px;font-weight: bold;">Task</label>
                    </div>

                    <!-- <input class="form-control" type="text" name="taskDescription" id="taskDescription"
                placeholder="Description"> -->
                </div>

                <h5 style="font-weight:bolder">Description</h5>

                <div style="display:flex;">
                    <div>
                        <textarea class="form-control" name="taskDescription" id="taskDescription" rows="5"
                            placeholder="Task Description"><?php echo $pro_desc; ?></textarea>
                    </div>

                    <!-- <div class="form-control" style="display:flex;flex-direction:column" id="taskStatus">
                        <span>
                            <input type="radio" name="taskStatus" id="notStarted" checked value="Not Started">
                            <label for="">Not Started</label>
                        </span>
                        <span>
                            <input type="radio" name="taskStatus" id="inProgress" value="In Progress">
                            <label for="">In Progress</label>
                        </span>
                        <span>
                            <input type="radio" name="taskStatus" id="completed" value="Completed">
                            <label for="">Completed</label>
                        </span>

                    </div> -->



                </div>

                <h5>Assigned</h5>



                <div style="display: flex;margin-left:-10px;margin-top:-20px">

                    <div class="form-floating">
                        <select required name="assigningUserId" id="assigningUserId" class="form-control">
                            <!-- dummy user names later i will connect with database
                        and get user from the users table-->
                            <option value="" style="text-align:center">-- Select User --</option>
                            <?php
                            $userDetailsFetched =  $userDetails->userDetailsByProjects($con, $hiddenProjectId);

                            while ($userData = $userDetailsFetched->fetch_assoc()) { ?>
                                <option value="<?php echo $userData['user_id'] ?>"
                                    <?php echo ($selected_user == $userData['user_id']) ? "selected" : "" ?>>
                                    <?php echo $userData['user_name'] ?>
                                </option>
                            <?php } ?>
                        </select>
                        <label for="" style="font-weight:bold;margin-top:3px;">User</label>
                    </div>

                    <div class="form-floating">
                        <select name="taskPriority" id="taskPriority" class="form-control">
                            <option value="Low">Low</option>
                            <option value="Medium">Medium</option>
                            <option value="High">High</option>
                        </select>
                        <label for="" style="font-weight:bold;margin-top:3px;">Priority Level</label>
                    </div>
                    <div class="form-floating" style="margin-left:-10px;">
                        <input required class="form-control" type="date" name="deadLine" id="deadLine"
                            placeholder="Dead Line" value="<?php echo $end_date; ?>">
                        <label for="" style="font-weight:bold;margin-top:3px;">Dead Line</label>
                    </div>


                </div>
                <div
                    style="display:flex;gap:10px;margin-top:-10px;border-top:1px solid #2E8B57;border-bottom:1px solid #2E8B57;">

                    <button type="submit" name="taskSubmitBtn" id="taskSubmitBtn" class="btn btn-success">Create
                        Task</button>

                    <a href="<?php echo BASE_URL . "/Admin/adminDashBoard.php"; ?>" id="projectBackBtn"
                        class="btn btn-warning" style="width:140px;color:black">Back</a>

                    <button type="submit" name="taskUpdateBtn" id="taskUpdateBtn" class="btn btn-info">Update</button>
                    <a href="<?php echo BASE_URL . "/Admin/projectForm.php"; ?>" id="projectUpdateCancelBtn"
                        class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <form action="" method="post" id="taskSearchForm">

        <input type="text" name="taskSearchBar" autocomplete="off" id="taskSearchBar" class="form-control"
            placeholder="Search Project">
        <button type="submit" name="taskSearchBtn" class="btn btn-success" hidden></button>

    </form>
    <div id="taskTable">
        <table class="table" style="width:750px;border:1px solid #2E8B57;">
            <thead>
                <tr id="taskTableHeader">
                    <th>S.No</th>
                    <th style="width:150px;">Project Name</th>
                    <th>Task</th>
                    <th>Assigned User</th>
                    <th>Dead Line</th>
                    <th>Status</th>
                    <th style=" text-align:right" hidden>Operations</th>
                </tr>
            </thead>
            <tbody id="taskTableBody" style="font-size:13px;font-weight:bolder">
                <?php if (isset($_SESSION['task_search_result']) && $_SESSION['task_search_result'] != "") { ?>
                    <?php $i = 1;
                    while ($taskData = $_SESSION['task_search_result']->fetch_assoc()) {
                        $project_data = $project_form_crud->projectDetails($con, $taskData['project_id'])->fetch_assoc();
                        $user_data = $user_form_crud->userDetailsById($con, $taskData['assigned_user_id']);
                        if (strtolower($taskData['task_status']) == 'not started') {
                            $status_color = "#E81224";
                        } elseif (strtolower($taskData['task_status']) == 'in progress') {

                            $status_color = "#FECA16";
                        } elseif (strtolower($taskData['task_status']) == 'completed') {

                            $status_color = "#16C20C";
                        }
                    ?>
                        <tr>
                            <td><?php echo  $i++ ?></td>
                            <td style="width:250px;"><?php echo $project_data['project_name']; ?></td>
                            <td style="width:160px;"><?php echo $taskData['task_name']; ?></td>
                            <td style="width:180px;"><?php echo $user_data['user_name']; ?>
                            </td>
                            <td style="width:120px;"><?php echo $taskData['dead_line']; ?></td>
                            <td style="width:120px;">
                                <div style="display:flex;gap:3px;">
                                    <div style="background-color: <?php echo $status_color; ?>;width:20px;height:20px;">
                                    </div>
                                    <span style="width:100px">
                                        <?php echo $taskData['task_status']; ?>
                                    </span>

                                </div>
                            </td>
                            <!-- <td style="display:flex;gap:2px;justify-content:flex-end" hidden>
                        <a style="width:45px;font-size:14px;"
                            href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?edit_id=<?php echo $taskData['project_id']; ?>"
                            class="btn btn-info">Edit</a>
                        <a style="width:60px;font-size:14px;"
                            href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?delete_id=<?php echo $taskData['project_id']; ?>"
                            class="btn btn-danger"
                            onclick="return confirm('Are You Sure Do You Want To Delete This Project')">Delete</a>
                    </td> -->
                        </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
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


    function triggerProjectNameIdHiddenBtn() {

        document.getElementById('project_name_id_hidden_btn').click();
    }
</script>

<?php ob_flush(); ?>