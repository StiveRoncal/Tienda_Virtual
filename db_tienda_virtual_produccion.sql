-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 26-01-2024 a las 03:49:47
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `db_tienda_virtual_produccion`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `idcategoria` bigint(20) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `portada` varchar(100) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`idcategoria`, `nombre`, `descripcion`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(1, 'Iluminación', 'Focos Ahorradores y Led', 'img_cb2e071ccca51b5db3da2972c303902a.jpg', '2023-12-14 15:52:56', 'iluminacion', 1),
(2, 'Herramientas', 'Herramientas Manuales y electricas', 'img_4d9f01feda768ddb211eba092adb6f23.jpg', '2024-01-09 22:45:35', 'herramientas', 1),
(3, 'Electricidad', 'Materiales de Instalación Eléctricas', 'portada_categoria.png', '2024-01-09 22:47:11', 'electricidad', 1),
(4, 'Tecnología', 'Productos de IOT', 'portada_categoria.png', '2024-01-09 22:48:40', 'tecnologia', 1),
(5, 'Epps', 'Equipos de Protección Personal', 'portada_categoria.png', '2024-01-09 22:50:31', 'epps', 1),
(6, 'Camaras de Seguridad', 'Sistema de VideoVigilancia', 'portada_categoria.png', '2024-01-19 15:44:02', 'camaras-de-seguridad', 1),
(7, 'Ferretería y Puertas', 'Accesorios en General', 'portada_categoria.png', '2024-01-19 16:02:47', 'ferreteria-y-puertas', 1),
(8, 'Baño', 'Herramientas de Servicio Higiénico', 'portada_categoria.png', '2024-01-19 16:07:46', 'bano', 1),
(9, 'Construcción y Ferreteria', 'Accesorios de Tornillos, Pernos, Clavos y Fijaciones', 'portada_categoria.png', '2024-01-19 16:10:21', 'construccion-y-ferreteria', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id` bigint(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `mensaje` text NOT NULL,
  `ip` varchar(15) NOT NULL,
  `dispositivo` varchar(25) NOT NULL,
  `useragent` text NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id`, `nombre`, `email`, `mensaje`, `ip`, `dispositivo`, `useragent`, `datecreated`) VALUES
(1, 'Aaaaaa', 'aaaa@gmail.com', 'asdadsasdads', '127.0.0.1', 'PC', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:121.0) Gecko/20100101 Firefox/121.0', '2024-01-15 16:58:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `id` bigint(20) NOT NULL,
  `pedidoid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `detalle_pedido`
--

INSERT INTO `detalle_pedido` (`id`, `pedidoid`, `productoid`, `precio`, `cantidad`) VALUES
(1, 1, 1, 17.00, 1),
(2, 2, 3, 8.00, 2),
(3, 3, 2, 22.00, 1),
(6, 6, 3, 8.00, 1),
(7, 6, 2, 22.00, 1),
(8, 7, 1, 17.00, 1),
(9, 8, 3, 8.00, 2),
(10, 9, 2, 22.00, 1),
(11, 10, 35, 150.00, 2),
(12, 10, 19, 5.00, 3),
(13, 11, 38, 10.00, 6),
(14, 11, 40, 280.00, 1),
(15, 12, 36, 230.00, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_temp`
--

CREATE TABLE `detalle_temp` (
  `id` bigint(20) NOT NULL,
  `personaid` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `transaccionid` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `id` bigint(20) NOT NULL,
  `productoid` bigint(20) NOT NULL,
  `img` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`id`, `productoid`, `img`) VALUES
(6, 1, 'prod_2ed2535e03ee3c2e5fadc6be22dc35e4.jpg'),
(8, 2, 'prod_34e8f2f5c1fcbc9f893cc629dc05d351.jpg'),
(9, 3, 'prod_cd46d7f3bf846888ca1282152d9647e0.jpg'),
(10, 4, 'prod_5bbb105143e88d6df010d1cb6480d76b.jpg'),
(11, 5, 'prod_4243e61581d727ad0f055b3ca516d8d8.jpg'),
(12, 6, 'prod_e65e2eacd041f80ffc8b2177b6476bd8.jpg'),
(13, 7, 'prod_2629731e1af3583488a09a58ee48b685.jpg'),
(14, 8, 'prod_43721e54e5ecef6a8679a39897a78c4e.jpg'),
(16, 10, 'prod_1ab23f3084badfb9c9cc7e87a68bafd8.jpg'),
(18, 9, 'prod_08f5a231e32c75d1fd92748d986aace1.jpg'),
(19, 11, 'prod_babed86ced7c871f72b6376d3a56ef42.jpg'),
(20, 12, 'prod_39f3704c5f3e940ae694c3b9c71cd6e9.jpg'),
(21, 13, 'prod_74f2e6899f91b835adf1772f2a5635e6.jpg'),
(22, 14, 'prod_7577905cf28b55f78c1fbe5121297bef.jpg'),
(23, 15, 'prod_b1f13be35420a88fbfff07c6130536ea.jpg'),
(24, 16, 'prod_a3c2174552741c8e06d18d203bc4ea6a.jpg'),
(25, 17, 'prod_8ff18786416d69e759bc5f795a8e49b7.jpg'),
(26, 18, 'prod_965521914dc2937a7952b69af5a553d9.jpg'),
(27, 19, 'prod_71f17134d8ee16d3bcedf9172bd79e73.jpg'),
(28, 20, 'prod_2ab549f29dfbeafa6e56b26260049a6b.jpg'),
(31, 22, 'prod_77b644d71de360f3feb9331349413697.jpg'),
(32, 23, 'prod_a137ca1bad1812aaf6ae720a19c66730.jpg'),
(33, 24, 'prod_752a203e3e258aff234cec3655643f9c.jpg'),
(34, 25, 'prod_861ed29af913a538096d9b6eb557b296.jpg'),
(39, 28, 'prod_9059516997912749d83c121ed7336993.jpg'),
(42, 26, 'prod_fe893a07703c0c3c06b176592025353e.jpg'),
(43, 27, 'prod_f0221cabb1e4fb2c3e65ce22678a6b4c.jpg'),
(44, 21, 'prod_7df99bc69658abd7606e8f0ca9c5b959.jpg'),
(45, 29, 'prod_455139c335dabe67ea1440e8e71e8069.jpg'),
(46, 30, 'prod_9eeceea882df41c7d996f13573d3877f.jpg'),
(47, 31, 'prod_02373e2d2d4e60b5ffc6e9d2101d8e5e.jpg'),
(48, 32, 'prod_6b7613acfe09a27fa46744986aeef101.jpg'),
(49, 33, 'prod_50a0aac27d0b5dfd4c280946e2db1853.jpg'),
(50, 34, 'prod_33a3ba425a9dd2147a19887fcc15218b.jpg'),
(51, 35, 'prod_e7b5ee3d31a3a5fd0e9be91cf134c07c.jpg'),
(52, 36, 'prod_0c59cefd3c922183ebc31d158ece826b.jpg'),
(53, 37, 'prod_61dfa9e2e5523c784e77cd9df7370682.jpg'),
(54, 38, 'prod_4a9399d2e8988462a2665296c84e8369.jpg'),
(55, 39, 'prod_cdffb005fd012de6ed7ec0ffa2c4d7bc.jpg'),
(56, 40, 'prod_80108db73c620d5a705b0fc8a0ea997e.jpg'),
(57, 41, 'prod_cac354f10d9decfcd2b6ba5f5c5f32fb.jpg'),
(58, 42, 'prod_43bee99c5fd2b1cd52871a9acc37614e.jpg'),
(59, 43, 'prod_f1f14bad19fbb7b35e801da318d759ac.jpg'),
(60, 44, 'prod_491fd11b624be191b63610e64482c6cb.jpg'),
(61, 45, 'prod_a405e75a670f7521f8f81609434cb26d.jpg'),
(62, 46, 'prod_d7fa5b60c8210e1c3c727331a9027f01.jpg'),
(63, 47, 'prod_4ac5df6da80075bec25519febcaed39b.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modulo`
--

CREATE TABLE `modulo` (
  `idmodulo` bigint(20) NOT NULL,
  `titulo` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `modulo`
--

INSERT INTO `modulo` (`idmodulo`, `titulo`, `descripcion`, `status`) VALUES
(1, 'Dashboard', 'Dashboard', 1),
(2, 'Usuarios', 'Usuarios del Sistema', 1),
(3, 'Clientes', 'Clientes de tienda', 1),
(4, 'Producto', 'Todos los Productos', 1),
(5, 'Pedidos', 'Pedidos', 1),
(6, 'Categorias', 'Categorias Productos', 1),
(7, 'Suscriptores', 'Suscriptores del Sitio Web', 1),
(8, 'Contactos', 'Mensajes del Formulario contacto', 1),
(9, 'Páginas', 'Páginas del Sitio Web', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedido`
--

CREATE TABLE `pedido` (
  `idpedido` bigint(20) NOT NULL,
  `referenciacobro` varchar(255) DEFAULT NULL,
  `idtransaccionpaypal` varchar(255) DEFAULT NULL,
  `datospaypal` text DEFAULT NULL,
  `personaid` bigint(20) NOT NULL,
  `fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `costo_envio` decimal(10,2) NOT NULL DEFAULT 0.00,
  `monto` decimal(11,2) NOT NULL,
  `tipopagoid` bigint(20) NOT NULL,
  `direccion_envio` text NOT NULL,
  `status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `pedido`
--

INSERT INTO `pedido` (`idpedido`, `referenciacobro`, `idtransaccionpaypal`, `datospaypal`, `personaid`, `fecha`, `costo_envio`, `monto`, `tipopagoid`, `direccion_envio`, `status`) VALUES
(1, 'Pago Correctamentamente', NULL, NULL, 4, '2023-12-20 10:23:14', 0.00, 17.00, 2, 'pangoa,pangoa', 'Completo'),
(2, 'Yape Completo', NULL, NULL, 1, '2023-12-29 13:59:02', 0.00, 16.00, 3, 'Calle 28 de Julio Nro. 725,San Martin de Pangoa', 'Completo'),
(3, 'Tranferencia Completada', NULL, NULL, 1, '2024-01-09 23:52:15', 0.00, 22.00, 4, 'calle ricardo palma nro 566,Pangoa', 'Completo'),
(6, NULL, NULL, NULL, 8, '2024-01-12 19:23:20', 0.00, 30.00, 2, 'Lima Peru,calle los heroes', 'Pendiente'),
(7, NULL, '28F872585A796861B', '{\"id\":\"78424791J1335644W\",\"intent\":\"CAPTURE\",\"status\":\"COMPLETED\",\"purchase_units\":[{\"reference_id\":\"default\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"4.52\"},\"payee\":{\"email_address\":\"sb-noepa28050302@business.example.com\",\"merchant_id\":\"E9HYXNUY3MAEC\"},\"description\":\"Compra de artículos en Ferreteria Roncal por $4.52\",\"shipping\":{\"name\":{\"full_name\":\"John Doe\"},\"address\":{\"address_line_1\":\"Free Trade Zone\",\"admin_area_2\":\"Lima\",\"admin_area_1\":\"Lima\",\"postal_code\":\"07001\",\"country_code\":\"PE\"}},\"payments\":{\"captures\":[{\"id\":\"28F872585A796861B\",\"status\":\"COMPLETED\",\"amount\":{\"currency_code\":\"USD\",\"value\":\"4.52\"},\"final_capture\":true,\"seller_protection\":{\"status\":\"ELIGIBLE\",\"dispute_categories\":[\"ITEM_NOT_RECEIVED\",\"UNAUTHORIZED_TRANSACTION\"]},\"create_time\":\"2024-01-16T16:25:09Z\",\"update_time\":\"2024-01-16T16:25:09Z\"}]}}],\"payer\":{\"name\":{\"given_name\":\"John\",\"surname\":\"Doe\"},\"email_address\":\"sb-8maep28050300@personal.example.com\",\"payer_id\":\"Z9CKBTQRXYVTJ\",\"address\":{\"country_code\":\"PE\"}},\"create_time\":\"2024-01-16T16:24:38Z\",\"update_time\":\"2024-01-16T16:25:09Z\",\"links\":[{\"href\":\"https://api.sandbox.paypal.com/v2/checkout/orders/78424791J1335644W\",\"rel\":\"self\",\"method\":\"GET\"}]}', 1, '2024-01-16 11:25:09', 0.00, 17.00, 1, 'pangoa,pangoa', 'Completo'),
(8, NULL, NULL, NULL, 1, '2024-01-16 15:18:50', 0.00, 16.00, 3, 'Pangoa,Pangoa', 'Pendiente'),
(9, NULL, NULL, NULL, 1, '2024-01-16 15:46:54', 0.00, 22.00, 3, 'pangoa,pangoa', 'Pendiente'),
(10, NULL, NULL, NULL, 9, '2024-01-20 21:41:34', 0.00, 315.00, 3, 'Pangoa,Pangoa', 'Pendiente'),
(11, 'Yapeo Completo', NULL, NULL, 10, '2024-01-20 21:44:22', 0.00, 340.00, 3, 'Pangoa,Pangoa', 'Completo'),
(12, NULL, NULL, NULL, 1, '2024-01-22 18:46:27', 0.00, 230.00, 2, 'pangoa,pangoa', 'Pendiente');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permisos`
--

CREATE TABLE `permisos` (
  `idpermiso` bigint(20) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `moduloid` bigint(20) NOT NULL,
  `r` int(11) NOT NULL DEFAULT 0,
  `w` int(11) NOT NULL DEFAULT 0,
  `u` int(11) NOT NULL DEFAULT 0,
  `d` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `permisos`
--

INSERT INTO `permisos` (`idpermiso`, `rolid`, `moduloid`, `r`, `w`, `u`, `d`) VALUES
(3, 1, 1, 1, 1, 1, 1),
(4, 1, 2, 1, 1, 1, 1),
(5, 1, 3, 1, 1, 1, 1),
(6, 1, 4, 1, 1, 1, 1),
(7, 1, 5, 1, 1, 1, 1),
(8, 1, 6, 1, 1, 1, 1),
(9, 1, 7, 1, 1, 1, 1),
(10, 1, 8, 1, 1, 1, 1),
(11, 1, 9, 1, 1, 1, 1),
(12, 2, 1, 1, 1, 1, 1),
(13, 2, 2, 0, 0, 0, 0),
(14, 2, 3, 1, 1, 1, 0),
(15, 2, 4, 1, 1, 1, 0),
(16, 2, 5, 1, 1, 1, 0),
(17, 2, 6, 1, 1, 1, 0),
(18, 2, 7, 1, 0, 0, 0),
(19, 2, 8, 1, 0, 0, 0),
(20, 2, 9, 1, 1, 1, 1),
(30, 3, 1, 1, 0, 0, 0),
(31, 3, 2, 0, 0, 0, 0),
(32, 3, 3, 0, 0, 0, 0),
(33, 3, 4, 0, 0, 0, 0),
(34, 3, 5, 1, 0, 0, 0),
(35, 3, 6, 0, 0, 0, 0),
(36, 3, 7, 0, 0, 0, 0),
(37, 3, 8, 0, 0, 0, 0),
(38, 3, 9, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `persona`
--

CREATE TABLE `persona` (
  `idpersona` bigint(20) NOT NULL,
  `identificacion` varchar(30) NOT NULL,
  `nombres` varchar(80) NOT NULL,
  `apellidos` varchar(100) NOT NULL,
  `telefono` bigint(20) NOT NULL,
  `email_user` varchar(100) NOT NULL,
  `password` varchar(75) NOT NULL,
  `dni` varchar(20) NOT NULL,
  `nombrefiscal` varchar(80) NOT NULL,
  `direccionfiscal` varchar(100) NOT NULL,
  `token` varchar(100) NOT NULL,
  `rolid` bigint(20) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `persona`
--

INSERT INTO `persona` (`idpersona`, `identificacion`, `nombres`, `apellidos`, `telefono`, `email_user`, `password`, `dni`, `nombrefiscal`, `direccionfiscal`, `token`, `rolid`, `datecreated`, `status`) VALUES
(1, '1153684', 'Stive Esau', 'Roncal Quintimari', 934027842, 'stiveroncal@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '72560007', 'Stive Esau Roncal Quintimari', 'Calle 28 de Julio Nro. 725 San Martín de Pangoa', '', 1, '2023-12-14 12:16:43', 1),
(2, '1153681', 'Samuel David', 'Prudencio Parado', 900530894, 'samprudencio3@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', '', '', '', 2, '2023-12-14 15:37:11', 1),
(3, '1253657489', 'Esau Edward', 'Roncal Hidalgo', 943932233, 'nsssroncal@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', '', '', '', 3, '2023-12-20 10:13:38', 1),
(4, '568555555', 'Dads', 'Saddas', 98563236, 'edward@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '20568458555', 'Corporacion de electrificacion SAC', 'Calle las Malvinas Lima - Lima - Lima', '', 3, '2023-12-20 10:22:56', 1),
(8, '', 'Stive Edward', 'Roncal Torres', 99969999, 'nsronweqewcal@gmal.com', '1c6563dd47fe168d5d450134f052002abaf4a6e217a0988468f84b740977118f', '', '', '', '', 3, '2024-01-12 19:22:04', 1),
(9, '', 'Edward', 'Newgate', 985632568, 'nsronsssscal@gmail.com', 'bc7bc444aa3967498443a787ecbdaef3e01cb44f6b5a0f0b0370033eafa4e517', '', '', '', '', 3, '2024-01-20 21:41:11', 1),
(10, '68522222332', 'Edward', 'Newgate', 985698569, 'nsronsdasdcal@gmail.com', '15e2b0d3c33891ebb0f1ef609ec419420c20e320ce94c65fbc8c3312448eb225', '', '', '', '', 3, '2024-01-20 21:44:00', 1),
(11, '', 'Ffdsfsdf', 'Fdsfdsfdfsd', 54353456345, 'nsroncal@gmail.com', '626296b69a2cc8cd6994f8819d90a73a8233eaedc2bef3bdf9882fd8aa6872f0', '', '', '', '', 3, '2024-01-25 13:26:40', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post`
--

CREATE TABLE `post` (
  `idpost` bigint(20) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `contenido` text NOT NULL,
  `portada` varchar(255) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `post`
--

INSERT INTO `post` (`idpost`, `titulo`, `contenido`, `portada`, `datecreated`, `ruta`, `status`) VALUES
(1, 'Inicio', '<div class=\"p-t-80\"> <h1 class=\"ltext-103 cl5\">Nuestras Marcas</h1> </div> <p>&nbsp;</p> <div> <p>Trabajamos Con las Mejores Marcas Nacionales e Internacionales</p> </div> <p>&nbsp;</p> <div class=\"row\"> <div class=\"col-md-3\"><img src=\"Assets/images/sti.png\" alt=\"Marca 1\" width=\"110\" height=\"110\" /></div> <div class=\"col-md-3\"><img src=\"Assets/images/indeco.png\" alt=\"Marca 2\" width=\"110\" height=\"110\" /></div> <div class=\"col-md-3\"><img src=\"Assets/images/hk.png\" alt=\"Marca 3\" width=\"110\" height=\"110\" /></div> <div class=\"col-md-3\"><img src=\"Assets/images/nicol.png\" alt=\"Marca 4\" width=\"110\" height=\"110\" /></div> </div>', '', '2023-12-04 12:30:38', 'inicio', 1),
(2, 'Tienda', '<p>Contenido de P&aacute;gina</p>', '', '2023-12-04 12:30:57', 'tienda', 1),
(3, 'Carrito', '<p>Contenido de Pagina</p>', '', '2023-12-04 12:31:32', 'carrito', 1),
(4, 'Nosotros', '<section class=\"bg0 p-t-75 p-b-120\"> <div class=\"container\"> <div class=\"row p-b-148\"> <div class=\"col-md-7 col-lg-8\"> <div class=\"p-t-7 p-r-85 p-r-15-lg p-r-0-md\"> <h3 class=\"mtext-111 cl2 p-b-16\">&iquest;Qui&eacute;nes Somos?</h3> <p class=\"stext-113 cl6 p-b-26\">Fundada en 2015, Somos una Empresa Dedicada al Servicio y Ventas de Materiales de Instalaci&oacute;n Electricas en la Ciudad de San Martin de Pangoa, Ofrecemos Productos de Alta Calidad y Marcas reconocidas a nivel Nacional e Internacional</p> <h3 class=\"mtext-111 cl2 p-b-16\">Ofrecemos:</h3> <ul> <li>Instalacion El&eacute;ctricas E Industriales</li> <li>Instalaci&oacute;n de Tableros Industriales</li> <li>Montaje y Mantenimiento de motores El&eacute;ctricos</li> <li>Instalaci&oacute;n de Puesta a Tierra Domestica e Industrial, Medicion y Mantenimiento</li> <li>Instalaci&oacute;n de Camaras de Seguridad</li> <li>Instalaciones de Luces Led Neon, Rgb, Pixel , ect.</li> </ul> </div> </div> <div class=\"col-11 col-md-5 col-lg-4 m-lr-auto\"> <div class=\"how-bor1 \"> <div class=\"hov-img0\" style=\"border: 1px solid #ccc;\"><img src=\"Assets/images/RoncalStive.jpg\" alt=\"IMG\" width=\"500\" height=\"333\" /></div> </div> </div> </div> <div class=\"row\"> <div class=\"order-md-2 col-md-7 col-lg-8 p-b-30\"> <div class=\"p-t-7 p-l-85 p-l-15-lg p-l-0-md\"> <h3 class=\"mtext-111 cl2 p-b-16\">Nuestra Misi&oacute;n</h3> <p class=\"stext-113 cl6 p-b-26\">Satisfacer las necesidades de la comunidad local y nacional en la comercializaci&oacute;n de materiales para la construcci&oacute;n, la industria y el hogar, con la mejor calidad, garant&iacute;a y al menor precio, a trav&eacute;s de la excelencia en el servicio al cliente</p> <div class=\"bor16 p-l-29 p-b-9 m-t-22\"> <p class=\"stext-114 cl6 p-r-40 p-b-11\">La Creatividad es simplemente conectar cosas. Cuando le Preguntas a las personas creativas c&oacute;mo hicieron algo, se sienten un poco culpables, porque en realidad no lo hizieron, simplemente vieron algo. Algo que despu&eacute;s de alg&uacute;n tiempo, les pareci&oacute; obvio</p> <span class=\"stext-111 cl8\"> - Steve Job&rsquo;s </span></div> </div> </div> <div class=\"order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30\"> <div class=\"how-bor2\"> <div class=\"hov-img0\"><img src=\"https://visionempresa.club/wp-content/uploads/2020/06/cu%C3%A1l-es-la-misi%C3%B3n-de-una-empresa.jpg\" alt=\"IMG\" width=\"500\" height=\"333\" /></div> </div> </div> </div> </div> </section>', 'img_88a8f5600090570cf93af392b891310e.jpg', '2023-12-04 12:32:06', 'nosotros', 1),
(5, 'Contacto', '<div class=\"map\"><iframe style=\"border: 0;\" src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d345.66267576032374!2d-74.48989884597513!3d-11.427368045426872!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x910b918310606b87%3A0xfa7c96474b474d11!2sNEGOCIOS%20Y%20SERVICIOS%20RONCAL%20E.I.R.L!5e0!3m2!1ses-419!2spe!4v1702254753993!5m2!1ses-419!2spe\" width=\"100%\" height=\"600\" allowfullscreen=\"allowfullscreen\" loading=\"lazy\"></iframe></div>', 'img_2b509f7f3c204ab7ee91e065f13ac54b.jpg', '2023-12-04 12:32:46', 'contacto', 1),
(6, 'Preguntas Frecuentes', '<ol> <li><strong>&iquest;Cu&aacute;l es el Tiempo de entrega de los Productos?</strong> Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam esse autem quasi aut est mollitia inventore, maiores voluptas, cum minus earum dicta sunt nulla error harum, molestiae nisi repudiandae. Exercitationem?</li> <li><strong>&iquest;Como es la Forma de Envi&oacute; de los Productos?</strong>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo, eos illum, optio, consectetur in necessitatibus repellendus enim laboriosam ratione iure natus doloremque velit mollitia aut. Sequi sunt praesentium quaerat voluptates. Ipsum nobis expedita pariatur qui facere, maxime magni vero, accusantium inventore adipisci assumenda ratione ducimus voluptatibus. Rerum nesciunt, tempore corrupti nisi autem voluptate magni eum culpa eveniet quae nulla accusantium.</li> <li><strong>&iquest;Cu&aacute;l es el Tiempo maximo para solicitar un Reembolso? </strong>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo, eos illum, optio, consectetur in necessitatibus repellendus enim laboriosam ratione iure natus doloremque velit mollitia aut. Sequi sunt praesentium quaerat voluptates. Ipsum nobis expedita pariatur qui facere, maxime magni vero, accusantium inventore adipisci assumenda ratione ducimus voluptatibus. Rerum nesciunt, tempore corrupti nisi autem voluptate magni eum culpa eveniet quae nulla accusantium</li> </ol> <p>Otras Preguntas</p> <ul> <li><strong>&iquest;Que Formas de Pago Aceptan?</strong> Lorem ipsum dolor sit, amet consectetur adipisicing elit. Illo, eos illum, optio, consectetur in necessitatibus repellendus enim laboriosam ratione iure natus doloremque velit mollitia aut. Sequi sunt praesentium quaerat voluptates. Ipsum nobis expedita pariatur qui facere, maxime magni vero, accusantium inventore adipisci assumenda ratione ducimus voluptatibus. Rerum nesciunt, tempore corrupti nisi autem voluptate magni eum culpa eveniet quae nulla accusantium.</li> </ul>', '', '2023-12-04 12:33:33', 'preguntas-frecuentes', 1),
(7, 'Términos y Condiciones', '<h1>A Continuaci&oacute;n Se Describre Los Terminos y Condiciones</h1> <ol> <li>Politica Uno</li> <li>Politica Dos</li> <li>Politica Tres</li> </ol> <p>is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum</p>', '', '2023-12-04 15:50:00', 'terminos-y-condiciones', 1),
(8, 'Sucursales', '<section class=\"py-5 text-center\"> <div class=\"container\"> <p>Visitamos y Obten Los Mejores precios del Mercado, Cualquier art&iacute;culo que necesitas para Vivir Mejor</p> <a class=\"btn btn-info\" href=\"../../tienda_virtual_demo/tienda\">VER PRODUCTO</a></div> </section> <div class=\"py-5 bg-light\"> <div class=\"container\"> <div class=\"row\"> <div class=\"col-md-6\"> <div class=\"card mb-4 box-shadow how-img0\"><img src=\"https://lh3.googleusercontent.com/p/AF1QipP_Yy2WwgNUAU6WaZ6vXspY9hyxoekCdhhlVPno=s1360-w1360-h1020\" alt=\"\" width=\"100%\" height=\"100%\" /> <div class=\"card-body\"> <p class=\"card-text\">Sede Principal San Martin de Pangoa</p> <p>Direci&oacute;n: Calle 28 de Julio Nro. 725 San Martin de Pangoa <br />Telefono: 934027842 <br />Correo: stiveroncal@gmail.com</p> </div> </div> </div> <! Carta 3 > <div class=\"col-md-6\"> <div class=\"card mb-4 box-shadow how-img0\"><img src=\"https://scontent.flim6-4.fna.fbcdn.net/v/t39.30808-6/347392840_269560565526770_7041754731561035376_n.jpg?_nc_cat=105&amp;ccb=1-7&amp;_nc_sid=783fdb&amp;_nc_eui2=AeHaZTE2lcOCeEVCz5eaFGmHc-k5Kx1kwApz6TkrHWTACmgnegwWdsfc15Uxi8NJbupb-omp435QLcJQoszIQthm&amp;_nc_ohc=UnBjqboiez4AX9bKjeX&amp;_nc_ht=scontent.flim6-4.fna&amp;oh=00_AfAzx_JbGi0vgrCeDYkbhRS6vT7IGg_ZyTPNorsBWwLwFg&amp;oe=657AD3D4\" alt=\"\" width=\"100%\" height=\"100%\" /> <div class=\"card-body\"> <p class=\"card-text\">Sede en Mercado Costa Verde</p> <p>Direci&oacute;n: Av. 3 de Noviembre Pangoa<br />Telefono: 900530894<br />Correo: simonpetrikov@gmail.com</p> </div> </div> </div> </div> </div> </div>', 'img_11bfa939e9230ff27e2213276ce46bdb.jpg', '2023-12-04 16:01:20', 'sucursales', 1),
(9, 'Not Found', '<h1>Error 404: P&aacute;gina no Encontrada</h1> <p>No se Encuentra la P&aacute;gina que ha Solicitado</p>', '', '2023-12-04 22:37:23', 'not-found', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `idproducto` bigint(20) NOT NULL,
  `categoriaid` bigint(20) NOT NULL,
  `codigo` varchar(30) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `precio` decimal(11,2) NOT NULL,
  `stock` int(11) NOT NULL,
  `imagen` varchar(100) DEFAULT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp(),
  `ruta` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`idproducto`, `categoriaid`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `datecreated`, `ruta`, `status`) VALUES
(1, 3, '000001', 'TOMACORRIENTE TRIPLE UNIVERSAL BTICINO DOMINIO AVANT 2P 16A 250V 3 MODULOS MODELO P96', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval SobrePuesta</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">3</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 18.00, 12, '', '2023-12-14 17:02:41', 'tomacorriente-triple-universal-bticino-dominio-avant-2p-16a-250v-3-modulos-modelo-p96', 1),
(2, 3, '000002', 'TOMACORRIENTE DOBLE CON LINEA TIERRA UNIVERSAL DOMINIO SENCIA(Con Alveolos Protegidos) 16A 250V', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Empotrado</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">3</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">AP1222</td> </tr> </tbody> </table>', 22.00, 8, '', '2023-12-14 17:16:29', 'tomacorriente-doble-con-linea-tierra-universal-dominio-sencia(con-alveolos-protegidos)-16a-250v', 1),
(3, 3, '000003', 'INTERRUPTOR SIMPLE BTICINO 10A 250V de 1 módulo Oval SobrePuestas', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; height: 344px;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; height: 43px;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">Oval SobrePuesta</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; height: 43px;\">10A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; height: 43px;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">P52</td> </tr> </tbody> </table>', 8.00, 10, '', '2023-12-14 17:28:50', 'interruptor-simple-bticino-10a-250v-de-1-modulo-oval-sobrepuestas', 1),
(4, 3, '000004', 'TOMACORRIENTE UNIVERSAL BTICINO 2P 16A 250V 1 MÓDULO', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial; height: 344px;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; height: 43px;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">Oval SobrePuesta</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; height: 43px;\">10A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; height: 43px;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9; height: 43px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9; height: 43px;\">P56</td> </tr> </tbody> </table>', 8.00, 15, NULL, '2023-12-20 09:56:42', 'tomacorriente-universal-bticino-2p-16a-250v-1-modulo', 1),
(5, 3, '000005', 'TOMACORRIENTE BTICINO II UNIVERSAL EMPOTRADA DOMINIO SENCIA', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 18.00, 20, NULL, '2024-01-19 17:02:20', 'tomacorriente-bticino-ii-universal-empotrada-dominio-sencia', 1),
(6, 3, '000006', 'TOMACORRIENTE BTICINO I UNIVERSAL EMPOTRADO DOMINIO SENCIA', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 13.00, 20, NULL, '2024-01-19 17:14:44', 'tomacorriente-bticino-i-universal-empotrado-dominio-sencia', 1),
(7, 3, '000007', 'INTERRUPTOR I EMPOTRADO BTICINO DOMINIO SENCIA', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 13.00, 20, NULL, '2024-01-19 17:21:27', 'interruptor-i-empotrado-bticino-dominio-sencia', 1);
INSERT INTO `producto` (`idproducto`, `categoriaid`, `codigo`, `nombre`, `descripcion`, `precio`, `stock`, `imagen`, `datecreated`, `ruta`, `status`) VALUES
(8, 3, '000008', 'INTERRUPTOR II EMPOTRADO BTICINO DOMINIO SENCIA', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 17.00, 30, NULL, '2024-01-19 17:29:07', 'interruptor-ii-empotrado-bticino-dominio-sencia', 1),
(9, 3, '000009', 'INTERRUPTOR II EMPOTRADO BTICINO DOMINIO AVANT', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 16.00, 20, NULL, '2024-01-19 18:12:48', 'interruptor-ii-empotrado-bticino-dominio-avant', 1),
(10, 3, '000010', 'INTERRUPTOR I EMPOTRADO BTICINO DOMINIO AVANT', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 11.00, 25, NULL, '2024-01-19 18:20:41', 'interruptor-i-empotrado-bticino-dominio-avant', 1),
(11, 3, '000011', 'TOMA COAXIAL TV DOMINIO AVANT', '<p>&nbsp;</p> <table class=\"group Ficha-Tecnica table -striped text fz-15\" style=\"box-sizing: border-box; margin: 0px auto; width: 133px; display: table; border-collapse: collapse; border-spacing: 0px; font-size: 15px !important; line-height: 1.2; color: #444444; font-family: Archivo, sans-serif; font-style: normal; font-variant-ligatures: normal; font-variant-caps: normal; font-weight: 300; letter-spacing: normal; text-align: start; text-transform: none; word-spacing: 0px; -webkit-text-stroke-width: 0px; white-space: normal; background-color: #ffffff; text-decoration-thickness: initial; text-decoration-style: initial; text-decoration-color: initial;\" cellspacing=\"0\"> <tbody style=\"box-sizing: border-box;\"> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Modelo\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Marca</h2> </th> <td class=\"value-field Modelo\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Bticino</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Color\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Color</h2> </th> <td class=\"value-field Color\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">Marfil</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Compatibilidad\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tipo</h2> </th> <td class=\"value-field Compatibilidad\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">Oval</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Tipo-de-Producto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Corriente Maxima</h2> </th> <td class=\"value-field Tipo-de-Producto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">16A</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Alto\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Tension Maxima</h2> </th> <td class=\"value-field Alto\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">250V</td> </tr> <tr style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Ancho\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Modulos</h2> </th> <td class=\"value-field Ancho\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777;\">1</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Nro Polo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">2</td> </tr> <tr class=\"even\" style=\"box-sizing: border-box; vertical-align: top; text-align: left; display: flex; justify-content: center; background: 0px 0px;\"> <th class=\"name-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; width: 186.5px; background: #f9f9f9;\"> <h2 style=\"box-sizing: border-box; margin: 0px; padding: 0px; line-height: 1.2; color: #444444; font-weight: bold; font-size: 15px;\">Modelo</h2> </th> <td class=\"value-field Profundidad-de-las-sillas\" style=\"box-sizing: border-box; width: 239.5px; display: table-cell; padding: 12px 8px 12px 20px; font-size: 15px; color: #777777; background: #f9f9f9;\">P96</td> </tr> </tbody> </table>', 20.00, 30, NULL, '2024-01-19 18:25:49', 'toma-coaxial-tv-dominio-avant', 1),
(12, 3, '000012', 'SOCKET BTICINO OVAL', '<p>-Marca: Bticino</p> <p>-Modelo: Oval</p>', 10.00, 50, NULL, '2024-01-19 19:01:11', 'socket-bticino-oval', 1),
(13, 3, '000013', 'SOCKET BTICINO PLAFON BTICINO', '<p>-Sokete Plafon Bticino</p>', 12.00, 50, NULL, '2024-01-19 19:06:25', 'socket-bticino-plafon-bticino', 1),
(14, 4, '000014', 'ROUTER D-LINK DIR 615 WIRELESS N300', '<p>Router D-Link</p>', 85.00, 4, NULL, '2024-01-19 19:21:40', 'router-d-link-dir-615-wireless-n300', 1),
(15, 3, '000015', 'TOMACORRIENTE II CON LINEA TIERRA BTICINO DOMINIO AVANT', '<p>-Marca: Bticino</p>', 16.00, 25, NULL, '2024-01-19 21:23:17', 'tomacorriente-ii-con-linea-tierra-bticino-dominio-avant', 1),
(16, 4, '000016', 'MOUSE TEROS TE-5074 INALAMBRICO 1,600 DPI NEGRO', '<p>-Mouse Inalambrico</p>', 35.00, 5, NULL, '2024-01-19 23:03:47', 'mouse-teros-te-5074-inalambrico-1600-dpi-negro', 1),
(17, 4, '000017', 'MOUSE GAMING TEROS TE-5168N', '<p>Marca: Teros</p>', 85.00, 2, NULL, '2024-01-19 23:18:25', 'mouse-gaming-teros-te-5168n', 1),
(18, 3, '000018', 'CINTA VULCANIZANTE 3M SCOTCH', '<p>-Marca: 3M</p>', 35.00, 4, NULL, '2024-01-20 10:45:59', 'cinta-vulcanizante-3m-scotch', 1),
(19, 3, '000019', 'CINTA AISLANTE 3M 155', '<p>&nbsp;</p> <p>-Marca: 3M</p>', 5.00, 15, NULL, '2024-01-20 10:50:18', 'cinta-aislante-3m-155', 1),
(20, 3, '000020', 'ENCHUFE PLANO VISION', '<p>&nbsp;</p> <p>-Marca: Vision</p>', 4.00, 52, NULL, '2024-01-20 11:04:31', 'enchufe-plano-vision', 1),
(21, 3, '000021', 'LLAVE TERMICA STRONGER MONOFASICO 2x10AMP', '<p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:18:57', 'llave-termica-stronger-monofasico-2x10amp', 1),
(22, 3, '000022', 'LLAVE TERMICA STRONGER MONOFASICO 2x16AMP', '<p>&nbsp;</p> <p>-Marca: Stronger New Era</p>', 18.00, 12, NULL, '2024-01-20 11:39:50', 'llave-termica-stronger-monofasico-2x16amp', 1),
(23, 3, '000023', 'LLAVE TERMICA MONOFASICO STRONGER 2x20AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:40:40', 'llave-termica-monofasico-stronger-2x20amp', 1),
(24, 3, '000024', 'LLAVE TERMICA MONOFASICO STRONGER 2x25AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:41:04', 'llave-termica-monofasico-stronger-2x25amp', 1),
(25, 3, '000025', 'LLAVE TERMICA STRONGER MONOFASICO 2x32AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:41:32', 'llave-termica-stronger-monofasico-2x32amp', 1),
(26, 3, '000026', 'LLAVE TERMICA STRONGER MONOFASICO 2x40AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:42:29', 'llave-termica-stronger-monofasico-2x40amp', 1),
(27, 3, '000027', 'LLAVE TERMICA STRONGER MONOFASICO 2x50AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:42:53', 'llave-termica-stronger-monofasico-2x50amp', 1),
(28, 3, '000028', 'LLAVE TERMICA STRONGER MONOFASICO 2x63AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 18.00, 12, NULL, '2024-01-20 11:48:06', 'llave-termica-stronger-monofasico-2x63amp', 1),
(29, 3, '000029', 'LLAVE TERMICA STRONGER TRIFASICO 3x16AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 40.00, 6, NULL, '2024-01-20 13:28:14', 'llave-termica-stronger-trifasico-3x16amp', 1),
(30, 3, '000030', 'LLAVE TERMICA STRONGER TRIFASICO 3x20AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 40.00, 6, NULL, '2024-01-20 13:31:46', 'llave-termica-stronger-trifasico-3x20amp', 1),
(31, 3, '000031', 'LLAVE TERMICA STRONGER TRIFASICO 3x25AMP', '<p>&nbsp;</p> <p>-Marca: stronger</p>', 40.00, 12, NULL, '2024-01-20 13:38:47', 'llave-termica-stronger-trifasico-3x25amp', 1),
(32, 3, '000032', 'LLAVE TERMICA STRONGER TRIFASICO 3x32AMP', '<p>&nbsp;</p> <p>-Marca: Stronger</p>', 40.00, 6, NULL, '2024-01-20 13:39:39', 'llave-termica-stronger-trifasico-3x32amp', 1),
(33, 3, '000033', 'LLAVE TERMICA STRONGER TRIFASICO 3x40AMP', '<p>&nbsp;</p> <p>-Marca Stronger</p>', 40.00, 12, NULL, '2024-01-20 13:40:09', 'llave-termica-stronger-trifasico-3x40amp', 1),
(34, 3, '000034', 'CUTER', '<p>&nbsp;</p> <p>-Accesorio de Corte</p>', 1.00, 150, NULL, '2024-01-20 13:54:42', 'cuter', 1),
(35, 3, '000035', 'ROLLO CABLE INDECO NRO 14 AWG TW-80 PLUS', '<p>&nbsp;</p> <p>-Marca: Indeco</p>', 150.00, 3, NULL, '2024-01-20 15:02:20', 'rollo-cable-indeco-nro-14-awg-tw-80-plus', 1),
(36, 3, '000036', 'ROLLO CABLE INDECO NRO 12 AWG TW-80 PLUS', '<p>&nbsp;</p> <p>-Marca: Indeco</p>', 230.00, 5, NULL, '2024-01-20 15:11:48', 'rollo-cable-indeco-nro-12-awg-tw-80-plus', 1),
(37, 3, '000037', 'CONECTOR AB MEDIA PULGADA', '<p>&nbsp;</p> <p>-Conector AB para Varilla de Cobre</p>', 8.00, 10, NULL, '2024-01-20 17:52:20', 'conector-ab-media-pulgada', 1),
(38, 3, '000038', 'CONECTO AB CINCO OCTAVOS PULGADA', '<p>&nbsp;</p> <p>-Conecto de 5/8\" Para Varilla de Cobre</p>', 10.00, 15, NULL, '2024-01-20 18:10:33', 'conecto-ab-cinco-octavos-pulgada', 1),
(39, 3, '000039', 'VARILLA DE COBRE DE MEDIA PULGADA', '<p>&nbsp;</p> <p>-Dimensiones:&nbsp; 3/4 x 2,40 mt</p>', 220.00, 3, NULL, '2024-01-20 19:31:43', 'varilla-de-cobre-de-media-pulgada', 1),
(40, 3, '000040', 'VARILLA DE COBRE DE QUINTO OCTAVOS PULGADA', '<p>&nbsp;</p> <p>-Dimensiones: 5/8 x 2,40 mts</p>', 280.00, 1, NULL, '2024-01-20 19:33:38', 'varilla-de-cobre-de-quinto-octavos-pulgada', 1),
(41, 3, '000041', 'CAJA DE REGISTRO PARA PUESTA A TIERRA DE CONCRETO', '<p>&nbsp;</p> <p>-Caja de Registro para Puesta a Tierra</p>', 60.00, 5, NULL, '2024-01-22 09:32:04', 'caja-de-registro-para-puesta-a-tierra-de-concreto', 1),
(42, 3, '000042', 'CAJA DE REGISTRO PARA PUESTA TIERRA PVC', '<p>&nbsp;</p> <p>-Caja de Registro de PVC</p>', 75.00, 2, NULL, '2024-01-22 09:33:58', 'caja-de-registro-para-puesta-tierra-pvc', 1),
(43, 3, '000043', 'CABLE DESNUDO DE COBRE DE 25MM² x 10 Metros', '<p>&nbsp;</p> <p>-Metros: 10 Metros</p> <p>-Medida: 25mm&sup2;</p>', 180.00, 3, NULL, '2024-01-22 09:42:47', 'cable-desnudo-de-cobre-de-25mm²-x-10-metros', 1),
(44, 3, '000044', 'BENTONITA SODICA DE 30KG', '<p>&nbsp;</p> <p>-Peso: 30 KG</p>', 55.00, 6, NULL, '2024-01-22 09:51:23', 'bentonita-sodica-de-30kg', 1),
(45, 3, '000045', 'THOR GEL CONDUCTIVO', '<p>&nbsp;</p> <p>-Peso: 5KG</p>', 120.00, 5, NULL, '2024-01-22 09:56:55', 'thor-gel-conductivo', 1),
(46, 3, '000046', 'CEMENTO CONDUCTIVO 25KG', '<p>&nbsp;</p> <p>-Peso: 25KG</p>', 95.00, 12, NULL, '2024-01-22 10:20:25', 'cemento-conductivo-25kg', 1),
(47, 3, '000047', 'PAQUETE CINTA AISLANTE 3M 155', '<p>&nbsp;</p> <p>-Marca: 3M</p> <p>-Cantidad: 10 Unidades</p>', 48.00, 8, NULL, '2024-01-24 19:34:49', 'paquete-cinta-aislante-3m-155', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reembolso`
--

CREATE TABLE `reembolso` (
  `id` bigint(20) NOT NULL,
  `pedidoid` bigint(20) NOT NULL,
  `idtransaccion` varchar(225) NOT NULL,
  `datosreembolso` text NOT NULL,
  `observacion` text NOT NULL,
  `status` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `idrol` bigint(20) NOT NULL,
  `nombrerol` varchar(50) NOT NULL,
  `descripcion` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`idrol`, `nombrerol`, `descripcion`, `status`) VALUES
(1, 'Administrador', 'Acceso a Todo El Sistema', 1),
(2, 'Supervisor', 'Supervisor de Tiendas', 1),
(3, 'Cliente', 'Clientes en General', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suscripciones`
--

CREATE TABLE `suscripciones` (
  `idsuscripcion` bigint(20) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `datecreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `suscripciones`
--

INSERT INTO `suscripciones` (`idsuscripcion`, `nombre`, `email`, `datecreated`) VALUES
(1, 'Sadadsdsaasd', 'aaaaa@gmail.com', '2024-01-15 16:57:07');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `idtipopago` bigint(20) NOT NULL,
  `tipopago` varchar(100) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`idtipopago`, `tipopago`, `status`) VALUES
(1, 'Paypal', 1),
(2, 'Efectivo', 1),
(3, 'Yape ', 1),
(4, 'Transferencia Bancaria', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`),
  ADD KEY `personaid` (`personaid`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productoid` (`productoid`);

--
-- Indices de la tabla `modulo`
--
ALTER TABLE `modulo`
  ADD PRIMARY KEY (`idmodulo`);

--
-- Indices de la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `personaid` (`personaid`),
  ADD KEY `tipopagoid` (`tipopagoid`);

--
-- Indices de la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD PRIMARY KEY (`idpermiso`),
  ADD KEY `rolid` (`rolid`),
  ADD KEY `moduloid` (`moduloid`);

--
-- Indices de la tabla `persona`
--
ALTER TABLE `persona`
  ADD PRIMARY KEY (`idpersona`),
  ADD KEY `rolid` (`rolid`);

--
-- Indices de la tabla `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`idpost`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `categoriaid` (`categoriaid`);

--
-- Indices de la tabla `reembolso`
--
ALTER TABLE `reembolso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pedidoid` (`pedidoid`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`idrol`);

--
-- Indices de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  ADD PRIMARY KEY (`idsuscripcion`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`idtipopago`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `idcategoria` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=129;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `modulo`
--
ALTER TABLE `modulo`
  MODIFY `idmodulo` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pedido`
--
ALTER TABLE `pedido`
  MODIFY `idpedido` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `permisos`
--
ALTER TABLE `permisos`
  MODIFY `idpermiso` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `persona`
--
ALTER TABLE `persona`
  MODIFY `idpersona` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `post`
--
ALTER TABLE `post`
  MODIFY `idpost` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `idproducto` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `reembolso`
--
ALTER TABLE `reembolso`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `idrol` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `suscripciones`
--
ALTER TABLE `suscripciones`
  MODIFY `idsuscripcion` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `idtipopago` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_temp`
--
ALTER TABLE `detalle_temp`
  ADD CONSTRAINT `detalle_temp_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD CONSTRAINT `imagen_ibfk_1` FOREIGN KEY (`productoid`) REFERENCES `producto` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedido`
--
ALTER TABLE `pedido`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`personaid`) REFERENCES `persona` (`idpersona`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`tipopagoid`) REFERENCES `tipopago` (`idtipopago`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `permisos`
--
ALTER TABLE `permisos`
  ADD CONSTRAINT `permisos_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permisos_ibfk_2` FOREIGN KEY (`moduloid`) REFERENCES `modulo` (`idmodulo`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `persona`
--
ALTER TABLE `persona`
  ADD CONSTRAINT `persona_ibfk_1` FOREIGN KEY (`rolid`) REFERENCES `rol` (`idrol`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`categoriaid`) REFERENCES `categoria` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reembolso`
--
ALTER TABLE `reembolso`
  ADD CONSTRAINT `reembolso_ibfk_1` FOREIGN KEY (`pedidoid`) REFERENCES `pedido` (`idpedido`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
