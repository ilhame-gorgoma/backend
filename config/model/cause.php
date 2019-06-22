<?php
class cause extends database
{
    public $id;
    public $title;
    public $content;
    public $dateCreation;
    public $dateEnd;
    public $status;
    public $image;
    public $id_user;
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @return boolean
     */
    public function addCause(){
        $prepare = $this -> db -> prepare("INSERT INTO `cause`(`title`, `content`, `dateCreation`, `dateEnd`, `status`, `image`) VALUES (:title, :content, :dateCreation, :dateEnd, :status, :image)");
        $prepare -> bindValue(':title', $this -> title, PDO::PARAM_STR);
        $prepare -> bindValue(':content', $this -> content, PDO::PARAM_STR);
        $prepare -> bindValue(':dateCreation', $this -> dateCreation, PDO::PARAM_STR);
        $prepare -> bindValue(':dateEnd', $this -> dateEnd, PDO::PARAM_STR);
        $prepare -> bindValue(':status', $this -> status, PDO::PARAM_INT);
        $prepare -> bindValue(':image', $this -> image, PDO::PARAM_STR);
        if($prepare -> execute()){
            return true;
        }
    }

    /**
    * Retourne un tableau contenant toute les données d'une recette grace à l'id de la recette
    * @return type
    */
    public function causeByIdRecipe(){
        $prepare = $this->db->prepare('SELECT * FROM cause WHERE id = :id');
        $prepare->bindValue(':id', $this->id, PDO::PARAM_INT);
        $prepare->execute();
        $recipe = $prepare->fetch(PDO::FETCH_OBJ);
        return $recipe;
    }

    /**
     * recherche d'un article grâce au nom de l'article
     * @return type
     */
    public function causeByName(){
        $prepare = $this->db->prepare('SELECT * FROM cause WHERE title = :title');
        $prepare -> bindValue(':title', $this -> title, PDO::PARAM_STR);
        $result = $prepare -> fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Modifie une article grâce à son id
     * @return boolean
     */
    public function updateArticle(){
        $prepare = $this -> db -> prepare('UPDATE `cause` SET `title`=:title,`content`=:content,`dateCreation`=:dateCreation,`dateEnd`=:dateEnd,`status`=:status, `image`=:image
        WHERE id=:id');
        $prepare -> bindValue(':title', $this -> title, PDO::PARAM_STR);
        $prepare -> bindValue(':content', $this -> content, PDO::PARAM_STR);
        $prepare -> bindValue(':dateCreation', $this -> dateCreation, PDO::PARAM_STR);
        $prepare -> bindValue(':dateEnd', $this -> dateEnd, PDO::PARAM_STR);
        $prepare -> bindValue(':image', $this -> image, PDO::PARAM_STR);
        $prepare -> bindValue(':status', $this -> status, PDO::PARAM_INT);
        $prepare -> bindValue(':id', $this -> id, PDO::PARAM_INT);
        if($prepare -> execute()){
            return true;
        }
    }


    /**
    * Supprime une recette grace à son id
    * @return boolean
    */
    public function deleteCauseByAdmin(){
        $prepare = $this -> db -> prepare("DELETE FROM `cause` WHERE `id` = :id");
        $prepare -> bindValue(':id', $this -> id, PDO::PARAM_INT);
        if ($prepare -> execute()) {
            return true;
        }
    }

}