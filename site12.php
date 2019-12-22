<?php

class Site12 extends Controller
{
    public $reg_licenses = [
        'seikan' => '正看護師',
        'junkan' => '准看護師'
    ];

    public function __construct()
    {
        $this->url = 'https://www.select-w.com/s-job/';
        $this->post_url = 'https://www.select-w.com/s-job/mail.php';

        parent::__construct();
    }

    public function filter_data()
    {
        $origin_data = $_POST;
        $reg_licenses = $this->reg_licenses[$origin_data['sikaku']];
        $this->post_data = array(
            'お名前_姓' => $origin_data['sei'],
            'お名前_名' => $origin_data['mei'],
            'ふりがな_姓' => $origin_data['seikana'],
            'ふりがな_名' => $origin_data['meikana'],
            '性別' => '女性',
            '電話番号' => $origin_data['tel'],
            'Email' => $origin_data['mail'],
            '保有資格' => $reg_licenses,
            // '臨床経験年数'=>'アファｓｄｆｓｄｆ',
            // '自宅からの最寄駅'=>'ア駅前',
            // '希望勤務地'=>3,
            // '現年収'=>'30万円',
            // '希望年収'=>'400万円',
            // '入職希望時期'=>'6ヶ月以内',
            // '現状不満'=>'アア',
            // 'その他希望'=>'ｂｂｂｂｂ',
            // 'その他'=>'アｓｄファｓｄファｓｄファｓｄｆｓｄｆ',
            'mail_set' => 'confirm_submit'
        );
    }
}
