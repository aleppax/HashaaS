<?php
// store data outside the web path
$dbpath = '../hashaasdb/';
$allowNewKeys = false;

if (!$_SERVER['REQUEST_METHOD'] === 'GET') {
    // The request is using other request methods
    die("Invalid request method");
}

// Get the payload and API key from the request headers
$payload = $_SERVER['HTTP_PAYLOAD'];
$apiKeyFromRequest = $_SERVER['HTTP_API_KEY'];

if (strlen($apiKeyFromRequest) !== 16) {
    die("Invalid input");
}

$IV = getenv('HASHAAS_INIT_VECTOR');
if (($IV === null) or ($IV === false))   {
    die("Initialization Vector is not configured");
}

$saltFileName = $dbpath.$apiKeyFromRequest.'_salt.txt';

// retrieve userSecretSalt from encrypted file
// if file doesn't exist, generate it.
if (!file_exists($saltFileName)) {
    if ($allowNewKeys) {
        $userSecretSalt = base64_encode(openssl_random_pseudo_bytes(16));
        $encrypted_data = openssl_encrypt($userSecretSalt, 'AES-128-CTR', $apiKeyFromRequest, OPENSSL_RAW_DATA, $IV);
        $kfile = fopen($saltFileName, 'wb');
        fwrite($kfile, $encrypted_data);
        fclose($kfile);
    } else {
        dye("Invalid key");
    }
} else {
    $encrypted_data = file_get_contents($saltFileName);
    $userSecretSalt = openssl_decrypt($encrypted_data, 'AES-128-CTR', $apiKeyFromRequest, OPENSSL_RAW_DATA, $IV);
}

// Return the salted payload
echo hash("md5",$payload.$userSecretSalt,0);
?>
