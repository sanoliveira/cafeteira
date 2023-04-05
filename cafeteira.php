<?php
    $cafeteira = [
        'suprimentos' => [
            'cafe'      => 0,
            'chocolate' => 0,
            'acucar'    => 0
        ],
        'caixa' => 0,
        'moedas' => [
            '0,01' => 0,
            '0,05' => 0,
            '0,10' => 0,
            '0,25' => 0,
            '0,50' => 0,
            '1,00' => 0,
        ],
        'cedulas' => [
            '2' => 0,
            '5' => 0,
            '10' => 0,
        ],
    ];

    if (file_exists('dados.json')) {
        $dados = file_get_contents ('dados.json');
        $cafeteira = json_decode ($dados, true);
    } else {
        file_put_contents ('dados.json', json_encode ($cafeteira));
    }

    function adicionarSuprimento ($suprimento) {
        global $cafeteira;
        $cafeteira['suprimentos'][$suprimento] = 100;
        print (file_put_contents ('dados.json', json_encode ($cafeteira)));
    }

    function iniciarCaixa ($valor) {
        global $cafeteira;
        $cafeteira['caixa'] = $valor;
        print (file_put_contents ('dados.json', json_encode ($cafeteira)));
    }

    function listaSuprimentos () {
        global $cafeteira;
        return $cafeteira['suprimentos'];
    }

    switch ($_GET['data']) {
        case 'listar' :
            echo json_encode (listaSuprimentos());
            break;
        case 'adicionar' :
            switch ($_GET['sup']) {
                case 'cafe' :
                    adicionarSuprimento ('cafe');
                    break;
                case 'acucar' :
                    adicionarSuprimento ('acucar');
                    break;
                case 'chocolate':
                    adicionarSuprimento ('chocolate');
                    break;
            }
    }

?>
