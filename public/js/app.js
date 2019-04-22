
$(function() {
    $('input:text, .ui.button', '.ui.action.input').on('click', function (e) {
        $('input:file', $(e.target).parents()).click();
    });
    
    $('input:file', '.ui.action.input').on('change', function (e) {
        
        var name = e.target.files[0].name;
        //pdf, doc, docx, odt ou txt
        let allowedExtensions = [
            '.pdf',
            '.doc',
            '.docx',
            '.odt',
            '.txt'
        ];
        let ext = name.substr(-4);
        if(!allowedExtensions.includes(ext)) {
    
            $("#warning").html('Extensões permitidas: pdf, doc, docx, odt ou txt');
            $('.ui.modal').modal('show');
    
        } else {
            $('input:text', $(e.target).parent()).val(name);
        }
        
    });
    //setting the mask for phone
    $("#phone").inputmask("(99) 99999-9999");
    $('#mailer-form')
        .form({
            on: 'blur',
            inline: true,
            fields: {
                name: {
                    identifier: 'name',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'É necessário colocar seu nome'
                        }
                    ]
                },
                email: {
                    identifier: 'email',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'É necessário colocar seu e-mail'
                        },
                        {
                            type: 'email',
                            prompt: "O email deve ser válido!"
                        }
                    ]
                },
                phone: {
                    identifier: 'phone',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'É necessário colocar seu telefone'
                        }
                    ]
                },
                file: {
                    identifier: 'file',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'É anexar um arquivo'
                        }
                    ]
                },
                message: {
                    identifier: 'message',
                    rules: [
                        {
                            type: 'empty',
                            prompt: 'É necessário colocar uma mensagem'
                        }
                    ]
                }
            }
        });

    $("#mailer-form").submit(event => {
        event.preventDefault();
        var formData = new FormData();
        
        let file = $('input[type=file]')[0].files[0];
        
        formData.append('name', $("#name").val());
        formData.append('email', $("#email").val());
        formData.append('phone', $("#phone").val());
        formData.append('message', $("#message").val());
        formData.append('file', file);
        
        // checking if the form pass in validation and, file size is less than 500kB
        if($("#mailer-form").form('is valid') && file.size < 500000) {
            $.ajax({    
                url: '/send',
                method: 'POST',
                dataType: 'json',
                beforeSend: () => {
                    $("#submit-button").toggleClass('loading');
                },
                processData: false,
                contentType: false,
                data: formData,
                success: (res) => {
                    $("#submit-button").toggleClass('loading');

                    $("#warning").html('E-Mail enviado com sucesso :)');
                    $('.ui.modal').modal('show');
                    console.log(res);
                    $("#name").val('');
                    $("#email").val('');
                    $("#phone").val('');
                    $("#message").val('');
                },
                error: (err) => {
                    $("#submit-button").toggleClass('loading');
                    $("#warning").html('Houve um problema ao enviar o e-mail');
                    $('.ui.modal').modal('show');
                    console.log(err);
                }
            });
        }
        
        
    });
    

});