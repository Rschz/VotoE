-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2020 a las 02:03:37
-- Versión del servidor: 10.4.10-MariaDB
-- Versión de PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `votoe`
--
CREATE DATABASE IF NOT EXISTS `votoe` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `votoe`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `candidato`
--

DROP TABLE IF EXISTS `candidato`;
CREATE TABLE `candidato` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Apellido` varchar(80) NOT NULL,
  `Partido` int(11) NOT NULL,
  `Puesto` int(11) NOT NULL,
  `FotoPerfil` text NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `candidato`
--

INSERT INTO `candidato` (`Id`, `Nombre`, `Apellido`, `Partido`, `Puesto`, `FotoPerfil`, `Estado`) VALUES
(1, 'Germaine', 'Bergstram', 1, 4, '/nunc/rhoncus/dui.png', 1),
(2, 'Germaine', 'Bergstram', 1, 4, '/nunc/rhoncus/dui.png', 1),
(3, 'Davey', 'Corain', 2, 2, '/morbi/odio/odio/elementum/eu/interdum/eu.jpg', 0),
(4, 'Davina', 'Pogosian', 2, 1, '/eleifend/pede/libero/quis.aspx', 0),
(5, 'Barry', 'Charopen', 2, 2, '/metus/aenean/fermentum/donec/ut/mauris/eget.png', 1),
(6, 'Denice', 'Demsey', 3, 1, '/ipsum/dolor/sit/amet/consectetuer/adipiscing/elit.png', 1),
(7, 'Jonell', 'McKaile', 4, 3, '/duis/at/velit.js', 0),
(8, 'Nehemiah', 'Kempstone', 4, 1, '/integer/ac/leo/pellentesque/ultrices/mattis/odio.png', 1),
(9, 'Britteny', 'McMenamin', 3, 4, '/massa/donec/dapibus/duis.jpg', 1),
(10, 'Nicko', 'Chadburn', 3, 4, '/at/dolor/quis/odio.json', 1),
(11, 'Harlene', 'Walthall', 3, 4, '/id/massa/id/nisl.jsp', 1),
(12, 'Olivia', 'Charlon', 4, 1, '/morbi/vel/lectus/in/quam/fringilla.jsp', 0),
(13, 'Rollin', 'Skahill', 2, 3, '/non/velit/nec.png', 1),
(14, 'Templeton', 'Glyde', 4, 3, '/metus.png', 1),
(15, 'Maje', 'Diviny', 1, 1, '/nibh/fusce/lacus/purus/aliquet.json', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eleccion`
--

DROP TABLE IF EXISTS `eleccion`;
CREATE TABLE `eleccion` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `FechaRealizacion` varchar(20) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `eleccion`
--

INSERT INTO `eleccion` (`Id`, `Nombre`, `FechaRealizacion`, `Estado`) VALUES
(1, 'Elección 2016-2020', '06-12-2016', 0),
(2, 'Elección 2020-2024', '06-12-2020', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `partido`
--

DROP TABLE IF EXISTS `partido`;
CREATE TABLE `partido` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `LogoPartido` text NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `partido`
--

INSERT INTO `partido` (`Id`, `Nombre`, `Descripcion`, `LogoPartido`, `Estado`) VALUES
(1, 'PRD', 'Partido Revolucionario Dominicano', '/fakeimage/img.jpg', 1),
(2, 'PLD', 'Partido de la Liberación Dominicana', '/fakeimage/img.jpg', 0),
(3, 'PRSC', 'Partido Reformista Social Cristiano', '/fakeimage/img.jpg', 1),
(4, 'PRM', 'Partido Revolucionario Moderno', '/fakeimage/img.jpg', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `puestoelectivo`
--

DROP TABLE IF EXISTS `puestoelectivo`;
CREATE TABLE `puestoelectivo` (
  `Id` int(11) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Descripcion` varchar(200) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `puestoelectivo`
--

INSERT INTO `puestoelectivo` (`Id`, `Nombre`, `Descripcion`, `Estado`) VALUES
(1, 'Presidente', 'Va como el máximo representante del estado', 1),
(2, 'Alcarde', 'Cargo público que se encuentra al frente de la administración política de una ciudad, municipio o pueblo.', 1),
(3, 'Senador', 'Miembro o integrante de la Cámara de Senadores o Senado', 1),
(4, 'Diputado', 'Representante en una Cámara de Diputados.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tb_ciudadano`
--

DROP TABLE IF EXISTS `tb_ciudadano`;
CREATE TABLE `tb_ciudadano` (
  `DocIdentidad` char(11) NOT NULL,
  `Nombre` varchar(80) NOT NULL,
  `Apellido` varchar(80) NOT NULL,
  `Email` varchar(150) NOT NULL,
  `Estado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `tb_ciudadano`
--

INSERT INTO `tb_ciudadano` (`DocIdentidad`, `Nombre`, `Apellido`, `Email`, `Estado`) VALUES
('12345678911', 'Mario', 'Cimarro', 'mcimarro@ejemplo.com', 1),
('40085320420', 'Alano', 'Priestnall', 'apriestnallj@state.tx.us', 1),
('40138052521', 'Jen', 'Olphert', 'jolphertp@washingtonpost.com', 0),
('41325111184', 'Kass', 'Burnell', 'kburnelli@furl.net', 0),
('41438609087', 'Vernen', 'Jepensen', 'vjepensen11@123-reg.co.uk', 0),
('41648093074', 'Joshuah', 'Chattington', 'jchattingtonb@storify.com', 0),
('41654906540', 'Malcolm', 'McGilvra', 'mmcgilvraq@e-recht24.de', 1),
('42028672885', 'Reggie', 'Ellar', 'rellar1a@hao123.com', 1),
('42091391602', 'Bud', 'Flynn', 'bflynnt@wiley.com', 0),
('42290228690', 'Aida', 'Emanueli', 'aemanuelio@wsj.com', 0),
('42494698323', 'Cort', 'Romney', 'cromney1d@nba.com', 1),
('42535947157', 'Vaclav', 'Burrows', 'vburrows1b@unblog.fr', 1),
('42543336637', 'Mei', 'Gimert', 'mgimert7@forbes.com', 0),
('42586171913', 'Cordelia', 'McEneny', 'cmcenenyz@time.com', 0),
('42664568312', 'Candice', 'Ripper', 'cripper2@walmart.com', 0),
('42750170114', 'Anetta', 'Yuryshev', 'ayuryshevw@php.net', 1),
('42875553205', 'Anny', 'Woolfitt', 'awoolfitta@sogou.com', 0),
('42974316676', 'Cordi', 'Grainger', 'cgrainger13@earthlink.net', 0),
('42990423867', 'Bertram', 'Phoenix', 'bphoenixn@ca.gov', 0),
('43095451471', 'Woody', 'Maas', 'wmaasv@digg.com', 1),
('43106129471', 'Ramonda', 'Florey', 'rfloreyh@arstechnica.com', 0),
('43462531258', 'Abelard', 'Naden', 'anadenl@nytimes.com', 0),
('43587917489', 'Derward', 'Sigars', 'dsigarsf@lulu.com', 1),
('43623301939', 'Joey', 'Barnson', 'jbarnson14@boston.com', 1),
('43672148840', 'Fanny', 'Kingwell', 'fkingwell19@vinaora.com', 1),
('43692225924', 'Lavinie', 'Dyos', 'ldyosg@wsj.com', 1),
('44013052641', 'Buckie', 'Joisce', 'bjoiscer@google.ca', 0),
('44185156575', 'Eamon', 'Golledge', 'egolledge18@jimdo.com', 1),
('44461965082', 'Jarret', 'Glenwright', 'jglenwright10@odnoklassniki.ru', 0),
('44508811592', 'Odelle', 'McMakin', 'omcmakin16@abc.net.au', 1),
('44713443726', 'Ulrika', 'Bleyman', 'ubleyman1c@comsenz.com', 1),
('45107079549', 'Kyle', 'Latter', 'klatter3@nyu.edu', 1),
('45117832157', 'Candie', 'Jacketts', 'cjacketts8@telegraph.co.uk', 1),
('45141273389', 'Juan', 'Ackenhead', 'jackenheadx@wordpress.org', 1),
('45251480265', 'Cathrin', 'Espinoy', 'cespinoy12@china.com.cn', 1),
('45428600878', 'Del', 'McGillivray', 'dmcgillivray6@themeforest.net', 1),
('45496331309', 'Claudina', 'Showl', 'cshowl5@lycos.com', 1),
('45971132496', 'Fallon', 'Stud', 'fstud0@wikipedia.org', 1),
('46122107771', 'Chilton', 'Franceschino', 'cfranceschinou@seesaa.net', 1),
('46289892762', 'Margarete', 'Higounet', 'mhigounet4@rakuten.co.jp', 1),
('46377773873', 'Reeta', 'Hallgate', 'rhallgatem@sun.com', 0),
('46490245385', 'Beatrix', 'Craney', 'bcraneye@xrea.com', 0),
('46553936811', 'Ester', 'Bickerstaffe', 'ebickerstaffe1@smh.com.au', 1),
('46678770151', 'Abigale', 'Gaisford', 'agaisford17@stumbleupon.com', 1),
('46864169640', 'Georgie', 'Dronsfield', 'gdronsfieldk@jigsy.com', 1),
('47016068867', 'Elna', 'Laird-Craig', 'elairdcraig15@topsy.com', 1),
('47043047492', 'Mareah', 'Laxton', 'mlaxtond@google.com.hk', 0),
('47050528331', 'Nadine', 'Raecroft', 'nraecroftc@globo.com', 1),
('47281269508', 'Gayel', 'Bart', 'gbart9@flickr.com', 1),
('47285613240', 'Walther', 'Durrad', 'wdurrads@ovh.net', 0),
('47327400077', 'Oliy', 'Chantler', 'ochantlery@vk.com', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `apellido` varchar(100) NOT NULL,
  `telefono` varchar(10) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`id`, `nombre`, `apellido`, `telefono`, `correo`, `usuario`, `contrasena`) VALUES
(1, 'Maria', 'Pierre', '8096209515', 'dfsfsd@hotmail.es', 'aa', '123456'),
(2, 'Miguel', 'Quezada', '8096209515', 'bbb@hdd.es', 'bb', '1234'),
(4, 'Julio', 'Infante', '8096209515', 'dfsdf@gg.es', 'dd', '123456'),
(5, 'Santos', 'Castillo', '8096209515', 'dfsdaf@dfd.es', 'cc', '1234567'),
(6, 'Carlos', 'Mue', '8095566477', 'dfdffd@hff.es', 'zz', '12347');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votacion`
--

DROP TABLE IF EXISTS `votacion`;
CREATE TABLE `votacion` (
  `id` int(11) NOT NULL,
  `eleccion` int(11) NOT NULL,
  `ciudadano` char(11) NOT NULL,
  `candidato` int(11) NOT NULL,
  `puesto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `votacion`
--

INSERT INTO `votacion` (`id`, `eleccion`, `ciudadano`, `candidato`, `puesto`) VALUES
(1, 2, '40085320420', 15, 1),
(2, 2, '42586171913', 5, 2),
(3, 2, '12345678911', 7, 3),
(4, 2, '46864169640', 11, 4);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Puesto` (`Puesto`),
  ADD KEY `Partido` (`Partido`);

--
-- Indices de la tabla `eleccion`
--
ALTER TABLE `eleccion`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `partido`
--
ALTER TABLE `partido`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `puestoelectivo`
--
ALTER TABLE `puestoelectivo`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `tb_ciudadano`
--
ALTER TABLE `tb_ciudadano`
  ADD PRIMARY KEY (`DocIdentidad`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `eleccion` (`eleccion`),
  ADD KEY `ciudadano` (`ciudadano`),
  ADD KEY `candidato` (`candidato`),
  ADD KEY `puesto` (`puesto`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `candidato`
--
ALTER TABLE `candidato`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `eleccion`
--
ALTER TABLE `eleccion`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `puestoelectivo`
--
ALTER TABLE `puestoelectivo`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `votacion`
--
ALTER TABLE `votacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `candidato`
--
ALTER TABLE `candidato`
  ADD CONSTRAINT `candidato_ibfk_1` FOREIGN KEY (`Puesto`) REFERENCES `puestoelectivo` (`Id`),
  ADD CONSTRAINT `candidato_ibfk_2` FOREIGN KEY (`Partido`) REFERENCES `partido` (`Id`);

--
-- Filtros para la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD CONSTRAINT `votacion_ibfk_1` FOREIGN KEY (`eleccion`) REFERENCES `eleccion` (`Id`),
  ADD CONSTRAINT `votacion_ibfk_4` FOREIGN KEY (`ciudadano`) REFERENCES `tb_ciudadano` (`DocIdentidad`),
  ADD CONSTRAINT `votacion_ibfk_5` FOREIGN KEY (`candidato`) REFERENCES `candidato` (`Id`),
  ADD CONSTRAINT `votacion_ibfk_6` FOREIGN KEY (`puesto`) REFERENCES `puestoelectivo` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
