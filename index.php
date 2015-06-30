<?php

require('includes/connect.php');
require('includes/utils.php');

$data = get_quiz_questions();

do_output(true, $data);
?>
