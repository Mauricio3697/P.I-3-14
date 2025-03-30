<?php  
    if(isset($_POST['submit']))
    {
      /*print_r('Nome:' .$_POST['nome']);
      print_r('<br>');
      print_r('Email: '. $_POST['email']);
      print_r('<br>');
      print_r('Telefone:'.$_POST['telefone']);
      print_r('<br>');
      print_r('Mensagem:'.$_POST['mensagem']);*/

      include_once('config.php');

      $nome = $_POST['nome'];
      $email = $_POST['email'];
      $telefone =$_POST['telefone'];
      $valor =$_POST['valor'];
      $mensagem =$_POST['mensagem'];

      $result = mysqli_query($conexao, "INSERT INTO usuarios(nome, email, telefone, valor, mensagem) 
      VALUES ('$nome', '$email', '$telefone', '$valor', '$mensagem')");
      
    }
   
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Solicitar Orçamento</title>
    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    />
    <style>
      body {
        background-color: #121212;
        color: #fff;
        font-family: "Poppins", sans-serif;
      }
      .container {
        margin-top: 50px;
      }
      h1, label {
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
      .btn-primary, .btn-success {
        background-color: #ffd700;
        border-color: #ffd700;
        color: #000;
        transition: background-color 0.3s ease, transform 0.3s ease;
      }
      .btn-primary:hover, .btn-success:hover {
        background-color: #e6c200;
        transform: scale(1.05);
      }
    </style>
  </head>
  <body>
    <div class="container">
      <h1 class="mb-4 text-center">Solicite um Orçamento</h1>
      <form action="formulario.php" method="POST">
        <div class="form-group">
          <label for="nome">Nome:</label>
          <input
            type="text"
            name="nome"
            id="nome"
            class="form-control"
            placeholder="Seu nome"
            required
          />
        </div>
        <div class="form-group">
          <label for="email">E-mail:</label>
          <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="seuemail@exemplo.com"
            required
          />
        </div>
        <div class="form-group">
          <label for="telefone">Telefone/WhatsApp:</label>
          <input
            type="text"
            name="telefone"
            id="telefone"
            class="form-control"
            placeholder="Somente números (ex.: 5511999999999)"
            required
          />
        </div>
        <div class="form-group">
          <label for="valor">Valor Estimado:</label>
          <input
            type="number"
            name="valor"
            id="valor"
            class="form-control"
            step="0.01"
            placeholder="Valor estimado"
          />
        </div>
        <div class="form-group">
          <label for="mensagem">Mensagem:</label>
          <textarea
            name="mensagem"
            id="mensagem"
            class="form-control"
            rows="4"
            placeholder="Detalhes do serviço desejado"
          ></textarea>
        </div>
        <div class="form-group text-center">
          <button name="submit" type="submit" class="btn btn-primary mr-2">
            Enviar Orçamento
          </button>
        </div>
      </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
