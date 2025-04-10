<?php
// Configurações do banco de dados
$host = 'localhost';
$dbname = 'orcamentos';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $valor = $_POST['valor'];
        $mensagem = $_POST['mensagem'];

        // Inserir dados no banco de dados
        $sql = "INSERT INTO orcamentos (nome, email, telefone, valor, mensagem) 
                VALUES (:nome, :email, :telefone, :valor, :mensagem)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':nome' => $nome,
            ':email' => $email,
            ':telefone' => $telefone,
            ':valor' => $valor,
            ':mensagem' => $mensagem
        ]);

        // Redirecionar para a página de agradecimento
        header("Location: obrigado.php");
        exit();
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Orçamento</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: "Poppins", sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        h1 {
            color: #ffd700;
        }
        .form-control {
            background-color: #333;
            border: 1px solid #ffd700;
            color: #fff;
        }
        .form-control:focus {
            box-shadow: 0 0 5px rgba(255, 215, 0, 0.5);
            border-color: #ffd700;
        }
        .btn-primary {
            background-color: #ffd700;
            border-color: #ffd700;
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center mb-4">Solicite um Orçamento</h1>
        <form action="index.php" method="POST">
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control" required placeholder="Seu nome">
            </div>
            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" name="email" id="email" class="form-control" required placeholder="seuemail@exemplo.com">
            </div>
            <div class="form-group">
                <label for="telefone">Telefone/WhatsApp:</label>
                <input type="text" name="telefone" id="telefone" class="form-control" required placeholder="Ex.: 5511999999999">
            </div>
            <div class="form-group">
                <label for="valor">Valor Estimado:</label>
                <input type="number" name="valor" id="valor" class="form-control" step="0.01" placeholder="Valor estimado">
            </div>
            <div class="form-group">
                <label for="mensagem">Mensagem:</label>
                <textarea name="mensagem" id="mensagem" class="form-control" rows="4" placeholder="Detalhes do serviço desejado"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Orçamento</button>
        </form>
    </div>
</body>
</html>
