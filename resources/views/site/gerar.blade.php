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

            .usuario_nome{
                position: fixed;
                top: 230px;
                left: 150px;
            }

            .treinamento_topicos{
                position: fixed;
                top: 370px;
                left: 150px;
                font-size: 15px;
            }

            .treinamento_carga_horaria{
                position: fixed;
                top: 450px;
                left: 310px;
                font-size: 25px;
            }

            .usuario_cpf{
                position: fixed;
                top: 527px;
                left: 345px;
                font-size: 20px;
            }

            .empresa_cnpj{
                position: fixed;
                top: 556px;
                left: 305px;
                font-size: 20px;
            }

            .instrutor{
                position: fixed;
                top: 587px;
                left: 250px;
                font-size: 20px;
            }

            .treinamento_criado{
                position: fixed;
                top: 650px;
                left: 150px;
                font-size: 20px;
            }

            .qrcode{
                position: fixed;
                top: 510px;
                right: 155px;
                font-size: 20px;
            }



        </style>
    </head>
    <body>

        <div class="watermark">
            <img src="{{ asset('/images/layout.jpg') }}"  class="full">
        </div>

        <div class="usuario_nome">
            <h2>{{ $usuario_nome }}</h2>
        </div>

        <div class="treinamento_topicos">
            @foreach($treinamento_topicos as $topico)
                <strong>TELA INTERATIVA:</strong> <span>{{ $topico }}</span><br>
            @endforeach
        </div>

        <div class="treinamento_carga_horaria">
            <p>{{ $treinamento_carga_horaria }} Horas</p>
        </div>

        <div class="usuario_cpf">
            <p>{{ mascara($usuario_cpf, "cpf") }}</p>
        </div>

        <div class="empresa_cnpj">
            <p>{{ "00.169.604/0001-66" }}</p>
        </div>

        <div class="instrutor">
            <p>{{ $instrutor }}</p>
        </div>

        <div class="treinamento_criado">
            <h3>{{ $treinamento_criado }}</h3>
        </div>

        <div class="qrcode">
            <a><img src="data:image/png;base64, {!! base64_encode(QrCode::size(130)->generate($link)) !!} "></a>
        </div>

    </body>
</html>



