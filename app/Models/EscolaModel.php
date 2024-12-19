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
        $builder->select('ID_ESCOLA, NOME AS ESCOLA');
        $builder->where("ID_ESCOLA IN ($subquery)", null, false);

        return $builder->get()->getResult();
    }

    public function getDetalhesAnimais()
    {
        // Subquery para vacinas tomadas
        $subqueryVacinas = $this->db->table('procedimento_vacina AS pv')
                                    ->select('pv.id_procedimento, v.nome AS vacina')
                                    ->join('vacinas AS v', 'pv.id_vacina = v.id', 'INNER')
                                    ->getCompiledSelect();

        // Subquery para medicamentos tomados
        $subqueryMedicamentos = $this->db->table('procedimento_medicacao AS pm')
                                        ->select('pm.id_procedimento, p.nome AS medicamento')
                                        ->join('produtos AS p', 'pm.id_medicacao = p.id', 'INNER')
                                        ->getCompiledSelect();

        // Query principal
        $builder = $this->db->table('animal AS a');
        $builder->select('a.nome AS animal, a.identificador, a.peso_atual AS peso, 
                        GROUP_CONCAT(DISTINCT v.vacina) AS vacinas, 
                        GROUP_CONCAT(DISTINCT m.medicamento) AS medicamentos, 
                        p.observacoes')
                ->join('procedimento AS p', 'a.id = p.id_animal', 'LEFT')
                ->join("($subqueryVacinas) AS v", 'p.id = v.id_procedimento', 'LEFT')
                ->join("($subqueryMedicamentos) AS m", 'p.id = m.id_procedimento', 'LEFT')
                ->groupBy('a.id');

        return $builder->get()->getResult();
    }

    public function getQuantidadeVacinas()
    {
        // Builder para contar as vacinas aplicadas
        $builder = $this->db->table('procedimento_vacina AS pv');
        $builder->select('v.nome AS vacina, COUNT(pv.id_vacina) AS quantidade')
                ->join('vacinas AS v', 'pv.id_vacina = v.id', 'INNER')
                ->groupBy('pv.id_vacina')
                ->orderBy('quantidade', 'DESC');

        return $builder->get()->getResult();
    }

    public function getQuantidadeMedicamentos()
    {
        // Builder para contar os medicamentos utilizados
        $builder = $this->db->table('procedimento_medicacao AS pm');
        $builder->select('p.nome AS medicamento, COUNT(pm.id_medicacao) AS quantidade')
                ->join('produtos AS p', 'pm.id_medicacao = p.id', 'INNER')
                ->groupBy('pm.id_medicacao')
                ->orderBy('quantidade', 'DESC');

        return $builder->get()->getResult();
    }

}