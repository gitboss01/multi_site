<?php

class Site10 extends Controller
{
    public $license = [
        'seikan' => 120,
        'junkan' => 130
    ];
    public $work_type = [
        '1' => '12',
        '2' => '11',
        '3' => '13',
        '4' => '40',
        '5' => '39',
        '99' => '21'
    ];
    public $hope_term = [
        '1'=>'170',
        '2'=>'180',
        '3'=>'180',
        '6'=>'190',
        '12'=>'220',
        '99'=>'230'
    ];
    public function __construct()
    {
        $this->url = 'https://kango.mynavi.jp/lp/028-2.html';
        $this->post_url = 'https://kango.mynavi.jp/lp/028-2.html';
        parent::__construct();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $hope_location1 = $db->select("region_name", "region", ["id" => $origin_data['hope_region']]);
        $hope_location2 = $db->select("region_name", "region", ["id" => $origin_data['hope2_region']]);

        $this->post_data = [
            // 'qualification2'=>'140',
            // 'employment0'=>'11',
            // 'employment4'=>'13',
            'kinmuchi01'=>$hope_location1['0'],
            'kinmuchi02'=>$hope_location2['0'],
            'hope_season'=>$this->hope_term[$origin_data['jiki']],
            'cmt'=>$origin_data['remarks'],
            'pref'=>$origin_data['region'],
            'address'=>$origin_data['city'].$origin_data['house'],
            'birthday_nen'=>$origin_data['birth_year'],
            'birthday_tuki'=>$origin_data['birth_month'],
            'birthday_hi'=>$origin_data['birth_day'],
            'sei'=>$origin_data['sei'].$origin_data['mei'],
            'seikana'=>$origin_data['seikana'].$origin_data['meikana'],
            'present'=>'特典のペンとファイルをもらう',
            'tel1'=>$origin_data['tel'],
            'mail'=>$origin_data['mail'],
            'token'=>$this->get_token(),
            'edit_flg'=>'1',
            'recruitno'=>'586291',
            'form_class'=>'111',
            'present_flg'=>'1',
            'present_txt'=>'特典のペンとファイルをもらう',
            'present_val'=>'特典のペンとファイルをもらう',
            'inquiry_flg'=>'',
            'detail_flg'=>'1',
            'travelnurse_flg'=>'',
            'naiyo'=>'',
        ];
        $license = $this->license[$origin_data['sikaku']];
        if ($license == '120') {
            $this->post_data['qualification0'] = $license;
        } elseif ($license == '130') {
            $this->post_data['qualification1'] = $license;
        }

        $work_type = $this->work_type[$origin_data['hatarakikata']];
        if ($work_type == '11') {
            $this->post_data['employment0'] = $work_type;
        } elseif ($work_type == '12') {
            $this->post_data['employment1'] = $work_type;
        } elseif ($work_type == '13') {
            $this->post_data['employment4'] = $work_type;
        } elseif ($work_type == '40') {
            $this->post_data['employment3'] = $work_type;
        } elseif ($work_type == '39') {
            $this->post_data['employment2'] = $work_type;
        } else {
            $this->post_data['employment6'] = $work_type;
        }

    }

    public function get_token()
    {
        return str_get_html($this->pre_body)->find('input[name="token"]', 0)->value;
    }

}
