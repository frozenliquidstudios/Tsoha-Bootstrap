--Login Testidata
INSERT INTO Login (username, password) VALUES ('pekoni', 'rapea'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Login (username, password) VALUES ('rapea', 'pekoni');
-- Testi klippi testidata
INSERT INTO Clip (title, game, resolution, fps, added, used, description) VALUES ('Smooth cinematic pan of the beach', 'Battlefield: Hardline', '1920x1080', '60', '22/03/2015', FALSE, 'Smooth aerial show of the beachfront.');