<?php
/**
 * @Author: Administrator
 * @Date:   2019-03-06 13:58:51
 * @Last Modified by:   Administrator
 * @Last Modified time: 2019-03-06 14:53:23
 */
include('Crypt/RSA.php');
include('Math/BigInteger.php');
$publickey = '<RSAKeyValue><Modulus>sAcJsHHyIRG2RgcfTa/WBhL3AYABVAisPwvyvhZfg+wLe3OesRExn2mecPblQ+efZJnNOI5Utm2RYk9HeHRGD95JIsO6fPOOq5om/zGtbQaeNADs876lwdrvjHZidDdQdlGqlENvPmydFNCiEIfYE1DMGaUVvWiDsQKk7z8vf2k=</Modulus><Exponent>AQAB</Exponent></RSAKeyValue>';

$privatekey = '<RSAKeyValue><Modulus>rJGxeAMCBwI6YMcayPx6+eJylYlvTNUWpydGwcqWTV1QiPigb5kpz/THHQy7HHv/xwZ+6cXaAfGSq2GlbvahFUanUPlCAsxrhnjgc3pTVMsNKLrJ5u8ETq0+h0wyL+SmQmFMK9cuIe7JZUU9Zmj+m618xhGjjdyjgtSJTJV8ggE=</Modulus><Exponent>AQAB</Exponent><P>4LL/sCzejlbC3v1G2k6kJW65SKTytljvSholGbyAwireV9lYqVbkMIY5Wh/bsq/Emkf9U8s/rcuAtOR7EnqSJw==</P><Q>xJuusDJI4ydCwFi83gKOPtwCvTqZ9ToNhnl7xxakyGZ9qMFwE4YjaU5j7EYd0iDkd25gIlzoOxZE7g3mrVZrlw==</Q><DP>hZ5sJhvIjORTJb9/rrotKoVZcTWFj6H7ShmaDl/mQZC0f5EkBC9Dqwdme42OXAfh5c0BfB7VU0g81VU5SpfQ6Q==</DP><DQ>FlQkA8jCNGIaF6Q8Vu5tX0A3Y2xLXelo7dPQNe0ha80QCmFlrCH41ZXcjVHtQxcPO20ip+RrT4KY83xKrXb6Iw==</DQ><InverseQ>0zvGMIHL4NGajgtc1HP51+D9s8EBZsbiUywx+Bp3Lf/6io6fQ5p3FvfHvzJ6ykvVxOHxt+IgbJ2NpAinBY89XA==</InverseQ><D>p71qiuQpmVRyGFYQ1CKPCswxYudXV5CdV1cXMRHRrVuyB6HcmP2BJhGhZbxVOGfThMrsnCFkOpVtYsckfkqe4azosgv4Hw4wZBmQtfcYCgZmoDHuxlReFxtux1DA7hgHzrNYWaNgCD9iO/Cbx824V+VRI6dWeBBLVrKYJqYQ9R0=</D></RSAKeyValue>';
$rsa = new RSA();
$rsa->loadKey($privatekey, CRYPT_RSA_PRIVATE_FORMAT_XML);
$rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
//.net加密的字符串
$encrypt_str ='UzAg6alD4ZTWWmXmPIq9kf7GDpxyVx1PLPwd7ad48Zpet+656a5n4yzhzMMlMWeHmKniCbzZXyQStMFX7rjKQymPKWzATMMp6yFLAE9z5PSUxe/Il23Bu0O4ihc0E0kmpXHSGfUDr259Cnp3Ixf5JGD13US5lLKWiflNTCZ60fI=';

$res = $rsa->decrypt(base64_decode($encrypt_str));
$res = $res.'AgAGUAbgBjAG8AZABpAG4AZwA9ACcAdQB0AGYALQA4ACcAPwA+AA0ACgAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAA8AFIAZQBzAHUAbAB0AD4ADQAKACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgADwARgBsAGEAZwA+ADEAPAAvAEYAbABhAGcAPgANAAoAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAPABNAGUAcwBzAGEAZwBlAD4APAAhAFsAQwBEAEEAVABBAFsA0GOkTg1noVIzdfeLEGKfUgz/M3X3i1VT91Ma/0YAVwAuAC1OtlFpchpOO2DokDEAOQAwADMAMAA2ADAAMAAwADIAXQBdAD4APAAvAE0AZQBzAHMAYQBnAGUAPgANAAoAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAIAAgACAAPAAvAFIAZQBzAHUAbAB0AD4A';
var_dump(base64_decode($res));
$aa =  encryptXmlToArray(base64_decode($res));
var_dump($aa);die;

function encryptXmlToArray($xml)
{
    //禁止引用外部xml实体
    libxml_disable_entity_loader(true);

    $xmlstring = simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA);
    $val = json_decode(json_encode($xmlstring), true);
    return $val;
}