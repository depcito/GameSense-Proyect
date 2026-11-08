-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 08, 2026 at 09:36 PM
-- Server version: 8.0.45
-- PHP Version: 8.3.30

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
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Acción', 'Juegos centrados en el combate, los reflejos y los desafíos físicos.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(2, 'Aventura', 'Juegos enfocados en la exploración, la narrativa y la resolución de desafíos.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(3, 'Rol (RPG)', 'Juegos donde los personajes progresan mediante habilidades, misiones y decisiones.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(4, 'Disparos', 'Juegos centrados en el uso de armas y el combate a distancia.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(5, 'Estrategia', 'Juegos que requieren planificación, gestión de recursos y toma de decisiones.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(6, 'Deportes', 'Juegos que recrean deportes como fútbol, baloncesto y tenis.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(7, 'Carreras', 'Juegos de conducción y competición con vehículos en distintos circuitos.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(8, 'Terror', 'Juegos diseñados para generar tensión y miedo mediante ambientes y situaciones peligrosas.', '2026-10-14 05:00:58', '2026-10-14 05:00:58', NULL),
(9, 'Souls', 'Juego de tipo RPG y Acción reconocido por su alta dificultad', '2026-10-14 11:04:29', '2026-10-14 11:04:29', NULL),
(11, 'Hulk', 'Prueba1', '2026-11-09 01:46:13', '2026-11-09 01:46:13', 'categories/2bc977d7-fff7-4142-900f-642140e77290.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` bigint UNSIGNED NOT NULL,
  `quantity` int NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `order_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
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
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2026_10_10_191524_create_products_table', 1),
(6, '2026_11_07_213224_create_personal_access_tokens_table', 2),
(7, '2026_10_13_182759_create_reviews_table', 3),
(8, '2026_10_19_100000_create_orders_table', 4),
(9, '2026_10_19_100100_create_payments_table', 4),
(10, '2026_10_26_100000_create_items_table', 4),
(11, '2026_10_27_100000_add_shipping_to_orders_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `total` decimal(10,2) NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint UNSIGNED NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pendiente',
  `order_id` bigint UNSIGNED NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `stock` int NOT NULL,
  `format` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `platform` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `stock`, `format`, `type`, `platform`, `category_id`, `created_at`, `updated_at`, `image`) VALUES
(1, 'Grand Theft Auto V', 'Juego de acción y mundo abierto ambientado en Los Santos.', 89900.00, 15, 'Físico', 'Videojuego', 'PS5', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(2, 'Marvel Spider-Man 2', 'Aventura de acción protagonizada por Peter Parker y Miles Morales.', 189900.00, 10, 'Físico', 'Videojuego', 'PS5', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(3, 'God of War Ragnarök', 'Aventura de acción mitológica protagonizada por Kratos y Atreus.', 149900.00, 12, 'Físico', 'Videojuego', 'PS5', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(4, 'Devil May Cry 5', 'Combate de acción rápida contra criaturas demoníacas.', 79900.00, 8, 'Físico', 'Videojuego', 'PS4', 1, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(5, 'The Legend of Zelda: Breath of the Wild', 'Explora Hyrule y resuelve desafíos en un mundo abierto.', 219900.00, 7, 'Físico', 'Videojuego', 'Nintendo Switch', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(6, 'Uncharted 4: A Thief\'s End', 'Aventura cinematográfica de exploración y búsqueda de tesoros.', 69900.00, 10, 'Físico', 'Videojuego', 'PS4', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(7, 'Red Dead Redemption 2', 'Aventura de mundo abierto ambientada en el lejano oeste.', 99900.00, 14, 'Físico', 'Videojuego', 'PS4', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(8, 'Tomb Raider: Definitive Edition', 'Explora ruinas y sobrevive en una aventura protagonizada por Lara Croft.', 59900.00, 9, 'Físico', 'Videojuego', 'PS4', 2, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(9, 'The Witcher 3: Wild Hunt', 'Juego de rol de fantasía con misiones y decisiones narrativas.', 89900.00, 11, 'Físico', 'Videojuego', 'PS5', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(10, 'Elden Ring', 'Juego de rol y acción en un extenso mundo de fantasía.', 159900.00, 8, 'Físico', 'Videojuego', 'PS5', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(11, 'Final Fantasy VII Rebirth', 'Juego de rol japonés con combates dinámicos y una historia épica.', 229900.00, 6, 'Físico', 'Videojuego', 'PS5', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(12, 'Baldur\'s Gate 3', 'Juego de rol basado en decisiones, exploración y combates tácticos.', 179900.00, 5, 'Digital', 'Videojuego', 'PC', 3, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(13, 'Call of Duty: Black Ops 6', 'Juego de disparos en primera persona con campaña y multijugador.', 179900.00, 10, 'Físico', 'Videojuego', 'PS5', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(14, 'Battlefield 2042', 'Combate militar a gran escala con vehículos y modos multijugador.', 69900.00, 8, 'Físico', 'Videojuego', 'PS5', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(15, 'DOOM Eternal', 'Disparos frenéticos contra hordas de demonios.', 79900.00, 9, 'Físico', 'Videojuego', 'PS4', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(16, 'Halo Infinite', 'Shooter de ciencia ficción con campaña y combates multijugador.', 99900.00, 7, 'Digital', 'Videojuego', 'Xbox Series X', 4, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(17, 'Civilization VI', 'Construye una civilización y compite por el dominio mundial.', 79900.00, 6, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(18, 'Age of Empires IV', 'Estrategia en tiempo real basada en civilizaciones históricas.', 119900.00, 7, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(19, 'StarCraft II', 'Estrategia de ciencia ficción con gestión de recursos y ejércitos.', 59900.00, 8, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(20, 'XCOM 2', 'Lidera una resistencia humana mediante combates tácticos por turnos.', 69900.00, 5, 'Digital', 'Videojuego', 'PC', 5, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(21, 'EA Sports FC 26', 'Simulación de fútbol con clubes, ligas y competiciones.', 249900.00, 15, 'Físico', 'Videojuego', 'PS5', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(22, 'NBA 2K26', 'Baloncesto con equipos, jugadores y modos competitivos.', 229900.00, 8, 'Físico', 'Videojuego', 'PS5', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(23, 'F1 25', 'Simulación de Fórmula 1 con pilotos, circuitos y campeonatos.', 199900.00, 7, 'Físico', 'Videojuego', 'PS5', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(24, 'Tony Hawk\'s Pro Skater 1 + 2', 'Juego de skate con trucos, desafíos y pistas clásicas.', 99900.00, 6, 'Físico', 'Videojuego', 'PS4', 6, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(25, 'Forza Horizon 5', 'Carreras de mundo abierto por paisajes inspirados en México.', 149900.00, 10, 'Digital', 'Videojuego', 'Xbox Series X', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(26, 'Gran Turismo 7', 'Simulador de conducción con automóviles y circuitos reales.', 169900.00, 8, 'Físico', 'Videojuego', 'PS5', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(27, 'Need for Speed Unbound', 'Carreras callejeras con personalización de vehículos.', 99900.00, 7, 'Físico', 'Videojuego', 'PS5', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(28, 'Mario Kart 8 Deluxe', 'Carreras arcade con personajes y circuitos del universo Mario.', 219900.00, 9, 'Físico', 'Videojuego', 'Nintendo Switch', 7, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(29, 'Resident Evil 4', 'Survival horror con exploración, recursos limitados y combates.', 139900.00, 8, 'Físico', 'Videojuego', 'PS5', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(30, 'Silent Hill 2', 'Terror psicológico centrado en la exploración y el misterio.', 159900.00, 5, 'Físico', 'Videojuego', 'PS5', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(31, 'Dead Space', 'Terror de ciencia ficción a bordo de una nave espacial abandonada.', 129900.00, 6, 'Físico', 'Videojuego', 'PS5', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(32, 'Outlast', 'Juego de terror y supervivencia dentro de un centro psiquiátrico.', 49900.00, 7, 'Digital', 'Videojuego', 'PC', 8, '2026-10-14 05:02:53', '2026-10-14 05:02:53', NULL),
(33, 'Producto Prueba', 'Es un producto de prueba', 200000.00, 1, 'Digital', 'Tarjeta de saldo', 'Nintendo Switch', 6, '2026-10-15 02:07:42', '2026-10-15 02:07:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint UNSIGNED NOT NULL,
  `rating` tinyint UNSIGNED NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` bigint UNSIGNED NOT NULL,
  `product_id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('FvQqvRXqKsknG1WxKHGailWvT8pxj2fPg92AkAZR', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.145.2 Chrome/150.0.7871.250 Electron/43.8.3 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWmU2bTJVbUR6aHl3aUUzZGFQUEtTbVlBaDVKVngyVFhRS05yaFJyNCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXZpZXdzIjtzOjU6InJvdXRlIjtzOjEyOiJyZXZpZXcuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6NDoiYXV0aCI7YToxOntzOjIxOiJwYXNzd29yZF9jb25maXJtZWRfYXQiO2k6MTc5NDE3MDc0Nzt9fQ==', 1794173760),
('IOU6GIROD5fU8LGB456vWnZcmDVhjXd8psT0fKqF', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.145.2 Chrome/150.0.7871.250 Electron/43.8.3 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTjUwdlpTS3M4aEN3b2ZpcVdUOGRBMUE3TWl6SUs2NTBEYzdLWWNFbiI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXZpZXdzIjtzOjU6InJvdXRlIjtzOjEyOiJyZXZpZXcuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1794099149),
('pE27QnvW5m7Ma4YFpoyQzpxGGOeR41I6BjoGo7MB', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.145.2 Chrome/150.0.7871.250 Electron/43.8.3 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQnc0UnJVdVU3dnF6aER2TVl1SVNrYlVxV3U0RTBxN2dFM0E0NW8zcCI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6Mjk6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9yZXZpZXdzIjtzOjU6InJvdXRlIjtzOjEyOiJyZXZpZXcuaW5kZXgiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1794087606),
('rb5pSZTAFsveiS1U2e7XKudZfzOCkZsTvYyZKGis', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/156.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiR2FEZ0JYZU0xMFgzekdPd0ZnTmFYMXIzMFczclUzM283OE5xd01uRSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MzI6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXRlZ29yaWVzIjtzOjU6InJvdXRlIjtzOjE0OiJjYXRlZ29yeS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzk0MDczODQ0O319', 1794073865),
('WfoLD2QnzzkpnXtXqVbz0CledRvzeFTOAhioL0CV', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Code/1.145.2 Chrome/150.0.7871.250 Electron/43.8.3 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiU0ZaWkw0eXJHQ0Y3WVdUcXJ0M0VIejBtZ014a1RweVU5S3JIcmRKdSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czoxMDoiaG9tZS5pbmRleCI7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czo0OiJhdXRoIjthOjE6e3M6MjE6InBhc3N3b3JkX2NvbmZpcm1lZF9hdCI7aToxNzk0MDcyNjQzO319', 1794072662);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role`, `email_verified_at`, `password`, `address`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Brayan Santiago Gonzalez Mateus', 'admin@gmail.com', 'admin', NULL, '$2y$12$yLdSvrbo9SDvXuodR4udieKDTaBLOv8.mUDo.2DiWfc.WUJAZxOW.', NULL, 'CGrzVIWfqeta2ow5y2KdCMOrZnhDB9AnBJqokdDRxII8YQ6zUG9vG8pRCUZd', '2026-10-13 18:43:06', '2026-10-13 18:43:06'),
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
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `items_order_id_foreign` (`order_id`),
  ADD KEY `items_product_id_foreign` (`product_id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_code_unique` (`code`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`),
  ADD KEY `payments_user_id_foreign` (`user_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`),
  ADD KEY `personal_access_tokens_expires_at_index` (`expires_at`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`);

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
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `payments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
