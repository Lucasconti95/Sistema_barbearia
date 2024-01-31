// Função para abrir o modal com os dados do funcionário a ser editado
function openEditModal(id, nome, email, telefone, cpf, cargo, atendimento, tipo_chave_pix, chave_pix, endereco, intervalo_min, comissao) {
    var modal = $('#meuModal');
    var form = $('#funcionarioForm');

    modal.find('#myModalLabel').text('Editar funcionario');
    modal.find('#funcionarioId').val(id);
    modal.find('#nome').val(nome);
    modal.find('#email').val(email);
    modal.find('#telefone').val(telefone);
    modal.find('#cpf').val(cpf);
    modal.find('#cargo').val(cargo);
    modal.find('#atendimento').val(atendimento);
    modal.find('#tipo_chave_pix').val(tipo_chave_pix);
    modal.find('#chave_pix').val(chave_pix);
    modal.find('#endereco').val(endereco);
    modal.find('#intervalo_min').val(intervalo_min);
    modal.find('#comissao').val(comissao);
    modal.modal('show');

    // Console log dos dados passados para openEditModal
    console.log('Dados passados para openEditModal:');
    console.log('ID: ' + id);
    console.log('Nome: ' + nome);
    console.log('Email: ' + email);
    console.log('Telefone: ' + telefone);
    console.log('CPF: ' + cpf);
    console.log('Cargo: ' + cargo);
    console.log('Atendimento: ' + atendimento);
    console.log('Tipo de Chave PIX: ' + tipo_chave_pix);
    console.log('Chave PIX: ' + chave_pix);
    console.log('Endereço: ' + endereco);
    console.log('Intervalo Min: ' + intervalo_min);
    console.log('Comissão: ' + comissao);
}

// Função para abrir o modal de criação
function openCreateModal() {
    var modal = $('#meuModal');
    var form = $('#funcionarioForm');

    modal.find('#myModalLabel').text('Inserir funcionario');
    modal.find('#funcionarioId').val(''); // Limpar o campo funcionariosId para garantir uma nova criação
    modal.find('#nome').val('');
    modal.find('#email').val('');
    modal.find('#telefone').val('');
    modal.find('#cpf').val('');
    modal.find('#cargo').val('');
    modal.find('#atendimento').val('');
    modal.find('#tipo_chave_pix').val('');
    modal.find('#chave_pix').val('');
    modal.find('#endereco').val('');
    modal.find('#intervalo_min').val('');
    modal.find('#comissao').val('');
    modal.modal('show');

    // Console log dos dados passados para openCreateModal
    console.log('Dados passados para openCreateModal:');
    console.log('ID: (vazio)');
    console.log('Nome: (vazio)');
    console.log('Email: (vazio)');
    console.log('Telefone: (vazio)');
    console.log('CPF: (vazio)');
    console.log('Cargo: (vazio)');
    console.log('Atendimento: (vazio)');
    console.log('Tipo de Chave PIX: (vazio)');
    console.log('Chave PIX: (vazio)');
    console.log('Endereço: (vazio)');
    console.log('Intervalo Min: (vazio)');
    console.log('Comissão: (vazio)');
}

$(document).ready(function() {
    // Adicionamos um evento para o formulário de funcionários
    $('#funcionarioForm').submit(function(event) {
        event.preventDefault();

        // Obtemos os dados do formulário
        var funcionarioId = $('#funcionarioId').val();
        var nome = $('#nome').val();
        var email = $('#email').val();
        var telefone = $('#telefone').val();
        var cpf = $('#cpf').val();
        var cargo = $('#cargo').val();
        var atendimento = $('#atendimento').val();
        var tipo_chave_pix = $('#tipo_chave_pix').val();
        var chave_pix = $('#chave_pix').val();
        var endereco = $('#endereco').val();
        var intervalo_min = $('#intervalo_min').val();
        var comissao = $('#comissao').val();

        // Console log dos dados obtidos do formulário no evento submit
        console.log('Dados obtidos do formulário no evento submit:');
        console.log('ID: ' + funcionarioId);
        console.log('Nome: ' + nome);
        console.log('Email: ' + email);
        console.log('Telefone: ' + telefone);
        console.log('CPF: ' + cpf);
        console.log('Cargo: ' + cargo);
        console.log('Atendimento: ' + atendimento);
        console.log('Tipo de Chave PIX: ' + tipo_chave_pix);
        console.log('Chave PIX: ' + chave_pix);
        console.log('Endereço: ' + endereco);
        console.log('Intervalo Min: ' + intervalo_min);
        console.log('Comissão: ' + comissao);

        // Validar campos aqui, se necessário
        if (!nome || !email || !telefone || !cpf || !cargo || !atendimento || !tipo_chave_pix || !chave_pix || !endereco || !intervalo_min || !comissao) {
            // Exibir mensagem de erro (opcional)
            console.log('Preencha todos os campos obrigatórios.');
            return;
        }

        // Criamos um objeto FormData com os dados do formulário
        var formData = new FormData();
        formData.append('funcionarioId', funcionarioId);
        formData.append('nome', nome);
        formData.append('email', email);
        formData.append('telefone', telefone);
        formData.append('cpf', cpf);
        formData.append('cargo', cargo);
        formData.append('atendimento', atendimento);
        formData.append('tipo_chave_pix', tipo_chave_pix);
        formData.append('chave_pix', chave_pix);
        formData.append('endereco', endereco);
        formData.append('intervalo_min', intervalo_min);
        formData.append('comissao', comissao);

        // Console log dos dados enviados via AJAX
        console.log('Dados enviados via AJAX:');
        console.log('funcionarioId: ' + funcionarioId);
        console.log('nome: ' + nome);

        // Utilizamos AJAX para enviar os dados para o script de inserção
        $.ajax({
            type: 'POST',
            url: 'pessoas_funcionarios_inserir.php',
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


// Função para excluir o Usuário
function excluirFuncionario(id) {
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
                url: 'pessoas_funcionarios_excluir.php',
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


