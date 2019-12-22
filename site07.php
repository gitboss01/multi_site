<?php

class Site07 extends Controller
{
    public $license=[
        'seikan'=>'看護師',
        'junkan'=>'准看護師'
    ];
    public $work_type=[
        '1'=>'常勤',
        '2'=>'非常勤',
        '3'=> '派遣',
        '4'=>'単発',
        '99'=>'その他'
    ];
    public function __construct()
    {
        $this->url = 'https://www.nursejj.com/adv/nursejj_lp.html';
        $this->post_url = 'https://www.nursejj.com/adv/mail.php';
        parent::__construct();
    }
    
    
    

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $first_tel=substr($origin_data['tel'],0,2);
        $second_tel=substr($origin_data['tel'],2,4);
        $last_tel=substr($origin_data['tel'],-1,4);
        $region=$db->select("region_name","region",['id'=>$origin_data['region']]);
        $city=$db->select("cities","name",['id'=>$origin_data['city']]);
        $this->post_data = [
            '名前'=>$origin_data['sei'] . $origin_data['mei'],
            'フリガナ'=> $origin_data['seikana'] . $origin_data['meikana'],
            '保有資格[]'=>$this->license[$origin_data['sikaku']],
            '勤務形態[]'=>$this->work_type[$origin_data['jj']],
            '誕生年'=>$origin_data['birth_year'],
            '都道府県'=>$region['0'],
            '市区町村'=>$city['0'],
            '電話番号'=>$first_tel.'-'.$second_tel.'-'.$last_tel,
            'Email'=>$origin_data['mail'],
            'ご要望'=>$origin_data['remarks'],
        ];
    }

    public function header(){
        return [
            'referer' => 'https://www.nursejj.com/adv/nursejj_lp.html',
        ];
    }
}
