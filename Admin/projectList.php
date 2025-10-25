<?php


include_once("../Config/config.php");
include_once(DIR_URL . "../Includes/header.php");
include_once(DIR_URL . "../Includes/adminNavbar.php");
?>

<body>

    <h1 style="text-align: center;">Project List</h1>
    <form action="" method="post" id="projectSearchForm">

        <input type="text" name="projectSearchBar" id="projectSearchBar" class="form-control">
        <button type="submit" class="btn btn-success" hidden></button>

    </form>
    <br>
    <div id="projectTableDiv">


        <table class="table">
            <thead>
                <tr id="projectTableHeader">
                    <th>Project Name</th>
                    <th>Assigned User</th>
                    <th>Dead Line</th>

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


</body>

<?php

include_once(DIR_URL . "../Includes/footer.php");
?>