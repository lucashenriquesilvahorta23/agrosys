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
        $builder->select('B.NOME AS PROFISSAO, A.*');
        $builder->join('CAD_PROFISSAO AS B','A.CARGO = B.ID_PROFISSAO', 'LEFT');
        if($cargo != ""){
            $builder->where('A.CARGO', $cargo);
        }
        if($situacao != ""){
            if($situacao != "A"){
                $builder->where('A.DATA_DESLIGAMENTO !=', 0000-00-00);
            }else{
                $builder->where('A.DATA_DESLIGAMENTO', 0000-00-00);
            }
        }
        return $builder->get()->getResult();
    }

    function getProfissionalEscola($idEscola, $situacao, $cargo){
        $builder = $this->db->table('CAD_PROFISSIONAL AS A');
        $builder->select('B.NOME AS PROFISSAO, A.*');
        $builder->join('CAD_PROFISSAO AS B','A.CARGO = B.ID_PROFISSAO', 'LEFT');
        $builder->where('A.FK_ID_ESCOLA', $idEscola);
        if($cargo != ""){
            $builder->where('A.CARGO', $cargo);
        }
        if($situacao != ""){
            if($situacao != "A"){
                $builder->where('A.DATA_DESLIGAMENTO !=', 0000-00-00);
            }else{
                $builder->where('A.DATA_DESLIGAMENTO', 0000-00-00);
            }
        }
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