-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para admin_atelie
CREATE DATABASE IF NOT EXISTS `admin_atelie` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `admin_atelie`;

-- Copiando estrutura para tabela admin_atelie.categorias
CREATE TABLE IF NOT EXISTS `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela admin_atelie.categorias: ~4 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `categoria`, `data_criacao`) VALUES
	(1, 'Sublimação', '2023-11-29 14:17:42'),
	(2, 'Costura', '2023-11-29 14:17:47'),
	(3, 'Papelaria', '2023-11-02 16:50:10'),
	(4, 'Camiseta', '2023-11-29 14:18:12');

-- Copiando estrutura para tabela admin_atelie.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `profissao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `compras` int DEFAULT NULL,
  `ultima_compra` datetime DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela admin_atelie.clientes: ~3 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `nome`, `telefone`, `email`, `profissao`, `data_nascimento`, `compras`, `ultima_compra`, `data_cadastro`) VALUES
	(6, 'Diogo Anderle', '(47) 98806-8739', 'anderle88@gmail.com', 'Analista de Sistema', '1988-11-11', 8, '2024-03-04 14:55:28', '2024-02-20 17:21:51'),
	(7, 'Patrícia de Souza Costa', '(47) 98909-0879', '4denosatelie@gmail.com', 'Empreendedora', '1985-10-07', 80, '2024-03-08 10:33:58', '2024-02-27 20:41:17'),
	(13, 'Diogo Anderle', '(47) 98806-8739', 'anderle88@gmail.com', 'Atendimento', '2011-01-01', 37, '2024-03-05 17:33:56', '2024-03-01 18:14:59'),
	(14, 'Sarah Anderle', '', '', 'Estudante', '2017-12-13', NULL, NULL, '2024-03-08 13:42:54');

-- Copiando estrutura para tabela admin_atelie.produtos
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria_id` int NOT NULL,
  `codigo` varchar(50) NOT NULL DEFAULT '0',
  `descricao` text NOT NULL,
  `imagem` varchar(255) NOT NULL DEFAULT '',
  `estoque` int NOT NULL DEFAULT '0',
  `preco_compra` float NOT NULL DEFAULT '0',
  `preco_venda` float NOT NULL DEFAULT '0',
  `vendas` int NOT NULL DEFAULT '0',
  `data_inclusao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_produtos_categorias` (`categoria_id`),
  CONSTRAINT `FK_produtos_categorias` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela admin_atelie.produtos: ~15 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `categoria_id`, `codigo`, `descricao`, `imagem`, `estoque`, `preco_compra`, `preco_venda`, `vendas`, `data_inclusao`) VALUES
	(4, 1, '104', 'Caneca personalizada alça e interior azul 325ml', 'views/img/produtos/product-default.png', 20, 19, 65, 0, '2023-11-29 14:46:08'),
	(5, 1, '105', 'Caneca personalizada alça e interior preto 325ml', 'views/img/produtos/product-default.png', 17, 14.5, 60, 14, '2023-11-29 14:46:08'),
	(6, 1, '106', 'Caneca personalizada alça coração alça e interior rosa 325ml', 'views/img/produtos/product-default.png', 9, 14.5, 60, 11, '2023-11-29 14:46:08'),
	(7, 1, '107', 'Caneca personalizada alça coração alça e interior azul 325ml', 'views/img/produtos/product-default.png', 7, 14.5, 60, 13, '2023-11-29 14:46:08'),
	(8, 1, '108', 'Caneca personalizada alça coração alça e interior vermelho 325ml', 'views/img/produtos/product-default.png', 5, 14.5, 60, 15, '2023-11-29 14:46:08'),
	(9, 1, '109', 'Caneca personalizada alça coração alça e interior preto 325ml', 'views/img/produtos/product-default.png', 20, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(10, 2, '201', 'Necessaire personalizada P', 'views/img/produtos/product-default.png', 25, 12.5, 25, 20, '2023-11-29 14:46:08'),
	(11, 2, '202', 'Necessaire personalizada M', 'views/img/produtos/product-default.png', 20, 12.5, 35, 0, '2023-11-29 14:46:08'),
	(12, 2, '203', 'Necessaire personalizada G', 'views/img/produtos/product-default.png', 20, 12.5, 55, 0, '2023-11-29 14:46:08'),
	(13, 2, '204', 'Estojo box personalizado', 'views/img/produtos/product-default.png', 20, 12.5, 56, 0, '2023-11-29 14:46:08'),
	(14, 2, '205', 'Niqueleira personalizada', 'views/img/produtos/product-default.png', 20, 6, 20, 0, '2023-11-29 14:46:08'),
	(15, 4, '401', 'Camiseta Sublimada', 'views/img/produtos/product-default.png', 20, 20, 30, 0, '2023-11-30 17:36:23'),
	(16, 3, '301', 'card personalizado com brincos', 'views/img/produtos/product-default.png', 20, 22, 33, 0, '2023-11-30 17:50:08'),
	(17, 1, '110', 'Canequinha', 'views/img/produtos/product-default.png', 20, 5.99, 8.985, 0, '2023-11-30 18:07:48'),
	(22, 1, '111', 'sadadasd', 'views/img/produtos/product-default.png', 20, 87, 130.5, 0, '2023-12-04 12:06:52'),
	(23, 2, '206', 'Kit Necessaire personalizada', 'views/img/produtos/product-default.png', 15, 25, 95, 52, '2024-02-28 14:22:11');

-- Copiando estrutura para tabela admin_atelie.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `perfil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL,
  `ultimo_login` datetime DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela admin_atelie.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `perfil`, `imagem`, `estado`, `ultimo_login`, `data_criacao`) VALUES
	(23, 'Diogo', 'diogo', '$6$rounds=1000000$NJy4rIPjpOaU$SUEOrxpTTdcbBG9k4o444Oo4H/jDQA.wEfjQPZjjnz07Xpc80QXyg13QeEL/WzDXBVs7qAmXE8VKB9XQqksuG0', 'Administrador', 'views/img/usuarios/diogo/diogo.jpg', 1, '2024-03-08 14:03:13', '2024-03-08 17:54:13'),
	(29, 'Administrador', 'admin', '$6$rounds=1000000$NJy4rIPjpOaU$t40eaN0arWWsBa5GnafOyvwneVuSYKTdA5861K5UoJBT49NZ6HLVMWJNSDRi8w3Z6P0DDAZIf9QaCkjHHzi64.', 'Administrador', 'views/img/usuarios/admin/admin.png', 1, '2024-03-08 14:03:10', '2024-03-08 17:30:10'),
	(37, 'Teste', 'teste', '$6$rounds=1000000$NJy4rIPjpOaU$JcS3.VANxmBTz.M8w7EbbG9EYqP0rmLUtuBKazFGgDPEdv9Ma4N.N4Noeiatg3TjosEH20ndjobE9AK5jckcg.', 'Especial', 'views/img/usuarios/teste/teste.jpg', 1, '2024-03-08 14:03:13', '2024-03-08 17:51:13');

-- Copiando estrutura para tabela admin_atelie.vendas
CREATE TABLE IF NOT EXISTS `vendas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `codigo` int NOT NULL,
  `cliente_id` int NOT NULL,
  `vendedor_id` int NOT NULL,
  `produtos` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `acrescimo` float NOT NULL,
  `subtotal` float NOT NULL,
  `total` float NOT NULL,
  `data_venda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `FK_vendas_clientes` (`cliente_id`),
  KEY `FK_vendas_usuarios` (`vendedor_id`),
  CONSTRAINT `FK_vendas_clientes` FOREIGN KEY (`cliente_id`) REFERENCES `clientes` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `FK_vendas_usuarios` FOREIGN KEY (`vendedor_id`) REFERENCES `usuarios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci ROW_FORMAT=DYNAMIC;

-- Copiando dados para a tabela admin_atelie.vendas: ~5 rows (aproximadamente)
INSERT INTO `vendas` (`id`, `codigo`, `cliente_id`, `vendedor_id`, `produtos`, `acrescimo`, `subtotal`, `total`, `data_venda`) VALUES
	(28, 10002, 6, 23, '[{"id":"5","descricao":"Caneca personalizada alça e interior preto 325ml","quantidade":"8","estoque":"17","preco":"60","total":"480.00"}]', 0, 480, 480, '2024-02-28 14:11:03'),
	(29, 10003, 7, 23, '[{"id":"6","descricao":"Caneca personalizada alça coração alça e interior rosa 325ml","quantidade":"2","estoque":"18","preco":"60","total":"120.00"},{"id":"5","descricao":"Caneca personalizada alça e interior preto 325ml","quantidade":"6","estoque":"9","preco":"60.00","total":"360.00"}]', 48, 480, 528, '2024-02-28 14:16:43'),
	(31, 10004, 13, 23, '[{"id":"7","descricao":"Caneca personalizada alça coração alça e interior azul 325ml","quantidade":"10","estoque":"10","preco":"60","total":"600.00"},{"id":"8","descricao":"Caneca personalizada alça coração alça e interior vermelho 325ml","quantidade":"15","estoque":"5","preco":"60","total":"900.00"},{"id":"6","descricao":"Caneca personalizada alça coração alça e interior rosa 325ml","quantidade":"9","estoque":"9","preco":"60.00","total":"540.00"}]', 265.2, 2040, 2305.2, '2024-03-01 19:07:25'),
	(32, 10005, 13, 23, '[{"id":"7","descricao":"Caneca personalizada alça coração alça e interior azul 325ml","quantidade":"3","estoque":"7","preco":"60.00","total":"180.00"}]', 0, 180, 180, '2024-03-05 20:33:56'),
	(33, 10006, 7, 23, '[{"id":"23","descricao":"Required","quantidade":"6","estoque":"46","preco":"95.00","total":"570.00"}]', 0, 570, 570, '2024-03-06 18:10:00'),
	(34, 10007, 7, 23, '[{"id":"10","descricao":"Necessaire personalizada P","quantidade":"20","estoque":"0","preco":"25.00","total":"500.00"}]', 0, 500, 500, '2024-03-06 18:10:43'),
	(35, 10008, 7, 29, '[{"id":"23","descricao":"Kit Necessaire personalizada","quantidade":"46","estoque":"0","preco":"95.00","total":"4370.00"}]', 0, 4370, 4370, '2024-03-08 13:33:58');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
