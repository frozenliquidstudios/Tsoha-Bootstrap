--Login Testidata
INSERT INTO Login (username, password) VALUES ('Pekoni', 'Rapea'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Login (username, password) VALUES ('Rapea', 'Pekoni');
-- Testi klippi testidata
INSERT INTO Clip (clipTitle, game, resolution, fps, added, description) VALUES ('Smooth cinematic pan of the beach', 'Battlefield: Hardline', '1920 x 1080', '60', '22/03/2015', 'Smooth aerial show of the beachfront.', NOW());