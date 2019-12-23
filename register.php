<?php
require 'mysql_con.php';
require_once './reg.php';
require_once './simple_html_dom.php';
require_once './site01.php';
// require_once './site02.php';
require_once './site03.php';
require_once './site04.php';
require_once './site05.php';
require_once './site06.php';
require_once './site07.php';
require_once './site08.php';
require_once './site09.php';
require_once './site10.php';
require_once './site11.php';
require_once './site12.php';
require_once './site13.php';
$sites = $_POST['site'];
foreach ($sites as $site) {
    if ($site == 1) {
        $site01 = new Site01();
        echo $site01->init();
    } elseif ($site == 2) {
        // $site02 = new Site02();
        // echo $site02->init();
    } elseif ($site == 3) {
        $site03 = new Site03();
        echo $site03->init();
    } elseif ($site == 4) {
        $site04 = new Site04();
        echo $site04->init();
    } elseif ($site == 5) {
        $site05 = new Site05();
        echo $site05->init();
    } elseif ($site == 6) {
        $site06 = new Site06();
        echo $site06->init();
    } elseif ($site == 7) {
        $site07 = new Site07();
        echo $site07->init();
    } elseif ($site == 8) {
        $site08 = new Site08();
        echo $site08->init();
    } elseif ($site == 9) {
        $site09 = new Site09();
        echo $site09->init();
    } elseif ($site == 10) {
        $site10 = new Site10();
        echo $site10->init();
    } elseif ($site == 11) {
        $site11 = new Site11();
        echo $site11->init();
    } elseif ($site == 12) {
        $site12 = new Site12();
        echo $site12->init();
    } else {
        $site13 = new Site13();
        echo $site13->init();
    }
}
