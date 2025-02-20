<?php
  class UserService {
    public function register(string $email, string $password) {
      $fileName = __DIR__ . '/../db/users.json';
      $jsonData = file_get_contents(filename: $fileName );

      $dataArray = json_decode(json: $jsonData, associative: true);

      $user = $this->findUser(data: $dataArray, email: $email);

      if($user)
        throw new Exception(message: "Esse email já foi cadastrado", code: 409);

      $hashedPass = password_hash(password: $password, algo: PASSWORD_DEFAULT);

      $newData = [
        'email' => $email,
        'password' => $hashedPass
      ];

      $dataArray[] = $newData;

      $newJsonData = json_encode(value: $dataArray, flags: JSON_PRETTY_PRINT);

      file_put_contents(filename: $fileName, data: $newJsonData);
    }

    public function login(): void {
      $email = $_POST['email'] ?? '';
      $password = $_POST['password'] ?? '';

      $fileName = __DIR__ . '/../db/users.json';
      $jsonData = file_get_contents(filename: $fileName);

      $dataArray = json_decode(json: $jsonData, associative: true);

      $user = $this->findUser(data: $dataArray, email: $email);

      if($user) {
        if(password_verify(password: $password, hash: $user['password'])) {
          http_response_code(response_code: 200);
          echo json_encode(value: ["status" => 'sucesso', 'mensagem' => 'Login realizado com sucesso']);

          return;
        }

        http_response_code(response_code: 400);
        echo json_encode(value: ['status'=> 'error', 'mensagem' => 'Credenciais Inválidas']);
      } else {
        http_response_code(response_code: 404);
        echo json_encode(value: ['status'=> 'error', 'mensagem' => 'Usuário não encontrado']);
      }
    }

    private function findUser($data, $email) {
      foreach ($data as $item) {
        if ($item['email'] === $email) {
          return $item;
        }
      }

      return null;
    }
  }
?>