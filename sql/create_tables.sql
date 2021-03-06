CREATE TABLE Login(
  id SERIAL PRIMARY KEY,
  username varchar(32),
  password varchar(32)
);

CREATE TABLE Clip(
  id SERIAL PRIMARY KEY,
  login_id INTEGER REFERENCES Login(id),
  title varchar(100),
  game varchar(100),
  resolution varchar(12),
  fps varchar(3),
  added varchar(20),
  used boolean DEFAULT FALSE,
  description varchar(500)
);

CREATE TABLE Game(
  id SERIAL PRIMARY KEY,
  gamename varchar(100)
);