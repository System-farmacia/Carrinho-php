<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Teste do carrinho que eu ainda nn peguei</h2>
<?php
include "db.php";
//quero pegar a imagem que tá aqui e os dados que estão no banco de dados e mostrar na tela, como faço isso?
$comando = $db->prepare("SELECT id_produto, nome, descricao, preco FROM produtos WHERE id_produto = 2");



$comando->execute();
$resultado = $comando->get_result();



if ($resultado && $resultado->num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        echo "<div>";
        echo "<img src='img/produtos/dorflex.png' alt='Imagem do produto'> <a href='?adicionar=" . $row['id_produto'] . "&nome=" . urlencode($row['nome']) . "'>Adicionar ao carrinho</a>";
        echo "<h2>" . $row['nome'] . "</h2>";
        echo "<p>" . $row['descricao'] . "</p>";
        echo "<p>Preço: R$ " . $row['preco'] . "</p>";
        echo "</div>";
    }
}

?>
<?php
if(isset($_GET['adicionar'])) {
    $id =(int) $_GET['adicionar'];
    $nome = (string) $_GET['nome'];
    if(!isset($_SESSION['id_produto'])) {
    if(isset($_SESSION['carrinho'][$id])) {
        $_SESSION['carrinho'][$id]   ['quantidade']++;
    }else{
        $_SESSION['carrinho'][$id] = [
            'id_produto' => $id,
            'nome' => $nome,
            'quantidade' => 1
        ];
    }
    echo "<script>alert('Produto adicionado ao carrinho!');</script>";
    }else{
        echo "Produto não existe: " . $id_produto;
    }
    
    }




?>
<h2>Carrinho</h2>

<?php
if(isset($_SESSION['carrinho'])) {
foreach($_SESSION['carrinho'] as $key => $item) {
    echo "<p>Nome: ." . $item['nome'] . " - Quantidade: " . $item['quantidade'] . "</p>";
}
} else {
    echo "<p>O carrinho está vazio.</p>";
}
?>


</body>
</html>

