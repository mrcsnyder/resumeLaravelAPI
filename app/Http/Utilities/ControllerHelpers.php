<?php

namespace App\Http\Utilities;

class ControllerHelpers
{

    //format a passed year & month (e.g. 2020-09 becomes Sep 2020)
    public static function returnMonthYear($date){

        if($date == null) {
            $monthYear = 'Present';
        }
        else {
            //work around to tack on day at end of passed request date
            $pre_date_str = $date.'-01';

            //format given date to store only month and year in neat format
            // i.e. 'Aug 2017' or 'Dec 2012' etc.
            $monthYear = date('M Y', strtotime($pre_date_str));
        }

        return $monthYear;
    }


}
