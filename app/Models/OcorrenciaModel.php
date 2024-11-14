<?php namespace App\Models;

use CodeIgniter\Model;

class OcorrenciaModel extends Model {

    protected $table = 'CAD_OCORRENCIA';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_OCORRENCIA');
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
    }

    function getOcorrencia($escola){
        $builder = $this->db->table('CAD_OCORRENCIA');
        $builder->where('FK_ID_ESCOLA', $escola);
        return $builder->get()->getResult();
    }

    function getOcorrenciaProfissional($id){
        $this->builder->where('ID_OCORRENCIA', $id);
        return $this->builder->get()->getResult();
    }

    function getOcorrenciaID($id){
        $this->builder->where('ID_OCORRENCIA', $id);
        return $this->builder->get()->getRow();
    }

    function setOcorrencia($dados){
        $builder = $this->db->table('CAD_OCORRENCIA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateOcorrencia($dados){
        $builder = $this->db->table('CAD_OCORRENCIA');
        $builder->where('ID_OCORRENCIA', $dados['ID_OCORRENCIA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteOcorrencia($id){
        $this->builder->where('ID_OCORRENCIA', $id)->delete();
        return $this->db->affectedRows();
    }


}