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

// View Routes

$router->get('/', 'HomeController@index');
$router->get('/imprint', 'ImprintController@index');
$router->get('/top', 'HomeController@top');
$router->get('/trending', 'HomeController@trending');
$router->get('idea/new', 'HomeController@new');
$router->get('idea/{id}', 'HomeController@show');
$router->get('/search', 'SearchController@search');
$router->get('/contact/{id}', 'ContactController@contact');
$router->post('/contact', 'ContactController@mailer');

// Api Routes
$router->get('api/ideas', 'IdeaController@index');
$router->get('api/idea/{id}', 'IdeaController@show');
$router->post('api/ideas', 'IdeaController@create');
$router->post('api/comments', 'CommentController@create');
$router->post('api/ratings', 'RatingController@create');

