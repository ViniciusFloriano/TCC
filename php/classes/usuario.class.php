<?php
        include_once "../../php/utils/autoload.php";
        class Usuario extends Database{
        private $id;
        private $nome;
        private $email;
        private $senha;
        private $tipo;

        public function __construct($id, $nome, $email, $senha, $tipo) {
            $this->setid($id);
            $this->setnome($nome);
            $this->setemail($email);
            $this->setsenha($senha);
            $this->settipo($tipo);
        }

        public function getid() {
            return $this->id;
        }

        public function setid($id) {
            if ($id >  0)
                $this->id = $id;
        }     

        public function getnome() {
            return $this->nome;
        }

        public function setnome($nome) {
            if ($nome >  0)
                $this->nome = $nome;
        }
        
        public function getemail() {
            return $this->email;
        }

        public function setemail($email) {
            if ($email >  0)
                $this->email = $email;
        }

        public function getsenha() {
            return $this->senha;
        }

        public function setsenha($senha) {
            if ($senha >  0)
                $this->senha = $senha;
        }

        public function gettipo() {
            return $this->tipo;
        }

        public function settipo($tipo) {
            if ($tipo >  0)
                $this->tipo = $tipo;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.usuario (nome, email, senha, tipo) 
            VALUES (:nome, :email, :senha, :tipo)';
            $parametros = array(":nome"=>$this->getnome(),
                                ":email"=>$this->getemail(),
                                ":senha"=>$this->getsenha(),
                                ":tipo"=>$this->gettipo());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM tcc.usuario WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE tcc.usuario 
            SET nome = :nome, email = :email, senha = :senha, tipo = :tipo
            WHERE id = :id';
            $parametros = array(":nome"=>$this->getnome(),
                                ":email"=>$this->getemail(),
                                ":senha"=>$this->getsenha(),
                                ":tipo"=>$this->gettipo(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM usuario";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE email like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE senha like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE tipo like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM usuario";
            if($where != null) {
                $sql .= " WHERE $where";
                if($search != null) {
                    if(is_numeric($search) == false) {
                        $sql .= " LIKE '%". trim($search) ."%'";
                    } else if(is_numeric($search) == true) {
                        $sql .= " <= '". trim($search) ."'";
                    }
                }
            }
            if($order != null) {
                $sql .= " ORDER BY $order";
            }
            if($group != null) {
                $sql .= " GROUP BY $group";
            }
            $sql .= ";";
            return $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function efetuarLogin($email, $senha){
            $sql = "SELECT id, tipo FROM usuario WHERE email = :email AND senha = :senha";
            $parametros = array(
                ':email' => $email,
                ':senha' => $senha,
            );
            session_set_cookie_params(0);
            session_start();
            if (self::buscar($sql, $parametros)) {
                $_SESSION['id'] = self::buscar($sql, $parametros)[0]['id'];
                $_SESSION['tipo'] = self::buscar($sql, $parametros)[0]['tipo'];
                return true;
            } else {
                $_SESSION['id'] = "";
                $_SESSION['tipo'] = "";
                return false;
            }
        }

        public static function consultarData($id){
            $sql = "SELECT * FROM usuario WHERE id = :id";
            $params = array(':id'=>$id);
            return parent::buscar($sql, $params);
        }
    }
?>