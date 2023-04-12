<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<!-- GRÁFICO SOBRE O TOTAL DE MENDAS MENSAL -->
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Meses', '2022', '2023'],
            <?php
            $sql = "SELECT 
                MONTH(data_venda) AS mes_venda,
                CASE WHEN MONTH(data_venda) = 1 THEN 'Jan'
                WHEN MONTH(data_venda) = 2 THEN 'Fev'
                WHEN MONTH(data_venda) = 3 THEN 'Mar'
                WHEN MONTH(data_venda) = 4 THEN 'Abr'
                WHEN MONTH(data_venda) = 5 THEN 'Mai'
                WHEN MONTH(data_venda) = 6 THEN 'Jun'
                WHEN MONTH(data_venda) = 7 THEN 'Jul'
                WHEN MONTH(data_venda) = 8 THEN 'Ago'
                WHEN MONTH(data_venda) = 9 THEN 'Set'
                WHEN MONTH(data_venda) = 10 THEN 'Out'
                WHEN MONTH(data_venda) = 11 THEN 'Nov'
                WHEN MONTH(data_venda) = 12 THEN 'Dez'
                END AS text_mes_venda,
                REPLACE(FORMAT(SUM( CASE WHEN YEAR(data_venda) = 2022 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN vlr_total_venda ELSE '' END ),2),',','') AS ano22,
                REPLACE(FORMAT(SUM( CASE WHEN YEAR(data_venda) = 2023 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN vlr_total_venda ELSE '' END ),2),',','') AS ano23
                FROM vendas GROUP BY mes_venda;";
            $buscar = $conn->query($sql);

            while ($dados = $buscar->fetch_object()) {
                $ano22 = floatval($dados->ano22);
                $ano23 = floatval($dados->ano23);
            ?>

                ['<?php echo $dados->text_mes_venda ?>', <?php echo $ano22 ?>, <?php echo $ano23 ?>],

            <?php } ?>

        ]);

        var options = {
            title: 'Total de Vendas por Período',
            curveType: 'function',
            legend: {
                position: 'bottom'
            },
            pointSize: 7,
        };

        var chart = new google.visualization.LineChart(document.getElementById('grafico_vendas'));

        chart.draw(data, options);
    }
</script>

<!-- GRÁFICO SOBRE O LUCRO MENSAL -->
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Meses', '2022', '2023'],
            <?php
            $grafico2 = "SELECT MONTH(data_venda) AS mes_venda, 
                CASE WHEN MONTH(v.data_venda) = 1 THEN 'Jan' WHEN MONTH(v.data_venda) = 2 THEN 'Fev' WHEN MONTH(v.data_venda) = 3 THEN 'Mar' WHEN MONTH(v.data_venda) = 4 THEN 'Abr' WHEN MONTH(v.data_venda) = 5 THEN 'Mai' WHEN MONTH(v.data_venda) = 6 THEN 'Jun' WHEN MONTH(v.data_venda) = 7 THEN 'Jul' WHEN MONTH(v.data_venda) = 8 THEN 'Ago' WHEN MONTH(v.data_venda) = 9 THEN 'Set' WHEN MONTH(v.data_venda) = 10 THEN 'Out' WHEN MONTH(v.data_venda) = 11 THEN 'Nov' WHEN MONTH(v.data_venda) = 12 THEN 'Dez' END AS text_mes_venda,
                REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2022 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN v.vlr_venda ELSE 0 END ),2),',','') AS vendas22,
                REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2023 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN v.vlr_venda ELSE 0 END ),2),',','') AS vendas23, 
                REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2022 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN p.vlr_compra_produto ELSE 0 END ),2),',','') AS produto22,
                REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2023 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN p.vlr_compra_produto ELSE 0 END ),2),',','') AS produto23,

                REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2022 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN v.vlr_total_venda ELSE 0 END ),2),',','') - REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2022 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN p.vlr_compra_produto ELSE 0 END ),2),',','') AS lucro22,

                REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2023 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN v.vlr_total_venda ELSE 0 END ),2),',','') - REPLACE(FORMAT(SUM( CASE WHEN YEAR(v.data_venda) = 2023 AND tipo_venda <> 'retirada' AND pagamento = 'pago' THEN p.vlr_compra_produto ELSE 0 END ),2),',','') AS lucro23
                
                from vendas as v join produtos as p where v.id_produto = p.id_produto GROUP BY mes_venda;";
            $buscar = $conn->query($grafico2);

            while ($dados = $buscar->fetch_object()) {
                $lucro22 = floatval($dados->lucro22);
                $lucro23 = floatval($dados->lucro23);
            ?>

                ['<?php echo $dados->text_mes_venda ?>', <?php echo $lucro22 ?>, <?php echo $lucro23 ?>],

            <?php } ?>

        ]);

        var options = {
            title: 'Total de Lucro por Período',
            curveType: 'function',
            legend: {
                position: 'bottom'
            },
            pointSize: 7,
        };

        var chart = new google.visualization.LineChart(document.getElementById('grafico_lucro'));

        chart.draw(data, options);
    }
</script>

<h1>@eudora_ceilandia</h1>
<div id="grafico_vendas" style="width: 100%; height: 60vh"></div>
<div id="grafico_lucro" style="width: 100%; height: 60vh"></div>