<h1>Nova Venda</h1>
<form action="?page=salvar-venda" method="POST">
    <input type="hidden" name="acao" value="cadastrar">
    <div class="mb-3">
        <label for="">Tipo de Venda*</label>
        <select name="tipo_venda" id="tipo_venda" class="form-select">
            <option value="venda">Venda</option>
            <option value="retirada">Retirada</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Data da venda</label>
        <input autofocus required type="date" name="data_venda" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Nome do cliente*</label>
        <input required type="text" name="nome_cliente" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Produto*</label>
        <select required class="form-select" name="id_produto">
            <?php
            $query = $conn->query("SELECT id_produto, ciclo, ano_ciclo, nome_produto, estoque_produto, empresa_produto FROM produtos WHERE estoque_produto > 0 ORDER BY empresa_produto, nome_produto;");
            $registros = $query->fetch_all(MYSQLI_ASSOC);

            foreach ($registros as $item) {
            ?>
                <option value="<?php echo $item['id_produto'] ?>"><?php echo $item['empresa_produto'] . " - " . $item['ciclo'] . "/" . $item['ano_ciclo'] . " - " . $item['nome_produto'] . " - " . $item['estoque_produto'] ?></option>
            <?php
            }
            ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="">Quantidade*</label>
        <input required value="1" type="number" name="quantidade" id="quantidade" onkeyup="calcular()" class="form-control">
    </div>
    <div class="mb-3">
        <label for="">Valor venda*</label>
        <input required type="text" name="vlr_venda" class="form-control" id="vlr_venda" onchange="calcular()" placeholder="R$ 000.00">
    </div>
    <div class="mb-3">
        <label for="">Valor total da venda</label>
        <input readonly type="text" name="vlr_total_venda" class="form-control" id="vlr_total_venda" placeholder="R$ 000.00">
    </div>
    <div class="mb-3">
        <label for="">Forma de pagamento*</label>
        <select required class="form-select" name="forma_pagamento" aria-placeholder="Selecione uma categoria!">
            <option value="dinheiro">Dinheiro</option>
            <option value="cartao-credito">Cartão de Crédito</option>
            <option value="cartao-debito">Cartão de Débito</option>
            <option value="pix">PIX</option>
            <option value="shopee">Shopee</option>
        </select>
    </div>
    <div class="mb-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="pagamento" id="pago" value="pago" checked>
            <label class="form-check-label" for="pago">
                Pagamento Imediato
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="pagamento" id="nao-pago" value="a pagar">
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