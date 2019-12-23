<?php

class Site02 extends Controller
{
    public $license=[
        'seikan'=>'1',
        'junkan'=>'2'
    ];
    public $work_type=[
        '1'=>'jokin_n',
        '2'=>'jokin',
        '3'=>'yakin',
        '4'=>'hijokin_h',
        '5'=>'hijokin',
        '99'=>'hijokin_h'
    ];
   
    public $work_state =[
        '10'=>1,
        '20'=>2
    ];
    public function __construct()
    {
        $this->url = 'https://j-depo.com/kango/register';
        $this->post_url = 'https://j-depo.com/kango/register';

        parent::__construct();
    }

    public function init(){
        $this->filter_data();

        $this->client->request('POST', $this->post_url, [
            'form_params' => $this->first_data,
            'allow_redirects' => true
        ]);

        $this->client->request('POST', 'https://j-depo.com/user/edit/terms?r=1', [
            'form_params' => $this->second_data,
            'allow_redirects' => true
        ]);

        $response = $this->client->request('POST', 'https://j-depo.com/user/edit/resume?r=1', [
            'form_params' => $this->third_data,
            'allow_redirects' => true
        ]);
        return $response->getBody();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $region=$db->select("region_name","region",["id"=>$origin_data['region']]);
        $city=$db->select("cities","name",["id"=>$origin_data['city']]);
        if($origin_data['jiki']=='99'){
            $origin_data['jiki']=12;
        }
        $hope_term=date('Y-m',strtotime("+{$origin_data['jiki']} month")); 
        $hope_year_month=explode("-",$hope_term);
        $hope_region=$db->select("region_name","region",["id"=>$origin_data['hope_region']]);
        $hope_city=$db->select("cities","name",["id"=>$origin_data['hope_city']]);
        

        $this->first_data = array(
            '_method'=>'POST',
            'data[User][login]'=>$this->get_user_id(),
            'mode'=>'send',
            'data[User][name]'=>$origin_data['sei'].$origin_data['mei'],
            'data[User][birthdate][year]'=>$origin_data['birth_year'],
            'data[User][birthdate][month]'=>$origin_data['birth_month'],
            'data[User][birthdate][day]'=>$origin_data['birth_day'],
            'data[User][certi][]'=>$this->license[$origin_data['sikaku']],
            'data[User][pref]'=>$region['0'],
            'data[User][address]'=>$city['0'],
            'data[User][tel]'=>$origin_data['tel'],
            'data[User][email]'=>$origin_data['mail'],
        );

        $this->second_data = [
            '_method'=>'PUT',
            'data[User][recruit_type]'=>'',
            'data[User][recruit_type][]'=>$this->work_type[$origin_data['hatarakikata']],
            // 'data[User][recruit_type][]'=>'jokin_n',
            'data[User][recruit_weekday]'=>'',
            'data[User][recruit_weekday][]'=>'0',
            // 'data[User][recruit_weekday][]'=>'2',
            // 'data[User][recruit_weekday][]'=>'4',
            'data[User][com_type]'=>'',
            'data[User][com_type][]'=>'2',
            'data[User][com_type][]'=>'10',
            'data[User][workstart][year]'=>$hope_year_month[0],
            'data[User][workstart][month]'=>$hope_year_month[1],
            'data[User][salary]'=>'4',
            'data[User][terms_pref][0]'=>$hope_region[0],
            'data[User][terms_city][0]'=>$hope_city[0],
            'data[User][terms_pref][1]'=>'',
            'data[User][terms_city][1]'=>'',
            'data[User][terms_pref][2]'=>'',
            'data[User][terms_city][2]'=>'',
            'data[User][terms_pref][3]'=>'',
            'data[User][terms_city][3]'=>'',
            'data[User][terms_pref][4]'=>'',
            'data[User][terms_city][4]'=>'',
            'data[User][terms_pref][5]'=>'',
            'data[User][terms_city][5]'=>'',
            'data[User][terms_pref][6]'=>'',
            'data[User][terms_city][6]'=>'',
            'data[User][terms_pref][7]'=>'',
            'data[User][terms_city][7]'=>'',
            'data[User][terms_pref][8]'=>'',
            'data[User][terms_city][8]'=>'',
            'data[User][terms_pref][9]'=>'',
            'data[User][terms_city][9]'=>'',
            'data[User][jobs_type]'=>'kango',
            'data[User][id]'=>'97538',
            'mode'=>'confirm',
        ];

        $this->third_data = [
            '_method'=>'PUT',
            'data[User][certi_year]'=>$origin_data['year'],
            'data[User][family]'=>'',
            'data[User][family]'=>'1',
            'data[User][workstatus]'=>$this->work_state[$origin_data['wk_state']],
            'data[User][workend][year]'=>'',
            'data[User][workend][month]'=>'',
            'data[User][recruit_status]'=>'0',
            'data[User][career_flag]'=>'',
            'data[Career][0][year]'=>'',
            'data[Career][0][month]'=>'',
            'data[Career][0][com_type]'=>'',
            'data[Career][0][business]'=>'',
            'data[Career][1][year]'=>'',
            'data[Career][1][month]'=>'',
            'data[Career][1][com_type]'=>'',
            'data[Career][1][business]'=>'',
            'data[Career][1][specialty]'=>'',
            'data[Career][2][year]'=>'',
            'data[Career][2][month]'=>'',
            'data[Career][2][com_type]'=>'',
            'data[Career][2][business]'=>'',
            'data[Career][2][specialty]'=>'',
            'data[Career][3][year]'=>'',
            'data[Career][3][month]'=>'',
            'data[Career][3][com_type]'=>'',
            'data[Career][3][business]'=>'',
            'data[Career][3][specialty]'=>'',
            'data[Career][4][year]'=>'',
            'data[Career][4][month]'=>'',
            'data[Career][4][com_type]'=>'',
            'data[Career][4][business]'=>'',
            'data[Career][4][specialty]'=>'',
            'data[Career][5][year]'=>'',
            'data[Career][5][month]'=>'',
            'data[Career][5][com_type]'=>'',
            'data[Career][5][business]'=>'',
            'data[Career][5][specialty]'=>'',
            'data[Career][6][year]'=>'',
            'data[Career][6][month]'=>'',
            'data[Career][6][com_type]'=>'',
            'data[Career][6][business]'=>'',
            'data[Career][6][specialty]'=>'',
            'data[Career][7][year]'=>'',
            'data[Career][7][month]'=>'',
            'data[Career][7][com_type]'=>'',
            'data[Career][7][business]'=>'',
            'data[Career][7][specialty]'=>'',
            'data[Career][8][year]'=>'',
            'data[Career][8][month]'=>'',
            'data[Career][8][com_type]'=>'',
            'data[Career][8][business]'=>'',
            'data[Career][8][specialty]'=>'',
            'data[Career][9][year]'=>'',
            'data[Career][9][month]'=>'',
            'data[Career][9][com_type]'=>'',
            'data[Career][9][business]'=>'',
            'data[Career][9][specialty]'=>'',
            'data[Career][10][year]'=>'',
            'data[Career][10][month]'=>'',
            'data[Career][10][com_type]'=>'',
            'data[Career][10][business]'=>'',
            'data[Career][10][specialty]'=>'',
            'data[Career][11][year]'=>'',
            'data[Career][11][month]'=>'',
            'data[Career][11][com_type]'=>'',
            'data[Career][11][business]'=>'',
            'data[Career][11][specialty]'=>'',
            'data[Career][12][year]'=>'',
            'data[Career][12][month]'=>'',
            'data[Career][12][com_type]'=>'',
            'data[Career][12][business]'=>'',
            'data[Career][12][specialty]'=>'',
            'data[Career][13][year]'=>'',
            'data[Career][13][month]'=>'',
            'data[Career][13][com_type]'=>'',
            'data[Career][13][business]'=>'',
            'data[Career][13][specialty]'=>'',
            'data[Career][14][year]'=>'',
            'data[Career][14][month]'=>'',
            'data[Career][14][com_type]'=>'',
            'data[Career][14][business]'=>'',
            'data[Career][14][specialty]'=>'',
            'data[Career][15][year]'=>'',
            'data[Career][15][month]'=>'',
            'data[Career][15][com_type]'=>'',
            'data[Career][15][business]'=>'',
            'data[Career][15][specialty]'=>'',
            'data[Career][16][year]'=>'',
            'data[Career][16][month]'=>'',
            'data[Career][16][com_type]'=>'',
            'data[Career][16][business]'=>'',
            'data[Career][16][specialty]'=>'',
            'data[Career][17][year]'=>'',
            'data[Career][17][month]'=>'',
            'data[Career][17][com_type]'=>'',
            'data[Career][17][business]'=>'',
            'data[Career][17][specialty]'=>'',
            'data[Career][18][year]'=>'',
            'data[Career][18][month]'=>'',
            'data[Career][18][com_type]'=>'',
            'data[Career][18][business]'=>'',
            'data[Career][18][specialty]'=>'',
            'data[Career][19][year]'=>'',
            'data[Career][19][month]'=>'',
            'data[Career][19][com_type]'=>'',
            'data[Career][19][business]'=>'',
            'data[Career][19][specialty]'=>'',
            'data[User][jobs_type]'=>'kango',
            'data[User][id]'=>'97538',
            'mode'=>'confirm',
        ];
    }

    public function get_user_id()
    {
        $html = str_get_html($this->pre_body);
        return $html->find('input#UserLogin', 0)->value;
    }
}
