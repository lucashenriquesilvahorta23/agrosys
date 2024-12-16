<?php namespace App\Models;

use CodeIgniter\Model;

class ProfissionalModel extends Model{

    protected $table = 'CAD_PROFISSIONAL';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_PROFISSIONAL');
    }

    function getProfissional($situacao, $cargo){
        $builder = $this->db->table('CAD_PROFISSIONAL AS A');
        return $builder->get()->getResult();
    }

    function getProfissionalEscola($idEscola, $situacao, $cargo){
        $builder = $this->db->table('CAD_PROFISSIONAL AS A');
        return $builder->get()->getResult();
    }

    function getProfissionalID($id){
        $this->builder->where('ID_PROFISSIONAL', $id);
        return $this->builder->get()->getRow();
    }

    function getProfissionalIDArray($id){
        $this->builder->where('ID_PROFISSIONAL', $id);
        return $this->builder->get()->getResult();
    }

    function setProfissional($dados){
        $builder = $this->db->table('CAD_PROFISSIONAL');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }
    function updateProfissional($dados){
        $builder = $this->db->table('CAD_PROFISSIONAL');
        $builder->where('ID_PROFISSIONAL', $dados['ID_PROFISSIONAL']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteProfissional($id){
        $this->builder->where('ID_PROFISSIONAL', $id)->delete();
        return $this->db->affectedRows();
    }
}
?>