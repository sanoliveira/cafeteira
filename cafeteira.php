<?php
    ini_set ('display_errors','1');

    $cafeteira = [
        'suprimentos' => [
            'cafe'      => 0,
            'chocolate' => 0,
            'acucar'    => 0
        ],
        'caixa' => 0,
    ];

    if (file_exists('dados.json')) {
        $dados = file_get_contents ('dados.json');
        $cafeteira = json_decode ($dados, true);
    } else {
        file_put_contents ('dados.json', json_encode ($cafeteira));
    }

    // enum Bebidas {
    //     case Cafe;
    //     case Chocolate;
    //     case Cappuccino;
    // }

    // foreach (Bebidas::cases() as $bebida) {
    //     print ($bebida->name."<br>");
    // }

    function adicionarSuprimento ($suprimento) {
        $cafeteira['suprimentos'][$suprimento] = 100;
        print ut_contents ('dados.json', json_encode ($cafeteira));
    }

    function iniciarCaixa ($valor) {
        $cafeteira['caixa'] = $valor;
    }

    function listaSuprimentos () {
        return $cafeteira['suprimentos'];
    }

    switch ($_GET['data']) {
        // echo json_encode (listaSuprimentos());
        case 'listar' :
            echo json_encode ($cafeteira['suprimentos']);
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
