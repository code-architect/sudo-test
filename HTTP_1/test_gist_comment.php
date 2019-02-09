<?php
$token= "your api key";
$comment = json_encode(["body" => "testing comment"]);

$url = "https://api.github.com/gists/56f5fa0aa594f3ac818d9d1ce26aa5da/comments";

$options = array(
    "http" => array(
        "header" => array("User-Agent: php-curl",
            "Content-Type: application/json",
            "Authorization: token " . $token),
        "method" => "POST",
        "content" => $comment
    ));

$response = file_get_contents($url, false, stream_context_create($options));

// 201 expected and a redirect
print_r($http_response_header);
