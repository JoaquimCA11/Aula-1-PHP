<?php
// Classe responsável por gerenciar a conexão com o banco de dados
class Database {
    private $pdo;  // Variável que irá armazenar a conexão PDO
    private $host; // Endereço do servidor de banco de dados
    private $db;   // Nome do banco de dados
    private $user; // Nome do usuário do banco de dados
    private $pass; // Senha do usuário do banco de dados
    private $port; // Porta de conexão com o banco de dados (padrão é 3306)

    // Construtor da classe, onde os parâmetros de conexão ao banco de dados são definidos
    public function __construct($host, $db, $user, $pass, $port = 3307) {
        $this->host = $host; // Atribui o valor do host
        $this->db = $db;     // Atribui o nome do banco de dados
        $this->user = $user; // Atribui o nome de usuário
        $this->pass = $pass; // Atribui a senha do banco de dados
        $this->port = $port; // Atribui a porta (se não for especificada, a porta padrão será 3306)
    }

    // Método responsável por realizar a conexão ao banco de dados
    public function connect() {
        try {
            // Cria uma instância de PDO, estabelecendo a conexão com o banco MySQL, definindo o charset como UTF-8
            $this->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db};charset=utf8", $this->user, $this->pass);
            
            // Define o modo de erro do PDO para lançar exceções em caso de erro
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // Exibe uma mensagem de sucesso caso a conexão seja estabelecida
            echo "Conexão com o banco de dados MySQL realizada com sucesso!<br>";
        } catch (PDOException $e) {
            // Caso ocorra um erro na conexão, exibe uma mensagem com a descrição do erro
            echo "Erro ao conectar ao banco de dados: " . $e->getMessage() . "<br>";
        }
    }

    // Método que retorna a conexão PDO para ser usada em consultas SQL
    public function getConnection(){
        return $this->pdo; // Retorna o objeto PDO representando a conexão ativa
    }
}
?>
