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
$router->get('/top', 'HomeController@top');
$router->get('/trending', 'HomeController@trending');
$router->get('idea/new', 'HomeController@new');
$router->get('idea/{id}', 'HomeController@show');

// Api Routes
$router->get('api/ideas', 'IdeaController@index');
$router->get('api/ideas/top', 'IdeaController@top');
$router->get('api/ideas/trending', 'IdeaController@trending');
$router->get('api/idea/{id}', 'IdeaController@show');
$router->post('api/ideas', 'IdeaController@create');
$router->post('api/comments', 'CommentController@create');

