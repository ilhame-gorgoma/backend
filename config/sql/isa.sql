#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: role
#------------------------------------------------------------

CREATE TABLE role(
        id   Int  Auto_increment  NOT NULL ,
        role Varchar (125) NOT NULL
	,CONSTRAINT role_PK PRIMARY KEY (id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id        Int  Auto_increment  NOT NULL ,
        username  Varchar (125) NOT NULL ,
        password  Varchar (125) NOT NULL ,
        lastname  Varchar (255) ,
        firstname Varchar (255) ,
        email     Varchar (255) ,
        id_role   Int NOT NULL
	,CONSTRAINT user_PK PRIMARY KEY (id)

	,CONSTRAINT user_role_FK FOREIGN KEY (id_role) REFERENCES role(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: article
#------------------------------------------------------------

CREATE TABLE article(
        id           Int  Auto_increment  NOT NULL ,
        author       Varchar (150) NOT NULL ,
        title        Varchar (255) NOT NULL ,
        content      Longtext NOT NULL ,
        dateCreation TimeStamp NOT NULL ,
        date         Date NOT NULL ,
        image        Varchar (255) NOT NULL ,
        id_user      Int NOT NULL
	,CONSTRAINT article_PK PRIMARY KEY (id)

	,CONSTRAINT article_user_FK FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: cause
#------------------------------------------------------------

CREATE TABLE cause(
        id           Int  Auto_increment  NOT NULL ,
        title        Varchar (255) NOT NULL ,
        content      Longtext NOT NULL ,
        description  Text NOT NULL ,
        dateCreation Date NOT NULL ,
        dateEnd      Date NOT NULL ,
        status       Bool NOT NULL ,
        image        Varchar (255) NOT NULL ,
        id_user      Int NOT NULL
	,CONSTRAINT cause_PK PRIMARY KEY (id)

	,CONSTRAINT cause_user_FK FOREIGN KEY (id_user) REFERENCES user(id)
)ENGINE=InnoDB;

