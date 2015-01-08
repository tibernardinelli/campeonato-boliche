INSERT INTO `boliche2014`.`participants`
(`id`,
`cpf`,
`name`,
`telephone`,
`email`,
`department`,
`created`,
`modified`)
VALUES
(UUID(),
'12345678910',
'nome de teste',
'(11) 1234-56789 - 123',
'emailteste@teste.com.br',
'ti - sistemas',
current_timestamp(),
current_timestamp());
