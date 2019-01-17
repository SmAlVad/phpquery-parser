<?php
require_once __DIR__ . '/phpquery/phpQuery/phpQuery.php';

/**
 * Files for save data
 */
const SVOBODNI = __DIR__ . '/adv/svobodni/parsed_data';


/**
 * Get html
 *
 * @param $url
 * @param $charset
 * @param string $referer
 * @return bool|mixed|string
 */
function getPageByUrl($url, $charset, $referer = 'http://www.google.com')
{

    $user_agent = 'Mozilla/5.0 (X11; Fedora; Linux x86_64; rv:61.0) Gecko/20100101 Firefox/61.0';

    //Инициализируем сеанс
    $curl = curl_init();

    curl_setopt($curl, CURLOPT_URL, $url);

    curl_setopt($curl, CURLOPT_HEADER, false);

    curl_setopt($curl, CURLOPT_NOBODY, false);

    curl_setopt($curl, CURLOPT_USERAGENT, $user_agent);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);

    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);

    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

    curl_setopt($curl, CURLOPT_REFERER, $referer);

    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);

    $result = curl_exec($curl);

    //Отлавливаем ошибки подключения
    if ($result === false) {
        echo "Ошибка CURL: " . curl_error($curl);
        return false;
    } else {
        $result = iconv($charset, 'UTF-8', $result);
        return $result;
    }
}