<?php

require_once '../require.php';
require_once CLASS_REALDIR . 'SC_Query.php';
require_once CLASS_REALDIR . 'db/SC_DB_MasterData.php';

$masterData = new SC_DB_MasterData();
$arrJOBSTATUS = $masterData->getMasterData('mtb_job_status');

$objQuery = & SC_Query_Ex::getSingletonInstance();
if ($_SESSION['authority'] == 2){
    $jobList = $objQuery->select('*', 'dtb_job', 'agency_id = ?', array($_SESSION['agency_id']));
    $corpList = $objQuery->select('corporate_id, pharmacy_name', 'mtb_corporate', 'del_flg = 0 AND agency_id = ?', array($_SESSION['agency_id']));
    foreach ($corpList as $corp)
        $arrCorp[$corp['corporate_id']] = $corp['pharmacy_name'];
}
else
    $jobList = $objQuery->select('*', 'dtb_job', 'agency_id = ? AND corporate_id = ?', array($_SESSION['agency_id'], $_SESSION['corporate_id']));

$arrJOB = array();
$i = 0;
foreach ($jobList as $job) {
    $arrJOB[$i]['id'] = $job['sjob_id'];
    $arrJOB[$i]['title'] = '依頼番号:' . $job['sjob_id'];
    $arrJOB[$i]['description'] = $arrJOBSTATUS[$job['status']] . '<br />依頼人数:' . $job['staff_count'] . '<br />' . $job['memo'];
    if ($_SESSION['authority'] == 2)
        $arrJOB[$i]['description'] = $arrCorp[$job['corporate_id']].'<br />'.$arrJOB[$i]['description'];
    $arrJOB[$i]['start'] = $job['working_day_all'] . ' ' . $job['working_start_all'] . ':00';
    $arrJOB[$i]['end'] = $job['working_day_all'] . ' ' . $job['working_over_all'] . ':00';
    $arrJOB[$i]['allDay'] = false;
    $arrJOB[$i]['url'] = 'schedule_job.php?sjob_id=' . $job['sjob_id'];
    if($job['type'] == 1)
        $arrJOB[$i]['color'] = 'green';
    $i++;
}
echo json_encode($arrJOB);
?>
