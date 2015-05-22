<?php
/**
 * Culmen
 * Class: emailTemplate.php
 * Author: @thisisudo
 * Date: 12/17/14
 * Time: 7:05 PM
 * This classes is used to generate emails to clients
 */

class emailTemplate{

    private $header ;
    private $type ;
    private $dataArr = array();
    private $template ;
    private $temp_dir = 'app/templates';
    private $email_tpl = '/email.php';
    private $bodyTemplate ;

    /**
     * Set type on initialization
     * @param $header
     * @param $type
     */
    public function __construct($header,$type=""){
        self::setHeader($header);
        self::setType($type);
    }

    /**
     * Set the type of email
     * @param $type
     */
    private function setType($type){
        $this->type = $type ;
    }

    /**
     * Set the header message
     * @param $header
     */
    private function setHeader($header){
        $this->header = $header ;
    }

    /**
     * Set a custom variable
     * @param $variable
     * @param $value
     */
    public function setVar($variable,$value){
        $this->dataArr[$variable] = $value;
    }


    /**
     * Get the message type
     */
    public function getMessage(){
        /* set templates */
        switch($this->type){
            case 'processing':
                $this->template = '/booking_processed.php';
                break;
            case 'ready':
                $this->template = '/booking_ready.php';
                break;
            case 'picked up':
                $this->template = '/booking_pickedup.php';
                break;
            default :
                $this->template = '/booking_placed.php';
                break;
        }

        /* Load message template */
        foreach($this->dataArr as $key => $value) {
            $this->$key = $value ;
        }

        $this->bodyTemplate = self::loadBufferFile($this->temp_dir.$this->template);
        /* Load final message */
        return  self::loadBufferFile($this->temp_dir.$this->email_tpl);
    }


    /**
     * Buffer file and execute PHP code inside
     * @param $file
     * @return string
     */
    private function loadBufferFile($file){
        ob_start();
        include $file ;
        $out = ob_get_contents();
        ob_end_clean();
        return $out ;
    }


} 