<?php namespace App\Models;

use CodeIgniter\Model;

class EscolaModel extends Model {

    protected $table = 'CAD_ESCOLA';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_ESCOLA');
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
    }

    function getEscolas(){
        $builder = $this->db->table('CAD_ESCOLA');
        return $builder->get()->getResult();
    }

    function getEscolasProfissional($id){
        $this->builder->where('ID_ESCOLA', $id);
        return $this->builder->get()->getResult();
    }

    function getEscolaID($id){
        $this->builder->where('ID_ESCOLA', $id);
        return $this->builder->get()->getRow();
    }

    function setEscola($dados){
        $builder = $this->db->table('CAD_ESCOLA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateEscola($dados){
        $builder = $this->db->table('CAD_ESCOLA');
        $builder->where('ID_ESCOLA', $dados['ID_ESCOLA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteEscola($id){
        $this->builder->where('ID_ESCOLA', $id)->delete();
        return $this->db->affectedRows();
    }

    public function getEscolasUsuario($usuario)
    {
        $subquery = $this->db->table('CON_PERMISSAO AS A')
                             ->select('FK_ID_ESCOLA')
                             ->join('CON_USUARIO AS B', 'A.FK_ID_USUARIO = B.ID_USUARIO', 'INNER')
                             ->where('B.USUARIO', $usuario)
                             ->groupBy('A.FK_ID_ESCOLA')
                             ->getCompiledSelect();

        $builder = $this->db->table('CAD_ESCOLA');
        $builder->select('ID_ESCOLA, ESCOLA');
        $builder->where("ID_ESCOLA IN ($subquery)", null, false);

        return $builder->get()->getResult();
    }
}