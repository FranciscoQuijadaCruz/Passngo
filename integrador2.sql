-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-05-2018 a las 23:11:35
-- Versión del servidor: 10.1.30-MariaDB
-- Versión de PHP: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `integrador2`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comentario` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `rating` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`id`, `correo`, `nombre`, `comentario`, `rating`) VALUES
(1, 'Mid@hotmail.com', 'Pepe Toño Mid', 'Soy Jose Antonio Mid Me gusto su app #PRI2018', 4),
(2, 'rcanaya@hotmail.com', 'Ricardinho Anaya', 'Ur app is insultin n unnaceptabol #PorMexicoAlFrente', 2),
(3, 'amlover@hotmail.com', 'AMLO roso', 'Con tu voto lo vamoj a lograj #JuntosHacemosHistoria', 4),
(4, 'conchaduende@hotmail.com', 'Margarita Tzabalah', 'E e e e sta ta ta ta app app app esta buena, se lo dire a a m mi e e espo po so #Zavala2018', 5),
(5, 'elbronquiza@hotmail.com', 'El Bronco Rodriguez', 'Una barbaridad, le mochare las manos raza #Bronco2018', 1),
(6, 'conchaduende@hotmail.com', 'Margarita Tzabalah', 'E e e e sta ta ta ta app app app esta buena, se lo dire a a m mi e e espo po so #Zavala2018', 4),
(7, 'elbronquiza@hotmail.com', 'El Bronco Rodriguez', 'Una barbaridad, le mochare las manos raza #Bronco2018', 1),
(8, 'markzukritaz@gmail.com', 'Marcus Zucaritas', 'Grrrr riquisimas ;D salu2 raza', 5),
(9, 'jlvh1996@gmail.com', 'Jose Luis Vega Herrera', 'Soy el Chito y esta app es la onda ;D', 4),
(10, 'thanoseldealtata@gmail.com', 'Thanos DeNigris', 'Mala app... los convertire en polvo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `evento`
--

CREATE TABLE `evento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` enum('Conciertos','Deportes','Teatro','Popular','Especial') COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('Electronica','Rock/Metal','Musica regional','Festivales','Pop','Expo regionales','Ferias','Palenques','Teatro','Football','Baseball','Basketball','Circos','Musicales') COLLATE utf8_unicode_ci NOT NULL,
  `artistaOGrupo` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `lugar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `localidad` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `numBoletos` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precioVip` float(10,2) NOT NULL,
  `latitud` decimal(10,7) NOT NULL,
  `longitud` decimal(10,7) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `evento`
--

INSERT INTO `evento` (`id`, `nombre`, `categoria`, `tipo`, `artistaOGrupo`, `fecha`, `hora`, `lugar`, `localidad`, `descripcion`, `imagen`, `numBoletos`, `precio`, `precioVip`, `latitud`, `longitud`, `dateCreated`, `dateUpdated`) VALUES
(2, 'Los Cafres en la O', 'Conciertos', 'Rock/Metal', 'Los cafres', '2018-04-27', '22:00:00', 'Arena ITSON', 'Cd. Obregon, SON', 'Un evento bien shidori', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Los_Cafres_%282014%29.jpg/1024px-Los_Cafres_%282014%29.jpg', '5000', 500.00, 900.00, '27.4936153', '-109.9743303', '2018-04-26 15:20:04', '2018-05-06 19:17:46'),
(3, 'Matisse en Obregón', 'Conciertos', 'Pop', 'Matisse', '2018-04-27', '22:00:00', 'Arena ITSON', 'Cd. Obregon, SON', 'Matisse es un grupo musical mexicano de pop en español creado en 2014. El grupo está conformado por Melissa Robles, Pablo Preciado y Román Torres. El nombre Matisse fue adoptado por el grupo después de que Pablo y Román percibieran', 'https://cde.publimetro.e3.pe/ima/0/0/1/2/5/125281.jpg', '2000', 500.00, 900.00, '27.4936153', '-109.9743303', '2018-04-26 15:21:52', '2018-05-06 19:18:02'),
(4, 'Yaquis vs Naranjeros', 'Deportes', 'Baseball', 'Yaquis de Obregon; Naranjeros de Hermosillo', '2018-11-24', '19:30:00', 'Estadio Yaquis', 'Cd. Obregon, SON', 'sadsadsadsda', 'http://www.yaquis.com.mx/wp-content/uploads/2016/01/image-640x360.png', '13000', 500.00, 900.00, '27.5257405', '-109.9521002', '2018-04-26 15:24:14', '2018-05-07 02:42:25'),
(7, 'WiSH Outdoor', 'Conciertos', 'Electronica', 'Armin Van Buren; Axwell Ingrosso; Galantis; Timmy Trumpet', '2018-05-26', '12:00:00', 'Parque Fundidora.', 'Monterrey, NL.', 'EDC 2018', 'http://neomusicmex.com/wp-content/uploads/2017/06/18768222_803743516449574_3128519024547295858_o.jpg', '10000', 1500.00, 2500.00, '25.6765934', '-100.2876707', '2018-05-03 14:53:04', '2018-05-05 17:52:08'),
(9, 'Remmy Valenzuela', 'Popular', 'Musica regional', 'Remmy Valenzuela', '2018-05-23', '23:00:00', 'Explanada Tecate', 'Navojoa, SON.', 'UN evento para la plebada.', 'https://naciongruperamx.com/wp-content/uploads/2018/03/RemmyValenzuelaOk.jpg', '1000', 400.00, 900.00, '27.0975999', '-109.4476459', '2018-05-03 19:05:01', '2018-05-07 02:44:34'),
(10, 'Tecate Sonoro', 'Conciertos', 'Festivales', 'Zoe; Los Autenticos Decadentes; Siddartha; Mon Laferte', '2018-10-16', '15:00:00', 'Parque La Ruina', 'Hermosillo, SON.', 'Tecate Sonoro', 'http://cdn.ocesa.com.mx/1497283297Sonoro_doble.png', '10000', 600.00, 1200.00, '29.0973997', '-110.9475863', '2018-05-03 19:13:52', '2018-05-07 02:44:19'),
(11, 'EXPOGAN 2018', 'Especial', 'Expo regionales', 'N/A', '2018-04-20', '12:00:00', 'Union Ganadera Regional de Sonora', 'Hermosillo, SON.', 'Expogan 2018', 'http://www.dondehayferia.com/sites/default/files/imagenes_eventos/expogan-sonora-2015-v2.jpg', '10000', 200.00, 400.00, '29.0425616', '-110.9354861', '2018-05-04 16:00:20', '2018-05-07 02:59:28'),
(12, 'Bosque Magico', 'Especial', 'Ferias', 'N/A', '2018-05-04', '10:00:00', 'Bosque Magico Coca Cola', 'Guadalupe, NL.', 'Bosque magico', 'https://cdn1.mx.yumping.info/emp/fotos/9/2/0/9/tb_Nuestras%20instalaciones.jpg', '1000', 400.00, 1000.00, '25.6635131', '-100.2522745', '2018-05-04 16:08:03', '2018-05-07 02:59:35'),
(14, 'El show de Franco Escamilla', 'Teatro', 'Teatro', 'Franco Escamilla', '2018-07-10', '22:00:00', 'Auditorio ITSON', 'Ciudad Obregon, SON.', 'Show de Franco Escamilla', 'https://i.ytimg.com/vi/4h3z0ZA1Y8k/hqdefault.jpg', '1200', 350.00, 700.00, '27.4820711', '-109.9330930', '2018-05-04 16:17:10', '2018-05-07 02:43:27'),
(15, 'Tijuana vs Necaxa', 'Deportes', 'Football', 'N/A', '2018-11-09', '07:00:00', 'Estadio Caliente', 'Tijuana, BC.', 'Liga MX Tijuana vs Necaxa', 'https://eastvillagetimes.com/wp-content/uploads/2017/07/tijuana-necaxa.jpg', '18000', 1000.00, 2000.00, '32.5068213', '-116.9955969', '2018-05-04 16:21:33', '2018-05-07 02:43:33'),
(16, 'Ostioneros Guaymas vs Halcones de Obregón', 'Deportes', 'Basketball', 'N/A', '2018-05-02', '20:00:00', 'Gimnasio Municipal', 'Guaymas, SON.', 'CIBACOPA 2018', 'https://i.ytimg.com/vi/-GdWksImDk4/maxresdefault.jpg', '1200', 70.00, 100.00, '27.9186271', '-110.8938261', '2018-05-04 16:26:07', '2018-05-07 02:43:42'),
(18, 'COCO en vivo', 'Teatro', 'Musicales', 'N/A', '2018-05-15', '17:00:00', 'Auditorio IMSS', 'Culiacán, SIN', 'Coco', 'https://i.ytimg.com/vi/zNCz4mQzfEI/maxresdefault.jpg', '1200', 100.00, 150.00, '24.7958616', '-107.3912012', '2018-05-04 16:32:45', '2018-05-07 02:43:57'),
(19, 'NTVG EN CULIACÁN', 'Conciertos', 'Rock/Metal', 'NTVG', '2018-08-01', '21:00:00', 'Estadio Banorte', 'Culiacán, SIN', 'El mejor concierto', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXxn-dVxDDzzI9AyFjywD-6q5i8LZN5dXlFxCnmTpR1ibo8QNS9g', '9000', 500.00, 900.00, '24.8301791', '-107.4043245', '2018-05-06 18:46:03', '2018-05-06 18:54:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papeleraevento`
--

CREATE TABLE `papeleraevento` (
  `id` int(11) NOT NULL,
  `nombre` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `categoria` enum('Conciertos','Deportes','Teatro','Popular','Especial') COLLATE utf8_unicode_ci NOT NULL,
  `tipo` enum('Electronica','Rock/Metal','Musica regional','Festivales','Pop','Expo regionales','Ferias','Palenques','Teatro','Football','Baseball','Basketball','Circos','Musicales') COLLATE utf8_unicode_ci NOT NULL,
  `artistaOGrupo` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `lugar` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `localidad` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `imagen` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `numBoletos` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `precio` float(10,2) NOT NULL,
  `precioVip` float(10,2) NOT NULL,
  `latitud` decimal(10,7) NOT NULL,
  `longitud` decimal(10,7) NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `papeleraevento`
--

INSERT INTO `papeleraevento` (`id`, `nombre`, `categoria`, `tipo`, `artistaOGrupo`, `fecha`, `hora`, `lugar`, `localidad`, `descripcion`, `imagen`, `numBoletos`, `precio`, `precioVip`, `latitud`, `longitud`, `dateCreated`, `dateUpdated`) VALUES
(2, 'Los Cafres en la O', 'Conciertos', 'Rock/Metal', 'Los cafres', '2018-04-27', '22:00:00', 'Arena ITSON', 'Cd. Obregon, SON', 'Un evento bien shidori', 'https://upload.wikimedia.org/wikipedia/commons/thumb/7/73/Los_Cafres_%282014%29.jpg/1024px-Los_Cafres_%282014%29.jpg', '5000', 500.00, 900.00, '27.4936153', '-109.9743303', '2018-04-26 15:20:04', '2018-05-06 19:17:46'),
(3, 'Matisse en Obregón', 'Conciertos', 'Pop', 'Matisse', '2018-04-27', '22:00:00', 'Arena ITSON', 'Cd. Obregon, SON', 'Matisse es un grupo musical mexicano de pop en español creado en 2014. El grupo está conformado por Melissa Robles, Pablo Preciado y Román Torres. El nombre Matisse fue adoptado por el grupo después de que Pablo y Román percibieran', 'https://cde.publimetro.e3.pe/ima/0/0/1/2/5/125281.jpg', '2000', 500.00, 900.00, '27.4936153', '-109.9743303', '2018-04-26 15:21:52', '2018-05-06 19:18:02'),
(4, 'Yaquis vs Naranjeros', 'Deportes', 'Baseball', 'Yaquis de Obregon; Naranjeros de Hermosillo', '2018-11-24', '19:30:00', 'Estadio Yaquis', 'Cd. Obregon, SON', 'sadsadsadsda', 'http://www.yaquis.com.mx/wp-content/uploads/2016/01/image-640x360.png', '13000', 500.00, 900.00, '27.5257405', '-109.9521002', '2018-04-26 15:24:14', '2018-05-07 02:42:25'),
(7, 'WiSH Outdoor', 'Conciertos', 'Electronica', 'Armin Van Buren; Axwell Ingrosso; Galantis; Timmy Trumpet', '2018-05-26', '12:00:00', 'Parque Fundidora.', 'Monterrey, NL.', 'EDC 2018', 'http://neomusicmex.com/wp-content/uploads/2017/06/18768222_803743516449574_3128519024547295858_o.jpg', '10000', 1500.00, 2500.00, '25.6765934', '-100.2876707', '2018-05-03 14:53:04', '2018-05-05 17:52:08'),
(9, 'Remmy Valenzuela', 'Popular', 'Musica regional', 'Remmy Valenzuela', '2018-05-23', '23:00:00', 'Explanada Tecate', 'Navojoa, SON.', 'UN evento para la plebada.', 'https://naciongruperamx.com/wp-content/uploads/2018/03/RemmyValenzuelaOk.jpg', '1000', 400.00, 900.00, '27.0975999', '-109.4476459', '2018-05-03 19:05:01', '2018-05-07 02:44:34'),
(10, 'Tecate Sonoro', 'Conciertos', 'Festivales', 'Zoe; Los Autenticos Decadentes; Siddartha; Mon Laferte', '2018-10-16', '15:00:00', 'Parque La Ruina', 'Hermosillo, SON.', 'Tecate Sonoro', 'http://cdn.ocesa.com.mx/1497283297Sonoro_doble.png', '10000', 600.00, 1200.00, '29.0973997', '-110.9475863', '2018-05-03 19:13:52', '2018-05-07 02:44:19'),
(11, 'EXPOGAN 2018', 'Especial', 'Expo regionales', 'N/A', '2018-04-20', '12:00:00', 'Union Ganadera Regional de Sonora', 'Hermosillo, SON.', 'Expogan 2018', 'http://www.dondehayferia.com/sites/default/files/imagenes_eventos/expogan-sonora-2015-v2.jpg', '10000', 200.00, 400.00, '29.0425616', '-110.9354861', '2018-05-04 16:00:20', '2018-05-07 02:59:28'),
(12, 'Bosque Magico', 'Especial', 'Ferias', 'N/A', '2018-05-04', '10:00:00', 'Bosque Magico Coca Cola', 'Guadalupe, NL.', 'Bosque magico', 'https://cdn1.mx.yumping.info/emp/fotos/9/2/0/9/tb_Nuestras%20instalaciones.jpg', '1000', 400.00, 1000.00, '25.6635131', '-100.2522745', '2018-05-04 16:08:03', '2018-05-07 02:59:35'),
(13, 'Marisela en Palenque EXPOGAN 2018', 'Popular', 'Palenques', 'Marisela', '2018-05-15', '23:00:00', 'Palenque ExpoGan', 'Hermosillo, SON.', 'Mariselaje', 'https://i.ytimg.com/vi/tLx_11MoC5o/maxresdefault.jpg', '1500', 700.00, 1200.00, '29.0401342', '-110.9435928', '2018-05-04 16:13:04', '2018-05-07 02:43:07'),
(14, 'El show de Franco Escamilla', 'Teatro', 'Teatro', 'Franco Escamilla', '2018-07-10', '22:00:00', 'Auditorio ITSON', 'Ciudad Obregon, SON.', 'Show de Franco Escamilla', 'https://i.ytimg.com/vi/4h3z0ZA1Y8k/hqdefault.jpg', '1200', 350.00, 700.00, '27.4820711', '-109.9330930', '2018-05-04 16:17:10', '2018-05-07 02:43:27'),
(15, 'Tijuana vs Necaxa', 'Deportes', 'Football', 'N/A', '2018-11-09', '07:00:00', 'Estadio Caliente', 'Tijuana, BC.', 'Liga MX Tijuana vs Necaxa', 'https://eastvillagetimes.com/wp-content/uploads/2017/07/tijuana-necaxa.jpg', '18000', 1000.00, 2000.00, '32.5068213', '-116.9955969', '2018-05-04 16:21:33', '2018-05-07 02:43:33'),
(16, 'Ostioneros Guaymas vs Halcones de Obregón', 'Deportes', 'Basketball', 'N/A', '2018-05-02', '20:00:00', 'Gimnasio Municipal', 'Guaymas, SON.', 'CIBACOPA 2018', 'https://i.ytimg.com/vi/-GdWksImDk4/maxresdefault.jpg', '1200', 70.00, 100.00, '27.9186271', '-110.8938261', '2018-05-04 16:26:07', '2018-05-07 02:43:42'),
(17, 'Circo ROLEX con Francesco', 'Teatro', 'Circos', 'Francesco', '2018-05-24', '17:30:00', 'Terrenos frente al IMSS', 'Empalme, SON.', 'Circo Rolex con Rrancesco', 'https://i.ytimg.com/vi/QoTYxLuKwjs/hqdefault.jpg', '400', 100.00, 150.00, '27.9573554', '-110.8245048', '2018-05-04 16:29:13', '2018-05-07 02:43:50'),
(18, 'COCO en vivo', 'Teatro', 'Musicales', 'N/A', '2018-05-15', '17:00:00', 'Auditorio IMSS', 'Culiacán, SIN', 'Coco', 'https://i.ytimg.com/vi/zNCz4mQzfEI/maxresdefault.jpg', '1200', 100.00, 150.00, '24.7958616', '-107.3912012', '2018-05-04 16:32:45', '2018-05-07 02:43:57'),
(19, 'NTVG EN CULIACÁN', 'Conciertos', 'Rock/Metal', 'NTVG', '2018-08-01', '21:00:00', 'Estadio Banorte', 'Culiacán, SIN', 'El mejor concierto', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQXxn-dVxDDzzI9AyFjywD-6q5i8LZN5dXlFxCnmTpR1ibo8QNS9g', '9000', 500.00, 900.00, '24.8301791', '-107.4043245', '2018-05-06 18:46:03', '2018-05-06 18:54:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `papelerausuario`
--

CREATE TABLE `papelerausuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Seleccione su estado','Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila','Colima','Durango','Estado de México','Guanajuato','Guerrero','Hidalgo','Jalisco','Michoacán','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz','Yucatán','Zacatecas') COLLATE utf8_unicode_ci NOT NULL,
  `rol` enum('agent','admin') COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `papelerausuario`
--

INSERT INTO `papelerausuario` (`id`, `nombre`, `apellidos`, `email`, `password`, `estado`, `rol`, `dateCreated`, `dateUpdated`) VALUES
(18, 'Titus', 'ONeill', 'titus@gmail.com', '$2y$12$67sAvLOzzvYr/FDjk8zlGOiz2j6//2SP6HFjBiSNMdRv9ZPuQA6kq', 'Sonora', 'agent', '2018-05-08 06:27:45', '0000-00-00 00:00:00'),
(19, 'Mario Alberto', 'Kempes', 'unosocongarras@gmail.com', '$2y$12$QXp6QcqLxEs96qdkLyH2GOtA3aFclw2Cs7EJ.fVROYt2wmrKIq9a.', 'Coahuila', 'agent', '2018-05-08 06:30:15', '0000-00-00 00:00:00'),
(20, 'Albert', 'Pujols', 'apujols@gmail.com', '$2y$12$9OK2vw0BFppXWo4EJ1XycOM84p15fCsakxkE3umfwiltA7CujbH6K', 'Oaxaca', 'agent', '2018-05-08 06:30:48', '0000-00-00 00:00:00'),
(21, 'Pepe', 'Meet', 'pepetoño@gmail.com', '$2y$12$67sAvLOzzvYr/FDjk8zlGOiz2j6//2SP6HFjBiSNMdRv9ZPuQA6kq', 'Sonora', 'agent', '2018-05-08 06:27:45', '0000-00-00 00:00:00'),
(22, 'Thanos', 'DeNigris', 'thanitodeguamuchil@gmail.com', '$2y$12$67sAvLOzzvYr/FDjk8zlGOiz2j6//2SP6HFjBiSNMdRv9ZPuQA6kq', 'Sonora', 'agent', '2018-05-08 06:27:45', '0000-00-00 00:00:00'),
(25, 'Francisco Doble', 'Quijada', 'franquijada97@gmail.com', '$2y$12$hiG9Kex5sPImnfkyQkbIje18/uMAZQVmX6EnRFDOB75RpgYEMLvdi', 'Sonora', 'agent', '2018-05-08 06:53:51', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `estado` enum('Seleccione su estado','Aguascalientes','Baja California','Baja California Sur','Campeche','Chiapas','Chihuahua','Coahuila','Colima','Durango','Estado de México','Guanajuato','Guerrero','Hidalgo','Jalisco','Michoacán','Morelos','Nayarit','Nuevo León','Oaxaca','Puebla','Querétaro','Quintana Roo','San Luis Potosí','Sinaloa','Sonora','Tabasco','Tamaulipas','Tlaxcala','Veracruz','Yucatán','Zacatecas') COLLATE utf8_unicode_ci NOT NULL,
  `rol` enum('agent','admin') COLLATE utf8_unicode_ci NOT NULL,
  `dateCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dateUpdated` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellidos`, `email`, `password`, `estado`, `rol`, `dateCreated`, `dateUpdated`) VALUES
(11, 'José Luis', 'Vega Herrera', 'jlvh1996@gmail.com', '$2y$12$EDAdw4kIBlifNWffaR8vcetvRIT5wW6TiJ7gCiK0YBJONPCC47WLS', 'Sonora', 'admin', '2018-05-07 03:32:26', '2018-05-08 06:32:53'),
(12, 'Mario', 'Llanez', 'mariojmz07@gmail.com', '$2y$12$R36ocrwNmU0zY6zKQpo7e.zTbW3wHsB0ZEFdbkZabPR4mqVOWoRGa', 'Sonora', 'agent', '2018-05-07 03:47:04', '0000-00-00 00:00:00'),
(15, 'Rey', 'Ayala', 'rey.rag13@gmail.com', '$2y$12$Uzcq/fDwpDIzCLpfXfDAqudhHAdLfKJBPJ8Zz58o3LkKiKCgGCe..', 'Sonora', 'agent', '2018-05-07 03:47:04', '2018-05-08 06:34:06'),
(16, 'Francisco', 'Quijada', 'franquijada97@gmail.com', '$2y$12$hiG9Kex5sPImnfkyQkbIje18/uMAZQVmX6EnRFDOB75RpgYEMLvdi', 'Sonora', 'agent', '2018-05-08 06:25:59', '0000-00-00 00:00:00'),
(17, 'Vivian', 'Munguia', 'vivian.munguia.mtz@gmail.com', '$2y$12$fHgqkHyikv5cmvMFHlevFODW01NOhGhNzB3v2OQ9lip8EhYEFIsu2', 'Sonora', 'agent', '2018-05-08 06:26:55', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id` int(11) NOT NULL,
  `idEvento` int(11) NOT NULL,
  `nombreCompleto` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `total` varchar(70) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id`, `idEvento`, `nombreCompleto`, `correo`, `total`) VALUES
(3, 9, 'Jose Vega', 'jlvh1996@gmail.com', '1600.00'),
(4, 11, 'Jose Vega', 'jlvh1996@gmail.com', '400.00'),
(5, 2, 'Jose Vega', 'jlvh1996@gmail.com', '1500.00'),
(6, 2, 'Jorge Posada', 'jposada@gmail.com', '2000.00'),
(7, 7, 'Jose Vega', 'jlvh1996@gmail.com', '13500.00'),
(8, 14, 'dfdsdf', 'fsdf@gmail.com', '3150.00'),
(9, 14, 'Jorge Posada', 'elbronquiza@hotmail.com', '2450.00'),
(10, 14, 'Jorge Posada', 'elbronquiza@hotmail.com', '1750.00'),
(11, 2, 'Jose Vega', 'elbronquichito@hotmail.com', '1000.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `evento`
--
ALTER TABLE `evento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `papeleraevento`
--
ALTER TABLE `papeleraevento`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `papelerausuario`
--
ALTER TABLE `papelerausuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idEvento` (`idEvento`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `evento`
--
ALTER TABLE `evento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `papeleraevento`
--
ALTER TABLE `papeleraevento`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `papelerausuario`
--
ALTER TABLE `papelerausuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
