INSERT INTO Kayttaja (nimi, salasana, oikeustaso) VALUES ('Jussi', 'kaakkuri', '0');
INSERT INTO Resepti (laatija, nimi, lisaysaika) 
	VALUES ((SELECT id FROM Kayttaja WHERE nimi = 'Jussi'), 'Pelkkä piimä', now());
INSERT INTO Ainesosa (nimi)  VALUES ('piimä');
INSERT INTO ReseptiAines (resepti_id, ainesosa_id)
	VALUES ((SELECT id FROM Resepti WHERE nimi = 'Pelkkä piimä'),
			(SELECT id FROM Ainesosa WHERE nimi = 'piimä'));