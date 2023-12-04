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

-- Copiando dados para a tabela admin_atelie.categorias: ~5 rows (aproximadamente)
INSERT INTO `categorias` (`id`, `categoria`, `data_criacao`) VALUES
	(1, 'Sublimação', '2023-11-29 14:17:42'),
	(2, 'Costura', '2023-11-29 14:17:47'),
	(3, 'Papelaria', '2023-11-02 16:50:10'),
	(4, 'Camiseta', '2023-11-29 14:18:12'),
	(5, 'Nova Categoria', '2023-11-30 13:22:57');

-- Copiando estrutura para tabela admin_atelie.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT '0',
  `telefone` varchar(20) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `profissao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `compras` int DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela admin_atelie.clientes: ~2 rows (aproximadamente)
INSERT INTO `clientes` (`id`, `nome`, `telefone`, `email`, `profissao`, `data_nascimento`, `compras`, `data_cadastro`) VALUES
	(1, 'Diogo', '(47) 999999-9999', 'teste@teste.com', 'Teste Teste', '1988-11-11', NULL, '2023-12-01 19:03:39'),
	(3, 'Patricia de Souza Costa', '(47) 98806-8739', '4denosatelie@gmail.com', 'Empreendedora', '1985-10-07', NULL, '2023-12-01 20:15:58');

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela admin_atelie.produtos: ~14 rows (aproximadamente)
INSERT INTO `produtos` (`id`, `categoria_id`, `codigo`, `descricao`, `imagem`, `estoque`, `preco_compra`, `preco_venda`, `vendas`, `data_inclusao`) VALUES
	(1, 1, '101', 'Caneca personalizada branca 325ml', 'views/img/produtos/101/896.jpg', 12, 20, 30, 0, '2023-11-29 14:46:08'),
	(2, 1, '102', 'Caneca personalizada alça e interior rosa 325ml', 'views/img/produtos/102/269.png', 17, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(3, 1, '103', 'Caneca personalizada alça e interior vermelho 325ml', 'views/img/produtos/product-default.png', 15, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(4, 1, '104', 'Caneca personalizada alça e interior azul 325ml', 'views/img/produtos/product-default.png', 19, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(5, 1, '105', 'Caneca personalizada alça e interior preto 325ml', 'views/img/produtos/product-default.png', 4, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(6, 1, '106', 'Caneca personalizada alça coração alça e interior rosa 325ml', 'views/img/produtos/product-default.png', 10, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(7, 1, '107', 'Caneca personalizada alça coração alça e interior azul 325ml', 'views/img/produtos/product-default.png', 12, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(8, 1, '108', 'Caneca personalizada alça coração alça e interior vermelho 325ml', 'views/img/produtos/product-default.png', 10, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(9, 1, '109', 'Caneca personalizada alça coração alça e interior preto 325ml', 'views/img/produtos/product-default.png', 10, 14.5, 60, 0, '2023-11-29 14:46:08'),
	(10, 2, '201', 'Necessaire personalizada P', 'views/img/produtos/product-default.png', 32, 12.5, 25, 0, '2023-11-29 14:46:08'),
	(11, 2, '202', 'Necessaire personalizada M', 'views/img/produtos/product-default.png', 2, 12.5, 35, 0, '2023-11-29 14:46:08'),
	(12, 2, '203', 'Necessaire personalizada G', 'views/img/produtos/product-default.png', 20, 12.5, 55, 0, '2023-11-29 14:46:08'),
	(13, 2, '204', 'Estojo box personalizado', 'views/img/produtos/product-default.png', 2, 12.5, 56, 0, '2023-11-29 14:46:08'),
	(14, 2, '205', 'Niqueleira personalizada', 'views/img/produtos/product-default.png', 2, 6, 20, 0, '2023-11-29 14:46:08'),
	(15, 4, '401', 'Camiseta Sublimada', 'views/img/produtos/product-default.png', 20, 20, 30, 0, '2023-11-30 17:36:23'),
	(16, 3, '301', 'card personalizado com brincos', 'views/img/produtos/product-default.png', 45, 22, 33, 0, '2023-11-30 17:50:08'),
	(17, 1, '110', 'Canequinha', 'views/img/produtos/product-default.png', 30, 5.99, 8.985, 0, '2023-11-30 18:07:48');

-- Copiando estrutura para tabela admin_atelie.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `usuario` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `senha` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `perfil` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `estado` int NOT NULL,
  `ultimo_login` datetime NOT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Copiando dados para a tabela admin_atelie.usuarios: ~3 rows (aproximadamente)
INSERT INTO `usuarios` (`id`, `nome`, `usuario`, `senha`, `perfil`, `imagem`, `estado`, `ultimo_login`, `data_criacao`) VALUES
	(23, 'Diogo Anderle', 'diogo', '$6$rounds=1000000$NJy4rIPjpOaU$SUEOrxpTTdcbBG9k4o444Oo4H/jDQA.wEfjQPZjjnz07Xpc80QXyg13QeEL/WzDXBVs7qAmXE8VKB9XQqksuG0', 'Especial', 'views/img/usuarios/diogo/135.png', 1, '2023-12-01 08:12:03', '2023-12-01 11:49:03'),
	(28, 'Patrícia de Souza Costa', 'paty', '$6$rounds=1000000$NJy4rIPjpOaU$E2jzkjEo/ve7rrLzMGjlcr2cJZTVaoBmo1LMHAEJnYTkTx8gex/83i32uXO806WxrKjrDuc/jU6yMO8MUfa0L.', 'Administrador', 'views/img/usuarios/paty/486.png', 1, '2023-11-28 20:11:25', '2023-11-28 23:59:25'),
	(29, 'Administrador', 'admin', '$6$rounds=1000000$NJy4rIPjpOaU$grnoQ/Mmis3Scnel4pP7Qoa6s7Nv8UX9HnqR1UaFUGsBG1WY2fEt.cFec/z6NKCrTaymn5CQcS5JfVubfV1tT0', 'Administrador', 'views/img/usuarios/admin/626.jpg', 1, '2023-11-02 11:11:00', '2023-11-02 14:44:00');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
