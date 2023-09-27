<?php
namespace App\Libsodium;
use Illuminate\Database\Eloquent\Model;
use DB;
class CryptographyPlugin extends Model
{

    /** @phpstan-ignore-next-line */
    private $nonce;
    /** @phpstan-ignore-next-line */
    private $key;
    /** @phpstan-ignore-next-line */
    private $block_size;

    public function __construct() {
      
        $this->nonce = env('LIB_SODIUM_NOUNCE');
        $this->key = env('LIB_SODIUM_KEY');
        //$get_val = DB::table('sodium_key_nonce')->first();
       // $this->nonce = $get_val->sodium_nonce;
       // $this->key = $get_val->sodium_key;
        //$this->block_size = '64';
      
    }
   

   /* public function sym_encode($message) 
    {
        try {
            $message = trim($message);
            if ($message == '') {
                return '';
            }
            $nonce_decoded = sodium_hex2bin($this->nonce);
            $key_decoded = sodium_hex2bin($this->key);
            // pad to $block_size byte chunks (enforce 512 byte limit)
            $padded_message = sodium_pad($message, $this->block_size <= 512 ? $this->block_size : 512);
            $cipher = sodium_bin2hex(sodium_crypto_secretbox($padded_message, $nonce_decoded, $key_decoded));

            // cleanup
            sodium_memzero($message);
            sodium_memzero($key_decoded);
            sodium_memzero($nonce_decoded);

            return $cipher;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function sym_decode($encrypted) 
    {
        try {
          
            $encrypted = trim($encrypted); 
            if (!empty($encrypted)) {
				if(ctype_xdigit($encrypted)){
					// unpack base64 message
					$decoded = sodium_hex2bin($encrypted);
					if ($decoded === false) {
						return '';
					}
					$nonce_decoded = sodium_hex2bin($this->nonce);
					$key_decoded = sodium_hex2bin($this->key);
					// decrypt it and account for extra padding from $block_size (enforce 512 byte limit)
					$decrypted_padded_message = sodium_crypto_secretbox_open($decoded, $nonce_decoded, $key_decoded);
					$message = sodium_unpad($decrypted_padded_message, $this->block_size <= 512 ? $this->block_size : 512);

					if ($message === false) {
						return '';
					}

					// cleanup
					sodium_memzero($decoded);
					sodium_memzero($key_decoded);
					sodium_memzero($nonce_decoded);
                   
					return $message;
				} else {
					return '';            
				}
			} else {
                return '';
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }*/

     /**
     * 
     *
     * @param  string $str
     * 
     * @return mixed
     * 
     */
    function encode($str) {
        //print_r($this->nonce);exit;
        try {
            $message = trim($str);
            if ($message != '') {

                $nonce_decoded = sodium_hex2bin($this->nonce);
                $key_decoded = sodium_hex2bin($this->key);
                // encrypt message and combine with nonce
                $cipher = sodium_bin2hex(sodium_crypto_secretbox($message, $nonce_decoded, $key_decoded));
                // cleanup
                sodium_memzero($message);
                sodium_memzero($key_decoded);
                sodium_memzero($nonce_decoded);
                return utf8_decode(utf8_encode(rtrim($cipher)));
                //return sodium_bin2hex($cipher);
            } else {
                return "";
            }
        } catch (\Exception $e) {
            return $e->getMessage();
 
        }
    }

    /**
     * 
     *
     * @param  string $code
     * 
     * @return mixed
     * 
     */
    function decode(string $code) {
        try {
            $encrypted = trim($code);
            if (!empty($encrypted)) {
				if(ctype_xdigit($encrypted)){
					$decoded = sodium_hex2bin($encrypted);
                    /** @phpstan-ignore-next-line */
					if ($decoded === false) {
						return '';
					}
					$nonce_decoded = sodium_hex2bin($this->nonce);
					$key_decoded = sodium_hex2bin($this->key);
					// decrypt it
					$message = sodium_crypto_secretbox_open($decoded, $nonce_decoded, $key_decoded);
                   
					if ($message === false) {
						return '';
					}
					// cleanup
					sodium_memzero($decoded);
					sodium_memzero($key_decoded);
					sodium_memzero($nonce_decoded);
					return utf8_decode(utf8_encode(rtrim($message)));
				} else {
					return '';            
				}
			} else {
                return '';
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * 
     *
     * @param  string $hexdata
     * 
     * @return mixed
     * 
     */
    protected function hex2bin($hexdata) {
        $bindata = '';

        for ($i = 0; $i < strlen($hexdata); $i += 2) {
            $bindata .= chr(hexdec(substr($hexdata, $i, 2)));
        }

        return $bindata;
    }

}
