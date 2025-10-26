<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
class ProjectFormCRUD
{

    public function createProject($con, $projectDetails)
    {
        try {
            $con->begin_transaction();

            $createProjectQuery = "INSERT INTO project(project_name, description, start_date, end_date,
            assigned_user_id)
            VALUES('$projectDetails[projectName]', '$projectDetails[projectDescription]',
            '$projectDetails[startDate]','$projectDetails[endDate]',
            '$projectDetails[assigningUserId]')";
            $result = $con->query($createProjectQuery);
            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Project Created Successfully";
                header("Location:" . BASE_URL . "/Admin/projectForm.php");
                exit;
            } else {
                $_SESSION['failure_notification'] = "Failed To Create Project";
            }
        } catch (Exception) {
            $con->rollback();
            $_SESSION['failure_notification']  = "All Fields Are Required";
            header("Location:" . BASE_URL . "/Admin/projectForm.php");
            exit;
        }
    }
    public function projectDetails($con, $filter)
    {
        $fetchProjectQuery  = "SELECT pr.*, us.* 
        FROM project as pr
        INNER JOIN user as us ON pr.assigned_user_id  =  us.user_id 
        WHERE pr.project_name like '%$filter%'";
        $result = $con->query($fetchProjectQuery);
        return $result;
    }


    public function projectDetailsById($con, $id)
    {
        $fetchProjectByIdQuery  = "SELECT*FROM project WHERE project_id = '$id'";
        $result = $con->query($fetchProjectByIdQuery);
        return $result;
    }


    public function updateProject($con, $projectDetails)
    {
        try {
            extract($projectDetails);
            $con->begin_transaction();
            $updateProjectQuery = "UPDATE project SET project_name = '$projectName', description='$projectDescription',
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
}