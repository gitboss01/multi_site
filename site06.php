<?php

class Site06 extends Controller
{

    public $reg_change_term = [        //希望の転職時期
        1 => 2,                     //1月以内
        2 => 2,                     //2月以内
        3 => 2,                     //3月以内
        6 => 3,                     //半年以内
        12 => 5,                    //1年以内
        99 => 1                     //その他
    ];
    public $reg_work_type = [
        1 => 5,
        2 => 4,
        3 => 4,
        4 => 2,
        5 => 8,
        99 => 6
    ];
    public $sex = [
        'female' => 2,
        'male' => 1
    ];
    public $reg_licenses = [
        'seikan' => 2,
        'junkan' => 3
    ];
    public $reg_work_state = [
        1 => '離職中／退職確定済',
        2 => 'できるだけ早く辞めたい',
        3 => '良い転職先なら辞めたい',
        4 => '良い転職先なら検討する',
        5 => '半年以上は辞められない',
        6 => 'あまりやめるきはない',
        7 => 'その他'

    ];

    public function __construct()
    {
        $this->url = 'https://www.nursejinzaibank.com/glp/aff_001';
        $this->post_url = 'https://www.nursejinzaibank.com/entryfin/';

        parent::__construct();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $reg_change_term = $this->reg_change_term[$origin_data['jiki']];
        $reg_licenses = $this->reg_licenses[$origin_data['sikaku']];
        $reg_work_type = $this->reg_work_type[$origin_data['hatarakikata']];
        $sex = $this->sex[$origin_data['sex']];
        $reg_work_state = $this->reg_work_state[$origin_data['bank']];
        $region1=$db->select("region_name","*",["id"=>$origin_data['region']]);
        $region2=$db->select("cities","*",["id"=>$origin_data['city']]);

        $addr2=$db->select("nass_cities","id",["addr2[~]"=>$region2['0']['name']]);
        
        $this->post_data = array(
            'license[]' => $reg_licenses,
            'req_emp_type[]' => $reg_work_type,
            'req_date' => $reg_change_term,
            'zip' => $origin_data['zip'],
            'addr1' => $region1['0']['addr1'],
            'addr2' => $addr2,
            'addr3' => $origin_data['house'],
            'name_kan' => $origin_data['sei'] . $origin_data['mei'],
            'name_cana' => $origin_data['seikana'] . $origin_data['meikana'],
            'birth_year' => $origin_data['birth_year'],
            'mob_phone' => $origin_data['tel'],
            'retirement_intention' => $reg_work_state,
            'mob_mail' => $origin_data['mail'],
            '_token' => $this->get_token(),
            'sex' => $sex,
            'req_work_type[]' => $this->get_reg_work_type(),
            'lp_id' => $this->get_lp_id(),
        );
        // var_dump($this->post_data);die;
    }

    public function get_token()
    {
        return str_get_html($this->pre_body)->find('input[name="_token"]', 0)->value;
    }

    public function get_reg_work_type()
    {
        preg_match("/name=\"req_work_type\[\]\" value=\"([\d]+)\"/", $this->pre_body, $match);
        return $match[1];
    }

    public function get_lp_id()
    {
        return str_get_html($this->pre_body)->find('input[name="lp_id"]', 0)->value;
    }
}
