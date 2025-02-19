<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hornet Bier - Pagamento n° {{$pagamento->id}} Realizado com Sucesso</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            body {
                background-color: #f8f9fa;
            }
            .success-message {
                margin-top: 50px;
                text-align: center;
            }
            .success-icon {
                font-size: 35px;
                color: #28a745;
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
            <div class="success-message">
                <img src="/images/nova-logo.png" alt="Logo do Estabelecimento" class="logo">
                <div class="success-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h1>Pagamento #{{$pagamento->id}} Realizado com Sucesso!</h1>
                <p>Obrigado por sua confiança em nosssos serviços. Seu pagamento foi processado com sucesso.</p>
                <a href="/" class="btn btn-success">Voltar para a Página Inicial</a>
                <button onclick="imprimirPagina()" class="btn btn-dark"><i class="fas fa-print"></i></button>
            </div>

            <div class="table-container">
                <h2>Detalhes do Serviço</h2>
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
                            <th colspan="3" class="text-right">Valor Total:</th>
                            <th>R$ {{number_format($pagamento->valor, 2, ',', '.')}}</th>
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