<?php include "layout/header.php" ?>
<main>
<script src="produtos_produtos.js"></script>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
            <a class="btn btn-primary" onclick='openCreateModal()'><i class="fa fa-plus" aria-hidden="true"></i> Novo Produto</a>
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

                        <form id="produtosform" method="POST">
                            <!-- Adicionamos um campo oculto para armazenar o ID do contrato em caso de edição -->
                            <input type="hidden" id="produtosId" name="produtosId">
                                <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select class="form-select" id="categoria" name="categoria" required>
                                            <option value="pomadas">Pomadas</option>
                                            <option value="creme">Creme</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="descricao" class="form-label">Descrição</label>
                                        <input type="text" class="form-control" id="descricao" name="descricao">
                                    </div>
                                </div>

                                <!-- Terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="valor_compra" class="form-label">Valor Compra</label>
                                        <input type="text" class="form-control" id="valor_compra" name="valor_compra">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="valor_venda" class="form-label">Valor Venda</label>
                                        <input type="text" class="form-control" id="valor_venda" name="valor_venda" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="estoque_minimo" class="form-label">Estoque Minimo</label>
                                        <input type="text" class="form-control" id="estoque_minimo" name="estoque_minimo" required>
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
                                    <a class="btn btn-danger" href="produtos_produtos.php">Cancelar</a>
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
                            <th>Categoria</th>
                            <th>Descrição</th>
                            <th>Valor_Compra</th>
                            <th>Valor_Venda</th>
                            <th>Estoque_Minimo</th>
                            <th>Ações</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                    <?php
                        try {
                        // Consulta SQL SELECT
                        $sql = "SELECT * FROM produtos WHERE ativo= 1 ";

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
                            echo "<td>{$row['categoria']}</td>";
                            echo "<td>{$row['descricao']}</td>";
                            echo "<td>{$row['valor_compra']}</td>";
                            echo "<td>{$row['valor_venda']}</td>";
                            echo "<td>{$row['estoque_minimo']}</td>";
                            echo "<td>
                            <center>
                            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['categoria']}\", \"{$row['descricao']}\", \"{$row['valor_compra']}\", \"{$row['valor_venda']}\", \"{$row['estoque_minimo']}\")' title='Editar'>
                            <i class='bi bi-pencil-square'></i>
                            </a>
                        
                            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluirprodutos($row[id])' title='Deletar'>
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