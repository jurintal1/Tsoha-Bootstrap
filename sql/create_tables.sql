CREATE TABLE UserAccount(
id serial PRIMARY KEY,
name varchar(50) UNIQUE NOT NULL,
password varchar(50) UNIQUE NOT NULL,
role integer NOT NULL CHECK(role < 3),
active boolean DEFAULT false NOT NULL
);

CREATE TABLE Recipe(
id serial PRIMARY KEY,
author integer REFERENCES UserAccount(id),
name varchar(50) UNIQUE NOT NULL,
timeAdded timestamp NOT NULL,
instructions varchar(1000),
glass varchar(50),
method varchar(50)
);

CREATE TABLE Ingredient(
id serial PRIMARY KEY,
name varchar(50) UNIQUE NOT NULL
);

CREATE TABLE RecipeIngredient(
recipe_id integer REFERENCES Recipe(id) NOT NULL,
ingredient_id integer REFERENCES Ingredient(id) NOT NULL,
quantity varchar(50),
UNIQUE (recipe_id, ingredient_id)
);
