function listarSuprimentos () {
    fetch ('cafeteira.php?data=listar')
    .then (data => data.text ())
    .then (sup => {
        sup = JSON.parse (sup)
        for (item in sup) {
            document.querySelector (`#${item}`).value = sup[item]
        }
    })
}

function listarMoedas () {
    fetch ('cafeteira.php?data=listarMoedas')
    .then (data => data.text ())
    .then (moedas => {
        moedas = JSON.parse (moedas)
        for (item in moedas) {
            document.querySelector (`#m${item}`).value = moedas[item]
        }
    })
}

function adicionarSuprimentos (sup) {
    fetch ('cafeteira.php?data=adicionar&sup='+sup)
    .then (data => data.text ())
    .then (ret => {
        if (ret > 0 ) listarSuprimentos ();
    })
}

function adicionarMoedas (val) {
    fetch ('cafeteira.php?data=adicionar&moeda='+val)
    .then (data => data.text ())
    .then (ret => {
        if (ret > 0 ) listarMoedas ();
    })
}

document.querySelectorAll ('#suprimentos button').forEach ((button, i) => {
    button.addEventListener ('click', () => {
        switch (i) {
            case 0:
                adicionarSuprimentos ('cafe')
                break;
            case 1:
                adicionarSuprimentos ('chocolate')
                break;
            case 2:
                adicionarSuprimentos ('acucar')
                break;
        }
    })
})

document.querySelectorAll ('#moedas button').forEach ((button, i) => {
    button.addEventListener ('click', () => {
        switch (i) {
            case 0:
                adicionarMoedas ('0_01')
                break;
            case 1:
                adicionarMoedas ('0_05')
                break;
            case 2:
                adicionarMoedas ('0_10')
                break;
            case 3:
                adicionarMoedas ('0_25')
                break;
            case 4:
                adicionarMoedas ('0_50')
                break;
            case 5:
                adicionarMoedas ('1_00')
                break;
        }
    })
})

listarSuprimentos ();
listarMoedas ();
