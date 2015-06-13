<? ob_start();

require_once "../WEB-INF/includes/functions/functions_benchmark.php";
session_name("cms_session");
session_start();
require_once "../WEB-INF/includes/classes/class.x3.utils.php";
	
		// includes
		require_once "../WEB-INF/includes/classes/class.x3.database.php";
		require_once "../WEB-INF/includes/config.php";
		require_once "../WEB-INF/includes/functions/functions_utils.php";
		include "../WEB-INF/includes/smarty/smarty_cms.php";
		// DB connction
		$db = new DB_config;
		$db->connect();

		
	
		$fields = array("order_id", "order_first_name","order_last_name", "departure_date", "departure_time");
		$query = "SELECT * from orders o inner join departure d on (o.order_departure_id = d.departure_id) where d.departure_tour_id = 21 and order_time < 1376956800";
		$res = $db->select_fields($db->orders, $query, $fields, "", "");
		
		
		echo "<pre>";
		
		print_r($res);
		
		echo "</pre>"
		
?>
