<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

class exchangeRate extends CBitrixComponent
{

    public $percentAuth; // Процент надбавки для авторизованного пользователя
    public $percentNoAuth; // Процент надбавки для неавторизованного пользователя

    private $usd = 0;
    private $eur = 0;

    public function executeComponent()
    {
        $this->getActualCourse();
        $this->includeComponentTemplate();
    }

    public function getPercent()
    {
        global $USER;
        $this->percentAuth = $this->arParams['ADD_PERCENT_AUTH'];
        $this->percentNoAuth = $this->arParams['ADD_PERCENT_NO_AUTH'];
        if ($USER->isAuthorized()) {
            $this->arResult['COURSES']['USD'] = ($this->percentAuth != 0) ? $this->usd + ($this->usd * (intval($this->percentAuth) / 100)) : $this->usd;
            $this->arResult['COURSES']['EUR'] = ($this->percentAuth != 0) ? $this->eur + ($this->eur * (intval($this->percentAuth) / 100)) : $this->eur;
        } else {
            $this->arResult['COURSES']['USD'] = ($this->percentNoAuth != 0) ? $this->usd + ($this->usd * (intval($this->percentNoAuth) / 100)) : $this->usd;
            $this->arResult['COURSES']['EUR'] = ($this->percentNoAuth != 0) ? $this->eur + ($this->eur * (intval($this->percentNoAuth) / 100)) : $this->eur;
        }
    }

    public function getActualCourse()
    {
        $curlXml = $this->Curl("https://cbr.ru/scripts/XML_daily.asp");
        $xml = simplexml_load_string($curlXml['content']);
        $xmlAr = json_decode(json_encode($xml), TRUE);

        foreach ($xmlAr['Valute'] as $valute) {
            switch ((string)$valute['@attributes']['ID']) {
                case 'R01235':
                    $this->usd = $valute['Value'];
                    break;
                case 'R01239':
                    $this->eur = $valute['Value'];
                    break;
            }
        }
        $this->getPercent();
    }

    private function Curl ($url, $post = '')
    {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);                                            // отправляем на $url
        curl_setopt($ch, CURLOPT_HEADER, 0);                                            // не возвращает заголовки
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));  // заголовки
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                 // возвратить то что вернул сервер
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);                                 // переходит по редиректам false
        curl_setopt($ch, CURLOPT_ENCODING, "");                                         // обрабатывает все кодировки
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);                                   // таймаут соединения
        curl_setopt($ch, CURLOPT_COOKIESESSION, false);                                 // использовать старую сессию
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);                                       // set referer on redirect
        curl_setopt($ch, CURLOPT_TIMEOUT, 20);                                          // timeout on response
        curl_setopt($ch, CURLOPT_MAXREDIRS, 5);                                         // stop after 0 redirects
        curl_setopt($ch, CURLOPT_FAILONERROR, false);                                   // TRUE для подробного отчета при неудаче

        if (!empty($post))
        {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        }

        $content = curl_exec($ch);
        $err     = curl_errno($ch);
        $errmsg  = curl_error($ch);
        $header  = curl_getinfo($ch);

        curl_close($ch);

        $header['errno']    = $err;
        $header['errmsg']   = $errmsg;
        $result['header']   = $header;
        $result['content']  = $content;

        return $result;
    }
}