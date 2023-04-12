<!-- VENDAS RECEBIDAS -->
<h1>Vendas</h1>
<?php
//define o numero de itens por página
$itens_por_pagina = 60;

//pegar a página atual
$pagina = intval($_GET['pagina']);

$limit = $pagina * $itens_por_pagina;

$sql = "SELECT * FROM vendas AS V JOIN produtos AS P ON V.id_produto = P.id_produto WHERE pagamento = 'pago' AND tipo_venda <> 'retirada' ORDER BY data_venda DESC LIMIT $limit, $itens_por_pagina";
$res = $conn->query($sql);

$num_total = $conn->query("SELECT * FROM vendas AS V JOIN produtos AS P ON V.id_produto = P.id_produto WHERE pagamento = 'pago' AND tipo_venda <> 'retirada'")->num_rows;

$num_paginas = ceil($num_total / $itens_por_pagina);

$qtd = $res->num_rows;

if ($qtd > 0) { ?>

    <!--
    <form action="?page=listar-venda">
        <div class="mb-3">
            <label for="">Pesquisa</label>
            <input required type="text" name="pesquisa" class="form-control-sm">
            <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
        </div>
    </form>
-->
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
                    <button onclick=<?php print "\"location.href='?page=editar-venda&idProduto=" . $row->id_produto . "&id=" . $row->id_venda . "'\" " ?> class='btn btn-warning'>Editar</button>
                    <button onclick=<?php print "\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-venda&acao=excluir&idProduto=" . $row->id_produto . "&qtd=" . $row->quantidade . "&id=" . $row->id_venda . "';}else{false;}\" " ?> class='btn btn-danger'>Excluir</button>
                </td>
            </tr>
        <?php } ?>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item">
                <a class="page-link" href="?page=listar-venda&pagina=0" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($i = 0; $i < $num_paginas; $i++) {
                $estilo = "";
                if ($pagina == $i) {
                    $estilo = " active ";
                }
            ?>
                <li class=" <?php echo $estilo; ?> page-item"><a class="page-link" href="?page=listar-venda&pagina=<?php echo $i; ?>"><?php echo $i + 1 ?></a></li>
            <?php } ?>
            <li class="page-item">
                <a class="page-link" href="?page=listar-venda&pagina=<?php echo $num_paginas - 1 ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
<?php } else { ?>
    <p clas="alert alert-danger">Não encontrou resultador!</p>
<?php } ?>