<?php

require_once("_classes/Cms.class.php");

$blog = new Cms();
$blog->setConexao("host","localhost");
$blog->setConexao("usuario","root");
$blog->setConexao("senha","123456");
$blog->setConexao("bd","phpoo");

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Meu Blog Pessoal</title>

    <style type="text/css">

      .post{
        margin-bottom: 1em;
        border-bottom: 1px dashed #E0E0E0;
        padding-bottom: 0.5em;
    }

    .post h2{
        padding: 0.5em;
        background-color: #EFEFEF;
        border: solid 1px #CFCFCF;
        margin-bottom: 0.5em;
    }

</style>
</head>
<body>

    <div id="estrutura-blog">

        <?php

        echo $blog->exibir();

        ?>

    </div>

</body>

</html>