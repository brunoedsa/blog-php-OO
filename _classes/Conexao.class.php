<?php

/**
 * Classe para conexão estendida da extensão MySQLi
 */

class Conexao extends mysqli{

    /**
     * Recebe os dados da conexão
     * @var array
     */

    private $con_dados = array();

    /**
     * Identificador de conexão com o MySQL. Se estiver conectado retorna true senão false
     * @var boolean
     * @static
     */

    private static $con_status = false;

    /**
     * Inicialização das variáveis de conexão com o MySQL
     *
     * @param string $chave - Índice associativo referente ao elemento da conexão
     * @param string $valor - Valor correspondente ao índice em questão
     */

    public function setConexao($chave, $valor){

      $this->con_dados[$chave] = $valor;

    }

    /**
     * Conecta-se ao banco de dados a partir do método herdado da classe MySQLi
     */

    private function conectar(){

        //Se $con_status for igual a false, teremos de inicializar uma conexão

      try{

        if( self::$con_status == false ){

                /*
                    Chamamos o construtor da classe Mysqli, responsável por inicializar a conexão.
                    Passamos como parâmetro o Array contendo os dados de conexão: $this->con_dados[]

                    Ps: Os dados de conexão poderiam estar por padrão já definidos na classe como membros estáticos.

                */

                    parent::__construct( $this->con_dados['host'] , $this->con_dados['usuario'], $this->con_dados['senha'], $this->con_dados['bd']);

                // Define o charset a ser usado nas transações

                    parent::set_charset("utf8");

                // mysqli_connect_errno() -> Método herdado da classe Mysqli, se o resultado for 0 é porq não ocorreu nenhum erro

                    if( mysqli_connect_errno() != 0 ){

                    // Lançamos uma exceção
                      throw new Exception('Por algum motivo não foi possível conectar-se ao banco de dados.');

                    }

                /*
                    A conexão foi estabelecida? Então $con_status é definido como True.
                */

                    self::$con_status = true;

                  }

                }catch(Exception $exc){

            // Retorna o erro
                  echo $exc->getMessage();

                }

              }

    /**
     * Executa uma Query no banco de dados.
     * O resultado da consulta são dados em forma de objetos.
     */

    public function consulta($sql){

      try{

              // Cria a conexão com o banco de dados caso não tenha nenhuma ativa
        $this->conectar();

              // parent::query -> Estamos executando o método query da classe-pai, que é a classe Mysqli herdada

        $resultado = parent::query($sql);

              // Verifica se o resultado está direitinho

        if(!$resultado){

          throw new Exception('Consulta não realizada. Um erro foi encontrado.');

        }else{

          return $resultado;

        }

      }catch(Exception $exc){

            // Retorna o erro
        echo $exc->getMessage();

      }
    }


    /**
     * Recebe o nome da tabela e um array com os dados a serem inseridos
     */

    public function inserir($tabela, $dados){

      try{

              // Cria a conexão com o banco de dados caso não tenha nenhuma ativa
        $this->conectar();

              /*
                  Os dados do Array que forem string, acrescentaremos aspas simples para a insercação na query
                  Por exemplo: João tornará: 'João'
              */

                  foreach ( $dados as $chave => $valor ) {

                    if( is_string($valor) ){
                      $dados[$chave]="'{$valor}'";
                    }

                  }

              /*
                  Cria a query de inserção
                  array_keys() retorna a chave do Array
              */

                  $sql = "INSERT INTO {$tabela} (".implode(', ', array_keys($dados)).") VALUES ( ".implode(', ', $dados).")";

              // parent::query -> Estamos executando o método query da classe-pai, que é a classe Mysqli herdada

                  $resultado = parent::query($sql);

              // Verifica se o resultado está direitinho

                  if(!$resultado){

                    throw new Exception($sql);

                  }

                }catch(Exception $exc){

            // Retorna o erro
                  echo $exc->getMessage();

                }
              }


    /**
     *  Fecha uma conexão ativa
     */

    public function fechar(){

        // A conexão está ativa? Então feche-a.

      if( self::$con_status ){

            // Executamos o método close() da classe-pai Mysqli
        parent::close();

            // $con_status é defino como false, ou seja, conexão não ativa.
        self::$con_status = false;

      }

    }

    /**
     * Método destrutor, responsável por fechar a conexão
     */

    function  __destruct(){

      $this->fechar();
    }

  }
  ?>