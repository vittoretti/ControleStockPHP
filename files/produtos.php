<?php 

include('../inc/conexao.php');

$sql_cadastro = "INSERT INTO produtos (nome, marca, preco, categoria)  VALUES(?, ?, ?, ?)";


if(isset($_POST['nome'])){
    $nome = $_POST['nome'];
    $marca = $_POST['marca'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];

    $stmt = $conexao->prepare($sql_cadastro);

    $stmt->bind_param("ssds", $nome, $marca, $preco, $categoria);

    if($stmt->execute()){
        header("Location: produtos.php?");
        exit();
        "cadastro adicionado!";
    }else{
        "Erro!";
    }

}
$sql = "SELECT * FROM produtos";
$resultado = $conexao->query($sql);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link href="/bootstrap/css/bootstrap-grid.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="../stylesheets/style.css">
</head>
<body>
    <!-- Header do site contendo botões para categorias -->
    <header>
        <h1>Controle de Estoque</h1>
    </header>
    <div class="container">
        <form action="produtos.php" method="post">
            <h1>Cadastrar novo produto:</h1>
            <div class="row">
                <div class="col-sm-2">
                    <label for="nome">Nome:</label>
                    <input type="text" class="form-control" name="nome">
                </div>
                <div class="col-sm-2">
                    <label for="marca">Marca:</label>
                    <input type="text" class="form-control" name="marca">
                </div>
                <div class="col-sm-2">
                    <label for="preco">Preço:</label>
                    <input type="number" class="form-control" name="preco">
                </div>
                 <div class="col-sm-2">
                     <label for="categoria">Categoria:</label>
                     <input type="text" class="form-control" name="categoria">
                </div>
                <div class="col-sm-2">
                    <input style="margin: 24px;" type="submit" class="btn btn-outline-info" value="Cadastrar">
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-12">
                <table class="table table-stripeD">
                    <!-- HEADER -->
                    <tr>
                        <th>MARCA</th>
                        <th>NOME</th>
                        <th>CATEGORIA</th>
                        <th>PREÇO</th>
                        <th colspan="4">Opções</th>
                    </tr>
                    <!-- VALORES -->
                    <?php 
                        if($resultado->num_rows>0){
                            while($produto = $resultado->fetch_assoc()){
                                echo "<tr>";
                                    echo "<td style='color:blue'>" . $produto['marca'] ."</td>";
                                    echo "<td>" . $produto['nome'] ."</td>";
                                    echo "<td style='color:red'>" . $produto['categoria'] ."</td>";
                                    echo "<td style='color:green'>" . 'R$ ' . $produto['preco'] ."</td>";
                                    echo "<td><a class='btn btn-outline-danger' href='excluir.php?cd=".$produto['id']."'>Excluir</a></td>";
                                    echo "<td><a class='btn btn-outline-warning' href='editar.php?cd=".$produto['id']."'>Editar</a></td>";
                                echo "</tr>";
                            }
                        }
                    ?>  
                </table>
            </div>
        </div>
    </div>



    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>