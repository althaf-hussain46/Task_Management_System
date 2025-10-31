<?php
ob_start();
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");

class TaskFormCRUD
{

    public function createTask($con, $taskDetails)
    {
        try {
            $con->begin_transaction();

            $createTaskQuery = "INSERT INTO task(project_id,task_name, task_description,assigned_user_id,
            priority_level,dead_line)
            VALUES('$taskDetails[project_name_id_hidden]','$taskDetails[taskName]', '$taskDetails[taskDescription]',
           '$taskDetails[assigningUserId]', '$taskDetails[taskPriority]','$taskDetails[deadLine]')";
            $result = $con->query($createTaskQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Task Created Successfully";
                header("Location:" . BASE_URL . "/Admin/taskManagement.php");
                exit;
            } else {
                $_SESSION['failure_notification'] = "Failed To Create Task";
            }
        } catch (Exception  $e) {
            $con->rollback();
            // $_SESSION['failure_notification']  = "All Fields Are Required";
            $_SESSION['failure_notification']  = $e;
            header("Location:" . BASE_URL . "/Admin/taskManagement.php");
            exit;
        }
    }
    public function taskDetails($con, $filter)
    {
        $fetchTaskQuery  = "SELECT*FROM task where task_name LIKE '%$filter%' OR task_status LIKE'%$filter%'";
        $result = $con->query($fetchTaskQuery);
        return $result;
    }

    public function taskDetailsByUserId($con, $user_id, $filter)
    {

        $fetchTaskQuery  = "SELECT ts.*, pr.*,prm.*, us.* 
        FROM task as ts
        INNER JOIN project as pr ON ts.project_id = pr.project_id
        INNER JOIN project_master as prm ON ts.project_id = prm.project_name_id
        INNER JOIN user as us ON ts.assigned_user_id  =  us.user_id 
        WHERE us.user_id = '$user_id' AND (prm.project_name LIKE '%$filter%' OR
        ts.task_name LIKE '%$filter%' OR us.user_name LIKE '%$filter%' OR ts.task_status LIKE '%$filter%')
        ORDER BY prm.project_name";
        $result = $con->query($fetchTaskQuery);
        return $result;
    }


    public function taskDetailsById($con, $id)
    {
        $fetchTaskByIdQuery  = "SELECT*FROM task WHERE task_id = '$id'";
        $result = $con->query($fetchTaskByIdQuery);
        return $result;
    }

    public function taskList($con, $filter, $fromDate, $toDate)
    {
        $fetchTaskQuery  = "SELECT ts.*,prm.*,pr.*,us.* 
        FROM task as ts
        INNER JOIN project as pr ON ts.project_id = pr.project_name_id
        INNER JOIN project_master as prm ON ts.project_id = prm.project_name_id
        INNER JOIN user as us ON ts.assigned_user_id  =  us.user_id 
        WHERE (ts.dead_line between '$fromDate' AND '$toDate')
        AND (prm.project_name LIKE '%$filter%' OR ts.task_name like '%$filter%' OR ts.task_status LIKE '%$filter%')";
        $result = $con->query($fetchTaskQuery);
        return $result;
    }
    public function taskListByUserId($con, $user_id, $filter, $fromDate, $toDate)
    {
        $fetchTaskQuery  = "SELECT ts.*,pr.*, us.* 
        FROM task as ts
        INNER JOIN user as us ON ts.assigned_user_id  =  us.user_id 
        INNER JOIN project as pr ON ts.project_id  =  pr.project_id 
        WHERE us.user_id = '$user_id' AND (ts.dead_line between '$fromDate' AND '$toDate') AND (pr.project_name like '%$filter%' OR ts.task_name like '%$filter%')";
        $result = $con->query($fetchTaskQuery);
        return $result;
    }

    public function totalTaskFilter($con, $value)
    {
        switch ($value) {
            case $value == 1;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE assigned_user_id = '$_SESSION[user_id]'";
                break;
            case $value == 2;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'Not Started'
                AND assigned_user_id = '$_SESSION[user_id]'";
                break;
            case $value == 3;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'In Progress'
                AND assigned_user_id = '$_SESSION[user_id]'";
                break;
            case $value == 4;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'Completed'
                AND assigned_user_id = '$_SESSION[user_id]'";
                break;
        };
        $result = $con->query($totalTask)->fetch_assoc();
        return $result;
    }

    public function totalTaskFilterAdmin($con, $value)
    {
        switch ($value) {
            case $value == 1;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE assigned_user_id";
                break;
            case $value == 2;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'Not Started'
                ";
                break;
            case $value == 3;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'In Progress'";
                break;
            case $value == 4;
                $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'Completed'";
                break;
        };
        $result = $con->query($totalTask)->fetch_assoc();
        return $result;
    }



    public function updateTask($con, $taskDetails)
    {
        try {
            extract($taskDetails);
            $con->begin_transaction();
            $updateTaskQuery = "UPDATE task SET task_name = '$taskName', task_description='$taskDescription',
            assigned_user_id = '$assigningUserId', priority_level = '$taskPriority', dead_line = '$deadLine'
            WHERE task_id = '$_SESSION[pro_id]'";
            $result = $con->query($updateTaskQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Task Updated";
                header("Location:" . BASE_URL . "/Admin/TaskForm.php");
                exit;
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Task Does Not Exist";
            header("Location:" . BASE_URL . "/Admin/TaskForm.php");
            exit;
        }
    }

    public function updateTaskStatus($con, $taskId, $taskStatus)
    {
        try {

            $con->begin_transaction();
            $updateTaskQuery = "UPDATE task SET task_status =  '$taskStatus'
            WHERE task_id = '$taskId'";
            $result = $con->query($updateTaskQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Task Status Updated";
                // header("Location:" . BASE_URL . "/User/viewTasks.php");
                // exit;
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Task Status Does Not Exist";
            header("Location:" . BASE_URL . "/User/viewTasks.php");
            exit;
        }
    }

    public function deleteTask($con, $id)
    {
        try {
            $con->begin_transaction();
            $deleteTaskQuery = "DELETE FROM Task WHERE Task_id = '$id'";
            $result = $con->query($deleteTaskQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Task Deleted";
                // header("Location:" . BASE_URL . "/Admin/TaskForm.php");
                // exit;
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Task Does Not Exist";
            header("Location:" . BASE_URL . "/Admin/TaskForm.php");
            exit;
        }
    }
}

?>
<?php
ob_flush();

?>