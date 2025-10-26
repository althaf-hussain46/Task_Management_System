<?php
include_once("../Config/config.php");


class DateFunctions
{

    public function date_difference($fromDate, $toDate)
    {
        // $date_difference =  abs(date("d", strtotime($toDate)) - date("d", strtotime($fromDate)));
        $start_date  = new DateTime($fromDate);
        $end_date = new DateTime($toDate);
        $date_difference = $start_date->diff($end_date);
        return  $date_difference->days;
    }
}