<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/taskForm.php");


$task_view_data = new TaskFormCRUD();






?><style>
#taskListContainer {
    margin-top: 10px;
    height: 620px;
    box-shadow: seagreen 1px 5px 15px 5px;
    border-radius: 20px;

}



#taskTableDiv {

    display: flex;
    /* border: 1px solid #2E8B57; */
    justify-content: center;
    /* padding-top: 50px; */
    height: 320px;
    margin-top: 100px;
    overflow-y: scroll;
    /* background-color: white; */
    /* z-index: 50 !important; */


}


#taskTable {

    width: 1600px;
    border: 1px solid #2E8B57;
    height: 130px;


}





#taskTableHeader th {
    background-color: seagreen;
    height: 50px;

    position: sticky;
    z-index: 1;
    top: 0;
}
</style>

<?php
ob_start();

include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
include_once(DIR_URL . "../CRUD/taskForm.php");
include_once(DIR_URL . "../CRUD/user.php");
$get_task_data  = new TaskFormCRUD();
$project_form_crud = new ProjectFormCRUD();
$user_form_crud = new UserCRUD();
$get_user_projects_tasks_status = $get_task_data->taskDetails($con, "");



?>

<body>

    <div id="taskListContainer">

        <h1 style="text-align:center;letter-spacing:10px;"> USER PROJECT & TASK STATUS </h1>
        <hr style="color:#2E8B57;">
        <div style="background-color:white;position:absolute;top:239px;height:50px;width:1389px;"></div>
        <div id="taskTableDiv">
            <table class="table" id="taskTable">
                <thead id="taskTableHeader">
                    <tr>
                        <th>S.No</th>
                        <th style="text-align:center">User</th>
                        <th style="text-align:center">Project</th>
                        <th style="text-align:center">Task</th>
                        <th style="text-align:center">Status</th>
                    </tr>
                </thead>
                <?php if (isset($get_user_projects_tasks_status) && $get_user_projects_tasks_status != "") { ?>
                <tbody id="taskTableBody">
                    <?php $i = 1;
                        while ($taskData = $get_user_projects_tasks_status->fetch_assoc()) {
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
                        <td style="width:10px;border:1px solid seagreen"><?php echo  $i++ ?></td>
                        <td style="text-align:center;border:1px solid seagreen">
                            <?php echo $user_data['user_name']; ?></td>
                        <td style="text-align:center;border:1px solid seagreen;width:520px">
                            <?php echo ($project_data['project_name'] != "") ? $project_data['project_name'] : "X"; ?>
                        </td>
                        <td style="text-align:center;border:1px solid seagreen;width:300px;">
                            <?php echo ($taskData['task_name'] != "") ? $taskData['task_name'] : "X"; ?>
                        </td>
                        <td>
                            <div style="display:flex;gap:5px;justify-content:center">
                                <div style="width:20;height:20px;background-color:<?php echo $status_color; ?>"></div>
                                <span style="width:90px;"><?php echo $taskData['task_status']; ?></span>
                            </div>
                        </td>

                        <?php } ?>
                    </tr>


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