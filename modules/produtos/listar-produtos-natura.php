<h1>Estoque Natura
<a href="../../../EstoqueVendas/modules/estoque/estoque-natura.php" class='btn btn-primary'>Emitir Estoque (PDF)</a>
</h1>
<?php

$sql = "SELECT * FROM produtos WHERE empresa_produto = 'natura' AND estoque_produto >= 1 ";
$res = $conn->query($sql);

$qtd = $res->num_rows;

if ($qtd > 0) { ?>
    <table id="tableProdutos" class='table table-hover table-striped table-bordered'>
        <tr>
            <th>Ciclo</th>
            <th>Nome do Produto</th>
            <th>Valor de Compra</th>
            <th>Quantidade</th>
            <th>Categoria</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $res->fetch_object()) { ?>
            <tr>
                <td><?php print $row->ciclo . "/" . $row->ano_ciclo ?></td>
                <td><?php print $row->nome_produto ?></td>
                <td>R$<?php print number_format($row->vlr_compra_produto, 2, ',','.')  ?></td>
                <td><?php print $row->estoque_produto ?></td>
                <td><?php print $row->categoria_produto ?></td>
                <td>
                    <button onclick=<?php print " \"location.href='?page=editar-produto&id=" . $row->id_produto . "'\" " ?> class='btn btn-warning'>Editar</button>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p clas="alert alert-danger">Não encontrou resultador!</p>
<?php } ?>
