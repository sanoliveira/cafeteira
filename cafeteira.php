<?php
    $cafeteira = [
        'suprimentos' => [
            'cafe'      => 0,
            'chocolate' => 0,
            'acucar'    => 0
        ],
        'caixa' => 0,
        'moedas' => [
            '0_01' => 0,
            '0_05' => 0,
            '0_10' => 0,
            '0_25' => 0,
            '0_50' => 0,
            '1_00' => 0,
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

    function adicionarMoedas ($moeda) {
        global $cafeteira;
        $cafeteira['moedas'][$moeda] += 1;
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

    function listaMoedas () {
        global $cafeteira;
        return $cafeteira['moedas'];
    }

    switch ($_GET['data']) {
        case 'listar' :
            echo json_encode (listaSuprimentos());
            break;

        case 'listarMoedas' :
            echo json_encode (listaMoedas());
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

            switch ($_GET['moeda']) {
                case '0_01':
                    adicionarMoedas ('0_01');
                    break;
                case '0_05':
                    adicionarMoedas ('0_05');
                    break;
                case '0_10':
                    adicionarMoedas ('0_10');
                    break;
                case '0_25':
                    adicionarMoedas ('0_25');
                    break;
                case '0_50':
                    adicionarMoedas ('0_50');
                    break;
                case '1_00':
                    adicionarMoedas ('1_00');
                    break;
            }
    }

?>
