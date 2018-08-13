<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    //return $router->app->version();
    return view('app');
});

$router->get('/login', function () use ($router) {
    return view('app');
});

// $router->get('/data', function () use ($router) {
// 	return view('upload_form');
// });

$router->group(['prefix' => 'test'], function () use ($router) {
	$router->post('/new/{id}/update', ['uses' => 'TestController@update']);
	$router->post('/new/{id}', ['uses' => 'TestController@delete']);
	$router->get('/new/{id}', ['uses' => 'TestController@get']);
	$router->post('/new', ['uses' => 'TestController@create']);
	$router->get('/new', ['uses' => 'TestController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'usertype'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'UserTypeController@update']);
	$router->post('/{id}', ['uses' => 'UserTypeController@delete']);
	$router->get('/{id}', ['uses' => 'UserTypeController@get']);
	$router->post('/', ['uses' => 'UserTypeController@create']);
	$router->get('/', ['uses' => 'UserTypeController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'propertytype'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyTypeController@update']);
	$router->post('/{id}', ['uses' => 'PropertyTypeController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyTypeController@get']);
	$router->post('/', ['uses' => 'PropertyTypeController@create']);
	$router->get('/', ['uses' => 'PropertyTypeController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'listtype'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'ListTypeController@update']);
	$router->post('/{id}', ['uses' => 'ListTypeController@delete']);
	$router->get('/{id}', ['uses' => 'ListTypeController@get']);
	$router->post('/', ['uses' => 'ListTypeController@create']);
	$router->get('/', ['uses' => 'ListTypeController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'construct'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyConstructController@update']);
	$router->post('/{id}', ['uses' => 'PropertyConstructController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyConstructController@get']);
	$router->post('/', ['uses' => 'PropertyConstructController@create']);
	$router->get('/', ['uses' => 'PropertyConstructController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'country'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'CountryController@update']);
	$router->post('/{id}', ['uses' => 'CountryController@delete']);
	$router->get('/{id}', ['uses' => 'CountryController@get']);
	$router->post('/', ['uses' => 'CountryController@create']);
	$router->get('/', ['uses' => 'CountryController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'level'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'LevelController@update']);
	$router->post('/{id}', ['uses' => 'LevelController@delete']);
	$router->get('/get/{id}', ['uses' => 'LevelController@getPropertyLevels']);
	$router->get('/{id}', ['uses' => 'LevelController@get']);
	$router->post('/', ['uses' => 'LevelController@create']);
	$router->get('/', ['uses' => 'LevelController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'state'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'StateController@update']);
	$router->post('/{id}', ['uses' => 'StateController@delete']);
	$router->get('/{id}', ['uses' => 'StateController@get']);
	$router->post('/', ['uses' => 'StateController@create']);
	$router->get('/', ['uses' => 'StateController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'city'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'CityTownController@update']);
	$router->post('/{id}', ['uses' => 'CityTownController@delete']);
	$router->get('/{id}', ['uses' => 'CityTownController@get']);
	$router->post('/', ['uses' => 'CityTownController@create']);
	$router->get('/', ['uses' => 'CityTownController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'brokerage'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'BrokerageController@update']);
	$router->post('/{id}', ['uses' => 'BrokerageController@delete']);
	$router->get('/{id}', ['uses' => 'BrokerageController@get']);
	$router->post('/', ['uses' => 'BrokerageController@create']);
	$router->get('/', ['uses' => 'BrokerageController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'brokers'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'BrokersController@update']);
	$router->post('/{id}', ['uses' => 'BrokersController@delete']);
	$router->get('/{id}', ['uses' => 'BrokersController@get']);
	$router->post('/', ['uses' => 'BrokersController@create']);
	$router->get('/', ['uses' => 'BrokersController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'owners'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'OwnersController@update']);
	$router->post('/{id}', ['uses' => 'OwnersController@delete']);
	$router->get('/{id}', ['uses' => 'OwnersController@get']);
	$router->post('/', ['uses' => 'OwnersController@create']);
	$router->get('/', ['uses' => 'OwnersController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'property'], function () use ($router) {
	$router->get('/spec/{id}', ['uses' => 'PropertyController@getPropertySpec']);
	$router->post('/{id}/update', ['uses' => 'PropertyController@update']);
	$router->get('/list', ['uses' => 'PropertyController@getList']);
	$router->post('/{id}', ['uses' => 'PropertyController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyController@get']);
	$router->post('/', ['uses' => 'PropertyController@create']);
	$router->get('/', ['uses' => 'PropertyController@getAll']);
});

// $router->group(['prefix' => 'full'], function () use ($router) {
// 	$router->post('/{id}/update', ['uses' => 'FullPropertyController@update']);
// 	$router->get('/{id}', ['uses' => 'FullPropertyController@get']);
// 	$router->post('/', ['uses' => 'FullPropertyController@create']);
// 	$router->get('/', ['uses' => 'FullPropertyController@getAll']);
// });

$router->group(['prefix' => 'insert'], function () use ($router) {
	$router->post('/property/{id}/update', ['uses' => 'FullPropertyController@update']);
	$router->get('/property/{id}', ['uses' => 'FullPropertyController@delete']);
	$router->get('/property/{id}', ['uses' => 'FullPropertyController@get']);
	$router->post('/property/', ['uses' => 'FullPropertyController@create']);
	$router->get('/property/', ['uses' => 'FullPropertyController@getAll']);
});


$router->group(['prefix' => 'propertydetails'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyDetailsController@update']);
	$router->post('/{id}', ['uses' => 'PropertyDetailsController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyDetailsController@get']);
	$router->post('/', ['uses' => 'PropertyDetailsController@create']);
	$router->get('/', ['uses' => 'PropertyDetailsController@getAll']);
});


$router->group(['prefix' => 'address'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyAddressController@update']);
	$router->post('/{id}', ['uses' => 'PropertyAddressController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyAddressController@get']);
	$router->post('/', ['uses' => 'PropertyAddressController@create']);
	$router->get('/', ['uses' => 'PropertyAddressController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'useraddress'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'UserAddressController@update']);
	$router->post('/{id}', ['uses' => 'UserAddressController@delete']);
	$router->get('/{id}', ['uses' => 'UserAddressController@get']);
	$router->post('/', ['uses' => 'UserAddressController@create']);
	$router->get('/', ['uses' => 'UserAddressController@getAll']);
});


$router->group(['prefix' => 'zone'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyZoneController@update']);
	$router->post('/{id}', ['uses' => 'PropertyZoneController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyZoneController@get']);
	$router->post('/', ['uses' => 'PropertyZoneController@create']);
	$router->get('/', ['uses' => 'PropertyZoneController@getAll']);
});


$router->group(['prefix' => 'brokerproperty'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'BrokerPropertyController@update']);
	$router->post('/{id}', ['uses' => 'BrokerPropertyController@delete']);
	$router->get('/{id}', ['uses' => 'BrokerPropertyController@get']);
	$router->post('/', ['uses' => 'BrokerPropertyController@create']);
	$router->get('/', ['uses' => 'BrokerPropertyController@getAll']);
});


$router->group(['prefix' => 'tax'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyTaxController@update']);
	$router->post('/{id}', ['uses' => 'PropertyTaxController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyTaxController@get']);
	$router->post('/', ['uses' => 'PropertyTaxController@create']);
	$router->get('/', ['uses' => 'PropertyTaxController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'propertyfeature'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PropertyFeatureController@update']);
	$router->post('/{id}', ['uses' => 'PropertyFeatureController@delete']);
	$router->get('/{id}', ['uses' => 'PropertyFeatureController@get']);
	$router->post('/', ['uses' => 'PropertyFeatureController@create']);
	$router->get('/', ['uses' => 'PropertyFeatureController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'accommodations'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'AccommodationsController@update']);
	$router->post('/{id}', ['uses' => 'AccommodationsController@delete']);
	$router->get('/{id}', ['uses' => 'AccommodationsController@get']);
	$router->post('/', ['uses' => 'AccommodationsController@create']);
	$router->get('/', ['uses' => 'AccommodationsController@getAll']);
});

//@todo Test
$router->group(['prefix' => 'pinned'], function () use ($router) {
	$router->post('/{id}/update', ['uses' => 'PinnedPropertyController@update']);
	$router->post('/{id}', ['uses' => 'PinnedPropertyController@delete']);
	$router->get('/{id}', ['uses' => 'PinnedPropertyController@get']);
	$router->post('/', ['uses' => 'PinnedPropertyController@create']);
	$router->get('/', ['uses' => 'PinnedPropertyController@getAll']);
});

$router->group(['prefix' => 'user', 'middleware' => 'cors'], function () use ($router) {
	$router->post('/secret', ['uses' => 'UserController@getUserBySecret']);
	$router->post('/update/{id}', ['uses' => 'UserController@update']);
	$router->get('/agents', ['uses' => 'UserController@getAgents']);
	$router->post('validate', ['uses' => 'UserController@login']);
	$router->post('/add', ['uses' => 'UserController@create']);
	$router->post('/{id}', ['uses' => 'UserController@delete']);
	$router->get('/{id}', ['uses' => 'UserController@get']);
	$router->get('/', ['uses' => 'UserController@getAll']);
});

$router->group(['prefix' => 'dashboard'], function () use ($router) {
	$router->get('/', ['uses' => 'DashboardController@checkLogin']);
});

$router->group(['prefix' => 'storage'], function () use ($router) {
	$router->post('upload', ['as' => 'file', 'uses' => 'FileController@upload']);
	$router->get('upload', ['as' => 'file', 'uses' => 'FileController@uploadForm']);
	$router->get('file', ['as' => 'file', 'uses' => 'FileController@writeFile']);
	$router->get('{filename}', ['as' => 'file', 'uses' => 'FileController@readFile']);
});