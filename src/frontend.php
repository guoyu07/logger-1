<?php

/**
 * Part of the Antares package.
 *
 * NOTICE OF LICENSE
 *
 * Licensed under the 3-clause BSD License.
 *
 * This source file is subject to the 3-clause BSD License that is
 * bundled with this package in the LICENSE file.
 *
 * @package    Logger
 * @version    0.9.0
 * @author     Antares Team
 * @license    BSD License (3-clause)
 * @copyright  (c) 2017, Antares
 * @link       http://antaresproject.io
 */
use Illuminate\Routing\Router;

$router->get('download/{path}', 'DownloadController@download');

$router->group(['prefix' => 'logger'], function (Router $router) {
    $router->match(['GET', 'POST'], 'devices/index', 'DevicesController@index');
    $router->resource('devices', 'DevicesController');
});