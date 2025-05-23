/*
CSV format:
group,name,calories,protein,carb,fiber,Ferro(mg),sodium
Cereais e derivados,"Arroz, integral, cozido","123,53","2,59","25,81","2,75","0,26","1,24"

output:
INSERT INTO `dietacerta`.food (group, name, user_id, calories, prot, carb, , unit)
VALUES ('Cereais e Derivados', 'Arroz integral cozido', )

*/
