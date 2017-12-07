<?php

class CarrotQuest {

    public $app_id = '11183';
    public $auth_token = "app.11183.425245e5183cc591750dbe682b2753e41275bc41d57b4a88";

    private function httpPostRequest($url, $params) {
        $post_data = http_build_query($params);
        if (!($curl = curl_init()))
            return false;
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        $result = curl_exec($curl);
        curl_close($curl);
        return $result;
    }

    public function makeEvent($event, $params) {
        $url = "https://api.carrotquest.io/v1/users/". $this->app_id ."/events";
        $opts = array(
            'event' => $event,
            'auth_token' => $this->auth_token,
            'params' => json_encode($params),
        );
        var_dump($opts);
        var_dump($url);
        $result = $this->httpPostRequest($url, $opts);
        return $result;
    }
}

echo "<pre>";

$cquest = new CarrotQuest();

$result = $cquest->makeEvent(114349, array(
    'name' => 'Макс Бекетов',
    'email' => 'mbeketov18@gmail.com'
));

var_dump($result);
