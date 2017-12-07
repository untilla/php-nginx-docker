<?php

class CarrotQuest {

    public $app_id = '11183';
    public $auth_token = "userauthkey-11183-911e02bd31ba75f668ff9360285d190e16675f2225577cb9331f0fb1267814";

    private function httpPostRequest($url, $params) {
        $post_data = http_build_query($params);
        $opts = array('http' =>
            array(
                'method'  => 'POST',
                'header'  => 'Content-type: application/x-www-form-urlencoded',
                'content' => $post_data
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
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