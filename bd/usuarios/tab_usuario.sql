-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.4.3 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando estrutura para tabela usuarios.tab_usuario
CREATE TABLE IF NOT EXISTS `tab_usuario` (
  `usu_codigo` int NOT NULL AUTO_INCREMENT,
  `per_codigo` int NOT NULL DEFAULT '0',
  `usu_nome` varchar(100) NOT NULL DEFAULT '0',
  `usu_senha` varchar(500) NOT NULL DEFAULT '0',
  `usu_login_acesso` varchar(15) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT '0',
  PRIMARY KEY (`usu_codigo`),
  KEY `per_codigo` (`per_codigo`),
  CONSTRAINT `per_codigo` FOREIGN KEY (`per_codigo`) REFERENCES `tab_perfil` (`per_codigo`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Copiando dados para a tabela usuarios.tab_usuario: ~1 rows (aproximadamente)
INSERT IGNORE INTO `tab_usuario` (`usu_codigo`, `per_codigo`, `usu_nome`, `usu_senha`, `usu_login_acesso`) VALUES
	(3, 11, 'Gabriel ', '123456', 'gabriel.pantene');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
