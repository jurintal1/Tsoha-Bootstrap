INSERT INTO UserAccount (name, password, role) VALUES ('Jussi', 'kaakkuri', 1);
INSERT INTO UserAccount (name, password, role, active) VALUES ('Sirpa', 'laama', 2, true);
INSERT INTO UserAccount (name, password, role, active) VALUES ('Sorsa', 'hanhi', 1, true);
INSERT INTO UserAccount (name, password, role, active) VALUES ('Tero', 'Helsinki1977', 	1, false);

INSERT INTO Recipe (author, name, timeAdded) 
	VALUES ((SELECT id FROM UserAccount WHERE name = 'Jussi'), 'Pelkkä piimä', now());
INSERT INTO Recipe (author, name, timeAdded) 
	VALUES ((SELECT id FROM UserAccount WHERE name = 'Sirpa'), 'Margarita', now());
INSERT INTO Recipe (author, name, timeAdded, glass, method, instructions) 
	VALUES ((SELECT id FROM UserAccount WHERE name = 'Sorsa'), 'Whisky Sour', now(),
	 'On the rocks', 'ravistettu',
	 'Kaada ainekset jääpaloilla täytettyyn ravistimeen. Ravista voimakkaasti. 
	 Kaada On the Rocks tai sour -lasiin.Koristele appelsiiniviipaleella
	 ja maraschinokirsikalla.');


INSERT INTO Ingredient (name)  VALUES ('ruisviski');
INSERT INTO Ingredient (name)  VALUES ('sitruunamehu');
INSERT INTO Ingredient (name)  VALUES ('piimä');
INSERT INTO Ingredient (name)  VALUES ('appelsiini');
INSERT INTO Ingredient (name)  VALUES ('cocktailkirsikka');
INSERT INTO Ingredient (name)  VALUES ('sokerisiirappi');


INSERT INTO RecipeIngredient (recipe_id, ingredient_id)
	VALUES ((SELECT id FROM Recipe WHERE name = 'Pelkkä piimä'),
			(SELECT id FROM Ingredient WHERE name = 'piimä'));
INSERT INTO RecipeIngredient (recipe_id, ingredient_id, quantity)
	VALUES ((SELECT id FROM Recipe WHERE name = 'Whisky Sour'),
			(SELECT id FROM Ingredient WHERE name = 'ruisviski'),
			'4,5 cl');
INSERT INTO RecipeIngredient (recipe_id, ingredient_id, quantity)
	VALUES ((SELECT id FROM Recipe WHERE name = 'Whisky Sour'),
			(SELECT id FROM Ingredient WHERE name = 'sitruunamehu'),
			' cl');
INSERT INTO RecipeIngredient (recipe_id, ingredient_id, quantity)
	VALUES ((SELECT id FROM Recipe WHERE name = 'Whisky Sour'),
			(SELECT id FROM Ingredient WHERE name = 'sokerisiirappi'),
			'1 cl');
INSERT INTO RecipeIngredient (recipe_id, ingredient_id)
	VALUES ((SELECT id FROM Recipe WHERE name = 'Whisky Sour'),
			(SELECT id FROM Ingredient WHERE name = 'appelsiini'));
INSERT INTO RecipeIngredient (recipe_id, ingredient_id)
	VALUES ((SELECT id FROM Recipe WHERE name = 'Whisky Sour'),
			(SELECT id FROM Ingredient WHERE name = 'cocktailkirsikka'));
