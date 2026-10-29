CREATE TABLE `produtos` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `marca` varchar(255) NOT NULL,
  `categoria` varchar(255) NOT NULL,
  `preco_custo` decimal(10,2) NOT NULL,
  `preco_venda` decimal(10,2) NOT NULL,
  `qtd_disponivel` int(11) NOT NULL,
  `estoque_minimo` int(11) NOT NULL,
  `validade` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE `movimentacoes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `poduto_id` bigint(20) unsigned NOT NULL,
  `entrada` varchar(255) NOT NULL,
  `saida` varchar(255) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data` date NOT NULL,
  `funcionario` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
