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
		$subtotal = number_format($respostaVenda["subtotal"], 2, ",", ".");
		$acrescimo = number_format($respostaVenda["acrescimo"], 2, ",", ".");
		$total = number_format($respostaVenda["total"], 2, ",", ".");

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
						<br>
							<td>
								4 de Nós Ateliê
								<br>
								Endereço: Rua Herminio Vieira, 247 
								<br>
								Acarai, São Francisco do Sul - SC
								<br>
							</td>

							<td>
								CNPJ: 49.759.963/0001-00
								<br>
								Email: 4denosatelie@gmail.com
								<br>
								Whatsapp: 47 98909-0879
							</td>
													

						</tr>
						<tr>
							<td>
									FATURA: $codigoVenda
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
							<br>
								<td style: border: 1px solid #666; background-color:white; width:390px>
								Cliente: $respostaCliente[nome]</td>
								<td></td>	
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
							<br>
								<td style="border: 1px solid #000;width:390px">Produto:</td>	
								<td style="border: 1px solid #000;width:390px">Quantidade:</td>
								<td style="border: 1px solid #000; width:390px">Valor Unitário</td>	
								<td style="border: 1px solid #000; width:390px">Valor Total</td>	
								
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
			$ordem = "id";

			$respostaProduto = ControllerProdutos::ctrMostrarProdutos($itemProduto, $valorProduto, $ordem);

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
							<tr>
								<td></td>
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
								<td></td>
								<td></td>
								<td>Subtotal:</td>
								<td>R$ $subtotal</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>Acresc/Desc:</td>
								<td>R$ $acrescimo</td>
							</tr>
							<tr>
								<td></td>
								<td></td>
								<td>Total:</td>
								<td>R$ $total</td>
							</tr>
				
EOF;
		$pdf->writeHTML($bloco5, false, false, false, false, '');



		$pdf->Output('fatura.pdf');
	}
}
$fatura = new ImprimirFatura();

$fatura->codigo = $_GET["codigo"];

$fatura->trazerImpressaoFatura();

