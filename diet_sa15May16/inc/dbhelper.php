<?php

class Database
{
    var $host="";
    var $user="";
    var $password="";
    var $database="";
    var $result="";
    var $con="";
    var $sql="";
    
    function Database()
    {
        $conf=new Config();
        $this->host=$conf->host;
        $this->user=$conf->user;
        $this->password=$conf->password;
        $this->database=$conf->database;
    }
    
    function open()
    {
      $this->con=@mysql_connect($this->host,$this->user,$this->password);
      
      if(!$this->con)
      {
        header("Location:error.html");
        return false;
      }
             
      if(!@mysql_select_db($this->database,$this->con))
      {
        header("Location:error.html");
        return false;
      }
      return true; 
    }
    
    function query($sql='')
    {
        $this->result=@mysql_query($sql,$this->con);
        return $this->result;
    }
    
    function fetchobject($result)
    {
       return @mysql_fetch_object($result);
    }
    
    function fetcharray($result)
    {
        return @mysql_fetch_array($result); 
    }
    
  
}

?>