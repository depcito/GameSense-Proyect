-- MySQL dump 10.13  Distrib 8.4.3, for Win64 (x86_64)
--
-- Host: localhost    Database: gamesense
-- ------------------------------------------------------
-- Server version	8.0.45

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
INSERT INTO `cache` VALUES ('laravel-cache-gbrayan103@gmail.com|127.0.0.1','i:2;',1791951880),('laravel-cache-gbrayan103@gmail.com|127.0.0.1:timer','i:1791951880;',1791951880),('laravel-cache-noreply@gmail.com|127.0.0.1','i:1;',1791951912),('laravel-cache-noreply@gmail.com|127.0.0.1:timer','i:1791951912;',1791951912);
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,'Acci??n','Juegos centrados en el combate, los reflejos y los desaf??os f??sicos.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(2,'Aventura','Juegos enfocados en la exploraci??n, la narrativa y la resoluci??n de desaf??os.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(3,'Rol (RPG)','Juegos donde los personajes progresan mediante habilidades, misiones y decisiones.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(4,'Disparos','Juegos centrados en el uso de armas y el combate a distancia.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(5,'Estrategia','Juegos que requieren planificaci??n, gesti??n de recursos y toma de decisiones.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(6,'Deportes','Juegos que recrean deportes como f??tbol, baloncesto y tenis.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(7,'Carreras','Juegos de conducci??n y competici??n con veh??culos en distintos circuitos.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(8,'Terror','Juegos dise??ados para generar tensi??n y miedo mediante ambientes y situaciones peligrosas.','2026-10-14 05:00:58','2026-10-14 05:00:58'),(9,'Souls','Juego de tipo RPG y Acci??n reconocido por su alta dificultad','2026-10-14 11:04:29','2026-10-14 11:04:29'),(10,'Prueba 2','PRueba 2','2026-10-14 11:04:58','2026-10-14 11:04:58');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'0001_01_01_000000_create_users_table',1),(2,'0001_01_01_000001_create_cache_table',1),(3,'0001_01_01_000002_create_jobs_table',1),(4,'2026_10_10_190714_create_categories_table',1),(5,'2026_10_10_191524_create_products_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Grand Theft Auto V','Juego de acci??n y mundo abierto ambientado en Los Santos.',89900.00,15,'F??sico','Videojuego','PS5',1,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(2,'Marvel Spider-Man 2','Aventura de acci??n protagonizada por Peter Parker y Miles Morales.',189900.00,10,'F??sico','Videojuego','PS5',1,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(3,'God of War Ragnar??k','Aventura de acci??n mitol??gica protagonizada por Kratos y Atreus.',149900.00,12,'F??sico','Videojuego','PS5',1,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(4,'Devil May Cry 5','Combate de acci??n r??pida contra criaturas demon??acas.',79900.00,8,'F??sico','Videojuego','PS4',1,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(5,'The Legend of Zelda: Breath of the Wild','Explora Hyrule y resuelve desaf??os en un mundo abierto.',219900.00,7,'F??sico','Videojuego','Nintendo Switch',2,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(6,'Uncharted 4: A Thief\'s End','Aventura cinematogr??fica de exploraci??n y b??squeda de tesoros.',69900.00,10,'F??sico','Videojuego','PS4',2,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(7,'Red Dead Redemption 2','Aventura de mundo abierto ambientada en el lejano oeste.',99900.00,14,'F??sico','Videojuego','PS4',2,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(8,'Tomb Raider: Definitive Edition','Explora ruinas y sobrevive en una aventura protagonizada por Lara Croft.',59900.00,9,'F??sico','Videojuego','PS4',2,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(9,'The Witcher 3: Wild Hunt','Juego de rol de fantas??a con misiones y decisiones narrativas.',89900.00,11,'F??sico','Videojuego','PS5',3,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(10,'Elden Ring','Juego de rol y acci??n en un extenso mundo de fantas??a.',159900.00,8,'F??sico','Videojuego','PS5',3,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(11,'Final Fantasy VII Rebirth','Juego de rol japon??s con combates din??micos y una historia ??pica.',229900.00,6,'F??sico','Videojuego','PS5',3,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(12,'Baldur\'s Gate 3','Juego de rol basado en decisiones, exploraci??n y combates t??cticos.',179900.00,5,'Digital','Videojuego','PC',3,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(13,'Call of Duty: Black Ops 6','Juego de disparos en primera persona con campa??a y multijugador.',179900.00,10,'F??sico','Videojuego','PS5',4,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(14,'Battlefield 2042','Combate militar a gran escala con veh??culos y modos multijugador.',69900.00,8,'F??sico','Videojuego','PS5',4,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(15,'DOOM Eternal','Disparos fren??ticos contra hordas de demonios.',79900.00,9,'F??sico','Videojuego','PS4',4,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(16,'Halo Infinite','Shooter de ciencia ficci??n con campa??a y combates multijugador.',99900.00,7,'Digital','Videojuego','Xbox Series X',4,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(17,'Civilization VI','Construye una civilizaci??n y compite por el dominio mundial.',79900.00,6,'Digital','Videojuego','PC',5,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(18,'Age of Empires IV','Estrategia en tiempo real basada en civilizaciones hist??ricas.',119900.00,7,'Digital','Videojuego','PC',5,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(19,'StarCraft II','Estrategia de ciencia ficci??n con gesti??n de recursos y ej??rcitos.',59900.00,8,'Digital','Videojuego','PC',5,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(20,'XCOM 2','Lidera una resistencia humana mediante combates t??cticos por turnos.',69900.00,5,'Digital','Videojuego','PC',5,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(21,'EA Sports FC 26','Simulaci??n de f??tbol con clubes, ligas y competiciones.',249900.00,15,'F??sico','Videojuego','PS5',6,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(22,'NBA 2K26','Baloncesto con equipos, jugadores y modos competitivos.',229900.00,8,'F??sico','Videojuego','PS5',6,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(23,'F1 25','Simulaci??n de F??rmula 1 con pilotos, circuitos y campeonatos.',199900.00,7,'F??sico','Videojuego','PS5',6,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(24,'Tony Hawk\'s Pro Skater 1 + 2','Juego de skate con trucos, desaf??os y pistas cl??sicas.',99900.00,6,'F??sico','Videojuego','PS4',6,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(25,'Forza Horizon 5','Carreras de mundo abierto por paisajes inspirados en M??xico.',149900.00,10,'Digital','Videojuego','Xbox Series X',7,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(26,'Gran Turismo 7','Simulador de conducci??n con autom??viles y circuitos reales.',169900.00,8,'F??sico','Videojuego','PS5',7,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(27,'Need for Speed Unbound','Carreras callejeras con personalizaci??n de veh??culos.',99900.00,7,'F??sico','Videojuego','PS5',7,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(28,'Mario Kart 8 Deluxe','Carreras arcade con personajes y circuitos del universo Mario.',219900.00,9,'F??sico','Videojuego','Nintendo Switch',7,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(29,'Resident Evil 4','Survival horror con exploraci??n, recursos limitados y combates.',139900.00,8,'F??sico','Videojuego','PS5',8,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(30,'Silent Hill 2','Terror psicol??gico centrado en la exploraci??n y el misterio.',159900.00,5,'F??sico','Videojuego','PS5',8,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(31,'Dead Space','Terror de ciencia ficci??n a bordo de una nave espacial abandonada.',129900.00,6,'F??sico','Videojuego','PS5',8,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(32,'Outlast','Juego de terror y supervivencia dentro de un centro psiqui??trico.',49900.00,7,'Digital','Videojuego','PC',8,'2026-10-14 05:02:53','2026-10-14 05:02:53'),(33,'Producto Prueba','Es un producto de prueba',200000.00,1,'Digital','Tarjeta de saldo','Nintendo Switch',6,'2026-10-15 02:07:42','2026-10-15 02:07:42');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('0REzW65m7EW4fQoso1r5i9eseaHZS7aINDqMH2oj',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.145.2 Chrome/150.0.7871.250 Electron/43.8.3 Safari/537.36','YTozOntzOjY6Il90b2tlbiI7czo0MDoiTDQ1OUF5QXM4VGFDS3h5S2hMbzc2bkpKRmVVWlh4WUUwcDVVTTRvSiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiaG9tZS5pbmRleCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=',1793983494),('AJW0EwzZtCpWfwI1i2x3M60calRdgPNEg9zPxupo',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiak9OT0lpR2hoUDdDMFRGTVJzZmE0dkFCckl3OExmc25RSEc3VFlBayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTQ6InByb2R1Y3QuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3OTIwMjA4NjY7fX0=',1792021086),('rUjd9pwBAeISvGChNoKUnPDr8vR39LGv5Yi2kAs4',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoid2RwUGhSbEdCbHY3S0thRUtPUnJlbEhCNUdZVnBNQ21BbHRIeGZ4ZSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjEzOiJwcm9kdWN0LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==',1792030070),('ry8R9rKrsu2jsDn1X1jxVOufqC4v9hOAZyLH22z6',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoieE1xQmZsMHNod0hvR2dxUzFqQ1V0R0xTaEcxdkxuRWNDUVoxS1FSYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNToiY2F0ZWdvcnkuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3OTE5NTIwNzk7fX0=',1791954761),('V4ru1X8j42BsvPYPiE3EqpebkLOKjt2U3uoUrwBq',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ2RNdHQwQXZxcE81UUNRbHpGeFVWUXZhVFJ0MzBwTkVuME9mMndsOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTQ6InByb2R1Y3QuY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3OTE5ODcxNzE7fX0=',1791989302),('Wwybhn4Fpovd5MBaoHiQiYZTXPtjwjMRlIdDBGLh',1,'127.0.0.1','Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQkRFVmFlWm5CM1I5dHluVGVIcGo2R2VmSEhKNGdMWDBrbm52eU91dCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3RzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdC5jcmVhdGUiO319',1791979178);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Brayan Santiago Gonzalez Mateus','admin@gmail.com','admin',NULL,'$2y$12$yLdSvrbo9SDvXuodR4udieKDTaBLOv8.mUDo.2DiWfc.WUJAZxOW.',NULL,'xrRJJJbIriUPTt3d7eGH8oZRVsa5C3mkdCVDoazFw2HedYqbydJHMO66RdKn','2026-10-13 18:43:06','2026-10-13 18:43:06'),(2,'Nando','noreply@gmail.com','user',NULL,'$2y$12$PSBA565tsqj/COmVgDCoGOYSpQtr6YLox/ssk7SD/bwW7ul89z0Dq',NULL,NULL,'2026-10-14 14:12:26','2026-10-14 14:12:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-06 11:48:04
