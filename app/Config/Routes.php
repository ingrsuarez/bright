<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Secure::login');
$routes->get('home', 'Home::index');
$routes->get('secure', 'Secure::index');
$routes->post('home', 'Home::index');

$routes->get('login', 'Secure::login');
$routes->add('logout', 'Secure::logout');
$routes->get('activate/(:num)/(:any)', 'Secure::activate/$1/$2');
$routes->post('activate/(:num)/(:any)', 'Secure::activate/$1/$2');

$routes->get('equipos', 'Equipos::index');
$routes->get('equipo/nuevo', 'Equipos::nuevo');
$routes->get('equipos/listado', 'Equipos::listado');
$routes->get('equipo/ingresar', 'Equipos::ingresar');
$routes->post('equipo/ingresar', 'Equipos::ingresar');
$routes->get('equipos/editar/(:num)', 'Equipos::editar_equipo/$1');
$routes->post('equipos/editar/(:num)', 'Equipos::editar_equipo/$1');
$routes->post('equipo/modificar/(:num)', 'Equipos::modificar/$1');
$routes->get('equipo/nueva_orden', 'Equipos::nuevaOrden');
$routes->post('equipo/nueva_orden/(:any)', 'Equipos::nuevaOrden/$1');
$routes->get('equipo/ordenes_abiertas', 'Equipos::ordenesAbiertas');
$routes->get('equipo/ordenes_abiertas/(:any)', 'Equipos::ordenesAbiertas/$1');
$routes->post('equipo/ordenes_abiertas/(:any)', 'Equipos::ordenesAbiertas/$1');
$routes->get('equipo/nueva_orden/(:any)', 'Equipos::nuevaOrden/$1');
$routes->get('equipos/listado_ordenes', 'Equipos::listadoOrdenes');


$routes->get('ventas', 'Ventas::index');
$routes->get('ventas/nuevo_remito', 'Ventas::nuevo_remito');
$routes->get('ventas/nuevo_remito/(:any)', 'Ventas::nuevo_remito/$1');
$routes->post('ventas/nuevo_remito/(:any)', 'Ventas::nuevo_remito/$1');
$routes->post('ventas/ingresarRemito', 'Ventas::ingresar_remito');
$routes->get('ventas/listado_remitos', 'Ventas::listadoRemitos');
$routes->get('ventas/listado_editarRemitos', 'Ventas::listadoEditarRemitos');
$routes->get('ventas/listado_editarRemitos/(:any)', 'Ventas::listadoEditarRemitos/$1');
$routes->get('ventas/editar_remito/(:any)', 'Ventas::editarRemito/$1');
$routes->post('ventas/editar_remito/(:any)', 'Ventas::editarRemito/$1');
$routes->post('ventas/pdfRemito/(:any)', 'Ventas::pdf_remito/$1');
$routes->get('ventas/pdfRemito/(:any)', 'Ventas::pdf_remito/$1');
$routes->get('ventas/nuevo_cambio', 'Ventas::nuevo_cambio');

$routes->get('ventas/saldos_clientes', 'Ventas::saldosClientes');
$routes->post('ventas/saldos_clientes/(:any)', 'Ventas::saldosClientes/$1');
$routes->get('ventas/saldos_clientes/(:any)', 'Ventas::saldosClientes/$1');
$routes->get('ventas/nuevo_cliente', 'Ventas::nuevo_cliente');
$routes->post('ventas/ingresar_cliente', 'Ventas::ingresar_cliente');
$routes->get('ventas/listado_clientes', 'Ventas::listadoClientes');
$routes->get('ventas/editar_cliente', 'Ventas::editar_cliente');
$routes->get('ventas/editar_cliente/(:any)', 'Ventas::editar_cliente/$1');
$routes->post('ventas/editar_cliente/(:any)', 'Ventas::editar_cliente/$1');
$routes->post('ventas/modificar_cliente', 'Ventas::modificarCliente/');
$routes->post('ventas/modificar_cliente/(:any)', 'Ventas::modificarCliente/$1');

$routes->get('rrhh', 'Rrhh::index');
$routes->get('rrhh/email1', 'Rrhh::email1');
$routes->get('rrhh/nuevo', 'Rrhh::nuevo');
$routes->post('rrhh/ingresar', 'Rrhh::ingresar');
$routes->get('rrhh/nomina', 'Rrhh::listado');
$routes->get('rrhh/editar/(:num)', 'Rrhh::editar_personal/$1');
$routes->post('rrhh/editar/(:num)', 'Rrhh::editar_personal/$1');
$routes->post('rrhh/modificar/(:num)', 'Rrhh::modificar/$1');
$routes->get('rrhh/alta_personal', 'Rrhh::altaPersonal');
$routes->post('rrhh/alta_personal/(:any)', 'Rrhh::altaPersonal/$1');


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
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
