-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: mysql:3306
-- Generation Time: Jan 30, 2025 at 09:49 AM
-- Server version: 11.6.2-MariaDB-ubu2404
-- PHP Version: 8.2.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `grupo1_2425`
--

-- --------------------------------------------------------

--
-- Table structure for table `breakdowns`
--

CREATE TABLE `breakdowns` (
  `idAveria` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `breakdowns`
--

INSERT INTO `breakdowns` (`idAveria`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Mecánica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Eléctrica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Neumática', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Hidráulica', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Informática', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Instalaciones Generales', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'Otros', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 'Mantenimiento', '2025-01-22 11:39:19', '2025-01-22 11:39:19');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `campuses`
--

CREATE TABLE `campuses` (
  `idCampus` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `campuses`
--

INSERT INTO `campuses` (`idCampus`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 'Arriaga', NULL, NULL),
(2, 'Mendizorroza', NULL, NULL),
(3, 'Molinuevo', NULL, NULL),
(4, 'Nieves Cano', NULL, NULL),
(5, 'Jesús Obrero', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incidences`
--

CREATE TABLE `incidences` (
  `idIncidencia` bigint(20) UNSIGNED NOT NULL,
  `idMaquina` bigint(20) UNSIGNED NOT NULL,
  `fechaReporte` date NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `fechaResolucion` date DEFAULT NULL,
  `estadoIncidencia` varchar(255) NOT NULL,
  `habilitada` tinyint(1) NOT NULL,
  `gravedad` varchar(255) NOT NULL,
  `idAveria` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `incidences`
--

INSERT INTO `incidences` (`idIncidencia`, `idMaquina`, `fechaReporte`, `titulo`, `descripcion`, `fechaResolucion`, `estadoIncidencia`, `habilitada`, `gravedad`, `idAveria`, `created_at`, `updated_at`) VALUES
(70, 1000001, '2025-01-29', 's', 'a', NULL, 'Abierta', 0, '2', 4, '2025-01-29 12:07:11', '2025-01-29 12:07:28'),
(71, 1000001, '2025-01-29', 's', 'a', NULL, 'Abierta', 0, '2', 2, '2025-01-29 12:10:31', '2025-01-29 12:14:37'),
(72, 2000002, '2025-01-29', 's', 'a', NULL, 'Abierta', 0, '2', 2, '2025-01-29 12:10:53', '2025-01-29 12:14:38'),
(73, 1000001, '2025-01-29', 'ssssssss', 'ssss', NULL, 'Abierta', 0, '2', 4, '2025-01-29 12:12:51', '2025-01-29 12:14:35'),
(74, 5000001, '2025-01-29', 'El motor se para', 'Cada 5 minutos el motor se sobrecalienta y se para', '2025-01-30', 'Resuelta', 0, '1', 1, '2025-01-29 18:05:32', '2025-01-30 10:29:59'),
(75, 5000005, '2025-01-30', 'Mensaje error 404', 'Sale un mensaje de error en la pantalla', NULL, 'Abierta', 1, '2', 5, '2025-01-30 08:28:15', '2025-01-30 08:28:15'),
(76, 1000001, '2025-01-30', 'Arranque de máquina', 'Al intentar encender, hace un ruido raro y no funciona', NULL, 'Abierta', 1, '1', 1, '2025-01-30 09:13:24', '2025-01-30 09:13:24'),
(77, 2000001, '2025-01-30', 'Tornillo suelto', 'El tornillo de la tapa exterior está totalmente suelto', NULL, 'Abierta', 1, '3', 7, '2025-01-30 09:15:38', '2025-01-30 09:15:38'),
(78, 3000002, '2025-01-30', 'Cables en mal estado', 'Aunque la maquina siga funcionando los cables de alimentación están en muy mal estado', NULL, 'Abierta', 1, '2', 2, '2025-01-30 09:17:20', '2025-01-30 09:17:20'),
(79, 4000002, '2025-01-30', 'Apagones inesperados', 'De vez en cuando la máquina se apaga sin ningún tipo de explicación', NULL, 'Abierta', 1, '1', 2, '2025-01-30 09:19:42', '2025-01-30 09:19:42');

-- --------------------------------------------------------

--
-- Table structure for table `interventions`
--

CREATE TABLE `interventions` (
  `idIntervencion` bigint(20) UNSIGNED NOT NULL,
  `idTecnico` bigint(20) UNSIGNED NOT NULL,
  `idIncidencia` bigint(20) UNSIGNED NOT NULL,
  `fechaInicio` datetime NOT NULL,
  `fechaFin` datetime DEFAULT NULL,
  `notas` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `motivo` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `interventions`
--

INSERT INTO `interventions` (`idIntervencion`, `idTecnico`, `idIncidencia`, `fechaInicio`, `fechaFin`, `notas`, `created_at`, `updated_at`, `motivo`) VALUES
(144, 47, 74, '2025-01-30 08:06:28', '2025-01-30 08:21:50', 'Comentarios: Las piezas llegan mañana', '2025-01-30 09:06:28', '2025-01-30 09:21:50', 'Falta de piezas'),
(145, 37, 74, '2025-01-30 08:42:31', '2025-01-30 08:43:01', 'Comentarios: No tengo llave de perro', '2025-01-30 09:42:32', '2025-01-30 09:43:02', 'Falta de herramientas'),
(146, 55, 74, '2025-01-30 09:29:43', '2025-01-30 09:29:58', 'Comentarios: Solucionado', '2025-01-30 10:29:44', '2025-01-30 10:29:59', 'Incidencia resuelta');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `machines`
--

CREATE TABLE `machines` (
  `idMaquina` bigint(20) UNSIGNED NOT NULL,
  `habilitada` tinyint(1) NOT NULL DEFAULT 1,
  `nombre` varchar(255) NOT NULL,
  `idCampus` bigint(20) UNSIGNED NOT NULL,
  `idSeccion` bigint(20) UNSIGNED NOT NULL,
  `prioridad` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `machines`
--

INSERT INTO `machines` (`idMaquina`, `habilitada`, `nombre`, `idCampus`, `idSeccion`, `prioridad`, `created_at`, `updated_at`) VALUES
(1000001, 1, 'Torno CNC Haas 0003', 1, 1002, 1, '2025-01-29 08:42:05', '2025-01-29 08:42:05'),
(2000001, 1, 'Rectificadora Kent 0004', 2, 2003, 2, '2025-01-29 08:42:36', '2025-01-29 08:42:36'),
(2000002, 1, 'Cepillo Industrial Bosch 0005', 2, 2001, 2, '2025-01-29 08:42:48', '2025-01-29 08:42:48'),
(2000003, 1, 'Sierra de Cinta Makita 0008', 2, 2002, 2, '2025-01-29 08:43:30', '2025-01-29 08:43:30'),
(3000001, 1, 'Taladro de Columna Delta 0006', 3, 3003, 3, '2025-01-29 08:43:01', '2025-01-29 08:43:01'),
(3000002, 1, 'Prensa Hidráulica Enerpac 0007', 3, 3001, 1, '2025-01-29 08:43:14', '2025-01-29 08:43:14'),
(3000003, 0, 'Mquina prueba', 3, 3002, 2, '2025-01-29 11:40:40', '2025-01-29 11:40:44'),
(4000001, 1, 'Plegadora CNC Trumpf 0010', 4, 4003, 1, '2025-01-29 08:43:46', '2025-01-29 08:43:46'),
(4000002, 1, 'Soldadora Miller 0014', 4, 4004, 1, '2025-01-29 08:44:03', '2025-01-29 08:44:03'),
(4000003, 1, 'Electroerosionadora Mitsubishi 0012', 4, 4002, 2, '2025-01-29 08:44:25', '2025-01-29 08:44:25'),
(5000001, 1, 'Torno Pinacho 0001', 5, 5010, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000002, 1, 'Torno Pinacho 0002', 5, 5010, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000003, 1, 'Torno Pinacho 0003', 5, 5010, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000004, 1, 'Torno Pinacho 0004', 5, 5010, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000005, 1, 'Torno Pinacho 0005', 5, 5010, 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000006, 1, 'Fresadora Zayer 0001', 5, 5012, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000007, 1, 'Fresadora Zayer 0002', 5, 5012, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000008, 1, 'Fresadora Zayer 0003', 5, 5012, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000009, 1, 'Fresadora Zayer 0004', 5, 5012, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5000010, 1, 'Taladradora 0001', 5, 5017, 3, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `maintenances`
--

CREATE TABLE `maintenances` (
  `idMantenimiento` bigint(20) UNSIGNED NOT NULL,
  `idTarea` bigint(20) UNSIGNED NOT NULL,
  `idMaquina` bigint(20) UNSIGNED NOT NULL,
  `frecuencia` int(11) NOT NULL,
  `ultimoMantenimiento` date NOT NULL,
  `proximoMantenimiento` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `maintenances`
--

INSERT INTO `maintenances` (`idMantenimiento`, `idTarea`, `idMaquina`, `frecuencia`, `ultimoMantenimiento`, `proximoMantenimiento`, `created_at`, `updated_at`) VALUES
(11, 15, 5000001, 14, '2025-01-29', '2025-02-12', '2025-01-29 11:55:28', '2025-01-29 11:55:28');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_01_15_082536_create_tasks_table', 1),
(5, '2025_01_15_082710_create_sections_table', 1),
(6, '2025_01_15_082931_create_campuses_table', 1),
(7, '2025_01_15_083101_create_breakdowns_table', 1),
(8, '2025_01_15_083326_create_machines_table', 1),
(9, '2025_01_15_083454_create_incidences_table', 1),
(10, '2025_01_15_083636_create_maintenances_table', 1),
(11, '2025_01_15_083739_create_interventions_table', 1),
(12, '2025_01_15_122232_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `idSeccion` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`idSeccion`, `nombre`, `created_at`, `updated_at`) VALUES
(1001, 'Taller Mecánico 4 040', '2025-01-29 08:35:16', '2025-01-29 08:35:16'),
(1002, 'Taller de Soldadura 4 040', '2025-01-29 08:35:34', '2025-01-29 08:35:34'),
(1003, 'Taller de Fontanería 7 070', '2025-01-29 08:36:14', '2025-01-29 08:36:14'),
(2001, 'Taller de Tapicería 9 090', '2025-01-29 08:36:34', '2025-01-29 08:36:34'),
(2002, 'Taller de Carpintería 3 030', '2025-01-29 08:36:42', '2025-01-29 08:36:42'),
(2003, 'Taller Mecánico 9 090', '2025-01-29 08:36:49', '2025-01-29 08:36:49'),
(2004, 'Taller de Carpintería 3 030', '2025-01-29 08:37:34', '2025-01-29 08:37:34'),
(3001, 'Taller Mecánico 1 010', '2025-01-29 08:37:21', '2025-01-29 08:37:21'),
(3002, 'Taller de Electricidad 2 020', '2025-01-29 08:37:28', '2025-01-29 08:37:28'),
(3003, 'Taller de Soldadura 4 040', '2025-01-29 08:37:41', '2025-01-29 08:37:41'),
(3004, 'Taller de Pintura 5 050', '2025-01-29 08:38:01', '2025-01-29 08:38:01'),
(4001, 'Taller de Electrónica 6 060', '2025-01-29 08:38:21', '2025-01-29 08:38:21'),
(4002, 'Taller de Fontanería 7 070', '2025-01-29 08:38:27', '2025-01-29 08:38:27'),
(4003, 'Taller de Herrería 8 080', '2025-01-29 08:38:33', '2025-01-29 08:38:33'),
(4004, 'Taller de Energías Renovables 12 120', '2025-01-29 08:38:43', '2025-01-29 08:38:43'),
(5010, 'Taller Mecánico 1 010', NULL, NULL),
(5011, 'Taller Aurrera XXI', NULL, NULL),
(5012, 'Taller Mecánico 2 012', NULL, NULL),
(5014, 'Taller Control Numérico 014', NULL, NULL),
(5017, 'Taller Mecánico 3 017', NULL, NULL),
(5018, 'Taller Mecánico 4 018', NULL, NULL),
(5019, 'Taller Metrología', NULL, NULL),
(5024, 'Taller Neumática', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `idTarea` bigint(20) UNSIGNED NOT NULL,
  `habilitada` int(1) NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`idTarea`, `habilitada`, `descripcion`, `nombre`, `created_at`, `updated_at`) VALUES
(1, 1, 'Desmontar, revisar y limpiar el motor principal de la maquina', 'Limpiar motor', NULL, NULL),
(3, 1, 'Arreglar el tornillo del lado derecho de la maquina 500069', 'Arreglar Tornillo', '2025-01-20 13:56:33', '2025-01-20 13:56:33'),
(13, 1, 'Lubricación de piezas móviles', 'Lubricación', '2025-01-29 08:54:45', '2025-01-29 08:54:45'),
(14, 1, 'Calibración de sensores y sistemas de medición.', 'Calibración', '2025-01-29 08:55:27', '2025-01-29 08:55:27'),
(15, 1, 'Inspección de desgaste en correas, cadenas y rodamientos.', 'Inspección de desgaste', '2025-01-29 08:55:59', '2025-01-29 08:55:59'),
(18, 0, 'La maquina', 'Limpiar', '2025-01-29 11:41:31', '2025-01-29 11:41:42'),
(19, 1, 'Desinfección de superficies en máquinas con contacto humano frecuente.', 'Desinfección de superficies', '2025-01-30 09:21:04', '2025-01-30 09:21:04'),
(20, 1, 'Aplicación de productos anticorrosivos en piezas metálicas.', 'Aplicación de productos anticorrosivos', '2025-01-30 09:21:23', '2025-01-30 09:21:23'),
(21, 1, 'Revisión y reapriete de abrazaderas y conexiones de tuberías.', 'Revisión y reapriete', '2025-01-30 09:22:09', '2025-01-30 09:22:09'),
(22, 1, 'Inspección de holguras en mecanismos deslizantes y ajuste si es necesario.', 'Inspección de holguras', '2025-01-30 09:22:30', '2025-01-30 09:22:30'),
(23, 1, 'Revisión de filtros de aire, aceite o refrigerante.', 'Revisión', '2025-01-30 09:22:50', '2025-01-30 09:22:50');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `idUsuario` bigint(20) UNSIGNED NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `apellido` varchar(255) NOT NULL,
  `rol` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `habilitado` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`idUsuario`, `nombre`, `apellido`, `rol`, `email`, `password`, `habilitado`, `created_at`, `updated_at`) VALUES
(10, 'Oier', 'Albeniz', 'admin', 'oier@gmail.com', '$2y$12$T3c0tFU96owIQ.xSURQlf.iM/NaqjzXtw1NxRsMQsiaSRPN5NbABC', 1, '2025-01-20 13:13:00', '2025-01-30 09:10:16'),
(27, 'Joseba', 'Fernández', 'operario', 'josebafdz@peru.pe', '$2y$12$DvpUg1PS9QfAE7qrmkEqIO59BCMM20lvL8H0CYPOQ.22Ysqr2lS4G', 1, '2025-01-21 10:02:41', '2025-01-21 10:02:41'),
(37, 'Jesus', 'de Nazaret', 'admin', 'jesus@nazaret.is', '$2y$12$1SafU7IusnchC1xEN1/O9uYg1oW5lWKb8B1Z0lj9u3FaDxKjcfMoa', 1, '2025-01-22 09:47:15', '2025-01-29 10:54:53'),
(47, 'Ben', 'Dover', 'tecnico', 'bendover@gmail.com', '$2y$12$X9dNjOdSNpg5XrbhvaJsqeqdJQf0TkjM2gARUT9viJC04jtxSMcQ6', 1, '2025-01-28 10:38:51', '2025-01-29 11:40:52'),
(48, 'Maddie', 'Çksbig', 'operario', 'maddie@hotmail.org', '$2y$12$ih0sBPZkRNoe8Wkyyk9wNO.4V8qek.cM5xWm4YCHBO/jI1pXmvz9i', 1, '2025-01-28 10:42:35', '2025-01-28 10:42:35'),
(49, 'Mike', 'Oxlong', 'operario', 'mike.oxlong@yahoo.us', '$2y$12$WH6Mo.57Koaf4ctkpygZ5e4cWYjSXscaj1S0S9f.lQ/AyNljhLUi2', 1, '2025-01-28 10:46:39', '2025-01-28 10:46:39'),
(50, 'Gabe', 'Itches', 'operario', 'gabeitches@google.net', '$2y$12$zUPPrryXcB/2L/v8u5dpJeGxHPAj.3suPZ7hnyMMGA60NAmo5/T6O', 1, '2025-01-28 10:48:13', '2025-01-28 10:48:13'),
(54, 'Bryan Dave', 'Alzamora', 'tecnico', 'bryandave@yahoo.pe', '$2y$12$T1VdSj2BRp7kyh5x6GaAReIr.1qzXN/N1jxaxfrso6zj2Cc/3KUli', 1, '2025-01-29 10:54:09', '2025-01-29 10:54:46'),
(55, 'Joseba', 'Fernández', 'admin', 'jfernandez@egibide.org', '$2y$12$N3Ksj7fTfY6tNj46lKOVoO35n4VSF6zBvTXzypWLsetJqV84XIWGy', 0, '2025-01-29 11:41:14', '2025-01-29 11:41:21'),
(56, 'Ines', 'Larrañaga', 'admin', 'ines@gmail.com', '$2y$12$17yWTqpogfv8AS85GC2TpuLsXlg.yFgSTsdE.f7zsIToU3nVDHOGe', 1, '2025-01-29 11:51:46', '2025-01-29 12:00:26'),
(57, 'Tecnico', 'Pruebas', 'tecnico', 'tecnico@egibide.org', '$2y$12$/h94zVfMiX4dNe8aGLNQpuxp5c8CgaKDgwKNkXyRG615FCEgKxdc2', 1, '2025-01-30 10:35:44', '2025-01-30 10:35:44'),
(58, 'Operario', 'Pruebas', 'operario', 'operario@egibide.org', '$2y$12$neerYiymDUPWYRwP6rgifepKazCwvBqNjIp4d2FSJj1FFhhDtSOki', 1, '2025-01-30 10:36:02', '2025-01-30 10:36:02'),
(59, 'Admin', 'Pruebas', 'admin', 'admin@egibide.org', '$2y$12$vEfub0.V3DdR2B6ZCVDNU.cfzKS1XLvshPu1CLOP.OKAdDlWQZl.a', 1, '2025-01-30 10:36:19', '2025-01-30 10:36:19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `breakdowns`
--
ALTER TABLE `breakdowns`
  ADD PRIMARY KEY (`idAveria`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `campuses`
--
ALTER TABLE `campuses`
  ADD PRIMARY KEY (`idCampus`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `incidences`
--
ALTER TABLE `incidences`
  ADD PRIMARY KEY (`idIncidencia`),
  ADD KEY `incidences_idmaquina_foreign` (`idMaquina`),
  ADD KEY `incidences_idaveria_foreign` (`idAveria`);

--
-- Indexes for table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`idIntervencion`),
  ADD KEY `interventions_idtecnico_foreign` (`idTecnico`),
  ADD KEY `interventions_idincidencia_foreign` (`idIncidencia`);

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
-- Indexes for table `machines`
--
ALTER TABLE `machines`
  ADD PRIMARY KEY (`idMaquina`),
  ADD KEY `machines_idcampus_foreign` (`idCampus`),
  ADD KEY `machines_idseccion_foreign` (`idSeccion`);

--
-- Indexes for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD PRIMARY KEY (`idMantenimiento`),
  ADD KEY `maintenances_idtarea_foreign` (`idTarea`),
  ADD KEY `maintenances_idmaquina_foreign` (`idMaquina`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`idSeccion`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`idTarea`),
  ADD UNIQUE KEY `unique_task` (`nombre`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUsuario`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `breakdowns`
--
ALTER TABLE `breakdowns`
  MODIFY `idAveria` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `campuses`
--
ALTER TABLE `campuses`
  MODIFY `idCampus` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incidences`
--
ALTER TABLE `incidences`
  MODIFY `idIncidencia` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `idIntervencion` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=147;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maintenances`
--
ALTER TABLE `maintenances`
  MODIFY `idMantenimiento` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `idTarea` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `idUsuario` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incidences`
--
ALTER TABLE `incidences`
  ADD CONSTRAINT `incidences_idaveria_foreign` FOREIGN KEY (`idAveria`) REFERENCES `breakdowns` (`idAveria`),
  ADD CONSTRAINT `incidences_idmaquina_foreign` FOREIGN KEY (`idMaquina`) REFERENCES `machines` (`idMaquina`);

--
-- Constraints for table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `interventions_idincidencia_foreign` FOREIGN KEY (`idIncidencia`) REFERENCES `incidences` (`idIncidencia`),
  ADD CONSTRAINT `interventions_idtecnico_foreign` FOREIGN KEY (`idTecnico`) REFERENCES `users` (`idUsuario`);

--
-- Constraints for table `machines`
--
ALTER TABLE `machines`
  ADD CONSTRAINT `machines_idcampus_foreign` FOREIGN KEY (`idCampus`) REFERENCES `campuses` (`idCampus`),
  ADD CONSTRAINT `machines_idseccion_foreign` FOREIGN KEY (`idSeccion`) REFERENCES `sections` (`idSeccion`);

--
-- Constraints for table `maintenances`
--
ALTER TABLE `maintenances`
  ADD CONSTRAINT `maintenances_idmaquina_foreign` FOREIGN KEY (`idMaquina`) REFERENCES `machines` (`idMaquina`),
  ADD CONSTRAINT `maintenances_idtarea_foreign` FOREIGN KEY (`idTarea`) REFERENCES `tasks` (`idTarea`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
