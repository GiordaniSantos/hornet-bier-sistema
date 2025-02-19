<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hornet Bier - Falha no pagamento n° {{$pagamento->id}}</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-color: #f8f9fa;
            }
            .error-message {
                margin-top: 50px;
                text-align: center;
            }
            .error-icon {
                font-size: 35px;
                color: #dc3545;
            }
            .logo {
                max-width: 200px;
                margin: 20px auto;
            }
            .table-container {
                margin-top: 30px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="error-message">
                <img src="/images/nova-logo.png" alt="Logo do Estabelecimento" class="logo">
                <div class="error-icon">
                    <i class="fas fa-times-circle"></i>
                </div>
                <h1>Falha no Pagamento!</h1>
                <p>Ocorreu um erro ao processar seu pagamento. Por favor, tente novamente.</p>
                <a href="https://www.mercadopago.com.br/checkout/v1/redirect?pref_id=<?=$pagamento->session_id?>" class="btn btn-danger">Tentar Novamente</a>
                <button onclick="imprimirPagina()" class="btn btn-dark"><i class="fas fa-print"></i></button>
            </div>
            <div class="table-container">
                <h2>Detalhes da Tentativa de Pagamento</h2>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>N° do Serviço</th>
                            <th>Quantidade</th>
                            <th>Cliente</th>
                            <th>Valor do Serviço</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamento->itens as $item)
                            <tr>
                                <td>
                                    <a href="{{route('orcamento', ['id' => $item->ordemServico->id])}}" target="_blank">
                                        {{$item->ordemServico->numero}}
                                    </a>
                                </td>
                                <td>
                                    1
                                </td>
                                <td>
                                    {{$item->cliente->nome}}
                                </td>
                                <td>
                                    R$ {{number_format($item->valor_item, 2, ',', '.')}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total Tentativa:</th>
                            <th>{{number_format($pagamento->valor, 2, ',', '.')}}</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <script>
            function imprimirPagina() {
                window.print();
            }
        </script>
    </body>
</html>