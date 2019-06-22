<?php
class article extends database
{
    public $id;
    public $title;
    public $author;
    public $content;
    public $description;
    public $date;
    public $image;
    public $id_user;
    
    public function __construct() {
        parent::__construct();
    }
    
    /**
     * 
     * @return boolean
     */
    public function addArticle(){
        $prepare = $this -> db -> prepare("INSERT INTO `article`(`title`, `author`, `content`, `description`, `date`, `image`) VALUE(:title, :author, :content, :description :date, :image)");
        $prepare -> bindValue(':title', $this -> title, PDO::PARAM_STR);
        $prepare -> bindValue(':author', $this -> author, PDO::PARAM_STR);
        $prepare -> bindValue(':content', $this -> content, PDO::PARAM_STR);
        $prepare -> bindValue(':description', $this -> description, PDO::PARAM_STR);
        $prepare -> bindValue(':date', $this -> date, PDO::PARAM_STR);
        $prepare -> bindValue(':image', $this -> image, PDO::PARAM_STR);
        if($prepare -> execute()){
            return true;
        }
    }

    /**
     * Retourne un tableau contenant toute les recette de l'utilisateur
     * @return type
     */
    public function listMyArticle(){
        $prepare = $this->db->prepare('SELECT * FROM article WHERE id_user = :id_user');
        $prepare->bindValue(':id_user', $this->id_user, PDO::PARAM_INT);
        $prepare->execute();
        $all = $prepare->fetchAll(PDO::FETCH_OBJ);
        return $all;
    }

    /**
    * Retourne un tableau contenant toute les données d'une recette grace à l'id de la recette
    * @return type
    */
    public function articleByIdRecipe(){
        $prepare = $this->db->prepare('SELECT * FROM recipe WHERE id = :id');
        $prepare->bindValue(':id', $this->id, PDO::PARAM_INT);
        $prepare->execute();
        $recipe = $prepare->fetch(PDO::FETCH_OBJ);
        return $recipe;
    }

    /**
     * recherche d'un article grâce au nom de l'article
     * @return type
     */
    public function articleByName(){
        $prepare = $this->db->prepare('SELECT * FROM article WHERE title = :title');
        $prepare -> bindValue(':title', $this -> title, PDO::PARAM_STR);
        $result = $prepare -> fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    /**
     * Modifie une article grâce à son id
     * @return boolean
     */
    public function updateArticle(){
        $prepare = $this -> db -> prepare('UPDATE `article` SET `title` = :title, `author` = :author, `content` = :content, description = :description, date = :date, `image` = :image WHERE `id` = :id');
        $prepare -> bindValue(':title', $this -> title, PDO::PARAM_STR);
        $prepare -> bindValue(':author', $this -> author, PDO::PARAM_STR);
        $prepare -> bindValue(':content', $this -> content, PDO::PARAM_STR);
        $prepare -> bindValue(':description', $this -> description, PDO::PARAM_STR);
        $prepare -> bindValue(':date', $this -> date, PDO::PARAM_STR);
        $prepare -> bindValue(':image', $this -> image, PDO::PARAM_STR);
        $prepare -> bindValue(':id', $this -> id, PDO::PARAM_INT);
        if($prepare -> execute()){
            return true;
        }
    }

    /**
     * Supprime une recette grace à son id et l'id de l'utilisateur
     * @return boolean
     */
    public function deleteArticle(){
        $prepare = $this -> db -> prepare("DELETE FROM `article` WHERE `id` = :id AND `id_user` = :id_user");
        $prepare -> bindValue(':id', $this -> id, PDO::PARAM_INT);
        $prepare -> bindValue(':id_user', $this -> id_user, PDO::PARAM_INT);
        if ($prepare -> execute()) {
            return true;
        }
    }

    /**
    * Supprime une recette grace à son id
    * @return boolean
    */
    public function deleteArticleByAdmin(){
        $prepare = $this -> db -> prepare("DELETE FROM `recipe` WHERE `id` = :id");
        $prepare -> bindValue(':id', $this -> id, PDO::PARAM_INT);
        if ($prepare -> execute()) {
            return true;
        }
    }

}