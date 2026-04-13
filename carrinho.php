<?php
session_start();
include "db.php";
if(!isset($_SESSION['carrinho']) || empty($_SESSION['carrinho'])) {
    echo "<p>O carrinho está vazio.</p>";
} else {
    echo "<h2>Seu Carrinho</h2>";
    echo "<table>";
    echo "<tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Total</th></tr>";
    $total_carrinho = 0;
    foreach($_SESSION['carrinho'] as $item) {
        $total_item = $item['preco'] * $item['quantidade'];
        $total_carrinho += $total_item;
        echo "<tr>";
        echo "<td>{$item['nome']}</td>";
        echo "<td>R$ " . number_format($item['preco'], 2, ',', '.') . "</td>";
        echo "<td>{$item['quantidade']}</td>";
        echo "<td>R$ " . number_format($total_item, 2, ',', '.') . "</td>";
        echo "</tr>";
    }
    echo "<tr><td colspan='3'><strong>Total do Carrinho:</strong></td><td><strong>R$ " . number_format($total_carrinho, 2, ',', '.') . "</strong></td></tr>";
    echo "</table>";
}
?>

<a href="limparsessaocarrinho.php">Limpar Carrinho</a>