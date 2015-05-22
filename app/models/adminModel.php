<?php
/**
 * Culmen
 * Class: adminModel.php
 * Author: @thisisudo
 * Date: 12/5/14
 * Time: 6:33 AM
 */

class adminModel extends models{

    public function create($username,$password){
        $username = Utility::sanitizeStr( $username ) ;
        $password = Utility::createHash( Utility::sanitizeStr( $password ) ) ;
        /* Check if email username is available */
        if(self::checkData('username',$username) !== null){
            $this->return['result'] = "Sorry the username ".$username." is not available" ;
        }else{
            $dataSet = "username='".$username."', password='".$password."'";
            $insert = $this->db->dbINSERT($dataSet,$this->tbl_admin);
            if($insert->status == true){
                $this->return['status'] = true;
            }else{
                $this->return['result'] = "An error occured ".$insert->result ;
            }
        }
        return $this->return;
    }


    /**
     * Authenticate a Login request
     * @param $username
     * @param $pswd
     * @internal param $password
     * @return ArrToObj
     */
    public function authenticate($username,$pswd){
        $username = Utility::sanitizeStr($username);
        $password = Utility::sanitizeStr($pswd);
        $qry = $this->db->dbSELECT('uid,password',"username='".$username."'",$this->tbl_admin);
        if($qry->status == true ){
            if ( crypt($password, $qry->result->password ) === $qry->result->password ) {
                $this->return['status'] = true ;
                $this->return['result'] = $qry->result->uid ;
                self::setLoginSession($qry->result->uid);
            }else{
                $this->return['result'] = 'Invalid username or password' ;
            }
        }else{
            $this->return['result'] = 'Invalid Username or Password' ;
        }
        return $this->return;
    }


    /**
     * update clients password
     * @param $oldPass
     * @param $newPass
     * @param $uid
     * @internal param $clientId
     * @internal param $clientid
     * @internal param $oldPassword
     * @internal param $newPassword
     * @internal param $client_id
     * @return array
     */
    public function updatePassword($oldPass,$newPass,$uid){
        $oldPassword = Utility::sanitizeStr( $oldPass ) ;
        $newPassword = Utility::createHash( Utility::sanitizeStr( $newPass ) ) ;
        $uid = Utility::sanitizeStr( $uid )  ;
        /* Check if old password is correct */
        $get = $this->db->dbSELECT("password","uid='".$uid."'",$this->tbl_admin);
        if( $get->status == true ){

            if ( crypt($oldPassword, $get->result->password ) === $get->result->password ) {
                // update password if correct
                $update = $this->db->dbUPDATE("password='".$newPassword."'","uid='$uid'",$this->tbl_admin);
                if($update->status == true){
                    $this->return['status'] = true ;
                }else{
                    $this->return['result'] = $update->result ;
                }
            }else{
                $this->return['result'] = 'old password provided is incorrect '.$oldPassword ;
            }

        }else{
            $this->return['result'] = 'this user does exist or has been deleted';
        }
        return $this->return;
    }



    /**
     *  Check if a user is loggedin
     *  @return boolean true/false
     */
    public function isLoggedIn(){
        $ret = false ;
        if (isset($_SESSION['secure_admin_user'])){
            //list($key , $token) = $_SESSION['LoggedIn'] ;
            $uid = Utility::sanitizeStr(  $_SESSION['secure_admin_user']['uid'] ) ;
            $login_token = Utility::sanitizeStr( $_SESSION['secure_admin_user']['login_token'] ) ;
            $qry = $this->db->dbSELECT('password',"uid='".$uid."'", $this->tbl_admin);
            if( $qry->status == true ){ // if successful
                $user_browser = $_SERVER['HTTP_USER_AGENT'] ;
                $token = hash('sha512',  $qry->result->password . $user_browser) ;
                if( $login_token == $token ){
                    $ret = true ;
                }
            }
        }
        return $ret ;
    }


    /**
     * Set Login Session
     * @param Int $uid
     */
    private function setLoginSession($uid){
        $qry = $this->db->dbSELECT('password',"uid='$uid'",$this->tbl_admin);
        $user_browser = $_SERVER['HTTP_USER_AGENT'] ;
        $token = hash('sha512',  $qry->result->password . $user_browser) ;
        $_SESSION['secure_admin_user'] = array("uid" => $uid , "login_token" => $token ) ;
    }


    /**
     * Check if a particular column contains
     * some specific data
     * column - value pairs
     * @param $column
     * @param $value
     * @param string $where
     * @return null
     */
    private function checkData($column,$value,$where=''){
        $qry = $this->db->dbSELECT($column,$column."='".$value."' $where",$this->tbl_admin);
        if($qry->status == true ){
            return $value ;
        }else{
            return null ;
        }
    }


    /**
     * clear all sessions
     * @internal param array $uid
     */
    private function clearSessions(){
        if (isset($_SESSION['secure_admin_user'])) {
            $_SESSION['secure_admin_user'] = "" ;
            unset($_SESSION['secure_admin_user']) ;
        }
    }

    /**
     * logout a user
     */
    public function logout(){
        self::clearSessions();
    }

} 