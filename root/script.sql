CREATE TABLE IF NOT EXISTS PileOuFace (
    idutilisateur INT NOT NULL AUTO_INCREMENT=0,
    typepage VARCHAR(50) NOT NULL,
    truque VARCHAR(50) NOT NULL,
    raison VARCHAR(500) NOT NULL,
    apriori VARCHAR(50) NOT NULL,
    critereXP VARCHAR(50),
    criterePersonne VARCHAR(50),
    critereReputation VARCHAR(50),
    critereAutre VARCHAR(500),
    PRIMARY KEY (idutilisateur)
);