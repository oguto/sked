ALTER TABLE `PAGAMENTO_SERVICO` ADD `valor` FLOAT NULL AFTER `id_pagamento`;

ALTER TABLE `PAGAMENTO_SERVICO` ADD `desconto` INT NULL AFTER `id_pagamento`;

ALTER TABLE `PAGAMENTO_SERVICO` ADD `id_profissional` INT(11) NULL AFTER `id_servico`;
ALTER TABLE `AGENDA` ADD `status` VARCHAR(100) NULL AFTER `id_servico`;


ALTER TABLE USUARIO ADD grupo INT NULL;

ALTER TABLE COLABORADOR CHANGE senha id_usuario int NULL;
