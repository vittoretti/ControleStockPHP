<?php 
include('../inc/conexao.php');


$id = $_GET['id'] ?? $_GET['cd'] ?? $_POST['id'] ?? null;

if ($id) {
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        // Exibe o alerta, redirecionando para a página de produtos para evitar duplicação
        echo "<script>
                alert('Produto excluído com sucesso!');
                window.location.href = 'produtos.php';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Erro ao excluir produto!');
                window.location.href = 'produtos.php';
              </script>";
        exit();
    }
} else {
    header("Location: produtos.php");
    exit();
}
?>