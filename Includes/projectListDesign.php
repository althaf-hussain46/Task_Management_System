<style>
#projectListContainer {
    margin-top: 10px;
    /* border: 1px solid black; */
    height: 620px;
    box-shadow: seagreen 1px 5px 15px 5px;
    border-radius: 20px;

}



#projectTableDiv {


    /* border: 1px solid #2E8B57; */
    /* padding-top: 50px; */
    height: 420px;
    margin-top: 100px;
    overflow-y: scroll;
    /* background-color: white; */
    /* z-index: 50 !important; */


}


#projectTable {
    /* margin-top: -50px; */
    /* width: 800px; */
    border: 1px solid #2E8B57;
    height: 100px;


}





#projectTableHeader th {
    background-color: seagreen;
    height: 50px;

    position: sticky;
    z-index: 1;
    top: 0;
}

/* #projectTableBody:hover {
    background-color: black;
} */

#projectSearchForm {
    display: flex;
    /* justify-content: space-between; */
    gap: 41px;
    position: absolute;
    top: 200px;
    left: 280px;
    width: 1385px;
    height: 90px;
    background-color: white;

}

#fromDate,
#toDate {
    width: 220px;
    font-size: large;
    font-weight: bolder;
    border: 1px solid #2E8B57;
}

#projectSearchBar {
    /* margin-left: 18px; */
    /* margin-top: 15px; */
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


#projectSearchBtn {

    height: 55px;
    width: 180px;
}


/* #projectSearchBar:focus {
    border-radius: 10px;
    border: 1px solid #2E8B57;
    width: 240px;
    padding-left: 50px;
    border: none;
    color: white;
} */
</style><?php


        include_once("../Config/config.php");
        include_once(DIR_URL . "../Connection/dbConnection.php");
        include_once(DIR_URL . "../Includes/header.php");
        include_once(DIR_URL . "../CRUD/projectForm.php");
        include_once(DIR_URL . "../CRUD/user.php");
        include_once(DIR_URL . "../Functions/date_functions.php");

        $project_form_crud = new ProjectFormCRUD();
        $userDetails = new UserCRUD();
        $date_methods = new DateFunctions();

        if (isset($_POST['projectSearchBtn'])) {
            if ($_POST['fromDate'] != "" && $_POST['toDate'] != "") {

                $_SESSION['project_search_result'] = $project_form_crud->projectList(
                    $con,
                    $_POST['projectSearchBar'],
                    $_POST['fromDate'],
                    $_POST['toDate']
                );
            } else {

                $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, $_POST['projectSearchBar']);
            }
        } else {

            $_SESSION['project_search_result'] = $project_form_crud->projectDetails($con, "");
        }

        ?>

<body>

    <div id="projectListContainer">
        <h1 style="text-align:center;letter-spacing:10px;"> ASSIGNED PROJECTS LIST </h1>
        <hr>
        <form action="" method="post" id="projectSearchForm">
            <div class="form-floating">
                <input type="date" name="fromDate" id="fromDate" class="form-control">
                <label for="">From Date</label>
            </div>

            <div class="form-floating">
                <input type="date" name="toDate" id="toDate" class="form-control">
                <label for="">To Date</label>
            </div>
            <div style="display:flex;gap:20px;justify-content:flex-end;
            width:820px;">
                <input type="text" name="projectSearchBar" autocomplete="off" id="projectSearchBar" class="form-control"
                    placeholder="Search Project/User">
                <button type="submit" name="projectSearchBtn" id="projectSearchBtn"
                    class="btn btn-success">Search</button>

            </div>

        </form>

        <div id="projectTableDiv">
            <table class="table" id="projectTable">
                <thead id="projectTableHeader">
                    <tr>
                        <th>S.No</th>
                        <th style="width:300px;">Project Name</th>
                        <th style="width:300px;">Description</th>
                        <th>Assigned User</th>
                        <th>Start Date </th>
                        <th>End Date</th>
                        <th>Dead Line</th>

                    </tr>
                </thead>
                <?php if (isset($_SESSION['project_search_result']) && $_SESSION['project_search_result'] != "") { ?>
                <tbody id="projectTableBody">

                    <?php $i = 1;
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
                        <td style="width:180px;"><?php echo $projectData['project_name']; ?></td>
                        <td><textarea readonly name="" id="" rows="4" style="border:none"
                                cols="40"> <?php echo $projectData['project_description']; ?></textarea>
                        </td>
                        <td><?php echo $projectData['user_name']; ?>
                        </td>
                        <td><?php echo $projectData['start_date']; ?></td>
                        <td><?php echo $projectData['end_date']; ?></td>
                        <td>
                            <div style="display:flex;gap:3px">
                                <div style=" background-color:<?php echo $color; ?>;width:20px;height:20px"></div>
                                <span style="color:<?php echo  $color; ?>;"><?php echo $status; ?> </span>
                            </div>
                        </td>

                    </tr>

                    <?php } ?>
                </tbody>
                <?php } ?>
            </table>

        </div>
    </div>

</body>
<script>

</script>
<?php

include_once(DIR_URL . "../Includes/footer.php");
?>