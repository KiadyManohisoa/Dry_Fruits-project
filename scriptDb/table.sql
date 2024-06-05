CREATE TABLE Cat_Produit(
   id SERIAL,
   libelle VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(libelle)
);

CREATE TABLE Cat_Fruit(
   id SERIAL,
   libelle VARCHAR(25)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(libelle)
);

CREATE TABLE Produit(
   id SERIAL,
   lienImage VARCHAR(50)  NOT NULL,
   description VARCHAR(75) ,
   dateCreation DATE,
   id_1 INTEGER NOT NULL,
   id_2 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Cat_Produit(id),
   FOREIGN KEY(id_2) REFERENCES Cat_Fruit(id)
);

CREATE TABLE Stock(
   id VARCHAR(50) DEFAULT ('STK') || LPAD(nextval('stock_sequence')::TEXT,4,'0'),
   dateRenouvellement TIMESTAMP,
   qttKg NUMERIC(9,2)   NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);

CREATE TABLE Compte_clients(
   id VARCHAR(20) DEFAULT ('CTL') || LPAD(nextval('compte_clients_sequence')::TEXT,4,'0'),
   pseudoName VARCHAR(25) ,
   mdp VARCHAR(50)  NOT NULL,
   mail VARCHAR(50) ,
   numéro VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(pseudoName)
);

CREATE TABLE Admin(
   id SERIAL,
   pseudoName VARCHAR(25) ,
   mdp VARCHAR(50)  NOT NULL,
   PRIMARY KEY(id),
   UNIQUE(pseudoName)
);

CREATE TABLE Mvt_Detail(
   id VARCHAR(50) DEFAULT ('MVD') || LPAD(nextval('mvt_detail_sequence')::TEXT,4,'0'),
   dateMvt DATE,
   prix NUMERIC(14,2)  ,
   reduction SMALLINT,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);

CREATE TABLE Mvt_Vrac(
   id VARCHAR(50) DEFAULT ('MVV') || LPAD(nextval('mvt_vrac_sequence')::TEXT,4,'0'),
   dateMvt DATE,
   prix NUMERIC(14,2)  ,
   reduction SMALLINT,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);

CREATE TABLE Mvt_Gros(
   id VARCHAR(50) DEFAULT ('MVG') || LPAD(nextval('mvt_gros_sequence')::TEXT,4,'0'),
   dateMvt DATE,
   prix NUMERIC(14,2)  ,
   reduction SMALLINT,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);

CREATE TABLE Mvt_DepensesKg(
   id VARCHAR(50) DEFAULT ('MVD') || LPAD(nextval('mvt_depensesKg_sequence')::TEXT,4,'0'),
   dateMvt DATE,
   prix NUMERIC(14,2)  ,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);

CREATE TABLE Produit_commander(
   id VARCHAR(50) DEFAULT ('PCM') || LPAD(nextval('produit_commander_sequence')::TEXT,4,'0'),
   typeVente CHAR(1) ,
   quantite NUMERIC(14,2)  ,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit(id)
);

CREATE TABLE Favoris_Client(
   id VARCHAR(50) DEFAULT ('FAC') || LPAD(nextval('favoris_client_sequence')::TEXT,4,'0'),
   PRIMARY KEY(id)
);

CREATE TABLE Commande(
   id SERIAL,
   idCommande VARCHAR(35)  NOT NULL,
   reduction SMALLINT,
   dateCommande TIMESTAMP,
   id_1 VARCHAR(75)  NOT NULL,
   id_2 VARCHAR(20)  NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Produit_commander(id),
   FOREIGN KEY(id_2) REFERENCES Compte_clients(id)
);

CREATE TABLE Livraison(
   id VARCHAR(50) DEFAULT ('LIV') || LPAD(nextval('livraison_sequence')::TEXT,4,'0'),
   dateLivraison TIMESTAMP,
   adresseLivraison VARCHAR(50)  NOT NULL,
   frais NUMERIC(10,2)   NOT NULL,
   statut SMALLINT NOT NULL,
   id_1 INTEGER NOT NULL,
   PRIMARY KEY(id),
   FOREIGN KEY(id_1) REFERENCES Commande(id)
);

CREATE TABLE Asso_13(
   id INTEGER,
   id_1 VARCHAR(50) ,
   PRIMARY KEY(id, id_1),
   FOREIGN KEY(id) REFERENCES Produit(id),
   FOREIGN KEY(id_1) REFERENCES Favoris_Client(id)
);

CREATE TABLE Asso_14(
   id VARCHAR(20) DEFAULT ('ASO') || LPAD(nextval('asso_14_sequence')::TEXT,4,'0'),
   id_1 VARCHAR(50) ,
   PRIMARY KEY(id, id_1),
   FOREIGN KEY(id) REFERENCES Compte_clients(id),
   FOREIGN KEY(id_1) REFERENCES Favoris_Client(id)
);
