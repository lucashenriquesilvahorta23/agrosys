<?php namespace App\Models;

use CodeIgniter\Model;

class ProcLotesModel extends Model{

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


    function getProcLotes(){
        $builder = $this->db->table('procedimento_curral AS a');
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
        $builder = $this->db->table('procedimento_curral_animal AS a');
        $builder->join('procedimento_curral AS d','a.id_procedimento_curral = d.id_procedimento_curral', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS b','a.identificacao_animal = b.IDENTIFICACAO', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS c','b.FK_ID_LOTE = c.ID_ANO_LETIVO', 'JOIN');
        $builder->where('a.id_procedimento_curral', $id);
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

    public function getProcedimentosPorLote()
    {
        // Inicializar o builder
        $builder = $this->db->table('procedimento_curral AS pc');
        $builder->select('NOME_LOTE, COUNT(pc.id_procedimento_curral) AS quantidade_procedimentos')
                ->join('CAD_ANO_LETIVO AS c','pc.id_lote = c.ID_ANO_LETIVO', 'JOIN')
                ->groupBy('pc.id_lote')
                ->orderBy('quantidade_procedimentos', 'DESC');
        
        // Executar a consulta e retornar os resultados
        return $builder->get()->getResult();
    }

    function getVacinasAgrupadasPorProcedimento($id_procedimento_curral) {
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('c.nome, COUNT(c.id) as total_vacinas');
        $builder->join('procedimento_vacina AS b', 'a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('vacinas AS c', 'b.id_vacina = c.id', 'JOIN');
        $builder->where('a.id_procedimento_curral', $id_procedimento_curral);
        $builder->groupBy('c.nome');
        $builder->orderBy('total_vacinas', 'DESC');
        return $builder->get()->getResult();
    }
    
    function getMedicacoesAgrupadasPorProcedimento($id_procedimento_curral) {
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('c.nome, COUNT(c.id) as total_medicacoes');
        $builder->join('procedimento_medicacao AS b', 'a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('produtos AS c', 'b.id_medicacao = c.id', 'JOIN');
        $builder->where('a.id_procedimento_curral', $id_procedimento_curral);
        $builder->groupBy('c.nome');
        $builder->orderBy('total_medicacoes', 'DESC');
        return $builder->get()->getResult();
    }
    
    


    
}
?>