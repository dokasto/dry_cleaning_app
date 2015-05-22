<?php
/**
 * library of various utility
 * functions that always come handy
 * @author UDcreate
 */

class Utility {

  /**
     * Is usually called by cleanUP method
     * Sanitize all inputs 
     * @param string $input 
     * @return string $output
     */
  public static function cleanIt($input){
  $search = array(
    '@<script[^>]*?>.*?</script>@si',   // Strip out javascript
    '@<[\/\!]*?[^<>]*?>@si',            // Strip out HTML tags
    '@<style[^>]*?>.*?</style>@siU',    // Strip style tags properly
    '@<![\s\S]*?--[ \t\n\r]*>@'         // Strip multi-line comments
  );
    $output = preg_replace($search, '', $input);
    return $output;
  }

    /**
     * Sanitize arrays and strings , calls private function cleanIt()
     * @param string $input 
     * @return string $output
     */
  public static function sanitizeStr($input) {
   $link = mysqli_connect( DB_HOST , DB_USER , DB_PASS , DB_NAME );
      $output = '' ;

    if (is_array($input)) {
        foreach($input as $var=>$val) {
            $output[$var] = Utility::sanitizeStr($val);
        }
    }
    else {
        if (get_magic_quotes_gpc()) {
            $input = stripslashes($input);
        }
        $input = Utility::cleanIt($input);
        $output = mysqli_real_escape_string($link,$input);
    }
        return $output;
    }

   /**
     * generate random strings
     * @param string $length of string to be generated  
     * @return string $string random string
     */
      public static function rand($length){
          $return = '' ;
     	  $characters = array(
     	  "A","B","C","D","E","F","G","H","J","K","L","M",
     	  "N","P","Q","R","S","T","U","V","W","X","Y","Z",
     	  "1","2","3","4","5","6","7","8","9","0");
      	     $keys = array();
       	    while(count($keys) < $length) {
       	    $x = mt_rand(0, count($characters));
       	              if(!in_array($x, $keys)) {
       	                       $keys[] = $x ;
       	                }
      	    }
      	    $random_chars = implode("",$keys) ;
            if(strlen($random_chars) < $length){
                $random_chars .= mt_rand(0, count($characters));
            }
     	 	$string = substr($random_chars, 0, $length);
            $strArr = str_split($string);
         	foreach($strArr as $k){
                $return .= $characters[$k] ;
            }
          return $return ;
       }

    /**
     *  Create string with hash encryption
     *  @param String  $string string to encrypt
     *  @return String $hash hashed string
     */
    public static function createHash($string){
        $cost = 10;
        $salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
        // Prefix information about the hash so PHP knows how to verify it later.
        // "$2a$" Means we're using the Blowfish algorithm. The following two digits are the cost parameter.
        $salt = sprintf("$2a$%02d$", $cost) . $salt;
        // Hash the password with the salt
        $hash = crypt($string, $salt);
        return $hash ;
    }

    /**
     * Get only alpha-numeric character from string
     * @param $string
     * @return mixed
     */
    public static function onlyAlphNumeric($string){
        $clean = preg_replace("/[^A-Za-z0-9 ]/", '', $string);
        $cleanStr = preg_replace("/[^\w\d ]/ui", '', $clean);
        return $cleanStr ;
    }

}