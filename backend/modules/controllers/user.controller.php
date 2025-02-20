<?php
  require_once __DIR__ . "/../services/user.service.php";

  class UserController {
    private $service;

    public function __construct() {
      $this->service = new UserService();
    }

    public function register(): void {
      try {
        $this->service->register(email: $_POST['email'] ?? '', password: $_POST['password'] ?? '');

        http_response_code(response_code: 200);
        echo json_encode(value: ["status" => 'sucesso', 'mensagem' => 'Usuário cadastrado com sucesso']);
      } catch (Exception $e) {
        http_response_code(response_code: $e->getCode());
        echo json_encode(value: ['status' => 'error', 'mensagem' => $e->getMessage()]);
      }
    }

    public function login(): void {
      try {
        $this->service->login();
      } catch (Exception $e) {
        http_response_code(response_code: $e->getCode());
        echo json_encode(value: ['status' => 'error', 'mensagem' => $e->getMessage()]);
      }
    }

    public function getAll(): void {
      try {
        $this->service->getAll();
      } catch (Exception $e) {
        http_response_code(response_code: $e->getCode());
        echo json_encode(value: ['status' => 'error', 'mensagem' => $e->getMessage()]);
      }
    }
  }
?>

