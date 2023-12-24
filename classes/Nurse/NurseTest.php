<?php
require_once 'NurseDAOImpl.php';
require_once 'Nurse.php';

$nurse = new Nurse(1, "nurse", "nurse", "nurse@gmail", "nurse Address", "nurse phone", "nurse CIN");
$nurseDAO = new NurseDAOImpl();
$nurseDAO->addNurse($nurse);
$nurse = $nurseDAO->getNurse("nurse", "nurse");
echo $nurse->getName(),"\n";
$nurse->setName("nurse25");
echo "yiuoyi\n";
$nurseDAO->updateNurse($nurse);
$nurse = $nurseDAO->getNurseById(4);
echo $nurse->getName();
?>