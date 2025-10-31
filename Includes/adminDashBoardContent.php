<style>
#userDashBoardCardGrid {
    display: grid;
    grid-template-columns: 1fr;
    grid-template-rows: 10px 150px 500px;
    /* gap: 3px;
        padding: 10px;
        background-color: dodgerblue; */
}

#userDashBoardCardGrid div {
    /* padding: 10px;
    background-color: white; */
}



div#card1 {
    font-size: 20px;
    font-weight: bolder;
}

div#card2 {
    font-size: 10px;
    font-weight: bold;
    display: flex;
}

div#card3 {

    display: flex;
    justify-content: center;
    margin-top: 150px;
}
</style>


<?php

include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../CRUD/user.php");
include_once(DIR_URL . "../CRUD/taskForm.php");
include_once(DIR_URL . "../CRUD/projectForm.php");
$get_user_data = new UserCRUD();
$get_project_data  = new ProjectFormCRUD();
$get_task_data  = new TaskFormCRUD();


$total_task = $get_task_data->totalTaskFilterAdmin($con, 1);
$not_started_task_total = $get_task_data->totalTaskFilterAdmin($con, 2);
$in_progress_task_total = $get_task_data->totalTaskFilterAdmin($con, 3);
$completed_task_total = $get_task_data->totalTaskFilterAdmin($con, 4);
$total_projects = $get_project_data->totalProjectsFilterAdmin($con);
$total_users = $get_user_data->totalUsers($con);
$assigned_projects_total = $get_project_data->totalProjectsAssigned($con);

$total_assigned_projects = $get_project_data->totalAssignedProjects($con);
$partially_assigned_projects = $get_project_data->totalPartialAssignedProject($con);
$unassigned_projects_total = $get_project_data->totalUnassignedProjects($con);


$unassigned_projects_count = $get_project_data->totalProjectsUnassigned($con)




?>

<div id="userDashBoardCardGrid">
    <div id="card1"></div>
    <div id="card2">

        <div class="col-sm-6 mb-1 mb-sm-0">
            <a href="<?php echo BASE_URL . "/Admin/projectList.php"; ?>" style="text-decoration: none;">
                <div class=" card"
                    style="display:flex;flex-direction:row;height:250px;box-shadow: seagreen 1px 5px 15px 0px;border-radius:15px">

                    <img width="300" src="<?php echo BASE_URL . "/Images/project_image.jpg" ?>" alt="">

                    <div class="card-body" style="width:100px;">
                        <?php if ($total_projects['total_count'] > 1) { ?>
                        <h2 class="card-title text-center">P R O J E C T S -
                            <?php echo $total_projects['total_count']; ?></h2>
                        <?php } else { ?>
                        <h2 class="card-title text-center">P R O J E C T -
                            <?php echo $total_projects['total_count']; ?>
                        </h2>
                        <?php } ?>

                        <h4 class="card-text text-center" style="margin-top:50px;">Assigned -
                            <span
                                style="font-size:larger"><?php echo $assigned_projects_total['assigned_projects_total']; ?></span>
                        </h4>

                        <h4 class="card-text text-center"> Unassigned -
                            <span
                                style="font-size:larger"><?php echo $unassigned_projects_count['unassigned_project_count']; ?></span>
                        </h4>

                        <br>
                    </div>
                </div>
            </a>
        </div>
        <div class=" col-sm-6">
            <a href="<?php echo BASE_URL . "/Admin/adminTaskList.php" ?>" style="text-decoration: none;">
                <div class="card"
                    style="display:flex;flex-direction:row;height:250px;box-shadow: seagreen 1px 5px 15px 0px;border-radius:15px">
                    <img width="278" src="<?php echo BASE_URL . "/Images/task_image.jpg" ?>" alt="">
                    <div class="card-body">
                        <h2 class="card-title text-center">T A S K S - <?php echo $total_task['total_count']; ?></h2>
                        <ul style="list-style-type:none;margin-left:-30px;margin-top:50px;"
                            class="card-text text-center">
                            <li class="card-text text-center">
                                <h4>Not Started -
                                    <span
                                        style="color:#E81224;font-size:larger"><?php echo $not_started_task_total['total_count']; ?></span>
                                </h4>
                            </li>
                            <li class="card-text text-center">
                                <h4>In Progress - <span
                                        style="color:#F7630C;font-size:larger"><?php echo $in_progress_task_total['total_count']; ?></span>
                                </h4>
                            </li>
                            <li class="card-text text-center">
                                <h4>Completed - <span
                                        style="color:#15C10C;font-size:larger"><?php echo $completed_task_total['total_count']; ?></span>
                                </h4>
                            </li>
                        </ul>
                    </div>
                </div>
            </a>
        </div>

    </div>
    <div id="card3">
        <div class="col-sm-6 mb-3 mb-sm-0">
            <a href="<?php echo BASE_URL . "/Admin/adminViewUserProjectTaskStatus.php"; ?>"
                style="text-decoration:none">
                <div class="card"
                    style="display:flex;flex-direction:row;height:280px;box-shadow: seagreen 1px 5px 15px 0px;border-radius:15px">

                    <img width="220" src="<?php echo BASE_URL . "/Images/users.png" ?>" alt="">

                    <div class="card-body" style="width:100px;">
                        <h2 class="card-text text-center">U S E R S -<?php echo $total_users['total_user']; ?></h2>
                        <h6 class="card-text text-center">(Developers)</h6>
                        <h1 class="card-text text-center"></h1>
                        <br>
                        <h4 class="card-title text-center">Assigned (Project & Task) -
                            <span
                                style="font-size:larger"><?php echo $total_assigned_projects['assigned_project_count'] ?></span>
                        </h4>
                        <h4 class="card-title text-center">Project Only -
                            <span
                                style="font-size:larger"><?php echo $partially_assigned_projects['partial_assigned_project_count']; ?></span>
                        </h4>
                        <h4 class="card-title text-center">Unassigned -
                            <span
                                style="font-size:larger"><?php echo  $unassigned_projects_total['unassigned_projects_count']; ?></span>
                        </h4>

                        <br>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>