<?php
require_once("classes/connection.php");


function intGet( $campo ){
    return isset( $_GET[$campo] ) ? (int)$_GET[$campo] : 1;
}
function retorno( $id )
{
    $sql = "SELECT `idRaca`, `nomeRaca` 
			FROM `raca` 
			WHERE `idAnimal` = {$id} ";
    $sql .= "ORDER BY `idRaca` ";
    $con = new Connection();
    $q = $con->Conectar()->query( $sql );


    $json = Array();
    if( $q->num_rows > 0 )
    {
        $json[] = Array('status' => "OK");
        while( $dados = $q->fetch_object() )
        {
            $json[]	= Array('nomeRaca'=> $dados->nomeRaca , 'idRaca'=> $dados->idRaca);
        }
    }
    else
        $json[]	= Array('nome'=> utf8_encode( 'nao encontrado' ), 'id'=> '0' );



    return json_encode( $json );
}

echo retorno(intGet('id'));