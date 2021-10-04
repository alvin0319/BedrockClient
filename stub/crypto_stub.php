<?php

namespace Crypto {
class CryptoException extends \Exception{
}
}

namespace Crypto {
class CipherException extends \Crypto\CryptoException{
	public const ALGORITHM_NOT_FOUND = 1;
	public const STATIC_METHOD_NOT_FOUND = 2;
	public const STATIC_METHOD_TOO_MANY_ARGS = 3;
	public const MODE_NOT_FOUND = 4;
	public const MODE_NOT_AVAILABLE = 5;
	public const AUTHENTICATION_NOT_SUPPORTED = 6;
	public const KEY_LENGTH_INVALID = 7;
	public const IV_LENGTH_INVALID = 8;
	public const AAD_SETTER_FORBIDDEN = 9;
	public const AAD_SETTER_FAILED = 10;
	public const AAD_LENGTH_HIGH = 11;
	public const TAG_GETTER_FORBIDDEN = 12;
	public const TAG_SETTER_FORBIDDEN = 13;
	public const TAG_GETTER_FAILED = 14;
	public const TAG_SETTER_FAILED = 15;
	public const TAG_LENGTH_SETTER_FORBIDDEN = 16;
	public const TAG_LENGTH_LOW = 17;
	public const TAG_LENGTH_HIGH = 18;
	public const TAG_VERIFY_FAILED = 19;
	public const INIT_ALG_FAILED = 20;
	public const INIT_CTX_FAILED = 21;
	public const INIT_ENCRYPT_FORBIDDEN = 22;
	public const INIT_DECRYPT_FORBIDDEN = 23;
	public const UPDATE_FAILED = 24;
	public const UPDATE_ENCRYPT_FORBIDDEN = 25;
	public const UPDATE_DECRYPT_FORBIDDEN = 26;
	public const FINISH_FAILED = 27;
	public const FINISH_ENCRYPT_FORBIDDEN = 28;
	public const FINISH_DECRYPT_FORBIDDEN = 29;
	public const INPUT_DATA_LENGTH_HIGH = 30;
}
}

namespace Crypto {
class Cipher{
	public const MODE_ECB = 1;
	public const MODE_CBC = 2;
	public const MODE_CFB = 3;
	public const MODE_OFB = 4;
	public const MODE_CTR = 5;
	public const MODE_GCM = 6;
	public const MODE_CCM = 7;
	public const MODE_XTS = 65537;
	protected $algorithm;

	public static function getAlgorithms($aliases = null, $prefix = null){}

	public static function hasAlgorithm($algorithm){}

	public static function hasMode($mode){}

	public static function __callStatic($name, $arguments){}

	public function __construct($algorithm, $mode = null, $key_size = null){}

	public function getAlgorithmName(){}

	public function encryptInit($key, $iv = null){}

	public function encryptUpdate($data) : string{}

	public function encryptFinish(){}

	public function encrypt($data, $key, $iv = null){}

	public function decryptInit($key, $iv = null){}

	public function decryptUpdate($data) : string{}

	public function decryptFinish(){}

	public function decrypt($data, $key, $iv = null){}

	public function getBlockSize(){}

	public function getKeyLength(){}

	public function getIVLength(){}

	public function getMode(){}

	public function getTag(){}

	public function setTag($tag){}

	public function setTagLength($tag_length){}

	public function setAAD($aad){}
}
}

namespace Crypto {
class Hash{
	protected $algorithm;

	public static function getAlgorithms($aliases = null, $prefix = null){}

	public static function hasAlgorithm($algorithm){}

	public static function __callStatic($name, $arguments){}

	public function __construct($algorithm){}

	public function update($data){}

	public function getAlgorithmName(){}

	public function digest(){}

	public function hexdigest(){}

	public function getSize(){}

	public function getBlockSize(){}
}
}

namespace Crypto {
class HashException extends \Crypto\CryptoException{
	public const HASH_ALGORITHM_NOT_FOUND = 1;
	public const STATIC_METHOD_NOT_FOUND = 2;
	public const STATIC_METHOD_TOO_MANY_ARGS = 3;
	public const INIT_FAILED = 4;
	public const UPDATE_FAILED = 5;
	public const DIGEST_FAILED = 6;
	public const INPUT_DATA_LENGTH_HIGH = 7;
}
}

namespace Crypto {
abstract class MAC extends \Crypto\Hash{

	public function __construct($algorithm, $key){}
}
}

namespace Crypto {
class MACException extends \Crypto\HashException{
	public const MAC_ALGORITHM_NOT_FOUND = 1;
	public const KEY_LENGTH_INVALID = 2;
}
}

namespace Crypto {
class HMAC extends \Crypto\MAC{
}
}

namespace Crypto {
class CMAC extends \Crypto\MAC{
}
}

namespace Crypto {
class Base64{

	public static function encode($data){}

	public static function decode($data){}

	public function __construct(){}

	public function encodeUpdate($data){}

	public function encodeFinish(){}

	public function decodeUpdate($data){}

	public function decodeFinish(){}
}
}

namespace Crypto {
class Base64Exception extends \Crypto\CryptoException{
	public const ENCODE_UPDATE_FORBIDDEN = 1;
	public const ENCODE_FINISH_FORBIDDEN = 2;
	public const DECODE_UPDATE_FORBIDDEN = 3;
	public const DECODE_FINISH_FORBIDDEN = 4;
	public const DECODE_UPDATE_FAILED = 5;
	public const INPUT_DATA_LENGTH_HIGH = 6;
}
}

namespace Crypto {
class Rand{

	public static function generate($num, $must_be_strong = null, &$returned_strong_result = null){}

	public static function seed($buf, $entropy = null){}

	public static function cleanup(){}

	public static function loadFile($filename, $max_bytes = null){}

	public static function writeFile($filename){}
}
}

namespace Crypto {
class RandException extends \Crypto\CryptoException{
	public const GENERATE_PREDICTABLE = 1;
	public const FILE_WRITE_PREDICTABLE = 2;
	public const REQUESTED_BYTES_NUMBER_TOO_HIGH = 3;
	public const SEED_LENGTH_TOO_HIGH = 4;
}
}

namespace Crypto {
abstract class KDF{

	public function __construct($length, $salt = null){}

	abstract public function derive($password);

	public function getLength(){}

	public function setLength($length){}

	public function getSalt(){}

	public function setSalt($salt){}
}
}

namespace Crypto {
class KDFException extends \Crypto\CryptoException{
	public const KEY_LENGTH_LOW = 1;
	public const KEY_LENGTH_HIGH = 2;
	public const SALT_LENGTH_HIGH = 3;
	public const PASSWORD_LENGTH_INVALID = 4;
	public const DERIVATION_FAILED = 5;
}
}

namespace Crypto {
class PBKDF2 extends \Crypto\KDF{

	public function __construct($hashAlgorithm, $length, $salt = null, $iterations = null){}

	public function derive($password){}

	public function getIterations(){}

	public function setIterations($iterations){}

	public function getHashAlgorithm(){}

	public function setHashAlgorithm($hashAlgorithm){}
}
}

namespace Crypto {
class PBKDF2Exception extends \Crypto\KDFException{
	public const HASH_ALGORITHM_NOT_FOUND = 1;
	public const ITERATIONS_HIGH = 2;
}
}

