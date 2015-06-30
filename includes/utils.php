<?php
function do_output($status, $params){
    header('Content-Type: application/json');
    $output = Array();
    $output['status'] = $status;
    if(!$status){
#        http_response_code(404);
        $output['reason'] = $params;
   }
    else
        $output = array_merge($params, $output);
    echo json_encode($output);
    exit;
}

function get_quiz_questions(){
    $to_go = Array();
    while(1){
        $a = rand(1,10);
        if(!in_array($a,$to_go))
            $to_go[] = $a;
        if(sizeof($to_go)>=5)
        return Array('questions'=>$to_go);
    }
}

function get_question($id){
    $qry = "SELECT * FROM perguntas WHERE id = '$id'";
    $qry = mysql_query($qry);
    return mysql_fetch_assoc($qry);
}


#---------------------OLD--------------------------#







function get_pedido_id($user){
    $qry_pedido = "SELECT pedId FROM Pedido WHERE pedStatus = 'aberto' AND pedCliId = '$user'";
    $ped_id = mysql_result(mysql_query($qry_pedido), 0, 0);
    if(!$ped_id){
        $insert_pedido = "INSERT INTO Pedido (pedCliId) VALUES ($user)";
        mysql_query($insert_pedido);
        $ped_id = mysql_insert_id();
    }
    return $ped_id;
}

function get_produtos_by_pedido($pedido_id){
    $list = Array();
    $qry = "SELECT ppeCount count, proId, proName, proValue FROM Produto,ProdutoPedido WHERE ppePedId = $pedido_id AND proId = ppeProId";
    $qry = mysql_query($qry);
    while($row = mysql_fetch_assoc($qry)){
 $row['imgResource'] = 'http://salvachz.com.br/restaurante/img/'.$row['proId'].'.jpg';
        $list[] = $row;}
    return $list;
}

function add_product_to_pedido($pedido_id,$product, $count){
    $qry = "INSERT INTO ProdutoPedido (ppePedId, ppeProId, ppeCount) VALUES ($pedido_id, $product, $count) ON DUPLICATE KEY UPDATE ppeCount = ppeCount + $count";
    mysql_query($qry);
    if(mysql_error())
        return false;
    return true;
}

function finalizar_pedido($pedido_id, $payment){
    $qry = "UPDATE Pedido SET pedStatus = 'finalizado', pedPayMethod = '$payment'";
    mysql_query($qry);
    if(mysql_error())
        return false;
    return true;

}
