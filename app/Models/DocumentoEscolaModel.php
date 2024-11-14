<?php namespace App\Models;

use CodeIgniter\Model;

class DocumentoEscolaModel extends Model{

    protected $table = 'CAD_DOCUMENTO_ESCOLA';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_DOCUMENTO_ESCOLA');
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
    }

    function getFotos($id){
        $builder = $this->db->table('CAD_DOCUMENTO_ESCOLA');
        $builder->where('FK_ID_ESCOLA', $id);
        return $builder->get()->getResult();
    }

    function getFotoID($id){
        $this->builder->where('ID_DOCUMENTO_ESCOLA', $id);
        return $this->builder->get()->getRow();
    }


    function setFoto($dados){
        $this->builder->insert($dados);
        $id = $this->db->insertID();
        sys_log($this->usuario->ID_USUARIO, "Inserção de dados ID: ".$id."", "CAD_DOCUMENTO_ESCOLA");
        return $id;
    }

    function updateFoto($dados){
        $this->builder->where('ID_DOCUMENTO_ESCOLA', $dados['ID_DOCUMENTO_ESCOLA']);
        $this->builder->update($dados);
        sys_log($this->usuario->ID_USUARIO, "Atualização de dados ID: ".$dados['ID_DOCUMENTO_ESCOLA']."", "CAD_DOCUMENTO_ESCOLA");
        return $this->db->affectedRows();
    }

    function deleteCategoria($id){
        $this->builder->where('ID_DOCUMENTO_ESCOLA', $id)->delete();
        sys_log($this->usuario->ID_USUARIO, "Exclusão de Categoria: ".$id."", "CAD_DOCUMENTO_ESCOLA");
        return $this->db->affectedRows();
    }

    function deleteFoto($id){
        $builder = $this->db->table('CAD_DOCUMENTO_ESCOLA');
        $builder->where('ID_DOCUMENTO_ESCOLA', $id)->delete();
        return $this->db->affectedRows();
    }
}
?>