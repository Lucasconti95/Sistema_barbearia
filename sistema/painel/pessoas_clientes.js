
// Função para abrir o modal com os dados do cliente a ser editado
function openEditModal(id, nome, telefone, cpf, cartoes, endereco, nascimento ) {
    var modal = $('#meuModal');


    modal.find('#myModalLabel').text('Editar cliente');
    modal.find('#clienteId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#telefone').val(telefone);
    modal.find('#cpf').val(cpf);
    modal.find('#cartoes').val(cartoes);
    modal.find('#endereco').val(endereco);
    modal.find('#nascimento').val(nascimento);
    modal.modal('show');
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');


    modal.find('#myModalLabel').text('Inserir cliente');
    modal.find('#clienteId').val(''); // Limpar o campo clienteId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#telefone').val('');
    modal.find('#cpf').val('');
    modal.find('#cartoes').val('');
    modal.find('#endereco').val('');
    modal.find('#nascimento').val('');
    modal.modal('show');
}

// Adicionamos um evento para o formulário de clientes
$(document).ready(function() {
    $('#meuModal').on('hide.bs.modal', function(event) {


        
        // Obtemos os dados do formulário
        var nome = $('#nome').val();
        var telefone = $('#telefone').val();
        var cpf = $('#cpf').val();
        var cartoes = $('#cartoes').val();
        var endereco = $('#endereco').val();
        var nascimento = $('#nascimento').val();

        // Validar campos aqui, se necessário
        if (!nome || !telefone || !cpf || !cartoes || !endereco || !nascimento ) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');

            // Impedir o fechamento do modal
            event.preventDefault();
        }
    });

    $('#clienteForm').submit(function(event) {
        event.preventDefault();

        // Obtemos os dados do formulário
        var clienteId = $('#clienteId').val();
        var nome = $('#nome').val();
        var telefone = $('#telefone').val();
        var cpf = $('#cpf').val();
        var cartoes = $('#cartoes').val();
        var endereco = $('#endereco').val();
        var nascimento = $('#nascimento').val();

        // Validar campos aqui, se necessário
        if (!nome || !telefone || !cpf || !cartoes || !endereco || !nascimento ) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return;
        }

        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('clienteId', clienteId);
        formData.append('nome', nome);
        formData.append('telefone', telefone);
        formData.append('cpf', cpf);
        formData.append('cartoes', cartoes);
        formData.append('endereco', endereco);
        formData.append('nascimento', nascimento);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'pessoas_clientes_inserir.php',
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
// Função para excluir o cliente

function excluirCliente(id) {
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
                url: 'pessoas_clientes_excluir.php',
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

