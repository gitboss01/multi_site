<?php

class Site05 extends Controller
{
    public $reg_change_term = [        //希望の転職時期
        1 => 'すぐ',                 //1月以内
        2 => '3ヶ月以内',            //2月以内
        3 => '3ヶ月以内',            //3月以内
        6 => '6ヶ月以内',            //半年以内
        12 => '未定',                //1年以内
        99 => '未定'                 //その他
    ];
    public $sex = [
        'female' => '女性',
        'male' => '男性'
    ];
    public $reg_licenses = [
        'seikan' => '正看護師',
        'junkan' => '准看護師'
    ];
    public $reg_biyou = [
        1 => 'あり',
        2 => 'なし'
    ];

    public function __construct()
    {
        $this->url = 'https://career-present.com/nurse/info06/';
        $this->post_url = 'https://career-present.com/nurse/info06/mailformpro/mailformpro.cgi';

        parent::__construct();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $hope_region=$db->select("region_name","*",["id"=>$origin_data['hope_region']]);
      
        $reg_sex = $this->sex[$origin_data['sex']];
        $reg_change_term = $this->reg_change_term[$origin_data['jiki']];
        $reg_licenses = $this->reg_licenses[$origin_data['sikaku']];
        $reg_biyou = $this->reg_biyou[$origin_data['experience1']];


        $cities = $db->select("cities", ["id", "prefecture_id"], ["name[~]" => $origin_data['city']]);
        $this->post_data = array(
            'お名前' => $origin_data['sei'] . $origin_data['mei'],
            'ふりがな' => $origin_data['seikana'] . $origin_data['meikana'],
            '最寄り駅' => $origin_data['station'],
            '誕生年' => $origin_data['birth_year'] . '年',
            '性別' => $reg_sex,
            '電話番号' => $origin_data['tel'],
            'email' => $origin_data['mail'],
            '保有資格' => $reg_licenses,
            '希望勤務地' => $hope_region['0']['region'],
            '美容クリニックでの経験' => $reg_biyou,
            '入職希望' => $reg_change_term,
            'ご希望・ご要望' => $origin_data['remarks'],
        );
    }
}
