<?php

class Site11 extends Controller
{
    public $licens = [
        'seikan' => '010103',
        'junkan' => '010104'
    ];
    public $current_state = [
        '1' => '0',
        '2' => '1',
        '3' => '5',
        '4' => '2'
    ];
    public $employee_type = [
        'day' => '1',
        'daynight' => '2',
        'nightonly' => '5',
        'less' => '3',
        'greater' => '4'

    ];
    public function __construct()
    {
        $this->url = 'https://mc-nurse.net/regists/lpStep/';
        $this->post_url = 'https://mc-nurse.net/regists/lpStep/finish/';

        parent::__construct();
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $address = $db->select("cities", "name", ["id" => $origin_data['city']]);
        $age = date('y', strtotime("-{$origin_data['birth_year']} year"));

        $this->post_data = [
            '_method' => 'POST',
            'data[Regist][vcJobID]' => $this->licens[$origin_data['sikaku']],
            'data[Regist][vcNowSituation]' => $this->current_state[$origin_data['mcjobm']],
            'data[Regist][vcEmploymentType][]' => $this->employee_type[$origin_data['mc']],
            // 'data[Regist][vcEmploymentType][]'=>'3',
            'data[Regist][postal]' => $origin_data['zip'],
            'data[Regist][vcLocalID]' => $origin_data['region'],
            'data[Regist][address]' => $address['0'],
            'data[Regist][vcFamilyName]' => $origin_data['sei'],
            'data[Regist][vcFirstName]' => $origin_data['mei'],
            'data[Regist][ruby]' => $origin_data['seikana'],
            'data[Regist][ruby2]' => $origin_data['meikana'],
            'data[Regist][tel]' => $origin_data['tel'],
            'data[Regist][email]' => $origin_data['mail'],
            'data[Regist][age]' => $age,
            'data[Regist][body]' => $origin_data['remarks'],
            'data[Regist][pageIdentifer]' => 'index',
        ];
    }
}
