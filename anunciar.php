<?php
$_titulo = "Novo anúncio";
include("_header.php");
?>

<script type="text/javascript">
    $(document).ready(function(){
        $('#selectAnimal').change(function(){
            $('#selectRaca').html("<option value='' >Carregando...</option>");
            var html_raca = "<option value=''>Selecione uma raça</option>";
            $.getJSON( '_listaracas.php?id=' + $(this).val(), function(resposta ) {
                if(resposta[0].status == 'OK'){
                    for (var i = 1; i < resposta.length; i++) {
                        html_raca += '<option value="'+resposta[i].idRaca+'">' + resposta[i].nomeRaca+ '</option>';
                    }
                }else{
                    $('#selectRaca').html("<option value=''></option>");
                }
                $('#selectRaca').html(html_raca);
            });
        });
    });
</script>
<main role="main">

<?php
if(@$_GET['sit'] == "perdido"){
    include("_secaoperdido.php");
}elseif (@$_GET['sit'] == "encontrado"){
    include("_secaoencontrado.php");
}else{
    include("_secaoinicio.php");
}
?>

</main>

<?php include("_footer.php"); ?>
