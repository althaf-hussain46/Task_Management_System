<style>
#projectUpdateBtn {
    display: none;
}

#projectUpdateCancelBtn {
    display: none;
}
</style>

<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../Includes/adminNavbar.php");


$pro_name = "";
$pro_desc = "";
$start_date = "";
$end_date = "";
$selected_user = "";

if (isset($_POST['projectSubmitBtn'])) {

    extract($_POST);

    // echo $projectName;
    // echo "<br>";
    // echo $projectDescription;
    // echo "<br>";
    // echo $startDate;
    // echo "<br>";
    // echo $endDate;
    // echo "<br>";
    // echo $assigningUser;
}

if (isset($_GET['id'])) {
    extract($_GET);
    // echo "id = " . $id;
    $pro_name = "TMS";
    $pro_desc = "Maintain Project and task";
    $start_date = "2025-10-24";
    $end_date = "2025-10-25";
    $selected_user = "user1";

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
<?php } ?>

<body>
    <div id="projectFormDiv">

        <form action="" method="post" id="projectForm" style="padding-left:10px;">
            <h1>Project Management</h1>
            <hr>
            <div>
                <div class="form-floating" style="width:300px;">
                    <input class="form-control" type="text" name="projectName" id="projectName"
                        placeholder="Project Name" value="<?php echo $pro_name; ?>">
                    <label for="">Project Name</label>
                </div>
                <!-- <input class="form-control" type="text" name="projectDescription" id="projectDescription"
                placeholder="Description"> -->
            </div>
            <br>
            <textarea class="form-control" name="projectDescription" id="projectDescription" rows="5" cols="5"
                placeholder="Project Description"><?php echo $pro_desc; ?></textarea>

            <br>
            <div style="display: flex;gap:20px;">
                <div class="form-floating">
                    <input class="form-control" type="date" name="startDate" id="startDate" placeholder="Start Date"
                        value="<?php echo $start_date; ?>">
                    <label for="">Start Date</label>
                </div>
                <div class="form-floating">
                    <input class="form-control" type="date" name="endDate" id="endDate" placeholder="End Date"
                        value="<?php echo $end_date; ?>">
                    <label for="">End Date</label>
                </div>

                <div class="form-floating">
                    <select name="assigningUser" id="assigningUser" class="form-control">
                        <!-- dummy user names later i will connect with database
                        and get user from the users table-->
                        <option value="">--select user--</option>
                        <option value="user1" <?php echo ($selected_user == "user1") ? "selected" : "" ?>>user1</option>
                        <option value="user2"><?php echo ($selected_user == "user2") ? "selected" : "" ?>user2</option>
                    </select>
                </div>
            </div>
            <div style="display:flex;gap:10px;">

                <button type="submit" name="projectSubmitBtn" id="projectSubmitBtn"
                    class="btn btn-success">Submit</button>
                <a href="<?php echo BASE_URL . "/Admin/adminDashBoard.php"; ?>" id="projectBackBtn"
                    class="btn btn-warning">Back</a>

                <button type="submit" name="projectUpdateBtn" id="projectUpdateBtn" class="btn btn-info">Update</button>
                <a href="<?php echo BASE_URL . "/Admin/projectForm.php"; ?>" id="projectUpdateCancelBtn"
                    class="btn btn-warning">Cancel</a>
            </div>
        </form>
    </div>

    <div id="projectTable">

        <table class="table">
            <thead>
                <tr id="projectTableHeader">
                    <th>Project Name</th>
                    <th>Assigned User</th>
                    <th>Dead Line</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>TMS</td>
                    <td>User1</td>
                    <td>
                        <div style=" height:10px; width:10px;border:1px solid red;background-color:red">
                        </div>
                    </td>
                    <td>
                        <a href="<?php echo BASE_URL . "/Admin/projectForm.php" ?>?id=1" class="btn btn-info">Edit</a>
                        <a href="" class="btn btn-danger"
                            onclick="return confirm('Are You Sure Do You Want To Delete This Record')">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>TMS</td>
                    <td>User2</td>
                    <td>
                        <div style="height:10px; width:10px;border:1px solid green;background-color:green"></div>
                    </td>
                </tr>

                <tr>
                    <td>TMS</td>
                    <td>User3</td>
                    <td>
                        <div style="height:10px; width:10px;border:1px solid orange;background-color:orange"></div>
                    </td>
                </tr>


            </tbody>
        </table>

    </div>
</body>



<style>

</style>

<?php

include_once(DIR_URL . "/Includes/footer.php");
?>