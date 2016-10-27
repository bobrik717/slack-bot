<?php

/**
 * Class Slack
 *
 * @property string $_chanel
 * @property string $_token
 */
class Slack
{
    public function __construct($token = 'xoxp-18100021248-95913423872-96513415863-d733f80a62109390a08010ace94078cc', $chanel = null)
    {
        if(!$token){
            throw new ErrorException('Need api token');
        }
        $this->_token = $token;

        if($chanel) $this->_chanel = $chanel;
    }

    private $_chanel = 'testchanel';
    private $_token = '';

    public function slack($message)
    {
        $ch = curl_init("https://slack.com/api/chat.postMessage");
        $data = http_build_query([
            "token" => $this->_token,
            "channel" => $this->_chanel,
            "text" => $message,
            "username" => "MySlackBot",
        ]);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

//bb02b046257ca722db631f6fb889fef2