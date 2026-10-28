<?php
   $host   = 'localhost'; //armazena o endereço ou nome do servidor de base de dados
   $dbname = 'gabnet_system'; //armazena o nome da base de dados a ser utilizada
   $user   = 'root'; //armazena o nome de usuário para acessar a base de dados
   $password   = ''; //armazena a senha para acessar a base de dados
   
   try {

        //A variavel $pdo armazena a conexao com a base de dados, e pode ser utilizada posteriormente para realizar consultas e outras operacoes
        /* Uma instancia da classe PDO eh criada com o objectivo de ligar ao servidor de base de dados, podemos constatar a seguinte sintaxe na criacao - new PDO ('informacoes do banco', 'usuario', 'senha', [array com configuracoes])*/
        $pdo = new PDO(
           "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
           $user,
           $password,
           [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
       );
    } catch (PDOException $e) {
        //PDOException eh uma especie de objecto com informacoes de um certo erro, neste caso os dados do PDOException sao transplantados para a variavel $e, e posteriormente a mensagem de erro eh exibida utilizando o metodo getMessage() do objeto $e.
        die('Erro de Ligação: ' . $e->getMessage());
    }
    