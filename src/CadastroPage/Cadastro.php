<?php
$host = "localhost";
$user = "root";
$pass = 'P@$$w0rd';
$dbname = "Cadastro";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error){
    die("Falha na conexão: ". $conn->connect_error);
}else{
    echo "Conexão bem-sucedida";
}

if ($_SERVER["REQUEST_METHOD"] === "POST"){
    $nome = trim($_POST["name"]);
    $email = trim($_POST["email"]);
    $senha = trim($_POST["password"]);

    if (empty($nome) || empty($email) || empty($senha)){
        echo json_encode(["error" => "Preencha todos os campos"]);
        exit;
    }

    $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("SELECT id FROM Cadastrar WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0){
        echo json_encode(["error" => "E-mail já cadastrado"]);
        exit;
    }
    $stmt->close();

    $stmt = $conn->prepare("INSERT INTO Cadastrar(nome, email, senha) VALUES(?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senhaHash); // Corrigido o número de parâmetros

    if ($stmt->execute()){
        echo json_encode(["success"=> true, "message"=> "Cadastro realizado"]);
    } else {
        echo json_encode(["error"=> "Erro ao cadastrar"]);
    }
    $stmt->close();
}

$conn->close();
?>
