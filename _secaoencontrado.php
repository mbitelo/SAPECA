<section class="jumbotron text-center">
    <div class="container">
        <h1 class="jumbotron-heading">Que ótima notícia 👏🙌</h1>
        <p class="lead text-muted">E agora vamos divulgar para que este pet possa voltar sua casa e sua familia</p>
        <p>
            <a href="anunciar.php?sit=perdido" class="btn btn-danger my-2">Eu perdi meu pet :(</a>
        </p>
    </div>
</section>
<div class="album py-5 bg-light">
    <div class="container">
        <form class="was-validated" method="post" enctype="multipart/form-data" action="index.php">
            <div class="form-row">
                <div class="form-group col-md-9">
                    <label for="inputNome">Nome</label>
                    <input type="text" name="formulario[]" class="form-control" id="inputNome" placeholder="Como ele se chama">
                </div>
                <div class="form-group col-md-3">
                    <label for="inputIdade">Idade</label>
                    <input type="text" name="formulario[]" class="form-control" id="inputIdade" placeholder="X Meses ou Y anos">
                </div>
            </div>
            <div class="form-group">
                <label for="textareaCaracteristicas">Características</label>
                <textarea name="formulario[]" class="form-control is-invalid" id="textareaCaracteristicas" placeholder="Cor, tamanho de pêlo, cor da pelagem, fisionomia, marcas no corpo etc..." required></textarea>
            </div>
            <div class="form-row">
                <div class="form-group col-md-8">
                    <label for="inputLocal">Local</label>
                    <input type="text" name="formulario[]" class="form-control is-invalid" id="inputLocal" placeholder="Cidade, bairro, rua, ponto de referência..." required>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputData">Data</label>
                    <input type="date" name="formulario[]" class="form-control is-invalid" id="inputData" placeholder="data" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputPessoa">Pessoa</label>
                    <input type="text" name="formulario[]" class="form-control is-invalid" id="inputPessoa" placeholder="Nos diga como você se chama" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="inputContato">Contato</label>
                    <input type="text" name="formulario[]" class="form-control is-invalid" id="inputContato" placeholder="Telefone, e-mail..." required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="selectAnimal">Espécie</label>
                    <select id="selectAnimal" class="custom-select" required>
                        <option value="">Selecione uma espécie</option><?php if($objListar->listarAnimal()){foreach($objListar->listarAnimal() as $lista){ ?>
                            <option value="<?php echo htmlspecialchars($lista['idAnimal']) ?>"><?php echo htmlspecialchars($lista['nomeAnimal']) ?></option><?php }}?>
                    </select>
                </div>

                <div class="form-group col-md-8">
                    <label for="selectRaca">Raça</label>
                    <select id="selectRaca" name="formulario[]" class="custom-select" required>
                        <option value="">Selecione uma espécie</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="inputZip">Foto</label>
                <div class="custom-file">
                    <input type="file" name="arquivo" class="custom-file-input" id="validatedCustomFile" accept="image/x-png,image/gif,image/jpeg" required>
                    <label class="custom-file-label" for="validatedCustomFile">Escolha uma foto nítida</label>
                    <div class="valid-feedback">Tudo pronto, só enviar para a moderação</div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="formulario[]" value="2">Enviar</button>
        </form>
    </div>
</div>