<?php include "layout/header.php" ?>
<main>
<script src="cadastro_formas_pagamento.js"></script>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
            <a class="btn btn-primary" onclick='openCreateModal()'><i class="fa fa-plus" aria-hidden="true"></i> Nova forma de pgto</a>
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

                        <form id="formas_pagamentoForm" method="POST">

                            <!-- Adicionamos um campo oculto para armazenar o ID do contrato em caso de edição -->
                            <input type="hidden" id="formas_pagamentoId" name="formas_pagamentoId">
                                <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="taxa" class="form-label">Taxa (%)</label>
                                        <input type="text" class="form-control" id="taxa" name="taxa" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar</button>
                                    <a class="btn btn-danger" href="formas_pagamento.php">Cancelar</a>
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
                            <th>Taxa</th>
                            <th>Ações</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                    <?php
                        try {
                        // Consulta SQL SELECT
                        $sql = "SELECT * FROM formas_pagamento WHERE ativo= 1 ";

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
                            echo "<td>{$row['taxa']}</td>";
                            echo "<td>
                            <center>
                            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['taxa']}\")' title='Editar'>
                            <i class='bi bi-pencil-square'></i>
                            </a>
                        
                            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluirFormas_pagamento($row[id])' title='Deletar'>
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