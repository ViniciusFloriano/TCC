<?php
        include_once "../../php/utils/autoload.php";
        class Projeto extends Database{
        private $id;
        private $nome;
        private $prazo;
        private $descricao;
        private $documento;
        private $idusu;

        public function __construct($id, $nome, $prazo, $descricao, $documento, $idusu) {
            $this->setid($id);
            $this->setnome($nome);
            $this->setprazo($prazo);
            $this->setdescricao($descricao);
            $this->setdocumento($documento);
            $this->setidusu($idusu);
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
        
        public function getprazo() {
            return $this->prazo;
        }

        public function setprazo($prazo) {
            if ($prazo >  0)
                $this->prazo = $prazo;
        }

        public function getdescricao() {
            return $this->descricao;
        }

        public function setdescricao($descricao) {
            if ($descricao >  0)
                $this->descricao = $descricao;
        }

        public function getdocumento() {
            return $this->documento;
        }

        public function setdocumento($documento) {
            if ($documento >  0)
                $this->documento = $documento;
        }

        public function getidusu() {
            return $this->idusu;
        }

        public function setidusu($idusu) {
            if ($idusu >  0)
                $this->idusu = $idusu;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.projeto (nome, prazo, descricao, documento, idusu) 
            VALUES (:nome, :prazo, :descricao, :documento, :idusu)';
            $parametros = array(":nome"=>$this->getnome(),
                                ":prazo"=>$this->getprazo(),
                                ":descricao"=>$this->getdescricao(),
                                ":documento"=>$this->getdocumento(),
                                ":idusu"=>$this->getidusu());
            return parent::executaComando($sql,$parametros);
        }

        public function excluir(){
            $sql = 'DELETE FROM tcc.projeto WHERE id = :id';
            $parametros = array(":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE tcc.projeto 
            SET nome = :nome, prazo = :prazo, descricao = :descricao, documento = :documento, idusu = :idusu
            WHERE id = :id';
            $parametros = array(":nome"=>$this->getnome(),
                                ":prazo"=>$this->getprazo(),
                                ":descricao"=>$this->getdescricao(),
                                ":documento"=>$this->getdocumento(),
                                ":idusu"=>$this->getidusu(),
                                ":id"=>$this->getid());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM projeto";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE id like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE nome like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(3): $sql .= " WHERE prazo like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(4): $sql .= " WHERE descricao like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(5): $sql .= " WHERE documento like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(6): $sql .= " WHERE idusu like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array();
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM projeto";
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
    }
?>