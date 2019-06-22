<?php
class database{
    
    private $db_host = 'internationalsolidarityafrica';
    private $db_name = 'test';
    private $db_username = 'root';
    private $db_password = '';
    
    
    public function __construct() {
        try
            {
                $this->db = new PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name,$this->db_username,$this->db_password, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]); 
            }
        catch(PDOException $e)
            {
                die("Impossible de se connecter : " . $e->getMessage());
            }      
    }
}
?>