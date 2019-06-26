<?php
// App key
$client_id = "3172ef25423c451491f7d94d52ecc39d";
$client_secret = "edd957a2aaee47c1bab9f34a9d5573f7";

// Richiesta token
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, "grant_type=client_credentials");
$headers = array("Authorization: Basic ".base64_encode($client_id.":".$client_secret));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

// Utilizzo
$token = json_decode($result)->access_token;
$data = http_build_query(array("q" => $_POST['textToSearch'], "type" => "track"));
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/search?".$data);
$headers = array("Authorization: Bearer ".$token);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
/*echo "<pre>";
print_r(json_decode($result));
echo "</pre>";*/
echo $result;
curl_close($curl);

?>