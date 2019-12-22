<?php
    require 'mysql_con.php';
    require_once './reg.php';
    require_once './simple_html_dom.php';
    
    // $site_num=$_POST;
    var_export($_POST);
    // $sites = $db->select('site_name', '*', [
    //     'id'=>$site_num
    // ]);
    // foreach($sites as $site){
    //     if($site['id']==1){

    //     }
    // }
    require_once './site01.php';    //complete
    require_once './site02.php';
    require_once './site03.php';        //complete 
    require_once './site04.php';     //complete
    require_once './site05.php';        //complete 
    require_once './site06.php';        //complete 
    require_once './site07.php';        //complete 
    require_once './site08.php';        //complete 
    require_once './site09.php';        //complete 
    require_once './site10.php';        //complete 
    require_once './site11.php';        //complete 
    require_once './site12.php';        //complete 
    require_once './site13.php';        //complete 

    // $site01 = new Site01();
    // echo $site01->init();
    $site02 = new Site02();
    echo $site02->init();
    // $site04 = new Site04();
    // echo $site04->init();
    // $site05 = new Site05();
    // echo $site05->init();
    // $site08 = new Site08();
    // echo $site08->init();
    // $site12 = new Site12();
    // echo $site12->init();
    // $site03 = new Site03();
    // echo $site03->init();
    // $site09 = new Site09();
    // echo $site09->init();
    // $site11 = new Site11();
    // echo $site11->init();
    // $site13 = new Site13();
    // echo $site13->init();
    // $site10 = new Site10();
    // echo $site10->init();
    // $site07 = new Site07();
    // echo $site07->init();
    // $site06 = new Site06();
    // echo $site06->init();
