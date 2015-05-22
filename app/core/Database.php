<?php
 /**
     * Database class
     * Handles all database transactions 
     */

class Database extends MySQLi {

  const DB_USERNAME = DB_USER ;
  const DB_PASSWORD = DB_PASS ;
  const DB_HOST = DB_HOST ;
  const DB_NAME = DB_NAME ;

    private $result = array() ;

   /**
     * create connection with the database
     */
  public function __construct(){
    parent :: __construct( Database::DB_HOST , Database::DB_USERNAME , Database::DB_PASSWORD , Database::DB_NAME );
    if(mysqli_connect_error())
    {
      die("Database connection error! (" . mysqli_connect_errno() . ") ");
    }
  }


    public function dbUPDATE( $set , $where,$table=''){
        $this->result['status'] = false ;
        if( $where !== ''){ $WHERE = ' WHERE '.$where ;	}
        else{ $WHERE = '' ;	}
        $data_table = '' ;
        if( $table !== ''){
            $data_table = $table ;
        }
        else{
            $data_table = $this->table ;
        }
        if($this->query("UPDATE ".$data_table ." SET ".$set.$WHERE)){
            $this->result['status'] = true ;
        }
        else{
            $this->result['result'] = $this->error ;
        }
        return new ArrToObj($this->result) ;
    }

    public function dbSELECT($colums,$where='',$table=''){
        $datas = array() ;
        $data_table = '' ;
        if( $table !== ''){
            $data_table = $table ;
        }
        else{
            $data_table = $this->table ;
        }

        if( $where !== ''){ $WHERE = ' WHERE '.$where ;	}
        else{ $WHERE = '' ;	}

        $q = $this->query('SELECT '.$colums.' FROM '.$data_table.$WHERE.' ');
        $r = $q->fetch_assoc();
        if($r){
            $this->result['status'] = true ;
            foreach($r as $key => $value){
                $datas[$key] = $value  ;
            }
            $this->result['result'] = new ArrToObj($datas) ;
        }
        else{
            $this->result['status'] = false ;
            $this->result['result']  = $this->error ;
        }
        return new ArrToObj($this->result) ;
    }

    public function dbINSERT($set ,$table=''){
        //print($set);die() ;
        $data_table = '' ;
        if( $table !== ''){
            $data_table = $table ;
        }
        else{
            $data_table = $this->table ;
        }
        if($this->query("INSERT INTO ".$data_table ." SET ".$set)){
            $this->result['status'] = true ;
            $this->result['result'] = 'success' ;
        }
        else{
            $this->result['status'] = false ;
            $this->result['result'] = $this->error ;
        }
        return new ArrToObj($this->result) ;
    }

    public function dbDELETE($where,$table=''){
        $data_table = '' ;
        if( $table !== ''){
            $data_table = $table ;
        }
        else{
            $data_table = $this->table ;
        }
        if($this->query("DELETE FROM ".$data_table." WHERE ".$where)){
            $this->result['status'] = true ;
        }
        else{
            $this->result['status'] = false ;
            $this->result['result'] = $this->error ;
        }
        return new ArrToObj($this->result) ;
    }

}