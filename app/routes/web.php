<?php
	
	$routes = [];

	$controller = '/UserController';

	$routes['user'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/delete',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceController';

	$routes['service'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/delete',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceBundleController';

	$routes['service-bundle'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/delete',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceBundleItemController';

	$routes['service-bundle-item'] = [
		'index' => $controller.'/index',
		'add' => $controller.'/add',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/delete',
		'show'   => $controller.'/show'
	];

	

	$controller = '/SpecialtyController';

	$routes['specialty'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/delete',
		'show'   => $controller.'/show'
	];
	
	$controller = '/CategoryController';

	$routes['category'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/delete',
		'show'   => $controller.'/show'
	];
	

	return $routes;
?>