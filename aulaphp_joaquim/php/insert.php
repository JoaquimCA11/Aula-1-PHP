<!-- PHP para configurar e conectar ao banco de dados -->
<?php
    // Define as variáveis com as credenciais de conexão ao banco de dados
    $host = 'localhost';          // Endereço do servidor do banco de dados
    $db = 'senai_aulaphp';        // Nome do banco de dados
    $user = 'joaquim';            // Nome do usuário do banco de dados
    $pass = '123';                // Senha do usuário
    $port = 3307;                 // Porta de conexão com o banco de dados (padrão alterado para 3307)

    // Inclui o arquivo PHP que contém a classe 'Database' para fazer a conexão com o banco de dados
    require_once 'C:\xampp\htdocs\aulaphp_joaquim\php\connection.php';

    // Instancia um novo objeto da classe 'Database', passando os parâmetros de conexão
    $database = new Database($host, $db, $user, $pass, $port);

    // Chama o método 'connect()' para realizar a conexão com o banco de dados
    $database->connect();

    // Obtém a conexão PDO criada pela classe 'Database'
    $pdo = $database->getConnection();

    // Verifica se a conexão foi estabelecida com sucesso
    if($pdo) {
        try {
            // Prepara uma consulta SQL para inserir um novo usuário na tabela 'usuario'
            $stmt = $pdo->prepare("INSERT INTO usuario(nome, senha) VALUES('Valquer', '123456');");
            
            // Executa a consulta preparada (inserção dos dados)
            $stmt->execute();
        }
        catch(PDOException $e) {
            // Captura e exibe uma mensagem de erro caso a execução da consulta falhe
            echo "Erro ao consultar o banco de dados: " . $e->getMessage() . "<br>";
        }
    }
?>
