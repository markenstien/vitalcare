<?php
	
	$routes = [];

	$controller = '/UserController';

	$routes['user'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceController';

	$routes['service'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceBundleController';

	$routes['service-bundle'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceBundleItemController';

	$routes['service-bundle-item'] = [
		'index' => $controller.'/index',
		'add' => $controller.'/add',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];

	$controller = '/ServiceCartController';

	$routes['service-cart'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'add' => $controller.'/add',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];


	$controller = '/AppointmentController';

	$routes['appointment'] = [
		'index' => $controller.'/index',
		'create' => $controller.'/create',
		'edit' => $controller.'/edit',
		'add' => $controller.'/add',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];
	

	$controller = '/SpecialtyController';

	$routes['specialty'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];
	
	$controller = '/CategoryController';

	$routes['category'] = [
		'index' => $controller.'/index',
		'edit' => $controller.'/edit',
		'create' => $controller.'/create',
		'delete' => $controller.'/destroy',
		'show'   => $controller.'/show'
	];
	

	return $routes;
?>