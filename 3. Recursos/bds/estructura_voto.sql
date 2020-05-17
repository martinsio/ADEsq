/*Base de datos "Sistema de Voto - ADESQ*/


SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
CREATE DATABASE IF NOT EXISTS voto;
USE voto;
--
-- Base de datos: `voto`
--

----------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci PRIMARY KEY,
  `nombre` varchar(12) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido1` varchar(12) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `apellido2` varchar(12) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `pass` varchar(150) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;
-- --------------------------------------------------------




--
-- Estructura de tabla para la tabla `encuesta`
--

CREATE TABLE IF NOT EXISTS `encuesta` (
  `id` int(11) AUTO_INCREMENT PRIMARY KEY,
  `pregunta` varchar(100) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `private` int(1) NOT NULL,
  `fecha` varchar(20) COLLATE utf8mb4_spanish2_ci NOT NULL,
  FOREIGN KEY (email) REFERENCES usuarios(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;


-- FOREIGN KEYS


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opciones`
--

CREATE TABLE IF NOT EXISTS `opciones` (
  `id_respuesta` int(11) AUTO_INCREMENT PRIMARY KEY,
  `id_pregunta` int(11) NOT NULL,
  `respuesta` varchar(25) COLLATE utf8mb4_spanish2_ci NOT NULL,
  FOREIGN KEY (id_pregunta) REFERENCES encuesta(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `resultados`
--

CREATE TABLE IF NOT EXISTS `resultados` (
  `id_voto` int(11) AUTO_INCREMENT PRIMARY KEY,
  `id_encuesta` int(11) NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_respuesta` int(11) NOT NULL,
  FOREIGN KEY (id_encuesta) REFERENCES encuesta(id),
  FOREIGN KEY (id_respuesta) REFERENCES opciones(id_respuesta),
  FOREIGN KEY (email) REFERENCES usuarios(email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;




COMMIT;
