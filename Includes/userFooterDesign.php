<style>
    #footer-design-container-user {
        display: grid;
        grid-template-columns: 150px auto 350px;
        /* gap: 3px;
    padding: 10px; */
        /* background-color: dodgerblue; */
    }

    #footer-design-container-user div {
        padding: 10px;
        background-color: dodgerblue;
    }

    #item1 {

        background-color: dodgerblue;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        color: white;
        font-size: large
    }

    #item2 {

        background-color: dodgerblue;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        color: white;
        font-size: large;
        font-weight: bolder;
    }

    #item3 {

        /* background-color: dodgerblue; */
        display: flex;
        flex-direction: column;
        /* justify-content: end;*/
        align-items: end;
        color: white;
        font-weight: bolder;
        font-size: 15px;

    }
</style>
<?php include_once('../Config/config.php');
include_once(DIR_URL . '../Includes/header.php');


?>


<!-- <div id="footer-design-container-user"> -->
<div id="item1">Developed By </div>
<div id="item2">Althaf Hussain J</div>
<div id="item3">
    <ul style="list-style-type:none">
        <li style="text-align:center">9094095610</li>
        <li style="text-align: center;">althafhussain2k3@gmail.com</li>
    </ul>
</div>

<!-- </div> -->


<?php include_once('../Includes/footer.php') ?>