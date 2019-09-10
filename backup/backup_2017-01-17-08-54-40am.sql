-- MySQL dump 10.13  Distrib 5.5.32, for Win32 (x86)
--
-- Host: localhost    Database: indowisata
-- ------------------------------------------------------
-- Server version	5.5.32

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id_admin` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `waktu_pembuatan` date NOT NULL,
  `kontak` varchar(16) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `id_admin` (`id_admin`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','admin','admin','0000-00-00','6285659305808'),(2,'arifanoteguh','arifanoteguh','Arifano Teguh','0000-00-00','6285659311818'),(3,'maulanaamsors','maulana12345','Maulana Amsor Sidik','2017-01-17','6285659305808'),(4,'oasisikomoto','123123123','oasisi komoto','2017-01-17','123323321');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `komentar`
--

DROP TABLE IF EXISTS `komentar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `komentar` (
  `id_komentar` int(10) NOT NULL AUTO_INCREMENT,
  `id_post` int(10) unsigned NOT NULL,
  `id_user_post` int(10) unsigned NOT NULL,
  `id_user` int(10) unsigned NOT NULL,
  `komentar` text NOT NULL,
  `baca` varchar(5) NOT NULL,
  `tanggal` date NOT NULL,
  PRIMARY KEY (`id_komentar`),
  KEY `FK_komentar` (`id_post`),
  KEY `FK_komentar_2` (`id_user`),
  KEY `FK_komentar_3` (`id_user_post`),
  CONSTRAINT `FK_komentar` FOREIGN KEY (`id_post`) REFERENCES `post` (`id_post`),
  CONSTRAINT `FK_komentar_2` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`),
  CONSTRAINT `FK_komentar_3` FOREIGN KEY (`id_user_post`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `komentar`
--

LOCK TABLES `komentar` WRITE;
/*!40000 ALTER TABLE `komentar` DISABLE KEYS */;
INSERT INTO `komentar` VALUES (15,26,1,1,'131231231','sudah','2016-12-27'),(17,22,2,1,'Kekuatan lorem ipsum dolor sit amet','sudah','2016-12-27'),(18,26,1,1,'Kekuatan lorem ipsum dolor sit amet','sudah','2016-12-27'),(19,25,1,2,' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisi felis, auctor sed tristique eget, scelerisque id sem. Nullam eu magna at ex tincidunt bibendum. Fusce scelerisque justo sit nullam. ','sudah','2016-12-27'),(20,29,4,1,'Test','sudah','2016-12-31'),(21,29,4,2,'s risus, fermentum quis tellus id, egestas vulputate ex. Aliquam erat volutpat. Suspendisse posuere a eros non pharetra. Praesent ultrices ipsum at mi varius, eu fermentum velit ultrices. Praesent nunc turpis, ultricies vitae ipsum vitae, consectetur venenatis arcu. Aliquam in sagittis lorem. Etiam vel venenatis risus. Suspendisse sodales ipsum nec semper cursus. Etiam rhoncus turpis vel erat egestas, in eleifend nisi aliquet. Cras egestas interdum eros. Nam mollis, ligula. ','sudah','2016-12-31'),(22,39,1,1,'Komentar','sudah','2017-01-17'),(23,37,2,1,'Komentar','sudah','2017-01-17');
/*!40000 ALTER TABLE `komentar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kota`
--

DROP TABLE IF EXISTS `kota`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `kota` (
  `id_kota` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `id_prov` smallint(5) unsigned NOT NULL,
  `kota` varchar(20) NOT NULL,
  PRIMARY KEY (`id_kota`),
  UNIQUE KEY `id_kota` (`id_kota`,`kota`),
  KEY `FK_kota` (`id_prov`),
  CONSTRAINT `FK_kota` FOREIGN KEY (`id_prov`) REFERENCES `provinsi` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9472 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kota`
--

LOCK TABLES `kota` WRITE;
/*!40000 ALTER TABLE `kota` DISABLE KEYS */;
INSERT INTO `kota` VALUES (1101,11,'KABUPATEN SIMEULUE'),(1102,11,'KABUPATEN ACEH SINGK'),(1103,11,'KABUPATEN ACEH SELAT'),(1104,11,'KABUPATEN ACEH TENGG'),(1105,11,'KABUPATEN ACEH TIMUR'),(1106,11,'KABUPATEN ACEH TENGA'),(1107,11,'KABUPATEN ACEH BARAT'),(1108,11,'KABUPATEN ACEH BESAR'),(1109,11,'KABUPATEN PIDIE'),(1110,11,'KABUPATEN BIREUEN'),(1111,11,'KABUPATEN ACEH UTARA'),(1112,11,'KABUPATEN ACEH BARAT'),(1113,11,'KABUPATEN GAYO LUES'),(1114,11,'KABUPATEN ACEH TAMIA'),(1115,11,'KABUPATEN NAGAN RAYA'),(1116,11,'KABUPATEN ACEH JAYA'),(1117,11,'KABUPATEN BENER MERI'),(1118,11,'KABUPATEN PIDIE JAYA'),(1171,11,'KOTA BANDA ACEH'),(1172,11,'KOTA SABANG'),(1173,11,'KOTA LANGSA'),(1174,11,'KOTA LHOKSEUMAWE'),(1175,11,'KOTA SUBULUSSALAM'),(1201,12,'KABUPATEN NIAS'),(1202,12,'KABUPATEN MANDAILING'),(1203,12,'KABUPATEN TAPANULI S'),(1204,12,'KABUPATEN TAPANULI T'),(1205,12,'KABUPATEN TAPANULI U'),(1206,12,'KABUPATEN TOBA SAMOS'),(1207,12,'KABUPATEN LABUHAN BA'),(1208,12,'KABUPATEN ASAHAN'),(1209,12,'KABUPATEN SIMALUNGUN'),(1210,12,'KABUPATEN DAIRI'),(1211,12,'KABUPATEN KARO'),(1212,12,'KABUPATEN DELI SERDA'),(1213,12,'KABUPATEN LANGKAT'),(1214,12,'KABUPATEN NIAS SELAT'),(1215,12,'KABUPATEN HUMBANG HA'),(1216,12,'KABUPATEN PAKPAK BHA'),(1217,12,'KABUPATEN SAMOSIR'),(1218,12,'KABUPATEN SERDANG BE'),(1219,12,'KABUPATEN BATU BARA'),(1220,12,'KABUPATEN PADANG LAW'),(1221,12,'KABUPATEN PADANG LAW'),(1222,12,'KABUPATEN LABUHAN BA'),(1223,12,'KABUPATEN LABUHAN BA'),(1224,12,'KABUPATEN NIAS UTARA'),(1225,12,'KABUPATEN NIAS BARAT'),(1271,12,'KOTA SIBOLGA'),(1272,12,'KOTA TANJUNG BALAI'),(1273,12,'KOTA PEMATANG SIANTA'),(1274,12,'KOTA TEBING TINGGI'),(1275,12,'KOTA MEDAN'),(1276,12,'KOTA BINJAI'),(1277,12,'KOTA PADANGSIDIMPUAN'),(1278,12,'KOTA GUNUNGSITOLI'),(1301,13,'KABUPATEN KEPULAUAN '),(1302,13,'KABUPATEN PESISIR SE'),(1303,13,'KABUPATEN SOLOK'),(1304,13,'KABUPATEN SIJUNJUNG'),(1305,13,'KABUPATEN TANAH DATA'),(1306,13,'KABUPATEN PADANG PAR'),(1307,13,'KABUPATEN AGAM'),(1308,13,'KABUPATEN LIMA PULUH'),(1309,13,'KABUPATEN PASAMAN'),(1310,13,'KABUPATEN SOLOK SELA'),(1311,13,'KABUPATEN DHARMASRAY'),(1312,13,'KABUPATEN PASAMAN BA'),(1371,13,'KOTA PADANG'),(1372,13,'KOTA SOLOK'),(1373,13,'KOTA SAWAH LUNTO'),(1374,13,'KOTA PADANG PANJANG'),(1375,13,'KOTA BUKITTINGGI'),(1376,13,'KOTA PAYAKUMBUH'),(1377,13,'KOTA PARIAMAN'),(1401,14,'KABUPATEN KUANTAN SI'),(1402,14,'KABUPATEN INDRAGIRI '),(1403,14,'KABUPATEN INDRAGIRI '),(1404,14,'KABUPATEN PELALAWAN'),(1405,14,'KABUPATEN S I A K'),(1406,14,'KABUPATEN KAMPAR'),(1407,14,'KABUPATEN ROKAN HULU'),(1408,14,'KABUPATEN BENGKALIS'),(1409,14,'KABUPATEN ROKAN HILI'),(1410,14,'KABUPATEN KEPULAUAN '),(1471,14,'KOTA PEKANBARU'),(1473,14,'KOTA D U M A I'),(1501,15,'KABUPATEN KERINCI'),(1502,15,'KABUPATEN MERANGIN'),(1503,15,'KABUPATEN SAROLANGUN'),(1504,15,'KABUPATEN BATANG HAR'),(1505,15,'KABUPATEN MUARO JAMB'),(1506,15,'KABUPATEN TANJUNG JA'),(1507,15,'KABUPATEN TANJUNG JA'),(1508,15,'KABUPATEN TEBO'),(1509,15,'KABUPATEN BUNGO'),(1571,15,'KOTA JAMBI'),(1572,15,'KOTA SUNGAI PENUH'),(1601,16,'KABUPATEN OGAN KOMER'),(1602,16,'KABUPATEN OGAN KOMER'),(1603,16,'KABUPATEN MUARA ENIM'),(1604,16,'KABUPATEN LAHAT'),(1605,16,'KABUPATEN MUSI RAWAS'),(1606,16,'KABUPATEN MUSI BANYU'),(1607,16,'KABUPATEN BANYU ASIN'),(1608,16,'KABUPATEN OGAN KOMER'),(1609,16,'KABUPATEN OGAN KOMER'),(1610,16,'KABUPATEN OGAN ILIR'),(1611,16,'KABUPATEN EMPAT LAWA'),(1612,16,'KABUPATEN PENUKAL AB'),(1613,16,'KABUPATEN MUSI RAWAS'),(1671,16,'KOTA PALEMBANG'),(1672,16,'KOTA PRABUMULIH'),(1673,16,'KOTA PAGAR ALAM'),(1674,16,'KOTA LUBUKLINGGAU'),(1701,17,'KABUPATEN BENGKULU S'),(1702,17,'KABUPATEN REJANG LEB'),(1703,17,'KABUPATEN BENGKULU U'),(1704,17,'KABUPATEN KAUR'),(1705,17,'KABUPATEN SELUMA'),(1706,17,'KABUPATEN MUKOMUKO'),(1707,17,'KABUPATEN LEBONG'),(1708,17,'KABUPATEN KEPAHIANG'),(1709,17,'KABUPATEN BENGKULU T'),(1771,17,'KOTA BENGKULU'),(1801,18,'KABUPATEN LAMPUNG BA'),(1802,18,'KABUPATEN TANGGAMUS'),(1803,18,'KABUPATEN LAMPUNG SE'),(1804,18,'KABUPATEN LAMPUNG TI'),(1805,18,'KABUPATEN LAMPUNG TE'),(1806,18,'KABUPATEN LAMPUNG UT'),(1807,18,'KABUPATEN WAY KANAN'),(1808,18,'KABUPATEN TULANGBAWA'),(1809,18,'KABUPATEN PESAWARAN'),(1810,18,'KABUPATEN PRINGSEWU'),(1811,18,'KABUPATEN MESUJI'),(1812,18,'KABUPATEN TULANG BAW'),(1813,18,'KABUPATEN PESISIR BA'),(1871,18,'KOTA BANDAR LAMPUNG'),(1872,18,'KOTA METRO'),(1901,19,'KABUPATEN BANGKA'),(1902,19,'KABUPATEN BELITUNG'),(1903,19,'KABUPATEN BANGKA BAR'),(1904,19,'KABUPATEN BANGKA TEN'),(1905,19,'KABUPATEN BANGKA SEL'),(1906,19,'KABUPATEN BELITUNG T'),(1971,19,'KOTA PANGKAL PINANG'),(2101,21,'KABUPATEN KARIMUN'),(2102,21,'KABUPATEN BINTAN'),(2103,21,'KABUPATEN NATUNA'),(2104,21,'KABUPATEN LINGGA'),(2105,21,'KABUPATEN KEPULAUAN '),(2171,21,'KOTA B A T A M'),(2172,21,'KOTA TANJUNG PINANG'),(3101,31,'KABUPATEN KEPULAUAN '),(3171,31,'KOTA JAKARTA SELATAN'),(3172,31,'KOTA JAKARTA TIMUR'),(3173,31,'KOTA JAKARTA PUSAT'),(3174,31,'KOTA JAKARTA BARAT'),(3175,31,'KOTA JAKARTA UTARA'),(3201,32,'KABUPATEN BOGOR'),(3202,32,'KABUPATEN SUKABUMI'),(3203,32,'KABUPATEN CIANJUR'),(3204,32,'KABUPATEN BANDUNG'),(3205,32,'KABUPATEN GARUT'),(3206,32,'KABUPATEN TASIKMALAY'),(3207,32,'KABUPATEN CIAMIS'),(3208,32,'KABUPATEN KUNINGAN'),(3209,32,'KABUPATEN CIREBON'),(3210,32,'KABUPATEN MAJALENGKA'),(3211,32,'KABUPATEN SUMEDANG'),(3212,32,'KABUPATEN INDRAMAYU'),(3213,32,'KABUPATEN SUBANG'),(3214,32,'KABUPATEN PURWAKARTA'),(3215,32,'KABUPATEN KARAWANG'),(3216,32,'KABUPATEN BEKASI'),(3217,32,'KABUPATEN BANDUNG BA'),(3218,32,'KABUPATEN PANGANDARA'),(3271,32,'KOTA BOGOR'),(3272,32,'KOTA SUKABUMI'),(3273,32,'KOTA BANDUNG'),(3274,32,'KOTA CIREBON'),(3275,32,'KOTA BEKASI'),(3276,32,'KOTA DEPOK'),(3277,32,'KOTA CIMAHI'),(3278,32,'KOTA TASIKMALAYA'),(3279,32,'KOTA BANJAR'),(3301,33,'KABUPATEN CILACAP'),(3302,33,'KABUPATEN BANYUMAS'),(3303,33,'KABUPATEN PURBALINGG'),(3304,33,'KABUPATEN BANJARNEGA'),(3305,33,'KABUPATEN KEBUMEN'),(3306,33,'KABUPATEN PURWOREJO'),(3307,33,'KABUPATEN WONOSOBO'),(3308,33,'KABUPATEN MAGELANG'),(3309,33,'KABUPATEN BOYOLALI'),(3310,33,'KABUPATEN KLATEN'),(3311,33,'KABUPATEN SUKOHARJO'),(3312,33,'KABUPATEN WONOGIRI'),(3313,33,'KABUPATEN KARANGANYA'),(3314,33,'KABUPATEN SRAGEN'),(3315,33,'KABUPATEN GROBOGAN'),(3316,33,'KABUPATEN BLORA'),(3317,33,'KABUPATEN REMBANG'),(3318,33,'KABUPATEN PATI'),(3319,33,'KABUPATEN KUDUS'),(3320,33,'KABUPATEN JEPARA'),(3321,33,'KABUPATEN DEMAK'),(3322,33,'KABUPATEN SEMARANG'),(3323,33,'KABUPATEN TEMANGGUNG'),(3324,33,'KABUPATEN KENDAL'),(3325,33,'KABUPATEN BATANG'),(3326,33,'KABUPATEN PEKALONGAN'),(3327,33,'KABUPATEN PEMALANG'),(3328,33,'KABUPATEN TEGAL'),(3329,33,'KABUPATEN BREBES'),(3371,33,'KOTA MAGELANG'),(3372,33,'KOTA SURAKARTA'),(3373,33,'KOTA SALATIGA'),(3374,33,'KOTA SEMARANG'),(3375,33,'KOTA PEKALONGAN'),(3376,33,'KOTA TEGAL'),(3401,34,'KABUPATEN KULON PROG'),(3402,34,'KABUPATEN BANTUL'),(3403,34,'KABUPATEN GUNUNG KID'),(3404,34,'KABUPATEN SLEMAN'),(3471,34,'KOTA YOGYAKARTA'),(3501,35,'KABUPATEN PACITAN'),(3502,35,'KABUPATEN PONOROGO'),(3503,35,'KABUPATEN TRENGGALEK'),(3504,35,'KABUPATEN TULUNGAGUN'),(3505,35,'KABUPATEN BLITAR'),(3506,35,'KABUPATEN KEDIRI'),(3507,35,'KABUPATEN MALANG'),(3508,35,'KABUPATEN LUMAJANG'),(3509,35,'KABUPATEN JEMBER'),(3510,35,'KABUPATEN BANYUWANGI'),(3511,35,'KABUPATEN BONDOWOSO'),(3512,35,'KABUPATEN SITUBONDO'),(3513,35,'KABUPATEN PROBOLINGG'),(3514,35,'KABUPATEN PASURUAN'),(3515,35,'KABUPATEN SIDOARJO'),(3516,35,'KABUPATEN MOJOKERTO'),(3517,35,'KABUPATEN JOMBANG'),(3518,35,'KABUPATEN NGANJUK'),(3519,35,'KABUPATEN MADIUN'),(3520,35,'KABUPATEN MAGETAN'),(3521,35,'KABUPATEN NGAWI'),(3522,35,'KABUPATEN BOJONEGORO'),(3523,35,'KABUPATEN TUBAN'),(3524,35,'KABUPATEN LAMONGAN'),(3525,35,'KABUPATEN GRESIK'),(3526,35,'KABUPATEN BANGKALAN'),(3527,35,'KABUPATEN SAMPANG'),(3528,35,'KABUPATEN PAMEKASAN'),(3529,35,'KABUPATEN SUMENEP'),(3571,35,'KOTA KEDIRI'),(3572,35,'KOTA BLITAR'),(3573,35,'KOTA MALANG'),(3574,35,'KOTA PROBOLINGGO'),(3575,35,'KOTA PASURUAN'),(3576,35,'KOTA MOJOKERTO'),(3577,35,'KOTA MADIUN'),(3578,35,'KOTA SURABAYA'),(3579,35,'KOTA BATU'),(3601,36,'KABUPATEN PANDEGLANG'),(3602,36,'KABUPATEN LEBAK'),(3603,36,'KABUPATEN TANGERANG'),(3604,36,'KABUPATEN SERANG'),(3671,36,'KOTA TANGERANG'),(3672,36,'KOTA CILEGON'),(3673,36,'KOTA SERANG'),(3674,36,'KOTA TANGERANG SELAT'),(5101,51,'KABUPATEN JEMBRANA'),(5102,51,'KABUPATEN TABANAN'),(5103,51,'KABUPATEN BADUNG'),(5104,51,'KABUPATEN GIANYAR'),(5105,51,'KABUPATEN KLUNGKUNG'),(5106,51,'KABUPATEN BANGLI'),(5107,51,'KABUPATEN KARANG ASE'),(5108,51,'KABUPATEN BULELENG'),(5171,51,'KOTA DENPASAR'),(5201,52,'KABUPATEN LOMBOK BAR'),(5202,52,'KABUPATEN LOMBOK TEN'),(5203,52,'KABUPATEN LOMBOK TIM'),(5204,52,'KABUPATEN SUMBAWA'),(5205,52,'KABUPATEN DOMPU'),(5206,52,'KABUPATEN BIMA'),(5207,52,'KABUPATEN SUMBAWA BA'),(5208,52,'KABUPATEN LOMBOK UTA'),(5271,52,'KOTA MATARAM'),(5272,52,'KOTA BIMA'),(5301,53,'KABUPATEN SUMBA BARA'),(5302,53,'KABUPATEN SUMBA TIMU'),(5303,53,'KABUPATEN KUPANG'),(5304,53,'KABUPATEN TIMOR TENG'),(5305,53,'KABUPATEN TIMOR TENG'),(5306,53,'KABUPATEN BELU'),(5307,53,'KABUPATEN ALOR'),(5308,53,'KABUPATEN LEMBATA'),(5309,53,'KABUPATEN FLORES TIM'),(5310,53,'KABUPATEN SIKKA'),(5311,53,'KABUPATEN ENDE'),(5312,53,'KABUPATEN NGADA'),(5313,53,'KABUPATEN MANGGARAI'),(5314,53,'KABUPATEN ROTE NDAO'),(5315,53,'KABUPATEN MANGGARAI '),(5316,53,'KABUPATEN SUMBA TENG'),(5317,53,'KABUPATEN SUMBA BARA'),(5318,53,'KABUPATEN NAGEKEO'),(5319,53,'KABUPATEN MANGGARAI '),(5320,53,'KABUPATEN SABU RAIJU'),(5321,53,'KABUPATEN MALAKA'),(5371,53,'KOTA KUPANG'),(6101,61,'KABUPATEN SAMBAS'),(6102,61,'KABUPATEN BENGKAYANG'),(6103,61,'KABUPATEN LANDAK'),(6104,61,'KABUPATEN MEMPAWAH'),(6105,61,'KABUPATEN SANGGAU'),(6106,61,'KABUPATEN KETAPANG'),(6107,61,'KABUPATEN SINTANG'),(6108,61,'KABUPATEN KAPUAS HUL'),(6109,61,'KABUPATEN SEKADAU'),(6110,61,'KABUPATEN MELAWI'),(6111,61,'KABUPATEN KAYONG UTA'),(6112,61,'KABUPATEN KUBU RAYA'),(6171,61,'KOTA PONTIANAK'),(6172,61,'KOTA SINGKAWANG'),(6201,62,'KABUPATEN KOTAWARING'),(6202,62,'KABUPATEN KOTAWARING'),(6203,62,'KABUPATEN KAPUAS'),(6204,62,'KABUPATEN BARITO SEL'),(6205,62,'KABUPATEN BARITO UTA'),(6206,62,'KABUPATEN SUKAMARA'),(6207,62,'KABUPATEN LAMANDAU'),(6208,62,'KABUPATEN SERUYAN'),(6209,62,'KABUPATEN KATINGAN'),(6210,62,'KABUPATEN PULANG PIS'),(6211,62,'KABUPATEN GUNUNG MAS'),(6212,62,'KABUPATEN BARITO TIM'),(6213,62,'KABUPATEN MURUNG RAY'),(6271,62,'KOTA PALANGKA RAYA'),(6301,63,'KABUPATEN TANAH LAUT'),(6302,63,'KABUPATEN KOTA BARU'),(6303,63,'KABUPATEN BANJAR'),(6304,63,'KABUPATEN BARITO KUA'),(6305,63,'KABUPATEN TAPIN'),(6306,63,'KABUPATEN HULU SUNGA'),(6307,63,'KABUPATEN HULU SUNGA'),(6308,63,'KABUPATEN HULU SUNGA'),(6309,63,'KABUPATEN TABALONG'),(6310,63,'KABUPATEN TANAH BUMB'),(6311,63,'KABUPATEN BALANGAN'),(6371,63,'KOTA BANJARMASIN'),(6372,63,'KOTA BANJAR BARU'),(6401,64,'KABUPATEN PASER'),(6402,64,'KABUPATEN KUTAI BARA'),(6403,64,'KABUPATEN KUTAI KART'),(6404,64,'KABUPATEN KUTAI TIMU'),(6405,64,'KABUPATEN BERAU'),(6409,64,'KABUPATEN PENAJAM PA'),(6411,64,'KABUPATEN MAHAKAM HU'),(6471,64,'KOTA BALIKPAPAN'),(6472,64,'KOTA SAMARINDA'),(6474,64,'KOTA BONTANG'),(6501,65,'KABUPATEN MALINAU'),(6502,65,'KABUPATEN BULUNGAN'),(6503,65,'KABUPATEN TANA TIDUN'),(6504,65,'KABUPATEN NUNUKAN'),(6571,65,'KOTA TARAKAN'),(7101,71,'KABUPATEN BOLAANG MO'),(7102,71,'KABUPATEN MINAHASA'),(7103,71,'KABUPATEN KEPULAUAN '),(7104,71,'KABUPATEN KEPULAUAN '),(7105,71,'KABUPATEN MINAHASA S'),(7106,71,'KABUPATEN MINAHASA U'),(7107,71,'KABUPATEN BOLAANG MO'),(7108,71,'KABUPATEN SIAU TAGUL'),(7109,71,'KABUPATEN MINAHASA T'),(7110,71,'KABUPATEN BOLAANG MO'),(7111,71,'KABUPATEN BOLAANG MO'),(7171,71,'KOTA MANADO'),(7172,71,'KOTA BITUNG'),(7173,71,'KOTA TOMOHON'),(7174,71,'KOTA KOTAMOBAGU'),(7201,72,'KABUPATEN BANGGAI KE'),(7202,72,'KABUPATEN BANGGAI'),(7203,72,'KABUPATEN MOROWALI'),(7204,72,'KABUPATEN POSO'),(7205,72,'KABUPATEN DONGGALA'),(7206,72,'KABUPATEN TOLI-TOLI'),(7207,72,'KABUPATEN BUOL'),(7208,72,'KABUPATEN PARIGI MOU'),(7209,72,'KABUPATEN TOJO UNA-U'),(7210,72,'KABUPATEN SIGI'),(7211,72,'KABUPATEN BANGGAI LA'),(7212,72,'KABUPATEN MOROWALI U'),(7271,72,'KOTA PALU'),(7301,73,'KABUPATEN KEPULAUAN '),(7302,73,'KABUPATEN BULUKUMBA'),(7303,73,'KABUPATEN BANTAENG'),(7304,73,'KABUPATEN JENEPONTO'),(7305,73,'KABUPATEN TAKALAR'),(7306,73,'KABUPATEN GOWA'),(7307,73,'KABUPATEN SINJAI'),(7308,73,'KABUPATEN MAROS'),(7309,73,'KABUPATEN PANGKAJENE'),(7310,73,'KABUPATEN BARRU'),(7311,73,'KABUPATEN BONE'),(7312,73,'KABUPATEN SOPPENG'),(7313,73,'KABUPATEN WAJO'),(7314,73,'KABUPATEN SIDENRENG '),(7315,73,'KABUPATEN PINRANG'),(7316,73,'KABUPATEN ENREKANG'),(7317,73,'KABUPATEN LUWU'),(7318,73,'KABUPATEN TANA TORAJ'),(7322,73,'KABUPATEN LUWU UTARA'),(7325,73,'KABUPATEN LUWU TIMUR'),(7326,73,'KABUPATEN TORAJA UTA'),(7371,73,'KOTA MAKASSAR'),(7372,73,'KOTA PAREPARE'),(7373,73,'KOTA PALOPO'),(7401,74,'KABUPATEN BUTON'),(7402,74,'KABUPATEN MUNA'),(7403,74,'KABUPATEN KONAWE'),(7404,74,'KABUPATEN KOLAKA'),(7405,74,'KABUPATEN KONAWE SEL'),(7406,74,'KABUPATEN BOMBANA'),(7407,74,'KABUPATEN WAKATOBI'),(7408,74,'KABUPATEN KOLAKA UTA'),(7409,74,'KABUPATEN BUTON UTAR'),(7410,74,'KABUPATEN KONAWE UTA'),(7411,74,'KABUPATEN KOLAKA TIM'),(7412,74,'KABUPATEN KONAWE KEP'),(7413,74,'KABUPATEN MUNA BARAT'),(7414,74,'KABUPATEN BUTON TENG'),(7415,74,'KABUPATEN BUTON SELA'),(7471,74,'KOTA KENDARI'),(7472,74,'KOTA BAUBAU'),(7501,75,'KABUPATEN BOALEMO'),(7502,75,'KABUPATEN GORONTALO'),(7503,75,'KABUPATEN POHUWATO'),(7504,75,'KABUPATEN BONE BOLAN'),(7505,75,'KABUPATEN GORONTALO '),(7571,75,'KOTA GORONTALO'),(7601,76,'KABUPATEN MAJENE'),(7602,76,'KABUPATEN POLEWALI M'),(7603,76,'KABUPATEN MAMASA'),(7604,76,'KABUPATEN MAMUJU'),(7605,76,'KABUPATEN MAMUJU UTA'),(7606,76,'KABUPATEN MAMUJU TEN'),(8101,81,'KABUPATEN MALUKU TEN'),(8102,81,'KABUPATEN MALUKU TEN'),(8103,81,'KABUPATEN MALUKU TEN'),(8104,81,'KABUPATEN BURU'),(8105,81,'KABUPATEN KEPULAUAN '),(8106,81,'KABUPATEN SERAM BAGI'),(8107,81,'KABUPATEN SERAM BAGI'),(8108,81,'KABUPATEN MALUKU BAR'),(8109,81,'KABUPATEN BURU SELAT'),(8171,81,'KOTA AMBON'),(8172,81,'KOTA TUAL'),(8201,82,'KABUPATEN HALMAHERA '),(8202,82,'KABUPATEN HALMAHERA '),(8203,82,'KABUPATEN KEPULAUAN '),(8204,82,'KABUPATEN HALMAHERA '),(8205,82,'KABUPATEN HALMAHERA '),(8206,82,'KABUPATEN HALMAHERA '),(8207,82,'KABUPATEN PULAU MORO'),(8208,82,'KABUPATEN PULAU TALI'),(8271,82,'KOTA TERNATE'),(8272,82,'KOTA TIDORE KEPULAUA'),(9101,91,'KABUPATEN FAKFAK'),(9102,91,'KABUPATEN KAIMANA'),(9103,91,'KABUPATEN TELUK WOND'),(9104,91,'KABUPATEN TELUK BINT'),(9105,91,'KABUPATEN MANOKWARI'),(9106,91,'KABUPATEN SORONG SEL'),(9107,91,'KABUPATEN SORONG'),(9108,91,'KABUPATEN RAJA AMPAT'),(9109,91,'KABUPATEN TAMBRAUW'),(9110,91,'KABUPATEN MAYBRAT'),(9111,91,'KABUPATEN MANOKWARI '),(9112,91,'KABUPATEN PEGUNUNGAN'),(9171,91,'KOTA SORONG'),(9401,94,'KABUPATEN MERAUKE'),(9402,94,'KABUPATEN JAYAWIJAYA'),(9403,94,'KABUPATEN JAYAPURA'),(9404,94,'KABUPATEN NABIRE'),(9408,94,'KABUPATEN KEPULAUAN '),(9409,94,'KABUPATEN BIAK NUMFO'),(9410,94,'KABUPATEN PANIAI'),(9411,94,'KABUPATEN PUNCAK JAY'),(9412,94,'KABUPATEN MIMIKA'),(9413,94,'KABUPATEN BOVEN DIGO'),(9414,94,'KABUPATEN MAPPI'),(9415,94,'KABUPATEN ASMAT'),(9416,94,'KABUPATEN YAHUKIMO'),(9417,94,'KABUPATEN PEGUNUNGAN'),(9418,94,'KABUPATEN TOLIKARA'),(9419,94,'KABUPATEN SARMI'),(9420,94,'KABUPATEN KEEROM'),(9426,94,'KABUPATEN WAROPEN'),(9427,94,'KABUPATEN SUPIORI'),(9428,94,'KABUPATEN MAMBERAMO '),(9429,94,'KABUPATEN NDUGA'),(9430,94,'KABUPATEN LANNY JAYA'),(9431,94,'KABUPATEN MAMBERAMO '),(9432,94,'KABUPATEN YALIMO'),(9433,94,'KABUPATEN PUNCAK'),(9434,94,'KABUPATEN DOGIYAI'),(9435,94,'KABUPATEN INTAN JAYA'),(9436,94,'KABUPATEN DEIYAI'),(9471,94,'KOTA JAYAPURA');
/*!40000 ALTER TABLE `kota` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id_post` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` int(10) unsigned NOT NULL,
  `id_prov` smallint(5) unsigned NOT NULL,
  `id_kota` smallint(5) unsigned NOT NULL,
  `foto_nama` varchar(200) DEFAULT NULL,
  `foto_size` int(20) DEFAULT NULL,
  `foto_tipe` varchar(5) DEFAULT NULL,
  `alamat` text NOT NULL,
  `caption` text,
  `tgl` date NOT NULL,
  PRIMARY KEY (`id_post`),
  UNIQUE KEY `id_post` (`id_post`,`id_user`,`id_prov`,`id_kota`),
  KEY `id_user` (`id_user`),
  KEY `id_kota` (`id_kota`),
  KEY `id_prov` (`id_prov`),
  CONSTRAINT `post_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_ibfk_2` FOREIGN KEY (`id_kota`) REFERENCES `kota` (`id_kota`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `post_ibfk_3` FOREIGN KEY (`id_prov`) REFERENCES `provinsi` (`id_prov`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (22,2,11,1112,'83407eqcl0n.jpg',163914,'image','1','1','0000-00-00'),(23,2,15,1502,'76101view-5.jpg',495537,'image','1','1','0000-00-00'),(24,1,11,1101,'13241view-5.jpg',495537,'image','1111','Suspendisse a arcu vitae tellus pellentesque eleifend eleifend vehicula urna. Pellentesque tempus ante non suscipit rhoncus. In maximus magna quis dignissim ornare. Integer vestibulum, sem vitae tincidunt dignissim, justo est luctus leo, volutpat pellentesque neque risus et neque. Phasellus quam nisl, aliquam at libero at, malesuada condimentum arcu. Vivamus ut consequat diam. Ut placerat dolor ac tellus fringilla malesuada.\n\nAenean placerat tellus eu facilisis interdum. Donec finibus mauris in blandit hendrerit. Aliquam sed diam interdum purus hendrerit facilisis. Sed eros nisl, ultricies a lorem vitae, porta porttitor dolor. Etiam orci sem, fringilla eu feugiat quis, vehicula eu sapien. Aenean non felis nulla. In pulvinar lectus sit amet lectus gravida pretium. Maecenas pharetra aliquam nisl, quis iaculis elit tempus a. Sed fermentum tincidunt diam, et sollicitudin sem egestas in. Aliquam sit amet ante felis. Aenean tincidunt, augue ut viverra venenatis, odio augue vestibulum urna, quis consequat neque elit quis erat. Fusce eu sem nec enim fermentum varius in ac dui. Praesent fermentum erat eget mollis accumsan. Phasellus pellentesque, ligula ultrices pellentesque tempor, justo felis pellentesque enim, nec accumsan lectus augue id nunc. Duis ornare mi ligula, vitae tempus eros sollicitudin mattis. Nam eu est id justo pretium semper. Mauris et est. ','0000-00-00'),(25,1,21,2104,'76971architecture_paint_buildings_fantasy_art_artwork_asian_desktop_1920x1200_hd-wallpaper-1176772.jpg',1531869,'image','11','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris nisi felis, auctor sed tristique eget, scelerisque id sem. Nullam eu magna at ex tincidunt bibendum. Fusce scelerisque justo sit nullam. ','0000-00-00'),(26,1,13,1310,'85317surrealism-art-painting-wallpaper-1366x768.jpg',203000,'image','klhulh','Suspendisse a arcu vitae tellus pellentesque eleifend eleifend vehicula urna. Pellentesque tempus ante non suscipit rhoncus. In maximus magna quis dignissim ornare. Integer vestibulum, sem vitae tincidunt dignissim, justo est luctus leo, volutpat pellentesque neque risus et neque. Phasellus quam nisl, aliquam at libero at, malesuada condimentum arcu. Vivamus ut consequat diam. Ut placerat dolor ac tellus fringilla malesuada.\n\nAenean placerat tellus eu facilisis interdum. Donec finibus mauris in blandit hendrerit. Aliquam sed diam interdum purus hendrerit facilisis. Sed eros nisl, ultricies a lorem vitae, porta porttitor dolor. Etiam orci sem, fringilla eu feugiat quis, vehicula eu sapien. Aenean non felis nulla. In pulvinar lectus sit amet lectus gravida pretium. Maecenas pharetra aliquam nisl, quis iaculis elit tempus a. Sed fermentum tincidunt diam, et sollicitudin sem egestas in. Aliquam sit amet ante felis. Aenean tincidunt, augue ut viverra venenatis, odio augue vestibulum urna, quis consequat neque elit quis erat. Fusce eu sem nec enim fermentum varius in ac dui. Praesent fermentum erat eget mollis accumsan. Phasellus pellentesque, ligula ultrices pellentesque tempor, justo felis pellentesque enim, nec accumsan lectus augue id nunc. Duis ornare mi ligula, vitae tempus eros sollicitudin mattis. Nam eu est id justo pretium semper. Mauris et est. ','2016-12-27'),(27,4,17,1708,'31008vancouver_skyline4.jpg',88903,'image','sdfwe','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porttitor mattis est, molestie blandit felis. Sed eget est commodo, pellentesque elit non, lacinia quam. Nullam ullamcorper suscipit erat in fringilla. Integer eros risus, fermentum quis tellus id, egestas vulputate ex. Aliquam erat volutpat. Suspendisse posuere a eros non pharetra. Praesent ultrices ipsum at mi varius, eu fermentum velit ultrices. Praesent nunc turpis, ultricies vitae ipsum vitae, consectetur venenatis arcu. Aliquam in sagittis lorem. Etiam vel venenatis risus. Suspendisse sodales ipsum nec semper cursus. Etiam rhoncus turpis vel erat egestas, in eleifend nisi aliquet. Cras egestas interdum eros. Nam mollis, ligula. ','2016-12-27'),(28,4,31,3174,'3582The City and Thames View L8629-007_slider_slider.JPG',140588,'image','Alamaaaaaaaaat',' Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porttitor mattis est, molestie blandit felis. Sed eget est commodo, pellentesque elit non, lacinia quam. Nullam ullamcorper suscipit erat in fringilla. Integer eros risus, fermentum quis tellus id, egestas vulputate ex. Aliquam erat volutpat. Suspendisse posuere a eros non pharetra. Praesent ultrices ipsum at mi varius, eu fermentum velit ultrices. Praesent nunc turpis, ultricies vitae ipsum vitae, consectetur venenatis arcu. Aliquam in sagittis lorem. Etiam vel venenatis risus. Suspendisse sodales ipsum nec semper cursus. Etiam rhoncus turpis vel erat egestas, in eleifend nisi aliquet. Cras egestas interdum eros. Nam mollis, ligula. ','2016-12-27'),(29,4,74,7406,'68820blue_view_1920x1080.jpg',532861,'image','Alamat','Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi porttitor mattis est, molestie blandit felis. Sed eget est commodo, pellentesque elit non, lacinia quam. Nullam ullamcorper suscipit erat in fringilla. Integer eros risus, fermentum quis tellus id, egestas vulputate ex. Aliquam erat volutpat. Suspendisse posuere a eros non pharetra. Praesent ultrices ipsum at mi varius, eu fermentum velit ultrices. Praesent nunc turpis, ultricies vitae ipsum vitae, consectetur venenatis arcu. Aliquam in sagittis lorem. Etiam vel venenatis risus. Suspendisse sodales ipsum nec semper cursus. Etiam rhoncus turpis vel erat egestas, in eleifend nisi aliquet. Cras egestas interdum eros. Nam mollis, ligula. ','2016-12-27'),(31,1,18,1811,'95578architecture_paint_buildings_fantasy_art_artwork_asian_desktop_1920x1200_hd-wallpaper-1176772.jpg',1531869,'image','MESUJI','Lorem Ipsum Dolor Sit Amet','2016-12-31'),(32,1,75,7504,'11752cityview-at-longwood-apartments-views.jpg',426162,'image','aasasasa','laisicjlkasjclkaj','2016-12-31'),(33,1,32,3271,'88989ticaret_pusulasi_manzara-27.jpg',349042,'image','Lorem Ipsum','Dolor Sit Amet','2016-12-31'),(34,1,15,1509,'75003view-7.jpg',1271286,'image','Jambi','Lorem Ipsum Dolor Sit Amet','2016-12-31'),(35,2,15,1506,'19393surrealism-art-painting-wallpaper-1366x768.jpg',203000,'image','pendek','pendek','2016-12-31'),(36,2,31,3172,'58395ticaret_pusulasi_manzara-27.jpg',349042,'image','pendek','pendek','2016-12-31'),(37,2,19,1904,'41833The City and Thames View L8629-007_slider_slider.JPG',140588,'image','asdasd','asdklajsdlkj','2016-12-31'),(38,1,11,1106,'42910surrealism-art-painting-wallpaper-1366x768.jpg',203000,'image','Aceh','Aceh','2017-01-17'),(39,1,18,1809,'10986s4htfk.jpg',350251,'image','Lampung','Lorem ipsum','2017-01-17'),(41,2,31,3172,'96136Fantasy-Paintings-Ships-Bridges-Rivers-Arch-1366x768.jpg',732165,'image','DKI','DKI','2017-01-17'),(42,2,15,1505,'7373architecture_paint_buildings_fantasy_art_artwork_asian_desktop_1920x1200_hd-wallpaper-1176772.jpg',1531869,'image','aca','aca','2017-01-17');
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `provinsi`
--

DROP TABLE IF EXISTS `provinsi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `provinsi` (
  `id_prov` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `provinsi` varchar(20) NOT NULL,
  PRIMARY KEY (`id_prov`),
  UNIQUE KEY `id_prov` (`id_prov`,`provinsi`)
) ENGINE=InnoDB AUTO_INCREMENT=95 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `provinsi`
--

LOCK TABLES `provinsi` WRITE;
/*!40000 ALTER TABLE `provinsi` DISABLE KEYS */;
INSERT INTO `provinsi` VALUES (11,'ACEH'),(12,'SUMATERA UTARA'),(13,'SUMATERA BARAT'),(14,'RIAU'),(15,'JAMBI'),(16,'SUMATERA SELATAN'),(17,'BENGKULU'),(18,'LAMPUNG'),(19,'KEPULAUAN BANGKA BEL'),(21,'KEPULAUAN RIAU'),(31,'DKI JAKARTA'),(32,'JAWA BARAT'),(33,'JAWA TENGAH'),(34,'DI YOGYAKARTA'),(35,'JAWA TIMUR'),(36,'BANTEN'),(51,'BALI'),(52,'NUSA TENGGARA BARAT'),(53,'NUSA TENGGARA TIMUR'),(61,'KALIMANTAN BARAT'),(62,'KALIMANTAN TENGAH'),(63,'KALIMANTAN SELATAN'),(64,'KALIMANTAN TIMUR'),(65,'KALIMANTAN UTARA'),(71,'SULAWESI UTARA'),(72,'SULAWESI TENGAH'),(73,'SULAWESI SELATAN'),(74,'SULAWESI TENGGARA'),(75,'GORONTALO'),(76,'SULAWESI BARAT'),(81,'MALUKU'),(82,'MALUKU UTARA'),(91,'PAPUA BARAT'),(94,'PAPUA');
/*!40000 ALTER TABLE `provinsi` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id_user` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `nama` varchar(35) DEFAULT NULL,
  `nama_foto` varchar(100) NOT NULL,
  `size_foto` int(11) NOT NULL,
  `tipe_foto` varchar(5) NOT NULL,
  `email` varchar(40) DEFAULT NULL,
  `kontak` varchar(16) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `waktu_pembuatan` date NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `id_user` (`id_user`,`username`,`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'arifanoteguh','123123123','Arifano Teguh Wicaksono','9478748.jpg',75162,'image','arifanoteguh@gmail.com','625777438186','1996-02-10','0000-00-00'),(2,'ossas','12341234','ossas','',0,'','ossas@gmail.com','625777438133','1996-10-10','0000-00-00'),(3,'arifanoteguh2','123','Arifano Teguh Wicaksono','',0,'','arif','625777438123','1996-02-10','0000-00-00'),(4,'kita123','123','Kita','',0,'','kita','625733438187','1996-02-10','0000-00-00'),(5,'username','123123123','User123','',0,'','username@gmail.com','625777438543','1977-08-19','2016-12-31');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-01-17 14:54:42
