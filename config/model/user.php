<?php
class user extends database
{
   
    public $id;
    public $pseudo;
    public $password;
    public $email;
    public $lastname;
    public $firstname;
    public $id_role = 3;

    public function __construct() {
        parent::__construct();
    }
    //affiche tous les utilisateur
    public function listAllUser(){
        $query = $this ->db->query("SELECT * FROM user");
        $all = $query -> fetchAll(PDO::FETCH_OBJ);
        return $all;
    }
    
    //ajout d'un nouvel utilisateur
    public function addUser(){
        $prepare = $this -> db -> prepare("INSERT INTO `user`(`username`, `password`, `id_role`) VALUE(:username, :password, :id_role)");
        $prepare -> bindValue(':username', $this -> username, PDO::PARAM_STR);
        $prepare -> bindValue(':password', $this -> password, PDO::PARAM_STR);
        $prepare -> bindValue(':id_role', $this -> id_role, PDO::PARAM_INT);
        if($prepare -> execute()){
            return true;
        }
    }

    // suppresion d'un utilisateur grâce à son id
    public function deleteUser(){
        $prepare = $this -> db -> prepare("DELETE FROM `user` WHERE `users`.`id` = :id");
        $prepare -> bindValue(':id', $this -> id, PDO::PARAM_INT);
        if($prepare -> execute()){
            return true;
        } else {
            return false;
        }
    }

    // mise a jour d'un utilisateur grâce à son id
    public function updateUser(){
        $prepare = $this -> db -> prepare("UPDATE user SET username = :username, email = :email, lastname = :lastname, firstname = :firstname WHERE id = :id");
        $prepare->bindValue(":username",$this->username,PDO::PARAM_STR);
        $prepare->bindValue(":email",$this->email,PDO::PARAM_STR);
        $prepare->bindValue(":lastname",$this->lastname,PDO::PARAM_STR);
        $prepare->bindValue(":firstname",$this->firstname,PDO::PARAM_STR);
        $prepare->bindValue(":id",$this->id,PDO::PARAM_INT);
        if($prepare->execute()){
            return true;
        } else {
            return false;
        }
    }


    // mise a jour d'un utilisateur grâce à son id
    public function updateUserAdmin(){
        $prepare = $this -> db -> prepare("UPDATE user SET username = :username, email = :email, lastname = :lastname, firstname = :firstname, id_role = :id_role WHERE id = :id");
        $prepare->bindValue(":username",$this->username,PDO::PARAM_STR);
        $prepare->bindValue(":email",$this->email,PDO::PARAM_STR);
        $prepare->bindValue(":lastname",$this->lastname,PDO::PARAM_STR);
        $prepare->bindValue(":firstname",$this->firstname,PDO::PARAM_STR);
        $prepare->bindValue(":id_role",$this->id_role,PDO::PARAM_INT);
        $prepare->bindValue(":id",$this->id,PDO::PARAM_INT);
        if($prepare->execute()){
            return true;
        } else {
            return false;
        }
    }
    //verifie l'unicité d'un pseudo
    public function pseudoUnique(){
        $prepare = $this->db->prepare('SELECT username FROM user WHERE username = :username');
        $prepare->bindValue(':username', $this->username, PDO::PARAM_STR);
        if($prepare->execute()){
            return $pseudoUnique = $prepare->rowCount();
        }
    }
    //verifie l'unicité d'une addresse mail
    public function mailUnique(){
        $prepare = $this->db->prepare('SELECT email FROM user WHERE email = :email');
        $prepare->bindValue(':email', $this->email, PDO::PARAM_STR);
        if($prepare->execute()){
            return $mailUnique = $prepare->rowCount();
        }
    }
    //renvoie un tableau avec toutes les informations d'un utilisateur grace à son id
    public function listOneUser(){
        $prepare = $this->db->prepare("SELECT * FROM `user` WHERE id = :id");
        $prepare->bindValue(':id', $this->id, PDO::PARAM_INT);
        if($prepare->execute()){
            $listOneUser = $prepare->fetch(PDO::FETCH_OBJ);
            return $listOneUser;
        } else {
            return false;
        }
    }

    public function connectUser(){
        $prepare = $this->db->prepare("SELECT `id`, `password`, `id_role` FROM `user` WHERE `username` = :username");
        $prepare->bindValue(':username', $this->username, PDO::PARAM_STR);
        if ($prepare->execute()) {
            return $result = $prepare->fetch(PDO::FETCH_OBJ);
        } else {
          return false;
        }
    }

    // public function listAll(){
    //     $query = $this->db->query("SELECT users.id id, users.pseudo pseudo, r.idRecipe,idRecipe, r.name recipe, r.description description,COUNT(s.step) step FROM users RIGHT JOIN recipe r USING(id) JOIN step s USING(idRecipe) GROUP BY r.idRecipe, r.name, users.id, users.pseudo");
    //     return $result = $query->fetchAll(PDO::FETCH_OBJ);
    // }

}
