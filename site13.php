<?php
class Site13 extends Controller
{
    public $license=[
        'seikan'=>'2',
        'junkan'=>'5'
    ];
    public $hope_work_type=[
        'day'=>'1',
        'daynight'=>'2',
        'nightonly'=>'3', 
        'less'=>'4',
        'greater'=>'4'
    ];
    public $work_state=[
        '1'=>'1',
        '2'=>'1',
        '3'=>'2',
        '4'=>'3'
    ];
    public $sex=[
        'female'=>'1',
        'male'  =>'2'
    ];
    public function __construct()
    {
        $this->url = 'https://job-medley.com/lp/ans/18011/pc/';
        $this->post_url = 'https://job-medley.com/members/?done=lp&job_category_code=ans';
        parent::__construct();
    }

    public function filter_data()
    {
        $origin_data = $_POST;
        $license=$this->license[$origin_data['sikaku']];
        $hope_work_type=$this->hope_work_type[$origin_data['jobm']];
        $work_state=$this->work_state[$origin_data['mcjobm']];
        $sex=$this->sex[$origin_data['sex']];
        $this->post_data = [
            'utf8' => '✓',
            'member[employment_status]' => $work_state,
            'member[postal_code]' => $origin_data['zip'],
            'member[prefecture_id]' => $origin_data['region'],
            'member[city_id]' => $origin_data['city'],
            'member[town]' => $origin_data['house'],
            'member[building]' => '建物名',
            'member[birthday(1i)]' => $origin_data['birth_year'],
            'member[birthday(2i)]' => $origin_data['birth_month'],
            'member[birthday(3i)]' => $origin_data['birth_day'],
            'member[family_name]' => $origin_data['sei'],
            'member[first_name]' => $origin_data['mei'],
            'member[family_kana]' => $origin_data['seikana'],
            'member[first_kana]' => $origin_data['meikana'],
            'member[gender]' => $sex,
            'member[tel]' => $origin_data['tel'],
            'member[email]' => $origin_data['mail'],
            'member[password]' => $origin_data['password'],
            'member[job_category_ids][]' => '3',
            'form[submit]' => '無料登録する',
        ];
        if($license=='2'){
            $this->post_data['member[qualifications]'][]='';
            $this->post_data['member[qualifications]'][]=$license;
            $this->post_data['member[qualifications]'][]='';
        }
        elseif($license=='5'){
            $this->post_data['member[qualifications]'][]='';
            $this->post_data['member[qualifications]'][]='';
            $this->post_data['member[qualifications]'][]=$license;
        }

        if($hope_work_type=='1'){
           $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type'] = '';
           $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '1';
           $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
           $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
           $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            
        }
        elseif($hope_work_type=='2'){
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '2';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
        }
        elseif($hope_work_type=='3'){
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '3';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';

        }
        elseif($hope_work_type=='4'){
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '';
            $this->post_data['member[member_desired_employment_types_attributes'][]['employment_type]'] = '4';

        }

        
    }
}
