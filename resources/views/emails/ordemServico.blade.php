<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Relatório de Atendimento Técnico</title>
    </head>
    <body style='font-family:Arial; font-size:11px; line-height:18px; text-align:center; margin:auto; padding:20px; color:rgb(50,50,50); background-color:#f1f1f1; font-weight:normal;'>
        <table width="700" align="center" cellpadding="0" cellspacing="0" style="border-bottom:5px solid #ff3a00 !important; background-color:#ffffff;">
            <tr>
                <td class="center"><img src="https://hornetbier.com.br/images/topo-email.jpg" alt="Topo Email"></td>
            </tr>
            <tr>
                <td align="left" style="padding:20px">
                    <table width="100%" border="0" cellpadding="0">
                        <tr>
                            <td>
                                <p>
                                    <span style="width:100%; float:left; padding:7px 0px; margin-bottom:10px; border-radius:4px; background-color:rgb(0, 0, 0); color:#FFF; text-align:center">
                                        <strong>Relatório de Atendimento Técnico n° {{ $ordemServico->numero }}</strong>
                                    </span>

                                    <p>Olá <strong>{{ $ordemServico->cliente->nome }}</strong>, para acessar seu orçamento de ordem de serviço n° <strong>{{ $ordemServico->numero }}</strong> e acompanhar o status do andamento do serviço basta acessar o seguinte link: <strong>{{ route('orcamento', ['id' => $ordemServico->id]) }}</strong> </p>
                                    
                                    <strong>Cliente:</strong> {{ $ordemServico->cliente->nome }}<br/>
                                    <strong>CPF/CNPJ:</strong> {{ $ordemServico->cliente->cpf_cnpj }}<br/>
                                    <strong>Status:</strong> {{ $ordemServico->getStatusFormatado() }}<br/>
                                    <strong>Data de Criação da Ordem de Serviço: </strong>{{ $ordemServico->created_at->format('d/m/Y') }}<br/>
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </body>
</html>