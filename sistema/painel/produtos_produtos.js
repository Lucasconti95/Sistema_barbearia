// Função para abrir o modal com os dados do produtos a ser editado
function openEditModal(id, nome, categoria, descricao,valor_compra, valor_venda, estoque_minimo) {
    var modal = $('#meuModal');
    var form = $('#produtosForm');

    modal.find('#myModalLabel').text('Editar produtos');
    modal.find('#produtosId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#categoria').val(categoria);
    modal.find('#descricao').val(descricao);
    modal.find('#valor_compra').val(valor_compra);
    modal.find('#valor_venda').val(valor_venda);
    modal.find('#estoque_minimo').val(estoque_minimo);
    modal.modal('show');
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');
    var form = $('#produtosForm');

    modal.find('#myModalLabel').text('Inserir produtos');
    modal.find('#produtosId').val(''); // Limpar o campo produtosId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#categoria').val('');
    modal.find('#descricao').val('');
    modal.find('#valor_compra').val('');
    modal.find('#valor_venda').val('');
    modal.find('#estoque_minimo').val('');
    modal.modal('show');

}
// Adicionamos um evento para o formulário de produtos
$(document).ready(function() {
    $('#meuModal').on('hide.bs.modal', function(event) {

        // Obtemos os dados do formulário
        var produtosId = $('#produtosId').val();
        var nome = $('#nome').val();
        var categoria = $('#categoria').val();
        var descricao = $('#descricao').val();
        var valor_compra = $('#valor_compra').val();
        var valor_venda = $('#valor_venda').val();
        var estoque_minimo = $('#estoque_minimo').val();


        // Validar campos aqui, se necessário
        if (!nome || !categoria || !descricao || !valor_compra || !valor_venda|| !estoque_minimo ) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return; //aqio 
            // Impedir o fechamento do modal
            event.preventDefault();
        }





        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('produtosId', produtosId);
        formData.append('nome', nome);
        formData.append('categoria', categoria);
        formData.append('descricao', descricao);
        formData.append('valor_compra', valor_compra);
        formData.append('valor_venda', valor_venda);
        formData.append('estoque_minimo', estoque_minimo);

        // Console log dos dados enviados via AJAX
        console.log('Dados enviados via AJAX:');
        console.log('produtosId: ' + produtosId);
        console.log('nome: ' + nome);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'produtos_produtos_inserir.php',
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
function excluirprodutos(id) {
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
                url: 'produtos_produtos_excluir.php',
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


