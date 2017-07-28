<?php
/**
 * Created by PhpStorm.
 * User: nguyenlinh
 * Date: 15/05/2017
 * Time: 22.35
 */
if(defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
    echo "CRYPT_BLOWFISH is enabled!";
} else {
    echo "CRYPT_BLOWFISH is NOT enabled!";
}
//this is to encrypt the password
$password = 'admin';

//echo ' hashed password'.$password_hash;

function better_crypt($input, $rounds = 10)
{
    $crypt_options = array(
        'cost' => $rounds
    );
    return password_hash($input, PASSWORD_BCRYPT, $crypt_options);
}
$password_hash1 = better_crypt($password);


//echo '<br>'.$password_hash1.'password 1';
//echo '<br>'.$password_hash2.'password 2 ';
echo $password_hash1;
