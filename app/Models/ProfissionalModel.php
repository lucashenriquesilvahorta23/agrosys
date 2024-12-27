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

    public function getPesoEDataPesagem($identificador)
    {
        $builder = $this->db->table('procedimento_curral_animal AS pca');
        $builder->select('pca.peso, pc.data AS data_pesagem')
                ->join('procedimento_curral AS pc', 'pca.id_procedimento_curral = pc.id_procedimento_curral', 'JOIN')
                ->where('pca.identificacao_animal', $identificador)
                ->groupBy('pc.data')
                ->orderBy('pc.data', 'ASC'); // Ordena por data mais recente
            
        $result = $builder->get()->getResult();
    
        // Formatar a data para o padrão brasileiro
        foreach ($result as &$row) {
            if (isset($row->data_pesagem)) {
                $row->data_pesagem = date("d/m/Y", strtotime($row->data_pesagem));
            }
        }
    
        return $result;
    }
    
    function getVacinasAgrupadasPorProcedimento($identificador) {
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('c.nome, COUNT(c.id) as total_vacinas');
        $builder->join('procedimento_vacina AS b', 'a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('vacinas AS c', 'b.id_vacina = c.id', 'JOIN');
        $builder->where('identificacao_animal', $identificador);
        $builder->groupBy('c.nome');
        $builder->orderBy('total_vacinas', 'DESC');
        return $builder->get()->getResult();
    }
    
    function getMedicacoesAgrupadasPorProcedimento($identificador) {
        $builder = $this->db->table("procedimento_curral_animal as a");
        $builder->select('c.nome, COUNT(c.id) as total_medicacoes');
        $builder->join('procedimento_medicacao AS b', 'a.id_procedimento_curral_animal = b.id_procedimento_curral_animal', 'JOIN');
        $builder->join('produtos AS c', 'b.id_medicacao = c.id', 'JOIN');
        $builder->where('identificacao_animal', $identificador);
        $builder->groupBy('c.nome');
        $builder->orderBy('total_medicacoes', 'DESC');
        return $builder->get()->getResult();
    }

}
?>