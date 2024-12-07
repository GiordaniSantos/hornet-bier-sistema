<?php
use App\Enums\StatusOrdemServico;

$dataSaida = 'Previsão de Saída';
if($ordemServico->status == StatusOrdemServico::Fechado->value || date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) < date('d/m/Y')){
    $dataSaida = 'Data de Saída';
}
if($ordemServico->data_saida && date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) >= date('d/m/Y')){
    $dataSaida = 'Previsão de Saída';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Relatório Atendimento Técnico: {{ $ordemServico->numero }}</title>
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }

            td, th {
                border: 1px solid #000000;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even) {
                background-color: #dddddd;
            }

            img {
                width: 150px;
                height: auto;
                text-align: center;
                
                display: inline-block;
            }
        </style>
    </head>
    <body>
        <table>
            <tr>
                <td style="text-align: center; width: 200px;"><img src="https://hornetbier.com.br/images/nova-logo.png" alt="Hornet Bier Logo"></td>
                <td style="text-align: center;">
                    <h3>RELATÓRIO ATENDIMENTO TÉCNICO</h3>
                    Hornetbier Manutenção de Chopeiras, Vendas e Projetos<br>
                    CNPJ 50.934.088 / 0001-97<br>
                    Sapucaia do Sul, Bairro Vargas. CEP. 93219-070<br>
                    Fone: (51) 99944-6655<br>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td colspan="2"><strong>Cliente:</strong> {{ $ordemServico->cliente->nome }}</td>
                <td colspan="2"><strong>CNPJ/CPF:</strong> {{ $ordemServico->cliente->cpf_cnpj }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Cidade:</strong> {{ $ordemServico->cliente->cidade }}</td>
                <td colspan="2"><strong>Número de OS:</strong> {{ $ordemServico->numero }}</td>
            </tr>
            <tr>
                <td><strong>MARCA:</strong> {{ $ordemServico->marca ? $ordemServico->marca->nome : null }}</td>
                <td><strong>MODELO:</strong> {{ $ordemServico->modelo }}</td>
                <td colspan="2"><strong>SÉRIE:</strong> {{ $ordemServico->serie }}</td>
            </tr>
            <tr>
                <td colspan="4"><strong>Problema Apresentado no Equipamento:</strong> <br>
                    {{ implode(', ', $ordemServico->problemas->pluck('nome')->toArray()) }}
                </td>
            </tr>
            <tr>
                <td colspan="4"><strong>Descrição dos Serviços Prestados:</strong> <br>
                    Desmontagem, Limpeza,
                    @foreach($ordemServico->servicos as $servico)
                        {{$servico->nome}}, 
                    @endforeach
                    Ajuste da temperatura de 0 a -1 grau
                </td>
            </tr>
            <tr>
                <td colspan="4"><strong>Informações Adicionais:</strong> <br>
                    Orçamento Válido por: 3 dias <br>
                    Forma de Pagamento: Pix, Débito ou Cartão de Crédito
                </td>
            </tr>
            <tr>
                <td style="width: 30%;"><strong>Data de Entrada:</strong> {{ $ordemServico->data_entrada ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_entrada))) : null }}</td>
                <td style="width: 30%;"><strong>{{ $dataSaida }}:</strong> {{ $ordemServico->data_saida ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) : null }}</td>
                <td style="width: 20%;"><strong>Status:</strong> {{ $ordemServico->getStatusFormatado() }}</td>
                <td style="width: 20%;"><strong>Valor Total:</strong> R${{ number_format($ordemServico->valor_total, 2, ',', '.') }}</td>
            </tr>
        </table>
    </body>
</html>
