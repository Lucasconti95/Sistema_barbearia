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
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="fa fa-plus" aria-hidden="true"></i> Novo Agendamento</a>
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
                                <div class="col-md-4">
                                        <label for="nivel" class="form-label">Cliente</label>
                                        <select class="form-select" id="nivel" name="nivel" required>
                                            <option value="administrador">Cliente 1</option>
                                            <option value="gerente">Cliente 2</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nivel" class="form-label">Serviço</label>
                                        <select class="form-select" id="nivel" name="nivel" required>
                                            <option value="administrador">Corte</option>
                                            <option value="gerente">Barba</option>
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nascimento" class="form-label">Data:</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento">
                                    </div>
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label for="endereco" class="form-label">OBS(Máx 100 caracteres)</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
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