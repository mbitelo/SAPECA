<?php
require_once("connection.php");
class listar{
    private $conexaoSQL;
    function __construct(){
        $this->conexaoSQL = new Connection();
    }
    function listarAnimal(){
        $sql = $this->conexaoSQL->Conectar()->query("SELECT `idAnimal`, `nomeAnimal` FROM `animal` ");
        if ($sql->num_rows >= 1) {
            while($row = $sql->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return FALSE;
        }
    }
    function listarRaca($id){
        $sql = $this->conexaoSQL->Conectar()->query("SELECT `idRaca`, `nomeRaca` FROM `raca` where `idAnimal` = {$id}");
        if ($sql->num_rows >= 1) {
            while($row = $sql->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return FALSE;
        }
    }
    function listarEvento($situacao, $ordem = "ASC", $publicado, $qtd = NULL){
        $limit = isset($qtd) ? "LIMIT $qtd" : "";
        $situacao = ($situacao > 0) ? "and `e`.idSituacao = $situacao" : "";
        $sql = $this->conexaoSQL->Conectar()->query("SELECT `idEvento`, `nome`, `idade`, `caracteristicas`, `local`, `dataEvento`, `pessoa`, `contato`, `nomeRaca`, `nomeAnimal`, `imagem`, `dataPost`, `publicado`, `idSituacao` FROM `evento` `e` INNER JOIN `raca` `r` on `e`.`idRaca` = `r`.`idRaca` INNER JOIN `animal` `a` on `r`.`idAnimal` = `a`.`idAnimal` WHERE publicado = {$publicado} {$situacao} ORDER by `dataPost` {$ordem} {$limit}");
        if ($sql->num_rows >= 1) {
            while($row = $sql->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return FALSE;
        }
    }

    function mostrarEvento($id){
        $sql = $this->conexaoSQL->Conectar()->query("SELECT `idEvento`, `nome`, `idade`, `caracteristicas`, `local`, `dataEvento`, `pessoa`, `contato`, `nomeRaca`, `nomeAnimal`, `imagem`, `dataPost`, `publicado`, `idSituacao`, `a`.`idAnimal`, `e`.`idRaca` FROM `evento` `e` INNER JOIN `raca` `r` on `e`.`idRaca` = `r`.`idRaca` INNER JOIN `animal` `a` on `r`.`idAnimal` = `a`.`idAnimal` WHERE idEvento = {$id}");
        if ($sql->num_rows >= 1) {
            while($row = $sql->fetch_assoc()) {
                $rows[] = $row;
            }
            return $rows;
        } else {
            return FALSE;
        }
    }

    function publicarEvento($parametros){
        $sql = $this->conexaoSQL->Conectar()->query("UPDATE `evento` SET `nome` = '{$parametros[0]}', `idade` = '{$parametros[1]}', `caracteristicas` = '{$parametros[2]}', `local` = '{$parametros[3]}', `dataEvento` = '{$parametros[4]}', `pessoa` = '{$parametros[5]}', `contato` = '{$parametros[6]}', `idRaca` = '{$parametros[7]}', `publicado` = '1'  WHERE `idEvento` = {$parametros[8]};");
        if ($sql == 1) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function MYSQLparaPTBR($data){
        $DataTime = new DateTime($data);
        return $DataTime->format("d/m/Y");
    }

    function tempo($time){

        $now = strtotime(date('Y/m/d H:i:s'));
        $time = strtotime($time);
        $diff = $now - $time;

        $seconds = $diff;
        $minutes = round($diff / 60);
        $hours = round($diff / 3600);
        $days = round($diff / 86400);
        $weeks = round($diff / 604800);
        $months = round($diff / 2419200);
        $years = round($diff / 29030400);

        if ($seconds <= 60) return "1 min atrás";
        else if ($minutes <= 60) return $minutes==1 ?'1 min atrás':$minutes.' min atrás';
        else if ($hours <= 24) return $hours==1 ?'1 hora atrás':$hours.' horas atrás';
        else if ($days <= 7) return $days==1 ?'1 dia atras':$days.' dias atrás';
        else if ($weeks <= 4) return $weeks==1 ?'1 semana atrás':$weeks.' semanas atrás';
        else if ($months <= 12) return $months == 1 ?'1 mês atrás':$months.' meses atrás';
        else return $years == 1 ? 'um ano atrás':$years.' anos atrás';
    }

    function salvarEvento($array, $arquivo){


        // verifica se foi enviado um arquivo
        if (isset($arquivo['arquivo']['name']) && $arquivo['arquivo']['error'] == 0) {
            $arquivo_tmp = $arquivo['arquivo']['tmp_name'];
            $nome = $arquivo['arquivo']['name'];
            $extensao = pathinfo($nome, PATHINFO_EXTENSION); // Pega a extensão
            $extensao = strtolower($extensao); // Converte a extensão para minúsculo

            // Somente imagens, .jpg;.jpeg;.gif;.png
            // Aqui eu enfileiro as extensões permitidas e separo por ';'
            // Isso serve apenas para eu poder pesquisar dentro desta String
            if (strstr('.jpg;.jpeg;.gif;.png', $extensao)) {
                // Cria um nome único para esta imagem
                // Evita que duplique as imagens no servidor.
                // Evita nomes com acentos, espaços e caracteres não alfanuméricos
                $novoNome = uniqid(time()) . '.' . $extensao;

                // Concatena a pasta com o nome
                $destino = 'imagens/' . $novoNome;

                // tenta mover o arquivo para o destino
                if (@move_uploaded_file($arquivo_tmp, $destino)) {
                    $sql = $this->conexaoSQL->Conectar()->query("INSERT INTO evento VALUES(NULL, '$array[0]','$array[1]','$array[2]','$array[3]','$array[4]','$array[5]','$array[6]','$array[7]','$novoNome', NOW() - INTERVAL 3 HOUR, 0, $array[8]);");
                    if($sql == 1){
                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
  <h4 class="alert-heading">Muito bem!</h4>
  <p>Desejamos muita sorte para que esse pet volte encontre e volte logo para sua casa, com sua familia e as pessoas que estão sentindo sua falta neste momento. Até pedimos muita paciência para você e fique atento nos meios de contato, em breve pode surgir o tão esperado sinal.</p>
  <hr>
  <p class="mb-0">Este anúncio precisa passar por uma moderação a fim de confirmar se todos os dados são válidos antes de ser publicado.</p>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
                    } else { // senão, volta para tela inicial
                        echo '<div class="alert alert-danger" role="alert">Erro na inclusão<br><a href="./index.php">Voltar ao menu</a></div>';
                    }
                } else
                    echo '<div class="alert alert-danger" role="alert">Erro ao salvar o arquivo. Aparentemente você não tem permissão de escrita.</div>';
            } else
                echo '<div class="alert alert-danger" role="alert">Você poderá enviar apenas arquivos "*.jpg;*.jpeg;*.gif;*.png"</div>';
        } else
            echo '<div class="alert alert-danger" role="alert">Você não enviou nenhum arquivo!</div>';
    }
}