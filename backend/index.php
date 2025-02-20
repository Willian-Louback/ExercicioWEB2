<?php
  header(header: "Access-Control-Allow-Origin: *");
  header(header: "Access-Control-Allow-Methods: GET, POST, OPTIONS");
  header(header: "Access-Control-Allow-Headers: Content-Type");
  header(header: 'Content-Type: application/json');

  require_once __DIR__ . '/routes/route.php';

  $request_uri = parse_url(url: $_SERVER['REQUEST_URI'], component: PHP_URL_PATH);

  route(request_uri: $request_uri);
?>
