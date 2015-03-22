CREATE TABLE Login(
  id SERIAL PRIMARY KEY,
  username varchar(50) NOT NULL,
  password varchar(50) NOT NULL
);

CREATE TABLE Clip(
  id SERIAL PRIMARY KEY,
  clipTitle varchar(100),
  game varchar(100),
  resolution varchar(12),
  fps integer,
  added DATE,
  description varchar(500)
);