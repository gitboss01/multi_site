<?php

class Site08 extends Controller
{
    public $reg_licenses = [
        'seikan' => '正看護師',
        'junkan' => '准看護師'
    ];
    public $reg_change_term = [        //希望の転職時期
        1 => '今すぐ',                     //1月以内
        2 => '3カ月以内',                     //2月以内
        3 => '3カ月以内',                     //3月以内
        6 => '6カ月以内',                     //半年以内
        12 => '未定',                    //1年以内
        99 => '未定'                     //その他
    ];
    public $reg_work_type = [
        1 => '常勤',     //常勤(日勤のみ)
        2 => '常勤',     //常勤(夜勤含む)
        3 => '非常勤',     //夜勤専従
        4 => '非常勤',     //非常勤(週20時間未満) 
        5 => '非常勤',     //非常勤(週20時間以上)
        99 => '非常勤'     //その他
    ];
    public $sex = [
        'female' => '女性',
        'male' => '男性'
    ];
    public $work_experience = [
        1 => '1年未満',
        2 => '2年未満',
        3 => '3年未満',
        99 => '3年以上',
    ];
    public $clinic_experience = [
        1 => 'あり',
        2 => 'なし'
    ];


    public function __construct()
    {
        $this->url = 'https://www.biyou-nurse.jp/contact/';
        $this->post_url = 'https://www2.biyou-nurse.jp/l/741773/2019-05-30/96b';

        parent::__construct();
    }

    public function filter_data()
    {

        global $db;
        $origin_data = $_POST;
        $reg_sex = $this->sex[$origin_data['sex']];
        $reg_change_term = $this->reg_change_term[$origin_data['jiki']];
        $reg_licenses = $this->reg_licenses[$origin_data['sikaku']];
        $reg_work_type = $this->reg_work_type[$origin_data['hatarakikata']];
        $work_experience = $this->work_experience[$origin_data['experience']];
        $clinic_experience = $this->clinic_experience[$origin_data['experience1']];
        $live_location=$db->select("region_name","region",['id'=>$origin_data['region']]);
        $live_city=$db->select("cities","name",['id'=>$origin_data['city']]);
        $hope_location=$db->select("region_name","region",['id'=>$origin_data['hope_region']]);
        $this->post_data = array(
            'step' => 3,
            'ki_license' => $reg_licenses,
            'ki_time' => $reg_change_term,
            'ki_employ' => $reg_work_type,
            'bikou' => $origin_data['remarks'],
            'ki_name_sei' => $origin_data['sei'],
            'ki_name_mei' => $origin_data['mei'],
            'ki_furi_sei' => $origin_data['seikana'],
            'ki_furi_mei' => $origin_data['meikana'],
            'ki_sex' => $reg_sex,
            'ki_birthday' => $origin_data['birth_year'] . '-' . $origin_data['birth_month'] . '-' . $origin_data['birth_day'], //'1995-01-10',
            'work_experience' => $work_experience,
            'clinic_work_experience' => $clinic_experience,
            'ki_area' =>$live_location['0'] ,
            'ki_addr' => $live_city,
            'ki_addr_1' => $origin_data['house'],
            'ki_work_location' => $hope_location['0'],
            'ki_tel' => $origin_data['tel'],
            'ki_mail' => $origin_data['mail'],
            'ki_line' => '',
            'consent' => 1,
        );
    }
}
