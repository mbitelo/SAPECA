<?php
if(@$_GET['sit'] == "perdido"){
$sit = 1;
$texto = "perdidos";
}elseif (@$_GET['sit'] == "encontrado"){
$sit = 2;
$texto = "encontrados";
}else{
    $sit = 0;
}
$_titulo = "Listagem de {$texto}";
include("_header.php");


// definir o numero de itens por pagina
$itens_por_pagina = 3;

// pegar a pagina atual
$pagina = isset($_GET['pagina']) ? intval($_GET['pagina']) : "1";

// definir numero de páginas
$num_paginas = ceil(count($objListar->listarEvento($sit, null, true, null))/$itens_por_pagina);

$limit = ($pagina-1)*$itens_por_pagina.", ".$itens_por_pagina;

?>
<?php if($sit){ ?>
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
            <h1>Todos <?php echo $texto; ?></h1><br>
            <div class="row">
                <?php if($objListar->listarEvento($sit, "DESC", true, "$limit")){foreach($objListar->listarEvento($sit,"DESC", true,"$limit") as $lista){ ?>
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
                                    <small class="text-muted">publicado <?php echo "{$objListar->tempo($lista['dataPost'])}" ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }}?>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="?sit=<?php echo $_GET['sit']; ?>&pagina=1" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    for($i=1;$i<=$num_paginas;$i++){
                        $estilo = "";
                        if($pagina == $i)
                            $estilo = "active";
                        ?>
                        <li class="page-item <?php echo $estilo; ?>"><a class="page-link" href="?sit=<?php echo $_GET['sit']; ?>&pagina=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php } ?>
                    <li class="page-item">
                        <a class="page-link" href="?sit=<?php echo $_GET['sit']; ?>&pagina=<?php echo $num_paginas; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

</main>

<?php }else{ ?>
    erro
    <?php } ?>
<?php include("_footer.php"); ?>