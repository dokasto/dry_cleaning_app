<?php
/**
 * Handles everything about the clients
 * of Culmen Dry Cleaners
 */


class clientModel extends models{


    /**
     * Send contact email from website
     * @param $name
     * @param $email
     * @param $mesage
     * @return array
     */
    public function contactEmail($name,$email,$mesage){
        $name = Utility::sanitizeStr($name);
        $email = Utility::sanitizeStr($email);
        $mesage = Utility::sanitizeStr($mesage);
        $mailer = new Email();
        $mailer->setFrom($email,$name);
        $mailer->setMessage($mesage);
        $mailer->setSubject("Enquire From Website");
        $mailer->addMailHeader('Reply-To', $email, $name);
        $mailer->addGenericHeader('Content-Type', 'text/html; charset="utf-8"');
        $mailer->addGenericHeader('X-Mailer', 'PHP/' . phpversion()) ;
        $mailer->setTo(ADMIN_EMAIL,SITENAME);
        if($mailer->send()){
            $this->return['status'] = true ;
        }else{
            $this->return['result'] = $mailer->debug() ;
        }

        return $this->return;
    }

    /**
     * Fetch all clients
     * in the database
     * @return array
     */
    public function getClients(){
        $qry = $this->db->query("SELECT client_id,name,email,phone,picture FROM {$this->tbl_clients}");
        while($client = $qry->fetch_assoc()){
            $this->return['result'][] = new ArrToObj($client) ;
        }
        if( isset($this->return['result']) && is_array($this->return['result']) && count($this->return['result']) > 1 ){
            $this->return['status'] = true ;
        }
        if(is_array($this->return)) {
            return new ArrToObj($this->return);
        }
    }


    /**
     * Send feedback message from client to admin
     * @param $client_id
     * @param $subject
     * @param $message
     * @return array
     */
    public function sendFeedback($client_id,$subject,$message){
        $client_id = Utility::sanitizeStr($client_id);
        $subject = Utility::sanitizeStr($subject);
        $message = Utility::sanitizeStr($message);
        $select = $this->db->dbSELECT('name,email',"client_id='".$client_id."'",$this->tbl_clients);
        $person = $select->result ;
        $email = new Email();
        $email->addMailHeader('Reply-To', $person->email , $person->name);
        $email->addGenericHeader('Content-Type', 'text/html; charset="utf-8"');
        $email->addGenericHeader('X-Mailer', 'PHP/' . phpversion()) ;
        $email->setFrom($person->email,$person->name);
        $email->setTo(ADMIN_EMAIL,SITENAME);
        $email->setSubject($subject);
        $email->setMessage($message);
        if($email->send()){
            $this->return['status'] = true ;
        }else{
            $this->return['result'] = $email->debug();
        }
        return $this->return;
    }


    /**
     * Get client information
     * @param $client_id
     * @return array
     */
    public function getClient($client_id){
        $client_id = Utility::sanitizeStr($client_id);
        $select = $this->db->dbSELECT("client_id,name,address,email,phone,picture,created","client_id='".$client_id."'",$this->tbl_clients);
        if( $select->status == true ){
            $this->return['status'] = true ;
            $this->return['result'] = $select->result ;
        }else{
            $this->return['result'] = "The user does not exist or has been removed" ;
        }
        return $this->return;
    }


    /**
     * Authenticate a Login request
     * @param $email
     * @param $password
     * @return ArrToObj
     */
    public function authenticate($email,$password){
        $email = Utility::sanitizeStr($email);
        $password = Utility::sanitizeStr($password);
        $qry = $this->db->dbSELECT('client_id,password',"email='".$email."'",$this->tbl_clients);
        if($qry->status == true ){
            if ( crypt($password, $qry->result->password ) === $qry->result->password ) {
                $this->return['status'] = true ;
                $this->return['result'] = $qry->result->client_id ;
                self::setLoginSession($qry->result->client_id);
            }else{
                $this->return['result'] = 'Invalid email or password';
            }
        }else{
            $this->return['result'] = 'Invalid email or password '.$qry->result ;
        }
        return $this->return;
    }


    /**
     * update clients password
     * @param $oldPass
     * @param $newPass
     * @param $clientId
     * @internal param $clientid
     * @internal param $oldPassword
     * @internal param $newPassword
     * @internal param $client_id
     * @return array
     */
    public function updatePassword($oldPass,$newPass,$clientId){
        $oldPassword = Utility::sanitizeStr( $oldPass ) ;
        $newPassword = Utility::createHash( Utility::sanitizeStr( $newPass ) ) ;
        $client_id = Utility::sanitizeStr( $clientId )  ;
        /* Check if old password is correct */
        $get = $this->db->dbSELECT("password","client_id='".$client_id."'",$this->tbl_clients);
        if( $get->status == true ){

            if ( crypt($oldPassword, $get->result->password ) === $get->result->password ) {
                // update password if correct
                $update = $this->db->dbUPDATE("password='".$newPassword."'","client_id='$client_id'",$this->tbl_clients);
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
     * Update a clients profile
     * @param $client_id
     * @param $name
     * @param $email
     * @param $phone
     * @param $address
     * @return ArrToObj
     */
    public function updateProfile($client_id,$name,$email,$phone,$address){
        $client_id = Utility::sanitizeStr( $client_id ) ;
        $name = Utility::sanitizeStr( $name ) ;
        $email = Utility::sanitizeStr( $email ) ;
        $phone = Utility::sanitizeStr( $phone ) ;
        $address = Utility::sanitizeStr( $address ) ;
        /* Check if email address is available */
        if(self::checkData('email',$email,"AND client_id !='$client_id'") !== null){
            $this->return['result'] = "Sorry the email address ".$email." is not available" ;
            /* check if phone number is available */
        }elseif(self::checkData('phone',$phone,"AND client_id !='$client_id'") !== null){
            $this->return['result'] = "Sorry the phone number ".$phone." is not available" ;
        }else{
            $dataSet = "name='".$name."', email='".$email."', phone='".$phone."', address='".$address."'" ;
            $insert = $this->db->dbUPDATE($dataSet,"client_id='$client_id'",$this->tbl_clients);
            if($insert->status == true){
                $this->return['status'] = true ;
            }else{
                $this->return['result'] = $insert->result ;
            }
        }
        return $this->return;
    }


    /**
     * Update client profile picture
     * @param $client_id
     * @param $picture array of $_FILE uploaded
     * @return ArrToObj
     */
    public function updatePicture($client_id,$picture){
        $get = $this->db->dbSELECT('picture',"client_id='".$client_id."'",$this->tbl_clients);
        $old_picture = $get->result->picture ;
        $uploadedPicture = '' ;
        var_dump($picture); die();
        /* upload new image */
        $imgFileName = Utility::rand(10); // generate random
        $image = new Upload($picture);
        $image->file_new_name_body = $imgFileName ;
        if ($image->uploaded) {
            $image->Process($this->uploadsPath.DIRECTORY_SEPARATOR);
            if ($image->processed) {
                $uploadedPicture = $imgFileName.'.'.$image->file_dst_name_ext ;
                /* update picture in database */
                $qry = $this->db->dbUPDATE("picture='$uploadedPicture'","client_id='$client_id'",$this->tbl_clients);
                if( $qry->status == true ){
                    $this->return['status'] = true ;
                    $this->return['result'] = $uploadedPicture ;
                } else { $this->return['result'] = $qry->result ; }
            } else { $this->return['result'] = $image->error ; }
        } else { $this->return['result'] = $image->error ; }

        unset($uploadedPicture,$picture);

        /* if all is well, delete the old picture if there is one */
     if($this->return['status']==true){
        if($old_picture !== null){
            $picFile = $this->uploadsPath . DIRECTORY_SEPARATOR . $old_picture ;
            if(file_exists($picFile)){
                unlink($picFile);
            }
        }
    }
        return $this->return;
    }


    /**
     * Register a new client
     * @param $name
     * @param $email
     * @param $phone
     * @param $address
     * @param $pswd
     * @internal param $password
     * @return ArrToObj result of the transaction
     */
    public function newClient($name,$email,$phone,$address,$pswd){
        $name = Utility::sanitizeStr( $name ) ;
        $email = Utility::sanitizeStr( $email ) ;
        $phone = Utility::sanitizeStr( $phone ) ;
        $address = Utility::sanitizeStr( $address ) ;
        $password = Utility::createHash( Utility::sanitizeStr( $pswd ) ) ;
        /* Check if email address is available */
        if(self::checkData('email',$email) !== null){
            $this->return['result'] = "Sorry the email address ".$email." is not available" ;
            /* check if phone number is available */
        }elseif(self::checkData('phone',$phone) !== null){
            $this->return['result'] = "Sorry the phone number ".$phone." is not available" ;
        }else{
            $dataset = "name='".$name."', email='".$email."', phone='".$phone."', address='".$address."', password='".$password."'" ;
            $insert = $this->db->dbINSERT($dataset,$this->tbl_clients);
            if($insert->status == true){
                $this->return['status'] = true ;
            }else{
                $this->return['result'] = $insert->result ;
            }
        }
        return $this->return;
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
        $qry = $this->db->dbSELECT($column,$column."='".$value."' $where",$this->tbl_clients);
        if($qry->status == true ){
            return $value ;
        }else{
            return null ;
        }
    }


    /**
     * Set Login Session
     * @param Int $client_id
     */
    private function setLoginSession($client_id){
        $qry = $this->db->dbSELECT('password',"client_id='$client_id'",$this->tbl_clients);
        $user_browser = $_SERVER['HTTP_USER_AGENT'] ;
        $token = hash('sha512',  $qry->result->password . $user_browser) ;
        $_SESSION['secure_user'] = array("client_id" => $client_id , "login_token" => $token ) ;
    }


    /**
     *  Check if a user is loggedin
     *  @return boolean true/false
     */
    public function isLoggedIn(){
        $ret = false ;
        if (isset($_SESSION['secure_user'])) {
            //list($key , $token) = $_SESSION['LoggedIn'] ;
            $client_id = Utility::sanitizeStr(  $_SESSION['secure_user']['client_id'] ) ;
            $login_token = Utility::sanitizeStr( $_SESSION['secure_user']['login_token'] ) ;
            $qry = $this->db->dbSELECT('password',"client_id='".$client_id."'",$this->tbl_clients);
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
     * clear all sessions
     * @internal param array $uid
     */
    private function clearSessions(){
        if (isset($_SESSION['secure_user'])) {
            $_SESSION['secure_user'] = "" ;
            unset($_SESSION['secure_user']) ;
        }
    }

    /**
     * logout a user
     */
    public function logout(){
        self::clearSessions();
    }


}
