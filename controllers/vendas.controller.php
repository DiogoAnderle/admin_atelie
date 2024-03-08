<?php

class ControllerVendas
{

    /***********************************************
     * MOSTRAR VENDAS
     ***********************************************/
    public static function ctrMostrarVendas($item, $valor)
    {
        $tabela = "vendas";
        $resposta = ModeloVendas::mdlMostrarVendas($tabela, $item, $valor);

        return $resposta;
    }

    /***********************************************
     * CRIAR VENDAS
     ***********************************************/

    public static function ctrCriarVenda()
    {

        if (isset($_POST["novoCodigo"])) {
            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/
            $listaProdutos = json_decode($_POST["listaProdutos"], true);

            $totalProdutosComprados = array();

            foreach ($listaProdutos as $key => $value) {

                array_push($totalProdutosComprados, $value["quantidade"]);

                $tabelaProdutos = "produtos";
                $item = "id";
                $valor = $value["id"];

                $ordem = 'codigo';

                $trazerProduto = ModelProdutos::mdlMostrarProdutos($tabelaProdutos, $item, $valor, $ordem);

                $item1a = "vendas";
                $valor1a = $value["quantidade"] + $trazerProduto["vendas"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $valor);

                $item1b = "estoque";
                $valor1b = $value["estoque"];

                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $valor);

            }

            $tabelaClientes = 'clientes';

            $item = "id";
            $valorCliente = $_POST["selecionarCliente"];

            $trazerCliente = ModeloClientes::mdlMostrarClientes($tabelaClientes, $item, $valorCliente);

            $item1a = "compras";
            $valor1a = array_sum($totalProdutosComprados) + $trazerCliente["compras"];

            $item1b = "ultima_compra";
            date_default_timezone_set("America/Sao_Paulo");

            $data = date('Y-m-d');
            $hora = date('H:i:s');
            $valor1b = $data . ' ' . $hora;


            ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1a, $valor1a, $valorCliente);
            ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1b, $valor1b, $valorCliente);

            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/
            $tabela = "vendas";

            $dados = array(
                "codigo" => $_POST["novoCodigo"],
                "cliente_id" => $_POST["selecionarCliente"],
                "vendedor_id" => $_POST["idVendedor"],
                "produtos" => $_POST["listaProdutos"],
                "acrescimo" => $_POST["novoValorAcrescimo"],
                "subtotal" => $_POST["novoValorSemAcrescimo"],
                "total" => $_POST["totalVenda"],
            );

            $resposta = ModeloVendas::mdlCriarVenda($tabela, $dados);

            if ($resposta == "ok") {
                echo "<script>

                Swal.fire({
                        icon: 'success',
                        title: 'Venda cadastrada com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'vendas';}
                    });
            
                </script>";
            }
        }

    }


    /***********************************************
     * EDITAR VENDAS
     ***********************************************/
    public static function ctrEditarVenda()
    {

        if (isset($_POST["editarCodigo"])) {

            /***********************************************
             * FORMATAR TABELA DE PRODUTOS E CLIENTES
             ***********************************************/
            $tabela = "vendas";
            $item = "codigo";
            $valorCodigo = $_POST["editarCodigo"];

            $trazerVenda = ModeloVendas::mdlMostrarVendas($tabela, $item, $valorCodigo);

            /***********************************************
             * CHECAR SE ESTÁ VINDOPRODUTOS EDITADOS
             ***********************************************/
            $alteracaoProduto = false;

            if ($_POST["listaProdutos"] == "") {

                $listaProdutos = $trazerVenda["produtos"];
                $alteracaoProduto = false;

            } else {
                $listaProdutos = $_POST["listaProdutos"];
                $alteracaoProduto = true;
            }
            if ($alteracaoProduto) {

                $produtos = json_decode($trazerVenda["produtos"], true);

                $totalProdutosComprados = array();

                foreach ($produtos as $key => $value) {

                    array_push($totalProdutosComprados, $value["quantidade"]);

                    $tabelaProdutos = "produtos";
                    $item = "id";
                    $idProduto = $value["id"];

                    $trazerProduto = ModelProdutos::mdlMostrarProdutos($tabelaProdutos, $item, $idProduto);

                    //Reverter a quantidade de itens vendidos antes  
                    // de salvar novamente no banco após a edição
                    $item1a = "vendas";

                    $valor1a = $trazerProduto["vendas"] - $value["quantidade"];


                    ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $idProduto);

                    //Reverter a quantidade de itens no estoque antes  
                    // de salvar novamente no banco após a edição
                    $item1b = "estoque";
                    $valor1b = $value["quantidade"] + $trazerProduto["estoque"];


                    ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $idProduto);

                }
                //Reverter a quantidade comprada pelo cliente antes  
                // de salvar novamente no banco após a edição
                $tabelaClientes = 'clientes';

                $itemCliente = "id";
                $idCliente = $_POST["selecionarCliente"];

                $trazerCliente = ModeloClientes::mdlMostrarClientes($tabelaClientes, $itemCliente, $idCliente);

                $item1a = "compras";

                $valor1a = $trazerCliente["compras"] - array_sum($totalProdutosComprados);

                ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1a, $valor1a, $idCliente);

                /***********************************************
                 * Atualizar as vendas do cliente, reduzir o estoque
                 * do produto e aumentar a venda dos produtos
                 ***********************************************/
                $listaProdutos_2 = json_decode($listaProdutos, true);

                $totalProdutosComprados_2 = array();

                foreach ($listaProdutos_2 as $key => $value) {

                    array_push($totalProdutosComprados_2, $value["quantidade"]);

                    $tabelaProdutos_2 = "produtos";

                    $item_2 = "id";
                    $idProduto = $value["id"];

                    $trazerProduto_2 = ModelProdutos::mdlMostrarProdutos($tabelaProdutos_2, $item_2, $idProduto);

                    $item1a_2 = "vendas";
                    $valor1a_2 = $value["quantidade"] + $trazerProduto_2["vendas"];

                    ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a_2, $valor1a_2, $idProduto);

                    $item1b_2 = "estoque";
                    $valor1b_2 = $value["estoque"];

                    ModelProdutos::mdlAtualizarProduto($tabelaProdutos_2, $item1b_2, $valor1b_2, $idProduto);

                }

                $tabelaClientes_2 = 'clientes';

                $item_2 = "id";
                $idCliente = $_POST["selecionarCliente"];

                $trazerCliente_2 = ModeloClientes::mdlMostrarClientes($tabelaClientes_2, $item_2, $idCliente);

                $item1a_2 = "compras";
                $valor1a_2 = array_sum($totalProdutosComprados_2) + $trazerCliente_2["compras"];
                ModeloClientes::mdlAtualizarCliente($tabelaClientes_2, $item1a_2, $valor1a_2, $idCliente);

                $item1b_2 = "ultima_compra";
                date_default_timezone_set("America/Sao_Paulo");

                $data_2 = date('Y-m-d');
                $hora_2 = date('H:i:s');
                $valor1b_2 = $data_2 . ' ' . $hora_2;

                ModeloClientes::mdlAtualizarCliente($tabelaClientes_2, $item1b_2, $valor1b_2, $idCliente);
            }



            /***********************************************
             * Atualizar as vendas do cliente, reduzir o estoque
             * do produto e aumentar a venda dos produtos
             ***********************************************/


            $dados = array(
                "codigo" => $_POST["editarCodigo"],
                "cliente_id" => $_POST["selecionarCliente"],
                "vendedor_id" => $_POST["idVendedor"],
                "produtos" => $listaProdutos,
                "acrescimo" => $_POST["novoValorAcrescimo"],
                "subtotal" => $_POST["novoValorSemAcrescimo"],
                "total" => $_POST["totalVenda"],
            );

            $resposta = ModeloVendas::mdlEditarVenda($tabela, $dados);

            if ($resposta == "ok") {
                echo "<script>

                Swal.fire({
                        icon: 'success',
                        title: 'Venda atualizada com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'vendas';}
                    });

                </script>";
            }
        }

    }

    /***********************************************
     * EXCLUIR VENDAS
     ***********************************************/

    public static function ctrExcluirVenda()
    {
        if (isset($_GET["idVenda"])) {

            $tabela = "vendas";
            $item = "id";
            $valor = $_GET["idVenda"];

            $trazerVenda = ModeloVendas::mdlMostrarVendas($tabela, $item, $valor);
            $guardarDatas = array();

            /***********************************************
             * ATUALIZAR DATA ULTIMA COMPRA
             ***********************************************/

            $tabelaClientes = "clientes";

            $itemVendas = null;
            $valorVendas = null;

            $trazerVendas = ModeloVendas::mdlMostrarVendas($tabela, $itemVendas, $valorVendas);

            foreach ($trazerVendas as $key => $vendas) {
                if ($vendas["cliente_id"] == $trazerVenda["cliente_id"]) {
                    array_push($guardarDatas, $vendas["data_venda"]);

                }
            }
            if (count($guardarDatas) > 1) {
                if ($vendas["data_venda"] > $guardarDatas[count($guardarDatas) - 2]) {
                    $itemCliente = "ultima_compra";
                    $valorCliente = $guardarDatas[count($guardarDatas) - 2];
                    $idCliente = $trazerVenda["cliente_id"];
                    ModeloClientes::mdlAtualizarCliente($tabelaClientes, $itemCliente, $valorCliente, $idCliente);

                } else {
                    $itemCliente = "ultima_compra";
                    $valorCliente = $guardarDatas[count($guardarDatas) - 1];
                    $idCliente = $trazerVenda["cliente_id"];
                    ModeloClientes::mdlAtualizarCliente($tabelaClientes, $itemCliente, $valorCliente, $idCliente);

                }

            } else {
                $itemCliente = "ultima_compra";
                $valorCliente = "1970-01-01 00:00:00";
                $idCliente = $trazerVenda["cliente_id"];

                ModeloClientes::mdlAtualizarCliente($tabelaClientes, $itemCliente, $valorCliente, $idCliente);
            }

            /***********************************************
             * ATUALIZAR ESTOQUE PRODUTO E COMPRAS CLIENTE
             ***********************************************/

            $produtos = json_decode($trazerVenda["produtos"], true);

            $totalProdutosComprados = array();

            foreach ($produtos as $key => $value) {

                array_push($totalProdutosComprados, $value["quantidade"]);

                $tabelaProdutos = "produtos";
                $item = "id";
                $idProduto = $value["id"];

                $trazerProduto = ModelProdutos::mdlMostrarProdutos($tabelaProdutos, $item, $idProduto);

                //Reverter a quantidade de itens vendidos antes  
                // de salvar novamente no banco após a edição
                $item1a = "vendas";

                $valor1a = $trazerProduto["vendas"] - $value["quantidade"];


                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1a, $valor1a, $idProduto);

                //Reverter a quantidade de itens no estoque antes  
                // de salvar novamente no banco após a edição
                $item1b = "estoque";
                $valor1b = $value["quantidade"] + $trazerProduto["estoque"];


                ModelProdutos::mdlAtualizarProduto($tabelaProdutos, $item1b, $valor1b, $idProduto);

            }
            //Reverter a quantidade comprada pelo cliente antes  
            // de salvar novamente no banco após a edição
            $tabelaClientes = 'clientes';

            $itemCliente = "id";
            $idCliente = $trazerVenda["cliente_id"];

            $trazerCliente = ModeloClientes::mdlMostrarClientes($tabelaClientes, $itemCliente, $idCliente);

            $item1a = "compras";

            $valor1a = $trazerCliente["compras"] - array_sum($totalProdutosComprados);

            ModeloClientes::mdlAtualizarCliente($tabelaClientes, $item1a, $valor1a, $idCliente);

            /***********************************************
             * EXCLUIR VENDA
             ***********************************************/

            $resposta = ModeloVendas::mdlExcluirVenda($tabela, $_GET["idVenda"]);

            if ($resposta == "ok") {
                echo "<script>

                Swal.fire({
                        icon: 'success',
                        title: 'Venda excluída com sucesso!',
                        confirmButtonText: 'Fechar',

                    }).then((result) => {
                        if(result.value){
                            window.location = 'vendas';}
                    });

                </script>";
            }
        }
    }

    /***********************************************
     * SOMAR TOTAL DE VENDAS
     ***********************************************/

    public static function ctrSomaTotaldeVendas()
    {
        $tabela = 'vendas';

        $resposta = ModeloVendas::mdlSomaTotaldeVendas($tabela);

        return $resposta;
    }

    /***********************************************
     * VENDAS POR PERÍODO
     ***********************************************/
    static public function ctrPeriodoDatasVendas($dataInicial, $dataFinal)
    {
        $tabela = "vendas";

        $resposta = ModeloVendas::mdlPeriodoDatasVendas($tabela, $dataInicial, $dataFinal);
        return $resposta;
    }

    /***********************************************
     * BAIXAR RELATORIO EM EXCEL
     ***********************************************/
    public function ctrBaixarRelatorio()
    {
        if (isset($_GET["relatorio"])) {

            $tabela = "vendas";

            if (isset($_GET["dataInicial"]) && isset($_GET["dataInicial"])) {
                $vendas = ModeloVendas::mdlPeriodoDatasVendas($tabela, $_GET["dataInicial"], $_GET["dataFinal"]);


            } else {
                $item = null;
                $valor = null;
                $vendas = ModeloVendas::mdlMostrarVendas($tabela, $item, $valor);
            }

            /***********************************************
             * Criar o arquivo em Excel
             ***********************************************/

            $Name = $_GET["relatorio"];

            header('Expires:0');
            header('Cache-Control: private');
            header("Content-Type: application/vnd.ms-excel");
            header('Cache-Control: cache, must-revalidate');
            header('Content-Description: File Transfer');
            header('Last-Modified:' . date('D, d M Y H:i:s'));
            header('Pragma: Public');
            header('Content-Disposition:; filename="' . $Name . '.xls"');
            header('Content-Transfer-Encoding: binary');

            echo mb_convert_encoding(
                "<table border=1>
                    <tr>
                        <td style='font-weight:bold; border: 1px solid #000;'>CÓDIGO</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>CLIENTE</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>VENDEDOR</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>QUANTIDADE</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>PRODUTOS</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>SUBTOTAL</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>ACRESC/DESC</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>TOTAL</td>
                        <td style='font-weight:bold; border: 1px solid #000;'>DATA</td>
                    </tr>",
                "ISO8859-1"
            );


            foreach ($vendas as $row => $item) {

                $cliente = ControllerClientes::ctrMostrarClientes("id", $item["cliente_id"]);
                $vendedor = ControllerUsuarios::crtMostrarUsuarios("id", $item["vendedor_id"]);

                echo mb_convert_encoding(
                    "<tr>
                    <td style='font-weight:bold; border: 1px solid #000;'>" . $item["codigo"] . "</td>
                    <td style='font-weight:bold; border: 1px solid #000;'>" . $cliente["nome"] . "</td>
                    <td style='font-weight:bold; border: 1px solid #000;'>" . $vendedor["nome"] . "</td>
                    <td style='font-weight:bold; border: 1px solid #000;'>",
                    "ISO8859-1"
                );

                $produtos = json_decode($item["produtos"], true);

                foreach ($produtos as $key => $valueProdutos) {
                    echo mb_convert_encoding($valueProdutos["quantidade"] . "<br>", "ISO8859-1");
                }

                echo mb_convert_encoding("</td><td style='font-weight:bold; border: 1px solid #000;'>", "ISO8859-1");

                foreach ($produtos as $key => $valueProdutos) {
                    echo mb_convert_encoding($valueProdutos["descricao"] . "<br>", "ISO8859-1");
                }
                echo mb_convert_encoding("</td>
                <td style='font-weight:bold; border: 1px solid #000;'>R$ " . number_format($item["subtotal"], 2, ",", ".") . "</td>
                <td style='font-weight:bold; border: 1px solid #000;'>R$ " . number_format($item["acrescimo"], 2, ",", ".") . "</td>
                <td style='font-weight:bold; border: 1px solid #000;'>R$ " . number_format($item["total"], 2, ",", ".") . "</td>
                <td style='font-weight:bold; border: 1px solid #000;'>" . substr($item["data_venda"], 0, 10) . "</td>
                </tr>", "ISO8859-1");
            }

            $totalVendas = ControllerVendas::ctrSomaTotaldeVendas();

            echo "<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style='font-weight:bold; border: 1px solid #000;'>Total Vendas</td>
                    <td></td>
                    <td></td>
                    <td style='font-weight:bold; border: 1px solid #000;'>" . number_format($totalVendas["total"], 2, ",", ".") . "</td>
            </tr>";
            echo "</table>";
        }
    }
}
