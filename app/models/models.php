<?php
/**
 * Culmen
 * Class: models.php
 * Author: @thisisudo
 * Date: 12/20/14
 * Time: 7:01 AM
 */

abstract class models {

    protected  $db ;
    protected  $return = array("status"=>false) ;
    protected  $uploadsPath = 'data/profiles/' ;

    /* List of Database tables */
    protected $tbl_admin = 'cld_admin';
    protected $tbl_clients = 'cld_clients';
    protected $tbl_bookings = 'cld_bookings';
    protected $tbl_priceList = 'cld_price_list';
    protected $tbl_specialOffers = 'cld_special_offers';

    /**
     * Every model needs a database connection, passed to the model
     * Create a new instance of the database
     */
    public function __construct() {
        try {
            $this->db = new Database() ;
        } catch (Exception $e) {
            exit('Database connection could not be established.');
        }
    }

} 