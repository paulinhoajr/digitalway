<html>
    <head>
        <style>

            @page {
                margin: 0;
            }

            table {
                width: 100%;
            }
            body{
                font-family: "Times New Roman", Times, serif;
            }

            .page-break {
                page-break-after: always;
            }

            .largura {
                width: 100%;
            }
            .altura {
                height: 100%;
            }
            .full {
                width: 100%;
                height: 100%;
            }

            .watermark {
                background-repeat: no-repeat;
                position: absolute;
                bottom:   0;
                left:     0;
                width:    100%;
                height:   100%;
                z-index:  -1000;
                opacity: 1;
            }

            .topo {
                margin-top: -30px;
            }

            .footer {
                position: absolute;
                bottom:   -30px;
            }

            .qrcode{
                font-size: x-small;
            }

            .conteudo{
                text-indent: 50px;
            }

            .fonte_10{
                font-size: 10px;
            }

            .fonte_11{
                font-size: 11px;
            }

            .fonte_12{
                font-size: 12px;
            }

            .fonte_13{
                font-size: 13px;
            }

            .fonte_14{
                font-size: 14px;
            }

            .fonte_18{
                font-size: 18px;
            }

            .border_td{
                border-bottom: 0.5px solid black;
            }

        </style>
    </head>
    <body>

        <div class="watermark">
            <img src="{{ asset('/images/layout.jpg') }}"  class="full">
        </div>

        <table class="table">
            <thead>
                <tr>
                    <h2>{{ $treinamento_nome }}</h2>
                    <th colspan="4">{{ $usuario_nome }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        @foreach($treinamento_topicos as $topico)
                            TELA INTERATIVA: <span>* {{ $topico }}</span> <br>
                        @endforeach
                    </td>

                    <td>{{ $treinamento_descricao }}</td>
                    <td>{{ $treinamento_carga_horaria }}</td>
                    <td>{{ $treinamento_criado }}</td>

                </tr>
                <tr>
                    <th colspan="4">
                        {{ mascara($usuario_cpf, "cpf") }}
                    </th>
                </tr>
            </tbody>
        </table>

    </body>
</html>



