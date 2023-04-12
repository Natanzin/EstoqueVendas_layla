<h1>Cadastro de produtos</h1>
<form action="?page=salvar-produto" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="acao" value="cadastrar">

    <label class="form-label" for="">Empresa*</label>
    <div class="mb-3">
        <div class="form-check form-check-inline">
            <input checked class="form-check-input" type="radio" name="empresa_produto" id="eudora" value="eudora">
            <label class="form-label" class="form-check-label" for="eudora">Eudora</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="empresa_produto" id="natura" value="natura">
            <label class="form-label" class="form-check-label" for="natura">Natura</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="empresa_produto" id="oboticario" value="boticario">
            <label class="form-label" class="form-check-label" for="oboticario">O Boticário</label>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="">Ciclo*</label>
                <select required class="form-select" name="ciclo">
                    <?php
                    $ciclo = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20];
                    foreach ($ciclo as $key => $item) {
                    ?>
                        <option value="<?php echo $ciclo[$key] ?>"><?php echo $ciclo[$key] ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="">Ano*</label>
                <select required class="form-select" name="ano_ciclo">
                    <?php
                    $ano = ["2021", "2022", "2023", "2024", "2025", "2026", "2027", "2028", "2029", "2030"];
                    foreach ($ano as $key => $item) {
                    ?>
                        <option value="<?php echo $ano[$key] ?>"><?php echo $ano[$key] ?></option>
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
                <label class="form-label" for="">Nome*</label>
                <input required type="text" name="nome" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="">Categoria*</label>
                <select required class="form-select" name="categoria" aria-placeholder="Selecione uma categoria!">
                    <option value="">Selecione uma categoria!</option>
                    <option value="cabelo">Cabelo</option>
                    <option value="skincare">Skincare</option>
                    <option value="pele">Pele</option>
                    <option value="makeup">Makeup</option>
                    <option value="perfume">Perfume</option>
                    <option value="acessorios">Acessórios</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <label class="form-label" for="">Valor Compra*</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">R$</span>
                <input required type="text" name="vlr_compra" id="vlr_compra" placeholder="Insira o valor de compra" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="">Quantidade*</label>
                <input required type="number" name="quantidade" class="form-control" placeholder="Insira a quantidade do produto em estoque!">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <label class="form-label" for="">Valor de Venda*</label>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">R$</span>
                <input required type="text" name="vlrSugerido" id="vlr_venda" placeholder="Insira o valor de venda" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="form-check form-switch">
                <label class="form-label" class="form-check-label" for="promo">Produto em promoção</label>
                <input class="form-check-input" type="checkbox" name="promo" id="promo" value="1">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">R$</span>
                <input type="text" name="vlrPromo" id="vlr_promo" placeholder="Insira o valor de promoção" class="form-control">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label class="form-label" for="">Imagem*</label>
                <input type="url" required id="imgProduto" onblur="apresentaImagem()" name="imagemProduto" placeholder="Insira o link da imagem do produto aqui!" class="form-control">
            </div>
        </div>
        <div class="col">
            <div class="mb-3">
                <img src="" class="border" id="imgPreview" height="80px" alt="">
            </div>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="">Descrição do Produto*</label>
        <input required type="text" name="desc_produto" class="form-control">
    </div>
    <div class="mb-3">
        <button class="btn btn-primary">Salvar</button>
    </div>

</form>

<script>
    //função que mostra a imagem a ser salva no banco de dados 
    function apresentaImagem() {
        var url = document.getElementById('imgProduto').value
        document.getElementById('imgPreview').src = url
    }
</script>