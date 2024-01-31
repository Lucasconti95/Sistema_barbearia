<?php include "layout/header.php" ?>
<main>
<script src="pessoas_fornecedores.js"></script>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
            <a class="btn btn-primary" onclick='openCreateModal()'><i class="fa fa-plus" aria-hidden="true"></i> Novo fornecedor</a>
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

                            <form id="fornecedorForm" method="POST">

                             <!-- Adicionamos um campo oculto para armazenar o ID do contrato em caso de edição -->
                             <input type="hidden" id="fornecedorId" name="fornecedorId">
                                <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone">
                                    </div>
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <label for="tipo_chave_pix" class="form-label">Tipo Chave Pix</label>
                                        <select class="form-select" id="tipo_chave_pix" name="tipo_chave_pix" required>
                                            <option value="cpf">CPF</option>
                                            <option value="telefone">Telefone</option>
                                            <option value="email">Email</option>
                                            <option value="codigo">Codigo</option>
                                            <option value="cnpj">CNPJ</option>
                                            
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="chave_pix" class="form-label">Chave Pix</label>
                                        <input type="text" class="form-control" id="chave_pix" name="chave_pix" required>
                                    </div>
                                </div>

                                <!-- Terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar</button>
                                    <a class="btn btn-danger" href="pessoas_fornecedores.php">Cancelar</a>
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
                            <th>Telefone</th>
                            <th>Tipo_chave_pix</th>
                            <th>Chave_pix</th>
                            <th>Endereço</th>
                            <th>Ações</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                    <?php
                        try {
                        // Consulta SQL SELECT
                        $sql = "SELECT * FROM fornecedores WHERE ativo= 1 ";

                        // Preparação da consulta
                        $stmt = $pdo->prepare($sql);

                        // Execução da consulta
                        $stmt->execute();

                        // Obtenção dos resultados
                        $rows = $stmt->fetchAll();

                        // Exibição dos resultados dentro da tabela HTML  nome, telefone, tipo_chave_pix, chave_pix, endereco
                        foreach ($rows as $row) {
                        echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['nome']}</td>";
                            echo "<td>{$row['telefone']}</td>";
                            echo "<td>{$row['tipo_chave_pix']}</td>";
                            echo "<td>{$row['chave_pix']}</td>";
                            echo "<td>{$row['endereco']}</td>";
                            echo "<td>
                            <center>
                            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['telefone']}\", \"{$row['tipo_chave_pix']}\", \"{$row['chave_pix']}\", \"{$row['endereco']}\")' title='Editar'>
                            <i class='bi bi-pencil-square'></i>
                            </a>
                        
                            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluirFornecedor($row[id])' title='Deletar'>
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