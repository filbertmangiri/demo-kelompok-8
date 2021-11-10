<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Pages');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Pages');

// Admin
$routes->group('admin', ['namespace' => '\App\Controllers\Admin'], function ($routes) {
	$session = session();

	$routes->get('', $session->get('is_logged_in') === true && $session->get('is_admin') === true ? 'Base' : function () {
		return redirect()->to(base_url());
	});

	$routes->get('account', $session->get('is_logged_in') === true && $session->get('is_admin') === true ? 'Account' : function () {
		return redirect()->to(base_url());
	});

	// Prevent 404 error when routing to an unknown controller
	$routes->get('(:any)', $session->get('is_logged_in') === true && $session->get('is_admin') === true ? 'Base' : function () {
		return redirect()->to(base_url());
	});
});

// User
$routes->group('u', ['namespace' => '\App\Controllers\User'], function ($routes) {
	$session = session();

	$routes->get('', $session->get('is_logged_in') === true ? 'Base::profile' : function () {
		return redirect()->to(base_url('account/register'));
	});

	$routes->group('account', function ($routes) {
		$routes->get('', 'Account');

		$routes->post('update', 'Account::update');

		$routes->get('(:any)', 'Account::$1');
	});

	$routes->get('settings', 'Account::settings'); // Optional -> base_url('u/settings');

	$routes->group('profile', function ($routes) {
		$session = session();

		$routes->get('', $session->get('is_logged_in') === true ? 'Base::profile' : function () {
			return redirect()->to(base_url('account/register'));
		});

		$routes->get('(:any)', $session->get('is_logged_in') === true ? 'Base::profile/$1' : function () {
			return redirect()->to(base_url('account/register'));
		});
	});

	$routes->get('(:any)', function () {
		return redirect()->to(base_url('u/profile'));
	});
});

// Account
$routes->group('account', ['namespace' => '\App\Controllers\Account'], function ($routes) {
	$session = session();

	$routes->get('', $session->get('is_logged_in') !== true ? 'Login' : function () {
		return redirect()->to(base_url());
	});

	$routes->get('login', $session->get('is_logged_in') !== true ? 'Login' : function () {
		return redirect()->to(base_url());
	});

	$routes->get('register', $session->get('is_logged_in') !== true ? 'Register' : function () {
		return redirect()->to(base_url());
	});

	$routes->get('logout', 'Logout');

	// Prevent 404 error when routing to an unknown controller
	$routes->get('(:any)', $session->get('is_logged_in') !== true ? 'Login' : function () {
		return redirect()->to(base_url());
	});
});

// Redirect to home instead of showing 404
$routes->get('(:any)', function () {
	return redirect()->to(base_url());
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
