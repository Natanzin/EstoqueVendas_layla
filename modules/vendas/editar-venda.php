<h1>Editar venda</h1>

<?php

$sql = "SELECT * FROM vendas AS V JOIN produtos AS P ON V.id_produto = P.id_produto WHERE id_venda=" . $_REQUEST['id'];
$res = $conn->query($sql);
$row = $res->fetch_object();

?>

<form action="?page=salvar-venda" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?php print $row->id_venda; ?>">
    <div class="mb-3">
        <label for="">Tipo de Venda*</label>
        <select name="tipo_venda" id="tipo_venda" class="form-select">
            <option <?= ($row->tipo_venda == 'venda') ? 'selected' : '' ?> value="venda">Venda</option>
            <option <?= ($row->tipo_venda == 'retirada') ? 'selected' : '' ?> value="retirada">Retirada</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Data da venda</label>
        <input type="date" value="<?php print $row->data_venda; ?>" name="data_venda" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Nome do cliente*</label>
        <input required value="<?php print $row->nome_cliente; ?>" type="text" name="nome_cliente" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Produto*</label>
        <select required class="form-select" name="id_produto">
            <?php
            $produtoAtual = $_REQUEST['idProduto'];
            $query = $conn->query("SELECT id_produto, ciclo, ano_ciclo, nome_produto, estoque_produto, empresa_produto FROM produtos WHERE id_produto = $produtoAtual OR estoque_produto > 0 ORDER BY empresa_produto, nome_produto;");
            $registros = $query->fetch_all(MYSQLI_ASSOC);
            print_r($registros);
            foreach ($registros as $item) {
            ?>
                <option <?= ($row->id_produto == $item['id_produto']) ? 'selected' : '' ?> value="<?php echo $item['id_produto'] ?>">
                    <?php echo $item['empresa_produto'] . " - " . $item['ciclo'] . "/" . $item['ano_ciclo'] . " - " . $item['nome_produto'] . " - " . $item['estoque_produto'] ?>
                </option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Quantidade*</label>
        <input required value="<?php print $row->quantidade; ?>" type="number" onkeyup="calcular()" name="quantidade" id="quantidade" class="form-control">
        <input hidden value="<?php print $row->quantidade; ?>" type="number" name="quantidadeAtual" class="form-control">
    </div>
    <label for="">Valor venda*</label>
    <div class="input-group mb-3">
        <input required type="text" value="<?php print $row->vlr_venda; ?>" id="vlr_venda" onblur="calcular()" placeholder="R$ 000.00" name="vlr_venda" class="form-control">
    </div>
    <label for="">Valor total da venda</label>
    <div class="input-group mb-3">
        <input readonly value="<?php print $row->vlr_total_venda; ?>" type="text" name="vlr_total_venda" class="form-control" id="vlr_total_venda" placeholder="R$ 000.00">
    </div>
    <div class="mb-3">
    </div>
    <div class="mb-3">
        <label for="">Forma de pagamento*</label>
        <select required class="form-select" name="forma_pagamento" aria-placeholder="Selecione uma categoria!">
            <option <?= ($row->forma_pagamento == 'dinheiro') ? 'selected' : '' ?> value="dinheiro">Dinheiro</option>
            <option <?= ($row->forma_pagamento == 'cartao-credito') ? 'selected' : '' ?> value="cartao-credito">Cartão de Crédito</option>
            <option <?= ($row->forma_pagamento == 'cartao-debito') ? 'selected' : '' ?> value="cartao-debito">Cartão de Débito</option>
            <option <?= ($row->forma_pagamento == 'pix') ? 'selected' : '' ?> value="pix">PIX</option>
            <option <?= ($row->forma_pagamento == 'shopee') ? 'selected' : '' ?> value="shopee">Shopee</option>
        </select>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input <?= ($row->pagamento == 'pago') ? 'checked' : '' ?> class="form-check-input" type="radio" name="pagamento" id="pago" value="pago">
            <label class="form-check-label" for="pago">
                Pagamento Imediato
            </label>
        </div>
        <div class="form-check">
            <input <?= ($row->pagamento == 'a pagar') ? 'checked' : '' ?> class="form-check-input" type="radio" name="pagamento" id="nao-pago" value="a pagar">
            <label class="form-check-label" for="nao-pago">
                pagamento futuro
            </label>
        </div>
    </div>
    <div class="mb-3">
        <button class="btn btn-primary">Salvar</button>
    </div>

</form>

<script>
    function calcular() {
        var vlr_venda = document.getElementById('vlr_venda').value.replace(/[^0-9]/g, '')
        vlr_venda = document.getElementById('vlr_venda').value.replace('R$', '')
        vlr_venda = parseFloat(vlr_venda)
        var quantidade = parseInt(document.getElementById('quantidade').value)
        if (vlr_venda && quantidade) {
            var vlr_total = vlr_venda * quantidade

            document.getElementById('vlr_total_venda').value = vlr_total.toLocaleString("pt-BR", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })

            document.getElementById('vlr_venda').value = vlr_venda.toLocaleString("pt-BR", {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            })
        }
    }
</script>