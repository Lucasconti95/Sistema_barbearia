<?php include "layout/header.php" ?>
<main>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

            <!-- Botão Modal-->
            <div class="card-header">
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="fa fa-plus" aria-hidden="true"></i> Nova Campanha</a>
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

                            <form>
                                <!-- Primeira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="endereco" class="form-label">Titulo da Campanha</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="endereco" class="form-label">Mensagem (Até 500 Caracteres)</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 1</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 2</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 3</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- quarta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 4</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 5</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 6</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- quinta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 7</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="endereco" class="form-label">Item 8</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- quinta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="endereco" class="form-label">Mensagem de Conclusão (Até 500 Caracteres)</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                </div>

                                <!-- Sexta linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="foto" class="form-label">Foto (Formato PNG)</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="preview" class="form-label"></label>
                                        <img src="https://barbearia.hugocursos.com.br/sistema/painel/img/perfil/sem-foto.jpg" id="preview" class="img-fluid" alt="Prévia da imagem" width="85px">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="foto" class="form-label">Audio (Formato OGG)</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                </div>

                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Salvar</button>
                            <!-- Outros botões do modal, se necessário -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fim Modal-->


            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Nome</th>
                            <th>Email</th>
                            <th>Senha</th>
                            <th>Nível</th>
                            <th>Cadastro</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        try {
                            // Consulta SQL SELECT
                            $sql = "SELECT * FROM usuarios";

                            // Preparação da consulta
                            $stmt = $pdo->prepare($sql);

                            // Execução da consulta
                            $stmt->execute();

                            // Obtenção dos resultados
                            $usuarios = $stmt->fetchAll();

                            // Exibição dos resultados dentro da tabela HTML
                            foreach ($usuarios as $usuario) {
                                echo "<tr>";
                                echo "<td>{$usuario['nome']}</td>";
                                echo "<td>{$usuario['email']}</td>";
                                echo "<td>{$usuario['senha']}</td>";
                                echo "<td>{$usuario['nivel']}</td>";
                                echo "<td>{$usuario['data']}</td>";
                                echo "<td>BOTOES</td>"; // Substitua "BOTOES" pelos botões ou ações desejadas
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