<?php
include_once("../Config/config.php");
include_once(DIR_URL . "/Includes/header.php");

?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">TMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Management
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item"
                                href="<?php echo BASE_URL . "/Admin/projectForm.php"; ?>">Project</a>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL . "/Admin/projectList.php"; ?>">Project
                                List
                            </a>
                        </li>
                        <li><a class="dropdown-item" href="<?php echo BASE_URL . "/Admin/taskForm.php"; ?>">Task</a>
                        </li>
                        <li>
                            <hr class=" dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#">Dead Line Tracking</a></li>
                    </ul>
                </li>

            </ul>
            <form style="display:flex; gap:60px;">
                <label for="" style="display:flex;flex-direction:column">
                    <img style="height:30px;float:left" src=" <?php echo BASE_URL . "/Images/admin_image.jpeg"; ?>"
                        alt="">
                    Admin
                </label>

                <a href="<?php echo BASE_URL . "/logout.php"; ?>" class="btn btn-outline-danger">Logout</a>
            </form>
        </div>
    </div>
</nav>



<?php

include_once(DIR_URL . "/Includes/footer.php");
?>