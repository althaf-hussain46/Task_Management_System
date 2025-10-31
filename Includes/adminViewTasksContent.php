<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/taskForm.php");


$task_view_data = new TaskFormCRUD();






?><style>
    #taskListContainer {
        margin-top: 10px;
        /* border: 1px solid black; */
        height: 620px;
        box-shadow: seagreen 1px 5px 15px 5px;
        border-radius: 20px;

    }



    #taskTableDiv {


        /* border: 1px solid #2E8B57; */
        /* padding-top: 50px; */
        height: 380px;
        margin-top: 100px;
        overflow-y: scroll;
        /* background-color: white; */
        /* z-index: 50 !important; */


    }


    #taskTable {
        /* margin-top: -50px; */
        width: 1379px;
        border: 1px solid #2E8B57;
        height: 30px;


    }





    #taskTableHeader th {
        background-color: seagreen;
        height: 50px;

        position: sticky;
        z-index: 1;
        top: 0;
    }

    /* #taskTableBody:hover {
    background-color: black;
} */

    #taskSearchForm {
        display: flex;
        /* justify-content: space-between; */
        gap: 41px;
        position: absolute;
        top: 215px;
        left: 280px;
        width: 1385px;
        height: 72px;
        background-color: white;
        /* border: 1px solid black; */

    }

    #fromDate,
    #toDate {
        width: 220px;
        font-size: large;
        font-weight: bolder;
        border: 1px solid seagreen;
    }

    #taskSearchBar {
        /* margin-left: 18px; */
        /* margin-top: 15px; */
        padding-left: 50px;
        font-size: 15px;
        font-weight: bold;
        width: 260px;
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


    #taskSearchBtn {

        height: 55px;
        width: 180px;
    }


    /* #taskSearchBar:focus {
    border-radius: 10px;
    border: 1px solid #2E8B57;
    width: 240px;
    padding-left: 50px;
    border: none;
    color: white;
} */
</style>

<?php
ob_start();

include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
include_once(DIR_URL . "../CRUD/taskForm.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../Functions/date_functions.php");

$task_view_list = new TaskFormCRUD();
$task_status_update = new TaskFormCRUD();
$project_form_crud = new ProjectFormCRUD();
$user_form_crud = new UserCRUD();

if (isset($_POST['updateTaskStatusBtn'])) {


    extract($_POST);
    $task_status_update->updateTaskStatus($con, $taskId, $taskStatusSelection);
}

if (isset($_POST['taskSearchBtn'])) {
    if ($_POST['fromDate'] != "" && $_POST['toDate'] != "") {

        $_SESSION['project_task_search_result'] = $task_view_list->taskList(
            $con,
            $_POST['taskSearchBar'],
            $_POST['fromDate'],
            $_POST['toDate']
        );
    } else {

        $_SESSION['project_task_search_result'] = $task_view_list->taskDetails(
            $con,
            $_POST['taskSearchBar']
        );
    }
} else {

    $_SESSION['project_task_search_result'] = $task_view_list->taskDetails(
        $con,
        ""

    );
}

?>

<body>

    <div id="taskListContainer">
        <h1 style="text-align:center"> Task List </h1>
        <hr style="color:#2E8B57;">
        <form action="" method="post" id="taskSearchForm">
            <div class="form-floating">
                <input type="date" name="fromDate" id="fromDate" class="form-control">
                <label for="">From Date</label>
            </div>

            <div class="form-floating">
                <input type="date" name="toDate" id="toDate" class="form-control">
                <label for="">To Date</label>
            </div>
            <div style="display:flex;gap:20px;justify-content:flex-end;
            width:830px;">
                <input type="text" name="taskSearchBar" autocomplete="off" id="taskSearchBar" class="form-control"
                    placeholder="Search Project/Task/Status">
                <button type="submit" name="taskSearchBtn" id="taskSearchBtn" class="btn btn-success">Search</button>

            </div>

        </form>

        <div id="taskTableDiv">
            <table class="table" id="taskTable">
                <thead id="taskTableHeader">
                    <tr>
                        <th>S.No</th>
                        <th style="width:250px">Project Name</th>
                        <th style="width:300px;">Project Description</th>
                        <th>Start Date </th>
                        <th>End Date</th>
                        <th>Assigned To</th>
                        <th style="width:300px;">Task</th>
                        <th style="width:300px;">Task Description</th>
                        <th>Priority</th>
                        <th>Dead Line</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <?php if (isset($_SESSION['project_task_search_result']) && $_SESSION['project_task_search_result'] != "") { ?>
                    <tbody id="taskTableBody">

                        <?php $i = 1;

                        while ($project_task_data = $_SESSION['project_task_search_result']->fetch_assoc()) {
                            $project_data = $project_form_crud->projectDetails($con, $project_task_data['project_id'])->fetch_assoc();
                            $user_data = $user_form_crud->userDetailsById($con, $project_task_data['assigned_user_id']);
                        ?>
                            <tr>
                                <td><?php echo  $i++ ?></td>
                                <td style="width:180px;"><?php echo $project_data['project_name']; ?></td>
                                <td><textarea readonly name="" rows="4" cols="26" style="border:none"
                                        id=""><?php echo $project_data['project_description']; ?></textarea></td>
                                <td style="width:250px;"><?php echo $project_data['start_date']; ?></td>
                                <td style="width:250px;"><?php echo $project_data['end_date']; ?></td>
                                <td style="width:250px;"><?php echo $user_data['user_name']; ?></td>
                                <td style="width:180px;"><?php echo $project_task_data['task_name']; ?></td>
                                <td style="width:180px;"><textarea name="" rows="4" cols="20" style="border:none"
                                        id=""><?php echo $project_task_data['task_description']; ?></textarea></td>
                                <td><?php echo $project_task_data['priority_level']; ?>
                                </td>
                                <td style="width:250px;"><?php echo $project_task_data['dead_line']; ?>
                                </td>

                                <?php if ($project_task_data['task_status'] == "Not Started") { ?>
                                    <td style="width:240px;color:red;font-weight:bold;">
                                        <?php echo $project_task_data['task_status']; ?></span>
                                    </td>
                                <?php } elseif ($project_task_data['task_status'] == "In Progress") { ?>
                                    <td style="width:180px;color:orange;font-weight:bold;">
                                        <?php echo $project_task_data['task_status']; ?></span>
                                    </td>

                                <?php } elseif ($project_task_data['task_status'] == "Completed") { ?>
                                    <td style="width:180px;color:green;font-weight:bold;">
                                        <?php echo $project_task_data['task_status']; ?></span>
                                    </td>
                                <?php } ?>
                            </tr>

                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>

        </div>
    </div>


</body>
<script>
    function getTaskId(taskId) {
        document.getElementById('taskId').value = taskId;
    }
</script>

<?php ob_flush(); ?>
<?php
include_once(DIR_URL . "../Includes/footer.php");
?>