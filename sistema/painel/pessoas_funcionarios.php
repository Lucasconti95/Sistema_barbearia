<?php include "layout/header.php" ?>
<?php include "config.php" ?>


<main>
<script src="pessoas_funcionarios.js"></script>
    <div class="container-fluid px-4">

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="fa fa-plus" aria-hidden="true"></i> Novo Funcionário</a>
            </div>
            <!-- Fim Botão Modal -->


            <!-- Inicio Modal-->
            <div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Inserir Registro</h4>
                        </div>
                        <div class="modal-body">

                        <form id="funcionarioForm"                                                                                                                                                         method="POST"> 

                            <!-- Adicionamos um campo oculto para armazenar o ID do contrato em ca                                                                                                                                                                             so de edição -->
                            <input type="hidden" id="funcionarioId" name="funcionarioId">                              
                            <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email" class="form-label">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cargo" class="form-label">Cargo</label>
                                        <select class="form-select" id="cargo" name="cargo" required>
                                            <option value="admin">Administrador</option>
                                            <option value="gerente">Gerente</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                </div>

                                <!-- Terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="atendimento" class="form-label">Atendimento</label>
                                        <select class="form-select" id="atendimento" name="atendimento" required>
                                            <option value="sim">Sim</option>
                                            <option value="não">Não</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tipo_chave_pix" class="form-label">Tipo Chave Pix</label>
                                        <select class="form-select" id="tipo_chave_pix" name="tipo_chave_pix" required>
                                            <option value="telefone">Telefone</option>
                                            <option value="email">Email</option>
                                            <option value="codigo">Codigo</option>
                                            <option value="cnpj">CNPJ</option>
                                            <option value="cpf">CPF</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="chave_pix" class="form-label">Chave Pix</label>
                                        <input type="text" class="form-control" id="chave_pix" name="chave_pix" required>
                                    </div>
                                </div>

                                <!-- Quarta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- Quinta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="intervalo_min" class="form-label">Intervalo Minutos</label>
                                        <input type="text" class="form-control" id="intervalo_min" name="intervalo_min" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="comissao" class="form-label">Comissão (exeto padrão)</label>
                                        <input type="text" class="form-control" id="comissao" name="comissao" required>
                                    </div>
                                </div>

                                <!-- Sexta linha -->
                                <!-- <div class="row mb-3">
                                    <div class="col-md-9">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="preview" class="form-label"></label>
                                        <img src="https://barbearia.hugocursos.com.br/sistema/painel/img/perfil/sem-foto.jpg" id="preview" class="img-fluid" alt="Prévia da imagem" width="85px">
                                    </div>
                                </div> -->
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar</button>
                                    <a class="btn btn-danger" href="pessoas_funcionarios.php">Cancelar</a>
                                    <!-- Outros botões do modal, se necessário -->
                                </div>
                            </form>

                        </div>
                        
                    </div>
                </div>
            </div>
            <!-- Fim Modal-->


            <div class="card-body">
            <table id="datatablesSimple" class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Cargo</th>
                            <th>Atendimento</th>
                            <th>Tipo de chave</th>
                            <th>Chave Pix</th>
                            <th>Endereço</th>
                            <th>Intervalo</th>
                            <th>Comissão</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$result = mysqli_query($conexao, "SELECT * FROM funcionarios WHERE ativo = 1");

// Itera sobre os resultados da busca e exibe cada funcionário em uma linha da tabela
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>";
    echo "<td>" . $row['id'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['telefone'] . "</td>";
    echo "<td>" . $row['cpf'] . "</td>";
    echo "<td>" . $row['cargo'] . "</td>";
    echo "<td>" . $row['atendimento'] . "</td>";
    echo "<td>" . $row['tipo_chave_pix'] . "</td>";
    echo "<td>" . $row['chave_pix'] . "</td>";
    echo "<td>" . $row['endereco'] . "</td>";
    echo "<td>" . $row['intervalo_min'] . "</td>";
    echo "<td>" . $row['comissao'] . "</td>";
    echo "<td>
        <center>
            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['email']}\", \"{$row['telefone']}\", \"{$row['cpf']}\", \"{$row['cargo']}\", \"{$row['atendimento']}\", \"{$row['tipo_chave_pix']}\", \"{$row['chave_pix']}\", \"{$row['endereco']}\", \"{$row['intervalo_min']}\", \"{$row['comissao']}\")' title='Editar'>
                <i class='bi bi-pencil-square'></i>
            </a>
            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluirFuncionario($row[id])' title='Deletar'>
                <i class='bi bi-trash3'></i>
            </a>
        </center>
    </td>";
    echo "</tr>";
}
?>

                    </tbody>
                </table>

            </div>
        </div>
    </div>

</main>
<?php include "layout/footer.php" ?>