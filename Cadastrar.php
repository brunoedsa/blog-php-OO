<?php

require_once("_classes/Cms.class.php");


if( $_POST ){

  $blog = new Cms();
  $blog->setConexao("host","localhost");
  $blog->setConexao("usuario","root");
  $blog->setConexao("senha","123456");
  $blog->setConexao("bd","phpoo");

  $titulo = addslashes($_POST['titulo']);
  $post = addslashes($_POST['post']);

  if ( $blog->cadastrar($titulo, $post) ){

    echo "<script type='text/javascript'>alert('Post Cadastrado!');</script>";

  }else{

    echo "<script type='text/javascript'>
    alert('Erro ao cadastrar. Preencha os dados corretamente');
    document.location.href='Cadastrar.php';
  </script>";

}

}

?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <title>Cadastrar Post para o blog</title>
</head>

<body>

  <form action="Cadastrar.php" method="post">

    <fieldset>

      <strong>Título:</strong><br />
      <input type="text" name="titulo" />

      <br /><br />

      <strong>Post:</strong><br />
      <textarea cols="50" rows="10" name="post"></textarea>

      <br /><br />

      <input type="submit" value="Postar" />

    </fieldset>

  </form>

</body>

</html>