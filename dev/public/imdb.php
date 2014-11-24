<?php

header('Content-type: text/html; charset=UTF-8');

require_once('imdb.class.php');

define('HOST', '172.19.1.185');
define('USER', 'lumiere');       
define('PASSWORD', 'neC7jIv3lis4Git3U');         
define('DATABASE', 'lumiere');
define('TABLE', 'cards');

$link = mysql_connect(HOST, USER, PASSWORD);
if(!$link) die('Impossible de se connecter au serveur: ' . mysql_error());

$db = mysql_select_db(DATABASE);
if(!$db) die("Base de données introuvable");

function save($data, $poster_url){
	unset($data["id"]);
	$sql = "INSERT INTO ".TABLE." (";
	foreach ($data as $key => $value) {
		$sql .= "$key,";
	}
	$sql =  substr($sql, 0, -1);
	$sql .= ") VALUES (";

	foreach ($data as $value) {
		$sql .= "'$value',";
	}
	$sql = substr($sql, 0, -1);
	$sql .= ")";
	
	mysql_query($sql) or die(mysql_error(). '-' .mysql_query());

	$id = mysql_insert_id();
	$img = 'dl/' . $id . '.jpg';
	file_put_contents($img, file_get_contents($poster_url));
}

$myIMDB = new Imdb();
$frenchCities = array('Paris', 'Marseille', 'Lyon', 'Toulouse', 'Nice', 'Nantes', 'Strasbourg', 'Montpellier', 'Bordeaux', 'Lille', 'Rennes', 'Le', 'Reims', 'Saint', 'Toulon', 'Grenoble', 'Angers', 'Dijon', 'Brest', 'Le Mans', 'Clermont-Ferrand', 'Amiens', 'Aix-En-Provence', 'Limoges', 'Nîmes', 'Tours');

function translatePlot($text){

	$googleAPIKey = 'AIzaSyDWs2ePEn5WSfEDPnq3xEeRTWI7JTaIl3U';
	$url = 'https://www.googleapis.com/language/translate/v2?key=' . $googleAPIKey . '&q=' . rawurlencode($text) . '&source=en&target=fr';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_ENCODING , 'UTF-8');
    
    $response = curl_exec($ch);                 
    $responseDecoded = json_decode($response, true);

    curl_close($ch);

    return $responseDecoded['data']['translations'][0]['translatedText'];
}

function getAddressInfo($address, $type){
	$geocoder = "http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false";
	$url_address = utf8_encode($address);
 	$url_address = urlencode($url_address);
 	$query = sprintf($geocoder, $url_address);
 	
 	$results = file_get_contents($query);
 	$results = json_decode($results, true);
 	$result = $results['results'][0]['geometry']['location'];

 	return $result[$type];
}

//'tt1675434', 'tt2278871', 'tt3612616', 'tt0211915', 'tt2737050', 'tt0290673', 'tt2752200', 'tt2800240', 'tt1029234', 'tt2406252', 'tt3399024', 'tt2054790', 'tt0237534', 'tt2053425', 'tt2027140', 'tt2316801', 'tt0113247', 'tt0362225', 'tt0450188', 'tt0414852'); 
//$movieIDs = array('tt1255953', 'tt2707848', 'tt1602620', 'tt0194314', 'tt0344510', 'tt0401711', 'tt2404461', 'tt1937118', 'tt0053472', 'tt1235166', 'tt0110963', 'tt0401383', 'tt0856288', 'tt2368635', 'tt0101700', 'tt0338095', 'tt2076220', 'tt0100263', 'tt2427892', 'tt2400275', 'tt1656192', 'tt3204734', 'tt1816518', 'tt1756750', 'tt3230082', 'tt1465487', 'tt0053198', 'tt0112682', 'tt0354899', 'tt2330546', 'tt1600524', 'tt1181840', 'tt0372824', 'tt1650048', 'tt1247640', 'tt3184934', 'tt2788556', 'tt0111495', 'tt0961097', 'tt3129564', 'tt1440232', 'tt1149361', 'tt1964624', 'tt3655522', 'tt0108394', 'tt1035736', 'tt0046911', 'tt1424797', 'tt3098306', 'tt2707858', 'tt0250223', 'tt0283900', 'tt0061395', 'tt0249380', 'tt0424205', 'tt2852458', 'tt1130988', 'tt0028950', 'tt0286244', 'tt0038348', 'tt3365778', 'tt0792948', 'tt0814685', 'tt1167638', 'tt0152930', 'tt0287963', 'tt1528750', 'tt2315200', 'tt0110612', 'tt0254686', 'tt1068649', 'tt1179025', 'tt0057345', 'tt2733258', 'tt1597522', 'tt2822742', 'tt1911553', 'tt0103905', 'tt1549589', 'tt1521848');
$movieIDs = array('tt2936180', 'tt2106550', 'tt3409392', 'tt1753813', 'tt0411270', 'tt0465203', 'tt0152015', 'tt0120802', 'tt0228786', 'tt0387898', 'tt2811878', 'tt1668200', 'tt1545759', 'tt0283832', 'tt1259014', 'tt1879030', 'tt2070776', 'tt0099334', 'tt0053459', 'tt0074811', 'tt0055032', 'tt2150332', 'tt0108500', 'tt0082949', 'tt0073115', 'tt2298384', 'tt0052893', 'tt2087850', 'tt3660370', 'tt0157016', 'tt0808417', 'tt1828995', 'tt2011971', 'tt0133385', 'tt0062229', 'tt3204144', 'tt0364517', 'tt1646127', 'tt2231630', 'tt0808339', 'tt0071464', 'tt1588337', 'tt0381392', 'tt3218580', 'tt1753584', 'tt3324494', 'tt0072933', 'tt1550312', 'tt0058450', 'tt1740053', 'tt0456396', 'tt1654829', 'tt0068361', 'tt1075113', 'tt0093489', 'tt0482088', 'tt1827512', 'tt2392672', 'tt1986843', 'tt0091288', 'tt1605769', 'tt1194616', 'tt1320082', 'tt0049189', 'tt0091480', 'tt0058946', 'tt0486751', 'tt0062136', 'tt2935564', 'tt0445054', 'tt1663321', 'tt0464913', 'tt2165236', 'tt1023441', 'tt0090563', 'tt1382725', 'tt0242795', 'tt1186369', 'tt0046268', 'tt0463872', 'tt0054189', 'tt3112654', 'tt0783530', 'tt1235552', 'tt0070460', 'tt2289538', 'tt1727516', 'tt2062969', 'tt1401643', 'tt2094877', 'tt0378661', 'tt1322333', 'tt1951166', 'tt1541110', 'tt1847731', 'tt2004279', 'tt1174047', 'tt2609222', 'tt0104507', 'tt0381985', 'tt0417189', 'tt0473753', 'tt0487419', 'tt1565958', 'tt0077288', 'tt1194238', 'tt0808372', 'tt1064932', 'tt1167660', 'tt1473063', 'tt1990217', 'tt0135024', 'tt0072353', 'tt1508675', 'tt1673702', 'tt2177827', 'tt0090095', 'tt2536428', 'tt0295721', 'tt2976920', 'tt1683921', 'tt1183276', 'tt1820488', 'tt1459012', 'tt0778784', 'tt2929890', 'tt0450843', 'tt1846472', 'tt2659190', 'tt0437526', 'tt1599975', 'tt0407621', 'tt1533818', 'tt0031514', 'tt1264904', 'tt2821088', 'tt0104008', 'tt2402623', 'tt1555084', 'tt0877700', 'tt0048021', 'tt0204709', 'tt0926759', 'tt1528313', 'tt2473750', 'tt1726861', 'tt2876834', 'tt3421514', 'tt0059592', 'tt0055572');

foreach ($movieIDs as $key => $movie) {

	$movieInfo = $myIMDB->getMovieInfoById($movie);
	$movieInfoLocation = $frenchCities[rand(0, count($frenchCities) - 1)] . ', ' . $movieInfo['country'];

	$movie = array(
		'id'                => mysql_real_escape_string(NULL),
		'title'             => mysql_real_escape_string($movieInfo['title']),
		'description'       => mysql_real_escape_string(translatePlot($movieInfo['plot'] . ' ' . $movieInfo['storyline'])),
		'poster_url'        => mysql_real_escape_string(NULL),
		'thumb_url'         => mysql_real_escape_string(NULL),
		'date_publication'  => mysql_real_escape_string($movieInfo['year']),
		'date_production'   => mysql_real_escape_string($movieInfo['year']),
		'length'            => mysql_real_escape_string($movieInfo['runtime']),
		'location'          => mysql_real_escape_string($movieInfoLocation),
		'location_lat'      => mysql_real_escape_string(getAddressInfo($movieInfoLocation, 'lat')),
		'location_long'     => mysql_real_escape_string(getAddressInfo($movieInfoLocation, 'lng')),
		'video_url'         => mysql_real_escape_string($movieInfo['videos']),
		'categories_id'     => mysql_real_escape_string(rand(4, 19)),
		'is_trailer'        => mysql_real_escape_string(0),
		'created_at'        => mysql_real_escape_string('0000-00-00 00:00:00'),
		'updated_at'        => mysql_real_escape_string('0000-00-00 00:00:00'),
		'user_id'           => mysql_real_escape_string(2),
		'destination_url'   => mysql_real_escape_string($movieInfo['imdb_url']),
	);

	save($movie, $movieInfo['poster_full']);
}

?>

