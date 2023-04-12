<?php

require '../../vendor/autoload.php';

include("../../config.php");

$sql = "SELECT * FROM produtos WHERE empresa_produto = 'natura' AND estoque_produto >= 1 ORDER BY categoria_produto, nome_produto";
$res = $conn->query($sql);
$html = "";

while ($row = $res->fetch_object()) {
    $html .= "<tr><td>" . $row->ciclo . "/" . $row->ano_ciclo . "</td><td>" . $row->nome_produto . "</td><td style='text-align:center'>" . $row->estoque_produto . "</td></tr>";
}

use Dompdf\Dompdf;

$dompdf = new Dompdf();

$dompdf->loadHtml(
    '@eudora_ceilandia <h1>ESTOQUE NATURA</h1> <hr> 
        <table border="1" style="width: 100%">
        <tr>
            <th>Ciclo</th>
            <th>Produto</th>
            <th>Estoque</th>
        </tr>' . $html . '</table>'
);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('Natura - ' . date('d-m-Y'));

header("location: ../../index.php?page=listar-produto-natura");
