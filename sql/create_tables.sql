CREATE TABLE Kayttaja(
id SERIAL PRIMARY KEY,
nimi varchar(50) UNIQUE NOT NULL,
salasana varchar(50) UNIQUE NOT NULL,
oikeustaso integer NOT NULL CHECK(oikeustaso < 2)
);

CREATE TABLE Resepti(
id SERIAL PRIMARY KEY,
laatija integer REFERENCES Kayttaja(id),
nimi varchar(50) UNIQUE NOT NULL,
lisaysaika timestamp NOT NULL,
ohje varchar(1000),
lasi varchar(50),
valmistustapa varchar(50)
);

CREATE TABLE Ainesosa(
id SERIAL PRIMARY KEY,
nimi varchar(50) UNIQUE NOT NULL
);

CREATE TABLE ReseptiAines(
resepti_id integer REFERENCES Resepti(id),
ainesosa_id integer REFERENCES Ainesosa(id)
);
