-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 15, 2026 at 02:10 AM
-- Server version: 8.4.10
-- PHP Version: 8.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gamesense`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel-cache-gbrayan103@gmail.com|127.0.0.1', 'i:2;', 1791951880),
('laravel-cache-gbrayan103@gmail.com|127.0.0.1:timer', 'i:1791951880;', 1791951880),
('laravel-cache-noreply@gmail.com|127.0.0.1', 'i:1;', 1791951912),
('laravel-cache-noreply@gmail.com|127.0.0.1:timer', 'i:1791951912;', 1791951912);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Acción', 'Juegos centrados en el combate, los reflejos y los desafíos físicos.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(2, 'Aventura', 'Juegos enfocados en la exploración, la narrativa y la resolución de desafíos.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(3, 'Rol (RPG)', 'Juegos donde los personajes progresan mediante habilidades, misiones y decisiones.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(4, 'Disparos', 'Juegos centrados en el uso de armas y el combate a distancia.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(5, 'Estrategia', 'Juegos que requieren planificación, gestión de recursos y toma de decisiones.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(6, 'Deportes', 'Juegos que recrean deportes como fútbol, baloncesto y tenis.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(7, 'Carreras', 'Juegos de conducción y competición con vehículos en distintos circuitos.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(8, 'Terror', 'Juegos diseñados para generar tensión y miedo mediante ambientes y situaciones peligrosas.', '2026-10-14 05:00:58', '2026-10-14 05:00:58'),
(9, 'Souls', 'Juego de tipo RPG y Acción reconocido por su alta dificultad', '2026-10-14 11:04:29', '2026-10-14 11:04:29'),
(10, 'Prueba 2', 'PRueba 2', '2026-10-14 11:04:58', '2026-10-14 11:04:58');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_10_10_190714_create_categories_table', 1),
(5, '2026_10_10_191524_create_products_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `stock`, `format`, `type`, `platform`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Grand Theft Auto V', 'Juego de acción y mundo abierto ambientado en Los Santos.', 89900.00, 15, 'Físico', 'Videojuego', 'PS5', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(2, 'Marvel Spider-Man 2', 'Aventura de acción protagonizada por Peter Parker y Miles Morales.', 189900.00, 10, 'Físico', 'Videojuego', 'PS5', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(3, 'God of War Ragnarök', 'Aventura de acción mitológica protagonizada por Kratos y Atreus.', 149900.00, 12, 'Físico', 'Videojuego', 'PS5', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(4, 'Devil May Cry 5', 'Combate de acción rápida contra criaturas demoníacas.', 79900.00, 8, 'Físico', 'Videojuego', 'PS4', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(5, 'The Legend of Zelda: Breath of the Wild', 'Explora Hyrule y resuelve desafíos en un mundo abierto.', 219900.00, 7, 'Físico', 'Videojuego', 'Nintendo Switch', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(6, 'Uncharted 4: A Thief\'s End', 'Aventura cinematográfica de exploración y búsqueda de tesoros.', 69900.00, 10, 'Físico', 'Videojuego', 'PS4', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(7, 'Red Dead Redemption 2', 'Aventura de mundo abierto ambientada en el lejano oeste.', 99900.00, 14, 'Físico', 'Videojuego', 'PS4', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(8, 'Tomb Raider: Definitive Edition', 'Explora ruinas y sobrevive en una aventura protagonizada por Lara Croft.', 59900.00, 9, 'Físico', 'Videojuego', 'PS4', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(9, 'The Witcher 3: Wild Hunt', 'Juego de rol de fantasía con misiones y decisiones narrativas.', 89900.00, 11, 'Físico', 'Videojuego', 'PS5', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(10, 'Elden Ring', 'Juego de rol y acción en un extenso mundo de fantasía.', 159900.00, 8, 'Físico', 'Videojuego', 'PS5', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(11, 'Final Fantasy VII Rebirth', 'Juego de rol japonés con combates dinámicos y una historia épica.', 229900.00, 6, 'Físico', 'Videojuego', 'PS5', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(12, 'Baldur\'s Gate 3', 'Juego de rol basado en decisiones, exploración y combates tácticos.', 179900.00, 5, 'Digital', 'Videojuego', 'PC', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(13, 'Call of Duty: Black Ops 6', 'Juego de disparos en primera persona con campaña y multijugador.', 179900.00, 10, 'Físico', 'Videojuego', 'PS5', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(14, 'Battlefield 2042', 'Combate militar a gran escala con vehículos y modos multijugador.', 69900.00, 8, 'Físico', 'Videojuego', 'PS5', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(15, 'DOOM Eternal', 'Disparos frenéticos contra hordas de demonios.', 79900.00, 9, 'Físico', 'Videojuego', 'PS4', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(16, 'Halo Infinite', 'Shooter de ciencia ficción con campaña y combates multijugador.', 99900.00, 7, 'Digital', 'Videojuego', 'Xbox Series X', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(17, 'Civilization VI', 'Construye una civilización y compite por el dominio mundial.', 79900.00, 6, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(18, 'Age of Empires IV', 'Estrategia en tiempo real basada en civilizaciones históricas.', 119900.00, 7, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(19, 'StarCraft II', 'Estrategia de ciencia ficción con gestión de recursos y ejércitos.', 59900.00, 8, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(20, 'XCOM 2', 'Lidera una resistencia humana mediante combates tácticos por turnos.', 69900.00, 5, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(21, 'EA Sports FC 26', 'Simulación de fútbol con clubes, ligas y competiciones.', 249900.00, 15, 'Físico', 'Videojuego', 'PS5', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(22, 'NBA 2K26', 'Baloncesto con equipos, jugadores y modos competitivos.', 229900.00, 8, 'Físico', 'Videojuego', 'PS5', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(23, 'F1 25', 'Simulación de Fórmula 1 con pilotos, circuitos y campeonatos.', 199900.00, 7, 'Físico', 'Videojuego', 'PS5', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(24, 'Tony Hawk\'s Pro Skater 1 + 2', 'Juego de skate con trucos, desafíos y pistas clásicas.', 99900.00, 6, 'Físico', 'Videojuego', 'PS4', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(25, 'Forza Horizon 5', 'Carreras de mundo abierto por paisajes inspirados en México.', 149900.00, 10, 'Digital', 'Videojuego', 'Xbox Series X', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(26, 'Gran Turismo 7', 'Simulador de conducción con automóviles y circuitos reales.', 169900.00, 8, 'Físico', 'Videojuego', 'PS5', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(27, 'Need for Speed Unbound', 'Carreras callejeras con personalización de vehículos.', 99900.00, 7, 'Físico', 'Videojuego', 'PS5', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(28, 'Mario Kart 8 Deluxe', 'Carreras arcade con personajes y circuitos del universo Mario.', 219900.00, 9, 'Físico', 'Videojuego', 'Nintendo Switch', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(29, 'Resident Evil 4', 'Survival horror con exploración, recursos limitados y combates.', 139900.00, 8, 'Físico', 'Videojuego', 'PS5', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(30, 'Silent Hill 2', 'Terror psicológico centrado en la exploración y el misterio.', 159900.00, 5, 'Físico', 'Videojuego', 'PS5', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(31, 'Dead Space', 'Terror de ciencia ficción a bordo de una nave espacial abandonada.', 129900.00, 6, 'Físico', 'Videojuego', 'PS5', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(32, 'Outlast', 'Juego de terror y supervivencia dentro de un centro psiquiátrico.', 49900.00, 7, 'Digital', 'Videojuego', 'PC', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53'),
(33, 'Producto Prueba', 'Es un producto de prueba', 200000.00, 1, 'Digital', 'Tarjeta de saldo', 'Nintendo Switch', 6, '2026-10-15 02:07:42', '2026-10-15 02:07:42');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('AJW0EwzZtCpWfwI1i2x3M60calRdgPNEg9zPxupo', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiak9OT0lpR2hoUDdDMFRGTVJzZmE0dkFCckl3OExmc25RSEc3VFlBayI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTQ6InByb2R1Y3QuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3OTIwMjA4NjY7fX0=', 1792021086),
('rUjd9pwBAeISvGChNoKUnPDr8vR39LGv5Yi2kAs4', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoid2RwUGhSbEdCbHY3S0thRUtPUnJlbEhCNUdZVnBNQ21BbHRIeGZ4ZSI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozMDoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3RzIjtzOjU6InJvdXRlIjtzOjEzOiJwcm9kdWN0LmluZGV4Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1792030070),
('ry8R9rKrsu2jsDn1X1jxVOufqC4v9hOAZyLH22z6', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoieE1xQmZsMHNod0hvR2dxUzFqQ1V0R0xTaEcxdkxuRWNDUVoxS1FSYiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNToiY2F0ZWdvcnkuY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3OTE5NTIwNzk7fX0=', 1791954761),
('V4ru1X8j42BsvPYPiE3EqpebkLOKjt2U3uoUrwBq', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiQ2RNdHQwQXZxcE81UUNRbHpGeFVWUXZhVFJ0MzBwTkVuME9mMndsOSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mzc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9wcm9kdWN0cy9jcmVhdGUiO3M6NToicm91dGUiO3M6MTQ6InByb2R1Y3QuY3JlYXRlIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjQ6ImF1dGgiO2E6MTp7czoyMToicGFzc3dvcmRfY29uZmlybWVkX2F0IjtpOjE3OTE5ODcxNzE7fX0=', 1791989302),
('Wwybhn4Fpovd5MBaoHiQiYZTXPtjwjMRlIdDBGLh', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64; rv:155.0) Gecko/20100101 Firefox/155.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiQkRFVmFlWm5CM1I5dHluVGVIcGo2R2VmSEhKNGdMWDBrbm52eU91dCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL3Byb2R1Y3RzL2NyZWF0ZSI7czo1OiJyb3V0ZSI7czoxNDoicHJvZHVjdC5jcmVhdGUiO319', 1791979178);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Brayan Santiago Gonzalez Mateus', 'admin@gmail.com', 'admin', NULL, '$2y$12$yLdSvrbo9SDvXuodR4udieKDTaBLOv8.mUDo.2DiWfc.WUJAZxOW.', NULL, 'xrRJJJbIriUPTt3d7eGH8oZRVsa5C3mkdCVDoazFw2HedYqbydJHMO66RdKn', '2026-10-13 18:43:06', '2026-10-13 18:43:06'),
(2, 'Nando', 'noreply@gmail.com', 'user', NULL, '$2y$12$PSBA565tsqj/COmVgDCoGOYSpQtr6YLox/ssk7SD/bwW7ul89z0Dq', NULL, NULL, '2026-10-14 14:12:26', '2026-10-14 14:12:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
