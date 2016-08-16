#Atenção

##1º passo: Crie um bacno de dados chamado phpoo

##2º passo: Inserindo o SQL no Banco de Dados phpoo

Após criar o banco de dados, adicione o SQL abaixo e execute. Ele irá criar uma tabela chamada **blog**.

```
CREATE TABLE blog(
id INT(10) NOT NULL AUTO_INCREMENT,
titulo VARCHAR(165) NULL,
post TEXT NULL,
PRIMARY KEY (id)
)
```

##3º passo: configurando a conexão
No arquivo **Cadastrar.php** e **index.php** altere os dados da conexão com o banco, colocando as configuração do seu localhost para que funcione corretamente.