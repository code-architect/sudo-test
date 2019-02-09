<?php

// initialize the request
$url = "https://api.github.com/users/code-architect/repos";

$options = [
    "http"=>["header" => ["User-Agent: php-curl"]]
];

// file_get_contents is a stream wrapper
$response = file_get_contents($url, false,  stream_context_create($options));

// if the request is unsuccessful we get a false, so check with false
if(false !== $response)
{
    //echo $response;

    $data = json_decode($response, true);
    foreach($data as $key => $value)
    {
        echo $value['name']."<br>";
    }
}else{
    print_r($http_response_header);
}