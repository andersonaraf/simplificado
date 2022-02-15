 $('#formcreate').submit(function(){
        e.preventDefault();
        let titulo_campo = $('#titulo_campo').val();
        let label = $('#label').val();
        let select = $('#select').val();
        // let titulo_campo = $('#placeholder' + data).val();
        // let titulo_campo = $('#titulo_campo').val();
        // let titulo_campo = $('#titulo_campo').val();
     $.ajax(
         url: '',
         method: 'POST',
         data: {},
        dataType: 'json',
     ).done(function(result))

    });



