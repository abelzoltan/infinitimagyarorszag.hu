<?php
class NotificationController extends BaseController
{
	public function __construct($connectionData = [])
	{
		global $dbGablini;
		if(empty($connectionData) AND isset($dbGablini) AND is_array($dbGablini)) { $connectionData = $dbGablini; }
		$this->getModel($connectionData);
	}
	
	public function getPopup()
	{
		$date = date("Y-m-d H:i:s");
		$query = "SELECT * FROM notifications_popups WHERE del = '0' AND (activeFrom IS NULL OR activeFrom = '0000-00-00 00:00:00' OR activeFrom <= :activeFrom) AND (activeTo IS NULL OR activeTo = '0000-00-00 00:00:00' OR activeTo >= :activeTo) AND sites LIKE '%|6|%' ORDER BY id DESC LIMIT 0, 1";
		$params = [
			"activeFrom" => $date,
			"activeTo" => $date,
		];		
		$rows = $this->model->select($query, $params);
		return (count($rows) > 0) ? $rows[0] : false;
	}
}
?>