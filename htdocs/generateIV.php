<?php

if (getenv('HASHAAS_INIT_VECTOR') === false) {
    echo getenv('HASHAAS_INIT_VECTOR');
    //To generate a random initialization vector (IV) for AES-128-CTR:
    $IV = openssl_random_pseudo_bytes(16);
    // the vector has to be stored as a env variable for example 
    // in an .htaccess file:
    $confEnv = "SetEnv HASHAAS_INIT_VECTOR " . bin2hex($IV);
    file_put_contents("../.htaccess", $confEnv);
}

?>
