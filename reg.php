<?php
require 'vendor/autoload.php';

abstract class Controller {
    
    public $url = '';
    public $post_url = '';
    public $post_data = [];
    public $pre_body;
    public $client;
    
    public function __construct(){
        $this->client = new \GuzzleHttp\Client([
            'cookies' => true,
            'proxy' => 'https://107.181.177.134:443',
        ]);
        $response = $this->client->request('GET', $this->url);
        $this->pre_body = (string) $response->getBody();
    }

    public function init(){
        $this->filter_data();
        $response = $this->client->request('POST', $this->post_url, [
            'form_params' => $this->post_data,
            'allow_redirects' => true,
            'headers' => $this->header()
        ]);
        $this->pre_body = (string) $response->getBody();
        return $this->pre_body;
    }

    abstract function filter_data();

    public function header(){
        return [];
    }
}