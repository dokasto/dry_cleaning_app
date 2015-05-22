<?php
/**
 * Culmen
 * Class: bookingModel.php
 * Author: @thisisudo
 * Date: 12/10/14
 * Time: 3:46 PM
 */

class bookingModel extends models{

    /**
     * Delete a booking
     * @param $bid
     * @return ArrToObj
     */
    public function remove($bid){
        $bid = Utility::sanitizeStr($bid);
        $qry = $this->db->dbDELETE("bid='".$bid."'",$this->tbl_bookings);
        return $qry ;
    }


    /**
     * Fetch All bookings data
     * @param string $client
     * @return array
     */
    public function fetchBookings($client=''){
        $qry = $this->db->query("SELECT * FROM ".$this->tbl_bookings);
        if($client !== ''){
            $client = Utility::sanitizeStr($client);
            $qry = $this->db->query("SELECT * FROM ".$this->tbl_bookings." WHERE client_id='".$client."'");
        }
        $array = array() ;
        $clientObj = new clientModel();
        while($r = $qry->fetch_assoc()){
            $d = $clientObj->getClient($r['client_id']);
            unset($r['client_id']);
            $r['client'] = new ArrToObj($d['result']) ;
            $array[] = new ArrToObj($r) ;
        }

        if(count($array) > 0){
            $this->return['status'] = true ;
            $this->return['result'] = $array ;
        }

        return $this->return ;
    }


    /**
     * @param $clientId
     * @param $bid
     * @param $new_status
     * @param $old_status
     * @param $new_payment_status
     * @param $old_payment_status
     * @param $transactionCode
     * @return array
     */
    public function update($clientId,$bid,$new_status,$old_status,$new_payment_status,$old_payment_status,$transactionCode){
        $clientId = Utility::sanitizeStr($clientId);
        $bid = Utility::sanitizeStr($bid);
        $new_status = Utility::sanitizeStr($new_status);
        $old_status = Utility::sanitizeStr($old_status);
        $new_payment_status = Utility::sanitizeStr($new_payment_status);
        $old_payment_status = Utility::sanitizeStr($old_payment_status);

        $setData = '' ;
        $statusChanged = false ;
        $clientPaid = false ;

        if( $new_status !== $old_status){
            $setData .= "status='".$new_status."'";
            if($new_status !== 'pending'){
                $statusChanged = true ;
            }
        }

        if( $new_payment_status !== $old_payment_status){
            if($statusChanged){
                $setData .= ", payment_status='".$new_payment_status."'";
            }else{
                $setData .= " payment_status='".$new_payment_status."'";
            }
            if($new_payment_status == 1){
                $clientPaid = true ;
            }
        }

        if($new_status == 'picked up' && $old_status !== 'picked up'){
            $date = date('Y-m-d H:i:s');
            $setData .= ", collection_date='".$date."'";
        }

        $qry = $this->db->dbUPDATE($setData,"bid='".$bid."'",$this->tbl_bookings);
        if($qry->status == true){
            $this->return['status'] = true ;
        }else{
            $this->return['result'] = $qry->result ;
        }

        /* send update emails */
        if($clientPaid){
            self::updateMailer($clientId,$transactionCode,"Payment Confirmed",'booking paid');
        }

        if($statusChanged) {
            self::updateMailer($clientId,$transactionCode,strtoupper("booking ".$new_status." notification"),$new_status);
        }

        return $this->return;
    }


    /**
     * Get all information about a booking
     * @param $orderId
     * @return array
     */
    public function getBookingInfo($orderId){
        $orderId = Utility::sanitizeStr($orderId);
        $qry = $this->db->dbSELECT('*',"code='".$orderId."'",$this->tbl_bookings);
        if($qry->status == true){
            $this->return['status'] = true ;

            /* get users information */
            $client = new clientModel();
            $getClient = $client->getClient($qry->result->client_id);
            $clientInfoArr = new ArrToObj($getClient['result']) ;

            /* get bookings info */
            $itemsInfoArr = array() ;
            $itemsArray = array();
            $priceList = self::getPriceList();
            foreach($priceList as $listItem){
                $i = $listItem['item_id'];
                $itemsArray[$i] = array("name"=>$listItem['name'],"price"=>$listItem['price']) ;
            }

            /* process items and quantity JSON */
            $allItems = json_decode($qry->result->items);
            //print_r($allItems);
            foreach($allItems as $pairs){
                $itemId = $pairs->item_id ;
                $itemQty = intval($pairs->quantity);
                $itemName = $itemsArray[$itemId]['name'] ;
                $itemPrice = intval($itemsArray[$itemId]['price']) ;
                $totalCost = $itemQty * $itemPrice ;
                $itemsInfoArr[] = new ArrToObj(array("item_id"  => $itemId,
                                        "quantity" => $itemQty,
                                        "name"     => $itemName,
                                        "price"    => $itemPrice,
                                        "cost"     => $totalCost) );
            }

            $this->return['result'] = new ArrToObj(array('items'=>$itemsInfoArr,'client'=>$clientInfoArr,'booking'=>$qry->result)) ;
        }else{
            $this->return['result'] = "Order was not found or has been deleted" ;
        }
        return $this->return ;
    }


    /**
     * Fetch the Price List of all items
     * @return array
     */
    public function getPriceList(){
        $db = $this->db->query("SELECT * FROM ".$this->tbl_priceList);
        $array = array();
        while($r = $db->fetch_assoc()){
            $array[] = $r;
        }
        return $array ;
    }


    /**
     * Place a new booking
     * @param $clientID
     * @param $pickupDate
     * @param $items
     * @return array
     */
    public function create($clientID,$pickupDate,$items){
        $client_id = Utility::sanitizeStr($clientID);
        $pickupDate = Utility::sanitizeStr($pickupDate);
        /*$itemsArray = Utility::sanitizeStr( json_decode($items) );
        $json = json_encode($itemsArray) ;*/
        $code = Utility::rand(10);
        $set = "client_id='".$client_id."', pickup_date='".$pickupDate."', items='".$items."', code='".$code."'";
        $qry = $this->db->dbINSERT($set,$this->tbl_bookings) ;
        if( $qry->status == true ){
            $this->return['status'] = true ;
            $this->return['result'] = $code ;

            /* Send email to client */
            self::updateMailer($client_id,$code,"New Booking Placed");

        }else{
            $this->return['result'] = $qry->result ;
        }
        return $this->return ;
    }


    /**
     * Send Update emails when a booking is create and updated
     * @param $client_id
     * @param $code
     * @param $subject
     * @param $type
     */
    private function updateMailer($client_id,$code,$subject,$type=""){
        $clMd = new clientModel();
        $client = $clMd->getClient($client_id);
        $emailTpl = new emailTemplate('Hi, '.$client['result']['name'],$type);
        $linkVar = URL . '/bookings/'.$code ; // create booking link
        $emailTpl->setVar('link',$linkVar);
        $mailer = new Email();
        $mailer->setTo($client['result']['email'],$client['result']['name']);
        $mailer->setFrom(ADMIN_EMAIL,SITENAME);
        $mailer->setSubject($subject);
        $mailer->addMailHeader('Reply-To', ADMIN_EMAIL, SITENAME);
        $mailer->addGenericHeader('Content-Type', 'text/html; charset="utf-8"');
        $mailer->addGenericHeader('X-Mailer', 'PHP/' . phpversion()) ;
        $mailer->setTo(ADMIN_EMAIL,SITENAME);

        $mailer->setMessage($emailTpl->getMessage());
        /* Send message only when app is not in development mode */
        if(APP_MODE !== 'Development'){
            $mailer->send();
        }else{
            file_put_contents('inbox.html',$mailer->getMessage()) ;
        }
    }

} 