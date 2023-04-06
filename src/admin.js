// function listarSuprimentos () {
//     fetch ('cafeteira.php?data=listar')
//     .then (data => data.text ())
//     .then (sup => {
//         sup = JSON.parse (sup)
//         for (item in sup) {
//             document.querySelector (`#${item}`).value = sup[item]
//         }
//     })
// }

// function listarMoedas () {
//     fetch ('cafeteira.php?data=listarMoedas')
//     .then (data => data.text ())
//     .then (moedas => {
//         moedas = JSON.parse (moedas)
//         for (item in moedas) {
//             document.querySelector (`#m${item}`).value = moedas[item]
//         }
//     })
// }

// function adicionarSuprimentos (sup) {
//     fetch ('cafeteira.php?data=adicionar&sup='+sup)
//     .then (data => data.text ())
//     .then (ret => {
//         if (ret > 0 ) listarSuprimentos ();
//     })
// }

// function adicionarMoedas (val) {
//     fetch ('cafeteira.php?data=adicionar&moeda='+val)
//     .then (data => data.text ())
//     .then (ret => {
//         if (ret > 0 ) listarMoedas ();
//         exibirCaixa ();
//     })
// }

// function exibirCaixa () {
//     fetch ('cafeteira.php?data=exibirCaixa')
//     .then (data => data.text ())
//     .then (ret => {
//         document.querySelector('#total').value = ret;
//     })
// }

// document.querySelectorAll ('#suprimentos button').forEach ((button, i) => {
//     button.addEventListener ('click', () => {
//         switch (i) {
//             case 0:
//                 adicionarSuprimentos ('cafe')
//                 break;
//             case 1:
//                 adicionarSuprimentos ('chocolate')
//                 break;
//             case 2:
//                 adicionarSuprimentos ('acucar')
//                 break;
//         }
//     })
// })

// document.querySelectorAll ('#moedas button').forEach ((button, i) => {
//     button.addEventListener ('click', () => {
//         switch (i) {
//             case 0:
//                 adicionarMoedas ('0_01')
//                 break;
//             case 1:
//                 adicionarMoedas ('0_05')
//                 break;
//             case 2:
//                 adicionarMoedas ('0_10')
//                 break;
//             case 3:
//                 adicionarMoedas ('0_25')
//                 break;
//             case 4:
//                 adicionarMoedas ('0_50')
//                 break;
//             case 5:
//                 adicionarMoedas ('1_00')
//                 break;
//         }
//     })
// })

// listarSuprimentos ();
// listarMoedas ();
// exibirCaixa ();

const url = 'cafeteira.php';

function exibirSuprimentos () {
    fetch (url+'?exibir=suprimentos')
    .then (ret => ret.text())
    .then (dados => {
        dados = JSON.parse (dados);
        for (item in dados) {
            document.querySelector (`#${item}`).value = dados[item]
            document.querySelector (`#${item}`).innerHTML = dados[item]
        }
    })
}

function exibirMoedas () {
    fetch (url+'?exibir=moedas')
    .then (ret => ret.text())
    .then (dados => {
        dados = JSON.parse (dados);
        for (i in dados) {
            document.querySelector (`progress[name="${i}"]`).value = dados[i]
            document.querySelector (`progress[name="${i}"]`).innerHTML = dados[i]
        }
    })
}

function exibirCaixa () {
    fetch (url+'?exibir=caixa')
    .then (ret => ret.text())
    .then (dados => {
        dados = JSON.parse (dados);
        document.querySelector ("#total").value = dados
        //console.log (dados)
    })
}

function adicionarSuprimento (suprimento) {
    fetch (url+'?adicionar=suprimentos&tipo='+suprimento)
    .then (ret => ret.text())
    .then (dados => {
        if (dados > 0) exibirSuprimentos ()

    })
}

function adicionarMoeda (valor) {
    fetch (url+'?adicionar=moedas&valor='+valor)
    .then (ret => ret.text())
    .then (dados => {
        if (dados > 0) {
            exibirMoedas ()
            exibirCaixa ()
        } else {
            alert (dados)
        }
    })
}

document.querySelectorAll ('#suprimentos button').forEach ((button, i) => {
    button.addEventListener ('click', () => {
        switch (i) {
            case 0:
                adicionarSuprimento ('café')
                break;
            case 1:
                adicionarSuprimento ('chocolate')
                break;
            case 2:
                adicionarSuprimento ('açúcar')
                break;
        }
    })
})

document.querySelectorAll ('#moedas button').forEach ((button, i) => {
    button.addEventListener ('click', () => {
        switch (i) {
            case 0:
                adicionarMoeda ('0.01')
                break;
            case 1:
                adicionarMoeda ('0.05')
                break;
            case 2:
                adicionarMoeda ('0.10')
                break;
            case 3:
                adicionarMoeda ('0.25')
                break;
            case 4:
                adicionarMoeda ('0.50')
                break;
            case 5:
                adicionarMoeda ('1.00')
                break;
        }
    })
})

exibirSuprimentos ();
exibirMoedas ();
exibirCaixa ();
