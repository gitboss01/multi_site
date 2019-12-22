<?php
class Site04 extends Controller
{

    public function __construct()
    {
        $this->url = 'https://www.kango-pro.jp/landingafi/';
        $this->post_url = 'https://www.kango-pro.jp/registration/submit.php';

        parent::__construct();
    }

    public function filter_data()
    {
        $origin_data = $_POST;

        $this->post_data = array(
            'id' => $this->get_id(),
            //POSITION:
            //mode:exec
            'prefecture_id' => $this->get_prefecture_id(),
            'name' => $origin_data['sei'] . $origin_data['mei'],
            'contact' => $origin_data['tel'],
            'mail' => $origin_data['mail'],
            'etc' => $origin_data['remarks']
        );
    }

    public function get_id()
    {
        return str_get_html($this->pre_body)->find('input[name="id"]', 0)->value;
    }

    public function get_prefecture_id()
    {
        return str_get_html($this->pre_body)->find('input[name="prefecture_id"]', 0)->value;
    }
}
