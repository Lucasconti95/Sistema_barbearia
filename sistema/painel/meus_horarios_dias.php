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
                            <label for="exampleInputEmail1">Dia</label>
                            <select class="form-control" id="dias" name="dias" required="">
                                <option value="Segunda-Feira">Segunda-Feira</option>
                                <option value="Terça-Feira">Terça-Feira</option>
                                <option value="Quarta-Feira">Quarta-Feira</option>
                                <option value="Quinta-Feira">Quinta-Feira</option>
                                <option value="Sexta-Feira">Sexta-Feira</option>
                                <option value="Sábado">Sábado</option>
                                <option value="Domingo">Domingo</option>


                            </select>
                        </div>
                    </div>

                    <div class="col-md-4" align="center">
                        <label for="exampleInputEmail1">(Início) Jornada de Trabalho (Final)</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="time" name="inicio" class="form-control" id="inicio" required="">
                            </div>

                            <div class="col-md-6">

                                <input type="time" name="final" class="form-control" id="final" required="">

                            </div>
                        </div>

                    </div>

                    <div class="col-md-4" align="center">
                        <label for="exampleInputEmail1">(Início) Intervalo de Almoço (Final)</label>
                        <div class="row">
                            <div class="col-md-6">
                                <input type="time" name="inicio_almoco" class="form-control" id="inicio_almoco">
                            </div>

                            <div class="col-md-6">

                                <input type="time" name="final_almoco" class="form-control" id="final_almoco">

                            </div>
                        </div>

                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary" style="margin-top:20px">Salvar</button>
                    </div>

                    <input type="hidden" name="id" id="id_dias" value="6">

                    <input type="hidden" name="id_d" id="id_d">

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