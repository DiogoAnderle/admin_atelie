<?php
require_once "../../../controllers/vendas.controller.php";
require_once "../../../models/vendas.model.php";

require_once "../../../controllers/clientes.controller.php";
require_once "../../../models/clientes.model.php";

require_once "../../../controllers/usuarios.controller.php";
require_once "../../../models/usuarios.model.php";

require_once "../../../controllers/produtos.controller.php";
require_once "../../../models/produtos.model.php";


class ImprimirFatura
{
	public $codigo;

	public function trazerImpressaoFatura()
	{

		// TRAZER A INFORMAÇÂO DA VENDA
		$itemVenda = "codigo";
		$codigoVenda = $this->codigo;

		$respostaVenda = ControllerVendas::ctrMostrarVendas($itemVenda, $codigoVenda);

		$data_venda = date('d/m/Y', strtotime($respostaVenda["data_venda"]));
		$produtos = json_decode($respostaVenda["produtos"], true);
		$subtotal = number_format($respostaVenda["subtotal"]);
		$acrescimo = number_format($respostaVenda["acrescimo"]);
		$total = number_format($respostaVenda["total"]);

		// TRAZER A INFORMAÇÂO DO CLIENTE

		$itemCliente = "id";
		$codigoCliente = $respostaVenda["cliente_id"];

		$respostaCliente = ControllerClientes::ctrMostrarClientes($itemCliente, $codigoCliente);

		// TRAZER A INFORMAÇÂO DO VENDEDOR

		$itemVendedor = "id";
		$codigoVendedor = $respostaVenda["vendedor_id"];

		$respostaVendedor = ControllerUsuarios::crtMostrarUsuarios($itemVendedor, $codigoVendedor);


		// TRAZER A INFORMAÇÂO DO VENDEDOR

		// INTANCIAR A CLASSE TCPDF
		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage();
		//-----------------------------------------------------------------//
		// Primeiro bloco
		//-----------------------------------------------------------------//
		$bloco1 = <<<EOF
					<table>
						<tr>
							<td style="width:150px">
								<span>
									<img src="images/logo-negro-bloque.png">
								</span>
							</td>
							<td style="width:240px">
								<div style = "font-size:8.5px; text-align:right; line-height:15px;">
									<br>
									CNPJ: 49.759.963/0001-00
									<br>
									Endereço: Rua Herminio Vieira, 247 Acarai São Francisco do Sul - SC
								</div>
							</td>
							<td style="background-color: #ff9900; width:140px;">
								<div style = "font-size:8px; text-align:right; line-height:15px;">
									<br>
									Whatsapp: 47 98909-0879
									<br>
									4denosatelie@gmail.com
								</div>
							</td>
							<td style="background-color: gray; width:110px; text-align:center; color:red">
								
								<br>
								<br>
									FATURA N. 
								<br>
								$codigoVenda
								</td>

						</tr>
					</table>

				EOF;

		$pdf->writeHTML($bloco1, false, false, false, false, '');
		//-----------------------------------------------------------------//
		// Segundo bloco
		//-----------------------------------------------------------------//
		$bloco2 = <<<EOF
						<table style="font-size:10px;">
							<tr>
								<td style: width:540px><img src="images/back.jpg"></td>
							</tr>
						</table>

						<table style="font-size:10px;">
							<tr>
								<td style: border: 1px solid #666; background-color:white; width:390px>
								Cliente: $respostaCliente[nome]</td>	
								<td style: border: 1px solid #666; background-color:white;text-align:right; width:390px>
								Data: $data_venda</td>
							</tr>
							<tr>
								<td style: border: 1px solid #666; background-color:white; width:390px>
								Vendedor: $respostaVendedor[nome]</td>	
								
							</tr>
						</table>
				
				EOF;

		$pdf->writeHTML($bloco2, false, false, false, false, '');
		//-----------------------------------------------------------------//
		// Terceiro bloco
		//-----------------------------------------------------------------//
		$bloco3 = <<<EOF
						<table style="font-size:10px;">
							<tr>
								<td style: width:"540px;"><img src="images/back.jpg"></td>
							</tr>
						</table>

						<table style="font-size:10px;">
							<tr>
								<td style="border: 1px solid #666;width:390px">Produto:</td>	
								<td style="border: 1px solid #666;width:390px">Quantidade:</td>
								<td style="border: 1px solid #666; width:390px">Valor Unitário</td>	
								<td style="border: 1px solid #666; width:390px">Valor Total</td>	
								
							</tr>
							<tr>
								<td style: border: 1px solid #666; background-color:white; width:540px</td>	
								
							</tr>
						</table>
				
		EOF;
		$pdf->writeHTML($bloco3, false, false, false, false, '');


		//-----------------------------------------------------------------//
		// Quarto bloco
		//-----------------------------------------------------------------//
		foreach ($produtos as $key => $item) {
			$itemProduto = "descricao";
			$valorProduto = $item["descricao"];

			$respostaProduto = ControllerProdutos::ctrMostrarProdutos($itemProduto, $valorProduto);

			$valorUnitario = number_format($item["preco"], 2, ",", ".");
			$valorTotal = number_format($item["total"], 2, ",", ".");



			$bloco4 = <<<EOF

			<table style="font-size:10px;">
							<tr>
								<td style="border: 1px solid #666;width:390px">$item[descricao]</td>	
								<td style="border: 1px solid #666;width:390px">$item[quantidade]</td>
								<td style="border: 1px solid #666; width:390px">R$ $valorUnitario</td>	
								<td style="border: 1px solid #666; width:390px">R$ $valorTotal</td>	
								
							</tr>
						</table>
						
				
		EOF;
			$pdf->writeHTML($bloco4, false, false, false, false, '');
		}

		//-----------------------------------------------------------------//
		// Quinto bloco
		//-----------------------------------------------------------------//
		$bloco5 = <<<EOF

						<table style="font-size:10px;">

							<tr>
								<td style: border: 1px solid #666; background-color:white; width:540px</td>	
								
							</tr>
						</table>
				
		EOF;
		$pdf->writeHTML($bloco5, false, false, false, false, '');



		$pdf->Output('fatura.pdf');
	}
}
$fatura = new ImprimirFatura();

$fatura->codigo = $_GET["codigo"];

$fatura->trazerImpressaoFatura();

