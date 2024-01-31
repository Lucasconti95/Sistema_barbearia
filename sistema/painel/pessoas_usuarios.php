<?php include "layout/header.php" ?>
<main>
<script src="pessoas_usuarios.js"></script>
    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
            <a class="btn btn-primary" onclick='openCreateModal()'><i class="fa fa-plus" aria-hidden="true"></i> Novo usuario</a>
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

                        <form id="usuarioForm" method="POST">

                             <!-- Adicionamos um campo oculto para armazenar o ID do contrato em caso de edição -->
                             <input type="hidden" id="usuarioId" name="usuarioId">

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
                                        <input type="tel" class="form-control" id="telefone" name="telefone" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nivel" class="form-label">Nível</label>
                                        <select class="form-select" id="nivel" name="nivel" required>
                                        <option value="" disabled selected>Selecione</option>
                                            <option value="administrador">Administrador</option>
                                            <option value="gerente">Gerente</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                </div>

                                <!-- Terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nivel" class="form-label">Atendimento</label>
                                        <select class="form-select" id="atendimento" name="atendimento" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="sim">Sim</option>
                                            <option value="nao">Não</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>

                                </div>

                                <!-- Quarta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <label for="foto" class="form-label">Foto</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="preview" class="form-label"></label>
                                        <img src="https://barbearia.hugocursos.com.br/sistema/painel/img/perfil/sem-foto.jpg" id="preview" class="img-fluid" alt="Prévia da imagem" width="85px">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar</button>
                                    <a class="btn btn-danger" href="pessoas_usuarios.php">Cancelar</a>
                                    <!-- Outros botões do modal, se necessário -->
                                </div>
                            </form>

                        </div>
                       
                    </div>
                </div>
            </div>
            <!-- Fim Modal-->


            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Telefone</th>
                            <th>CPF</th>
                            <th>Nivel</th>
                            <th>Endereço</th>
                            <th>Atendimento</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        try {
                        // Consulta SQL SELECT
                        $sql = "SELECT * FROM usuarios WHERE ativo= 1 ";

                        // Preparação da consulta
                        $stmt = $pdo->prepare($sql);

                        // Execução da consulta
                        $stmt->execute();

                        // Obtenção dos resultados
                        $rows = $stmt->fetchAll();

                        // Exibição dos resultados dentro da tabela HTML
                        foreach ($rows as $row) {
                        echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['nome']}</td>";
                            echo "<td>{$row['email']}</td>";
                            echo "<td>{$row['telefone']}</td>";
                            echo "<td>{$row['cpf']}</td>";
                            echo "<td>{$row['nivel']}</td>";
                            echo "<td>{$row['endereco']}</td>";
                            echo "<td>{$row['atendimento']}</td>";
                            echo "<td>
                            <center>
                            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['email']}\", \"{$row['telefone']}\", \"{$row['cpf']}\", \"{$row['nivel']}\", \"{$row['endereco']}\", \"{$row['atendimento']}\")' title='Editar'>
                            <i class='bi bi-pencil-square'></i>
                            </a>
                        
                            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluirUsuario($row[id])' title='Deletar'>
                            <i class='bi bi-trash3'></i>
                        </a>
                            </center>
                        </td>";
                            echo "</tr>";
                        }
                        } catch (PDOException $e) {
                        die("Erro na consulta: " . $e->getMessage());
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</main>
<?php include "layout/footer.php" ?>