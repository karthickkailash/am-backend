<?php

namespace App\Http\Controllers;
use App\Libsodium\CryptographyPlugin;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    /**
    * decryption check.
    * @param  string  $string
    * @return mixed
    */
    public function decryption()
    {

        $key = random_bytes(SODIUM_CRYPTO_AEAD_XCHACHA20POLY1305_IETF_NPUBBYTES);
       $k=  sodium_bin2hex( $key );
//print_r($k);
       // $key   = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES); // 256 bit
//$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES); // 24 bytes
//print_r($nonce);
 $string='0f385921f8283685594e29107da6d898880c0ce15ce46b';
        if(!empty($string)) {
           $cryp=new CryptographyPlugin();
           $data = $cryp->decode($string);
           //$data1 = json_decode($data);
           return $data;
        }
        return '';
    }
    /**
    * encryption check.
    * @param  string  $string
    * @return mixed
    */
    public function encryption()
    {  $string='deepika';
                if(!empty($string)) {
            $cryp=new CryptographyPlugin();
            $data = $cryp->encode($string);
            return $data;
        }
        return '';
    }

}
