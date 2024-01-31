// Função para abrir o modal com os dados do funcionário a ser editado
function openEditModal(id, nome, chave, grupo) {
    var modal = $('#meuModal');
    var form = $('#acessoForm');

    modal.find('#myModalLabel').text('Editar acesso');
    modal.find('#acessoId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#chave').val(chave);
    modal.find('#grupo').val(grupo);
    modal.modal('show');
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');
    var form = $('#acessoForm');

    modal.find('#myModalLabel').text('Inserir acesso');
    modal.find('#acessoId').val(''); // Limpar o campo acessoesId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#chave').val('');
    modal.find('#grupo').val('');
    modal.modal('show');

}

$(document).ready(function() {
    // Adicionamos um evento para o formulário de funcionários
    $('#acessoForm').submit(function(event) {
        event.preventDefault();

        // Obtemos os dados do formulário
        var acessoId = $('#acessoId').val();
        var nome = $('#nome').val();
        var chave = $('#chave').val();
        var grupo = $('#grupo').val();


        // Validar campos aqui, se necessário
        if (!nome || !chave || !grupo) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return;
        }

        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('acessoId', acessoId);
        formData.append('nome', nome);
        formData.append('chave', chave);
        formData.append('grupo', grupo);

        // Console log dos dados enviados via AJAX
        console.log('Dados enviados via AJAX:');
        console.log('acessoId: ' + acessoId);
        console.log('nome: ' + nome);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'cadastro_acesso_inserir.php',
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


// Função para excluir o acesso
function excluiracesso(id) {
    Swal.fire({
        title: 'Atenção!',
        text: 'Tem certeza que deseja excluir?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#28a745', // Cor verde
        cancelButtonColor: '#dc3545', // Cor vermelha (danger)
        confirmButtonText: 'Sim, Confirmar!', // Texto personalizado
        cancelButtonText: 'Cancelar', // Texto em português
        position: 'top',
    }).then((result) => {
        if (result.isConfirmed) {
            // Utilizamos AJAX para enviar os dados para o script de exclusão
            $.ajax({
                type: 'GET',
                url: 'cadastro_acesso_excluir.php',
                data: {
                    id: id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Excluído!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonColor: '#28a745',
                            position: 'top',
                        });

                        // Se a exclusão foi bem-sucedida, remova a linha da tabela
                        $('#row_' + id).remove();
                    } else {
                        Swal.fire({
                            title: 'Erro!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonColor: '#dc3545', // Cor vermelha
                            position: 'top',
                        });
                    }
                     // Se a exclusão foi bem-sucedida, recarrega a página ou realiza outras ações necessárias
                     if (response.success) {
                        setTimeout(function() {
                            window.location.reload();
                        }, 1000); // 1000 milissegundos = 1 segundo
                    }
                },
                error: function(error) {
                    console.error('Erro na requisição AJAX:', error);
                    Swal.fire({
                        title: 'Erro!',
                        text: 'Ocorreu um erro na exclusão.',
                        icon: 'error',
                        confirmButtonColor: '#dc3545', // Cor vermelha
                        position: 'top',
                    });
                }
            });
        }
    });
}


