<?php
include_once("../Config/config.php");
// include_once(DIR_URL . "../Connection/dbConnection.php");


class  UserCRUD
{

    public function createUser($con, $userData)
    {


        try {

            $con->begin_transaction();

            $createUserQuery  = "INSERT INTO user (user_name,user_email,user_password)
        VALUES('$userData[signUpUserName]','$userData[signUpUserEmail]','$userData[signUpUserPassword]')";
            $result = $con->query($createUserQuery);

            if ($result) {
                $con->commit();
                $_SESSION['success_notification'] = "Account Created Successfully";
                header("Location:" . BASE_URL . "/User/userLogin.php");
                exit;
            }
        } catch (Exception $e) {
            $con->rollback();
            $_SESSION['failure_notification'] = "Email Id Already Exist";
            header("Location:" . BASE_URL . "/User/userLogin.php");
            exit;
        }
    }

    public function userDetails($con)
    {
        $fetchUserDetails = "SELECT*FROM user";
        $result = $con->query($fetchUserDetails);
        return $result;
    }
    
    public function userDetailsByProjects($con,$project_id)
    {
        $fetchUserDetails = "select us.user_id, us.user_name,prm.project_name
                            from user as us
                            inner join project as pr on us.user_id = pr.assigned_user_id
                            inner join project_master as prm on pr.project_name_id = prm.project_name_id
                            where pr.project_name_id = '$project_id';";
        $result = $con->query($fetchUserDetails);
        return $result;
    }

    public function totalUsers($con){
        $fetchTotalUsers  = "SELECT COUNT(*) as total_user FROM user";
        $result = $con->query($fetchTotalUsers)->fetch_assoc();
        return $result;
    }
    
    public function assignedUsers($con){
        // $fetchTotalAssignedUsers = "SELECT"
    }


    public function userDetailsById($con, $id)
    {
        $fetchUserDetails = "SELECT*FROM user WHERE user_id = '$id'";
        $result = $con->query($fetchUserDetails)->fetch_assoc();
        return $result;
    }

    public function updateUser($con, $userData)
    {


        try {

            $con->begin_transaction();
            $_SESSION['user_name'] = $userData['user_profile_name'];
            $_SESSION['user_email'] = $userData['user_profile_email'];
            $_SESSION['user_password'] = $userData['user_profile_password'];
            $updateUserQuery  = "UPDATE user SET user_name = '$userData[user_profile_name]',
            user_email = '$userData[user_profile_email]', user_password = '$userData[user_profile_password]'
            WHERE user_id = '$_SESSION[user_id]' AND user_email != '$userData[user_profile_email]'";
            $result = $con->query($updateUserQuery);

            if ($result) {
                $con->commit();

                $_SESSION['success_notification'] = "Profile Updated Successfully";
                header("Location:" . BASE_URL . "/User/userDashBoard.php");
                exit;
            }
        } catch (Exception $e) {
            $con->rollback();
            $_SESSION['failure_notification'] = "Email Id Already Exist";

            header("Location:" . BASE_URL . "/User/userDashBoard.php");
            exit;
        }
    }


    public function checkUserExist($conn, $userData)
    {

        extract($userData);
        // echo $userEmail;
        // echo $userPassword;
        $fetchUserDetails = "SELECT*FROM user WHERE user_email = '$userEmail' AND user_password = '$userPassword'";
        $result = $conn->query($fetchUserDetails)->fetch_assoc();

        if (isset($result['user_email']) && $result['user_email'] != "") {
            $_SESSION['user_id'] = $result['user_id'];
            $_SESSION['user_name'] =  $result['user_name'];
            $_SESSION['user_email'] =  $result['user_email'];
            $_SESSION['user_password'] =  $result['user_password'];
            header("Location:" . BASE_URL . "/User/userDashBoard.php");
        } else {
            $_SESSION['failure_notification'] = "User Does Not Exist";
        }
    }
}