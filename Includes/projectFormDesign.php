<style>
#projectTable {
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

#projectName {
    border: 1px solid #2E8B57;
    margin-left: -20px;
    font-size: 15px;
    font-weight: bold;
}

#projectDescription {
    font-size: 15px;
    font-weight: bold;
    text-align: left;
    border: 1px solid #2E8B57;
}

#assigningUserId {

    width: 237px;
    margin-left: -10px;
    padding-top: 10px;
    font-size: 15px;
    font-weight: bold;
    border: 1px solid #2E8B57;
}

#projectTableHeader {
    position: sticky;
    z-index: 1;
    top: 0;

}

#projectTableHeader th {

    background-color: seagreen;
}



#projectSearchForm {
    position: absolute;
    top: 230px;
    right: 48px;
    width: 760px;
    height: 50px;
    /* border: 1px solid black; */
    background-color: white;
    z-index: 1;
}



#projectSearchBar {
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

#projectSearchBar:focus {
    border-radius: 10px;

    border: 1px solid #2E8B57;
    width: 220px;
    padding-left: 50px;
    border: none;
    /* color: white; */

}

#projectUpdateBtn {
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
    background-color: orange !important;
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

#startDate,
#endDate {
    /* font-size: medium; */
    font-weight: 700;
    border: 1px solid #2E8B57;
}
</style>

<?php
ob_start();
// include_once("../Config/config.php");
// include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../Functions/date_functions.php");

$project_form_crud = new ProjectFormCRUD();
$userDetails = new UserCRUD();
$date_methods = new DateFunctions();

$project_master = new ProjectFormCRUD();

$project_name_list = $project_master->projectMasterDetails($con, "");
$pro_name_edit_id = "";
$pro_name_id = "";
$pro_name = "";
$pro_desc = "";
$pro_description = "";
$pro_desc_edit = "";
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


    $project_form_crud->assignProject($con, $_POST);
}

if (isset($_POST['projectSearchBtn'])) {
    if ($_POST['projectSearchBar'] != "") {

        $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, $_POST['projectSearchBar']);
    } else {
        $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, "");
    }
} else {

    $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, "");
}
if (isset($_GET['delete_id'])) {
    extract($_GET);
    $project_form_crud->deleteProject($con, $delete_id);
}
if (isset($_POST['searchProjectNameHiddenBtn'])) {
    // projectName

    extract($_POST);


    $result = $project_master->projectMasterDetailsById($con, $projectName)->fetch_assoc();
    $pro_name_id   = $result['project_name_id'];
    $pro_name = $result['project_name'];
    $pro_desc = $result['project_description'];
    $_SESSION['project_name_id'] = $result['project_name_id'];
    $_SESSION['project_name'] = $result['project_name'];
}


if (isset($_GET['edit_id'])) {
    extract($_GET);
    $project_data_by_id = $project_form_crud->projectDetailsById($con, $edit_id)->fetch_assoc();
    $pro_name_edit_id = $project_data_by_id['project_name_id'];
    $pro_name_edit = $project_data_by_id['project_name'];
    $pro_desc_edit = $project_data_by_id['project_description'];
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
    <!--  -->
    <div id="projectFormDiv">
        <form action="" method="post" style="position:absolute;top:220px;left:290px;">
            <h5 style="font-weight:bolder">Project Details</h5>
            <div style="display:flex;gap:10px;border-right:1px solid #2E8B57;width:610px;">
                <div class="form-floating" style="width:300px;">

                    <select required onchange="setProjectDescription()" name="projectName" id="projectName"
                        class="form-control" placeholder="Project Name">
                        <option value="">-- Select Project --</option>
                        <?php
                        $pro_id = "";
                        while ($project_master_data = $project_name_list->fetch_assoc()) {
                            if ($pro_name_id != "") {
                                $pro_id = $pro_name_id;
                            } elseif ($pro_name_edit_id != "") {
                                $pro_id = $pro_name_edit_id;
                            }
                        ?>
                        <option value="<?php echo $project_master_data['project_name_id']; ?>" <?php ?> <?php  ?>
                            <?php echo ($pro_id == $project_master_data['project_name_id']) ? "selected" : "" ?>>

                            <?php echo $project_master_data['project_name']; ?>
                        </option>
                        <?php } ?>
                    </select>
                    <label for="" style=" margin-left:-10px">Project Name</label>

                </div>
                <button type="submit" style="width:50px;height:50px;" name="searchProjectNameHiddenBtn"
                    id="searchProjectNameHiddenBtn" class="form-control" hidden>Hidden Submit</button>
            </div>
        </form>

        <form action="" method="post" id="projectForm" style="padding-left:10px;">
            <h1 style=" text-align:center;letter-spacing:10px;">ASSIGN PROJECT</h1>
            <hr>
            <div style="width:620px;border-right:1px solid #2E8B57;margin-top:150px;">
                <?php

                if ($pro_desc != "") {
                    $pro_description = $pro_desc;
                } elseif ($pro_desc_edit != "") {
                    $pro_description = $pro_desc_edit;
                }
                ?>
                <h5 style="font-weight:bolder">Description</h5>
                <textarea readonly class="form-control" name="projectDescription" id="projectDescription" rows="5"
                    cols="5" placeholder="Project Description"><?php echo $pro_description; ?></textarea>
                <br>
                <h5> Assign User & Date </h5>

                <div style="display: flex;margin-left:-10px;margin-top:-20px">


                    <div class="form-floating">
                        <select required name="assigningUserId" id="assigningUserId" class="form-control">
                            <!-- dummy user names later i will connect with database
                        and get user from the users table-->
                            <option value="" style="text-align:center">-- Select User --</option>
                            <?php
                            $userDetailsFetched =  $userDetails->userDetails($con);

                            while ($userData = $userDetailsFetched->fetch_assoc()) { ?>
                            <option value="<?php echo $userData['user_id'] ?>"
                                <?php echo ($selected_user == $userData['user_id']) ? "selected" : "" ?>>
                                <?php echo $userData['user_name'] ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>

                    <div class="form-floating" style="margin-left:-10px;">
                        <input required class="form-control" type="date" name="startDate" id="startDate"
                            placeholder="Start Date" value="<?php echo $start_date; ?>">
                        <label for="">Start Date</label>
                    </div>
                    <div class="form-floating" style="margin-left:-10px;">
                        <input required class="form-control" type="date" name="endDate" id="endDate"
                            placeholder="End Date" value="<?php echo $end_date; ?>">
                        <label for="">End Date</label>
                    </div>


                </div>
                <div
                    style="display:flex;gap:10px;margin-top:-10px;border-top:1px solid #2E8B57;border-bottom:1px solid #2E8B57;">

                    <button type="submit" name="projectSubmitBtn" id="projectSubmitBtn" class="btn btn-success">Assign
                        Project</button>

                    <a href="<?php echo BASE_URL . "/Admin/adminDashBoard.php"; ?>" id="projectBackBtn"
                        class="btn btn-warning" style="width:140px;color:black">Back</a>

                    <button type="submit" name="projectUpdateBtn" id="projectUpdateBtn"
                        class="btn btn-info">Update</button>
                    <a href="<?php echo BASE_URL . "/Admin/projectForm.php"; ?>" id="projectUpdateCancelBtn"
                        class="btn btn-warning">Cancel</a>
                </div>
            </div>
        </form>
    </div>
    <form action="" method="post" id="projectSearchForm">

        <input type="text" name="projectSearchBar" autocomplete="off" id="projectSearchBar" class="form-control"
            placeholder="Search Project">
        <button type="submit" name="projectSearchBtn" class="btn btn-success" hidden></button>

    </form>
    <div id="projectTable">
        <table class="table table-success" style="width:750px;">
            <thead>
                <tr id="projectTableHeader">
                    <th>S.No</th>
                    <th style="width:350px;">Project Name</th>
                    <th style="width:250px;">Assigned User</th>
                    <th>Dead Line</th>
                    <th style="">Operations</th>
                </tr>
            </thead>
            <?php if (isset($_SESSION['project_search_result']) && $_SESSION['project_search_result'] != "") { ?>
            <tbody id="projectTableBody" style="font-size:13px;font-weight:bolder">
                <?php $i = 1;
                    date_default_timezone_set('Asia/Kolkata');
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
                    <td style="width:320px;"><?php echo $projectData['project_name']; ?></td>
                    <td style="width:200px;"><?php echo $projectData['user_name']; ?>
                    </td>
                    <td style="width:10px;">
                        <div style="display:flex;gap:3px;">
                            <div style="background-color: <?php echo $color; ?>;width:20px;height:20px;">
                            </div>
                            <span style="width:200px"> <?php echo $status; ?></span>
                        </div>
                    </td>
                    <td style="width:320px">
                        <div style="height:50px;">
                            <a style="width:45px;font-size:14px;"
                                href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?edit_id=<?php echo $projectData['project_name_id']; ?>"
                                class="btn btn-info">Edit</a>
                            <a style="width:60px;font-size:14px;"
                                href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?delete_id=<?php echo $projectData['project_id']; ?>"
                                class="btn btn-danger"
                                onclick="return confirm('Are You Sure Do You Want To Delete This Project')">Delete</a>
                        </div>
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
function setProjectDescription() {

    document.getElementById("searchProjectNameHiddenBtn").click();
}


setTimeout(() => {
    let failure_alert = document.getElementById("failure-notification")
    if (failure_alert) {
        failure_alert.style.display = "none";
    }
    let success_alert = document.getElementById("success-notification")
    if (success_alert) {
        success_alert.style.display = "none";
    }
}, 2000);
</script>

<?php ob_flush(); ?>