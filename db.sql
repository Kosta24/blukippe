DROP DATABASE IF EXISTS Calendario_Annuale_Palestra;

CREATE DATABASE IF NOT EXISTS Calendario_Annuale_Palestra;

USE Calendario_Annuale_Palestra;

CREATE TABLE IF NOT EXISTS locale(
    id            INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome          VARCHAR(128) NOT NULL DEFAULT "Locale",
    capienzaMax   INT(10) DEFAULT NULL,
    indiceFattura FLOAT(5,2) NOT NULL DEFAULT 1.0
);

CREATE TABLE IF NOT EXISTS tipiAttivita(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(128) NOT NULL DEFAULT "Tipo Attività"
);

CREATE TABLE IF NOT EXISTS attivita(
    id      INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome    VARCHAR(128) NOT NULL DEFAULT "Attività",
    under18 BIT DEFAULT 0,
    fk_tipo INT(10) NOT NULL,
    FOREIGN KEY (fk_tipo) REFERENCES tipiAttivita(id)
);

CREATE TABLE IF NOT EXISTS extra(
    id            INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nPeople       FLOAT(5,2) NOT NULL DEFAULT 0.0,
    nHours        FLOAT(5,2) NOT NULL DEFAULT 0.0,
    palestrina    BIT DEFAULT 0,
    pubblico      BIT DEFAULT 0,
    respSicurezza BIT DEFAULT 0,
    indiceFattura FLOAT(5,2) NOT NULL DEFAULT 1.0,
    tariffa       FLOAT(10,2) NOT NULL DEFAULT 1.0,
    fk_attivita   INT(10) NOT NULL,
    FOREIGN KEY (fk_attivita) REFERENCES attivita(id)
); 

CREATE TABLE IF NOT EXISTS tariffa(
    id         INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fk_attivita INT(10) NOT NULL,
    prezzo     FLOAT(5,2) NOT NULL DEFAULT 0.0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fk_attivita) REFERENCES attivita(id)
);

CREATE TABLE IF NOT EXISTS ricevuta(
    id         INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    modalita_pagamento       VARCHAR(256) NOT NULL DEFAULT "Bonifico",
    causale    TEXT DEFAULT "",
    da_pagare  BIT NOT NULL DEFAULT 0,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE IF NOT EXISTS disciplina(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL DEFAULT "disciplina"
);

CREATE TABLE IF NOT EXISTS referente(
    id        INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome      VARCHAR(128) NOT NULL DEFAULT "nome",
    cognome   VARCHAR(128) NOT NULL DEFAULT "cognome",
    telefono  VARCHAR(128) NOT NULL DEFAULT "+39 1234567890",
    cellulare VARCHAR(128) NOT NULL DEFAULT "+39 1234567890",
    email     VARCHAR(128) NOT NULL DEFAULT "email@example.com",
    pec       VARCHAR(128) NOT NULL DEFAULT "pec@example.com",
    fAttivo   BIT          NOT NULL DEFAULT 1
);



CREATE TABLE IF NOT EXISTS assocTipo(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(128) NOT NULL DEFAULT "assocTipo"
);

CREATE TABLE IF NOT EXISTS tipoPagamento(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    tipo VARCHAR(128) NOT NULL DEFAULT "tipoPagamento"
);

CREATE TABLE IF NOT EXISTS temp_slots (
    id INT AUTO_INCREMENT PRIMARY KEY,
    giorno TIMESTAMP,
    slot INT
);


CREATE TABLE IF NOT EXISTS ente(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome      VARCHAR(128) NOT NULL DEFAULT "nome",
    pIva      VARCHAR(128) NOT NULL DEFAULT "pIva",
    codFisc   VARCHAR(128) NOT NULL DEFAULT "codFisc",
    SDI       VARCHAR(7)   NOT NULL DEFAULT "SDI",
    IBAN      VARCHAR(128) NOT NULL DEFAULT "IBAN",
    telefono  VARCHAR(128) NOT NULL DEFAULT "+39 1234567890",
    cellulare VARCHAR(128) NOT NULL DEFAULT "+39 1234567890",
    email     VARCHAR(128) NOT NULL DEFAULT "email@example.com",
    pec       VARCHAR(128) NOT NULL DEFAULT "pec@example.com",
    citta     VARCHAR(128) NOT NULL DEFAULT "Citta",
    provincia VARCHAR(128) NOT NULL DEFAULT "Provincia",
    via       VARCHAR(256) NOT NULL DEFAULT "via",
    ncivico   VARCHAR(128) NOT NULL DEFAULT "n1/a",
    cap       VARCHAR(128) NOT NULL DEFAULT "10000",
    paese     VARCHAR(256) NOT NULL DEFAULT "ITA",
    colore    VARCHAR(6) NOT NULL DEFAULT   "ff0000",
    fAttivo   BIT          NOT NULL DEFAULT 1,
    fk_tipo   INT(10) NOT NULL,
    fk_tipoPagamento   INT(10) NOT NULL,
    FOREIGN KEY (fk_tipo) REFERENCES assocTipo(id),
    FOREIGN KEY (fk_tipoPagamento) REFERENCES tipoPagamento(id)
);

CREATE TABLE IF NOT EXISTS referenteEnte(
    id        INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fk_referente INT(10) NOT NULL,
    fk_ente INT(10) NOT NULL,
    FOREIGN KEY (fk_referente)      REFERENCES referente(id),
    FOREIGN KEY (fk_ente)   REFERENCES ente(id)
);

CREATE TABLE IF NOT EXISTS affiliazioneFamiglia(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL DEFAULT "affiliazioneFamiglia"
);

CREATE TABLE IF NOT EXISTS affiliazione(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(128) NOT NULL DEFAULT "affiliazione",
    fk_famiglia INT(10) NOT NULL,
    FOREIGN KEY (fk_famiglia)   REFERENCES affiliazioneFamiglia(id)
);

CREATE TABLE IF NOT EXISTS entiAffiliazioni(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fk_ente INT(10) NOT NULL,
    fk_affiliazione INT(10) NOT NULL,
    FOREIGN KEY (fk_ente)   REFERENCES ente(id),
    FOREIGN KEY (fk_affiliazione)   REFERENCES affiliazione(id)
);

CREATE TABLE IF NOT EXISTS squadra(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome      VARCHAR(128) NOT NULL DEFAULT "nome",
    atleti    INT(10)      NOT NULL DEFAULT 1,
    reps      INT(10)      NOT NULL DEFAULT 7,
    fAttivo   BIT          NOT NULL DEFAULT 1,
    fk_referente    INT(10) NOT NULL,
    fk_tariffaBase  INT(10) NOT NULL,
    fk_disciplina   INT(10) NOT NULL,
    fk_ente INT(10) NOT NULL,
    FOREIGN KEY (fk_referente) REFERENCES referente(id),
    FOREIGN KEY (fk_tariffaBase) REFERENCES tariffa(id),
    FOREIGN KEY (fk_disciplina) REFERENCES disciplina(id),
    FOREIGN KEY (fk_ente) REFERENCES ente(id)
);


CREATE TABLE IF NOT EXISTS evento(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    slots      FLOAT(5,2)   NOT NULL DEFAULT 1.0,
    giorno     DATETIME DEFAULT CURRENT_TIMESTAMP,
    disciplina VARCHAR(128) DEFAULT "",
    note       TEXT DEFAULT "",
    pubblico      BIT DEFAULT 0,
    arbitro       BIT DEFAULT 0,
    respSicurezza BIT DEFAULT 0,
    annullato     BIT DEFAULT 0,
    riferimento   BIT DEFAULT 0,
    created_at    DATETIME DEFAULT CURRENT_TIMESTAMP,
    stato         int(10) default NULL,               /*Dice se l'evento è stato inserito oppure non può essere inserito causa evento già presente */ 
    fk_nextEvento INT(10) default NULL,
    fk_attivita   INT(10) NOT NULL,
    fk_locale     INT(10) NOT NULL,
    fk_squadra1   INT(10) default 0,
    fk_squadra2   INT(10) default 0,
    FOREIGN KEY (fk_attivita) REFERENCES attivita(id),
    FOREIGN KEY (fk_locale)   REFERENCES locale(id),
    FOREIGN KEY (fk_squadra1) REFERENCES squadra(id),
    FOREIGN KEY (fk_squadra2) REFERENCES squadra(id)
);

CREATE TABLE IF NOT EXISTS offDays(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    dayOff     DATETIME
);

CREATE TABLE IF NOT EXISTS showCalendarioSettings(
    id   INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    slots      BIT DEFAULT 1,
    giorno     BIT DEFAULT 1,
    disciplina BIT DEFAULT 1,
    note       BIT DEFAULT 1,
    pubblico      BIT DEFAULT 1,
    arbitro       BIT DEFAULT 1,
    respSicurezza BIT DEFAULT 1,
    annullato     BIT DEFAULT 1,
    riferimento   BIT DEFAULT 1,
    attivita      BIT DEFAULT 1,
    tipoAttivita  BIT DEFAULT 1,
    locale        BIT DEFAULT 1,
    squadra1      BIT DEFAULT 1,
    squadra1Nome      BIT DEFAULT 1,
    squadra1Atleti      BIT DEFAULT 1,
    squadra1Ente      BIT DEFAULT 1,
    squadra2      BIT DEFAULT 1,
    squadra2Nome      BIT DEFAULT 1,
    squadra2Atleti      BIT DEFAULT 1,
    squadra2Ente      BIT DEFAULT 1
);


CREATE TABLE IF NOT EXISTS registro(
    id         INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    totale     FLOAT(10,2) NOT NULL DEFAULT 0.00,
    effettuato BIT DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    fk_evento INT(10) NOT NULL,
    fk_ricevuta INT(10) NOT NULL,
    FOREIGN KEY (fk_evento)   REFERENCES evento(id),
    FOREIGN KEY (fk_ricevuta) REFERENCES ricevuta(id)
);

CREATE TABLE IF NOT EXISTS registroTariffeExtra(
    id         INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    fk_registro INT(10) NOT NULL,
    fk_tariffa INT(10) NOT NULL,
    fk_extra INT(10) NOT NULL,
    FOREIGN KEY (fk_registro)   REFERENCES registro(id),
    FOREIGN KEY (fk_tariffa)   REFERENCES tariffa(id),
    FOREIGN KEY (fk_extra) REFERENCES extra(id)
);



CREATE TABLE IF NOT EXISTS user(
    id        INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome      VARCHAR(128) NOT NULL DEFAULT "nome",
    cognome   VARCHAR(128) NOT NULL DEFAULT "cognome",
    sesso     VARCHAR(1)   NOT NULL DEFAULT "M",
    cellulare VARCHAR(128) NOT NULL DEFAULT "+39 1234567890",
    email     VARCHAR(128) NOT NULL DEFAULT "email@example.com",
    username  VARCHAR(128) NOT NULL DEFAULT "user",
    password  VARCHAR(256) NOT NULL DEFAULT "password",
    salt      VARCHAR(128) NOT NULL DEFAULT "salt",
    grado     int(10)      NOT NULL DEFAULT 1,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS operazioni(
    id        INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome      VARCHAR(128) NOT NULL DEFAULT "nome",
    tipo      VARCHAR(128) NOT NULL DEFAULT "tipo"
);

CREATE TABLE IF NOT EXISTS log(
    id        INT(10) NOT NULL PRIMARY KEY AUTO_INCREMENT,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    fk_user INT(10) NOT NULL,
    fk_operazioni INT(10) NOT NULL,
    FOREIGN KEY (fk_user)   REFERENCES user(id),
    FOREIGN KEY (fk_operazioni)   REFERENCES operazioni(id)
);




insert into locale(nome,capienzaMax,indiceFattura) VALUES
("Intero Stabile",999,1.0),
("Intera Palestra",999,1.0),
("A - palestrina",999,0.5),
("A + palestrina",999,0.5),
("B - palestrina",999,0.5),
("B + palestrina",999,0.5),
("solo palestrina",999,1.0);


insert into tipiAttivita(tipo) VALUES
("Allenamento"),
("Gara"),
("Manifestrazione"),
("Altro");

insert into attivita (nome, under18,fk_tipo) VALUES
("Allenamento Giovanile under 18 prima ora",1,1),
("Allenamento Giovanile under 18 ORE SUCCESSIVE",1,1),
("Singola GARA Giovanile under 18 con Custodia e Pulizia",1,2),
("Allenamento (Serie A–A/1–A2–B1–B2) prima ora",0,1),
("Allenamento (Serie A–A/1–A2–B1–B2) ORE SUCCESSIVE",0,1),
("Singola GARA (Serie A–A/1–A2–B1–B2) compresa custodia e pulizia",0,2),
("Allenamento Serie C - D ed altre attività dilettantistiche di altre categorie inferiori con atleti oltre i 18 anni prima ora",0,1),
("Allenamento Serie C - D ed altre attività dilettantistiche di altre categorie inferiori con atleti oltre i 18 anni ORE SUCCESSIVE",0,1),
("Singola GARA Serie C - D ed altre attività dilettantistiche di altre categorie inferiori con atleti oltre i 18 anni con custodia e pulizia",0,2),
("Allenamento Amatoriale (varie discipline) prima ora",0,1),
("Allenamento Amatoriale (varie discipline) ORE SUCCESSIVE",0,1),
("Singola GARA Amatoriale (varie discipline) compresa custodia e pulizia",0,2),
("Attività rivolte a persone a partire da 65 anni prima ora",0,4),
("Attività rivolte a persone a partire da 65 anni ORE SUCCESSIVE",0,4),
("Manifestazioni Sportive - a giornata + di 4 ore",0,3),
("Manifestazioni Sportive - a giornata fino a 4 ore",0,3),
("Manifestazioni Sportive GIOVANILI + di 4 ore",0,3),
("Manifestazioni Sportive GIOVANILI fino a 4 ore",0,3);


insert into tariffa(fk_attivita,prezzo) VALUES
(1,14.5),
(2,6.5),
(3,28.4),
(4,36.6),
(5,28.6),
(6,89.9),
(7,24.4),
(8,16.4),
(9,65.4),
(10,55.5),
(11,55.5),
(12,89.9),
(13,16.2),
(14,8.2),
(15,442.0),
(16,221.0),
(17,221.0),
(18,110.5);


insert into disciplina(nome) VALUES
("Ginnastica Ritmica/artistica"),
("Pallavolo"),
("Basket"),
("Futsal"),
("Arti Marziali"),
("Rugby"),
("Attività motoria"),
("Palla Tamburello"),
("Pallamano"),
("Atletica"),
("Scherma"),
("Tennis"),
("Pattinaggio"),
("Hockey"),
("Libero"),
("Zumba"),
("Ginnastica Posturale");

insert into referente(nome, cognome,telefono, cellulare	, email, pec) VALUES
("Marios"        , "Rossis"     , "+390000001", "0490000001", "marios.rossis@email.com", "marios.rossis@pec.com"),
("Carlos Andreas", "Passarinis" , "+390000002", "0490000002", "carlosandreas.passarinis@email.com", "carlosandreas.passarinis@pec.com"),
("Emmas"         , "Ottos"      , "+390000003", "0490000003", "emmas.ottos@email.com", "emmas.ottos@pec.com"),
("Elisabettas"   , "Scorccaross", "+390000004", "0490000004", "elisabettas.scroccaros@email.com", "elisabettas.scroccaros@pec.com"),
("Brunos"        , "Masis"      , "+390000005", "0490000005", "brunos.masis@email.com", "brunos.masis@pec.com"),
("Giorgios"      , "Parolais"   , "+390000006", "0490000006", "giorgio.parolais@email.com", "giorgios.parolais@pec.com"),
("Augustos"      , "Piccolins"  , "+390000007", "0490000007", "augustos.piccolins@email.com", "augustos.piccolins@pec.com");

insert into assoctipo (tipo) VALUES
("Scuola"),
("Ente comunale"),
("Ente fuori Padova"),
("Privato");


INSERT INTO tipopagamento (tipo) VALUES
("Bonifico"),
("Pagamento Elettronico"),
("Carta di Credito"),
("PayPal"),
("Assegno"),
("Contanti"),
("Apple Pay"),
("Rimessa Bancaria");




insert into ente (nome,pIva,codFisc,SDI,iban,telefono,cellulare,email,pec,via,ncivico,cap,citta, provincia,paese,fk_tipo,fk_tipoPagamento) VALUES
("ASSOCIAZIONE BLUKIPPE ASD","04760530289","92152840283","AAAAAAA","IT31Q0872862341000000015983","3392950217 ","+39 3393348195","infobk@blukippe.com","002208@pec.federginnastica.it","SOMEDA","9","35124","Padova","PD","IT",2,6),
("ASD PETRARCA BASKET","04979410281","04979410281","AAAAAAB","IT42P0335901600100000145990","0498809147","+39 3472437828","pataviumpetrarca@libero.it","asdpetrarcabasket@pec.it","VIA SCUOLE (DELLE)","5","35125","Padova","PD","IT",2,1),
("ASSOCIAZIONE OTTAVO GIORNO ONLUS","02706400286","02706400286","AAAAAAC","","0492613040","+39 ","ottavogiorno@gmail.com","ottavogiorno@pec.it","VIA VANZETTI TITO","5","35131","Padova","PD","IT",2,1),
("CENTRO UNIVERSITARIO SPORTIVO PADOVA - CUS","00893390286","80012840288","AAAAAAD","IT85E0200812100000102133613","049685222  ","+39","segreteria@cuspadova.it","cuspadova@pec.cuspadova.it","VIA G. BRUNO","27","35124","Padova","PD","IT",2,1);

insert into affiliazioneFamiglia(nome) VALUES
("Coni"),
("E.P.S.");

insert into affiliazione(nome,fk_famiglia) VALUES
("ACLI",2),
("LIB",2),
("UISP",2),
("AKS",2),
("ACSI",1),
("AICS",1),
("ASC",1),
("ASI",1),
("CNS LIBERTAS",1),
("CSAIN",1),
("CSEN",1),
("CSI",1),
("ENDAS",1),
("MSP",1),
("OPES",1),
("PGS",1),
("UISP",1),
("US ACLI",1);

insert into entiAffiliazioni(fk_ente,fk_affiliazione) VALUES
(1,1),
(2,5),
(3,7),
(4,10);









