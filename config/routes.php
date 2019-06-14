<?php
return array(
	'orders/([0-9]+)' => 'orders/view/$1',
	'orders' => 'orders/index', 
	'login' => 'login/login',
	'logout' => 'login/logout',
	'addorder' => 'orders/addorder',
	'deleteorder/([0-9]+)' => 'orders/deleteorder/$1',
	'deleteorder' => 'orders/deleteorder',
	'adduser' => 'login/adduser',
	'404' => 'pagenotfound/notfound',
	);