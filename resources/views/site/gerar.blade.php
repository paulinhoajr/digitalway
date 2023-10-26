<!doctype html>
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
                top: 220px;
                /*left: 150px;*/
                width: 100%;
                text-align: center;
                font-size: 25px;
            }
            .treinamento_topicos{
                position: fixed;
                top: 365px;
                left: 220px;
                font-size: 18px;
            }
            .item{
                margin-bottom: -10px;
            }
            .treinamento_carga_horaria{
                position: fixed;
                top: 450px;
                left: 310px;
                font-size: 25px;
            }
            .usuario_cpf{
                position: fixed;
                top: 520px;
                left: 345px;
                font-size: 20px;
            }
            .empresa_cnpj{
                position: fixed;
                top: 554px;
                left: 305px;
                font-size: 20px;
            }
            .instrutor{
                position: fixed;
                top: 584px;
                left: 250px;
                font-size: 20px;
            }
            .treinamento_criado{
                position: fixed;
                top: 645px;
                /*left: 150px;*/
                font-size: 18px;
                width: 100%;
                text-align: center;
            }
            .qrcode{
                position: fixed;
                top: 520px;
                right: 100px;
                font-size: 15px;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="watermark">
            <img src="{{ asset('/images/layout.png') }}"  class="full">
        </div>
        <div class="usuario_nome">
            <h2>{{ $usuario_nome }}</h2>
        </div>
        <div class="treinamento_topicos">
            @foreach($treinamento_topicos as $topico)
                <p class="item">{{ $topico }}</p>
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
            <p>Veranópolis / RS {{ $treinamento_criado }}</p>
        </div>
        <div class="qrcode">
            <img src="data:image/png;base64, {!! base64_encode(QrCode::size(160)->generate($link)) !!} "><br>
            <p style="margin-top: 0px;">DOCUMENTO ASSINADO</p>
            <p style="margin-top: -18px;">DIGITALMENTE</p>
        </div>
    </body>
</html>
