<?php
        include_once "../../php/utils/autoload.php";
        class Arquivo_req extends Database{
        private $arquivos;
        private $idreq;

        public function __construct($arquivos, $idreq) {
            $this->setarquivos($arquivos);
            $this->setidreq($idreq);
        }

        public function getarquivos() {
            return $this->arquivos;
        }

        public function setarquivos($arquivos) {
            $this->arquivos = $arquivos;
        }
        
        public function getidreq() {
            return $this->idreq;
        }

        public function setidreq($idreq) {
            $this->idreq = $idreq;
        }

        public function inserir(){
            $sql = 'INSERT INTO tcc.arquivo_req (arquivos, idreq) 
            VALUES (:arquivos, LAST_INSERT_ID())';
            $parametros = array(":arquivos"=>$this->getarquivos());
            return parent::executaComando($sql,$parametros);
        }

        public function editar(){
            $sql = 'UPDATE tcc.arquivo_req 
            SET arquivos = :arquivos
            WHERE idreq = :idreq';
            $parametros = array(":arquivos"=>$this->getarquivos(),
                                ":idreq"=>$this->getidreq());
            return parent::executaComando($sql,$parametros);
        }

        public static function listar($buscar = 0, $procurar = ""){
            $sql = "SELECT * FROM arquivo_req";
            if ($buscar > 0)
                switch($buscar){
                    case(1): $sql .= " WHERE arquivos like :procurar"; $procurar = "%".$procurar."%"; break;
                    case(2): $sql .= " WHERE idreq like :procurar"; $procurar = "%".$procurar."%"; break;
                }
            if ($buscar > 0)
                $parametros = array(':procurar'=>$procurar);
            else 
                $parametros = array(); 
            return parent::buscar($sql, $parametros);
        }

        public static function select($rows="*", $where = null, $search = null, $order = null, $group = null) {
            $pdo = Database::iniciaConexao();
            $sql= "SELECT $rows FROM arquivo_req";
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