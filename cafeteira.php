<?php
    include_once ('src/classes/Cafeteira.php');

    $cafeteira = new Cafeteira ();


    if (isset ($_GET['exibir'])) {
        if ($_GET['exibir'] === 'suprimentos') {
            print ($cafeteira->exibirSuprimentos ());
        }

        if ($_GET['exibir'] === 'moedas') {
            print ($cafeteira->exibirMoedas ());
        }

        if ($_GET['exibir'] === 'caixa') {
            print ($cafeteira->exibirCaixa ());
        }
    }


    if (isset ($_GET['adicionar'])) {
        if ($_GET['adicionar'] === 'suprimentos') {
            if (isset ($_GET['tipo'])) {
                print ($cafeteira->adicionarSuprimento (new Suprimento ($_GET['tipo'], '100')));
            }
        }

        if ($_GET['adicionar'] === 'moedas') {
            if (isset ($_GET['valor'])) {
                print ($cafeteira->adicionarMoeda ($_GET['valor']));
            }
        }
    }
?>
