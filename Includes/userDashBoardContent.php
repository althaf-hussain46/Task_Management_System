<style>
#userDashBoardCardGrid {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 50px 100px 500px;
    /* gap: 3px;
    padding: 10px;
    background-color: dodgerblue; */
}

#userDashBoardCardGrid div {
    /* padding: 10px;
    background-color: white; */
}



div#card1 {
    font-size: 40px;
    font-weight: bolder;
}

div#card2 {
    font-size: 17px;
    font-weight: bold;
}

div#card3 {

    display: flex;
    justify-content: space-around;
}
</style>


<?php

include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../CRUD/taskForm.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
$get_user_data_by_id = new UserCRUD();
$get_project_data  = new ProjectFormCRUD();
$get_task_data  = new TaskFormCRUD();


$total_task = $get_task_data->totalTaskFilter($con, 1);
$not_started_task_total = $get_task_data->totalTaskFilter($con, 2);
$in_progress_task_total = $get_task_data->totalTaskFilter($con, 3);
$completed_task_total = $get_task_data->totalTaskFilter($con, 4);
$total_projects = $get_project_data->totalProjectsFilter($con, "");

?>

<div id="userDashBoardCardGrid">
    <div id="card1"><?php echo $_SESSION['user_name']; ?></div>
    <div id="card2"><?php echo $_SESSION['user_email']; ?></div>
    <div id="card3">
        <div class="row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <div class="card"
                    style="display:flex;flex-direction:row;height:350px;box-shadow: dodgerblue 1px 5px 15px 0px;;border-radius:10px">

                    <img width="300" src="<?php echo BASE_URL . "/Images/project_image.jpg" ?>" alt="">

                    <div class="card-body" style="width:500px;">
                        <h2 class="card-title text-center">P R O J E C T S</h2>
                        <h5 class="card-text text-center">Total</h5>
                        <h5 class="card-text text-center"> Assigned Projects</h5>
                        <h1 class="card-text text-center"><?php echo $total_projects['total_count']; ?></h1>
                        <br>
                        <div style="display:flex;justify-content:center;margin-top:70px">
                            <a href="<?php echo BASE_URL . "/User/viewProjects.php"; ?>" class="btn btn-primary"
                                style="margin-left:10px;width:300px;">View
                                Projects</a>

                        </div>
                    </div>
                </div>
            </div>
            <div class=" col-sm-6">
                <div class="card"
                    style="display:flex;flex-direction:row;height:350px;box-shadow: dodgerblue 1px 5px 15px 0px;;border-radius:10px;">
                    <img width="278" src="<?php echo BASE_URL . "/Images/task_image.jpg" ?>" alt="">
                    <div class="card-body">
                        <h2 class="card-title text-center">T A S K S</h5>
                            <h5 class="card-text text-center">Total</h5>
                            <h5 class="card-text text-center"> Task Assigned </h5>
                            <h1 class="card-text text-center"> <?php echo $total_task['total_count']; ?></h1>
                            <ul style="list-style-type:none;margin-left:-30px" class="card-text text-center">
                                <li>
                                    <h5>Not Started
                                        <span
                                            style="color:#E81224"><?php echo $not_started_task_total['total_count']; ?></span>
                                    </h5>
                                </li>
                                <li>
                                    <h5>In Progress <span
                                            style="color:#F7630C"><?php echo $in_progress_task_total['total_count']; ?></span>
                                    </h5>
                                </li>
                                <li>
                                    <h5>Completed <span
                                            style="color:#15C10C"><?php echo $completed_task_total['total_count']; ?></span>
                                    </h5>
                                </li>
                            </ul>
                            <div style="display:flex;justify-content:center;margin-top:-8px">
                                <a href="<?php echo BASE_URL . "/User/viewTasks.php" ?>" class="btn btn-primary"
                                    style="margin-left:10px;width:300px;">View
                                    Tasks</a>

                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>