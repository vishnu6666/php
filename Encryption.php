<?php 
====================================================================================================
Encryption and Decryption By PHP
====================================================================================================

Stap : 1

Create Library In Codeigniter , Encryption.php

Stap : 2

Call Library In Controller

	$this->load->library('encryption');

	$encData ='This is Encryption Library ,Main use for URL Encryption and Decryption';

	$enc =  $this->encryption->encryptor('encrypt', $encData); //Call for Encryption

	$dec =  $this->encryption->encryptor('decrypt', $enc); // Call for Decryption

==================================================================================================
Encryption.php  

<?php 
class Encryption {

    function encryptor($action, $string) {
        $output = false;

        $encrypt_method = "AES-256-CBC";
        //pls set your unique hashing key
        $secret_key = 'test';
        $secret_iv = 'test123';

        // hash
        $key = hash('sha256', $secret_key);

        // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
        $iv = substr(hash('sha256', $secret_iv), 0, 16);

        //do the encyption given text/string/number
        if( $action == 'encrypt' ) {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        }
        else if( $action == 'decrypt' ){
        	//decrypt the given text/string/number
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }

        return $output;
    }
}
?>

