<style>

</style>

<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../Includes/adminNavbar.php");

// Each task includes:


// Task Title


// Description


// Assigned User


// Priority (Low / Medium / High)


// Deadline

if (isset($_POST['scheduleTask'])) {
    // extract($_POST);
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";
}
$taskFilter = false;
if (isset($_POST['showTaskBtn'])) {
    extract($_POST);
    echo "project name = " . $projectSelectionToFilterTask;
    $taskFilter = true;
} else {
}
?>
<div id="">


    <form action="" method="post">
        <h1>Task Management</h1>
        <hr>

        <div class="form-floating">

            <select name="projectSelection" id="projectSelection" class="form-control">
                <option value="TASK MANAGEMENT SYSTEM">TMS</option>
            </select>

        </div>
        <div class="form-floating">


            <input class=" form-control" type="text" name="taskTitle" id="taskTitle" placeholder="Task Title">
            <label for="">Task Title</label>
        </div>
        <div class="form-floating">
            <input class="form-control" type="text" name="taskDescription" id="taskDescription"
                placeholder=" Task Description">
            <label for="">Task Description</label>
        </div>
        <div class="form-floating">
            <select name="userSelection" id="userSelection" class="form-control">

                <option value="user1">user1</option>
                <option value="user2">user2</option>
            </select>
            <label for="">Select User</label>
        </div>
        <div class="form-floating">
            <select class="form-control" type="text" name="taskPriority" id="taskPriority">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
            <label for="">Task Priority</label>
        </div>
        <div class="form-control" style="display:flex;gap:10px;" id="taskStatus">
            <input type="radio" name="taskStatus" id="notStarted" checked value="Not Started">
            <label for="">Not Started</label>
            <input type="radio" name="taskStatus" id="inProgress" value="In Progress">
            <label for="">In Progress</label>
            <input type="radio" name="taskStatus" id="completed" value="Completed">
            <label for="">Completed</label>

        </div>
        <div class=" form-floating">
            <input class="form-control" type="date" name="taskDeadLine" id="taskDeadLine" placeholder="Task DeadLine">
            <label for="">Task DeadLine</label>
        </div>

        <button type="submit" class="btn btn-success" name="scheduleTask" id="scheduleTask">Schedule Task</button>
    </form>
</div>


<div id="showTaskListForm">
    <form action="" method="post">
        <div style="display:flex;gap:20px">
            <div class="form-floating">
                <select name="projectSelectionToFilterTask" id="projectSelectionToFilterTask" class="form-control">
                    <option value="TASK MANAGEMENT SYSTEM">TMS</option>
                </select>
                <label for="">Select Project</label>
            </div>
            <button type="submit" class="btn btn-primary" name="showTaskBtn" id="showTaskBtn">Show Task</button>
        </div>
    </form>
</div>




<div id="taskTableGrid">
    <div id="task">Task</div>
    <div id="description">Description</div>
    <div id="assignedUser">Assigned User</div>
    <div id="priority">Priority</div>
    <div id="deadline">Dead Line</div>
    <div id="status">Status</div>


    <?php

    if (isset($taskFilter) && $taskFilter == true) {
        $i = 1;
        while ($i <= 10) {
    ?>
    <div id="taskName">Task Name</div>
    <div id="descriptionDetails" style="height:80px;overflow-y:scroll">
    </div>
    <div id="assignedUserName">Assigned User Name</div>
    <div id="priorityLevel">Priority Level</div>
    <div id="deadlineLimit">Dead Line Limit</div>
    <div id="statusFlag">Status Flag</div>
    <?php $i++;
        }
    } ?>



</div>
<script>
window.onload = () => {
    let projectSelection = document.getElementById("projectSelection");
    if (projectSelection) {
        projectSelection.focus();
        projectSelection.select();
    }

}

document.getElementById("projectSelection").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let taskTitle = document.getElementById("taskTitle");
        if (taskTitle) {
            taskTitle.focus();
            taskTitle.select();
        }
    }

});



document.getElementById("taskTitle").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let taskDesc = document.getElementById("taskDescription");
        if (taskDesc) {
            taskDesc.focus();
            taskDesc.select();
        }
    }

});
document.getElementById("taskDescription").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let userSelect = document.getElementById("userSelection");
        if (userSelect) {
            userSelect.focus();
            userSelect.select();
        }
    }

})

document.getElementById("userSelection").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let taskPri = document.getElementById("taskPriority");
        if (taskPri) {
            taskPri.focus();
            taskPri.select();
        }
    }

})

document.getElementById("taskPriority").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let taskStatus = document.getElementById("notStarted");
        if (taskStatus) {
            taskStatus.focus();
            taskStatus.select();
        }
    }

})

document.getElementById("taskStatus").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let taskDeadLine = document.getElementById("taskDeadLine");
        if (taskDeadLine) {
            taskDeadLine.focus();
            taskDeadLine.select();
        }
    }

})

document.getElementById("taskDeadLine").addEventListener("keydown", (event) => {
    if (event.key == "Enter") {
        event.preventDefault();
        let scheduleTask = document.getElementById("scheduleTask");
        if (scheduleTask) {
            scheduleTask.focus();

        }
    }

})
</script>
<?php

include_once(DIR_URL . "../Includes/footer.php");
?>