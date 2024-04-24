DROP TABLE if exists UTILISATEUR cascade;
DROP TABLE if exists NEWS cascade;
DROP TABLE if exists CLUB cascade;
DROP TABLE if exists S_ABONNER cascade;

-- -----------------------------------------------------------------------------
--       TABLE : UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE TABLE UTILISATEUR
   (
     ID_UTI serial NOT NULL,
     ID_CLUB int NOT NULL,
     NOM_UTI varchar(30) NOT NULL,
     PRENOM_UTI varchar(30) NOT NULL,
     SEXE_UTI varchar(15) NOT NULL,
     PASSWORD_UTI varchar(64) NOT NULL CHECK(LENGTH(PASSWORD_UTI) >= 12),
     DATE_INSCRIPTION date DEFAULT CURRENT_DATE,
     IMAGE_UTI text NULL,
     MAIL_UTI text NULL,
	CONSTRAINT PK_UTILISATEUR PRIMARY KEY (ID_UTI),
     CONSTRAINT UC_UTILISATEUR_MAIL_UTI UNIQUE (MAIL_UTI)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE UTILISATEUR
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_UTILISATEUR_CLUB
     ON UTILISATEUR (ID_CLUB)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : NEWS
-- -----------------------------------------------------------------------------

CREATE TABLE NEWS
   (
     ID_NEWS serial NOT NULL,
     ID_CLUB int NOT NULL,
     ARTICLE_NEWS varchar NULL,
     CONSTRAINT PK_NEWS PRIMARY KEY (ID_NEWS)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE NEWS
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_NEWS_CLUB
     ON NEWS (ID_CLUB)
    ;

-- -----------------------------------------------------------------------------
--       TABLE : CLUB
-- -----------------------------------------------------------------------------

CREATE TABLE CLUB
   (
    ID_CLUB serial NOT NULL,
    NOM_CLUB varchar(128) NOT NULL,
    LIGUE_CLUB char(2) NOT NULL,
    CONSTRAINT PK_CLUB PRIMARY KEY (ID_CLUB)
   ) ;

-- -----------------------------------------------------------------------------
--       TABLE : S_ABONNER
-- -----------------------------------------------------------------------------

CREATE TABLE S_ABONNER
   (
     ID_UTI int NOT NULL,
     ID_CLUB int NOT NULL,   
     CONSTRAINT PK_S_ABONNER PRIMARY KEY (ID_UTI, ID_CLUB)
   ) ;

-- -----------------------------------------------------------------------------
--       INDEX DE LA TABLE S_ABONNER
-- -----------------------------------------------------------------------------

CREATE  INDEX I_FK_S_ABONNER_UTILISATEUR
     ON S_ABONNER (ID_UTI)
    ;

CREATE  INDEX I_FK_S_ABONNER_CLUB
     ON S_ABONNER (ID_CLUB)
    ;


-- -----------------------------------------------------------------------------
--       CREATION DES REFERENCES DE TABLE
-- -----------------------------------------------------------------------------


ALTER TABLE UTILISATEUR ADD 
     CONSTRAINT FK_UTILISATEUR_CLUB
          FOREIGN KEY (ID_CLUB)
               REFERENCES CLUB (ID_CLUB);

ALTER TABLE NEWS ADD 
     CONSTRAINT FK_NEWS_CLUB
          FOREIGN KEY (ID_CLUB)
               REFERENCES CLUB (ID_CLUB);

ALTER TABLE S_ABONNER ADD 
     CONSTRAINT FK_S_ABONNER_UTILISATEUR
          FOREIGN KEY (ID_UTI)
               REFERENCES UTILISATEUR (ID_UTI);

ALTER TABLE S_ABONNER ADD 
     CONSTRAINT FK_S_ABONNER_CLUB
          FOREIGN KEY (ID_CLUB)
               REFERENCES CLUB (ID_CLUB);


-- -----------------------------------------------------------------------------
--                INSERT des CLUBS
-- -----------------------------------------------------------------------------

insert into club values
(default,'Paris-SG'  ,'L1'),
(default,'Lens' 	, 'L1'),
(default,'Lorient' 	 ,'L1'),
(default,'Rennes' 	, 'L1'),
(default,'Marseille' ,'L1'),
(default,'Lille' 	, 'L1'),
(default,'Monaco'	, 'L1'),
(default,'Lyon' 	, 'L1'),
(default,'Clermont' , 'L1'),
(default,'Toulouse' , 'L1'),
(default,'Troyes'	, 'L1'),
(default,'Nice' 	, 'L1'),
(default,'Montpellier','L1'),
(default,'Reims' 	, 'L1'),
(default,'Nantes'	, 'L1'),
(default,'Strasbourg','L1'),
(default,'Brest' 	, 'L1'),
(default,'Auxerre'	 ,'L1'),
(default,'AC Ajaccio','L1'),
(default,'Angers'    ,'L1');