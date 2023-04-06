<?php
    class Cafeteira {
        public $suprimentos;
        public $caixa;
        public $moedas;
        public $cedulas;
        public $bebidas;

        private static $arquivo = 'dados.json';

        function __construct () {
            if (file_exists (self::$arquivo)) {
                $dados = file_get_contents (self::$arquivo);
                $dados = json_decode ($dados, true);

                $this->suprimentos = $dados['suprimentos'];
                $this->caixa       = $dados['caixa'];
                $this->moedas      = $dados['moedas'];
                $this->cedulas     = $dados['cedulas'];
                $this->bebidas     = $dados['bebidas'];
                return;
            }

            $this->suprimentos = [
            // 'café'      => 0,
            // 'chocolate' => 0,
            // 'açúcar'    => 0
            ];
            $this->caixa       = 0;
            $this->moedas      = [
                '0.01' => 0,
                '0.05' => 0,
                '0.10' => 0,
                '0.25' => 0,
                '0.50' => 0,
                '1.00' => 0,
            ];
            $this->cedulas     = [];
            $this->bebidas     = [];
            $this->gravarDados ();
        }

        function adicionarSuprimento ($suprimento) {
            $this->suprimentos[$suprimento->nome] = $suprimento->nivel;
            return $this->gravarDados ();
        }

        function adicionarMoeda ($valor) {
            if ($this->moedas[$valor] < 25) {
                $this->moedas[$valor] +=1;
            } else {
                print ("dispenser de moedas {$valor} está cheio\n");
                return;
            }
            // $this->moedas[$valor] += 1;
            $this->totalizarCaixa ();
            return $this->gravarDados ();
        }

        function totalizarCaixa () {
            $this->caixa = 0;
            foreach ($this->moedas as $valor => $quantia) {
                $this->caixa += $valor * $quantia;
            }
        }

        function exibirSuprimentos () {
            return json_encode ($this->suprimentos);
        }

        function exibirMoedas () {
            return json_encode ($this->moedas);
        }

        function exibirCaixa () {
            return $this->caixa;
        }

        function gravarDados () {
            $dados = json_encode ($this);
            return file_put_contents (self::$arquivo, $dados);
        }
    }

    class Suprimento {
        public $nome;
        public $nivel;

        function __construct ($nome, $nivel) {
            $this->nome  = $nome;
            $this->nivel = $nivel;
        }
    }


    $cafeteira = new Cafeteira ();


    if (isset ($_GET['exibir'])) {
        if ($_GET['exibir']==='suprimentos') {
            print ($cafeteira->exibirSuprimentos ());
        }

        if ($_GET['exibir']==='moedas') {
            print ($cafeteira->exibirMoedas ());
        }

        if ($_GET['exibir']==='caixa') {
            print ($cafeteira->exibirCaixa ());
        }
    }


    if (isset ($_GET['adicionar'])) {
        if ($_GET['adicionar']==='suprimentos') {
            if (isset ($_GET['tipo'])) {
                print ($cafeteira->adicionarSuprimento (new Suprimento ($_GET['tipo'], '100')));
            }
        }

        if ($_GET['adicionar']==='moedas') {
            if (isset ($_GET['valor'])) {
                print ($cafeteira->adicionarMoeda ($_GET['valor']));
            }
        }
    }
?>
