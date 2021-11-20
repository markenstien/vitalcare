<?php
	
	$routes = [];

	$controller = '/HomeController';

	$routes['home'] = [
		'index' => $controller.'/index'
	];

	$controller = '/TopTenController';

	$routes['topTen'] = [
		'index' => $controller.'/index'
	];

	$controller = '/AvatarController';

	$routes['avatar'] = [
		'index' => $controller.'/index',
		'show' => $controller.'/show'
	];

	$controller = '/BalancerController';

	$routes['balancer'] = [
		'index' => $controller.'/index',
		'show'  => $controller.'/show'
	];

	$controller = '/LeagueController';

	$routes['league'] = [
		'index' => $controller .'/index',
		'show'  => $controller .'/show'
	];

	$controller = '/LeaguePlayerController';

	$routes['leaguePlayer'] = [
		'search' => $controller .'/search'
	];

	$controller = '/DotaController';

	$routes['dota'] = [
		'index' => $controller .'/index',
		'show'  => $controller .'/show'
	];

	$controller = '/DotaBalancerController';

	$routes['dotaBalancer'] = [
		'index' => $controller .'/index',
		'show'  => $controller .'/show'
	];


	$controller = '/LoginController';

	$routes['login'] = [
		'action' => $controller.'/loginAction',
		'index'  => $controller.'/index',
		'destroy'  => $controller.'/destroy',
	];

	$controller = '/LeagueBalancerController';

	$routes['leagueBalancer'] = [
		'index' => $controller .'/index',
		'show' => $controller .'/show',
	];

	$controller = '/ApiKeyController';

	$routes['api'] = [
		'edit' => $controller .'/edit',
	];
		

	$controller = '/MobileLegendController';

	$routes['mobile'] = [
		'show' => $controller.'/show',
		'index' => $controller.'/index'
	];


	$controller = '/MobileLegendBalancerController';

	$routes['mobileBalancer'] = [
		'index' => $controller.'/index'
	];


	$controller = '/MatchesController';

	$routes['match'] = [
		'index' => $controller .'/index'
	];

	return $routes;
?>