<?php 


    class Database{
        // Informações para conexão com o banco de dados:
        // Local do banco de dados
        const DNS_CON = 'firebird:dbname=127.0.0.1/3050:C:\Program Files\Firebird\Firebird_4_0\data\DB_TESTE_SHINIER.fdb';
        // Usuario de acesso á tabela
        const USER_NAME = 'SYSDBA';
        // Senha de acesso a tabela
        const DB_PASSWORD = 'masterkey';

        /**
         * Define o nome da tabela a ser manipulada
         * @var string
         */

        private $table;

        /**
         * Instancia de PDO, para conectar a base de dados
         * @var PDO
         */
        
        private $connection;

        /**
         * Define a tabela e instancia a conexão
         * @param string
         */

        public function __construct($table)
        {
            $this->table = $table;
            $this->setConnection();
        }

        private function setConnection(){
            try{
                $this->connection = new PDO(self::DNS_CON, self::USER_NAME, self::DB_PASSWORD);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        /**
         * Método responsavel por executar as querys dentro do banco de dados
         *
         * @param string $query
         * @param array $params
         *
         * @return PDOStatement
         */

        public function execute($query, $params = []){
            try{
                $statement = $this->connection->prepare($query);
                $statement->execute($params);
                return $statement;
            }catch(PDOException $e){
                die('ERROR: '.$e->getMessage());
            }
        }

        function buscarNomePorCpf(){
            // ... CODE
        }

        function createFinanceiroView(){
            // ...CODE
        }

        function buscaDadosFinanceiroView(){
            // ... CODE
        }
    }

