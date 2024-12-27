<?php namespace App\Models;

use CodeIgniter\Model;

class ProbLotesModel extends Model{

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


    function getProbLotes(){
        $builder = $this->db->table('procedimento_problema AS a');
        $builder->join('CAD_ANO_LETIVO AS c','a.id_lote = c.ID_ANO_LETIVO', 'JOIN');
        $result = $builder->get()->getResult();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;
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

    function getDetalheProcedimento($id){
        $builder = $this->db->table('procedimento_problema_animal AS a');
        $builder->join('procedimento_problema AS d','a.id_procedimento_problema = d.id_procedimento_problema', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS b','a.identificacao_animal = b.IDENTIFICACAO', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS c','b.FK_ID_LOTE = c.ID_ANO_LETIVO', 'JOIN');
        $builder->join('tipos AS t','a.tipo = t.id', 'JOIN');
        $builder->where('a.id_procedimento_problema', $id);
        $builder->groupBy('identificacao_animal');

        $result = $builder->get()->getResult();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;
    }

    function getDadosVacina($id){
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('nome');
        $builder->join('procedimento_vacina AS b','a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('vacinas AS c','b.id_vacina = c.id', 'JOIN');
        $builder->where('b.id_procedimento_curral_animal', $id);
        return $builder->get()->getResult();
    }

    function getDadosMedicacao($id){
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('nome');
        $builder->join('procedimento_medicacao AS b','a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('produtos AS c','b.id_medicacao = c.id', 'JOIN');
        $builder->where('b.id_procedimento_curral_animal', $id);
        return $builder->get()->getResult();
    }

    public function getProblemasPorLote()
    {
        $builder = $this->db->table('procedimento_problema AS pc');
        $builder->select('pc.id_lote, c.NOME_LOTE, COUNT(pc.id_procedimento_problema) AS quantidade_procedimentos')
                ->join('CAD_ANO_LETIVO AS c', 'pc.id_lote = c.ID_ANO_LETIVO', 'JOIN')
                ->groupBy('pc.id_lote')
                ->orderBy('quantidade_procedimentos', 'DESC');
        
        return $builder->get()->getResult();
    }

    public function getProblemasPorTipo($idLote)
    {
        $builder = $this->db->table('procedimento_problema_animal AS ppa');
        $builder->select('t.nome AS tipo_problema, COUNT(ppa.id_procedimento_problema_animal) AS quantidade_problemas')
                ->join('tipos AS t', 'ppa.tipo = t.id', 'JOIN')
                ->where('ppa.id_lote', $idLote)
                ->groupBy('ppa.tipo')
                ->orderBy('quantidade_problemas', 'DESC');
        
        return $builder->get()->getResult();
    }

    public function getProblemasRecorrentes()
    {
        $builder = $this->db->table('procedimento_problema_animal AS ppa');
        $builder->select('t.nome AS tipo_problema, COUNT(ppa.id_procedimento_problema_animal) AS quantidade_problemas')
                ->join('tipos AS t', 'ppa.tipo = t.id', 'JOIN')
                ->groupBy('ppa.tipo')
                ->orderBy('quantidade_problemas', 'DESC');
        
        return $builder->get()->getResult();
    }

    function getVacina() {
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('c.nome, COUNT(c.id) as total_vacinas');
        $builder->join('procedimento_vacina AS b', 'a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('vacinas AS c', 'b.id_vacina = c.id', 'JOIN');
        $builder->groupBy('c.nome');
        $builder->orderBy('total_vacinas', 'DESC');
        $builder->limit(5);
        return $builder->get()->getResult();
    }
    
    function getMedicamentos() {
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('c.nome, COUNT(c.id) as total_medicacoes');
        $builder->join('procedimento_medicacao AS b', 'a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('produtos AS c', 'b.id_medicacao = c.id', 'JOIN');
        $builder->groupBy('c.nome');
        $builder->orderBy('total_medicacoes', 'DESC');
        $builder->limit(5);
        return $builder->get()->getResult();
    }

    public function getAnimaisMaisPesadosPorProcedimento()
    {
        // Builder para obter os 5 animais mais pesados de um procedimento de venda específico
        $builder = $this->db->table('procedimento_venda_animal AS pva');
        $builder->select('pva.identificacao_animal, pva.peso, pva.valor')
                ->orderBy('pva.peso', 'DESC')
                ->limit(10);

        return $builder->get()->getResult();
    }

    

    
}
?>