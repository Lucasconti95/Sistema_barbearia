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
                <form id="form-dias">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Serviço</label>
                                <select class="form-control sel3" id="servico" name="servico" style="width:100%;" required="">
                                    <option value="0">Selecione</option>
                                    <option value="2">Barba</option>
                                    <option value="1">Corte</option>
                                    <option value="10">Corte + Barba</option>
                                    <option value="5">Hidrataçao</option>
                                    <option value="4">Luzes</option>
                                    <option value="8">Mão e Pé</option>
                                    <option value="9">Unha de Gel</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <button type="submit" class="btn btn-primary" style="margin-top:20px">Salvar</button>
                        </div>

                        <input type="hidden" name="id" id="id_dias" value="6">

                    </div>
                </form>
            </div>
            <!-- Fim Form -->

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