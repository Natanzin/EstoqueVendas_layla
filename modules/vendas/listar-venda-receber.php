<!-- VENDAS RECEBIDAS -->
<h1>Vendas a Receber</h1>
<?php

$sql = "SELECT * FROM vendas AS V JOIN produtos AS P ON V.id_produto = P.id_produto WHERE pagamento = 'a pagar' AND tipo_venda <> 'retirada' ORDER BY data_venda DESC";
$res = $conn->query($sql);

$qtd = $res->num_rows;

if ($qtd > 0) { ?>
    <table class='table table-sm table-hover table-striped table-bordered'>
        <tr>
            <th>Data da Venda</th>
            <th>Cliente</th>
            <th>Produto</th>
            <th>Qtd.</th>
            <th>Pagamento</th>
            <th>Vlr. unt</th>
            <th>Vlr. total</th>
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
                <td>R$ <?php print number_format($row->vlr_venda, 2, ',', '.')  ?></td>
                <td>R$ <?php print number_format($row->vlr_total_venda, 2, ',', '.')  ?></td>
                <td><?php print $row->pagamento ?></td>
                <td>
                    <button onclick=<?php print "\"location.href='?page=salvar-venda&acao=receber&id=" . $row->id_venda . "'\" " ?> class='btn btn-success btn-sm'>Receber</button>
                    <button onclick=<?php print "\"location.href='?page=editar-venda&idProduto=" . $row->id_produto . "&id=" . $row->id_venda . "'\" " ?> class='btn btn-warning btn-sm'>Editar</button>
                    <button onclick=<?php print "\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-venda&acao=excluir&idProduto=" . $row->id_produto . "&qtd=" . $row->quantidade . "&id=" . $row->id_venda . "';}else{false;}\" " ?> class='btn btn-danger btn-sm'>Excluir</button>
                </td>
            </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <p clas="alert alert-danger">Não encontrou resultador!</p>
<?php } ?>