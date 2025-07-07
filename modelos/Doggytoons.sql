-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 07-07-2025 a las 02:46:31
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `doggytoons`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `idAdmin` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`idAdmin`, `Nombre`, `Apellido`, `Correo`, `Clave`) VALUES
(1021670976, 'Danna ', 'Molina ', 'dannamolina@gmail.com', '202cb962ac59075b964b07152d234b70'),
(1032798548, 'Juan', 'Ortiz', 'juanortiz@gmail.com', '250cf8b51c773f3f8dc8b4be867a9a02');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `dueño`
--

CREATE TABLE `dueño` (
  `idDueño` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Contacto` int(11) NOT NULL,
  `Foto` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `dueño`
--

INSERT INTO `dueño` (`idDueño`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Contacto`, `Foto`) VALUES
(101, 'Pedro', 'Picapiedra', 'pedro@gmail.com', '134afc4870bdd96fc193fda6eaea831a', 310123456, 'imagenes/1751220368.png'),
(102, 'Homero', 'Simpson', 'homero@gmail.com', 'f3974bfce209a246c56049d6e27e7dfa', 320555112, 'imagenes/1751237338.png'),
(103, 'Shaggy', 'Rogers', 'shaggy@gmail.com', 'd66bcc0e7de711e49d3a5abd29a75e01', 315789012, 'imagenes/1751237486.png'),
(104, 'Charlie', 'Brown', 'charlie@gmail.com', 'cbaca0a0a39298908a7f0013b04bdc2a', 300111223, 'imagenes/1751237521.png'),
(105, 'Jon', 'Arbuckle', 'jon@gmail.com', 'ce1b0e5c1c3bcc99b430af1cd64084e5', 311222334, 'imagenes/1751237564.png'),
(106, 'Ryder', 'PawPatrol', 'ryder@gmail.com', 'd19495f1c7858d2e4a1084d4df5b70c2', 301333445, 'imagenes/1751237599.png'),
(107, 'Heidi', 'Prado', 'heidi@gmail.com', '640ee581f58db025b43db67239abf074', 302444556, 'imagenes/1751237633.png'),
(108, 'Ben', 'Tennyson', 'ben@gmail.com', '9660186406ddac0445b9f9b09785ac29', 303555667, 'imagenes/1751237669.png'),
(109, 'Johnny', 'Bravo', 'johnny@gmail.com', '87faf1c4acd45c9602d06fa1a62f5f7e', 304666778, 'imagenes/1751237699.png'),
(110, 'Muriel', 'Bagge', 'muriel@gmail.com', 'd0719c27ad2bed26f853ac1c1af83d65', 305777988, 'imagenes/1751237727.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadopaseo`
--

CREATE TABLE `estadopaseo` (
  `idEstadoPaseo` int(11) NOT NULL,
  `Valor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `estadopaseo`
--

INSERT INTO `estadopaseo` (`idEstadoPaseo`, `Valor`) VALUES
(1, 'Pendiente'),
(2, 'Aceptada'),
(3, 'Completado'),
(4, 'Cancelado'),
(5, 'Pagada');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseador`
--

CREATE TABLE `paseador` (
  `idPaseador` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Apellido` varchar(45) NOT NULL,
  `Correo` varchar(45) NOT NULL,
  `Clave` varchar(45) NOT NULL,
  `Activo` tinyint(4) NOT NULL,
  `Informacion` varchar(300) NOT NULL,
  `Foto` varchar(45) DEFAULT NULL,
  `Admin_idAdmin` int(11) NOT NULL,
  `Contacto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paseador`
--

INSERT INTO `paseador` (`idPaseador`, `Nombre`, `Apellido`, `Correo`, `Clave`, `Activo`, `Informacion`, `Foto`, `Admin_idAdmin`, `Contacto`) VALUES
(1, 'Mickey ', 'Mouse', 'mickey@toons.com', '4d467a49990fe697121629ab9237ea3e', 1, 'Especialista en \"Viajes Perrunos\" a parques temáticos, explorando los rincones más divertidos. Ofrece sesiones de juego con los \"Juguetes Toon\" más resistentes y siempre tiene a mano \"Alimentos Mágicos\" para un snack post-aventura. Siempre con una sonrisa.', 'imagenes/1751598130.png', 1021670976, 300213985),
(2, 'Bugs', 'Bunny', 'bugs@toons.com', 'dd3fe76c3f5fbced0623e596f9955c72', 1, 'Experto en \"Expediciones Saltarinas\" por campos y senderos. Conoce los mejores escondites para buscar \"Juguetes Escondidos\" y premia el buen comportamiento con \"Alimentos Crujientes\" a base de zanahorias. Siempre listo para una nueva travesura.', 'imagenes/1751598270.png', 1032798548, 321354985),
(3, 'Bob', 'Esponja', 'bob@toons.com', 'f2f1d285a435bd0694da8cf3d780b670', 1, 'Activo y listo para \"Paseos Submarinos\" imaginarios por la ciudad, buscando charcos y fuentes. Lleva consigo los \"Juguetes Burbujeantes\" más divertidos y \"Alimentos Marinos\" nutritivos para una energía inagotable. Amante de la vida marina y los paseos tranquilos.', 'imagenes/1751598417.png', 1021670976, 365894156),
(4, 'Popeye', 'Marino', 'popeye@toons.com', 'b1f236bdf823f5dd942b256c79d4604c', 1, 'Fuerte y energético, organiza \"Rutas Oceánicas\" por senderos costeros y muelles. Sus \"Juguetes de Nudo\" son irrompibles y siempre carga con \"Alimentos de Espinaca\" para un impulso de vitalidad que mantiene a los perros siempre listos para la acción.', 'imagenes/1751598474.png', 1032798548, 315316053),
(5, 'Candace', 'Flynn', 'candace@toons.com', 'ebf4b55472e49d376a5fdf9aeaeea495', 1, 'Paseadora \"Conspiradora\", siempre en busca de la \"Gran Aventura del Día\" que sus hermanos no puedan esconder. Equipada con \"Juguetes Innovadores\" y \"Alimentos Sorpresa\" que aparecen de la nada. ¡Va a contarles a tus padres lo divertido que es el paseo!', 'imagenes/1751598511.png', 1021670976, 318326542),
(7, 'Kim', 'Possible', 'kim@gmail.com', '98467a817e2ff8c8377c1bf085da7138', 1, 'Una paseadora audaz y brillante.', '', 1021670976, 2147483647),
(8, 'Edward', 'Horace', 'ed@gmail.com', 'd2c9694bdad14eaabbed8b425f994fce', 1, 'Rápido y genial paseador', 'imagenes/1751777331.png', 1021670976, 23456789);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseo`
--

CREATE TABLE `paseo` (
  `idPaseo` int(11) NOT NULL,
  `FechaInicio` datetime NOT NULL,
  `FechaFin` datetime NOT NULL,
  `Paseador_idPaseador` int(11) NOT NULL,
  `EstadoPaseo_idEstadoPaseo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paseo`
--

INSERT INTO `paseo` (`idPaseo`, `FechaInicio`, `FechaFin`, `Paseador_idPaseador`, `EstadoPaseo_idEstadoPaseo`) VALUES
(1, '2025-06-12 09:00:00', '2025-06-12 10:00:00', 1, 3),
(2, '2025-06-12 14:00:00', '2025-06-12 15:00:00', 2, 3),
(3, '2025-06-13 10:00:00', '2025-06-13 11:00:00', 3, 3),
(4, '2025-06-13 16:00:00', '2025-06-13 17:00:00', 4, 3),
(5, '2025-06-14 09:00:00', '2025-06-14 10:00:00', 5, 2),
(6, '2025-06-15 11:00:00', '2025-06-15 12:00:00', 1, 1),
(7, '2025-06-16 14:00:00', '2025-06-16 15:00:00', 2, 1),
(8, '2025-06-17 09:00:00', '2025-06-17 10:00:00', 3, 1),
(9, '2025-06-18 10:00:00', '2025-06-18 11:00:00', 4, 4),
(10, '2025-06-19 15:00:00', '2025-06-19 16:00:00', 5, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paseoperro`
--

CREATE TABLE `paseoperro` (
  `Paseo_idPaseo` int(11) NOT NULL,
  `Perro_idPerro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `paseoperro`
--

INSERT INTO `paseoperro` (`Paseo_idPaseo`, `Perro_idPerro`) VALUES
(1, 1),
(2, 2),
(2, 3),
(3, 4),
(4, 5),
(4, 7),
(5, 8),
(5, 9),
(6, 10),
(7, 11),
(7, 12),
(8, 13),
(9, 14),
(9, 16),
(10, 19),
(10, 20);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `perro`
--

CREATE TABLE `perro` (
  `idPerro` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Foto` varchar(45) DEFAULT NULL,
  `Raza_idRaza` int(11) NOT NULL,
  `Dueño_idDueño` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `perro`
--

INSERT INTO `perro` (`idPerro`, `Nombre`, `Foto`, `Raza_idRaza`, `Dueño_idDueño`) VALUES
(1, 'Dino', 'imagenes/1750985702.png', 6, 101),
(2, 'Astro', 'imagenes/1750985525.png', 6, 101),
(3, 'Bandit', 'imagenes/1750985544.png', 5, 101),
(4, 'Ayudante de Santa', 'imagenes/1750985923.png', 12, 102),
(5, 'Niebla', 'imagenes/1750985947.png', 13, 102),
(6, 'Pluto', 'imagenes/1750985985.png', 14, 102),
(7, 'Scooby', 'imagenes/1750986039.png', 6, 103),
(8, 'Scrappy-Doo', 'imagenes/1750986053.png', 6, 103),
(9, 'Dug', 'imagenes/1750986082.png', 9, 103),
(10, 'Snoopy', 'imagenes/1750986566.png', 4, 104),
(11, 'Spike', 'imagenes/1750986481.png', 5, 104),
(12, 'Milú', 'imagenes/1750986585.png', 7, 104),
(13, 'Odie', 'imagenes/1750986666.png', 16, 105),
(14, 'Pongo', 'imagenes/1750986680.png', 1, 105),
(15, 'Chase', 'imagenes/1750986715.png', 3, 106),
(16, 'Marshall', 'imagenes/1750986725.png', 1, 106),
(17, 'Dodger', 'imagenes/1750986762.png', 10, 107),
(18, 'Sparky', 'imagenes/1750986784.png', 11, 107),
(19, 'Bolt', 'imagenes/1750986816.png', 3, 108),
(20, 'Clifford', 'imagenes/1750986828.png', 15, 108),
(21, 'Droopy', 'imagenes/1750986976.png', 2, 109),
(22, 'Jake', 'imagenes/1750987026.png', 5, 109),
(23, 'Coraje', 'imagenes/1750987158.png', 4, 110),
(24, 'Ren', 'imagenes/1750987224.png', 8, 110);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `raza`
--

CREATE TABLE `raza` (
  `idRaza` int(11) NOT NULL,
  `Nombre` varchar(45) NOT NULL,
  `Tamaño_idTamaño` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `raza`
--

INSERT INTO `raza` (`idRaza`, `Nombre`, `Tamaño_idTamaño`) VALUES
(1, 'Dálmata', 2),
(2, 'Basset Hound', 2),
(3, 'Pastor Alemán', 3),
(4, 'Beagle', 2),
(5, 'Bulldog', 2),
(6, 'Gran Danés', 4),
(7, 'Fox Terrier', 1),
(8, 'Chihuahua', 1),
(9, 'Golden Retriever', 3),
(10, 'Terrier', 2),
(11, 'Bull Terrier', 2),
(12, 'Galgo', 3),
(13, 'San Bernardo', 4),
(14, 'Bloodhound', 3),
(15, 'Vizsla', 3),
(16, 'Mestiza', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tamaño`
--

CREATE TABLE `tamaño` (
  `idTamaño` int(11) NOT NULL,
  `Tipo` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tamaño`
--

INSERT INTO `tamaño` (`idTamaño`, `Tipo`) VALUES
(1, 'Pequeño'),
(2, 'Mediano'),
(3, 'Grande'),
(4, 'Gigante');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tarifa`
--

CREATE TABLE `tarifa` (
  `idTarifa` int(11) NOT NULL,
  `PrecioHora` decimal(10,0) NOT NULL,
  `Paseador_idPaseador` int(11) NOT NULL,
  `Tamaño_idTamaño` int(11) NOT NULL,
  `FechaInicio` date NOT NULL,
  `Activa` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Volcado de datos para la tabla `tarifa`
--

INSERT INTO `tarifa` (`idTarifa`, `PrecioHora`, `Paseador_idPaseador`, `Tamaño_idTamaño`, `FechaInicio`, `Activa`) VALUES
(1, 16000, 2, 1, '2025-07-04', 1),
(2, 21000, 2, 2, '2025-07-04', 1),
(3, 26000, 2, 3, '2025-07-04', 1),
(4, 31000, 2, 4, '2025-07-04', 1),
(5, 14000, 3, 1, '2025-07-04', 1),
(6, 19000, 3, 2, '2025-07-04', 1),
(7, 24000, 3, 3, '2025-07-04', 1),
(8, 29000, 3, 4, '2025-07-04', 1),
(9, 17000, 4, 1, '2025-07-04', 1),
(10, 22000, 4, 2, '2025-07-04', 1),
(11, 27000, 4, 3, '2025-07-04', 1),
(12, 32000, 4, 4, '2025-07-04', 1),
(13, 15500, 5, 1, '2025-07-04', 1),
(14, 20500, 5, 2, '2025-07-04', 1),
(15, 25500, 5, 3, '2025-07-04', 1),
(16, 30500, 5, 4, '2025-07-04', 1),
(17, 15000, 1, 1, '2025-07-04', 1),
(18, 20000, 1, 2, '2025-07-04', 1),
(19, 25000, 1, 3, '2025-07-04', 1),
(20, 30000, 1, 4, '2025-07-04', 0),
(25, 27000, 1, 4, '2025-07-06', 0),
(26, 30000, 1, 4, '2025-07-06', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idAdmin`);

--
-- Indices de la tabla `dueño`
--
ALTER TABLE `dueño`
  ADD PRIMARY KEY (`idDueño`);

--
-- Indices de la tabla `estadopaseo`
--
ALTER TABLE `estadopaseo`
  ADD PRIMARY KEY (`idEstadoPaseo`);

--
-- Indices de la tabla `paseador`
--
ALTER TABLE `paseador`
  ADD PRIMARY KEY (`idPaseador`),
  ADD KEY `fk_Paseador_Admin1_idx` (`Admin_idAdmin`);

--
-- Indices de la tabla `paseo`
--
ALTER TABLE `paseo`
  ADD PRIMARY KEY (`idPaseo`),
  ADD KEY `fk_Paseo_Paseador1_idx` (`Paseador_idPaseador`),
  ADD KEY `fk_Paseo_EstadoPaseo1_idx` (`EstadoPaseo_idEstadoPaseo`);

--
-- Indices de la tabla `paseoperro`
--
ALTER TABLE `paseoperro`
  ADD PRIMARY KEY (`Paseo_idPaseo`,`Perro_idPerro`),
  ADD KEY `fk_Paseo_has_Perro_Perro1_idx` (`Perro_idPerro`),
  ADD KEY `fk_Paseo_has_Perro_Paseo1_idx` (`Paseo_idPaseo`);

--
-- Indices de la tabla `perro`
--
ALTER TABLE `perro`
  ADD PRIMARY KEY (`idPerro`),
  ADD KEY `fk_Perro_Raza1_idx` (`Raza_idRaza`),
  ADD KEY `fk_Perro_Dueño1_idx` (`Dueño_idDueño`);

--
-- Indices de la tabla `raza`
--
ALTER TABLE `raza`
  ADD PRIMARY KEY (`idRaza`),
  ADD KEY `fk_Raza_Tamaño_idx` (`Tamaño_idTamaño`);

--
-- Indices de la tabla `tamaño`
--
ALTER TABLE `tamaño`
  ADD PRIMARY KEY (`idTamaño`);

--
-- Indices de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD PRIMARY KEY (`idTarifa`),
  ADD KEY `fk_Tarifa_Paseador1_idx` (`Paseador_idPaseador`),
  ADD KEY `fk_Tarifa_Tamaño1_idx` (`Tamaño_idTamaño`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `dueño`
--
ALTER TABLE `dueño`
  MODIFY `idDueño` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=144;

--
-- AUTO_INCREMENT de la tabla `estadopaseo`
--
ALTER TABLE `estadopaseo`
  MODIFY `idEstadoPaseo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `paseador`
--
ALTER TABLE `paseador`
  MODIFY `idPaseador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `paseo`
--
ALTER TABLE `paseo`
  MODIFY `idPaseo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `perro`
--
ALTER TABLE `perro`
  MODIFY `idPerro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT de la tabla `raza`
--
ALTER TABLE `raza`
  MODIFY `idRaza` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `tamaño`
--
ALTER TABLE `tamaño`
  MODIFY `idTamaño` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tarifa`
--
ALTER TABLE `tarifa`
  MODIFY `idTarifa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paseador`
--
ALTER TABLE `paseador`
  ADD CONSTRAINT `fk_Paseador_Admin1` FOREIGN KEY (`Admin_idAdmin`) REFERENCES `admin` (`idAdmin`);

--
-- Filtros para la tabla `paseo`
--
ALTER TABLE `paseo`
  ADD CONSTRAINT `fk_Paseo_EstadoPaseo1` FOREIGN KEY (`EstadoPaseo_idEstadoPaseo`) REFERENCES `estadopaseo` (`idEstadoPaseo`),
  ADD CONSTRAINT `fk_Paseo_Paseador1` FOREIGN KEY (`Paseador_idPaseador`) REFERENCES `paseador` (`idPaseador`);

--
-- Filtros para la tabla `paseoperro`
--
ALTER TABLE `paseoperro`
  ADD CONSTRAINT `fk_Paseo_has_Perro_Paseo1` FOREIGN KEY (`Paseo_idPaseo`) REFERENCES `paseo` (`idPaseo`),
  ADD CONSTRAINT `fk_Paseo_has_Perro_Perro1` FOREIGN KEY (`Perro_idPerro`) REFERENCES `perro` (`idPerro`);

--
-- Filtros para la tabla `perro`
--
ALTER TABLE `perro`
  ADD CONSTRAINT `fk_Perro_Dueño1` FOREIGN KEY (`Dueño_idDueño`) REFERENCES `dueño` (`idDueño`),
  ADD CONSTRAINT `fk_Perro_Raza1` FOREIGN KEY (`Raza_idRaza`) REFERENCES `raza` (`idRaza`);

--
-- Filtros para la tabla `raza`
--
ALTER TABLE `raza`
  ADD CONSTRAINT `fk_Raza_Tamaño` FOREIGN KEY (`Tamaño_idTamaño`) REFERENCES `tamaño` (`idTamaño`);

--
-- Filtros para la tabla `tarifa`
--
ALTER TABLE `tarifa`
  ADD CONSTRAINT `fk_Tarifa_Paseador1` FOREIGN KEY (`Paseador_idPaseador`) REFERENCES `paseador` (`idPaseador`),
  ADD CONSTRAINT `fk_Tarifa_Tamaño1` FOREIGN KEY (`Tamaño_idTamaño`) REFERENCES `tamaño` (`idTamaño`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
