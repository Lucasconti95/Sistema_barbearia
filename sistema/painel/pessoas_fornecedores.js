// Função para abrir o modal com os dados do funcionário a ser editadonome, telefone, tipo_chave_pix, chave_pix, endereco
function openEditModal(id, nome, telefone, tipo_chave_pix, chave_pix, endereco) {
    var modal = $('#meuModal');
    var form = $('#fornecedorForm');

    modal.find('#myModalLabel').text('Editar fornecedor');
    modal.find('#fornecedorId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#telefone').val(telefone);
    modal.find('#tipo_chave_pix').val(tipo_chave_pix);
    modal.find('#chave_pix').val(chave_pix);
    modal.find('#endereco').val(endereco);
    modal.modal('show');
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');
    var form = $('#fornecedorForm');

    modal.find('#myModalLabel').text('Inserir fornecedor');
    modal.find('#fornecedorId').val(''); // Limpar o campo fornecedoresId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#telefone').val('');
    modal.find('#tipo_chave_pix').val('');
    modal.find('#chave_pix').val('');
    modal.find('#endereco').val('');
    modal.modal('show');

}

$(document).ready(function() {
    // Adicionamos um evento para o formulário de funcionários
    $('#fornecedorForm').submit(function(event) {
        event.preventDefault();

        // Obtemos os dados do formulário
        var fornecedorId = $('#fornecedorId').val();
        var nome = $('#nome').val();
        var telefone = $('#telefone').val();
        var tipo_chave_pix = $('#tipo_chave_pix').val();
        var chave_pix = $('#chave_pix').val();
        var endereco = $('#endereco').val();


        // Validar campos aqui, se necessário
        if (!nome || !telefone || !tipo_chave_pix || !chave_pix || !endereco) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return;
        }

        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('fornecedorId', fornecedorId);
        formData.append('nome', nome);
        formData.append('telefone', telefone);
        formData.append('tipo_chave_pix', tipo_chave_pix);
        formData.append('chave_pix', chave_pix);
        formData.append('endereco', endereco);

        // Console log dos dados enviados via AJAX
        console.log('Dados enviados via AJAX:');
        console.log('fornecedorId: ' + fornecedorId);
        console.log('nome: ' + nome);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'pessoas_fornecedores_inserir.php',
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


// Função para excluir o fornecedor
function excluirFornecedor(id) {
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
                url: 'pessoas_fornecedores_excluir.php',
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


