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
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="fa fa-plus" aria-hidden="true"></i> Nova Compra</a>
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
                                <div class="col-md-5">
                                    <label for="nivel" class="form-label">Produto</label>
                                        <select class="form-select" id="nivel" name="nivel" required>
                                            <option value="administrador">Pix</option>
                                            <option value="gerente">Debito</option>
                                            <option value="gerente">Credito</option>
                                            <option value="gerente">Dinheiro</option>
                                                                        
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                    <label for="nivel" class="form-label">Fornecedor</label>
                                        <select class="form-select" id="nivel" name="nivel" required>
                                            <option value="administrador">Pix</option>
                                            <option value="gerente">Debito</option>
                                            <option value="gerente">Credito</option>
                                            <option value="gerente">Dinheiro</option>
                                                                        
                                            <!-- Adicione mais opções conforme necessário -->
                                        </select>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="nome" class="form-label">Quantidade</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <label for="telefone" class="form-label">Valor total da Compra</label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nascimento" class="form-label">Vencimento:</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nascimento" class="form-label">Pago Em:</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento">
                                    </div>
                                    
                                </div>

                                <!-- Terceira linha -->
                               
                                <div class="row mb-3">
                                    <div class="col-md-9">
                                        <label for="foto" class="form-label">Escolher Arquivo(Nota Fiscal)</label>
                                        <input type="file" class="form-control" id="foto" name="foto">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="preview" class="form-label"></label>
                                        <img src="https://barbearia.hugocursos.com.br/sistema/painel/img/perfil/sem-foto.jpg" id="preview" class="img-fluid" alt="Prévia da imagem" width="85px">
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Salvar</button>
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