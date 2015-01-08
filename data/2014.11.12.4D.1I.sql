INSERT INTO participants (`id`, `cpf`, `name`, `telephone`, `email`, `department`, `created`, `modified`) 
VALUES (UUID(), '06983679873', 'GIULIANO CIDIN AMENDOLA SPERIDIAO', '', 'giulius.spiridion@crazylady.com.br', 'Comunicação',
		current_timestamp(), current_timestamp());

delete from participants where cpf = 41882505802 and id is not null; # Camila Garcias da Silva
delete from participants where cpf = 39527509807 and id is not null; # Carlos Yudi Hayashi 
delete from participants where cpf = 34285292866 and id is not null; # Cláudia Letícia Vendrame Santos
delete from participants where cpf = 24674881870 and id is not null; # Edson Yoshiki Maeda