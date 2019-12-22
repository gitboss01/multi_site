<?php

function cj($str)
{
    return mb_convert_encoding($str, "SJIS", "UTF-8");
}

class Site09
{
    public $header = [];
    public $url = '';
    public $post_url = '';
    public $post_data = '';
    public $pre_ch;
    public $license=[
        'seikan'=>'看護師',
        'junkan'=>'准看護師'
    ];
    public $work_type=[
        '1'=>'日勤',
        '2'=>'常勤',
        '3'=>'夜間パート',
        '4'=>'日勤パート',
        '5'=>'派遣',
        '99'=>'こだわらない'
    ];
    public function __construct()
    {
        $this->url = 'http://www.nurse-pw.jp/';
        $this->post_url = 'http://www.nurse-pw.jp/cgi-bin/kango/postmail_com.cgi';

        $this->header = [
            "Connection" => "keep-alive",
            "accept" => "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8,application/signed-exchange;v=b3",
            "accept-encoding" => "gzip, deflate, br",
            "accept-language" => "en,en-US;q=0.9,ja;q=0.8",
            "content-type" => "application/x-www-form-urlencoded",
            "origin" => "http://www.nurse-pw.jp",
            "referer" => "http://www.nurse-pw.jp/cgi-bin/kango/postmail_com.cgi",
            "Pragma" => "no-cache",
            "Cache-Control" => "no-cache",
            "upgrade-insecure-requests" => 1,
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:71.0) Gecko/20100101 Firefox/71.0',
            'Cookie' => $this->set_cookies()
        ];
    }

    public function init()
    {
        $this->filter_data();
        $curl_header = [];
        foreach ($this->header as $key => $val) {
            $curl_header[] = $key . ': ' . $val;
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->post_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $curl_header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(http_build_query($this->post_data)));

        $response = curl_exec($ch);
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            return $this->post_url . "--cURL Error #:" . $err;
        }
        return $response;
    }

    public function set_cookies()
    {
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 1);
        $this->pre_ch = curl_exec($ch);
        preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $this->pre_ch, $matches);
        $cookies = '';
        foreach ($matches[1] as $item) {
            if ($cookies !== '') $cookies .= '; ';
            $cookies .= $item;
        }
        return $cookies;
    }

    public function filter_data()
    {
        global $db;
        $origin_data = $_POST;
        $birth_year = $db->select("japan_year", "j_year", ["id" => $origin_data['birth_year']]);
        $birth_y = (int) filter_var($birth_year['0'], FILTER_SANITIZE_NUMBER_INT);
        $live_region = $db->select("region_name", "region", ['id' => $origin_data['region']]);
        $live_city = $db->select("cities", "name", ['id' => $origin_data['city']]);
        $license_achive = $db->select("japan_year", "j_year", ["id" => $origin_data['year']]);
        $license_year_go = mb_substr($license_achive['0'], 0, 2);
        $license_year = (int) filter_var($license_achive['0'], FILTER_SANITIZE_NUMBER_INT);
        $work_type1 = $this->work_type[$origin_data['hatarakikata']];
        $work_type = cj($work_type1);
        $t = [];
        if ($work_type1 == '日勤') {
            $t=  [cj("34:勤務形態1") =>$work_type];
        } elseif ($work_type1 == '常勤') {
            $t=  [cj("34:勤務形態2") => $work_type];
        } elseif ($work_type1 == '日勤パート') {
            $t=  [cj("34:勤務形態3") => $work_type];
        } elseif ($work_type1 == '夜間パート') {
            $t=  [cj("34:勤務形態4") => $work_type];
        } elseif ($work_type1 == '派遣') {
            $t=  [cj("34:勤務形態5") => $work_type];
        } elseif ($work_type1 == 'こだわらない') {
            $t=  [cj("34:勤務形態6") => $work_type];
        }
        $hope_location1=$db->select("region_name","region",["id"=>$origin_data['hope_region']]);
        $ch_lenth=mb_strlen($hope_location1['0']);
        $hope_location1_1=mb_substr($hope_location1['0'],0,$ch_lenth-1);
        $hope_location2=$db->select("region_name","region",["id"=>$origin_data['hope2_region']]);
        $ch_lenth1=mb_strlen($hope_location2['0']);
        $hope_location2_2=mb_substr($hope_location2['0'],0,$ch_lenth1);
        $this->post_data = [
            "mode" => cj('send'),
            "need" => cj('00:希望種別+01:氏名姓+02:氏名名+05:フリガナ姓+06:フリガナ名+07:生年月日元号+08:生年月日年+09:生年月日月+10:生年月日日+14:住所1+16:電話番号+19:資格1'),
            "subject" => cj('新規求職登録（アフィリエイト版）'),
            "mailto" => cj('熊本事業所'),
            "backurl" => cj('アフィリエイト'),
            cj('00:希望種別') => cj('６ヶ月短期「離島応援ナース」として登録します。 ６ヶ月短期「沖縄応援ナース」として登録します。'),
            cj('01:氏名姓') => cj($origin_data['sei']),
            cj("02:氏名名") => cj($origin_data['mei']),
            cj("05:フリガナ姓") => cj($origin_data['seikana']),
            cj("06:フリガナ名") => cj( $origin_data['meikana']),
            cj("07:生年月日元号") => cj(mb_substr($birth_year['0'],0,2)),
            cj("08:生年月日年") => cj($birth_y),
            cj("09:生年月日月") => cj($origin_data['birth_month']),
            cj("10:生年月日日") => cj($origin_data['birth_day']),
            cj("11:ＰＣメール") => cj($origin_data['mail']),
            cj("13:郵便番号") => cj($origin_data['zip']),
            cj("14:住所1") => cj($live_region['0'].' '.$live_city['0'].' '.$origin_data['house']),
            cj("16:電話番号") => cj($origin_data['tel']),
            cj("19:資格1") => cj($this->license[$origin_data['sikaku']]),
            cj("20:資格2") => cj($this->license[$origin_data['sikaku']]),
            cj("21:資格1取得元号") => cj($license_year_go),
            cj("22:資格1取得年") => cj($license_year),
            // cj("34:勤務形態1") => cj('常勤'),
            // cj("34:勤務形態3") => cj('日勤パート'),
            cj("36:勤務地第1希望") => cj($hope_location1_1),
            cj("37:勤務地第2希望") => cj($hope_location2_2),
            cj("41:勤務時期") => cj('その他'),
            // cj("43:勤務時期その他") => cj('1年2月'),
            // cj("89:職歴備考") => cj('、過去臨床経験 9年')
        ];
        $this->post_data = array_merge($t, $this->post_data);
    }
}
