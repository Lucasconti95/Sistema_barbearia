<?php include "layout/header.php" ?>
<main>
<script src="cadastro_acesso.js"></script>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
            <a class="btn btn-primary" onclick='openCreateModal()'><i class="fa fa-plus" aria-hidden="true"></i> Novo acesso</a>
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

                        <form id="acessoForm" method="POST">

                            <!-- Adicionamos um campo oculto para armazenar o ID do contrato em caso de edição -->
                            <input type="hidden" id="acessoId" name="acessoId">
                                <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="chave" class="form-label">Chave</label>
                                        <input type="text" class="form-control" id="chave" name="chave" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="grupo" class="form-label">Grupo</label>
                                        <select class="form-select" id="grupo" name="grupo" required>
                                            <option value="pessoas">Pessoas</option>
                                            <option value="cadastro">Cadastro</option>
                                            <option value="produtos">Produtos</option>
                                            <option value="financeiro">Financeiro</option>
                                            <option value="agendamentos">Agendamentos</option>
                                            <option value="relatorios">Relatórios</option>
                                            <option value="dados_do_site">Dados do site</option>    
                                            
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">Salvar</button>
                                    <a class="btn btn-danger" href="cadastro_acesso.php">Cancelar</a>
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
                            <th>Chave</th>
                            <th>Grupo</th>
                            <th>Ações</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                    <?php
                        try {
                        // Consulta SQL SELECT
                        $sql = "SELECT * FROM acesso WHERE ativo= 1 ";

                        // Preparação da consulta
                        $stmt = $pdo->prepare($sql);

                        // Execução da consulta
                        $stmt->execute();

                        // Obtenção dos resultados
                        $rows = $stmt->fetchAll();

                        // Exibição dos resultados dentro da tabela HTML  nome, valentia, categoria, dias retorno, comissao tempo extimado
                        foreach ($rows as $row) {
                        echo "<tr>";
                            echo "<td>{$row['id']}</td>";
                            echo "<td>{$row['nome']}</td>";
                            echo "<td>{$row['chave']}</td>";
                            echo "<td>{$row['grupo']}</td>";
                            echo "<td>
                            <center>
                            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['chave']}\", \"{$row['grupo']}\")' title='Editar'>
                            <i class='bi bi-pencil-square'></i>
                            </a>
                        
                            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluiracesso($row[id])' title='Deletar'>
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