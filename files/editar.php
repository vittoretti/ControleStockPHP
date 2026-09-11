<?php 
include('../inc/conexao.php');


$id = $_GET['id'] ?? $_GET['cd'] ?? $_POST['id'] ?? null;

if (!$id) {
    header("Location: produtos.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome      = $_POST['nome'];
    $categoria = $_POST['categoria'];
    $preco     = $_POST['preco'];
    $marca     = $_POST['marca'];

    $updt = "UPDATE produtos SET nome = ?, categoria = ?, preco = ?, marca = ? WHERE id = ?";
    $stmt = $conexao->prepare($updt);

    $stmt->bind_param('ssdsi', $nome, $categoria, $preco, $marca, $id);

    if ($stmt->execute()) {
        echo "<script>
                alert('Produto atualizado com sucesso!');
                window.location.href='produtos.php';
              </script>";
        exit();
    } else {
        echo "<script>alert('Erro ao atualizar produto!');</script>";
    }
}


$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conexao->prepare($sql);
$stmt->bind_param('i', $id);
$stmt->execute();
$resultado = $stmt->get_result();
$produto = $resultado->fetch_assoc();


if (!$produto) {
    echo "<p class='alert alert-danger'>Produto não encontrado!</p>";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link href="../bootstrap/css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="../stylesheets/style.css">
</head>
<body>
    <!-- Header da página -->
    <header><h1>Edição de Produtos</h1></header>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <!-- Header do card de edição de dados -->
                    <div class="card-header">
                        <h1>Editar Produto Nº<?php echo $produto['id']; ?></h1>
                    </div>
                    <!-- Formulário do card para registrar os dados novos -->
                    <div class="card-body">
                        <form action="" method="post">
                            
                            <!-- Campo para armazenar o id do produto -->
                            <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

                            <!-- Demais campos (Nome,Preço, etc.) -->
                            <div class="mb-3">
                                <label for="nome" class="form-label">Nome:</label>
                                <input name="nome" type="text" value="<?php echo htmlspecialchars($produto['nome']); ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="marca" class="form-label">Marca:</label>
                                <input name="marca" type="text" value="<?php echo htmlspecialchars($produto['marca']); ?>" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="categoria" class="form-label">Categoria:</label>
                                <input name="categoria" type="text" value="<?php echo htmlspecialchars($produto['categoria']); ?>" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="preco" class="form-label">Preço:</label>
                                <input name="preco" type="number" step="0.01" value="<?php echo $produto['preco']; ?>" class="form-control" required>
                            </div>

                            <div class="card-buttons d-flex gap-3">
                                <button type="submit" class="btn btn-success w-100">Salvar Alterações</button>
                                <a href="produtos.php" class="btn btn-cancel w-100">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script src="/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>