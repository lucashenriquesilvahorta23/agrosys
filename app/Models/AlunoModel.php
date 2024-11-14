<?php namespace App\Models;

use CodeIgniter\Model;

class AlunoModel extends Model{

    protected $table = 'CAD_ALUNO';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_ALUNO');
    }

    function getAluno($escola){
        $this->builder->orderBy('NOME_ALUNO',' ASC');
        $this->builder->where('FK_ID_ESCOLA', $escola);
        return $this->builder->get()->getResult();
    }

    function getAlunoTurmatotalAlunos($escola){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('AL.*');
        $builder->join('CAD_ANO_LETIVO AS B','A.FK_ID_ANO_LETIVO = B.ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS C','A.FK_ID_PROFISSIONAL = C.ID_PROFISSIONAL', 'LEFT');
        $builder->join('CAD_ALUNO_TURMA AS D','A.ID_TURMA = D.FK_ID_TURMA', 'INNER');
        $builder->join('CAD_ALUNO AS AL','AL.ID_ALUNO = D.FK_ID_ALUNO', 'INNER');
        $builder->where('A.FK_ID_ESCOLA', $escola);
        
        $result = $builder->get()->getResult();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;
    }

    function getAlunosSemTurma($escola){
        $builder = $this->db->table('CAD_ALUNO');
        $builder->select('CAD_ALUNO.*');
    
        // Subquery para verificar alunos que não estão em turmas
        $subQuery = $this->db->table('CAD_ALUNO_TURMA AS A')
                             ->select('FK_ID_ALUNO')
                             ->join('CAD_TURMA AS B', 'B.ID_TURMA = A.FK_ID_TURMA', 'INNER')
                             ->where('B.FK_ID_ESCOLA', $escola)
                             ->groupBy('FK_ID_ALUNO')
                             ->getCompiledSelect();
    
        // Aplicando a subquery no where
        $builder->where("ID_ALUNO NOT IN ($subQuery)", null, false);
    
        $result = $builder->get()->getResult();
        
        return $result;
    }

    function getAlunoID($id){
        $this->builder->where('ID_ALUNO', $id);
        return $this->builder->get()->getRow();
    }

    function getDeficiencia($id){
        $builder = $this->db->table('CAD_ALUNO_DEFICIENCIA');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }

    function getTranstorno($id){
        $builder = $this->db->table('CAD_ALUNO_TRANSTORNO');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }

    function getDoenca($id){
        $builder = $this->db->table('CAD_ALUNO_CRONICA');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }

    function setAluno($dados){
        $builder = $this->db->table('CAD_ALUNO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setDeficiencia($dados){
        $builder = $this->db->table('CAD_ALUNO_DEFICIENCIA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setTranstorno($dados){
        //var_dump($dados);die();
        $builder = $this->db->table('CAD_ALUNO_TRANSTORNO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        //echo $id;die();
        return $id;
    }

    function setDoencaCronica($dados){
        $builder = $this->db->table('CAD_ALUNO_CRONICA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateAluno($dados){
        $builder = $this->db->table('CAD_ALUNO');
        $builder->where('ID_ALUNO', $dados['ID_ALUNO']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteDeficiencia($id){
        $builder = $this->db->table('CAD_ALUNO_DEFICIENCIA');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }

    function deleteTranstorno($id){
        $builder = $this->db->table('CAD_ALUNO_TRANSTORNO');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }

    function deleteDoencaCronica($id){
        $builder = $this->db->table('CAD_ALUNO_CRONICA');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }

    function deleteAluno($id){
        $this->builder->where('ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }

    function getAlunoVinculoId($id){
        $builder = $this->db->table('CAD_ALUNO_TURMA AS A');
        $builder->where('ID_ALUNO_TURMA', $id);
        return $builder->get()->getRow();
    }

    function getAlunoVinculo($id){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('B.*, D.ANO_LETIVO, ETAPA, NOME_TURMA, TIPO_ATENDIMENTO, C.FK_ID_ESCOLA');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getResult();
    }

    function getAlunoVinculoIdCompleto($id){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.*, B.*, D.ANO_LETIVO, ETAPA, NOME_TURMA, TIPO_ATENDIMENTO, C.FK_ID_ESCOLA');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }

    function getAlunoTurma($id){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.*, B.SITUACAO, E.NOME_PROFISSIONAL, B.DATA_MATRICULA, DATA_ALTERACAO_SITUACAO');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS E','C.FK_ID_PROFISSIONAL = E.ID_PROFISSIONAL', 'LEFT');
        $builder->where('B.FK_ID_TURMA', $id);
        $builder->orderBy('NOME_ALUNO',' ASC');
        return $builder->get()->getResult();

    }

    function getAlunoTurmaID($id){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.*, B.*, E.NOME_PROFISSIONAL, D.*, C.*');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS E','C.FK_ID_PROFISSIONAL = E.ID_PROFISSIONAL', 'JOIN');
        $builder->where('B.FK_ID_ALUNO', $id);
        $builder->orderBy('NOME_ALUNO',' ASC');
        return $builder->get()->getResult();

    }

    function getAlunoTurmaIDUnico($id, $id_turma){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.*, B.*, E.NOME_PROFISSIONAL, D.*, C.*');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS E','C.FK_ID_PROFISSIONAL = E.ID_PROFISSIONAL', 'JOIN');
        $builder->where('B.FK_ID_ALUNO', $id);
        $builder->where('B.FK_ID_TURMA', $id_turma);
        $builder->orderBy('NOME_ALUNO',' ASC');
        $builder->limit("1");
        return $builder->get()->getResult();
    }

    function getAlunoTurmaDiagnostico($id, $semestre){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, B.DATA, B.DESCRICAO');
        $builder->join('CAD_REGISTRO_ALUNO AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->where('B.FK_ID_TURMA', $id);
        $builder->where('SEMESTRE', $semestre);
        $builder->orderBy('NOME_ALUNO',' ASC');
        return $builder->get()->getResult();
    }

    function getTurmaProfessor($id){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('E.*');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS E','C.FK_ID_PROFISSIONAL = E.ID_PROFISSIONAL', 'JOIN');
        $builder->where('B.FK_ID_TURMA', $id);
        return $builder->get()->getResult();

    }

    function getRelatorioAlunos($id, $sexo, $situacao, $escolaId){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.*, B.SITUACAO, E.NOME_PROFISSIONAL, B.DATA_MATRICULA, C.*');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS E','C.FK_ID_PROFISSIONAL = E.ID_PROFISSIONAL', 'JOIN');
        $builder->where('A.FK_ID_ESCOLA', $escolaId);
        if($sexo != ""){
            $builder->where('A.SEXO', $sexo);
        }
        if($situacao != ""){
            $builder->where('B.SITUACAO', $situacao);
        }
        if($id != ""){
            $builder->where('B.FK_ID_TURMA', $id);
        }
        
        $result = $builder->get()->getResult();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;



    }
    

    function getAlunoTurmatotal($id, $sexo, $situacao, $data_inicial, $data_final){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('COUNT(*) AS QTD_ALUNO');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->join('CAD_TURMA AS C','C.ID_TURMA = B.FK_ID_TURMA', 'JOIN');
        $builder->join('CAD_ANO_LETIVO AS D','D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS E','C.FK_ID_PROFISSIONAL = E.ID_PROFISSIONAL', 'LEFT');
        $builder->where('B.FK_ID_TURMA', $id);
        if($sexo != ""){
            $builder->where('A.SEXO', $sexo);
        }
        if($situacao != ""){
            $builder->where('B.SITUACAO', $situacao);
        }
        if($data_inicial != ""){
            $builder->where('DATA_MATRICULA >=', $data_inicial);
        }
        if($data_final != ""){
            $builder->where('DATA_MATRICULA <=', $data_final);
        }
        
        $result = $builder->get()->getRow();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;



    }

    public function getTurmaAlunoAno($anoLetivo, $escolaId)
    {
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('D.ANO_LETIVO, C.ETAPA, C.NOME_TURMA, COUNT(B.FK_ID_ALUNO) AS QTD_ALUNO, C.TIPO_ATENDIMENTO');
        $builder->join('CAD_ALUNO_TURMA AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'RIGHT');
        $builder->join('CAD_TURMA AS C', 'C.ID_TURMA = B.FK_ID_TURMA', 'RIGHT');
        $builder->join('CAD_ANO_LETIVO AS D', 'D.ID_ANO_LETIVO = C.FK_ID_ANO_LETIVO', 'RIGHT');
        $builder->where('C.FK_ID_ANO_LETIVO', $anoLetivo);
        $builder->where('C.FK_ID_ESCOLA', $escolaId);
        $builder->groupBy('C.ETAPA, C.NOME_TURMA, D.ANO_LETIVO, C.TIPO_ATENDIMENTO');

        return $builder->get()->getResult();
    }
    
    function getTurmaAnoLetivo($ano, $etapa="", $escola){
        $builder = $this->db->table('CAD_TURMA');
        $builder->where('FK_ID_ESCOLA', $escola);
        $builder->where('FK_ID_ANO_LETIVO', $ano);
        if($etapa != ""){
            $builder->where('ETAPA', $etapa);
        }
        return $builder->get()->getResult();
    }

    function setAlunoVinculo($dados){
        $builder = $this->db->table('CAD_ALUNO_TURMA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateAlunoVinculo($dados){
        $builder = $this->db->table('CAD_ALUNO_TURMA');
        $builder->where('ID_ALUNO_TURMA', $dados['ID_ALUNO_TURMA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteAlunoVinculo($id){
        $builder = $this->db->table('CAD_ALUNO_TURMA');
        $builder->where('ID_ALUNO_TURMA', $id)->delete();
        return $this->db->affectedRows();
    }

    function setIntolerancia($dados){
        $builder = $this->db->table('CAD_ALUNO_INTOLERANCIA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }
    
    function deleteIntolerancia($id){
        $builder = $this->db->table('CAD_ALUNO_INTOLERANCIA');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }
    
    function getIntolerancia($id){
        $builder = $this->db->table('CAD_ALUNO_INTOLERANCIA');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }

    function setAlergia($dados){
        $builder = $this->db->table('CAD_ALUNO_ALERGIA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }
    
    function deleteAlergia($id){
        $builder = $this->db->table('CAD_ALUNO_ALERGIA');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }
    
    function getAlergia($id){
        $builder = $this->db->table('CAD_ALUNO_ALERGIA');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }

    function setMedicamento($dados){
        $builder = $this->db->table('CAD_ALUNO_MEDICAMENTO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }
    
    function deleteMedicamento($id){
        $builder = $this->db->table('CAD_ALUNO_MEDICAMENTO');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }
    
    function getMedicamento($id){
        $builder = $this->db->table('CAD_ALUNO_MEDICAMENTO');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }
    
    function setTratamento($dados){
        $builder = $this->db->table('CAD_ALUNO_TRATAMENTO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }
    
    function deleteTratamento($id){
        $builder = $this->db->table('CAD_ALUNO_TRATAMENTO');
        $builder->where('FK_ID_ALUNO', $id)->delete();
        return $this->db->affectedRows();
    }
    
    function getTratamento($id){
        $builder = $this->db->table('CAD_ALUNO_TRATAMENTO');
        $builder->where('FK_ID_ALUNO', $id);
        return $builder->get()->getRow();
    }   

    function getAlunosDeficiencia($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_DEFICIENCIA AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_DEFICIENCIA', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosTranstorno($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_TRANSTORNO AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_TRANSTORNO', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosIntolerancia($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_INTOLERANCIA AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_INTOLERANCIA', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosAlergia($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_ALERGIA AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_ALERGIA', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosMedicamento($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_MEDICAMENTO AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_MEDICAMENTO', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosTratamento($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_TRATAMENTO AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_TRATAMENTO', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosDoencas($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO, B.* ');
        $builder->join('CAD_ALUNO_CRONICA AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_DOENCAS_CRONICAS', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }

    function getAlunosSuper($ano){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.SEXO, A.DATA_NASCIMENTO, A.CPF, D.NOME_TURMA, D.ETAPA, D.TIPO_ATENDIMENTO, C.SITUACAO');
        $builder->join('CAD_ALUNO_TURMA AS C', 'A.ID_ALUNO = C.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS D', 'C.FK_ID_TURMA = D.ID_TURMA', 'INNER');
        $builder->where('A.POSSUI_SUPERDOTACAO', "S");
        $builder->where('D.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResult();
    }
    
    
}
?>