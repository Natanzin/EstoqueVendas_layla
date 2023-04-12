<?php

switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $ano_ciclo = $_POST['ano_ciclo'];
        $ciclo = $_POST['ciclo'];
        $nome = $_POST['nome'];
        $vlr_compra = $_POST['vlr_compra'];
        $quantidade = $_POST['quantidade'];
        $categoria = $_POST['categoria'];
        $empresa_produto = $_POST['empresa_produto'];
        $imagem_produto = $_POST['imagemProduto'];
        $preco_sugerido_produto = $_POST['vlrSugerido'];
        $produto_promo = $_POST['promo'];
        $preco_promo_produto = $_POST['vlrPromo'];
        $desc_produto = $_POST['desc_produto'];

        $sql = "INSERT INTO produtos (ciclo, ano_ciclo,nome_produto, vlr_compra_produto, estoque_produto, categoria_produto, empresa_produto, imagem_produto, preco_sugerido_produto, produto_promo, preco_promo_produto, desc_produto) 
        VALUES ('{$ciclo}','{$ano_ciclo}','{$nome}', '{$vlr_compra}', '{$quantidade}', '{$categoria}', '{$empresa_produto}', '{$imagem_produto}', '{$preco_sugerido_produto}', '{$produto_promo}', '{$preco_promo_produto}', '{$desc_produto}') ";
        $res = $conn->query($sql);

        if ($res == true) {
            if ($empresa_produto == 'eudora') {
                print "<script>alert('Produto cadastrado com sucesso!')</script>";
                print "<script>location.href='?page=novo-produto-eudora'</script>";
            } else if ($empresa_produto == 'natura') {
                print "<script>alert('Produto cadastrado com sucesso!')</script>";
                print "<script>location.href='?page=novo-produto-natura'</script>";
            } else if ($empresa_produto == 'boticario') {
                print "<script>alert('Produto cadastrado com sucesso!')</script>";
                print "<script>location.href='?page=novo-produto-boticario'</script>";
            }
        } else {
            print "<script>alert('Não foi possível cadastrar!')</script>";
            print "<script>location.href='?page=novo-produto'</script>";
        }
        break;
    case 'editar':
        $ano_ciclo = $_POST['ano_ciclo'];
        $ciclo = $_POST['ciclo'];
        $nome = $_POST['nome'];
        $vlr_compra = $_POST['vlr-compra'];
        $quantidade = $_POST['quantidade'];
        $categoria = $_POST['categoria'];
        $empresa_produto = $_POST['empresa_produto'];
        $imagem_produto = $_POST['imagemProduto'];
        $preco_sugerido_produto = $_POST['vlrSugerido'];
        $produto_promo = $_POST['promo'];
        $preco_promo_produto = $_POST['vlrPromo'];
        $desc_produto = $_POST['desc_produto'];

        $sql = "UPDATE produtos SET
            ciclo='{$ciclo}',
            ano_ciclo='{$ano_ciclo}',
            nome_produto='{$nome}',
            vlr_compra_produto='{$vlr_compra}',
            estoque_produto='{$quantidade}',
            categoria_produto='{$categoria}',
            empresa_produto='{$empresa_produto}',
            imagem_produto='{$imagem_produto}',
            preco_sugerido_produto='{$preco_sugerido_produto}',
            produto_promo='{$produto_promo}',
            preco_promo_produto='{$preco_promo_produto}',
            desc_produto='{$desc_produto}'
        WHERE 
            id_produto=" . $_REQUEST['id'];
        $res = $conn->query($sql);

        if ($res == true) {
            if ($empresa_produto == 'eudora') {
                print "<script>alert('Produto editado com sucesso!')</script>";
                print "<script>location.href='?page=listar-produto-eudora'</script>";
            } else if ($empresa_produto == 'natura') {
                print "<script>alert('Produto editado com sucesso!')</script>";
                print "<script>location.href='?page=listar-produto-natura'</script>";
            } else if ($empresa_produto == 'boticario') {
                print "<script>alert('Produto editado com sucesso!')</script>";
                print "<script>location.href='?page=listar-produto-boticario'</script>";
            }
        } else {
            print "<script>alert('Não foi possível editar!')</script>";
            print "<script>location.href='?page=listar-produto'</script>";
        }
        break;
    case 'excluir':
        $sql = "DELETE FROM produtos WHERE id_produto=" . $_REQUEST["id"];
        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Produto excluído com sucesso!')</script>";
            print "<script>location.href='?page=listar-produto'</script>";
        } else {
            print "<script>alert('Não foi possível excluir!')</script>";
            print "<script>location.href='?page=listar-prduto'</script>";
        }
        break;
}
