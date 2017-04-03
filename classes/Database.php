<?php 

class Database {
  
  //set up some properties
  //connection
  
  private $host = "localhost";
  private $user = "builtbye_webnote";
  private $password = "Webnote_pass123";
  private $dbname = "builtbye_web_note";
  
  private $dbh; //database handler
  private $error; //collect the errors
  private $stmt; //the statement
  
  //build the constructor
  public function __construct(){
    
    //set DSN
    $dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname;
    
    //set options
    $options = array(
      PDO::ATTR_PERSISTENT   => true,
      PDO::ATTR_ERRMODE      => PDO::ERRMODE_EXCEPTION
    );
    
    //create new pdo
    try {
      
      $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
      
    }catch(PDOException $e){
      
      $this->error = $e->getMessage();
      
      echo $e;
      
    } // end try catch
   } //end constructor function
  
  //build some methods
  public function query($query){
    
    $this->stmt = $this->dbh->prepare($query);
     
  } // end query
  
  //bind the data
  public function bind($param,$value,$type = null){
    
    if(is_null($type)){
      
      //switch statement
      switch(true){
        case is_int($value): $type = PDO::PARAM_INT;
          break;
          
        case is_bool($value): $type = PDO::PARAM_BOOL;
          break;
          
        case is_null($value): $type = PDO::PARAM_NULL;
          break;
          
        default: $type = PDO::PARAM_STR;
          
      } //end switch
      
    } //end if
    
    $this->stmt->bindValue($param,$value,$type);
    
  } // end bind
  
  public function execute(){
    
    //execute the statment
    return $this->stmt->execute();
    
  } //end execute
  
  public function result_set(){
    
    //excute the statement
    $this->execute();
    
    //get the data
    return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    
  }
  
  //check to see if database affected
  public function last_insert_id (){
    
    $this->dbh->lastInsertId();
    
  }
  
}//end Database