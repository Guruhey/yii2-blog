<?php
function curl_get($url, $referer = 'http://www.google.com')
{
        $ch =  curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64;rv:38.0) Gecko/20100101 Firefox/38.0");
        curl_setopt($ch, CURLOPT_REFERER, $referer);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $data  = curl_exec($ch);
        curl_close($ch);
        return $data;

}
function getItems($url)
{
    $file =  curl_get($url);

    preg_match_all('/<span class="price price-m".*[^>]*>([\s\S]*?),/',$file,$outer);
    preg_match_all('/a class=" product.*title="(.*)item/',$file,$out);
    preg_match_all('/a class=" product.*(href="(.*))title/',$file,$links);

    foreach ($out[1] as $result1)
    {
        $item = str_replace('&nbsp;','',array_shift($outer[1]));

        $ourprice = $item / 10;

        echo '<div><a href=' . trim(array_shift($links[2]),"&#34;") . '>' . '</a></div>' . $result1 . ' ' . ($item + $ourprice) . ' руб.' .  '<br>';
    }
}
getItems('https://ru.aliexpress.com/category/202000104/laptops.html');
