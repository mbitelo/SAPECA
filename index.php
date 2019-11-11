<?php include("_header.php");
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

    <?php include("_secaoinicio.php");?>

    <div class="album py-5 bg-light">
        <div class="container">
            <?php
            if(!empty($_POST)){
                $objListar->salvarEvento($_POST["formulario"], $_FILES);
            }
            ?>
            <h1>Últimos perdidos <small class="subtitulo"><a href="todos.php?sit=perdido">ver todos</a></small></h1><br>
            <div class="row">
                <?php if($objListar->listarEvento(1, "DESC", true,3)){foreach($objListar->listarEvento(1,"DESC", true,3) as $lista){ ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><image width="100%" height="225" xlink:href="<?php echo "imagens/{$lista['imagem']}" ?>" preserveAspectRatio="none" /><text x="50%" y="90%" fill="#fff" stroke="#000" font-size="48px" dy=".3em"><?php echo htmlspecialchars($lista['nome']) ?></text></svg>
                        <div class="card-body">
                            <p class="card-text"><?php echo "{$lista['nomeAnimal']}" ?>, <?php echo "{$lista['nomeRaca']}" ?><br>
                                Local: <?php echo "{$lista['local']}" ?><br>
                                Data: <?php echo "{$objListar->MYSQLparaPTBR($lista['dataEvento'])}" ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-remote="evento.php?ver&id=<?php echo "{$lista['idEvento']}" ?>" data-target="#myModel">Ver mais</button>
                                </div>
                                <small class="text-muted">postado <?php echo "{$objListar->tempo($lista['dataPost'])}" ?></small>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }}?>
            </div>

            <h1>Ultimos encontrados <small class="subtitulo"><a href="todos.php?sit=encontrado">ver todos</a></small></h1><br>
            <div class="row">
                <?php if($objListar->listarEvento(2, "DESC", true)){foreach($objListar->listarEvento(2,"DESC", true) as $lista){ ?>
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img"><image width="100%" height="225" xlink:href="<?php echo "imagens/{$lista['imagem']}" ?>" preserveAspectRatio="none" /><text x="50%" y="90%" fill="#fff" stroke="#000" font-size="48px" dy=".3em"><?php echo htmlspecialchars($lista['nome']) ?></text></svg>
                        <div class="card-body">
                            <p class="card-text"><?php echo "{$lista['nomeAnimal']}" ?>, <?php echo "{$lista['nomeRaca']}" ?><br>
                                Local: <?php echo "{$lista['local']}" ?><br>
                                Data: <?php echo "{$objListar->MYSQLparaPTBR($lista['dataEvento'])}" ?></p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-remote="evento.php?ver&id=<?php echo "{$lista['idEvento']}" ?>" data-target="#myModel">Ver mais</button>
                                </div>
                                <small class="text-muted">postado <?php echo "{$objListar->tempo($lista['dataPost'])}" ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php }}?>
            </div>
        </div>
    </div>

</main>

<?php include("_footer.php"); ?>
