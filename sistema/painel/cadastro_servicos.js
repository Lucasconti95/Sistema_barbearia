// Função para abrir o modal com os dados do funcionário a ser editado nome, valor, categoria, dias_retorno, comissao, tempo_extimado
function openEditModal(id, nome, valor, categoria, dias_retorno, comissao, tempo_extimado) {
    var modal = $('#meuModal');
    var form = $('#servicoForm');

    modal.find('#myModalLabel').text('Editar servico');
    modal.find('#servicoId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#valor').val(valor);
    modal.find('#categoria').val(categoria);
    modal.find('#dias_retorno').val(dias_retorno);
    modal.find('#comissao').val(comissao);
    modal.find('#tempo_extimado').val(tempo_extimado);
    modal.modal('show');
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');
    var form = $('#servicoForm');

    modal.find('#myModalLabel').text('Inserir servico');
    modal.find('#servicoId').val(''); // Limpar o campo servicosId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#valor').val('');
    modal.find('#categoria').val('');
    modal.find('#dias_retorno').val('');
    modal.find('#comissao').val('');
    modal.find('#tempo_extimado').val('');
    modal.modal('show');

}

$(document).ready(function() {
    // Adicionamos um evento para o formulário de servicos
    $('#servicoForm').submit(function(event) {
        event.preventDefault();

        // Obtemos os dados do formulário
        var servicoId = $('#servicoId').val();
        var nome = $('#nome').val();
        var valor = $('#valor').val();
        var categoria = $('#categoria').val();
        var dias_retorno = $('#dias_retorno').val();
        var comissao = $('#comissao').val();
        var tempo_extimado = $('#tempo_extimado').val();


        // Validar campos aqui, se necessário
        if (!nome || !valor || !categoria || !dias_retorno || !comissao || !tempo_extimado) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return;
        }

        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('servicoId', servicoId);
        formData.append('nome', nome);
        formData.append('valor', valor);
        formData.append('categoria', categoria);
        formData.append('dias_retorno', dias_retorno);
        formData.append('comissao', comissao);
        formData.append('tempo_extimado', tempo_extimado);

        // Console log dos dados enviados via AJAX
        console.log('Dados enviados via AJAX:');
        console.log('servicoId: ' + servicoId);
        console.log('nome: ' + nome);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'cadastro_servicos_inserir.php',
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
function excluirservico(id) {
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
                url: 'cadastro_servicos_excluir.php',
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


