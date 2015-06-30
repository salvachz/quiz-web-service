<html>
<form action="" method="POST"  enctype="multipart/form-data">

<table>
    <!--tr>
        <td>Nome</td>
        <td><input type="text" name="nome"></td>
    </tr-->
    <tr>
        <td>Pergunta</td>
        <td><input type="text" name="pergunta"></td>
    </tr>
    <tr>
        <td>Opcoes</td>
        <td><textarea name="opcoes"></textarea></td>
    </tr>
    <tr>
        <td>resposta</td>
        <td><input type="text" name="resposta"></td>
    </tr>
    <tr>
        <td>imagem</td>
        <td><input type="file" name="imagem"></td>
    </tr>
    <tr>
        <td coolspan="2"><input type="submit" value="vai!" /></td>
    </td>

</table>
</form>
<?php
    require("includes/connect.php");
    if($_POST){
        $nome = $_POST['nome'];
        $pergunta = $_POST['pergunta'];
        $opcoes = $_POST['opcoes'];
        $resposta = $_POST['resposta'];
        print_r($_FILES);
        $img_str = file_get_contents($_FILES['imagem']['tmp_name']);
        #echo 'img'.$img_str;
        #$img_str = explode(",",$img_str);
        #array_shift($img_str);
        #$img_str = join(",",$img_str);
        $imgData = base64_encode($img_str);
        #echo 'codada '.$imgData."\n";
        $qry = "INSERT INTO perguntas VALUES (NULL,'$pergunta','$opcoes', '$resposta','$imgData')";
        #echo $qry."\n";
        mysql_query($qry);
    }

        $get = mysql_query("select * from quiz.perguntas");
?>

<table>

    <tr>
        <td>ID</td>
        <td>Pergunta</td>
    </tr>
    <?php while($row = mysql_fetch_row($get)) { ?>
    <tr>
        <td><?=$row[0]?></td>
        <td><?=$row[1]?></td>
    </tr>
    <?php } ?>
</table>
</html>
