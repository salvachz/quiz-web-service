<?php

require('includes/connect.php');
require('includes/utils.php');

$question = $_REQUEST['question'];
$data = get_question($question);

do_output(true, $data);
?>
