<?php include "layout/header.php" ?>
<main>

    <div class="container-fluid px-4">

        <div class="card mb-4">
            <div class="card-body">
            </div>
        </div>
        <div class="card mb-4">

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