<?php
require 'mysql_con.php'; 

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Multi_site_Register</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $(`#city>optgroup`).hide();
            $('#region').on('change', function(){
                let region = $(this).val();
                $(`#city>optgroup[label!='${region}']`).hide();
                $(`#city>optgroup[label='${region}']`).show();
            });
        });
        $(document).ready(function(){
            $(`#hope_city>optgroup`).hide();
            $('#hope_region').on('change', function(){
                let region = $(this).val();
                $(`#hope_city>optgroup[label!='${region}']`).hide();
                $(`#hope_city>optgroup[label='${region}']`).show();
            });
        });
    </script>
</head>
<body>
    <form action="./register.php" method="post" id="register" enctype="multipart/form-data">

        <fieldset>
            <legend>一括登録するサイト</legend>
            <label><input type="checkbox" name="site[]" value="1">看護のお仕事</label>
            <label><input type="checkbox" name="site[]" value="2">ジョブデポ</label>
            <label><input type="checkbox" name="site[]" value="3">ナースではたらこ</label>
            <label><input type="checkbox" name="site[]" value="4">看護プロ</label>
            <label><input type="checkbox" name="site[]" value="5">キャリアプレゼント</label>
            <label><input type="checkbox" name="site[]" value="6">ナース人材バンク</label>
            <label><input type="checkbox" name="site[]" value="7">ナースJJ</label>
            <label><input type="checkbox" name="site[]" value="8">美容外科求人ガイド</label>
            <label><input type="checkbox" name="site[]" value="9">ナースパワー</label>
            <label><input type="checkbox" name="site[]" value="10">マイナビ看護師</label>
            <label><input type="checkbox" name="site[]" value="11">MCナースネット</label>
            <label><input type="checkbox" name="site[]" value="12">セレジョブ看護</label>
            <label><input type="checkbox" name="site[]" value="13">ジョブメドレー</label>
           
           
            
        </fieldset>

        <fieldset>
            <legend>保有資格</legend><!-- 除外（ナースではたらこ・看護プロ） -->
            <label><input type="radio" name="sikaku" value="seikan" required>看護師</label>
            <label><input type="radio" name="sikaku" value="junkan" required>准看護師</label>
        </fieldset>

        <fieldset>
            <legend>資格取得年(※ナースパワー登録用)</legend>
            <label>年<input type="number" name="year" max="2050" min="1960" id="" required><label>
            <label>月<input type="number" name="month" max="12" min="1" id="" required><label>
        </fieldset>
        
        <fieldset>
            <legend>希望の転職時期</legend><!-- 看護のお仕事・ナース人材バンク・マイナビ看護師・ナースではたらこ・キャリアプレゼント・美容外科求人ガイド・ナースパワー -->
            <label><input type="radio" name="jiki" value="1" required>1月以内</label>
            <label><input type="radio" name="jiki" value="2" required>2月以内</label>
            <label><input type="radio" name="jiki" value="3" required>3月以内</label>
            <label><input type="radio" name="jiki" value="6" required>半年以内</label>
            <label><input type="radio" name="jiki" value="12" required>1年以内</label>
            <label><input type="radio" name="jiki" value="99" required>その他</label>
        </fieldset>

        <fieldset>
            <legend>お仕事の状況(※ナースではたらこ登録用)</legend><!-- ・ナースではたらこ -->
            <label><input type="radio" name="wk_state" value="10" required>在職中</label>
            <label><input type="radio" name="wk_state" value="20" required>離職中</label>
           
        </fieldset>
        <fieldset>
            <legend>お仕事の状況(※ナース人材バンク登録用)</legend><!-- ・ナース人材バンク -->
            <label><input type="radio" name="bank" value="1" required>離職中／退職確定済</label>
            <label><input type="radio" name="bank" value="2" required>できるだけ早く辞めたい</label>
            <label><input type="radio" name="bank" value="3" required>良い転職先なら辞めたい</label>
            <label><input type="radio" name="bank" value="4" required>良い転職先なら検討する</label>
            <label><input type="radio" name="bank" value="5" required>半年以上は辞められない</label>
            <label><input type="radio" name="bank" value="6" required>あまりやめるきはない</label>
            <label><input type="radio" name="bank" value="99" required>その他</label>
        </fieldset>

        <fieldset>
            <legend>お仕事の状況(※MCナース/ジョブメドレー登録用)</legend><!-- MCナース・ジョブメドレー -->
            <label><input type="radio" name="mcjobm" value="1" required>常勤勤務中</label>
            <label><input type="radio" name="mcjobm" value="2" required>非常勤勤務中</label>
            <label><input type="radio" name="mcjobm" value="3" required>退職予定</label>
            <label><input type="radio" name="mcjobm" value="4" required>フリー</label>
        </fieldset>

        <fieldset>
            <legend>希望の働き方</legend><!-- 看護のお仕事・ナース人材バンク・マイナビ看護師・ナースではたらこ・ジョブメドレー・ナースパワー -->
            <label><input type="radio" name="hatarakikata" value="1" required>常勤(日勤のみ)</label>
            <label><input type="radio" name="hatarakikata" value="2" required>常勤(夜勤含む)</label>
            <label><input type="radio" name="hatarakikata" value="3" required>夜勤専従</label>
            <label><input type="radio" name="hatarakikata" value="4" required>非常勤(週20時間未満)</label>
            <label><input type="radio" name="hatarakikata" value="5" required>非常勤(週20時間以上)</label>
            <label><input type="radio" name="hatarakikata" value="99" required>その他</label>
        </fieldset>

        <fieldset>
            <legend>勤務形態(※ナースJJ登録用)</legend><!-- ナースJJ -->
            <label><input type="radio" name="jj" value="1" required>常勤</label>
            <label><input type="radio" name="jj" value="2" required>非常勤</label>
            <label><input type="radio" name="jj" value="3" required>派遣</label>
            <label><input type="radio" name="jj" value="4" required>単発</label>
            <label><input type="radio" name="jj" value="99" required>その他</label>
        </fieldset>
        <fieldset>
            <legend>希望の働き方(※ジョブメドレー登録用)</legend><!-- ジョブメドレー -->
            <label><input type="radio" name="jobm" value="day" required>正職員</label>
            <label><input type="radio" name="jobm" value="daynight" required>契約社員</label>
            <label><input type="radio" name="jobm" value="nightonly" required>パート・アルバイト</label>
            <label><input type="radio" name="jobm" value="less" required>業務委託</label>
            <label><input type="radio" name="jobm" value="greater" required>非常勤(週20時間以上)</label>
        </fieldset>

        <fieldset>
            <legend>ご希望雇用形態(※MCナース登録用)</legend><!-- MCナース -->
            <label><input type="radio" name="mc" value="day" required>人材派遣</label>
            <label><input type="radio" name="mc" value="daynight" required>紹介予定派遣</label>
            <label><input type="radio" name="mc" value="nightonly" required>単発・スポット</label>
            <label><input type="radio" name="mc" value="less" required>正社員(就職)</label>
            <label><input type="radio" name="mc" value="greater" required>パート(就職)</label>
        </fieldset>


        <fieldset>
            <legend>希望種別(※ナースパワー登録用)</legend><!-- ナースパワー -->
            <label><input type="radio" name="np" value="day" required>一般募集の常勤・パートの登録をします</label>
            <label><input type="radio" name="np" value="daynight" required>月収45万円以上確実「都市圏応援ナース」として登録します</label>
            <label><input type="radio" name="np" value="nightonly" required>６ヶ月短期「離島応援ナース」として登録します</label>
            <label><input type="radio" name="np" value="less" required>６ヶ月短期「沖縄応援ナース」として登録します</label>
            <label><input type="radio" name="np" value="greater" required>「派遣ナース・長期アルバイト」として登録します</label>
        </fieldset>

        <fieldset>
            <legend>お名前</legend><!-- 標準 -->
            <label>姓<input type="text" name="sei" required></label>
            <label>名<input type="text" name="mei" required></label>            
        </fieldset>

        <fieldset>
                <legend>ふりがな</legend><!-- 標準 -->
                <label>姓<input type="text" name="seikana" required></label>
                <label>名<input type="text" name="meikana" required></label>            
        </fieldset>

        <fieldset id="selejob">
                <legend>性別 </legend><!-- セレジョブ・キャリアプレゼント・看護プロ・美容外科求人ガイド -->
                <label><input type="radio" name="sex" value="female" required>女性</label>
                <label><input type="radio" name="sex" value="male" required>男性</label>
        </fieldset>

        <fieldset>
            <legend>誕生日</legend><!-- セレジョブ・看護プロ以外の全て -->
            <label>年(西暦)<input type="number" name="birth_year" min="1960" max="2019" required></label>
            <label>月<input type="number" name="birth_month" min="1" max="12" required></label>
            <label>日<input type="number" name="birth_day" min="1" max="31" required></label>
        </fieldset>

        <fieldset>
            <legend>電話番号</legend><!-- 標準 -->
            <input type="telphone" name="tel" required>
        </fieldset>

        <fieldset>
            <legend>e-mail</legend><!-- 標準 -->
            <input type="email" name="mail" required>
        </fieldset>

        <fieldset>
            <?php 
                global $db;
                $regions=$db->select("region_name","*");
                $cities=$db->select("cities","*");
               
            ?>
                <legend>お住まいの住所</legend><!-- ナースJJ・マイナビ看護師・ジョブデポ・ナースではたらこ・看護プロ -->
                <label>郵便番号<input type="text" name="zip" required></label><br>
                <!-- <label>県<input type="text" name="pref" required></label><br> -->
                <label>県<select name="region" id="region" >
                    <option value="">県</option>
                    <?php 
                    $region_arr = [];
                    foreach($regions as $region){
                        $region_arr[$region['id']] = $region['id'];
                    ?>
                        <option id="<?php echo $region['id'];?>" value="<?php echo $region['id'];?>" ><?php echo $region['region'];?></option>
                    <?php
                    }
                    ?>
                    
                   
                </select>
                </label><br>
                <!-- <label>市区町村<input type="text" name="city" required></label><br> -->
                <label>市区町村<select name="city" id="city" style="background-image: none;">
                    <option value="">市区町村</option>
                    <?php 
                    $options = [];
                    foreach($cities as $city){
                        if(!isset($options[$city['prefecture_id']])){
                            $options[$city['prefecture_id']] = '';
                        }
                        $options[$city['prefecture_id']] .= "<option value='{$city['id']}'>{$city['name']}</option>";
                    }
                    foreach($options as $key=>$opt){
                        echo "<optgroup label='{$region_arr[$key]}'>{$opt}</optgroup>";
                    }
                    ?>
                    
                </select>
                </label><br>
                <label class="house">番地<input type="text" name="house" class="house" required> ※マイナビ看護師登録用</label> 
        </fieldset>

        <fieldset>
                <legend>ご希望の勤務地</legend><!-- 看護のお仕事・マイナビ看護師・ナースではたらこ・キャリアプレゼント・美容外科求人ガイド・ナースパワー -->
                <!-- <label>(第一希望)県<input type="text" name="pref1" required></label> -->
                <label>(第一希望)県<select name="hope_region" id="hope_region" >
                    <option value="">県</option>
                    <?php 
                    $hope_region_arr = [];
                    foreach($regions as $region){
                        $hope_region_arr[$region['id']] = $region['id'];
                    ?>
                        <option id="<?php echo $region['id'];?>" value="<?php echo $region['id'];?>" ><?php echo $region['region'];?></option>
                    <?php
                    }
                    ?>
                    
                   
                </select>
                </label><br>
                <!-- <label>市区町村<input type="text" name="city1" required></label><br> -->
                <label>市区町村<select name="hope_city" id="hope_city" style="background-image: none;">
                    <option value="">市区町村</option>
                    <?php 
                    $hope_options = [];
                    foreach($cities as $city){
                        if(!isset($hope_options[$city['prefecture_id']])){
                            $hope_options[$city['prefecture_id']] = '';
                        }
                        $hope_options[$city['prefecture_id']] .= "<option value='{$city['id']}'>{$city['name']}</option>";
                    }
                    foreach($hope_options as $key=>$opt){
                        echo "<optgroup label='{$hope_region_arr[$key]}'>{$opt}</optgroup>";
                    }
                    ?>
                    
                </select>
                </label><br>
                <!-- <label>(第二希望)県<input type="text" name="pref2" required></label> -->
                <label>(第二希望)県<select name="hope2_region" id="hope2_region" >
                    <option value="">県</option>
                    <?php 
                    $region_arr = [];
                    foreach($regions as $region){
                        $region_arr[$region['id']] = $region['id'];
                    ?>
                        <option id="<?php echo $region['id'];?>" value="<?php echo $region['id'];?>" ><?php echo $region['region'];?></option>
                    <?php
                    }
                    ?>
                    
                   
                </select>
                </label><br>
         </fieldset>
        
        <fieldset>
            <legend>希望連絡時間などご要望</legend><!-- 標準 -->
            <textarea name="remarks" id="" cols="30" rows="10"></textarea>
        </fieldset>
        
        <fieldset>
            <legend>実務経験(※美容外科求人ガイド登録用)</legend><!-- 美容外科求人ガイド -->
            <label><input type="radio" name="experience" value="1" required>1年未満</label>
            <label><input type="radio" name="experience" value="2" required>2年未満</label>
            <label><input type="radio" name="experience" value="3" required>3年未満</label>
            <label><input type="radio" name="experience" value="99" required>3年以上</label>
        </fieldset>
        
        <fieldset>
            <legend>美容クリニックでの経験</legend><!-- キャリアプレゼント・美容外科求人ガイド -->
            <label><input type="radio" name="experience1" value="1" required>あり</label>
            <label><input type="radio" name="experience1" value="2" required>なし</label>
        </fieldset>

        <fieldset>
                <legend>最寄り駅 (※キャリアプレゼント登録用)</legend>
                <input type="text" name="station" required>
        </fieldset>
        
        <fieldset id="jobmedley">
                <legend>パスワードの登録 (※ジョブメドレー登録用)</legend>
                <label><input type="password" name="password" required></label>
        </fieldset>

        <input type="submit" value="チェックしたサイトに一括で登録する">

    </form>
       
</body>
<javascript>

</javascript>
</html>





