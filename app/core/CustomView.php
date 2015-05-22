<?php

/**
 * View Class
 * Handles and generates all views
 */

class CustomView{

    private  $dataArr = array();

	public  $title ;
    public $description ;
    public $keywords ;
    public $body ;
    private $url = URL ;
    private $header = null ;
    private $footer = null ;
    private $injectHeader ;
    private $OUTPUT ;

    /** Set variable to be available in view
     * @param $variable
     * @param $value
     */
    public function setVar($variable,$value){
        $this->dataArr[$variable] = $value;
    }

    public function setHeader($header){
        $this->header = $header ;
    }

    /**
     * @param array $code
     */
    public function headerInject($code=array()){
        $this->injectHeader = $code ;
    }

    public function setFooter($footer){
        $this->footer = $footer ;
    }

	public function setTitle($title){
		$this->title = $title ;
	}

    public function setKeywords($keywords){
        $this->keywords = $keywords;
    }

	public function setDesc($desc){
		$this->description = $desc ;
	}

	public function setBody($file){		
		$this->body = $file ;
	}

	public  function loadExecfile($file){
	    ob_start();
        /** @noinspection PhpIncludeInspection */
        include $file ;
        $out = ob_get_contents();
        ob_end_clean();
        return $out ;
	}

    /**
     * Render the page
     * @return string|void
     */
    public function render(){
        //$this->data = new ArrToObj($this->dataArr);
        foreach($this->dataArr as $key => $value) {
            //$$key = $value;
            $this->$key = $value ;
        }

        if($this->header !== null){
            $this->OUTPUT .= $this->loadExecfile($this->header) ;
        }

        $this->OUTPUT .= $this->loadExecfile($this->body) ;

        if($this->footer !== null){
            $this->OUTPUT .= $this->loadExecfile($this->footer) ;
        }
        header("Content-type:text/html");
        print $this->OUTPUT ;
	}


    /**
     * Generate seo url link
     * eg. title-of-the-book
     * @param $s
     * @return string
     */
    protected function generateUrl($s) {
        //Convert accented characters, and remove parentheses and apostrophes
        $from = explode (',', "ç,æ,œ,á,é,í,ó,ú,à,è,ì,ò,ù,ä,ë,ï,ö,ü,ÿ,â,ê,î,ô,û,å,e,i,ø,u,(,),[,],'");
        $to = explode (',', 'c,ae,oe,a,e,i,o,u,a,e,i,o,u,a,e,i,o,u,y,a,e,i,o,u,a,e,i,o,u,,,,,,');
        //Do the replacements, and convert all other non-alphanumeric characters to spaces
        $s = preg_replace ('~[^\w\d]+~', '-', str_replace ($from, $to, trim ($s)));
        //Remove a - at the beginning or end and make lowercase
        return strtolower (preg_replace ('/^-/', '', preg_replace ('/-$/', '', $s)));
    }
	
}