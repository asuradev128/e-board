<?php
    include "../../utils/index.php";
    $_SESSION['authToken'] = NULL;
    session_destroy();
    route('../../index');
?>