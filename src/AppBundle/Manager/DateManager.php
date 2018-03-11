<?php
/**
 * Created by PhpStorm.
 * User: acanteroruiz
 * Date: 11/3/18
 * Time: 10:49
 */

namespace AppBundle\Manager;

class DateManager
{

    public function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' )//%a año, %d días
    {
        $interval = date_diff($date_1, $date_2);
        return $interval->format($differenceFormat);
    }

}