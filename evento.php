<?php
if(isset($_SERVER['HTTP_REFERER'])){
require_once("classes/listar.php");
$objListar = new Listar();
    if (isset($_GET["editar"])) {
        if(isset($_GET["id"])){
            ?>
            <?php if($objListar->mostrarEvento($_GET["id"])){foreach($objListar->mostrarEvento($_GET["id"]) as $mostra){ ?>
            <script type="text/javascript">
                $(document).ready(function(){
                    $('#selectAnimal').val(<?php echo $mostra['idAnimal']; ?>);
                    var idRacabanco = <?php echo $mostra['idRaca']; ?>;
                    var html_raca = "<option value=''>Selecione uma raça</option>";
                    $.getJSON( '_listaracas.php?id=' + <?php echo $mostra['idAnimal']; ?>, function(resposta ) {
                        if(resposta[0].status == 'OK'){
                            for (var i = 1; i < resposta.length; i++) {
                                html_raca += '<option value="' +resposta[i].idRaca +'"'+ (resposta[i].idRaca == idRacabanco ? 'selected="selected"' : '') + '>'+resposta[i].nomeRaca+ '</option>';

                            }
                        }else{
                            $('#selectRaca').html("<option value=''></option>");
                        }
                        $('#selectRaca').html(html_raca);
                    });
                });
                /******/
                $('#selectAnimal').change(function(){
                    $('#selectRaca').html("<option value='' >Carregando...</option>");
                    var html_raca = "<option value=''>Selecione uma raça</option>";
                    $.getJSON( '_listaracas.php?id=' + $(this).val(), function(resposta ) {
                        if(resposta[0].status == 'OK'){
                            for (var i = 1; i < resposta.length; i++) {
                                html_raca += '<option value="'+resposta[i].idRaca+'" >' + resposta[i].nomeRaca+ '</option>';
                            }
                        }else{
                            $('#selectRaca').html("<option value=''></option>");
                        }
                        $('#selectRaca').html(html_raca);
                    });
                });
            </script>
            <form class="was-validated" method="post" enctype="multipart/form-data" action="aprovacao.php">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ID: <?php echo "{$mostra['idEvento']}" ?> - <?php echo "{$mostra['nome']}" ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputNome">Nome</label>
                        <input type="text" name="formulario[]" class="form-control <?php if($mostra['idSituacao'] == 1){echo "is-invalid";} ?>" id="inputNome" value="<?php echo "{$mostra['nome']}" ?>" <?php if($mostra['idSituacao'] == 1){echo "required";} ?>>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputIdade">Idade</label>
                        <input type="text" name="formulario[]" class="form-control <?php if($mostra['idSituacao'] == 1){echo "is-invalid";} ?>" id="inputIdade" value="<?php echo "{$mostra['idade']}" ?>" <?php if($mostra['idSituacao'] == 1){echo "required";} ?>>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textareaCaracteristicas">Características</label>
                    <textarea name="formulario[]" class="form-control is-invalid" id="textareaCaracteristicas" required><?php echo "{$mostra['caracteristicas']}" ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputLocal">Local</label>
                        <input type="text" name="formulario[]" class="form-control is-invalid" id="inputLocal" value="<?php echo "{$mostra['local']}" ?>" required>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputData">Data</label>
                        <input type="date" name="formulario[]" class="form-control is-invalid" id="inputData" value="<?php echo "{$mostra['dataEvento']}" ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPessoa">Pessoa</label>
                        <input type="text" name="formulario[]" class="form-control is-invalid" id="inputPessoa" value="<?php echo "{$mostra['pessoa']}" ?>" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputContato">Contato</label>
                        <input type="text" name="formulario[]" class="form-control is-invalid" id="inputContato" value="<?php echo "{$mostra['contato']}" ?>" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="selectAnimal">Espécie</label>
                        <select id="selectAnimal" class="custom-select" required>
                            <option value="">Selecione uma opção</option>
                            <?php if($objListar->listarAnimal()){foreach($objListar->listarAnimal() as $lista){ ?><option value="<?php echo $lista['idAnimal']; ?>" <?php echo ($lista['idAnimal'] == $mostra['idAnimal'] ? "selected" : ""); ?>><?php echo htmlspecialchars($lista['nomeAnimal']) ?></option><?php }}?>
                        </select>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="selectRaca">Raça</label>
                        <select id="selectRaca" name="formulario[]" class="custom-select" required>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" name="formulario[]" value="<?php echo "{$mostra['idEvento']}" ?>">Aprovar</button>
            </div>
        </div>
    </form>
            <?php } ?>
<?php }}}
    if (isset($_GET["ver"])) {
    if(isset($_GET["id"])){
        if($objListar->mostrarEvento($_GET["id"])){foreach($objListar->mostrarEvento($_GET["id"]) as $mostra){ ?>
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">ID: <?php echo "{$mostra['idEvento']}" ?> - <?php echo "{$mostra['nome']}" ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-row">
                    <div class="form-group col-md-9">
                        <label for="inputNome">Nome</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['nome']}" ?>" readonly>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputIdade">Idade</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['idade']}" ?>" readonly>
                    </div>
                </div>
                <div class="form-group">
                    <label for="textareaCaracteristicas">Características</label>
                    <textarea class="form-control" readonly><?php echo "{$mostra['caracteristicas']}" ?></textarea>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-8">
                        <label for="inputLocal">Local</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['local']}" ?>" readonly>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputData">Data</label>
                        <input type="date" class="form-control" value="<?php echo "{$mostra['dataEvento']}" ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputPessoa">Pessoa</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['pessoa']}" ?>" readonly>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputContato">Contato</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['contato']}" ?>" readonly>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="selectAnimal">Espécie</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['nomeAnimal']}" ?>" readonly>
                    </div>
                    <div class="form-group col-md-8">
                        <label for="selectRaca">Raça</label>
                        <input type="text" class="form-control" value="<?php echo "{$mostra['nomeRaca']}" ?>" readonly>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    <?php } ?>
    <?php }}} ?>
<?php } ?>