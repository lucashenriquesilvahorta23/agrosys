<?php namespace App\Models;

use CodeIgniter\Model;

class ComprasModel extends Model{

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

    function getcompras(){
        $builder = $this->db->table('procedimento_compra');
        return $builder->get()->getResult();
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
        $builder = $this->db->table('procedimento_compra_animal AS a');
        $builder->join('CAD_PROFISSIONAL AS b','a.identificacao_animal = b.IDENTIFICACAO', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS c','b.FK_ID_LOTE = c.ID_ANO_LETIVO', 'JOIN');
        $builder->where('a.id_procedimento_compra', $id);
        $result = $builder->get()->getResult();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;
    }

    public function getQuantidadeAnimaisPorProcedimento()
    {
        // Builder para contar os animais por procedimento de venda
        $builder = $this->db->table('procedimento_compra_animal AS pva');
        $builder->select('pv.descricao AS procedimento, COUNT(pva.id_procedimento_compra_animal) AS quantidade, sum(valor) as total')
                ->join('procedimento_compra AS pv', 'pva.id_procedimento_compra = pv.id_procedimento_compra', 'INNER')
                ->groupBy('pva.id_procedimento_compra')
                ->orderBy('quantidade', 'DESC');

        return $builder->get()->getResult();
    }

    public function getAnimaisMaisPesadosPorProcedimento($id_procedimento_compra)
    {
        // Builder para obter os 5 animais mais pesados de um procedimento de venda específico
        $builder = $this->db->table('procedimento_compra_animal AS pva');
        $builder->select('pva.identificacao_animal, pva.peso, pva.valor')
                ->where('pva.id_procedimento_compra', $id_procedimento_compra)
                ->orderBy('pva.peso', 'DESC')
                ->limit(5);

        return $builder->get()->getResult();
    }
}
?>