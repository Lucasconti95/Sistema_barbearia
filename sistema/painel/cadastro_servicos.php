<?php include "layout/header.php" ?>
<main>
<script src="cadastro_servicos.js"></script>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="fa fa-plus" aria-hidden="true"></i> Novo Serviço</a>
            </div>
            <!-- Fim Botão Modal -->


            <!-- Inicio Modal-->
            <div class="modal fade" id="meuModal" tabindex="-1" aria-labelledby="meuModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">Inserir Serviço</h4>
                        </div>
                        <div class="modal-body">

                        <form id="servicoForm" method="POST">

                        <!-- Adicionamos um campo oculto para armazenar o ID do contrato em caso de edição -->
                            <input type="hidden" id="servicoId" name="servicoId">
                                <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="valor" class="form-label">Valor</label>
                                        <input type="text" class="form-control" id="valor" name="valor" required>
                                    </div>
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="categoria" class="form-label">Categoria</label>
                                        <select class="form-select" id="categoria" name="categoria" required>
                                            <option value="corte">Corte</option>
                                            <option value="barba">Barba</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="dias_retorno" class="form-label">Dias Retorno</label>
                                        <input type="text" class="form-control" id="dias_retorno" name="dias_retorno" required>
                                    </div>
                                </div>

                                <!-- Terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <label for="comissao" class="form-label">Comissão (%)</label>
                                        <input type="text" class="form-control" id="comissao" name="comissao">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="tempo_extimado" class="form-label">Tempo Extimado</label>
                                        <input type="text" class="form-control" id="tempo_extimado" name="tempo_extimado">
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
                            <th>Valor</th>
                            <th>Categoria</th>
                            <th>Dias_Retorno</th>
                            <th>Comissao</th>
                            <th>Tempo_Extimado</th>
                            <th>Ações</th>
                        </tr>
                       
                    </thead>
                    <tbody>
                    <?php
                        try {
                        // Consulta SQL SELECT
                        $sql = "SELECT * FROM servicos WHERE ativo= 1 ";

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
                            echo "<td>{$row['valor']}</td>";
                            echo "<td>{$row['categoria']}</td>";
                            echo "<td>{$row['dias_retorno']}</td>";
                            echo "<td>{$row['comissao']}</td>";
                            echo "<td>{$row['tempo_extimado']}</td>";
                            echo "<td>
                            <center>
                            <a class='btn btn-sm btn-primary' onclick='openEditModal({$row['id']}, \"{$row['nome']}\", \"{$row['valor']}\", \"{$row['categoria']}\", \"{$row['dias_retorno']}\", \"{$row['comissao']}\", \"{$row['tempo_extimado']}\")' title='Editar'>
                            <i class='bi bi-pencil-square'></i>
                            </a>
                        
                            <a class='btn btn-sm btn-danger' href='javascript:void(0);' onclick='excluirservico($row[id])' title='Deletar'>
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