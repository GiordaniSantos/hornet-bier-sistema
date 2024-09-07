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
                <td>
                    <h3>RELATÓRIO ATENDIMENTO TÉCNICO</h3>
                    Hornetbier Manutenção de Chopeiras, Vendas e Projetos<br>
                    CNPJ 50.934.088 / 0001-97<br>
                    Sapucaia do Sul, Bairro Vargas. CEP. 93219-070<br>
                    Fone. 51.99944-6655 - Hélio / 51.99293-4558 - Fábio<br>
                </td>
            </tr>
        </table>
        <table>
            <tr>
                <td><strong>Cliente:</strong> {{ $ordemServico->cliente->nome }}</td>
                <td><strong>CNPJ/CPF:</strong> {{ $ordemServico->cliente->cpf_cnpj }}</td>
                <td><strong>Cidade:</strong> {{ $ordemServico->cliente->cidade }}</td>
                <td><strong>Número de OS:</strong> {{ $ordemServico->numero }}</td>
            </tr>
            <tr>
                <td><strong>MODELO:</strong> {{ $ordemServico->modelo }}</td>
                <td><strong>SÉRIE:</strong> {{ $ordemServico->serie }}</td>
                <td colspan="2"><strong>NÚMERO DO MOTOR:</strong> {{ $ordemServico->serie }}</td>
            </tr>
            <tr>
                <td colspan="4"><strong>Problema apresentado no equipamento:</strong> <br>
                    {{ implode(', ', $ordemServico->problemas->pluck('nome')->toArray()) }}
                </td>
            </tr>
            <tr>
                <td colspan="4"><strong>Descrição dos serviços prestados:</strong> <br>
                    desmontagem, limpeza,
                    @foreach($ordemServico->servicos as $servico)
                        {{$servico->nome}}, 
                    @endforeach
                    ajuste da temperatura de 0 a - 1 grau
                </td>
            </tr>
            <tr>
                <td colspan="4" style="text-align: center;"><strong>PEÇAS UTILIZADAS</strong></td>
            </tr>
            <tr>
                <td colspan="2"><strong>PEÇA</strong></td>
                <td colspan="2"><strong>QUANTIDADE</strong></td>
            </tr>
            @foreach($ordemServico->pecas as $peca)
                <tr>
                    <td colspan="2">{{ $peca->nome }}</td>
                    <td colspan="2">{{ $peca->pivot->quantidade }}</td>
                </tr>
            @endforeach
            <tr>
                <td><strong>Data de Entrada:</strong> {{ $ordemServico->created_at->format('d/m/Y') }}</td>
                <td><strong>{{ $dataSaida }}:</strong> {{ $ordemServico->data_saida ? date('d/m/Y', strtotime(str_replace('/', '-', $ordemServico->data_saida))) : null }}</td>
                <td><strong>Status:</strong> {{ $ordemServico->getStatusFormatado() }}</td>
                <td><strong>Valor Total:</strong> R${{ $ordemServico->valor_total }}</td>
            </tr>
        </table>
    </body>
</html>