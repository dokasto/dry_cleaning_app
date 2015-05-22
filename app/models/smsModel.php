<?php
/**
 * Culmen
 * Class: smsModel.php
 * Author: @thisisudo
 * Date: 12/20/14
 * Time: 6:48 AM
 */

class smsModel extends models{

    private $contacts = array() ;

    /**
     * Fetch al contacts
     * @return array
     */
    private function fetchContacts(){
        $contactsArr = array() ;
        $clientModel = new clientModel();
        $data = $clientModel->getClients();
        foreach($data->result as $contact){
            $contactsArr[] = $contact->phone ;
        }
        return $contactsArr;
    }


    /**
     * Send message to contact
     * @param $phone
     * @param $message
     * @return array
     */
    private function send($phone,$message){
        /* use sms Api to send message to contact */
        return $this->return;
    }


    /**
     * Send Bulk SMS
     * @param $message
     * @return array
     */
    public function sendBulkSMS($message){
        $message = Utility::sanitizeStr($message);
        $this->contacts = self::fetchContacts() ;
        foreach($this->contacts as $phone){
            $send = self::send($phone,$message);
            if($send == true){
                $this->return['status'] = true;
            }else{
                $this->return['result'] = $send ;
            }
        }
        return $this->return;
    }

} 