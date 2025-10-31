<?php
ob_start();
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
class ProjectFormCRUD
{
    public function createProjectMaster($con, $projectDetails)
    {

        try {
            $con->begin_transaction();

            $createProjectQuery = "INSERT INTO project_master(project_name, project_description)
            VALUES('$projectDetails[projectName]', '$projectDetails[projectDescription]')";
            $result = $con->query($createProjectQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Project Created Successfully";
                header("Location:" . BASE_URL . "/Admin/projectMaster.php");
                exit;
            } else {
                $_SESSION['failure_notification'] = "Failed To Create Project";
            }
        } catch (Exception $e) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Project Name Already Exist";
            // $_SESSION['failure_notification']  = "$e";
            header("Location:" . BASE_URL . "/Admin/projectMaster.php");
            exit;
        }
    }
    public function assignProject($con, $projectDetails)
    {
        try {
            $con->begin_transaction();
            $check_project_user_exist = "SELECT us.user_name, pr.project_name_id,prm.project_name
            FROM user as us
            INNER JOIN project as pr ON us.user_id = pr.assigned_user_id
            INNER JOIN project_master as prm ON pr.project_name_id = prm.project_name_id
             WHERE prm.project_name_id = '$_SESSION[project_name_id]'
                AND pr.assigned_user_id = '$projectDetails[assigningUserId]'";


            $result_project_user_exist = $con->query($check_project_user_exist);

            if ($result_project_user_exist->num_rows >= 1) {
                $_SESSION['failure_notification'] = "Already User Assigned To This Project";
            } else {
                $assignProjectQuery = "INSERT INTO project(project_name_id, start_date, end_date,
            assigned_user_id)
            VALUES('$_SESSION[project_name_id]',
            '$projectDetails[startDate]','$projectDetails[endDate]',
            '$projectDetails[assigningUserId]')";
                $result = $con->query($assignProjectQuery);
                if ($result) {
                    $con->commit();
                    $_SESSION['success_notification'] = "Project Created Successfully";
                    header("Location:" . BASE_URL . "/Admin/projectForm.php");
                    exit;
                } else {
                    $_SESSION['failure_notification'] = "Failed To Create Project";
                }
            }
        } catch (Exception $e) {
            $con->rollback();
            $_SESSION['failure_notification']  = "All Fields Are Required";
            // $_SESSION['failure_notification']  = "$e";
            header("Location:" . BASE_URL . "/Admin/projectForm.php");
            exit;
        }
    }

    public function projectMasterDetails($con, $filter)
    {
        $fetchProjectQuery  = "SELECT*From project_master
        WHERE project_name LIKE '%$filter%' OR project_description LIKE '%$filter%'";
        $result = $con->query($fetchProjectQuery);
        return $result;
    }


    public function projectDetails($con, $filter)
    {
        $fetchProjectQuery  = "SELECT pr.*, prm.*, us.* 
        FROM project as pr
        INNER JOIN project_master as prm ON pr.project_name_id = prm.project_name_id
        INNER JOIN user as us ON pr.assigned_user_id  =  us.user_id 
        WHERE prm.project_name like '%$filter%' OR us.user_name LIKE '%$filter%'
        OR pr.project_id ='$filter' OR us.user_id='$filter'";
        $result = $con->query($fetchProjectQuery);
        return $result;
    }

    public function projectNameList($con)
    {
        $fetchProjectQuery  = "select distinct(project_name),project_name_id from
        (select us.user_name,prm.project_name_id, prm.project_name
        from project_master as prm
        inner join project as pr on prm.project_name_id = pr.project_name_id
        inner join user as us on pr.assigned_user_id = us.user_id) as t1;";

        $result = $con->query($fetchProjectQuery);

        return $result;
    }

    public function projectMasterDetailsById($con, $id)
    {
        $fetchProjectMasterByIdQuery  = "SELECT*FROM project_master WHERE project_name_id = '$id'";
        $result = $con->query($fetchProjectMasterByIdQuery);
        return $result;
    }


    public function projectDetailsById($con, $id)
    {
        $fetchProjectByIdQuery  = "SELECT pr.*,prm.*,us.*
        FROM project as pr
        INNER JOIN project_master as prm ON pr.project_name_id = prm.project_name_id
        INNER JOIN user as us ON pr.assigned_user_id = us.user_id
        WHERE pr.project_name_id = '$id'";
        $result = $con->query($fetchProjectByIdQuery);
        return $result;
    }


    public function totalProjectsFilter($con, $value)
    {
        $totalProjects = "SELECT COUNT(*) as total_count FROM project WHERE assigned_user_id = '$_SESSION[user_id]'";

        // switch ($value) {
        //     case $value == 1;
        //         $totalTask = "SELECT COUNT(*) as total_count FROM projects WHERE assigned_user_id = '$_SESSION[user_id]'";
        //         break;
        //     case $value == 2;
        //         $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'Not Started'
        //         AND assigned_user_id = '$_SESSION[user_id]'";
        //         break;
        //     case $value == 3;
        //         $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'In Progress'
        //         AND assigned_user_id = '$_SESSION[user_id]'";
        //         break;
        //     case $value == 4;
        //         $totalTask = "SELECT COUNT(*) as total_count FROM task WHERE task_status = 'Completed'
        //         AND assigned_user_id = '$_SESSION[user_id]'";
        //         break;
        // };
        $result = $con->query($totalProjects)->fetch_assoc();
        return $result;
    }

    public function totalProjectsFilterAdmin($con)
    {
        $totalProjects = "SELECT COUNT(*) as total_count FROM project_master";
        $result = $con->query($totalProjects)->fetch_assoc();
        return $result;
    }

    public function totalProjectsAssigned($con)
    {
        $totalAssignedProjects = "SELECT COUNT(*) as assigned_projects_total From (SELECT DISTINCT(project_name_id) FROM project) AS tb1;";
        $result = $con->query($totalAssignedProjects)->fetch_assoc();
        return $result;
    }

    public function totalProjectsUnassigned($con)
    {

        $totalUnassignedProjects = "select count(*) as unassigned_project_count from
        (select prm.project_name_id,prm.project_name,pr.project_id
        from project_master as prm
        left join project as pr on prm.project_name_id = pr.project_name_id
        where pr.project_id is null) as t1;";
        $result = $con->query($totalUnassignedProjects)->fetch_assoc();
        return $result;
    }
    public function projectList($con, $filter, $fromDate, $toDate)
    {
        $fetchProjectQuery  = "SELECT pr.*,prm.*, us.* 
        FROM project as pr
        INNER JOIN project_master as prm ON pr.project_name_id = prm.project_name_id
        INNER JOIN user as us ON pr.assigned_user_id  =  us.user_id 
        WHERE  (pr.start_date between '$fromDate' AND '$toDate') AND (prm.project_name like '%$filter%' OR us.user_name LIKE '%$filter%')";
        $result = $con->query($fetchProjectQuery);
        return $result;
    }

    public function updateProjectMaster($con, $projectMasterDetails)
    {
        try {
            extract($projectMasterDetails);
            $con->begin_transaction();
            $updateProjectQuery = "UPDATE project_master SET project_name = '$projectName', project_description='$projectDescription'
            WHERE project_name_id = '$_SESSION[project_master_id]'";
            $result = $con->query($updateProjectQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Project Master Updated";
                header("Location:" . BASE_URL . "/Admin/projectMaster.php");
                exit;
            }
        } catch (Exception $e) {
            $con->rollback();
            // $_SESSION['failure_notification']  = "Project Does Not Exist";
            $_SESSION['failure_notification']  = "$e";
            header("Location:" . BASE_URL . "/Admin/projectMaster.php");
            exit;
        }
    }



    public function updateProject($con, $projectDetails)
    {
        try {
            extract($projectDetails);
            $con->begin_transaction();
            $updateProjectQuery = "UPDATE project SET project_name_id = '$_SESSION[project_name_id]',
            start_date = '$startDate', end_date = '$endDate', assigned_user_id = '$assigningUserId'
            WHERE project_id = '$_SESSION[pro_id]'";
            $result = $con->query($updateProjectQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Project Updated";
                header("Location:" . BASE_URL . "/Admin/projectForm.php");
                exit;
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Project Does Not Exist";
            header("Location:" . BASE_URL . "/Admin/projectForm.php");
            exit;
        }
    }


    public function deleteProjectMaster($con, $id)
    {
        try {
            $con->begin_transaction();
            $deleteProjectMasterQuery = "DELETE FROM project_master WHERE project_name_id = '$id'";
            $result = $con->query($deleteProjectMasterQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Project Deleted";
                header("Location:" . BASE_URL . "/Admin/projectMaster.php");
                exit;
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Project Does Not Exist";
            header("Location:" . BASE_URL . "/Admin/projectMaster.php");
            exit;
        }
    }


    public function deleteProject($con, $id)
    {
        try {
            $con->begin_transaction();
            $deleteProjectQuery = "DELETE FROM project WHERE project_id = '$id'";
            $result = $con->query($deleteProjectQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Project Deleted";
                header("Location:" . BASE_URL . "/Admin/projectForm.php");
                exit;
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "Project Does Not Exist";
            header("Location:" . BASE_URL . "/Admin/projectForm.php");
            exit;
        }
    }


    public function totalAssignedProjects($con)
    {


        $totalAssignedProject = "select count(*) as assigned_project_count from (select distinct(project_name)
                            from (select us.user_id,us.user_name,pr.project_name_id,prm.project_name,ts.task_name
                            from user as us
                            inner join project as pr on pr.assigned_user_id = us.user_id
                            inner join project_master as prm on pr.project_name_id = prm.project_name_id
                            inner join task as ts on us.user_id = ts.assigned_user_id) as t1) as t2";
        $result = $con->query($totalAssignedProject)->fetch_assoc();
        return $result;
    }

    public function totalPartialAssignedProject($con)
    {

        $totalPartialAssignedProjectQuery = "select count(*) as partial_assigned_project_count from 
            (select us.user_id,us.user_name,pr.project_name_id,prm.project_name,ts.task_name
            from user as us
            left join project as pr on pr.assigned_user_id = us.user_id
            inner join project_master as prm on pr.project_name_id = prm.project_name_id
            left join task as ts on us.user_id = ts.assigned_user_id
            where ts.task_name is null or ts.task_name = 'NULL') as t1;";
        $result = $con->query($totalPartialAssignedProjectQuery)->fetch_assoc();
        return $result;
    }

    public function totalUnassignedProjects($con)
    {

        $totalUnassignedProjectsQuery = "select count(*) as unassigned_projects_count from 
    (select us.user_id,us.user_name,pr.project_name_id,prm.project_name,ts.task_name
    from user as us
    left join project as pr on pr.assigned_user_id = us.user_id
    left join project_master as prm on pr.project_name_id = prm.project_name_id
    left join task as ts on us.user_id = ts.assigned_user_id
    where (prm.project_name is null or prm.project_name = 'null') and 
    (ts.task_name is null or ts.task_name = 'null')) as t1;";
        $result = $con->query($totalUnassignedProjectsQuery)->fetch_assoc();
        return $result;
    }

    public function getUserProjectTaskStatus($con)
    {
        $fetchUserWorking = "select 
    us.user_id,us.user_name,pr.project_name_id,prm.project_name,ts.task_name
    from user as us
    left join project as pr on pr.assigned_user_id = us.user_id
    left join project_master as prm on pr.project_name_id = prm.project_name_id
    left join task as ts on us.user_id = ts.assigned_user_id;";
        $result =  $con->query($fetchUserWorking);
        return $result;
    }
}
