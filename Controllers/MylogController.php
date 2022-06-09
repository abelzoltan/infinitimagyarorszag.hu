<?php
class MylogController extends BaseController
{
	public $info;
	
	public function log($typeName, $datas = [], $resolution = NULL)
	{
		$this->info = $this->model->log($typeName, $datas, $resolution);
		return $this->info;
	}
}
?>