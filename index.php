<?php
require 'helpers.php';
require 'constants.php';

//add new routes here
$routes = [
    'GET:/api/ticket/' => 'TicketController@ListTicket',
    'GET:/api/ticket/detail/' => 'TicketController@DetailTicket',
    'PATCH:/api/ticket/update/' => 'TicketController@ChangeStatus',
];

// delete file path
$request_uri = $_SERVER['REQUEST_URI'];
$path_filename = explode("/", $_SERVER['SCRIPT_NAME']);
$request_uri = str_replace("/" . $path_filename[1], "", $request_uri);

// check query string in url
if (strpos($request_uri, '?') !== false) {
    $request_uri_parts = explode('?', $request_uri);
    $request_uri = $request_uri_parts[0];
    $query_string = $request_uri_parts[1];
    parse_str($query_string, $query_params);
    $query_params = validasi_params($query_params);
} else {
    $query_params = [];
}

$request_method = $_SERVER['REQUEST_METHOD'];
$route_key = $request_method . ':' . $request_uri;

if (array_key_exists($route_key, $routes)) {
    header('Content-Type: application/json');

    // separate controller name and function
    $route = $routes[$route_key];
    $route_parts = explode('@', $route);

    $controller_name = $route_parts[0];
    $method_name = $route_parts[1];

    require_once 'api/' . $controller_name . '.php';
    $controller = new $controller_name($query_params);
    $controller->$method_name();
} else {
    http_response_code(404);
    response(404, null, ERROR_MESSAGE_URL_NOT_FOUND);
}
