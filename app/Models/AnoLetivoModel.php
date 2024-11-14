<?php namespace App\Models;

use CodeIgniter\Model;

class AnoLetivoModel extends Model{

    protected $table = 'CAD_ANO_LETIVO';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_ANO_LETIVO');
    }

    function getAnoLetivo($escola){
        $this->builder->orderBy('ID_ANO_LETIVO',' ASC');
        $this->builder->where('FK_ID_ESCOLA', $escola);
        return $this->builder->get()->getResult();
    }

    function getAnoLetivoID($id){
        $this->builder->where('ID_ANO_LETIVO', $id);
        return $this->builder->get()->getRow();
    }

    function setAnoLetivo($dados){
        $builder = $this->db->table('CAD_ANO_LETIVO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateAnoLetivo($dados){
        $builder = $this->db->table('CAD_ANO_LETIVO');
        $builder->where('ID_ANO_LETIVO', $dados['ID_ANO_LETIVO']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteAnoLetivo($id){
        $this->builder->where('ID_ANO_LETIVO', $id)->delete();
        return $this->db->affectedRows();
    }

    function deleteDatas($id){
        $builder = $this->db->table('CAD_DATAS_ANO_LETIVO');
        $builder->where('FK_ID_ANO_LETIVO', $id)->delete();
        return $this->db->affectedRows();
    }

    function setDatas($dados){
        $builder = $this->db->table('CAD_DATAS_ANO_LETIVO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function getDatasAnoLetivoID($id){
        $builder = $this->db->table('CAD_DATAS_ANO_LETIVO');
        $builder->where('FK_ID_ANO_LETIVO', $id);
        return $builder->get()->getResult();
    }
}
?>