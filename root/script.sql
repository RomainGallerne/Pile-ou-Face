CREATE TABLE IF NOT EXISTS PileOuFace (
    idutilisateur INT NOT NULL, /*l'indentifiant de l'utilisateur*/
    age VARCHAR(50) NOT NULL, /*son âge*/
    sexe VARCHAR(50) NOT NULL, /*son sexe*/
    versionpage VARCHAR(50) NOT NULL, /*Est-il sur la page scientifique ou la page normal*/
    pagetruque VARCHAR(50) NOT NULL, /*La page sur laquelle il est est-elle truqué ?*/
    utilisateurtruque VARCHAR(50) NOT NULL, /*A t-il répondu que l'application était truqué ?*/
    raisontruque VARCHAR(500) NOT NULL, /*Pour quelle raison est-ce truqué ?*/
    apriori VARCHAR(50) NOT NULL, /*l'utilisateur avait-il un apriori*/
    raisonapriori VARCHAR(500) NOT NULL, /*Pour quelle raison avait-il un apriori (s'il en a un)*/
    critereXP VARCHAR(50), /*Critère d'expérience utilisateur ?*/
    criterePersonne VARCHAR(50), /*Critère de la personne l'ayant développé*/
    critereReputation VARCHAR(50), /*Critère de réputation*/
    critereAutre VARCHAR(500), /*Autres critères ?*/
    PRIMARY KEY (idutilisateur)
);