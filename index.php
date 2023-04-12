<!doctype html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eudora_Ceilândia</title>
    <script type="text/javascript" src="./js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="./js/jquery.mask.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Eudora</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <div class="dropdown me-3">
                            <a class="nav-link active dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Estoque
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="?page=listar-produto-eudora">Eudora</a></li>
                                <li><a class="dropdown-item" href="?page=listar-produto-natura">Natura</a></li>
                                <li><a class="dropdown-item" href="?page=listar-produto-boticario">O Boticário</a></li>
                                <li><a class="dropdown-item" href="?page=listar-produto-sem-estoque">Produtos sem estoque</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=novo-produto">Novo Produto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=nova-venda">Nova Venda</a>
                    </li>
                    <li class="nav-item">
                        <div class="dropdown me-3">
                            <a class="nav-link active dropdown-toggle" href="#" role="button" id="vendas" data-bs-toggle="dropdown" aria-expanded="false">
                                Minhas Vendas
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="?page=listar-venda-receber&pagina=0">A Receber</a></li>
                                <li><a class="dropdown-item" href="?page=listar-venda&pagina=0">Vendas</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="?page=listar-retirada">Minhas Retiradas</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <?php
                include("config.php");
                switch (@$_REQUEST["page"]) {
                    case "novo-produto":
                        include("./modules/produtos/novo-produto.php");
                        break;
                    case "listar-produto-eudora":
                        include("./modules/produtos/listar-produtos-eudora.php");
                        break;
                    case "listar-produto-natura":
                        include("./modules/produtos/listar-produtos-natura.php");
                        break;
                    case "listar-produto-boticario":
                        include("./modules/produtos/listar-produtos-boticario.php");
                        break;
                    case "listar-produto-sem-estoque":
                        include("./modules/produtos/listar-produtos-sem-estoque.php");
                        break;
                    case "salvar-produto":
                        include("./modules/produtos/salvar-produto.php");
                        break;
                    case "editar-produto":
                        include("./modules/produtos/editar-produto.php");
                        break;
                    case "nova-venda":
                        include("./modules/vendas/nova-venda.php");
                        break;
                    case "listar-venda-receber":
                        include("./modules/vendas/listar-venda-receber.php");
                        break;
                    case "listar-venda":
                        include("./modules/vendas/listar-venda.php");
                        break;
                    case "salvar-venda":
                        include("./modules/vendas/salvar-venda.php");
                        break;
                    case "editar-venda":
                        include("./modules/vendas/editar-venda.php");
                        break;
                    case "listar-retirada":
                        include("./modules/retiradas/listar-retirada.php");
                        break;
                    default:
                        include('./dashboard/index.php');
                        break;
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>
<script type="text/javascript">
    $("#vlr_compra").mask("9990.00", {
        reverse: true
    })
    $("#vlr_venda").mask("9990.00", {
        reverse: true
    })
    $("#vlr_promo").mask("9990.00", {
        reverse: true
    })
</script>