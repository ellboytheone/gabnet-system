<?php
    function encontrarPessoa($pdo, $email){
        $tabelas = [
            'aluno' => 'Estudante',
            'professor' => 'Professor',
            'admin' => 'Administrador'
        ];
        foreach($tabelas as $tabela => $papel){

            $stmt = $pdo->prepare("
                SELECT *
                FROM $tabela
                WHERE email = ?
                LIMIT 1
            ");

            $stmt->execute([$email]);

            $dados = $stmt->fetch();

            if($dados){

                $dados['papel'] = $papel;
                $dados['tabela'] = $tabela;

                return $dados;
            }
        }
        return null;
    }