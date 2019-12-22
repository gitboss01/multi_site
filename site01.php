<?php
class Site01 extends Controller
{

    public $reg_change_term = [        //希望の転職時期
        1 => 2,                     //1月以内
        2 => 3,                     //2月以内
        3 => 4,                     //3月以内
        6 => 5,                     //半年以内
        12 => 7,                    //1年以内
        99 => 8                     //その他
    ];
    public $reg_work_type = [
        1 => 1,
        2 => 2,
        3 => 3,
        4 => 3,
        5 => 3,
        99 => 3
    ];
    public $reg_licenses = [
        'seikan' => 101,
        'junkan' => 102
    ];

    public function __construct()
    {
        $this->url = 'https://kango-oshigoto.jp/lp/9/area/00/';
        $this->post_url = 'https://kango-oshigoto.jp/lp/entry/input/directhire/execute/';
        parent::__construct();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $reg_change_term = $this->reg_change_term[$origin_data['jiki']];
        $reg_licenses = $this->reg_licenses[$origin_data['sikaku']];
        $reg_work_type = $this->reg_work_type[$origin_data['hatarakikata']];
        $this->post_data = array(
            '_token' => $this->get_token(),
            'form_ko_c1[input_url]' => 'https://kango-oshigoto.jp/lp/9/area/00',
            'form_ko_c1[type_id]' => 1,
            'form_ko_c1[googleanalytics][client_id]' => '122718410.1574843517',
            'form_ko_c1[hope_employment_workstyles][0][employment_workstyle_id]' => $reg_work_type,
            'form_ko_c1[hope_jobchanges][0][type_id]' => $reg_change_term,
            'form_ko_c1[licenses][0][license_id]' => $reg_licenses,
            'form_ko_c1[name]' => $origin_data['sei'] . $origin_data['mei'],
            'form_ko_c1[kana]' => $origin_data['seikana'] . $origin_data['meikana'],
            'form_ko_c1[birth]' => $origin_data['birth_year'] . '-' . '01' . '-' . '01', //1980-01-01
            'form_ko_c1[prefecture_id]' => $origin_data['region'],
            'form_ko_c1[city_id]' => $origin_data['city'],
            'form_ko_c1[phone]' => $origin_data['tel'],
            'form_ko_c1[email]' => $origin_data['mail'],
            'form_ko_c1[memo_local]' => $origin_data['remarks']
        );
    }

    public function get_token()
    {
        preg_match("/csrfToken = \"([\d\w]+)\"/", $this->pre_body, $match);
        return $match[1];
    }
}
