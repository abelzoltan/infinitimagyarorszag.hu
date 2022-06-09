<?php
class WebAddressController extends BaseController
{
	public function getAddressesForSendingByURL($url)
	{
		$return = [
			"to" => [],
			"cc" => [],
			"bcc" => [],
			"all" => [],
		];
		
		$categories = $this->model->select("SELECT id FROM webAddresses_categories WHERE del = '0' AND url = :url", ["url" => $url]);
		if(count($categories) > 0)
		{
			$addresses = $this->model->select("SELECT * FROM webAddresses WHERE del = '0' AND category = :category AND active = '1'", ["category" => $categories[0]->id]);
			if(count($addresses) > 0)
			{
				foreach($addresses AS $address)
				{
					if($address->type != "info")
					{
						$okay = false;
						$name = $email = NULL;
						
						if(!empty($address->user))
						{
							$users = $this->model->select("SELECT id, email, firstName, lastName FROM users WHERE del = '0' AND id = :id", ["id" => $address->user]);
							if(count($users) > 0)
							{
								$name = $users[0]->lastName." ".$users[0]->firstName;
								$email = $users[0]->email;
								$okay = true;
							}						
						}
						else
						{
							$name = $address->name;
							$email = $address->email;
							$okay = true;
						}
						
						if($okay)
						{
							$return["all"][] = ["type" => $address->type, "email" => $email, "name" => $name];
							$return[$address->type][$email] = $name;
						}
					}
				}
			}			
		}
		
		return $return;
	}
}