<?php namespace App\Models;

use CodeIgniter\Model;

class ProfissaoModel extends Model{

    protected $table = 'CAD_PROFISSAO';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_PROFISSAO');
    }

    function getProfissao(){
        $builder = $this->db->table('CAD_PROFISSAO AS A');
        return $builder->get()->getResult();
    }


    function getProfissaoID($id){
        $this->builder->where('ID_PROFISSAO', $id);
        return $this->builder->get()->getRow();
    }

    function setProfissao($dados){
        $builder = $this->db->table('CAD_PROFISSAO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateProfissao($dados){
        $builder = $this->db->table('CAD_PROFISSAO');
        $builder->where('ID_PROFISSAO', $dados['ID_PROFISSAO']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteProfissao($id){
        $this->builder->where('ID_PROFISSAO', $id)->delete();
        return $this->db->affectedRows();
    }

}
?>