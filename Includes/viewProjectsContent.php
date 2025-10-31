<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/taskForm.php");


$task_view_data = new TaskFormCRUD();






?><style>
#tableHeader {
    display: grid;
    margin-left: 10px;
    width: 1380px;
    grid-template-columns: 120px 310px 320px 250px 250px 100px;
    /* padding: 10px; */
    background-color: dodgerblue;
    z-index: 1;
}

#tableHeader div {
    /* padding: 10px; */
    color: white;
    font-size: larger;
    font-weight: bolder;
}





#projectCollapsibleContainer {
    display: grid;
    grid-template-columns: 120px 260px 410px 250px 200px;
    /* gap: 3px;
    padding: 10px; */
    background-color: #DAEDFF;
    border: 1px solid #DAEDFF;
    /* border-left: 1px solid seagreen;
    border-bottom: 1px solid seagreen;
    border-right: 1px solid seagreen; */

}



#collapseTaskItems {

    display: grid;
    margin-left: 120px;
    grid-template-columns: 300px 380px 240px 175px 125px;
    /* gap: 3px;
    /* padding: 10px; */
    /* background-color: dodgerblue; */
}



#CollapseTaskItems:hover {
    background-color: #1E90FF;
    /* background-color: white; */
}

/* #collapseTaskContainer {

    display: grid;
    grid-template-columns: 345px 1fr 1fr 1fr 1fr;
    gap: 3px;
    padding: 10px;
    background-color: dodgerblue;
}

 */

#taskListContainer {
    margin-top: 1px;
    /* border: 1px solid black; */
    height: 643px;
    box-shadow: dodgerblue 1px 5px 15px 2px;
    border-radius: 20px;

}
</style>


<?php


include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/taskForm.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../Functions/date_functions.php");

$task_view_list = new TaskFormCRUD();
$task_status_update = new TaskFormCRUD();
if (isset($_POST['updateTaskStatusBtn'])) {


    extract($_POST);
    $task_status_update->updateTaskStatus($con, $taskId, $taskStatusSelection);
}

if (isset($_POST['taskSearchBtn'])) {
    if ($_POST['fromDate'] != "" && $_POST['toDate'] != "") {

        $_SESSION['project_task_search_result'] = $task_view_list->taskListByUserId(
            $con,
            $_SESSION['user_id'],
            $_POST['taskSearchBar'],
            $_POST['fromDate'],
            $_POST['toDate']
        );
    } else {

        $_SESSION['project_task_search_result'] = $task_view_list->taskDetailsByUserId(
            $con,
            $_SESSION['user_id'],
            $_POST['taskSearchBar']
        );
    }
} else {

    $_SESSION['project_task_search_result'] = $task_view_list->taskDetailsByUserId(
        $con,
        $_SESSION['user_id'],
        ""
    );
}

?>

<body>

    <div id="taskListContainer">
        <h1 style="text-align:center"> Projects & Tasks </h1>
        <hr>
        <div id="tableHeader">
            <div id="header1">S.No</div>
            <div id="header2">Project/Task</div>
            <div id="header3">Description(Project/Task)</div>
            <div id="header4">Start Date/Priority</div>
            <div id="header5">End Date/Dead Line</div>
            <div id="header6">Status</div>
        </div>
        <div style="max-height:450px;overflow-y:scroll;margin-top:-10px;">
            <?php
            if (isset($_SESSION['project_task_search_result']) && $_SESSION['project_task_search_result'] != "") { ?>
            <?php

                $fetch_project_name = "select prm.project_name_id, prm.project_name,prm.project_description,
                pr.start_date, pr.end_date
                from project_master as prm
                inner join project as pr on prm.project_name_id = pr.project_name_id
                where pr.assigned_user_id = '$_SESSION[user_id]'
                ";
                $fetch_project_name_result = $con->query($fetch_project_name);
                $project_task_details = $_SESSION['project_task_search_result'];
                $i = 1;
                $j = 1;
                foreach ($fetch_project_name_result as $project_data) {
                    $fetch_task_details = "select*from task where project_id = $project_data[project_name_id]
                            and assigned_user_id = '$_SESSION[user_id]'";
                    $fetch_task_details_result = $con->query($fetch_task_details);
                ?>
            <div id="projectCollapsibleContainer" data-bs-toggle="collapse"
                data-bs-target="#collapseTaskContainer<?php echo $i; ?>">
                <div><?php echo $i; ?></div>
                <div>

                    <?php echo $project_data['project_name']; ?>
                </div>
                <div><?php echo $project_data['project_description']; ?> </div>
                <div><?php echo $project_data['start_date']; ?> </div>
                <div><?php echo $project_data['end_date']; ?> </div>

            </div>
            <?php foreach ($fetch_task_details_result as $task_data) {

                        if (strtolower($task_data['task_status']) == 'not started') {
                            $status_color = "#E81224";
                        } elseif (strtolower($task_data['task_status']) == 'in progress') {

                            $status_color = "#FECA16";
                        } elseif (strtolower($task_data['task_status']) == 'completed') {

                            $status_color = "#16C20C";
                        }
                    ?>

            <div class="collapse" id="collapseTaskContainer<?php echo $i; ?>">
                <div id="collapseTaskItems">
                    <div><?php echo $task_data['task_name']; ?>
                    </div>
                    <div><?php echo $task_data['task_description']; ?> </div>
                    <div><?php echo $task_data['priority_level']; ?> </div>
                    <div><?php echo $task_data['dead_line']; ?> </div>
                    <div style="color:<?php echo $status_color; ?>;display:flex;justify-content:center">
                        <span style="background-color: <?php echo $status_color; ?>;width:20px;height:20px"></span>

                    </div>

                </div>
            </div>
            <?php }
                    $i++;
                }
            } ?>
        </div>
    </div>

</body>
<script>
function getTaskId(taskId) {
    document.getElementById('taskId').value = taskId;
}
</script>
<?php

include_once(DIR_URL . "../Includes/footer.php");
?>