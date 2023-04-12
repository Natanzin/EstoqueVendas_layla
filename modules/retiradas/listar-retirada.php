<h1>Minhas Retiradas</h1>
<?php

$sql = "SELECT * FROM vendas AS V JOIN produtos AS P ON V.id_produto = P.id_produto WHERE tipo_venda = 'retirada'";
$res = $conn->query($sql);

$qtd = $res->num_rows;

if ($qtd > 0) { ?>
    <table class='table table-hover table-striped table-bordered'>
        <tr>
            <th>Data da Venda</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Quantidade</th>
            <th>Forma de Pagamento</th>
            <th>Vlr. da venda</th>
            <th>Situação</th>
            <th>Ações</th>
        </tr>
        <?php while ($row = $res->fetch_object()) { ?>
            <tr>
                <td><?php print date('d/m/Y', strtotime($row->data_venda)) ?></td>
                <td><?php print $row->nome_cliente ?></td>
                <td><?php print $row->nome_produto ?></td>
                <td><?php print $row->quantidade ?></td>
                <td><?php print $row->forma_pagamento ?></td>
                <td>R$ <?php print $row->vlr_venda ?></td>
                <td><?php print $row->pagamento ?></td>
                <td>
                    <button onclick=<?php print "\"location.href='?page=editar-venda&idProduto=" . $row->id_produto . "&id=" . $row->id_venda . "'\" " ?> class='btn btn-warning'>Editar</button>
                    <button onclick=<?php print "\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-venda&acao=excluir&idProduto=" . $row->id_produto . "&qtd=" . $row->quantidade . "&id=" . $row->id_venda . "';}else{false;}\" " ?> class='btn btn-danger'>Excluir</button>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p clas="alert alert-danger">Não encontrou resultador!</p>
<?php } ?>