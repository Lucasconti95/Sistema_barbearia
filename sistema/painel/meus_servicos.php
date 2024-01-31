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
                <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#meuModal"><i class="fa fa-plus" aria-hidden="true"></i> Novo Serviço</a>
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
                                    <div class="col-md-6">
                                        <label for="nome" class="form-label">Nome</label>
                                        <input type="text" class="form-control" id="nome" name="nome" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="tel" class="form-control" id="telefone" name="telefone">
                                    </div>
                                </div>

                                <!-- Segunda linha -->
                                <div class="row mb-3">
                                    <div class="col-md-7">
                                        <label for="cpf" class="form-label">CPF</label>
                                        <input type="text" class="form-control" id="cpf" name="cpf" required>
                                    </div>
                                    <div class="col-md-5">
                                        <label for="cartoes" class="form-label">Cartões</label>
                                        <input type="text" class="form-control" id="cartoes" name="cartoes" required>
                                    </div>
                                </div>

                                <!-- Terceira linha -->
                                <div class="row mb-3">
                                    <div class="col-md-8">
                                        <label for="endereco" class="form-label">Endereço</label>
                                        <input type="text" class="form-control" id="endereco" name="endereco">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="nascimento" class="form-label">Nascimento:</label>
                                        <input type="date" class="form-control" id="nascimento" name="nascimento">
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
            <div class="card mb-4">
                <!-- Fomulario inicio-->
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-5" style="margin-bottom:5px;">
                            <div style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Inicial" class="fa fa-calendar-o"></i></small></span></div>
                            <div style="float:left; margin-right:20px">
                                <input type="date" class="form-control " name="data-inicial" id="data-inicial-caixa" value="2023-10-15" required="">
                            </div>

                            <div style="float:left; margin-right:10px"><span><small><i title="Data de Vencimento Final" class="fa fa-calendar-o"></i></small></span></div>
                            <div style="float:left; margin-right:30px">
                                <input type="date" class="form-control " name="data-final" id="data-final-caixa" value="2023-10-15" required="">
                            </div>
                        </div>


                        <div class="col-md-2" align="center">
                            <div>
                                <small>
                                    <a title="Conta de Ontem" class="text-muted" href="#" onclick="valorData('2023-10-14', '2023-10-14')"><span>Ontem</span></a> /
                                    <a title="Conta de Hoje" class="text-muted" href="#" onclick="valorData('2023-10-15', '2023-10-15')"><span>Hoje</span></a> /
                                    <a title="Conta do Mês" class="text-muted" href="#" onclick="valorData('2023-10-01', '2023-10-31')"><span>Mês</span></a>
                                </small>
                            </div>
                        </div>



                        <div class="col-md-3" align="center">
                            <div>
                                <small>
                                    <a title="Todos os Serviços" class="text-muted" href="#" onclick="buscarContas('')"><span>Todos</span></a> /
                                    <a title="Pendentes" class="text-muted" href="#" onclick="buscarContas('Não')"><span>Pendentes</span></a> /
                                    <a title="Pagos" class="text-muted" href="#" onclick="buscarContas('Sim')"><span>Pagos</span></a>
                                </small>
                            </div>
                        </div>


                        <div class="col-md-2" align="center">
                            <div>
                                <form action="rel/rel_comissoes_class.php" target="_blank" method="POST">

                                    <input type="hidden" name="dataInicial" id="dataInicial" value="2023-10-15">
                                    <input type="hidden" name="dataFinal" id="dataFinal" value="2023-10-15">
                                    <input type="hidden" name="pago" id="pago_rel" value="">
                                    <input type="hidden" name="funcionario" value="6">

                                    <button type="submit" class="text-danger link-botao"><i class="fa fa-file-pdf-o"></i> <span class="text-primary">Relatório</span></button>

                                </form>
                            </div>
                        </div>


                        <input type="hidden" id="buscar-contas">

                    </div>
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