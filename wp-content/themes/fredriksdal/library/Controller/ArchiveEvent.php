<?php

namespace Fredriksdal\Controller;

/**
 * Controllers is loaded based on which theme-file is used on the current
 * page. For instance if the currently used theme-file is Archive.php, the
 * controller loaded would be Archive.
 *
 * Name your controller file Archive.php and the class should be named Archive.
 */

class ArchiveEvent extends \Municipio\Controller\BaseController
{
    public function init()
    {
        $this->data['quaters'] = $this->getQuaters();
    }

    /**
     * Get an array with quaters info
     * @return array
     */
    public function getQuaters()
    {
        $quaters = array();

        for ($i = 1; $i <= 4; $i++) {
            $endMonth = $i * 3;
            $startMonth = $endMonth - 2;

            $year = date('Y');
            if (date('m') > $endMonth) {
                $year++;
            }

            $startDate = mysql2date('Y-m-d', date('Y-m-d', mktime(0, 0, 0, $startMonth, 1, $year)), true);
            $endDate = mysql2date('Y-m-d', date('Y-m-t', mktime(0, 0, 0, $endMonth, 1, $year)), true);

            $startMonth = mysql2date('F', date('Y-m-d', mktime(0, 0, 0, $startMonth, 1, $year)), true);
            $endMonth = mysql2date('F', date('Y-m-d', mktime(0, 0, 0, $endMonth, 1, $year)), true);

            $quaters[] = array(
                'year' => $year,
                'start_date' => $startDate,
                'start_month' => $startMonth,
                'end_date' => $endDate,
                'end_month' => $endMonth
            );
        }

        $quaters = json_decode(json_encode($quaters));
        return $quaters;
    }

    public static function getEventDate($eventId)
    {
        $start = date('Y-m-d H:i:s', strtotime(get_field('event-date-start', $eventId)));
        $end = date('Y-m-d H:i:s', strtotime(get_field('event-date-end', $eventId)));
        $date = mysql2date('j F Y', $start, true) . ' kl. ' . mysql2date('H:i', $start, true) . ' till ' . mysql2date('j F Y', $end, true) . ' kl. ' . mysql2date('H:i', $end, true);

        if (date('Y-m-d', strtotime($start)) == date('Y-m-d', strtotime($end))) {
            $date = mysql2date('j F Y', $start, true) . ' kl. ' . mysql2date('H:i', $start, true) . ' - ' . mysql2date('H:i', $end, true);
        }

        return $date;
    }
}
