<?php namespace App\Models;

use CodeIgniter\Model;

class PerfilModel extends Model{

    protected $table = 'CON_PERFIL';
    protected $primaryKey = 'ID_PERFIL';
    protected $allowedFields = ['DESCRICAO, DATA'];

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CON_PERFIL_PERMISSAO');
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
    }

    function perfilConsultarPermissoes($id){
        $this->builder->select('FK_ID_METODO');
        $this->builder->where('FK_ID_PERFIL', $id);
        return $this->builder->get()->getResult();
    }

    function getPerfis($id=""){
        $builder = $this->db->table('CON_PERFIL');
        if($id!=""){
            $builder->where('ID_PERFIL', $id);
        }
        return $builder->get();
    }

    function getPerfilID($id){
        $builder = $this->db->table('CON_PERFIL');
        $builder->where('ID_PERFIL', $id);
        return $builder->get()->getRow();
    }

    function setPerfil($dados){
        $builder = $this->db->table('CON_PERFIL');
        $builder->insert($dados);
        $id = $this->db->insertID();
        sys_log($this->usuario->ID_USUARIO, "Inserção de dados ID: ".$id."", "CON_PERFIL");
        return $id;
    }

    function updatePerfil($dados){
        $builder = $this->db->table('CON_PERFIL');
        $builder->where('ID_PERFIL', $dados['ID_PERFIL']);
        $builder->update($dados);
        sys_log($this->usuario->ID_USUARIO, "Atualização de dados ID: ".$dados['ID_PERFIL']."", "CON_PERFIL");
        return $this->db->affectedRows();
    }

    function setPerfilPermissao($checkperm, $id){
        $dados = array();
        $this->limparPermissoes($id);
        if($checkperm != null){
            foreach ($checkperm as $check){
                $dadosarray = array(
                    'FK_ID_PERFIL' => $id,
                    'FK_ID_METODO' => $check
                );
                array_push($dados, $dadosarray);
            }
            $this->builder->insertBatch($dados);

            sys_log($this->usuario->ID_USUARIO, "Inserção de Perfil: ".$id."", "CON_PERFIL_PERMISSAO");
        }
    }

    function limparPermissoes($id){        
        $builder = $this->db->table('CON_PERFIL_PERMISSAO');
        $builder->where('FK_ID_PERFIL', $id)->delete();
    }

    function excluirPerfil($id){
        $this->limparPermissoes($id);
        $builder = $this->db->table('CON_PERFIL');
        $builder->where('ID_PERFIL', $id)->delete();
        sys_log($this->usuario->ID_USUARIO, "Exclusão de Perfil: ".$id."", "CON_PERFIL");
        return $this->db->affectedRows();
    }
}
?>