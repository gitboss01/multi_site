<?php

class Site03 extends Controller
{
    
    
    public function __construct()
    {
        $this->url = 'https://iryo-de-hatarako.net/plp/pc/fm_p02/tmp_p0001';
        $this->post_url = 'https://iryo-de-hatarako.net/completion/registration/';

        parent::__construct();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $employment_type_id='';
        $working_type_id='';
        $employment_type_id='';
        $employment_time_type_id='';
        $location_data=$db->select("region_name","*",["id"=>$origin_data['hope_region']]);

        foreach ($location_data as $hope_work_location) {
            if ($hope_work_location['id'] == '1') {
                $hope_work_location['region'] = '北海道（全域）';
            } elseif ($hope_work_location['id'] == '13') {
                $hope_work_location['region'] = '東京都（23区のみ）';
            } elseif ($hope_work_location['id'] == '27') {
                $hope_work_location = '大阪府（全域）';
            } elseif ($hope_work_location['id'] == '40') {
                $hope_work_location = '福岡県（全域';
            }
        }
        $live_location_data=$db->select("region_name","*",["id"=>$origin_data['region']]);
        
        if ($origin_data['hatarakikata'] == 1) {
            $employment_type_id = $origin_data['hatarakikata'] ? '8' : '';
        } elseif ($origin_data['hatarakikata'] == 2) {
            $working_type_id = $origin_data['hatarakikata'] ? '12' : '';
        } elseif ($origin_data['hatarakikata'] == 3) {
            $working_type_id = $origin_data['hatarakikata'] ? '12' : '';
        } elseif ($origin_data['hatarakikata'] == 4) {
            $employment_time_type_id = $origin_data['hatarakikata'] ? '20' : '';
        } elseif ($origin_data['hatarakikata'] == 5) {
            $employment_time_type_id = $origin_data['hatarakikata'] ? '10' : '';
        } elseif ($origin_data['hatarakikata'] == 99) {
            $employment_time_type_id = $origin_data['hatarakikata'] ? '10' : '';
        }
        if ($origin_data['jiki'] == 99) {
            $origin_data['jiki'] = 16;
        }
        $date = date('Y年m月', strtotime("+{$origin_data['jiki']} month"));
        if ($origin_data['jiki'] == 16) {
            $date .= '以降';
        }

        
        
        $this->post_data = [
            'authenticity_token' => $this->get_token(),
            'candidate[office_id]' => '',
            'candidate[job_id]' => '',
            'candidate[template_id]' => 'tmp_p0001',
            'candidate[form_id]' => '',
            'candidate[register_url]' => '/plp/pc/fm_p02/tmp_p0001',
            'candidate[action_name]' => 'slide',
            'candidate[form_type]' => 'fm_p02',
            'candidate[wacul_prefecture_id]' => '',
            'andidate[wacul_ordi_des_city_id]' => '',
            'candidate[wacul_city_id]' => '',
            'candidate[wacul_employment_type_id]' => '',
            'candidate[wacul_working_type_id]' => '',
            'candidate[wacul_night_shift_type_id]' => '',
            'candidate[referer_url]' => '',
            'candidate[landing_url]' => '',
            'candidate[ab_type]' => '',
            'candidate[utm_source]' => '',
            'candidate[utm_medium]' => '',
            'candidate[qtgt]' => '',
            'candidate[qcre]' => '',
            'candidate[qtyp]' => '',
            'candidate[qdiv]' => '',
            'candidate[qafl]' => '',
            'candidate[qmmday]' => '',
            'candidate[qmmarea]' => '',
            'candidate[qkwd]' => '',
            'candidate[qmmid]' => '',
            'candidate[qmmabt]' => '',
            'candidate[qmmcdk]' => '',
            'candidate[office_location_prefecture]' => $hope_work_location['region'],
            'candidate[employment_type_id]' => '',
            'candidate[employment_type_id]' => $employment_type_id,
            'candidate[working_type_id]' => $working_type_id,
            'candidate[employment_time_type_id]' => $employment_time_type_id,
            'candidate[time_career_change]' => $date,
            'candidate[termination_status_id]' => $origin_data['wk_state'],
            'candidate[birth_year]' =>  $origin_data['birth_year'] . '-' . '01' . '-' . '01',//'1996-01-01',
            'candidate[prefecture]' => $live_location_data['0']['region'],
            'candidate[email]' => $origin_data['mail'],
            'candidate[phone_number]' => $origin_data['tel'],
            'candidate[name]' => $origin_data['sei'] .' '. $origin_data['mei'],
            'candidate[name_kana]' =>  $origin_data['seikana'] .' '. $origin_data['meikana'],
        ];

        // var_export($this->post_data);die;
        $this->second_data = [
            'candidate[email_registered]' => 'false',
            'candidate[office_id]' => '',
            'candidate[job_id]' => '',
            'candidate[template_id]' => 'tmp_p0001',
            'candidate[form_id]' => '',
            'candidate[register_url]' => '/plp/pc/fm_p02/tmp_p0001',
            'candidate[action_name]' => 'slide',
            'candidate[form_type]' => 'fm_p02',
            'candidate[nurse_type_array][]' => '',
            'candidate[nurse_type_array][]' => '正看護師',
            'candidate[nurse_type_array][]' => '准看護師',
            'candidate[night_shift_type_id]' => '105',
            'candidate[cognitive_route]' => '携帯のバナー広告'
        ];
    }

    public function get_token()
    {
        return str_get_html($this->pre_body)->find('input[name="authenticity_token"]', 0)->value;
    }
    public function get_object_id(){
        return str_get_html($this->pre_body)->find('input#candidate_candidate_object_id', 0)->value;
    }
    public function get_entry_history_object_id(){
        return str_get_html($this->pre_body)->find('input#candidate_candidate_entry_history_object_id', 0)->value;
    }
    public function get_entry_code(){
        return str_get_html($this->pre_body)->find('input#candidate_entry_code', 0)->value;
    }
    public function init()
    {
        parent::init();
        $this->second_data['authenticity_token'] = $this->get_token();
        $this->second_data['candidate[candidate_object_id]'] = $this->get_object_id();
        $this->second_data['candidate[candidate_entry_history_object_id]'] = $this->get_entry_history_object_id();
        $this->second_data['candidate[entry_code]'] = $this->get_entry_code();

        $response = $this->client->request('POST', 'https://iryo-de-hatarako.net/completion/questionnaire/', [
            'form_params' => $this->second_data,
            'allow_redirects' => true
        ]);
        $this->pre_body = $response->getBody();
        return $this->pre_body;
    }
}
