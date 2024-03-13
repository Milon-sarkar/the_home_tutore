<?php

function convert_base64_from_path($path){
    $path = public_path().$path;

    if (file_exists($path)) {
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        return $base64;
    }
    return null;
}


function square_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/backend/images/square-img.png';
}

function get_settings($title){
    return \App\Models\Setting::where('id', 1)->first()->$title;
}

function shortText($string,$length = 50){
    $string = strip_tags($string);
    if (strlen($string) > $length) {

        // truncate string
        $stringCut = substr($string, 0, $length);
        $endPoint = strrpos($stringCut, ' ');

        //if the string doesn't contain any space then it will cut without word basis.
        $string = $endPoint? substr($stringCut, 0, $endPoint)."..." : substr($stringCut, 0)."...";
    }
    return $string;
}


function welcome_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/demo-welcome.png';
}
function user_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/user.png';
}
function marksheet($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/marksheet.png';
}
function cover_img($path = null){
    if($path){
        if(file_exists(public_path().$path)){
            return $path;
        }
    }

    return '/img/cover-img.png';
}


function sendSms($number, $text){

    $text = $text. "\n \n -The Home Tutor";

    $url = "http://bulksmsbd.net/api/smsapi";
    $data= array(
        'api_key'=>"SExhZmH0NZKJrJNV4QZb",
        'type'=>"text",
        'senderid'=>"8809617611065",
        'number'=>"$number",
        'message'=>$text,
    );


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $smsresult = curl_exec($ch);
    $p = explode("|",$smsresult);
    $sendstatus = $p[0];
    return $sendstatus;
}


function get_balance() {
    $url = "https://bulksmsbd.net/api/getBalanceApi";
    $api_key = "SExhZmH0NZKJrJNV4QZb";
    $data = [
        "api_key" => $api_key
    ];
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function sendWhatsAppMsg($number, $text = ''){

    $test = '{"to": "8801819075764", "type": "template", "template": { "name": "hello_world", "language": { "code": "en_US" }}}';

    $data = array(
        'messaging_product' => 'whatsapp',
        'to' => $number,
        'type' => 'template',
        'template' => [
            'name' => 'hello, how are you?',
            'language' => [
                'code' => 'en_US'
            ]
        ]
    );

    $data = json_encode($data);
//    return $data;

    $headers = array(
        'Authorization' => 'Bearer EAALAqt1VeZAgBAHtomJ7aGdthGiQmhYc5M5Nqx0Bflb0tLF3PpbqWiqWYtWRe5BUjlpkE0ScPczYq0n7J73WZCwjEadV2SYPmpe6Hp5T6H0SQ5OkxpvC4ZA0igm98TJNTJypxx6CelDUaazxSOhyNFNqcOtj72bJOELINFZBxOKeZCIZAWHvLh9EeugtiYz9vmC6WDU3RR6ZCDcW8HXXK90',
        'Content-Type' => 'application/json',
        'messaging_product' => 'whatsapp'
    );
    $url = 'https://graph.facebook.com/v13.0/103961059121860/messages';


    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.6) Gecko/20070725 Firefox/2.0.0.6");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//    curl_setopt($ch, CURLOPT_POSTFIELDS, "messaging_product=whatsapp");
    $reply = curl_exec($ch);

    return $reply;

//    curl -i -X POST `
//  https://graph.facebook.com/v13.0/103961059121860/messages `
//    -H 'Authorization: Bearer EAALAqt1VeZAgBAKXnnco0XLgXKhuOHxZBaksyrugy6qmBgrzD0s0AcYQg4TZANlK1iDZAkWHxlQTnQz2PGrZB2scU3vhOfU9wx8AIXvv6YjXe8mZA9ob9jHXEwRuUQPfR3v9lyMYZBnnDgY5LtiWjoeDrPPY66rNjcE7c28tsAlxWo0ZAa4utdQNtv41pelyBrc9xjeqUtCljgd4IJDHtI04' `
//  -H 'Content-Type: application/json' `
//    -d '{ \"messaging_product\": \"whatsapp\", \"to\": \"\", \"type\": \"template\", \"template\": { \"name\": \"hello_world\", \"language\": { \"code\": \"en_US\" } } }'

}


// menu active
function menu_active($route, $route2 = '', $route3 = '', $route4 = '', $route5 = '', $route6 = '', $route7 = '', $route8 = '', $route9 = '', $route10 = ''){
    if (Request::routeIs($route) || Request::routeIs($route2) || Request::routeIs($route3) || Request::routeIs($route4) || Request::routeIs($route5) || Request::routeIs($route6) || Request::routeIs($route7) || Request::routeIs($route8) || Request::routeIs($route9) || Request::routeIs($route10)){
        return true;
    }else{
        return false;
    }
}

if(!function_exists('bn2en')){

    function bn2en($number)
    {
        $bn_number = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en_number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        return str_replace($bn_number, $en_number, $number);
    }
}

if(!function_exists('en2bn')){

    function en2bn($number)
    {
        $bn_number = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en_number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        return str_replace($en_number, $bn_number, $number);
    }
}



if(!function_exists('bn2en_only')){

    function bn2en_only($number)
    {
        $bn_number = ["১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০"];
        $en_number = ["1", "2", "3", "4", "5", "6", "7", "8", "9", "0"];

        $string = str_replace($bn_number, $en_number, $number);

        $number = preg_replace('/[^0-9 ."\']/',null, $string);
        if($number == ''){
            return null;
        }
        return $number;
    }
}
