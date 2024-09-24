<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
    <!-- PHP para configurar e conectar ao banco de dados -->
    <?php
        // Define as variáveis com as credenciais de conexão ao banco de dados
        $host = 'localhost';          // Endereço do servidor do banco de dados
        $db = 'senai_aulaphp';        // Nome do banco de dados
        $user = 'joaquim';            // Nome do usuário do banco de dados
        $pass = '123';                // Senha do usuário
        $port = 3307;                 // Porta de conexão (padrão do MySQL)
        
        // Inclui o arquivo PHP que contém a classe 'Database' para fazer a conexão com o banco de dados
        require_once 'C:\xampp\htdocs\aulaphp_joaquim\php\connection.php';
        
        // Instancia um novo objeto da classe 'Database', passando os parâmetros de conexão
        $database = new Database($host, $db, $user, $pass, $port);
        
        // Chama o método 'connect()' para realizar a conexão com o banco de dados
        $database->connect();
        
        // Obtém a conexão PDO criada pela classe 'Database'
        $pdo = $database->getConnection();
    ?>
</head>
<body>

    <!-- PHP para consultar e exibir dados do banco de dados -->
    <?php
    // Verifica se a conexão com o banco de dados foi estabelecida com sucesso
    if ($pdo) {
        try {
            // Prepara uma consulta SQL para selecionar as colunas 'id' e 'nome' da tabela 'usuario'
            $stmt = $pdo->prepare("SELECT id, nome FROM usuario");
            
            // Executa a consulta preparada
            $stmt->execute();
            
            // Busca todos os resultados da consulta em um array associativo
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            // Verifica se há algum resultado na consulta
            if ($resultados) {
                // Itera sobre cada linha de resultado
                foreach ($resultados as $row) {
                    // Exibe o valor da coluna 'id' do registro
                    echo "ID: " . $row['id'] . "<br>";
                    
                    // Exibe o valor da coluna 'nome' do registro
                    echo "Nome: " . $row['nome'] . "<br>";
                }
            } else {
                // Caso não haja resultados, exibe uma mensagem indicando que nenhum registro foi encontrado
                echo "Nenhum registro encontrado.<br>";
            }
        } catch (PDOException $e) {
            // Captura e exibe qualquer exceção (erro) que possa ocorrer durante a consulta ao banco de dados
            echo "Erro ao consultar o banco de dados: " . $e->getMessage() . "<br>";
        }
    }
    ?>
</body>
</html>
