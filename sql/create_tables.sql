CREATE TABLE Login(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
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