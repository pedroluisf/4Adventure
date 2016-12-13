-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 01:00 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4adventure`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `catid` int(11) NOT NULL,
  `category` varchar(100) COLLATE latin1_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`catid`, `category`) VALUES
(2, 'Calendario'),
(4, 'Galeria'),
(3, 'Noticias'),
(1, 'Perfis');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `comid` int(11) NOT NULL,
  `pagid` int(11) NOT NULL,
  `name` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `comment` text COLLATE latin1_general_ci,
  `lastupdate` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comid`, `pagid`, `name`, `comment`, `lastupdate`) VALUES
(2, 2, 'j.p', 'gosto da tua moto', '2011-06-14 21:01:44'),
(3, 4, 'j,p', 'gosto desta atitude vossa \r\ne vela se fechas essa boca :)', '2011-06-14 21:02:47'),
(4, 5, 'j.p', 'óóóó´pá entao com esse cabedal esats a olhar para baixo !!!!hihihihihih xdxdxdxdx', '2011-06-14 21:03:54'),
(5, 1, 'j.p ', 'quatro lindas\r\n', '2011-06-14 21:06:42'),
(6, 3, 'j.p', 'que linda !!!!! mas que linda !!!!', '2011-06-14 21:07:52'),
(7, 5, 'Pedro LF', 'Éh... O sol tava forte em Faro :D', '2011-06-14 21:20:28'),
(8, 3, 'Pedro Ribeiro', 'Muito Fixe, sim senhor, mas a minha é mais bonita.\r\nXD', '2011-06-15 11:53:16'),
(9, 5, 'j.p', 'sim ....olha que nao ficas te muito atraz', '2011-06-16 15:44:27'),
(10, 3, 'J.P', 'XDXDXDXDXDXDXDXDXDXD', '2011-06-16 15:45:28');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `cntid` int(11) NOT NULL,
  `country_name` varchar(50) COLLATE latin1_general_ci NOT NULL,
  `country_code` varchar(2) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`cntid`, `country_name`, `country_code`) VALUES
(1, 'Portugal', 'PT'),
(2, 'England', 'EN');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `langid` int(11) NOT NULL,
  `language` varchar(100) COLLATE latin1_general_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`langid`, `language`) VALUES
(1, 'Português'),
(2, 'English');

-- --------------------------------------------------------

--
-- Table structure for table `motorcycles`
--

CREATE TABLE IF NOT EXISTS `motorcycles` (
  `mtrid` int(11) NOT NULL,
  `oficialurl` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `marcamodelo` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `customdesc` text COLLATE latin1_general_ci,
  `lastupdate` datetime DEFAULT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pagid` int(11) NOT NULL,
  `catid` int(11) DEFAULT NULL,
  `title` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `contents` text COLLATE latin1_general_ci,
  `lastupdate` datetime DEFAULT '1970-01-01 00:00:00',
  `url` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `thumb` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `datepost` datetime DEFAULT '1970-01-01 00:00:00',
  `lang` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`pagid`, `catid`, `title`, `contents`, `lastupdate`, `url`, `thumb`, `datepost`, `lang`) VALUES
(1, 1, 'Descri&ccedil;&atilde;o do Grupo', '<p>Partindo do princ&iacute;pio de que todos os indiv&iacute;duos t&ecirc;m caracter&iacute;sticas id&ecirc;nticas que os fazem identificar-se e relacionar-se socialmente mais com uns do que com outros, sabe-se tamb&eacute;m que cada cora&ccedil;&atilde;o tem a sua paix&atilde;o.</p>\n<p>Por assim ser e por gosto a praticamente todos os desportos motorizados, o grupo 4ADVENTURE decidiu consolidar-se, finalmente, ap&oacute;s v&aacute;rios anos de conv&iacute;vio e experi&ecirc;ncias sob duas rodas.</p>\n<p>Constitu&iacute;do por quatro elementos de seus nomes Pedro Ribeiro, Johnny Pedrosa, Jos&eacute; Pinho e Pedro Lu&iacute;s, este &eacute; um grupo motard que j&aacute; tem corrido o pa&iacute;s de Norte a Sul, e que tem tamb&eacute;m j&aacute; viajado para concentra&ccedil;&otilde;es como a grande Concentra&ccedil;&atilde;o Internacional de Faro.</p>\n<p>Nunca esquecendo que o mais importante de tudo &eacute; a atitude e a veracidade da paix&atilde;o por este mundo, o grupo 4ADVENTURE sagra-se como sendo um grupo que assenta na base da liberdade, uni&atilde;o, lealdade, irrever&ecirc;ncia e aventura.<br /><br /> O grupo 4ADVENTURE, como j&aacute; referido acima, nutre um especial gosto pela aventura, elemento este fulcral para tamanha viagem como esta.</p>\n<p>A desloca&ccedil;&atilde;o a Marrocos, para estes quatro amigos, assume assim o papel da descoberta de novos espa&ccedil;os, novos terrenos, novas sensa&ccedil;&otilde;es sob duas rodas. Um misto de emo&ccedil;&otilde;es que estes esperam arrecadar, podendo assim transform&aacute;-las em mem&oacute;rias, n&atilde;o s&oacute; para si como tamb&eacute;m para todos os amantes do mundo motard.</p>\n<p><br /><br /><img src="images/grupomota_pic.jpg" alt="Foto das motas do Grupo" width="95%" /></p>', '0000-00-00 00:00:00', 'grupo.php', 'images/profile_grupo.png', '0000-00-00 00:00:00', 1),
(2, 1, 'Pedro Ant&oacute;nio Rocha Pinto Cunha Ribeiro', '<img src="images/pedro_pic.jpg" alt="Foto de Pedro Ribeiro"/>\r\n<br />\r\n<h2>Dados Pessoais</h2>\r\n<p><b>Data de Nascimento:</b> 22-08-1974</p><br />\r\n<p><b>Naturalidade:</b> Portugu&ecirc;s</p><br />\r\n<p><b>Morada Actual:</b> Vila Nova de Gaia</p><br />\r\n<p><b>Profiss&atilde;o:</b> Empres&aacute;rio no ramo do Markting &amp; Publicidade</p><br />\r\n<p><b>Clube Futebolistico:</b> Sporting Clube de Portugal</p><br /><br />\r\n<h2>Motas at&eacute; &aacute; data:</h2>\r\n<p><b>1989 a 1989:</b> Yamaha RZ50</p><br /><p><b>1991 a 1993:</b> Yamaha Super Sports 50</p><br /><p><b>1993 a 1998:</b> Yamaha XV 250 Virago</p><br /><p><b>1998 a 2002:</b> Honda CB 750</p><br /><p><b>2002 a 2006:</b> Yamaha XVS 1600 Wild Star</p><br /><p><b>2006 a 2010:</b> Honda CBR 1100 XX</p><br /><p><b>2011 at&eacute; &aacute; data:</b> BMW F800GS</p><br />		\r\n<br />\r\n<h2>Experiencias Sobre duas Rodas:</h2>\r\n<p>17 Concentra&ccedil;&otilde;es Internacionais do Moto Clube de Faro (todas seguidas)</p><br /><p>1996 Concentra&ccedil;&atilde;o de Gerez de La Frontera</p><br /><p>Diversas Incurs&otilde;es ao n&iacute;vel do Todo Terreno</p><br /><p>Participa&ccedil;&atilde;o em diversas concentra&ccedil;&otilde;es Motards</p><br />\r\n<br />\r\n<h2>Gostos</h2>\r\n<p>Estar com os amigos</p><br /><p>Andar de Mota</p><br /><p>Estar com a Familia</p><br /><p>Ouvir Musica</p><br /><p>Ver Filmes</p><br /><p>Ver Moto GP</p><br /><p>WRC</p><br /><p>Trial TT</p><br />\r\n<br />\r\n<h2>Hobby&#39;s:</h2>\r\n<p>Jogar PS3</p><br /><p>Fazer BTT</p><br /><p>Fotografia</p><br />\r\n<img src="images/pedromota_pic.jpg" alt="Foto da mota de Pedro Ribeiro"/>', '0000-00-00 00:00:00', 'pedro.php', 'images/profile_pedro.png', '0000-00-00 00:00:00', 1),
(3, 1, 'Jos&eacute; Aubrey da Silva Pinho', '<img src="images/josepinho_pic.jpg" alt="Foto de Jose Aubrey"/>\r\n<br />\r\n<h2>Dados Pessoais</h2>\r\n<p><b>Data de Nascimento:</b> 11-11-1969</p><br />\r\n<p><b>Naturalidade:</b> Mo&ccedil;ambicano</p><br />\r\n<p><b>Morada Actual:</b> Sta Maria da Feira</p><br />\r\n<p><b>Profiss&atilde;o:</b> Empres&aacute;rio no ramo da decora&ccedil;&atilde;o</p><br />\r\n<p><b>Clube Futebolistico:</b> Futebol Clube do Porto</p><br /><br />\r\n<h2>Motas at&eacute; &aacute; data:</h2>\r\n<p><b>1987 a 1989:</b> Famel Zundapp XF 21</p><br /><p><b>1991 a 1992:</b> Honda CBR 1000F</p><br /><p><b>2003 a 2007:</b> Honda CBR 600 Sport F</p><br /><p><b>2007 a 2010:</b> Kawazaki ZX10R Ninja</p><br /><p><b>2010 a 2011:</b> BMW F650 GS</p><br /><p><b>2011 at&eacute; &aacute; data:</b> BMW F800GS</p><br />		\r\n<br />\r\n<h2>Experiencias Sobre duas Rodas:</h2>\r\n<p>7 Concentra&ccedil;&otilde;es Internacionais do Moto Clube de Faro (todas seguidas)</p><br /><p>Diversas Incurs&otilde;es ao n&iacute;vel do Todo Terreno</p><br /><p>Participa&ccedil;&atilde;o em diversas concentra&ccedil;&otilde;es Motards</p><br />\r\n<br />\r\n<h2>Gostos</h2>\r\n<p>Estar com os amigos</p><br /><p>Andar de Mota</p><br /><p>Fazer "o" Amor</p><br /><p>Estar com a Familia</p><br /><p>Ouvir Musica</p><br /><p>Ver Filmes</p><br /><p>Ver Moto GP</p><br /><p>Nata&ccedil;&atilde;o</p><br />\r\n<br />\r\n<h2>Hobby&#39;s:</h2>\r\n<p>Navegar na Internet</p><br /><p>Jogar Futsal</p><br />\r\n<img src="images/josepinhomota_pic.jpg" alt="Foto da mota de Jose Aubrey"/>', '0000-00-00 00:00:00', 'josepinho.php', 'images/profile_josepinho.png', '0000-00-00 00:00:00', 1),
(4, 1, 'Johnny Araujo Pedrosa', '<img src="images/jonhy_pic.jpg" alt="Foto de Jonhy Pedrosa"/>\r\n<br />\r\n<h2>Dados Pessoais</h2>\r\n<p><b>Data de Nascimento:</b> 11-07-1977</p><br />\r\n<p><b>Naturalidade:</b> Venezulano</p><br />\r\n<p><b>Morada Actual:</b> Espinho</p><br />\r\n<p><b>Profiss&atilde;o:</b> Pasteleiro / Comercial</p><br />\r\n<p><b>Clube Futebolistico:</b> Futebol Clube do Porto</p><br /><br />\r\n<h2>Motas at&eacute; &aacute; data:</h2>\r\n<p><b>2006 a 2007:</b> Yamaha XT 600</p><br /><p><b>2007 a 2009:</b> Kawazaki KLE 500</p><br /><p><b>2009 at&eacute; &aacute; data:</b> Yamaha XTZ 660 T&eacute;n&eacute;r&eacute;</p><br />		\r\n<br />\r\n<h2>Experiencias Sobre duas Rodas:</h2>\r\n<p>Diversas Incurs&otilde;es ao n&iacute;vel do Todo Terreno</p><br /><p>Viagem a Marrocos em 2010</p><br /><p>Participa&ccedil;&atilde;o em diversas concentra&ccedil;&otilde;es Motards</p><br />\r\n<br />\r\n<h2>Gostos</h2>\r\n<p>Ouvir Musica</p><br /><p>Andar de Mota</p><br /><p>Estar com os amigos</p><br /><p>Todo o Terreno 4x4</p><br /><p>Viagar</p><br />\r\n<br />\r\n<h2>Hobby&#39;s:</h2>\r\n<p>Navegar na Internet</p><br /><p>Ler</p><br />\r\n<img src="images/jonhymota_pic.jpg" alt="Foto da mota de Jonhy Pedrosa"/>', '0000-00-00 00:00:00', 'jonhy.php', 'images/profile_jonhy.png', '0000-00-00 00:00:00', 1),
(5, 1, 'Pedro Luis Cardoso Vasques Ferreira', '<img src="images/pedrolf_pic.jpg" alt="Foto de Pedro Luis Ferreira"/>\r\n<br />\r\n<h2>Dados Pessoais</h2>\r\n<p><b>Data de Nascimento:</b> 10-06-1976</p><br />\r\n<p><b>Naturalidade:</b> Portugu&ecirc;s</p><br />\r\n<p><b>Morada Actual:</b> Porto</p><br />\r\n<p><b>Profiss&atilde;o:</b> Programador de Inform&aacute;tica</p><br />\r\n<p><b>Clube Futebolistico:</b> Futebol Clube do Porto</p><br /><br />\r\n<h2>Motas at&eacute; &aacute; data:</h2>\r\n<p><b>2001 a 2003:</b> Honda CB 500</p><br /><p><b>2003 a 2008:</b> Yamaha YZF 1000 ThunderAce (gas&oacute;leo)</p><br /><p><b>2008 a 2008:</b> Kawasaki ZX12-R Ninja</p><br /><p><b>2009 a 2011:</b> Kawasaki KLE 600 Versys</p><br /><p><b>2011 at&eacute; &aacute; data:</b> Yamaha XTZ 660 Tener&eacute;</p><br />\r\n<br />\r\n<h2>Experiencias Sobre duas Rodas:</h2>\r\n<p>7 Concentra&ccedil;&otilde;es Internacionais do Moto Clube de Faro</p><br /><p>Diversas Incurs&otilde;es ao n&iacute;vel do Todo Terreno</p><br /><p>Participa&ccedil;&atilde;o em diversas concentra&ccedil;&otilde;es Motards</p><br />\r\n<br />\r\n<h2>Gostos</h2>\r\n<p>Estar com os amigos</p><br /><p>Andar de Mota</p><br /><p>Nata&ccedil;&atilde;o</p><br /><p>Filmes Ac&ccedil;&atilde;o</p><br /><p>Esparguete Carbonara</p><br />\r\n<br />\r\n<h2>Hobby&#39;s:</h2>\r\n<p>Muscula&ccedil;&atilde;o</p><br /><p>Boxe / MMA</p><br /><p>Counter Strike Source</p><br />\r\n<br />\r\n<img src="images/pedrolfmota_pic.jpg" alt="Foto da mota de Pedro Luis Ferreira"/>', '0000-00-00 00:00:00', 'pedrolf.php', 'images/profile_pedrolf.png', '0000-00-00 00:00:00', 1),
(6, 3, 'Dia 0 - Tomar', '<p>Zero perguntais v&oacute;s&hellip; Sim &eacute; verdade. Talvez n&atilde;o tenhamos contado tudo. Mas de verdade diga-se que nem n&oacute;s pr&oacute;prios imagin&aacute;vamos sair um dia antes. Mas visto bem as coisas at&eacute; nem era m&aacute; ideia. Sa&iacute;r um dia antes, fazer parte da viagem mais chata (AE) e desta forma evit&aacute;vamos ter de acordar &agrave;s 5h30 da manh&atilde; de ter&ccedil;a-feira.</p>\n<p>Opah!! Tudo o que seja para evitar acordar cedo contem comigo.</p>\n<p>Assim sendo a partida oficial foi segunda-feira &agrave;s 23h. Ou seria, n&atilde;o fosse o mesmo atrasado de sempre.</p>\n<p>O ideal seria arranjar sitio para passar a noite o mais perto poss&iacute;vel de Santa&rdquo;Guida&rdquo; (aka Santa Margarida) para desta forma podermos acordar e arrancar directo para o ponto alto da viagem. O off-road.</p>\n<p>Feitos 200 e qualquer coisa Km de estrada ficou decidido que Tomar at&eacute; poderia ser uma boa hip&oacute;tese de arranjar dormida e nem fic&aacute;vamos assim t&atilde;o longe do pretendido.</p>\n<p>Tomar ah Tomar&hellip; A cidade dos bailes, da ca&ccedil;a e do &ldquo;j&aacute; o conhe&ccedil;o de qualquer lado&rdquo;.</p>\n<p>Ok dito assim provavelmente n&atilde;o se percebo o sentido. Ent&atilde;o imaginem o seguinte:~</p>\n<p>Chegados a Tomar, cidade ainda em rescaldo da famosa festa dos tabuleiros, que ocorre de quatro em quatro anos, o &uacute;nico s&iacute;tio que encontramos para passar a noite &agrave;s 2h00 da manh&atilde; era o hotel dos Templ&aacute;rios. 4 estrelas&hellip; Sim 4. Escusado ser&aacute; dizer que a reac&ccedil;&atilde;o de alguns dos intervenientes do evento ao pre&ccedil;o de 130&euro; por quarto casal n&atilde;o foi propriamente da melhor&hellip;</p>\n<p>Mas a necessidade move a raz&atilde;o e&hellip; Olha ao menos podemos dizer que come&ccedil;amos &ldquo;&agrave; Grande&rdquo;!!!</p>\n<p>Piscina, pequeno almo&ccedil;o de luxo, arquitectura contempor&acirc;nea, garagem para as motas, arranjos de costura gr&aacute;tis (eheheh estas cal&ccedil;as XXXL&hellip; j&aacute; n&atilde;o fazem cal&ccedil;as para homens). At&eacute; t&iacute;nhamos uma festa da faculdade (a dar as ultimas, diga-se) com 20 pessoas no m&aacute;ximo, mas sempre tinha cerveja&hellip; e a 50 metros do hotel.</p>\n<p>N&atilde;o, n&atilde;o est&aacute;vamos mal.</p>\n<p>Claro que a primeira frase que o recepcionista disse quando viu o Pedro LF foi: &ldquo;Mas eu n&atilde;o o conhe&ccedil;o de algum lado?&rdquo;&hellip; Tinha de ser&hellip;</p>\n<p>Mas logo a seguir fomos presenteados com mais duas. Mal fomos beber uma cerveja e j&aacute; com as t-shirts vestidas do evento, e com o camuflado respectivo da cor de cada mota (t&aacute;vamos bonitos :D) encontramos uma personagem caricata, no m&iacute;nimo, que nos pergunta: &ldquo;Voc&ecirc;s v&ecirc;m do baile?&rdquo;.</p>\n<p>Assim que explicamos que n&atilde;o, que &iacute;amos para Marrocos, temos a resposta: &ldquo;Ah, v&atilde;o ca&ccedil;ar a Marrocos!!&rdquo; :S Ca&ccedil;ar?? Seria dos camuflados??</p>\n<p>Estava visto que a viagem prometia. Duas horas de gargalhadas depois, eram 4h da manh&atilde;.</p>\n<p>Era hora de dormir. O dia seguinte prometia&hellip;</p>', '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos0/start.jpg', '1970-01-01 00:00:00', 1),
(7, 3, 'Dia 1 - aventura Off Road', '<p>O dia come&ccedil;ou com a partida do Hotel Os Templ&aacute;rios, rumo ao quartel de Santa Margarida, para dar inicio &aacute; nossa grande aventura.</p>\r\n<p>Na subida para o quartel, tivemos de fazer uma pequena paragem no desdenrasca, para desenrascar uma cal&ccedil;as para o Johnny, porque este n&atilde;o vinha a condizr, e n&atilde;o estavamos todos &ldquo;pipis&rdquo;. Depois do Johnny devidademente equipado, seguimos para a porta de armas do quartel. Paramos para ir falar com os P.M.s, para nos deixarem passar pela grande recta, come&ccedil;ar com a nossa aventura pelos montes alentejanos.</p>\r\n<p>Depois de negada a passagem, e nos deixarem um lugar em branco no espa&ccedil;o destinado para o quartel no nosso album de viagem, demos a volta &aacute; situa&ccedil;&atilde;o, contornando o quartel. Pior para eles, que perderam a hipotese de ver os 4Adventure em ac&ccedil;&atilde;o, ou ent&atilde;o foi melhor assim, n&atilde;o fosse a mota do Pedro ou do Johnny mandar um rater e eles pensarem que estavam em guerra.</p>\r\n<p>Entramos na terra, e come&ccedil;amos a desbrabar terreno pelas lesirias ribatejanas, mas talvez fosse um erro ter-mos come&ccedil;ado numa faze t&atilde;o inicial da viagem. Diga-se de passagem, subir montes e vales com motas super carregadas, n&atilde;o era propriamente p&ecirc;ra doce, mas mesmo assim, ainda aguenta-mos umas corajosas 4 horas, at&eacute; come&ccedil;ar a sentir as maselas.</p>\r\n<p>Estavamos receosos de cair, mas tudo correu bem durante as primeiras goras, at&eacute; o Pedro R. abrir as hostilidades. Apartir de ai, foi um fartote de tombos, quedas, reboques e enrabadelas.</p>\r\n<p>Passo a explicar: tombos e quedas era o prato principal, acompanhados de um ligeiro reboque ocasional e salpicada com uma colis&atilde;o da BMW do Jos&eacute; e a YAMAHA do Pedro L. Danos ocorridos na &uacute;ltima hora de viagem: um selector de mudan&ccedil;a empenado, duas direc&ccedil;&otilde;es desalinhadas, dois piscas partidos, uma viseira sem apoios, protector de m&atilde;os partido, carnagens riscadas e partidas, mas felizmente contamos com apio de Antero e Filhos para suavisar estas maselas, j&aacute; para n&atilde;o falar das nodas negras cortes e arranh&otilde;es&eacute;dia passou a uns dr&aacute;ticos</p>\r\n<p>Tinhamos feito at&eacute; ent&atilde;o uma media de 60km/h, mas na &uacute;ltima hora essa nossa m&eacute;dia passou a uns dr&aacute;ticos 5km/h. &Egrave; que o tempo que se perdia entre motas atoladas, motas no ch&atilde;o, motas rebocadas e a pausa necess&aacute;ria para refrescar,digamos que a &uacute;ltima hora de viagem, foi a que mais nos derriou.</p>\r\n<p>O terreno era extremamente acidentado, mas por incrivel que pareca &eacute; preferivel cair neste terreno pois &eacute; sempre mais suave do que seria em estrada.</p>\r\n<p>Por uma quest&atilde;o de timing, e para cumprir calendario (e convenha-mos que o can&ccedil;asso j&aacute; dava ares da sua gra&ccedil;a), decidimos ent&atilde;o deixar a terra, e enveredar pela estrada para tentar chegar ao Algarve ainda no final do dia, quando nos deparamos com uma situa&ccedil;&atilde;o bizarra. Tinhamos andado a ultima meia hora e diga-se, a mais dificil, a lutar contra o terreno quando constatamos que tinhamos andado &agrave;s vostas, pois acabamos por passar num mesmo local duas vezes.</p>\r\n<p>Tal feito merece o louvor do fervoroso empenho de um dos nossos navegadores de servi&ccedil;o (Jonhy), que por quest&otilde;es de sa&uacute;de (preguicite aguda) dos 180 pontos tirados para a navega&ccedil;&atilde;o do percurso off-road apenas se dignou a passar 18 para o GPS.</p>\r\n<p>Paramos para reabastecer energias e encontramos um caf&eacute; com duas &ldquo;mo&ccedil;oilas&rdquo; no m&iacute;nimo caricatas. Menos mal, sempre nos ofereceram a ronda de gelados. Foram esses e as &aacute;guas transportadas pelo Jos&eacute; numa arca concebido para trabalhar pelo isqueiro que nos safaram naquela tosta de dia.</p>\r\n<p>Fizemos o resto do percurso pelas estradas do interior e o que perdemos em velocidade das AE ganhamos pelas paisagens e curvas fant&aacute;sticas que fomos presenteados.</p>\r\n<p>L&aacute; chegamos ao inicio da noite a Vila Real de Santo Ant&oacute;nio e embora conseguissemos um hotel, quase n&atilde;o conseguimos arranjar local para comer. Porra pah, ainda nem eram 23h. Vimos n&oacute;s do Norte habituados a comer a qualquer hora e esta terra de turistas, n&atilde;o tem cozinhas abertas depois das 22h. Ficamos incr&eacute;dulos.</p>\r\n<p>Devia ser dos tombos, mas aqueles que menos provaram a terra de perto, estavam ainda cheios de pica para sair &agrave; noite. Azar o deles que estavam em minoria e n&atilde;o conseguiram arrastar os outros, que quase nem tinham forlas para levantar os garfo para comer os bifes feitos com tanta contrariedade pela cozinheira de servi&ccedil;o.</p>', '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos1/282573_248303158515680_226099240736072_1071482_92985_n.jpg', '1970-01-01 00:00:00', 1),
(8, 3, 'Dia 2 - Marrocos', '<p>O dia por todos falado havia chegado. Este era finalmente o dia que tanto se planeou. Um dia apenas para tentar ter um vislumbre de uma realidade que nem por sombras poder&iacute;amos ter ideia que existia.</p>\r\n<p>Come&ccedil;ou desde cedo, direi at&eacute; desde o dia anterior, devido a muitos de n&oacute;s come&ccedil;armos a acusar o cansa&ccedil;o sentido depois do baptismo de off-road... Colocou-se no ar a quest&atilde;o se n&atilde;o ter&iacute;amos &ldquo;mordido mais do que conseguir&iacute;amos comer&rdquo;. &Eacute; que para poder viver a verdadeira emo&ccedil;&atilde;o de atravessar a imensid&atilde;o do deserto e sentir a verdadeira liga&ccedil;&atilde;o com os elementos sobre as nossas m&aacute;quinas, ter&iacute;amos de ter certezas que pelo menos chegar&iacute;amos a casa com todos e tudo o que sa&iacute;mos.</p>\r\n<p>E sejamos realistas&hellip; O ideal mesmo era poder ver Marrocos inteiro, come&ccedil;ando pelas cidades e passando pela zonas mais interessantes e in&oacute;spitas onde pud&eacute;ssemos passar horas a andar de mota sem ver ningu&eacute;m. Essa sim seria uma experi&ecirc;ncia em pleno. Mas passear num pa&iacute;s distante sem conhecer ningu&eacute;m , apenas com um mapa e uma b&uacute;ssola e carradas de boa vontade, ainda &eacute;ramos quatro pessoas em quatro motas, sem carro de apoio, mec&acirc;nicos, pe&ccedil;as ou sequer pneus sobresselentes. Logo qualquer aventura mais efusiva teria de ser contida sob pena de nem sequer poder voltar para tr&aacute;s pela mesma mota que nos levou.</p>\r\n<p>J&aacute; para n&atilde;o dizer que todos est&aacute;vamos conscientes que no dia seguinte quer&iacute;amos estar em Faro prontos para assistir ao concerto de Iron Maiden, comemorativo dos 30 anos de concentra&ccedil;&atilde;o e que sem d&uacute;vida alguma nenhum de n&oacute;s iria querer perder.</p>\r\n<p>Portanto na pr&aacute;tica t&iacute;nhamos aquele dia apenas. E mais nenhum&hellip;</p>\r\n<p>Feitas as contas, est&aacute;vamos em Vila Real de Santo Ant&oacute;nio, a mais de 400 km de Tarifa em Espanha, onde pod&iacute;amos apanhar o ferry que nos levaria a Marrocos. Seria imposs&iacute;vel imaginar que embora s&oacute; t&iacute;vessemos um dia dispon&iacute;vel, n&atilde;o ir&iacute;amos por p&eacute; em &Aacute;frica. Afinal, h&aacute; muita gente que vive uma vida sem cruzar um continente. Ao menos essa meta moral seria alcan&ccedil;ada.</p>\r\n<p>Assim sendo toca a pegar nas motas e fazer viagem at&eacute; Espanha, que t&iacute;nhamos um ferry para apanhar.</p>\r\n<p>Depois de algumas horas e quil&oacute;metros feitos por aquelas maravilhosas estradas espanholas, onde se andam quase 400 quil&oacute;metros de auto-estrada rodeados de paisagens magn&iacute;ificas de girass&oacute;is a perder de vista, separadores centrais adornados com flores de cores brancas e rubis intercaladas de tr&ecirc;s para um, campos e campos de animais de pasto, e quintas enormes, todas plantadas e a rejubilar de vida e cor (digo sinceramente que me deixou um sabor agridoce, saber que os nuestros hermanos vivam a crise tal como n&oacute;s, n&atilde;o desistem de plantar e fazer render a terra, ao passo que n&oacute;s deixamos vastid&otilde;es de campos sem serem aproveitados) eis que vislumbramos ao longe o destino. &Aacute;frica que se apresentava como uma sombra no horizonte, ainda muito distante, mas apenas a 35 minutos de barco. Dizem eles&hellip; (informo desde j&aacute; que &eacute; mentira, pois fizemos uma viagem a todo o vapor e demoramos mais de 50 minutos s&oacute; para cruzar o estreito).</p>\r\n<p>Adquiridos os bilhetes, colocou-se desde logo no ar a quest&atilde;o. Onde ir&iacute;amos dormir? Afinal embora o sonho era experimentar as tendas que trouxemos fazer um verdadeiro campismo selvagem no meio do deserto, isso seria imposs&iacute;vel devido ao nosso tempo dispon&iacute;vel, pelo que no m&aacute;ximo poder&iacute;amos procurar um hotel por l&aacute; para passar a noite e voltar no dia seguinte. Ainda eram apenas quatro horas da tarde, mas depois da travessia e da alf&acirc;ndega n&atilde;o ir&iacute;amos ter propriamente muito tempo para procurarmos solu&ccedil;&otilde;es que agradassem a todos. Outra hip&oacute;tese seria ir a Marrocos e voltarmos no mesmo dia. Perguntamos a opini&atilde;o ao agente de turismo espanhol que nos vendeu bilhetes e este respondeu-nos que dever&iacute;amos procurar uma cidade perto (30 km) chamada Asirah e l&aacute; ter&iacute;amos hotel dispon&iacute;vel. Referiu tamb&eacute;m que havia duas principais rotas. Uma litoral que seria a mais aconselh&aacute;vel e outra que levaria ao interior, mas que dever&iacute;amos evitar j&aacute; que esta poderia ser muito perigosa. N&atilde;o nego que esta escolha de palavras deixou alguns de n&oacute;s meio em estado de &ldquo;alerta&rdquo;.</p>\r\n<p>O certo &eacute; que a rota para o interior estava fora de quest&atilde;o desde o inicio, pois nem chegar&iacute;amos a lado nenhum em algumas horas. Opt&aacute;mos ent&atilde;o por seguir a rota do litoral e pensar depois no local onde ficar, pois nada como ver para escolher. Sem compromissos, apenas vamos ver o que existe do outro lado.</p>\r\n<p>Chegada a hora do barco, ainda est&aacute;vamos n&oacute;s a comer uns bocadillos de j&aacute;mom com queso e umas cervezas perto do porto. Apress&aacute;mo-nos para o ferry, na nossa inoc&ecirc;ncia de n&atilde;o chegar atrasados e perder o barco, mas depois apercebemo-nos que este n&atilde;o era desde logo um exemplo de pontualidade. J&aacute; para n&atilde;o referir que todo o processo alfandeg&aacute;rio demorou o seu tempo.</p>\r\n<p>Chegado ao barco a primeira impress&atilde;o passou pela quantidade de &ldquo;mohammed&rdquo;s que nos rodeavam. Ainda nem t&iacute;nhamos sa&iacute;do da Europa e j&aacute; est&aacute;vamos em minoria. Come&ccedil;amos logo a perceber que est&aacute;vamos a &ldquo;jogar fora&rdquo;.</p>\r\n<p>Uma coisa era certa. Ter&iacute;amos de ter cuidado com o que diss&eacute;ssemos ou fiz&eacute;ssemos, pois n&atilde;o est&aacute;vamos na nossa terra e como tal qualquer situa&ccedil;&atilde;o de mau entendimento poderia descarrilar para algo mais perigoso num instante. Logo haveria que tentar limitar qualquer situa&ccedil;&atilde;o o mais poss&iacute;vel. Algo que se provou ser dif&iacute;cil, desde o primeiro minuto que entramos no barco, pois come&ccedil;&aacute;mos a perceber como a maneira que se atravessam rotundas em Tanger, &eacute; a maneira como se respeitam as filas para carimbar o passaporte ou outro fila qualquer, diga-se&hellip; quem chegar primeiro ou mostrar mais convic&ccedil;&atilde;o aka loucura, passa &agrave; frente. E tentem discutir com algu&eacute;m que s&oacute; fala &aacute;rabe em portugu&ecirc;s&hellip; boa sorte&hellip;</p>\r\n<p>O certo &eacute; que assim que desembarcamos em Tanger instalou-se o caos. Come&ccedil;ou com as quase duas horas perdidas na alf&acirc;ndega onde fomos prontamente rodeados de &ldquo;prest&aacute;veis&rdquo; locais que se faziam passar de assistentes que num &aacute;pice nos arrancaram os passaportes da m&atilde;o e nos pediram os documentos das motas e algum extra para podermos avan&ccedil;ar com o processo. Aparentemente fomos logo ca&ccedil;os na primeira armadilha colocada aos turistas que aqui entram. Tudo tem um pre&ccedil;o. E aparentemente nunca &eacute; suficiente, pois cada vez v&ecirc;m mais assistentes que nos dizem que falta preencher outro papel e para isso custa mais tanto.</p>\r\n<p>Depois do trauma, veio a li&ccedil;&atilde;o, ensinada por um bendito agente da lei, que deixo j&aacute; aqui o meu reparo extremamente positivo a todos os policiais que conseguem manter a calma no meio de todo aquele p&acirc;nico e conseguem repor a ordem e nos restituir a liberdade, e que nos alertou para que segu&iacute;ssemos viagem e n&atilde;o lig&aacute;ssemos a nada nem d&eacute;ssemos dinheiro a ningu&eacute;m, pois todo o servi&ccedil;o era gratuito. Pena j&aacute; termos largado mais de 40 euros s&oacute; nessa hist&oacute;ria&hellip;</p>\r\n<p>Come&ccedil;ou com um alerta. Mas uma pequena amostra comparado ao que veio a seguir. Tanger era simplesmente massivo. Enorme, cheio de gente, confuso, barulhento, sem regras, com uma experi&ecirc;ncia de condu&ccedil;&atilde;o de uma qualquer super metr&oacute;pole numa atarefada hora de ponta aliada ao caos de milhares de pessoas que a qualquer momento apareciam de todos os lados, fosse a p&eacute;, de bicicleta, carro, quads, triciclos e misturada com uma pitada de ignor&acirc;ncia/neglig&ecirc;ncia/desrespeito das comuns regras de transito &hellip; tudo o que nos pud&eacute;ssemos lembrar era certo de encontrar ao virar de qualquer esquina em Tanger. A cidade era de si enorme, cheia de grandes empreendimentos imobili&aacute;rios e parecia estar em cont&iacute;nua expans&atilde;o, pois por todo o lado se viam grandes blocos de apartamentos em constru&ccedil;&atilde;o ou em demoli&ccedil;&atilde;o para dar lugar a outros. Muitos deles aparentavam estar inclusive abandonados h&aacute; anos, ainda semi acabados. Uma completa loucura de cimento rodeado de mato e terreno selvagem. A cidade em si estava apinhada de pessoas. Em todo o lado se viam pessoas a p&eacute;, em caf&eacute;s, &agrave; janela, sentados nas ombreiras das portas, debaixo de uma sombra, encostados aos carros, sentados na beira da estrada, a conversar no meio da estrada&hellip; n&atilde;o sei como dizer isto. Parecia que para qualquer lado que se olhasse v&iacute;amos algu&eacute;m com algo a fazer alguma coisa. At&eacute; uma manifesta&ccedil;&atilde;o conseguimos ver. Felizmente apenas empunhavam bandeiras&hellip;</p>\r\n<p>Tentamos fugir do caos da cidade, rumar a Asirah para procurar o hotel que nos tinha sido recomendado. Mas logo a&iacute; se colocaram problemas. O GPS de servi&ccedil;o at&eacute; ent&atilde;o tinha-se avariado com o calor ainda em Espanha, mas tamb&eacute;m n&atilde;o seria por a&iacute;, afinal este n&atilde;o tinha mapas de Marrocos. Restava um mapa em papel e umas placas escritas em &Aacute;rabe que nenhum de n&oacute;s sabia o que diziam. Depois de um quantos desvios errados come&ccedil;amos a perceber o quanto nos encontramos habituados a estas novas tecnologias e ao encontrar uma fal&eacute;sia que dava para uma praia, paramos para fazer um ponto de situa&ccedil;&atilde;o.</p>\r\n<p>T&iacute;nhamos chegado a Marrocos. O nosso objectivo principal estava cumprido. No entanto havia um sabor agridoce, pois o nosso verdadeiro objectivo era a calma e o vazio do deserto, n&atilde;o uma confus&atilde;o capaz de deixar qualquer capital Europeia em hora de ponta a parecer um passeio de meninos &agrave; beira mar. Para passar a noite em Marrocos ter&iacute;amos de procurar um hotel que deixasse guardar as motas em local seguro, pois seria loucura deix&aacute;-las sozinhas durante a noite, mas sem local definido t&iacute;nhamos de decidir se ir&iacute;amos arriscar passar o fim de tarde &agrave; procura ou tentar apanhar o &uacute;ltimo Ferry, que estava para sair e era a &uacute;ltima hip&oacute;tese de tentar voltar nesse mesmo dia.</p>\r\n<p>N&atilde;o sei se seria o trauma ainda sentido pelos agentes alfandeg&aacute;rios, se pelo stress induzido pela condu&ccedil;&atilde;o naquelas estradas que nem passeios tinham, se pela quantidade avassaladora de pessoas que constantemente nos rodeavam ou da desconfian&ccedil;a natural que temos em qualquer ambiente que nos &eacute; estranho, ou se pela pr&oacute;pria cidade n&atilde;o ser assim t&atilde;o cativante. Ou direi mesmo bonita. O certo &eacute; que nunca uma decis&atilde;o se tornou t&atilde;o un&acirc;nime como quando todos colocamos o descanso nas motas naquela escarpa &agrave; beira mar. Todos n&oacute;s preferimos voltar a Espanha e dormir por l&aacute;. Era mais calmo, era mais sossegado, era mais&hellip; mais f&eacute;rias.</p>\r\n<p>Assim que dissemos isto, degulamos uma garrafa de &aacute;gua cada e voltamos para o ferry, sabendo que para isso ainda ter&iacute;amos de enfrentar todo o mesmo caos do transito, da cidade, da multid&atilde;o, da alfandega, dos assistentes&hellip; Mas enfrentamos com outra atitude. Afinal em Roma s&ecirc; romano. Assumimos a condu&ccedil;&atilde;o mais agressiva de hora de ponta, aproveitando qualquer buraquinho para ziguezaguear entre os carros para vencer o sem&aacute;foro que estava para fechar. Mas uma coisa &eacute; certa. Encontramos o ferry mais r&aacute;pido que este teve tempo para sair. E coitados dos &ldquo;assistentes&rdquo; que se cruzassem &agrave; nossa frente.</p>\r\n<p>Claro que assim que os policiais que nos tinham visto a entrar estranharam estarmos a voltar t&atilde;o cedo, o que levou a alguns coment&aacute;rios relativamente ao &ldquo;cabedal&rdquo; do Pedro e o sentimento avassalador sentido perante tantas pessoas pequeninas&hellip; Ora a&iacute; est&aacute; mais uma prova que tamanho n&atilde;o &eacute; documento. :D</p>\r\n<p>Depois de sair do ferry encontramos um hotel a 4 km de Tarifa com um pequeno anexo com habita&ccedil;&otilde;es duplas com lugarzinho para as motas, rodeados do precioso sossego esperado ao final de um dia, e com uma reserva inesgot&aacute;vel de presunto, queijo e cerveja. Pois&hellip; essa era outra&hellip; se l&aacute; tiv&eacute;ssemos ficado provavelmente ter&iacute;amos estado a jantar banana grelhada e ch&aacute;&hellip; Definitivamente foi uma boa escolha.</p>', '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos2/_marrocos_rosto.jpg', '1970-01-01 00:00:00', 1),
(9, 3, 'Dia 3 - Faro', NULL, '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos3/faro.jpg', '1970-01-01 00:00:00', 1),
(10, 4, 'As motas', 'As fotos das motas usadas', '1970-01-01 00:00:00', NULL, 'images/albuns/motas/_rosto.jpg', '1970-01-01 00:00:00', 1),
(11, 4, 'Dia 0 - Tomar', 'Aqui vemos algumas fotos e videos da partida. Se quiser pode tambem seguir a <a href="http://localhost/4adventure/www/noticias.php?pagid=6">cronica</a>', '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos0/start.jpg', '1970-01-01 00:00:00', 1),
(12, 4, 'Dia 1 - Off road', 'As fotos da aventura em off-road. A cronica pode ser lida <a href="http://localhost/4adventure/www/noticias.php?pagid=7">aqui</a>', '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos1/282573_248303158515680_226099240736072_1071482_92985_n.jpg', '1970-01-01 00:00:00', 1),
(13, 4, 'Dia 2 - Chegada a Marrocos', 'As fotos da chegada a Marrocos. A cronica pode ser lida <a href="http://localhost/4adventure/www/noticias.php?pagid=8">aqui</a>', '1970-01-01 00:00:00', NULL, 'images/albuns/4a2marrocos2/_marrocos_rosto.jpg', '1970-01-01 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(11) NOT NULL,
  `pagid` int(11) NOT NULL,
  `imagepath` varchar(256) NOT NULL,
  `comment` varchar(256) DEFAULT NULL,
  `ord` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photos`
--

INSERT INTO `photos` (`id`, `pagid`, `imagepath`, `comment`, `ord`) VALUES
(1, 11, 'images/albuns/4a2marrocos0/201107120100.jpg', 'A abastecer', 1),
(2, 11, 'images/albuns/4a2marrocos0/201107120101.jpg', 'Tenere 660', 2),
(3, 11, 'images/albuns/4a2marrocos0/201107120102.jpg', 'BMW GS 800', 3),
(4, 11, 'images/albuns/4a2marrocos0/201107120103.jpg', 'Tenere 660', 4),
(5, 11, 'images/albuns/4a2marrocos0/201107120104.jpg', 'BMW GS 800', 5),
(6, 12, 'images/albuns/4a2marrocos1/201107121200.jpg', NULL, 1),
(7, 12, 'images/albuns/4a2marrocos1/201107121202.jpg', NULL, 2),
(8, 12, 'images/albuns/4a2marrocos1/201107121204.jpg', NULL, 3),
(9, 12, 'images/albuns/4a2marrocos1/201107121206.jpg', NULL, 4),
(10, 12, 'images/albuns/4a2marrocos1/201107121500.jpg', NULL, 5),
(11, 12, 'images/albuns/4a2marrocos1/201107121501.jpg', NULL, 6),
(12, 12, 'images/albuns/4a2marrocos1/201107121502.jpg', NULL, 7),
(13, 12, 'images/albuns/4a2marrocos1/201107121600.jpg', NULL, 8),
(14, 12, 'images/albuns/4a2marrocos1/201107121601.jpg', NULL, 9),
(15, 12, 'images/albuns/4a2marrocos1/201107121602.jpg', NULL, 10),
(16, 12, 'images/albuns/4a2marrocos1/201107121603.jpg', NULL, 11),
(17, 12, 'images/albuns/4a2marrocos1/201107121604.jpg', NULL, 12),
(18, 12, 'images/albuns/4a2marrocos1/201107121605.jpg', NULL, 13),
(19, 12, 'images/albuns/4a2marrocos1/201107121606.jpg', NULL, 14),
(20, 12, 'images/albuns/4a2marrocos1/201107121607.jpg', NULL, 15),
(21, 12, 'images/albuns/4a2marrocos1/201107121608.jpg', NULL, 16),
(22, 12, 'images/albuns/4a2marrocos1/201107121609.jpg', NULL, 17),
(23, 12, 'images/albuns/4a2marrocos1/201107121630.jpg', NULL, 18),
(24, 12, 'images/albuns/4a2marrocos1/201107121710.jpg', NULL, 19),
(25, 12, 'images/albuns/4a2marrocos1/201107121730.jpg', NULL, 20),
(26, 12, 'images/albuns/4a2marrocos1/201107121830.jpg', NULL, 21),
(27, 12, 'images/albuns/4a2marrocos1/201107121900.jpg', NULL, 22),
(28, 12, 'images/albuns/4a2marrocos1/201107122100.jpg', NULL, 23),
(29, 12, 'images/albuns/4a2marrocos1/201107122101.jpg', NULL, 24),
(32, 13, 'images/albuns/4a2marrocos2/281278_248307208515275_226099240736072_1071541_6176377_n.jpg', NULL, 31),
(34, 13, 'images/albuns/4a2marrocos2/20110713_1201.jpg', NULL, 5),
(35, 13, 'images/albuns/4a2marrocos2/20110713_1202.jpg', NULL, 6),
(36, 13, 'images/albuns/4a2marrocos2/20110713_1400.jpg', NULL, 7),
(37, 13, 'images/albuns/4a2marrocos2/20110713_1401.jpg', NULL, 8),
(38, 13, 'images/albuns/4a2marrocos2/20110713_1402.jpg', NULL, 9),
(39, 13, 'images/albuns/4a2marrocos2/20110713_1403.jpg', NULL, 10),
(40, 13, 'images/albuns/4a2marrocos2/20110713_1600.jpg', NULL, 11),
(41, 13, 'images/albuns/4a2marrocos2/20110713_1601.jpg', NULL, 12),
(42, 13, 'images/albuns/4a2marrocos2/20110713_1602.jpg', NULL, 13),
(43, 13, 'images/albuns/4a2marrocos2/20110713_1603.jpg', NULL, 14),
(44, 13, 'images/albuns/4a2marrocos2/20110713_1604.jpg', NULL, 15),
(45, 13, 'images/albuns/4a2marrocos2/20110713_1605.jpg', NULL, 16),
(46, 13, 'images/albuns/4a2marrocos2/20110713_1610.jpg', NULL, 17),
(47, 13, 'images/albuns/4a2marrocos2/20110713_1700.jpg', NULL, 18),
(48, 13, 'images/albuns/4a2marrocos2/20110713_1701.jpg', NULL, 19),
(49, 13, 'images/albuns/4a2marrocos2/20110713_1702.jpg', NULL, 20),
(50, 13, 'images/albuns/4a2marrocos2/20110713_1703.jpg', NULL, 21),
(51, 13, 'images/albuns/4a2marrocos2/20110713_1740.jpg', NULL, 22),
(52, 13, 'images/albuns/4a2marrocos2/20110713_1741.jpg', NULL, 23),
(53, 13, 'images/albuns/4a2marrocos2/20110713_1742.jpg', NULL, 24),
(54, 13, 'images/albuns/4a2marrocos2/20110713_1743.jpg', NULL, 25),
(55, 13, 'images/albuns/4a2marrocos2/20110713_1744.jpg', NULL, 26),
(56, 13, 'images/albuns/4a2marrocos2/20110713_1745.jpg', NULL, 27),
(57, 13, 'images/albuns/4a2marrocos2/20110713_1746.jpg', NULL, 28),
(58, 13, 'images/albuns/4a2marrocos2/20110713_1747.jpg', NULL, 29),
(59, 13, 'images/albuns/4a2marrocos2/20110713_1748.jpg', NULL, 30),
(60, 13, 'images/albuns/4a2marrocos2/20110713_1749.jpg', NULL, 31),
(61, 13, 'images/albuns/4a2marrocos2/20110713_1750.jpg', NULL, 32),
(62, 13, 'images/albuns/4a2marrocos2/20110713_1751.jpg', NULL, 33),
(63, 13, 'images/albuns/4a2marrocos2/20110713_1752.jpg', NULL, 34),
(64, 13, 'images/albuns/4a2marrocos2/20110713_1753.jpg', NULL, 35),
(65, 13, 'images/albuns/4a2marrocos2/20110713_1754.jpg', NULL, 36),
(66, 13, 'images/albuns/4a2marrocos2/20110713_1900.jpg', NULL, 37),
(67, 13, 'images/albuns/4a2marrocos2/20110713_1910.jpg', NULL, 38),
(68, 13, 'images/albuns/4a2marrocos2/20110713_2101.jpg', NULL, 39),
(69, 13, 'images/albuns/4a2marrocos2/20110713_2102.jpg', NULL, 40),
(70, 13, 'images/albuns/4a2marrocos2/20110713_2110.jpg', NULL, 41),
(71, 10, 'images/albuns/motas/246777_228005703878759_226099240736072_997283_2204357_n.jpg', NULL, 1),
(72, 10, 'images/albuns/motas/246947_228006030545393_226099240736072_997288_5446235_n.jpg', NULL, 2),
(73, 10, 'images/albuns/motas/247518_228008377211825_226099240736072_997329_3186413_n.jpg', NULL, 3),
(74, 10, 'images/albuns/motas/247589_228007450545251_226099240736072_997316_3029477_n.jpg', NULL, 4),
(75, 10, 'images/albuns/motas/247859_228005090545487_226099240736072_997268_1972489_n.jpg', NULL, 5),
(76, 10, 'images/albuns/motas/248373_228008650545131_226099240736072_997331_4871284_n.jpg', NULL, 6),
(77, 10, 'images/albuns/motas/248392_228007057211957_226099240736072_997309_3347681_n.jpg', NULL, 7),
(78, 10, 'images/albuns/motas/248703_228005903878739_226099240736072_997286_1893039_n.jpg', NULL, 8),
(79, 10, 'images/albuns/motas/249410_228007500545246_226099240736072_997317_6882101_n.jpg', NULL, 9),
(80, 10, 'images/albuns/motas/249550_228006740545322_226099240736072_997305_3182078_n.jpg', NULL, 10),
(81, 10, 'images/albuns/motas/249928_228005660545430_226099240736072_997282_1294127_n.jpg', NULL, 11),
(82, 10, 'images/albuns/motas/250042_228004950545501_226099240736072_997265_6222971_n.jpg', NULL, 12),
(83, 10, 'images/albuns/motas/251085_228007357211927_226099240736072_997314_3412221_n.jpg', NULL, 13),
(84, 10, 'images/albuns/motas/251233_228007197211943_226099240736072_997312_7492005_n.jpg', NULL, 14),
(85, 10, 'images/albuns/motas/252479_228006857211977_226099240736072_997306_6520503_n.jpg', NULL, 15),
(86, 10, 'images/albuns/motas/252479_228006933878636_226099240736072_997308_2307992_n.jpg', NULL, 16),
(87, 10, 'images/albuns/motas/252848_228005783878751_226099240736072_997284_8023109_n.jpg', NULL, 17),
(88, 10, 'images/albuns/motas/253554_228008127211850_226099240736072_997326_6595562_n.jpg', NULL, 18),
(89, 10, 'images/albuns/motas/253657_228008220545174_226099240736072_997328_2824470_n.jpg', NULL, 19),
(90, 10, 'images/albuns/motas/253903_228008533878476_226099240736072_997330_2421885_n.jpg', NULL, 20),
(91, 10, 'images/albuns/motas/253932_228007553878574_226099240736072_997318_6663861_n.jpg', NULL, 21),
(92, 10, 'images/albuns/motas/253972_228007610545235_226099240736072_997319_595391_n.jpg', NULL, 22),
(93, 10, 'images/albuns/motas/263099_244582388887757_226099240736072_1057537_6043139_n.jpg', NULL, 23),
(94, 10, 'images/albuns/motas/263824_244582358887760_226099240736072_1057536_5811472_n.jpg', NULL, 24),
(95, 10, 'images/albuns/motas/265114_244582435554419_226099240736072_1057538_7700033_n.jpg', NULL, 25),
(96, 10, 'images/albuns/motas/268334_244582458887750_226099240736072_1057539_7098846_n.jpg', NULL, 26),
(97, 10, 'images/albuns/motas/269937_228007307211932_226099240736072_997313_6014042_n.jpg', NULL, 27);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `company_address` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
  `admin_email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL,
  `username` varchar(100) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `company_phone` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `company_fax` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `company_mobile` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `company_email` varchar(100) COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `company_name`, `company_address`, `admin_email`, `username`, `password`, `company_phone`, `company_fax`, `company_mobile`, `company_email`) VALUES
(1, '4Adventure', 'Porto - Portugal', 'pedroluisf@gmail.com', 'admin', 'admin', '', '', '961955200', 'geral@4adventure.com.pt');

-- --------------------------------------------------------

--
-- Table structure for table `translations`
--

CREATE TABLE IF NOT EXISTS `translations` (
  `trnid` int(11) NOT NULL,
  `keyword` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `translation` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `lang` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `motorcycle_id` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `password` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `phone` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `fax` varchar(45) COLLATE latin1_general_ci DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `newsletter` enum('Y','N') COLLATE latin1_general_ci NOT NULL DEFAULT 'N',
  `preferred_lang` int(11) NOT NULL,
  `username` varchar(255) COLLATE latin1_general_ci NOT NULL,
  `role` enum('A','R') COLLATE latin1_general_ci NOT NULL DEFAULT 'R'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uid`, `name`, `motorcycle_id`, `email`, `password`, `phone`, `fax`, `country_id`, `newsletter`, `preferred_lang`, `username`, `role`) VALUES
(1, 'Admin', NULL, 'a@a.com', '1a1dc91c907325c69271ddf0c944bc72', '2121', '2121', 1, 'N', 1, 'user', 'A');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`catid`),
  ADD UNIQUE KEY `desc` (`category`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comid`),
  ADD KEY `comments_page` (`pagid`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`cntid`),
  ADD UNIQUE KEY `uniq_code` (`country_code`),
  ADD KEY `uniq_name` (`country_name`),
  ADD KEY `cntid` (`cntid`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`langid`);

--
-- Indexes for table `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD PRIMARY KEY (`mtrid`),
  ADD KEY `page_lang` (`lang`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`pagid`),
  ADD KEY `page_lang` (`lang`),
  ADD KEY `catid` (`catid`),
  ADD KEY `catid_2` (`catid`);

--
-- Indexes for table `photos`
--
ALTER TABLE `photos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pagid` (`pagid`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `translations`
--
ALTER TABLE `translations`
  ADD PRIMARY KEY (`trnid`),
  ADD KEY `trans_lang` (`lang`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `uniq_email` (`email`),
  ADD KEY `user_country` (`country_id`),
  ADD KEY `user_lang` (`preferred_lang`),
  ADD KEY `motorcycle_id` (`motorcycle_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `catid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `cntid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `langid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `motorcycles`
--
ALTER TABLE `motorcycles`
  MODIFY `mtrid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `pagid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `photos`
--
ALTER TABLE `photos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_page` FOREIGN KEY (`pagid`) REFERENCES `pages` (`pagid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `motorcycles`
--
ALTER TABLE `motorcycles`
  ADD CONSTRAINT `motorcycles_lang` FOREIGN KEY (`lang`) REFERENCES `languages` (`langid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `page_lang` FOREIGN KEY (`lang`) REFERENCES `languages` (`langid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `pages_cat` FOREIGN KEY (`catid`) REFERENCES `categories` (`catid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `translations`
--
ALTER TABLE `translations`
  ADD CONSTRAINT `trans_lang` FOREIGN KEY (`lang`) REFERENCES `languages` (`langid`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `user_country` FOREIGN KEY (`country_id`) REFERENCES `countries` (`cntid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_lang` FOREIGN KEY (`preferred_lang`) REFERENCES `languages` (`langid`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_motor` FOREIGN KEY (`motorcycle_id`) REFERENCES `motorcycles` (`mtrid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
