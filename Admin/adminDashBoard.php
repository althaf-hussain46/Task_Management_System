<style>
#grid-container-offcanvas {
    display: grid;
    grid-template-areas:
        "header header header"
        "offcanvas mainContent mainContent"
        "developer name contact";
    grid-template-columns: 250px 1fr 7fr;
    grid-template-rows: 80px 665px 56px;
    /* gap: 3px; */
    /* padding: 10px; */
    /* background-color: dodgerblue; */
}

#grid-container-offcanvas div {
    padding: 10px;
    /* background-color: white; */
}

#header {
    grid-area: header;
    background-color: #198754;
}

#offcanvas {
    grid-area: offcanvas;
    background-color: #198754 !important;
    /* display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center; */
}

#main-content {
    grid-area: mainContent;
    /* display: flex; */
    /* flex-direction: column;
    justify-content: center;
    align-items: center; */
}

#developer {
    grid-area: developer;
    background-color: #198754;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    color: white;
    font-size: large
}

#name {
    grid-area: name;
    background-color: #198754;
    display: flex;
    justify-content: flex-start;
    align-items: center;
    color: white;
    font-size: large;
    font-weight: bolder;
}

#contact {
    grid-area: contact;
    background-color: #198754;
    display: flex;
    flex-direction: column;
    /* justify-content: end;*/
    align-items: end;
    color: white;
    font-weight: bolder;
    font-size: 15px;

}
</style>
<?php
include_once("../Config/config.php");
include_once(DIR_URL . "../Connection/dbConnection.php");
include_once(DIR_URL . "../Includes/header.php");
// include_once(DIR_URL . "../Includes/adminNavbar.php");


?>


<body>
    <div id="grid-container-offcanvas">
        <div id="header">

            <?php include_once(DIR_URL . "../Includes/adminNavbar.php"); ?>
        </div>

        <div id="offcanvas"><?php include_once(DIR_URL . "../Includes/sidebar.php"); ?></div>
        <div id="main-content"></div>
        <div id="developer">Developed by</div>
        <div id="name">Althaf Hussain J</div>
        <div id="contact">
            <ul style="list-style-type:none">
                <li style="text-align:center">9094095610</li>
                <li>althafhussain2k3@gmail.com</li>
            </ul>





        </div>
        <!-- <div id=" footer">Developed By <span style="font-weight:bolder">Althaf Hussain J</span><span
                    style="font-weight:bolder;padding-left:10px">
                    9094095610
                </span>
                <span style="font-weight:bolder">

                    althafhussain2k3@gmail.com
                </span>
        </div> -->
    </div>


</body>



<?php

include_once(DIR_URL . "/Includes/footer.php");
?>