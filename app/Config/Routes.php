<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth routes (public)
$routes->get('/login', 'Auth::index');
$routes->post('/login', 'Auth::login');
$routes->get('/logout', 'Auth::logout');

// Public pages
$routes->get('/', 'PublicSite::index');
$routes->get('/nilai', 'PublicSite::grades');

// Protected routes (require authentication)
$routes->group('', ['filter' => 'auth'], static function ($routes) {
    // Dashboard
    $routes->get('/dashboard', 'Dashboard::index');

    // Students
    $routes->get('/students', 'Students::index');
    $routes->get('/students/create', 'Students::create');
    $routes->post('/students/store', 'Students::store');
    $routes->get('/students/edit/(:num)', 'Students::edit/$1');
    $routes->post('/students/update/(:num)', 'Students::update/$1');
    $routes->get('/students/delete/(:num)', 'Students::delete/$1');
    $routes->get('/students/view/(:num)', 'Students::view/$1');

    // Subjects
    $routes->get('/subjects', 'Subjects::index');
    $routes->get('/subjects/create', 'Subjects::create');
    $routes->post('/subjects/store', 'Subjects::store');
    $routes->get('/subjects/edit/(:num)', 'Subjects::edit/$1');
    $routes->post('/subjects/update/(:num)', 'Subjects::update/$1');
    $routes->get('/subjects/delete/(:num)', 'Subjects::delete/$1');
    $routes->get('/subjects/view/(:num)', 'Subjects::view/$1');

    // Classes
    $routes->get('/classes', 'Classes::index');
    $routes->get('/classes/create', 'Classes::create');
    $routes->post('/classes/store', 'Classes::store');
    $routes->get('/classes/edit/(:num)', 'Classes::edit/$1');
    $routes->post('/classes/update/(:num)', 'Classes::update/$1');
    $routes->get('/classes/delete/(:num)', 'Classes::delete/$1');
    $routes->get('/classes/view/(:num)', 'Classes::view/$1');

    // Grades
    $routes->get('/grades', 'Grades::index');
    $routes->get('/grades/create', 'Grades::create');
    $routes->post('/grades/store', 'Grades::store');
    $routes->get('/grades/edit/(:num)', 'Grades::edit/$1');
    $routes->post('/grades/update/(:num)', 'Grades::update/$1');
    $routes->get('/grades/delete/(:num)', 'Grades::delete/$1');
    $routes->get('/grades/student/(:num)', 'Grades::studentGrades/$1');
    $routes->get('/grades/get-students-by-class', 'Grades::getStudentsByClass');

    // Reports
    $routes->get('/reports', 'Reports::index');
    $routes->get('/reports/student', 'Reports::studentReport');
    $routes->get('/reports/class', 'Reports::classReport');
});
