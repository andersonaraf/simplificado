$(document).ready(function(){
    $("#contato1").inputmask({
        mask: ["(99) 9999-9999", "(99) 99999-9999", ],
        keepStatic: true
    });
    $("#contato2").inputmask({
        mask: ["(99) 9999-9999", "(99) 99999-9999", ],
        keepStatic: true
    });
    $('#cep').inputmask({"mask": "99.999-999"});
    $('#cpf').inputmask({"mask": "999.999.999-99"});
});


