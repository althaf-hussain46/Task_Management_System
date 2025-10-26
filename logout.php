<?php
include_once("./Config/config.php");
include_once(DIR_URL . "./Connection/dbConnection.php");

unset($_SESSION['success_notification']);
unset($_SESSION['failure_notification']);
unset($_SESSION['project_search_result']);
session_destroy();

header("Location:" . BASE_URL . "/index.php");