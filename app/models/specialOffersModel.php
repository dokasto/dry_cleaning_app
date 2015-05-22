<?php
/**
 * Culmen
 * Class: specialOffersModel.php
 * Author: @thisisudo
 * Date: 12/19/14
 * Time: 4:57 AM
 */

class specialOffersModel extends models{

    /**
     * Fetch All special offers from the database
     * @return array|null
     */
    public function fetch(){
        $qry = $this->db->query("SELECT * FROM ".$this->tbl_specialOffers);
        $array = array();
        while($r = $qry->fetch_assoc()){
            $array[] = new ArrToObj($r) ;
        }
        if(count($array) > 0){
            return $array;
        }else{
            return null ;
        }
    }


    /**
     * Create a new special offer
     * @param $offer
     * @return ArrToObj
     */
    public function create($offer){
        $content = htmlspecialchars($offer);
        $where = "offer='".$content."'" ;
        /* Check if content is duplicate */
        $check = $this->db->dbSELECT('offer_id',$where,$this->tbl_specialOffers);
        if($check->status !== true){
        $qry = $this->db->dbINSERT($where,$this->tbl_specialOffers);
        if($qry->status == true ){
            $get = $this->db->dbSELECT('offer_id',$where,$this->tbl_specialOffers);
            if($get->status == true){
                $this->return['status'] = true ;
                $this->return['result'] = $get->result->offer_id ;
            }else{
                $this->return['result'] = $get->result ;
            }
        }else{
            $this->return['result'] = $qry->result ;
        }
        }else{
            $this->return['result'] = "This is offer already exists !" ;
        }
        return $this->return;
    }


    /**
     * Remove an offer
     * @param $offer_id
     * @return ArrToObj
     */
    public function remove($offer_id) {
        $offer_id = Utility::sanitizeStr($offer_id);
        $qry = $this->db->dbDELETE("offer_id='".$offer_id."'",$this->tbl_specialOffers);
        return $qry;
    }

} 