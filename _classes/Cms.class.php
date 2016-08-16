<?php

// Inclui a classe Cms. Ps: Poderíamos ter usado o método especial __autoload()

require_once("Conexao.class.php");

/**
 * Classe para manipulação de posts. Esta classe estende a Conexao.
 */

class Cms extends Conexao{

    /**
     * Nome da tabela
     * @static var string
     */

    private static $tabela = "blog";

    /**
     * Contabiliza os erros de validação
     * @static var integer
     */

    private static $erro = 0;


    /**
     * Cadastra um novo post
     *
     * @param string $titulo - Título do post
     * @param string $post - Conteúdo do Post
     */

     public function cadastrar($titulo, $post){

        $dados = array();
        $dados['titulo'] = $titulo;
        $dados['post'] = $post;

        // Validações iniciais

        if( strlen( $dados['titulo'] )<10 ){

            self::$erro++;

        }

        if( strlen( $dados['post'] )<10 ){

            self::$erro++;

        }

        // Tudo certo, cadastra o post

        if( self::$erro==0 ){

          // Nenhum erro, então posta
          parent::inserir(self::$tabela, $dados); // Acessa o método inserir da classe-pai

          return true;

        }else{

          return false;

        }

     }


    /**
     * Retorna todos os posts em forma de objeto a partir do método consulta()
     */

     public function exibir(){

        $resultado = parent::consulta("SELECT * FROM " . self::$tabela );

        /*
            Itera o resultado da consulta.
            fetch_assoc -> Retorna uma matriz associativa das linhas do resultado
            Poderíamos usar fetch_row() que retorna uma matriz que corresponde a linha obtida
            exemplo: $row[0] ...
        */

        // Inicializa a variável

        $html = "";

        while ( $row = $resultado->fetch_assoc() ) {

            $html .="

            <div class='post'>

                <h2>{$row['titulo']}</h2>

                <p>
                    {$row['post']}
                </p>

            </div>

            ";

        }

        // Retorna os dados

        return $html;

     }

}

?>