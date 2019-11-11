<?php
$_titulo = "Aprovar anúncio";
include("_header.php");
?>
<script>
    $('body').on('click', '[data-toggle="modal"]', function(){
        $($(this).data("target")+' .modal-dialog').load($(this).data("remote"));
    });
</script>


<!-- Model modal -->
<div class="modal fade" id="myModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
    </div>
</div>


<main role="main">
    <div class="album py-5 bg-light">
        <div class="container">
            <?php if(@$_SESSION["logado"]){ ?>
            <?php if(!empty($_POST["formulario"])){
                $objListar->publicarEvento($_POST["formulario"]);
                ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <h4 class="alert-heading">Anúncio Aprovado!</h4>
                    <p>Esta anúncio já foi aprovado e publicado para que toda a comunidade do SAPECA possa vizualidar e ajudar da maneira possivel. Estamos torcedo muito para que esse pet volte logo para sua familia.</p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>
            <h1>Pendente de Aprovação</h1><br>
            <div class="row"><?php if($objListar->listarEvento(0, "DESC", 0)){foreach($objListar->listarEvento(0, "DESC", 0) as $lista){ ?>
                <div class="col-md-3">
                    <div class="card mb-3 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="150" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><image width="100%" height="150" xlink:href="<?php echo "imagens/{$lista['imagem']}" ?>" preserveAspectRatio="none" /><text x="50%" y="90%" fill="#fff" stroke="#000" font-size="48px" dy=".3em"><?php echo htmlspecialchars($lista['nome']) ?></text></svg>
                        <div class="card-body">
                            <p class="card-text"><?php echo "{$lista['nomeAnimal']}" ?>, <?php echo "{$lista['nomeRaca']}" ?><br><?php echo ($lista['idSituacao'] == "1") ? "Perdido" : "Encontrado"; ?>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-remote="evento.php?editar&id=<?php echo "{$lista['idEvento']}" ?>" data-target="#myModel">Ver mais</button>
                                </div>
                                <small class="text-muted"><?php echo "{$objListar->MYSQLparaPTBR($lista['dataEvento'])}" ?></small>
                            </div>
                        </div>
                    </div>
                </div><?php }}else{?>
            </div>
            <div class="alert alert-success" role="alert">
                Não temos publicações pendentes de aprovação!
            </div>
        <?php } ?>
        </div>
    </div>
    <?php } else { ?>
    <form class="form-signin text-center" method="post" name="senha" action="aprovacao.php">
        <img class="mb-4" src="assets/img/login.png" alt="login" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Autenticação</h1>
        <?php if($senhaerrada){echo '<div class="alert alert-danger" role="alert">Senha errada</div>';} ?>
        <label for="inputPassword" class="sr-only">Senha</label>
        <input type="password" id="inputPassword" class="form-control" name="senha" placeholder="Senha" required autofocus>
        <br>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
    </form>
    <?php } ?>

</main>

<?php include("_footer.php"); ?>



