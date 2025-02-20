<?php
  require_once __DIR__ . '/../modules/controllers/user.controller.php';

  function route($request_uri): void {
    $controller = new UserController();

    $routes = [
      '/register' => 'register',
      '/login' => 'login',
      '/getAll' => 'getAll'
    ];

    if (array_key_exists(key: $request_uri, array: $routes)) {
      $function = $routes[$request_uri];

      $controller->$function();
    } else {
      not_found();
    }
  }

  function not_found(): void {
    http_response_code(response_code: 404);
    echo json_encode(value: ["message" => "Página não encontrada (404)"]);
  }
?>
