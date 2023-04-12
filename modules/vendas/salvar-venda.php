<?php

switch ($_REQUEST["acao"]) {
    case 'cadastrar':
        $tipo_venda = $_POST['tipo_venda'];
        $data_venda = $_POST['data_venda'];
        $nome_cliente = $_POST['nome_cliente'];
        $id_produto = $_POST['id_produto'];
        $vlr_venda = str_replace(',', '.', $_POST['vlr_venda']);
        $vlr_total_venda = str_replace(',', '.', $_POST['vlr_total_venda']);
        $quantidade = $_POST['quantidade'];
        $forma_pagamento = $_POST['forma_pagamento'];
        $pagamento = $_POST['pagamento'];

        $sql = "INSERT INTO vendas (tipo_venda, id_produto, vlr_venda, vlr_total_venda, data_venda, nome_cliente, forma_pagamento, pagamento, quantidade) 
                        VALUES ('{$tipo_venda}','{$id_produto}', '{$vlr_venda}','{$vlr_total_venda}', '{$data_venda}', '{$nome_cliente}', '{$forma_pagamento}', '{$pagamento}', '{$quantidade}') ";
        $res = $conn->query($sql);

        $sql2 = "UPDATE produtos SET
        estoque_produto = estoque_produto - '{$quantidade}'
    WHERE 
        id_produto='{$id_produto}'";
        $res2 = $conn->query($sql2);

        if ($res == true) {
            print "<script>alert('Venda cadastrada com sucesso!')</script>";
            print "<script>location.href='?page=nova-venda'</script>";
        } else {
            print "<script>alert('Não foi possível vender!')</script>";
            print "<script>location.href='?page=nova-venda'</script>";
        }
        break;

        //editar venda
    case 'editar':
        $tipo_venda = $_POST['tipo_venda'];
        $data_venda = $_POST['data_venda'];
        $nome_cliente = $_POST['nome_cliente'];
        $id_produto = $_POST['id_produto'];
        $vlr_venda = str_replace(',', '.', $_POST['vlr_venda']);
        $vlr_total_venda = str_replace(',', '.', $_POST['vlr_total_venda']);
        $forma_pagamento = $_POST['forma_pagamento'];
        $pagamento = $_POST['pagamento'];
        $quantidade = $_POST['quantidade'];
        $quantidadeAtual = $_POST['quantidadeAtual'];

        //sql - edita a venda
        $sql =
            "UPDATE vendas SET
            tipo_venda='{$tipo_venda}',
            id_produto='{$id_produto}',
            vlr_venda='{$vlr_venda}',
            vlr_total_venda='{$vlr_total_venda}',
            data_venda='{$data_venda}',
            nome_cliente='{$nome_cliente}',
            forma_pagamento='{$forma_pagamento}',
            pagamento='{$pagamento}',
            quantidade='{$quantidade}'
        WHERE 
            id_venda=" . $_REQUEST['id'];
        $res = $conn->query($sql);

        $qtdSubtrair = $quantidade - $quantidadeAtual;

        //atualiza o estoque do produto 
        $sql2 = "UPDATE produtos SET
        estoque_produto = estoque_produto - '{$qtdSubtrair}'
    WHERE 
        id_produto='{$id_produto}'";
        $res2 = $conn->query($sql2);

        if ($res == true) {
            print "<script>alert('Venda editada com sucesso!')</script>";
            print "<script>location.href='?page=listar-venda&pagina=0'</script>";
        } else {
            print "<script>alert('Não foi possível editar!')</script>";
            print "<script>location.href='?page=listar-venda&pagina=0'</script>";
        }
        break;

        //receber pagamento
    case 'receber':
        $id_venda = $_REQUEST['id'];

        //sql - edita a venda
        $sql =
            "UPDATE vendas SET
            pagamento = 'pago'
        WHERE id_venda  = " . $_REQUEST['id'];
        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Pagamento recebido com sucesso!')</script>";
            print "<script>location.href='?page=listar-venda'</script>";
        } else {
            print "<script>alert('Não foi possível receber pagamento!')</script>";
            print "<script>location.href='?page=listar-venda'</script>";
        }
        break;

    case 'excluir':

        $qtd = $_REQUEST["qtd"];
        $sql2 = "UPDATE produtos SET estoque_produto = estoque_produto + " . $qtd . " WHERE id_produto = " . $_REQUEST["idProduto"];
        $res2 = $conn->query($sql2);

        $sql = "DELETE FROM vendas WHERE id_venda = " . $_REQUEST["id"];
        $res = $conn->query($sql);

        if ($res == true) {
            print "<script>alert('Venda excluído com sucesso!')</script>";
            print "<script>location.href='?page=listar-venda'</script>";
        } else {
            print "<script>alert('Não foi possível excluir!')</script>";
            print "<script>location.href='?page=listar-venda'</script>";
        }
        break;
}
