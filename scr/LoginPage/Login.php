<?php
$host = "localhost";
$user = "root";
$pass = 'P@$$w0rd';
$dbname = "Cadastro";

// Criar conexão
$conn = new mysqli($host, $user, $pass, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST["email"]);
    $senha = trim($_POST["password"]);

    if (empty($email) || empty($senha)) {
        echo json_encode(["error" => "Preencha todos os campos"]);
        exit;
    }

    // Verificar se o e-mail existe no banco de dados
    $stmt = $conn->prepare("SELECT id, nome, senha FROM Cadastrar WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // O e-mail existe, vamos verificar a senha
        $stmt->bind_result($id, $nome, $senhaHash);
        $stmt->fetch();

        // Verificar a senha fornecida com a senha hasheada no banco
        if (password_verify($senha, $senhaHash)) {
            // Login bem-sucedido, redirecionar para a página "Maker/index.html"
            header("Location:../index.html");
            exit; // Certifique-se de chamar exit após o redirecionamento
        } else {
            echo json_encode(["error" => "Senha incorreta"]);
        }
    } else {
        echo json_encode(["error" => "E-mail não encontrado"]);
    }

    $stmt->close();
}

$conn->close();
?>
