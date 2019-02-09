<?php

$curl = curl_init('https://api.github.com/users/code-architect');

// with out this curl will echo your result
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
// sending a user agent because git hub requires you send one
curl_setopt($curl, CURLOPT_HTTPHEADER, ["User-Agent: php-curl"]);

$response = curl_exec($curl);
$info = curl_getinfo($curl);


if($info['http_code'] == 200)
{
    $data = json_decode($response, true);

    $repos = $data['repos_url'];
    $curl = curl_init($repos);

    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, ["User-Agent: php-curl"]);

    $response = curl_exec($curl);
    $info = curl_getinfo($curl);

    if($info['http_code'] == 200)
    {
        $name_repos = json_decode($response, true);

        foreach($name_repos as $key => $value)
        {
            echo $value['name']."<br>";
        }
    }


//    foreach ($data as $key => $value)
//    {
//        echo $key.'     =>      '.$value.'<br>';
//    }
}else{
    echo "Curl Error". curl_error($curl);
}

curl_close($curl);
