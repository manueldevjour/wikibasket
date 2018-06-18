-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-06-2018 a las 14:49:04
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tbasketball`
--
CREATE DATABASE IF NOT EXISTS `tbasketball` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `tbasketball`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `conferencia`
--

CREATE TABLE IF NOT EXISTS `conferencia` (
  `id_conferencia` int(1) NOT NULL,
  `conferencia` varchar(10) COLLATE utf8_bin NOT NULL,
  `imagen` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_conferencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `conferencia`
--

INSERT INTO `conferencia` (`id_conferencia`, `conferencia`, `imagen`) VALUES
(1, 'este', '../assets/conferences/east.png'),
(2, 'oeste', '../assets/conferences/west.png');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `equipos`
--

CREATE TABLE IF NOT EXISTS `equipos` (
  `team_id` int(11) NOT NULL,
  `team_name` varchar(100) COLLATE utf8_bin NOT NULL,
  `logo` varchar(100) COLLATE utf8_bin NOT NULL,
  `conferencia_id` int(1) NOT NULL,
  PRIMARY KEY (`team_id`),
  KEY `conferencia_id` (`conferencia_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `equipos`
--

INSERT INTO `equipos` (`team_id`, `team_name`, `logo`, `conferencia_id`) VALUES
(1610612737, 'Atlanta Hawks', '../assets/teams/hawks.png', 1),
(1610612738, 'Boston Celtics', '../assets/teams/celtics.png', 1),
(1610612739, 'Cleveland Cavaliers', '../assets/teams/cavs.png', 1),
(1610612740, 'New Orleans Pelicans', '../assets/teams/pelicans.png', 2),
(1610612741, 'Chicago Bulls', '../assets/teams/bulls.png', 1),
(1610612742, 'Dallas Mavericks', '../assets/teams/mavericks.png', 2),
(1610612743, 'Denver Nuggets', '../assets/teams/nuggets.png', 2),
(1610612744, 'Golden State Warriors', '../assets/teams/warriors.png', 2),
(1610612745, 'Houston Rockets', '../assets/teams/rockets.png', 2),
(1610612746, 'Los Angeles Clippers', '../assets/teams/clippers.png', 2),
(1610612747, 'Los Angeles Lakers', '../assets/teams/lakers.png', 2),
(1610612748, 'Miami Heat', '../assets/teams/heat.png', 1),
(1610612749, 'Milwaukee Bucks', '../assets/teams/bucks.png', 1),
(1610612750, 'Minnesota Timberwolves', '../assets/teams/timberwolves.png', 2),
(1610612751, 'Brooklyn Nets', '../assets/teams/nets.png', 1),
(1610612752, 'New York Knicks', '../assets/teams/knicks.png', 1),
(1610612753, 'Orlando Magic', '../assets/teams/magic.png', 1),
(1610612754, 'Indiana Pacers', '../assets/teams/pacers.png', 1),
(1610612755, 'Philadelphia 76ers', '../assets/teams/philly.png', 1),
(1610612756, 'Phoenix Suns', '../assets/teams/suns.png', 2),
(1610612757, 'Portland Trail Blazers', '../assets/teams/blazers.png', 2),
(1610612758, 'Sacramento Kings', '../assets/teams/kings.png', 2),
(1610612759, 'San Antonio Spurs', '../assets/teams/spurs.png', 2),
(1610612760, 'Oklahoma City Thunder', '../assets/teams/thunder.png', 2),
(1610612761, 'Toronto Raptors', '../assets/teams/raptors.png', 1),
(1610612762, 'Utah Jazz', '../assets/teams/jazz.png', 2),
(1610612763, 'Memphis Grizzlies', '../assets/teams/grizzlies.png', 2),
(1610612764, 'Washington Wizards', '../assets/teams/wizards.png', 1),
(1610612765, 'Detroit Pistons', '../assets/teams/pistons.png', 1),
(1610612766, 'Charlotte Hornets', '../assets/teams/hornets.png', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paises`
--

CREATE TABLE IF NOT EXISTS `paises` (
  `id_pais` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) COLLATE utf8_bin NOT NULL,
  `nombre` varchar(80) COLLATE utf8_bin NOT NULL,
  `nombrebonitoingles` varchar(80) COLLATE utf8_bin NOT NULL,
  `nombrebonitoespanol` varchar(80) COLLATE utf8_bin NOT NULL,
  `iso3` char(3) COLLATE utf8_bin DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `codigotelefonico` int(5) NOT NULL,
  `latitud` float NOT NULL,
  `longitud` float NOT NULL,
  PRIMARY KEY (`id_pais`),
  UNIQUE KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=240 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `paises`
--

INSERT INTO `paises` (`id_pais`, `iso`, `nombre`, `nombrebonitoingles`, `nombrebonitoespanol`, `iso3`, `numcode`, `codigotelefonico`, `latitud`, `longitud`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'Afganistán', 'AFG', 4, 93, 34.5755, 69.2401),
(2, 'AL', 'ALBANIA', 'Albania', 'Albania', 'ALB', 8, 355, 41.3275, 19.8187),
(3, 'DZ', 'ALGERIA', 'Algeria', 'Algeria', 'DZA', 12, 213, 36.7529, 3.04205),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'Samoa Americana', 'ASM', 16, 1684, -14.2756, -170.702),
(5, 'AD', 'ANDORRA', 'Andorra', 'Andorra', 'AND', 20, 376, 42.5063, 1.52183),
(6, 'AO', 'ANGOLA', 'Angola', 'Angola', 'AGO', 24, 244, -8.83999, 13.2894),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'Anguila', 'AIA', 660, 1264, 18.2148, -63.0574),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', 'Antártida', NULL, NULL, 0, -90, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'Antigua y Barbuda', 'ATG', 28, 1268, 17.1274, -61.8468),
(10, 'AR', 'ARGENTINA', 'Argentina', 'Argentina', 'ARG', 32, 54, 0, 0),
(11, 'AM', 'ARMENIA', 'Armenia', 'Armenia', 'ARM', 51, 374, 0, 0),
(12, 'AW', 'ARUBA', 'Aruba', 'Aruba', 'ABW', 533, 297, 0, 0),
(13, 'AU', 'AUSTRALIA', 'Australia', 'Australia', 'AUS', 36, 61, 0, 0),
(14, 'AT', 'AUSTRIA', 'Austria', 'Austria', 'AUT', 40, 43, 0, 0),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'Azerbaiyán', 'AZE', 31, 994, 0, 0),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'Bahamas', 'BHS', 44, 1242, 0, 0),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'Bahréin', 'BHR', 48, 973, 0, 0),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'Bangladesh', 'BGD', 50, 880, 0, 0),
(19, 'BB', 'BARBADOS', 'Barbados', 'Barbados', 'BRB', 52, 1246, 0, 0),
(20, 'BY', 'BELARUS', 'Belarus', 'Bielorrusia', 'BLR', 112, 375, 0, 0),
(21, 'BE', 'BELGIUM', 'Belgium', 'Bélgica', 'BEL', 56, 32, 0, 0),
(22, 'BZ', 'BELIZE', 'Belize', 'Belize', 'BLZ', 84, 501, 0, 0),
(23, 'BJ', 'BENIN', 'Benin', 'Benín', 'BEN', 204, 229, 0, 0),
(24, 'BM', 'BERMUDA', 'Bermuda', 'Bermuda', 'BMU', 60, 1441, 0, 0),
(25, 'BT', 'BHUTAN', 'Bhutan', 'Bután', 'BTN', 64, 975, 0, 0),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'Bolivia', 'BOL', 68, 591, 0, 0),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'Bosnia y Herzegovina', 'BIH', 70, 387, 0, 0),
(28, 'BW', 'BOTSWANA', 'Botswana', 'Botswana', 'BWA', 72, 267, 0, 0),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', 'Isla Bouvet', NULL, NULL, 0, 0, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'Brasil', 'BRA', 76, 55, 0, 0),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', 'Territorio Oceánico de las Indias Británicas', NULL, NULL, 246, 0, 0),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'Brunei Darussalam', 'BRN', 96, 673, 0, 0),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'Bulgaria', 'BGR', 100, 359, 0, 0),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'Burkina Faso', 'BFA', 854, 226, 0, 0),
(35, 'BI', 'BURUNDI', 'Burundi', 'Burundi', 'BDI', 108, 257, 0, 0),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'Camboya', 'KHM', 116, 855, 0, 0),
(37, 'CM', 'CAMEROON', 'Cameroon', 'Camerún', 'CMR', 120, 237, 0, 0),
(38, 'CA', 'CANADA', 'Canada', 'Canadá', 'CAN', 124, 1, 0, 0),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'Cabo Verde', 'CPV', 132, 238, 0, 0),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'Islas Caimán', 'CYM', 136, 1345, 0, 0),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'República Centroafricana', 'CAF', 140, 236, 0, 0),
(42, 'TD', 'CHAD', 'Chad', 'Chad', 'TCD', 148, 235, 0, 0),
(43, 'CL', 'CHILE', 'Chile', 'Chile', 'CHL', 152, 56, 0, 0),
(44, 'CN', 'CHINA', 'China', 'China', 'CHN', 156, 86, 0, 0),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', 'Islas Navidad', NULL, NULL, 61, 0, 0),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', 'Islas Cocos', NULL, NULL, 672, 0, 0),
(47, 'CO', 'COLOMBIA', 'Colombia', 'Colombia', 'COL', 170, 57, 0, 0),
(48, 'KM', 'COMOROS', 'Comoros', 'Comoras', 'COM', 174, 269, 0, 0),
(49, 'CG', 'CONGO', 'Congo', 'Congo', 'COG', 178, 242, 0, 0),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'La República Democrática del Congo', 'COD', 180, 242, 0, 0),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'Islas Cook', 'COK', 184, 682, 0, 0),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'Costa Rica', 'CRI', 188, 506, 0, 0),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'Costa de Marfil', 'CIV', 384, 225, 0, 0),
(54, 'HR', 'CROATIA', 'Croatia', 'Croacia', 'HRV', 191, 385, 0, 0),
(55, 'CU', 'CUBA', 'Cuba', 'Cuba', 'CUB', 192, 53, 0, 0),
(56, 'CY', 'CYPRUS', 'Cyprus', 'Chipre', 'CYP', 196, 357, 0, 0),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'República Checa', 'CZE', 203, 420, 0, 0),
(58, 'DK', 'DENMARK', 'Denmark', 'Dinamarca', 'DNK', 208, 45, 0, 0),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'Djibouti', 'DJI', 262, 253, 0, 0),
(60, 'DM', 'DOMINICA', 'Dominica', 'Dominica', 'DMA', 212, 1767, 0, 0),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'República Dominicana', 'DOM', 214, 1809, 0, 0),
(62, 'EC', 'ECUADOR', 'Ecuador', 'Ecuador', 'ECU', 218, 593, 0, 0),
(63, 'EG', 'EGYPT', 'Egypt', 'Egipto', 'EGY', 818, 20, 0, 0),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'El Salvador', 'SLV', 222, 503, 0, 0),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'Guinea Ecuatorial', 'GNQ', 226, 240, 0, 0),
(66, 'ER', 'ERITREA', 'Eritrea', 'Eritrea', 'ERI', 232, 291, 0, 0),
(67, 'EE', 'ESTONIA', 'Estonia', 'Estonia', 'EST', 233, 372, 0, 0),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'Etiopía', 'ETH', 231, 251, 0, 0),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'Las Malvinas', 'FLK', 238, 500, 0, 0),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'Islas Feroe', 'FRO', 234, 298, 0, 0),
(71, 'FJ', 'FIJI', 'Fiji', 'Fiji', 'FJI', 242, 679, 0, 0),
(72, 'FI', 'FINLAND', 'Finland', 'Finlandia', 'FIN', 246, 358, 0, 0),
(73, 'FR', 'FRANCE', 'France', 'Francia', 'FRA', 250, 33, 0, 0),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'Guyana francesa', 'GUF', 254, 594, 0, 0),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'Polinesia francesa', 'PYF', 258, 689, 0, 0),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', 'Tierras Australes y Antárticas Francesas', NULL, NULL, 0, 0, 0),
(77, 'GA', 'GABON', 'Gabon', 'Gabón', 'GAB', 266, 241, 0, 0),
(78, 'GM', 'GAMBIA', 'Gambia', 'Gambia', 'GMB', 270, 220, 0, 0),
(79, 'GE', 'GEORGIA', 'Georgia', 'Georgia', 'GEO', 268, 995, 0, 0),
(80, 'DE', 'GERMANY', 'Germany', 'Alemania', 'DEU', 276, 49, 0, 0),
(81, 'GH', 'GHANA', 'Ghana', 'Ghana', 'GHA', 288, 233, 0, 0),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'Gibraltar', 'GIB', 292, 350, 0, 0),
(83, 'GR', 'GREECE', 'Greece', 'Grecia', 'GRC', 300, 30, 0, 0),
(84, 'GL', 'GREENLAND', 'Greenland', 'Groenlandia', 'GRL', 304, 299, 0, 0),
(85, 'GD', 'GRENADA', 'Grenada', 'Granada', 'GRD', 308, 1473, 0, 0),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'Guadalupe', 'GLP', 312, 590, 0, 0),
(87, 'GU', 'GUAM', 'Guam', 'Guam', 'GUM', 316, 1671, 0, 0),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'Guatemala', 'GTM', 320, 502, 0, 0),
(89, 'GN', 'GUINEA', 'Guinea', 'Guinea', 'GIN', 324, 224, 0, 0),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'Guinea-Bissau', 'GNB', 624, 245, 0, 0),
(91, 'GY', 'GUYANA', 'Guyana', 'Guyana', 'GUY', 328, 592, 0, 0),
(92, 'HT', 'HAITI', 'Haiti', 'Haití', 'HTI', 332, 509, 0, 0),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', 'Isla Corazón e Isla Mcdonald', NULL, NULL, 0, 0, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'Santa Sede (Ciudad Estado del Vaticano)', 'VAT', 336, 39, 0, 0),
(95, 'HN', 'HONDURAS', 'Honduras', 'Honduras', 'HND', 340, 504, 0, 0),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'Hong Kong', 'HKG', 344, 852, 0, 0),
(97, 'HU', 'HUNGARY', 'Hungary', 'Hungría', 'HUN', 348, 36, 0, 0),
(98, 'IS', 'ICELAND', 'Iceland', 'Islandia', 'ISL', 352, 354, 0, 0),
(99, 'IN', 'INDIA', 'India', 'India', 'IND', 356, 91, 0, 0),
(100, 'ID', 'INDONESIA', 'Indonesia', 'Indonesia', 'IDN', 360, 62, 0, 0),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'República Islámica de Irán', 'IRN', 364, 98, 0, 0),
(102, 'IQ', 'IRAQ', 'Iraq', 'Irak', 'IRQ', 368, 964, 0, 0),
(103, 'IE', 'IRELAND', 'Ireland', 'Irlanda', 'IRL', 372, 353, 0, 0),
(104, 'IL', 'ISRAEL', 'Israel', 'Israel', 'ISR', 376, 972, 0, 0),
(105, 'IT', 'ITALY', 'Italy', 'Italia', 'ITA', 380, 39, 0, 0),
(106, 'JM', 'JAMAICA', 'Jamaica', 'Jamaica', 'JAM', 388, 1876, 0, 0),
(107, 'JP', 'JAPAN', 'Japan', 'Japón', 'JPN', 392, 81, 0, 0),
(108, 'JO', 'JORDAN', 'Jordan', 'Jordania', 'JOR', 400, 962, 0, 0),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'Kazajistán', 'KAZ', 398, 7, 0, 0),
(110, 'KE', 'KENYA', 'Kenya', 'Kenia', 'KEN', 404, 254, 0, 0),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'Kiribati', 'KIR', 296, 686, 0, 0),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'República Popular Democrática de Corea', 'PRK', 408, 850, 0, 0),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'República de Corea', 'KOR', 410, 82, 0, 0),
(114, 'KW', 'KUWAIT', 'Kuwait', 'Kuwait', 'KWT', 414, 965, 0, 0),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'Kirguistán', 'KGZ', 417, 996, 0, 0),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'República Popular Democrática de Laos', 'LAO', 418, 856, 0, 0),
(117, 'LV', 'LATVIA', 'Latvia', 'Letonia', 'LVA', 428, 371, 0, 0),
(118, 'LB', 'LEBANON', 'Lebanon', 'Líbano', 'LBN', 422, 961, 0, 0),
(119, 'LS', 'LESOTHO', 'Lesotho', 'Lesotho', 'LSO', 426, 266, 0, 0),
(120, 'LR', 'LIBERIA', 'Liberia', 'Liberia', 'LBR', 430, 231, 0, 0),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'Estado de Libia', 'LBY', 434, 218, 0, 0),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'Liechtenstein', 'LIE', 438, 423, 0, 0),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'Lituania', 'LTU', 440, 370, 0, 0),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'Luxemburgo', 'LUX', 442, 352, 0, 0),
(125, 'MO', 'MACAO', 'Macao', 'Macao', 'MAC', 446, 853, 0, 0),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'Antigua República Yugoslava de Macedonia', 'MKD', 807, 389, 0, 0),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'Madagascar', 'MDG', 450, 261, 0, 0),
(128, 'MW', 'MALAWI', 'Malawi', 'Malawi', 'MWI', 454, 265, 0, 0),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'Malasia', 'MYS', 458, 60, 0, 0),
(130, 'MV', 'MALDIVES', 'Maldives', 'Maldivas', 'MDV', 462, 960, 0, 0),
(131, 'ML', 'MALI', 'Mali', 'Mali', 'MLI', 466, 223, 0, 0),
(132, 'MT', 'MALTA', 'Malta', 'Malta', 'MLT', 470, 356, 0, 0),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'Islas Marshall', 'MHL', 584, 692, 0, 0),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'Martinica', 'MTQ', 474, 596, 0, 0),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'Mauritania', 'MRT', 478, 222, 0, 0),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'Islas Mauricio', 'MUS', 480, 230, 0, 0),
(137, 'YT', 'MAYOTTE', 'Mayotte', 'Mayotte, Departamento de Mayotte', NULL, NULL, 269, 0, 0),
(138, 'MX', 'MEXICO', 'Mexico', 'México', 'MEX', 484, 52, 0, 0),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'Estados Federados de Micronesia', 'FSM', 583, 691, 0, 0),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'República de Moldavia', 'MDA', 498, 373, 0, 0),
(141, 'MC', 'MONACO', 'Monaco', 'Mónaco', 'MCO', 492, 377, 0, 0),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'Mongolia', 'MNG', 496, 976, 0, 0),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'Montserrat', 'MSR', 500, 1664, 0, 0),
(144, 'MA', 'MOROCCO', 'Morocco', 'Marruecos', 'MAR', 504, 212, 0, 0),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'Mozambique', 'MOZ', 508, 258, 0, 0),
(146, 'MM', 'MYANMAR', 'Myanmar', 'Birmania', 'MMR', 104, 95, 0, 0),
(147, 'NA', 'NAMIBIA', 'Namibia', 'Namibia', 'NAM', 516, 264, 0, 0),
(148, 'NR', 'NAURU', 'Nauru', 'Nauru', 'NRU', 520, 674, 0, 0),
(149, 'NP', 'NEPAL', 'Nepal', 'Nepal', 'NPL', 524, 977, 0, 0),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'Países Bajos', 'NLD', 528, 31, 0, 0),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'Antillas Holandesas', 'ANT', 530, 599, 0, 0),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'Nueva Caledonia', 'NCL', 540, 687, 0, 0),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'Nueva Zelanda', 'NZL', 554, 64, 0, 0),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'Nicaragua', 'NIC', 558, 505, 0, 0),
(155, 'NE', 'NIGER', 'Niger', 'Níger', 'NER', 562, 227, 0, 0),
(156, 'NG', 'NIGERIA', 'Nigeria', 'Nigeria', 'NGA', 566, 234, 0, 0),
(157, 'NU', 'NIUE', 'Niue', 'Niue', 'NIU', 570, 683, 0, 0),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'Isla Norfolk', 'NFK', 574, 672, 0, 0),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'Islas Marianas del Norte', 'MNP', 580, 1670, 0, 0),
(160, 'NO', 'NORWAY', 'Norway', 'Noruega', 'NOR', 578, 47, 0, 0),
(161, 'OM', 'OMAN', 'Oman', 'Omán', 'OMN', 512, 968, 0, 0),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'Pakistán', 'PAK', 586, 92, 0, 0),
(163, 'PW', 'PALAU', 'Palau', 'Palau', 'PLW', 585, 680, 0, 0),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', 'Territorio Ocupado de Palestina', NULL, NULL, 970, 0, 0),
(165, 'PA', 'PANAMA', 'Panama', 'Panamá', 'PAN', 591, 507, 0, 0),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'Papua Nueva Guinea', 'PNG', 598, 675, 0, 0),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'Paraguay', 'PRY', 600, 595, 0, 0),
(168, 'PE', 'PERU', 'Peru', 'Perú', 'PER', 604, 51, 0, 0),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'Filipinas', 'PHL', 608, 63, 0, 0),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'Pitcairn', 'PCN', 612, 0, 0, 0),
(171, 'PL', 'POLAND', 'Poland', 'Polonia', 'POL', 616, 48, 0, 0),
(172, 'PT', 'PORTUGAL', 'Portugal', 'Portugal', 'PRT', 620, 351, 0, 0),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'Puerto Rico', 'PRI', 630, 1787, 0, 0),
(174, 'QA', 'QATAR', 'Qatar', 'Catar', 'QAT', 634, 974, 0, 0),
(175, 'RE', 'REUNION', 'Reunion', 'Reunión', 'REU', 638, 262, 0, 0),
(176, 'RO', 'ROMANIA', 'Romania', 'Rumanía', 'ROM', 642, 40, 0, 0),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'Federación Rusa (Rusia)', 'RUS', 643, 70, 0, 0),
(178, 'RW', 'RWANDA', 'Rwanda', 'Ruanda', 'RWA', 646, 250, 0, 0),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'Santa Helena', 'SHN', 654, 290, 0, 0),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'San Kitts y Nevis', 'KNA', 659, 1869, 0, 0),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'Santa Lucía', 'LCA', 662, 1758, 0, 0),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'San Pedro y Miquelón', 'SPM', 666, 508, 0, 0),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'San Vicente y las Granadinas', 'VCT', 670, 1784, 0, 0),
(184, 'WS', 'SAMOA', 'Samoa', 'Samoa', 'WSM', 882, 684, 0, 0),
(185, 'SM', 'SAN MARINO', 'San Marino', 'San Marino', 'SMR', 674, 378, 0, 0),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'Santo Tomás y Príncipe', 'STP', 678, 239, 0, 0),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'Arabia Saudí', 'SAU', 682, 966, 0, 0),
(188, 'SN', 'SENEGAL', 'Senegal', 'Senegal', 'SEN', 686, 221, 0, 0),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', 'Serbia y Montenegro', NULL, NULL, 381, 0, 0),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'Seychelles', 'SYC', 690, 248, 0, 0),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'Sierra Leona', 'SLE', 694, 232, 0, 0),
(192, 'SG', 'SINGAPORE', 'Singapore', 'Singapur', 'SGP', 702, 65, 0, 0),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'Eslovaquia', 'SVK', 703, 421, 0, 0),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'Eslovenia', 'SVN', 705, 386, 0, 0),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'Islas Salomón', 'SLB', 90, 677, 0, 0),
(196, 'SO', 'SOMALIA', 'Somalia', 'Somalia', 'SOM', 706, 252, 0, 0),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'Sudáfrica', 'ZAF', 710, 27, 0, 0),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', 'Islas Georgias del Sur y Sandwich del Sur', NULL, NULL, 0, 0, 0),
(199, 'ES', 'SPAIN', 'Spain', 'España', 'ESP', 724, 34, 40.3833, -3.71667),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'Sri Lanka', 'LKA', 144, 94, 0, 0),
(201, 'SD', 'SUDAN', 'Sudan', 'Sudán', 'SDN', 736, 249, 0, 0),
(202, 'SR', 'SURINAME', 'Suriname', 'Surinamm', 'SUR', 740, 597, 0, 0),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'Svalbard y Jan Mayen', 'SJM', 744, 47, 0, 0),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'Suazilandia', 'SWZ', 748, 268, 0, 0),
(205, 'SE', 'SWEDEN', 'Sweden', 'Suecia', 'SWE', 752, 46, 0, 0),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'Suiza', 'CHE', 756, 41, 0, 0),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'República Árabe Siria', 'SYR', 760, 963, 0, 0),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'Taiwán', 'TWN', 158, 886, 0, 0),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'Tayikistán', 'TJK', 762, 992, 0, 0),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'República Unida de Tanzania', 'TZA', 834, 255, 0, 0),
(211, 'TH', 'THAILAND', 'Thailand', 'Tailandia', 'THA', 764, 66, 0, 0),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', 'Timor', NULL, NULL, 670, 0, 0),
(213, 'TG', 'TOGO', 'Togo', 'Togo', 'TGO', 768, 228, 0, 0),
(214, 'TK', 'TOKELAU', 'Tokelau', 'Tokelau', 'TKL', 772, 690, 0, 0),
(215, 'TO', 'TONGA', 'Tonga', 'Tonga', 'TON', 776, 676, 0, 0),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'Trinidad y Tobago', 'TTO', 780, 1868, 0, 0),
(217, 'TN', 'TUNISIA', 'Tunisia', 'Túnez', 'TUN', 788, 216, 0, 0),
(218, 'TR', 'TURKEY', 'Turkey', 'Turquía', 'TUR', 792, 90, 0, 0),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'Turkmenistán', 'TKM', 795, 7370, 0, 0),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'Islas Turcas y Caicos', 'TCA', 796, 1649, 0, 0),
(221, 'TV', 'TUVALU', 'Tuvalu', 'Tuvalu', 'TUV', 798, 688, 0, 0),
(222, 'UG', 'UGANDA', 'Uganda', 'Uganda', 'UGA', 800, 256, 0, 0),
(223, 'UA', 'UKRAINE', 'Ukraine', 'Ucrania', 'UKR', 804, 380, 0, 0),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'Emiratos Árabes Unidos', 'ARE', 784, 971, 0, 0),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'Reino Unido', 'GBR', 826, 44, 0, 0),
(226, 'US', 'UNITED STATES', 'United States', 'Estados Unidos', 'USA', 840, 1, 0, 0),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', 'Islas Ultramarinas Menores de Estados Unidos', NULL, NULL, 1, 0, 0),
(228, 'UY', 'URUGUAY', 'Uruguay', 'Uruguay', 'URY', 858, 598, 0, 0),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'Uzbekistán', 'UZB', 860, 998, 0, 0),
(230, 'VU', 'VANUATU', 'Vanuatu', 'Vanuatu', 'VUT', 548, 678, 0, 0),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'Venezuela', 'VEN', 862, 58, 0, 0),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'Vietnam', 'VNM', 704, 84, 0, 0),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'Islas Vírgenes británicas', 'VGB', 92, 1284, 0, 0),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'Islas Vírgenes americanas', 'VIR', 850, 1340, 0, 0),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'Wallis y Futuna', 'WLF', 876, 681, 0, 0),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'Sáhara Occidental', 'ESH', 732, 212, 0, 0),
(237, 'YE', 'YEMEN', 'Yemen', 'Yemen', 'YEM', 887, 967, 0, 0),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'Zambia', 'ZMB', 894, 260, 0, 0),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'Zimbabue', 'ZWE', 716, 263, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporadas`
--

CREATE TABLE IF NOT EXISTS `temporadas` (
  `id_temporada` int(5) NOT NULL,
  `temporada` varchar(10) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_temporada`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `temporadas`
--

INSERT INTO `temporadas` (`id_temporada`, `temporada`) VALUES
(1, '2000-01'),
(2, '2001-02'),
(3, '2002-03'),
(4, '2003-04'),
(5, '2004-05'),
(6, '2005-06'),
(7, '2006-07'),
(8, '2007-08'),
(9, '2008-09'),
(10, '2009-10'),
(11, '2010-11'),
(12, '2011-12'),
(13, '2012-13'),
(14, '2013-14'),
(15, '2014-15'),
(16, '2015-16'),
(17, '2016-17'),
(18, '2017-18');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `usuario` varchar(50) COLLATE utf8_bin NOT NULL,
  `contrasena` varchar(100) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `administrador` tinyint(1) NOT NULL,
  `nombre_completo` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fecha_nacimiento` varchar(15) COLLATE utf8_bin NOT NULL,
  `id_franquicia` int(10) DEFAULT NULL,
  `id_pais` int(11) DEFAULT NULL,
  PRIMARY KEY (`usuario`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `id_franquicia` (`id_franquicia`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`usuario`, `contrasena`, `email`, `administrador`, `nombre_completo`, `fecha_nacimiento`, `id_franquicia`, `id_pais`) VALUES
('admin', '91f5167c34c400758115c2a6826ec2e3', 'administrador@gmail.com', 1, 'Administrador', '17-08-1996', 1610612741, 139),
('armeindo', '93c9e6449b59be1d266ce487394213b2', 'armeindo@gmail.com', 0, 'armeindo', '20-06-2018', 1610612742, 7),
('usuario2', '2fb6c8d2f3842a5ceaa9bf320e649ff0', 'usuario2@gmail.com', 0, 'Usuario 2', '23-12-1954', 1610612739, 6),
('usuuario', 'f8032d5cae3de20fcec887f395ec9a6a', 'usuario@gmail.com', 0, 'usuuario', '14-08-1996', 1610612743, 13);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `equipos`
--
ALTER TABLE `equipos`
  ADD CONSTRAINT `equipos_ibfk_1` FOREIGN KEY (`conferencia_id`) REFERENCES `conferencia` (`id_conferencia`);

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `paises` (`id_pais`),
  ADD CONSTRAINT `usuarios_ibfk_2` FOREIGN KEY (`id_franquicia`) REFERENCES `equipos` (`team_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
