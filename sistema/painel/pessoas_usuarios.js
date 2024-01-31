
// Função para abrir o modal com os dados do usuario a ser editado
function openEditModal(id, nome, email, telefone, cpf, nivel, endereco, atendimento) {
    var modal = $('#meuModal');
    modal.find('#myModalLabel').text('Editar usuario');
    modal.find('#usuarioId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#email').val(email);
    modal.find('#telefone').val(telefone);
    modal.find('#cpf').val(cpf);
    modal.find('#nivel').val(nivel);
    modal.find('#endereco').val(endereco);
    modal.find('#atendimento').val(atendimento);
    modal.modal('show');
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');
    modal.find('#myModalLabel').text('Inserir usuario');
    modal.find('#usuarioId').val(''); // Limpar o campo usuarioId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#email').val('');
    modal.find('#telefone').val('');
    modal.find('#cpf').val('');
    modal.find('#nivel').val('');
    modal.find('#endereco').val('');
    modal.find('#atendimento').val('');
    modal.modal('show');
}

// Adicionamos um evento para o formulário de usuarios
$(document).ready(function() {
    $('#meuModal').on('hide.bs.modal', function(event) {


        
        // Obtemos os dados do formulário
        var nome = $('#nome').val();
        var email = $('#email').val();
        var telefone = $('#telefone').val();
        var cpf = $('#cpf').val();
        var nivel = $('#nivel').val();
        var endereco = $('#endereco').val();
        var atendimento = $('#atendimento').val();

        // Validar campos aqui, se necessário
        if (!nome || !email || !telefone || !cpf || !nivel || !endereco || !atendimento ) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');

            // Impedir o fechamento do modal
            event.preventDefault();
        }
    });

    $('#usuarioForm').submit(function(event) {
        event.preventDefault();

        // Obtemos os dados do formulário
        var usuarioId = $('#usuarioId').val();
        var nome = $('#nome').val();
        var email = $('#email').val();
        var telefone = $('#telefone').val();
        var cpf = $('#cpf').val();
        var nivel = $('#nivel').val();
        var endereco = $('#endereco').val();
        var atendimento = $('#atendimento').val();

        // Validar campos aqui, se necessário
        if (!nome || !email || !telefone || !cpf || !nivel || !endereco || !atendimento ) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return;
        }

        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('usuarioId', usuarioId);
        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('telefone', telefone);
        formData.append('cpf', cpf);
        formData.append('nivel', nivel);
        formData.append('endereco', endereco);
        formData.append('atendimento', atendimento);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'pessoas_usuarios_inserir.php',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json', // Indica que esperamos uma resposta JSON
            success: function(response) {
                // Verifica se a operação foi bem-sucedida
                if (response.success) {
                    Swal.fire({
                        title: 'Sucesso!',
                        text: response.message,
                        icon: 'success',
                        confirmButtonColor: '#28a745',
                        position: 'top',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // recarrega a página após 1 segundo
                            setTimeout(function() {
                                window.location.reload();
                            }, 1000);
                        }
                    });
                } else {
                    Swal.fire({
                        title: 'Erro!',
                        text: response.message,
                        icon: 'error',
                        confirmButtonColor: '#28a745',
                        position: 'top',
                    });
                }

                // Fecha o modal apenas se a validação for bem-sucedida
                // Se a exclusão foi bem-sucedida, recarrega a página ou realiza outras ações necessárias
                if (response.success) {
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000); // 1000 milissegundos = 1 segundo
                }
            },
            error: function(error) {
                console.error('Erro na requisição AJAX:', error);
            }
        });
    });
});
// Função para excluir o Usuario

function excluirUsuario(id) {
    Swal.fire({
        title: 'Atenção!',
        text: 'Tem certeza que deseja excluir?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745', // Cor verde
        cancelButtonColor: '#dc3545', // Cor vermelha (danger)
        confirmButtonText: 'Sim, Confrimar!', // Texto personalizado
        cancelButtonText: 'Cancelar', // Texto em português
        position: 'top',
    }).then((result) => {
        if (result.isConfirmed) {
            // Utilizamos AJAX para enviar os dados para o script de exclusão
            $.ajax({
                type: 'GET',
                url: 'pessoas_usuarios_excluir.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    Swal.fire({
                        title: response.success ? 'Excluído!' : 'Erro!',
                        text: response.message,
                        icon: response.success ? 'success' : 'error',
                        confirmButtonColor: '#28a745',
                        position: 'top',
                    });

                    // Se a exclusão foi bem-sucedida, recarrega a página ou realiza outras ações necessárias
                    if (response.success) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000); // 1000 milissegundos = 1 segundo
                    }
                },
                error: function(error) {
                    console.error('Erro na requisição AJAX:', error);
                }
            });
        }
    });
}

