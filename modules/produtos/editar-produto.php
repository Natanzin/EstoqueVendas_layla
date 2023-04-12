<h1>Editar Produto</h1>

<?php

$sql = "SELECT * FROM produtos WHERE id_produto=" . $_REQUEST['id'];
$res = $conn->query($sql);
$row = $res->fetch_object();

?>

<form action="?page=salvar-produto" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id" value="<?php print $row->id_produto; ?>">

    <label for="">Empresa*</label>
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input <?= ($row->empresa_produto == 'eudora') ? 'checked' : '' ?> class="form-check-input" type="radio" name="empresa_produto" id="eudora" value="eudora">
            <label class="form-check-label" for="eudora">Eudora</label>
        </div>
        <div class="form-check form-check-inline">
            <input <?= ($row->empresa_produto == 'natura') ? 'checked' : '' ?> class="form-check-input" type="radio" name="empresa_produto" id="natura" value="natura">
            <label class="form-check-label" for="natura">Natura</label>
        </div>
        <div class="form-check form-check-inline">
            <input <?= ($row->empresa_produto == 'boticario') ? 'checked' : '' ?> class="form-check-input" type="radio" name="empresa_produto" id="oboticario" value="boticario">
            <label class="form-check-label" for="oboticario">O Boticário</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="">Ciclo*</label>
                <select required class="form-select" name="ciclo">
                    <?php
                    $ciclo = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
                    foreach ($ciclo as $key => $item) {
                    ?>
                        <option <?= ($row->ciclo == $ciclo[$key]) ? 'selected' : '' ?> value="<?php echo $ciclo[$key] ?>"><?php echo $ciclo[$key] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="">Ano*</label>
                <select required class="form-select" name="ano_ciclo">
                    <?php
                    $ano = ["2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030"];
                    foreach ($ano as $key => $item) {
                    ?>
                        <option <?= ($row->ano_ciclo == $ano[$key]) ? 'selected' : '' ?> value="<?php echo $ano[$key] ?>"><?php echo $ano[$key] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="">Nome*</label>
                <input required type="text" name="nome" value="<?php print $row->nome_produto; ?>" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="">Categoria*</label>
                <select required class="form-select" name="categoria" aria-placeholder="Selecione uma categoria!">
                    <option <?= ($row->categoria_produto == 'cabelo') ? 'selected' : '' ?> value="cabelo">Cabelo</option>
                    <option <?= ($row->categoria_produto == 'skincare') ? 'selected' : '' ?> value="skincare">Skincare</option>
                    <option <?= ($row->categoria_produto == 'pele') ? 'selected' : '' ?> value="pele">Pele</option>
                    <option <?= ($row->categoria_produto == 'makeup') ? 'selected' : '' ?> value="makeup">Makeup</option>
                    <option <?= ($row->categoria_produto == 'perfume') ? 'selected' : '' ?> value="perfume">Perfume</option>
                    <option <?= ($row->categoria_produto == 'acessorios') ? 'selected' : '' ?> value="acessorios">Acessórios</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label for="">Valor Compra*</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">R$</span>
                <input required value="<?php print $row->vlr_compra_produto; ?>" type="text" id="vlr_compra" placeholder="000.00" name="vlr-compra" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label for="">Quantidade*</label>
                <input required value="<?php print $row->estoque_produto; ?>" type="number" name="quantidade" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="form-label" for="">Valor de Venda*</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">R$</span>
                <input required type="text" name="vlrSugerido" id="vlr_venda" placeholder="Insira o valor de venda" class="form-control" value="<?php print $row->preco_sugerido_produto; ?>">
            </div>
        </div>
        <div class="col">
            <div class="form-check form-switch">
                <label class="form-label" class="form-check-label" for="promo">Produto em promoção</label>
                <input class="form-check-input" type="checkbox" name="promo" id="promo" <?= ($row->produto_promo == 1) ? 'checked' : '' ?> value="1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">R$</span>
                <input type="text" name="vlrPromo" id="vlr_promo" placeholder="Insira o valor de promoção" class="form-control" value="<?php print $row->preco_promo_produto; ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="">Imagem*</label>
                <input type="url" required id="imgProduto" onblur="apresentaImagem()" value="<?php print $row->imagem_produto; ?>" name="imagemProduto" placeholder="Insira o link da imagem do produto aqui!" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <img src="<?php print $row->imagem_produto; ?>" id="imgPreview" class="border" height="80px" alt="">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="">Descrição do Produto*</label>
        <input required type="text" name="desc_produto" class="form-control" value="<?php print $row->desc_produto; ?>">
    </div>

    <div class="mb-3">
        <button class="btn btn-primary">Salvar</button>
    </div>

</form>

<script>
    function apresentaImagem() {
        var url = document.getElementById('imgProduto').value

        document.getElementById('imgPreview').src = url


    }
</script>