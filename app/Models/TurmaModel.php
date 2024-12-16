<?php namespace App\Models;

use CodeIgniter\Model;

class TurmaModel extends Model{

    protected $table = 'CAD_TURMA';

    public function __construct(){
        $this->db      = \Config\Database::connect();
        $this->builder = $this->db->table('CAD_TURMA');
    }

    function getTurma($escola){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('B.NOME_LOTE, ID_TURMA, ETAPA, QTD_VAGAS, NOME_TURMA, TIPO_ATENDIMENTO, ENTRADA, SAIDA, "" AS PROFESSOR');
        $builder->join('CAD_ANO_LETIVO AS B','A.FK_ID_ANO_LETIVO = B.ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS C','A.FK_ID_PROFISSIONAL = C.ID_PROFISSIONAL', 'LEFT');
        $builder->where('A.FK_ID_ESCOLA', $escola);
        return $builder->get()->getResult();
    }

    function getTurmaEscola($escola){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('A.ID_TURMA, B.ANO_LETIVO AS ANO');
        $builder->join('CAD_ANO_LETIVO AS B','A.FK_ID_ANO_LETIVO = B.ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS C','A.FK_ID_PROFISSIONAL = C.ID_PROFISSIONAL', 'LEFT');
        $builder->where('A.FK_ID_ESCOLA', $escola);
        return $builder->get()->getResult();
    }

    function getAlunoTurmatotalAlunos($escola){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('COUNT(*) AS QTD_ALUNO');
        $builder->join('CAD_ANO_LETIVO AS B','A.FK_ID_ANO_LETIVO = B.ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS C','A.FK_ID_PROFISSIONAL = C.ID_PROFISSIONAL', 'LEFT');
        $builder->join('CAD_ALUNO_TURMA AS D','A.ID_TURMA = D.FK_ID_TURMA', 'INNER');
        $builder->where('A.FK_ID_ESCOLA', $escola);
        $anoAtual = date('Y');
        $builder->where('B.ANO_LETIVO', $anoAtual);
        
        $result = $builder->get()->getRow();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;
    }

    function getAlunosSemTurma($escola){
        $builder = $this->db->table('CAD_ALUNO');
        $builder->select('COUNT(*) AS QTD_ALUNO');
        $builder->where('FK_ID_ESCOLA', $escola);

    
        // Subquery para verificar alunos que não estão em turmas
/*         $subQuery = $this->db->table('CAD_ALUNO_TURMA AS A')
                             ->select('FK_ID_ALUNO')
                             ->join('CAD_TURMA AS B', 'B.ID_TURMA = A.FK_ID_TURMA', 'INNER')
                             ->where('B.FK_ID_ESCOLA', $escola)
                             ->groupBy('FK_ID_ALUNO')
                             ->getCompiledSelect();
    
        // Aplicando a subquery no where
        $builder->where("ID_ALUNO NOT IN ($subQuery)", null, false); */
    
        $result = $builder->get()->getRow();
        
        return $result;
    }

    function getAniversariantesDoMesAluno($mesReferencia, $escola) {
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select("DATE_FORMAT(A.DATA_NASCIMENTO, '%d/%m') AS 'DIA', A.NOME_ALUNO, C.NOME_TURMA");
        $builder->join('CAD_ALUNO_TURMA AS B', 'A.ID_ALUNO = B.FK_ID_ALUNO', 'INNER');
        $builder->join('CAD_TURMA AS C', 'C.ID_TURMA = B.FK_ID_TURMA', 'INNER');
        $builder->join('CAD_ANO_LETIVO AS D', 'C.FK_ID_ANO_LETIVO = D.ID_ANO_LETIVO', 'INNER');
        $builder->where('B.SITUACAO', 'CU');
        $builder->where('MONTH(A.DATA_NASCIMENTO)', $mesReferencia);
        $anoAtual = date('Y');
        $builder->where('D.ANO_LETIVO', $anoAtual);
        $builder->where('A.FK_ID_ESCOLA', $escola);
    
        // Executando a consulta e retornando os resultados
        $result = $builder->get()->getResult();
        
        return $result;
    }
    
    
    function getAniversariantesDoMesProfessor($mesReferencia, $escola) {
        $builder = $this->db->table('CAD_PROFISSIONAL');
        $builder->select("DATE_FORMAT(DATA_NASCIMENTO, '%d/%m') AS 'DIA', NOME_PROFISSIONAL");
        
        // Adicionando a condição para filtrar pelo mês de nascimento
        $builder->where('MONTH(DATA_NASCIMENTO)', $mesReferencia);
        $builder->where('FK_ID_ESCOLA', $escola);

    
        // Executando a consulta e retornando os resultados
        $result = $builder->get()->getResult();
        
        return $result;
    }

    function getDatasAnoLetivo($anoAtual, $escolaId) {
        $builder = $this->db->table('CAD_ANO_LETIVO AS A');
        $builder->select('B.DATA, B.DESCRICAO_DATA, A.ANO_LETIVO');
        $builder->join('CAD_DATAS_ANO_LETIVO AS B', 'A.ID_ANO_LETIVO = B.FK_ID_ANO_LETIVO', 'INNER');
        $builder->where('A.FK_ID_ESCOLA', $escolaId);
        $builder->where('A.ANO_LETIVO', $anoAtual);    
        // Executando a consulta e retornando os resultados
        $result = $builder->get()->getResult();
    
        return $result;
    }
    
    
    
    

    function getTurmaProfissional($escola, $profissional){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('A.NOME_TURMA, A.ID_TURMA, B.ANO_LETIVO');
        $builder->join('CAD_ANO_LETIVO AS B','A.FK_ID_ANO_LETIVO = B.ID_ANO_LETIVO', 'JOIN');
        $builder->where('A.FK_ID_ESCOLA', $escola);
        $builder->where('A.FK_ID_PROFISSIONAL', $profissional);
        return $builder->get()->getResult();
    }

    function getAlunoTurmaProfissional($turma){
        $builder = $this->db->table('CAD_ALUNO AS A');
        $builder->select('A.NOME_ALUNO, A.ID_ALUNO, SITUACAO');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_ALUNO = B.FK_ID_ALUNO', 'JOIN');
        $builder->where('B.FK_ID_TURMA', $turma);
        $builder->orderBy('A.NOME_ALUNO', 'ASC');
        return $builder->get()->getResult();
    }

    function getTurmaAno($ano){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->where('A.FK_ID_ANO_LETIVO', $ano);
        return $builder->get()->getResultArray();
    }

    function getTurmasSimples(){
        $builder = $this->db->table('CAD_TURMA');
        return $builder->get()->getResult();
    }


    function getTurmaID($id){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->join('CAD_ANO_LETIVO AS B','A.FK_ID_ANO_LETIVO = B.ID_ANO_LETIVO', 'JOIN');
        $builder->where('ID_TURMA', $id);
        return $builder->get()->getRow();
    }

    function getDadosAlunoSemestre($semestre, $aluno, $turma, $profissional){
        $builder = $this->db->table('CAD_ACOMPANHAMENTO_ALUNO');
        $builder->where('SEMESTRE', $semestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_PROFISSIONAL', $profissional);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    function getDadosAlunoSemestreRegistro($semestre, $aluno, $turma, $profissional){
        $builder = $this->db->table('CAD_REGISTRO_ALUNO');
        $builder->where('SEMESTRE', $semestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_PROFISSIONAL', $profissional);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    function getChamadasTurma($profissional ,$id_turma, $data){
        $builder = $this->db->table('CAD_CHAMADA');
        $builder->select('CONCAT(ID_CHAMADA, " - ", DATE_FORMAT(DATA, "%d/%m/%Y"), " ", HORA) AS CHAMADA, FK_ID_TURMA, ID_CHAMADA');
        $builder->where('FK_ID_PROFESSOR', $profissional);
        $builder->where('FK_ID_TURMA', $id_turma);
        if($data != ""){
            $builder->where('DATA', $data);
        }

        // Para ver a query gerada
        //$query = $builder->getCompiledSelect();
        //echo $query; // Ou use log_message('debug'

        return $builder->get()->getResult();
    }

    function getChamadasTurmaData($id_turma, $data_inicial, $data_final){
        $builder = $this->db->table('CAD_CHAMADA AS A');
        $builder->select('DATA, ID_CHAMADA, CODIGO, DESCRICAO ');
        $builder->join('CAD_TURMA AS B','B.ID_TURMA = A.FK_ID_TURMA', 'JOIN');
        $builder->where('FK_ID_TURMA', $id_turma);
        $builder->where('DIA_NAO_LETIVO', "N");
        if($data_inicial != ""){
            $builder->where('DATA >=', $data_inicial);
        }
        if($data_final != ""){
            $builder->where('DATA <=', $data_final);
        }
        $builder->groupBy('DATA');

        // Para ver a query gerada
        //$query = $builder->getCompiledSelect();
        //echo $query; // Ou use log_message('debug'

        return $builder->get()->getResult();
    }

    function getChamadasTurmaDataNaoLetivo($id_turma, $data_inicial, $data_final){
        $builder = $this->db->table('CAD_CHAMADA AS A');
        $builder->select('DATA, ID_CHAMADA, CODIGO, DESCRICAO, A.OBSERVACOES ');
        $builder->join('CAD_TURMA AS B','B.ID_TURMA = A.FK_ID_TURMA', 'JOIN');
        $builder->where('FK_ID_TURMA', $id_turma);
        $builder->where('DIA_NAO_LETIVO', "S");
        if($data_inicial != ""){
            $builder->where('DATA >=', $data_inicial);
        }
        if($data_final != ""){
            $builder->where('DATA <=', $data_final);
        }
        $builder->groupBy('DATA');

        // Para ver a query gerada
        //$query = $builder->getCompiledSelect();
        //echo $query; // Ou use log_message('debug'

        return $builder->get()->getResult();
    }

    function getFrequenciaAluno($id_chamada, $id_aluno){
        $builder = $this->db->table('CAD_CHAMADA AS A ');
        $builder->join('CAD_FREQUENCIA_CHAMADA AS B','A.ID_CHAMADA = B.FK_ID_CHAMADA', 'JOIN');
        $builder->where('FK_ID_ALUNO', $id_aluno);
        $builder->where('FK_ID_CHAMADA', $id_chamada);
        return $builder->get()->getRow();
    }

    function getJustificativas($id_chamada){
        $builder = $this->db->table('CAD_CHAMADA AS A ');
        $builder->select('C.NOME_ALUNO, B.OBSERVACOES ');
        $builder->join('CAD_FREQUENCIA_CHAMADA AS B','A.ID_CHAMADA = B.FK_ID_CHAMADA', 'JOIN');
        $builder->join('CAD_ALUNO AS C','B.FK_ID_ALUNO = C.ID_ALUNO', 'JOIN');
        $builder->where('PRESENTE != ', "S");
        $builder->where('B.OBSERVACOES != ', "");
        $builder->where('B.OBSERVACOES IS NOT NULL');
        $builder->where('FK_ID_CHAMADA', $id_chamada);
        return $builder->get()->getResult();
    }

    

    function getchamadaId($id){
        $builder = $this->db->table('CAD_CHAMADA');
        $builder->where('ID_CHAMADA', $id);
        return $builder->get()->getRow();
    }

    function getEnvolvidoschamadaId($id){
        $builder = $this->db->table('CAD_FREQUENCIA_CHAMADA');
        $builder->where('FK_ID_CHAMADA', $id);

        // Para ver a query gerada
        //$query = $builder->getCompiledSelect();
        //echo $query; // Ou use log_message('debug'
        return $builder->get()->getResult();
    }

    function updateChamada($dados){
        $builder = $this->db->table('CAD_CHAMADA');
        $builder->where('ID_CHAMADA', $dados['ID_CHAMADA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function updateChamadaAluno($dados){
        $builder = $this->db->table('CAD_FREQUENCIA_CHAMADA');
        $builder->where('FK_ID_CHAMADA', $dados['FK_ID_CHAMADA']);
        $builder->where('FK_ID_ALUNO', $dados['FK_ID_ALUNO']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }


    function deleteChamadaAluno($id){
        $builder = $this->db->table('CAD_FREQUENCIA_CHAMADA');
        $builder->where('FK_ID_CHAMADA', $id)->delete();
        return $this->db->affectedRows();
    }
    

    function setTurma($dados){
        $builder = $this->db->table('CAD_TURMA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setChamada($dados){
        $builder = $this->db->table('CAD_CHAMADA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setAcompanhamento($dados){
        $builder = $this->db->table('CAD_ACOMPANHAMENTO_ALUNO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setRegistro($dados){
        $builder = $this->db->table('CAD_REGISTRO_ALUNO');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setChamadaAluno($dados){
        $builder = $this->db->table('CAD_FREQUENCIA_CHAMADA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function setNotificacao($dados){
        $builder = $this->db->table('CAD_NOTIFICACAO_FALTA_CHAMADA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function updateNotificacao($dados){
        $builder = $this->db->table('CAD_NOTIFICACAO_FALTA_CHAMADA');
        $builder->where('ID_NOTIFICACAO_FALTA_CHAMADA', $dados['ID_NOTIFICACAO_FALTA_CHAMADA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    
    function getNotificacoes($usuario, $escola){
        $builder = $this->db->table('CAD_CHAMADA AS A');
        $builder->join('CAD_TURMA AS B','A.FK_ID_TURMA = B.ID_TURMA', 'JOIN');
        $builder->join('CAD_NOTIFICACAO_FALTA_CHAMADA AS C','C.FK_ID_CHAMADA = A.ID_CHAMADA', 'JOIN');
        $builder->where('FK_ID_USUARIO', $usuario);
        $builder->where('C.FK_ID_ESCOLA', $escola);
        $builder->where('LIDO', "N");
        return $builder->get()->getRow();
    }

    function getChamadaTurma($turma, $usuario){
        $builder = $this->db->table('CAD_NOTIFICACAO_FALTA_CHAMADA AS A');
        $builder->join('CAD_CHAMADA AS B','A.FK_ID_CHAMADA = B.ID_CHAMADA', 'JOIN');
        $builder->where('A.FK_ID_TURMA', $turma);
        $builder->where('FK_ID_USUARIO', $usuario);
        $builder->where('LIDO', "N");
        return $builder->get()->getResult();
    }

    function getChamadaData($turma, $data){
        $builder = $this->db->table('CAD_CHAMADA');
        $builder->select('count(*) as QTD_DATA');
        $builder->where('FK_ID_TURMA', $turma);
        $builder->where('DATA', $data);
        return $builder->get()->getRow();
    }

    function getAlunosChamadas($id_chamada){
        $builder = $this->db->table('CAD_CHAMADA AS A ');
        $builder->select('C.ID_ALUNO, C.FILIACAO_1_TELEFONE, C.NOME_ALUNO, B.*');
        $builder->join('CAD_FREQUENCIA_CHAMADA AS B','A.ID_CHAMADA = B.FK_ID_CHAMADA', 'JOIN');
        $builder->join('CAD_ALUNO AS C','B.FK_ID_ALUNO = C.ID_ALUNO', 'JOIN');
        $builder->where('PRESENTE', "N");
        $builder->where('FK_ID_CHAMADA', $id_chamada);
        return $builder->get()->getResult();
    }

    function getHabilidades($coluna, $tipo, $tabela, $bimestre){
        $builder = $this->db->table($tabela);
        $builder->select("COUNT(*) AS QTD");
        $builder->where($coluna, $tipo);
        $builder->where('BIMESTRE', $bimestre);
        return $builder->get()->getRow();
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


    function deleteOcorrenciaAluno($id){
        $builder = $this->db->table('CAD_ENVOLVIDOS_OCORRENCIA');
        $builder->where('FK_ID_OCORRENCIA', $id)->delete();
        return $this->db->affectedRows();
    }
    


    function setOcorrenciaAluno($dados){
        $builder = $this->db->table('CAD_ENVOLVIDOS_OCORRENCIA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    function getOcorrencias($profissional, $turma, $data){
        $builder = $this->db->table('CAD_OCORRENCIA');
        $builder->select(' CONCAT(ID_OCORRENCIA, " - ", DATE_FORMAT(DATA, "%d/%m/%Y"), " ", HORA) AS OCORRENCIA, FK_ID_TURMA, ID_OCORRENCIA');
        $builder->where('FK_ID_PROFESSOR', $profissional);
        $builder->where('FK_ID_TURMA', $turma);
        if($data != ""){
            $builder->where('DATA', $data);
        }
        return $builder->get()->getResult();
    }

    
    function getOcorrenciasData($id, $profissional, $data_inicial, $data_final){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('ID_TURMA, ANO_LETIVO, ETAPA, NOME_TURMA, TIPO_ATENDIMENTO, ENTRADA, DESCRICAO, SAIDA, ID_TURMA, ID_OCORRENCIA, DATE_FORMAT(DATA, "%d/%m/%Y") as DATA, HORA, NOME_PROFISSIONAL');
        $builder->join('CAD_ANO_LETIVO AS B','B.ID_ANO_LETIVO = A.FK_ID_ANO_LETIVO', 'JOIN');
        $builder->join('CAD_OCORRENCIA AS C','C.FK_ID_TURMA = A.ID_TURMA', 'JOIN');
        $builder->join('CAD_PROFISSIONAL AS D','D.ID_PROFISSIONAL = C.FK_ID_PROFESSOR', 'JOIN');
        $builder->where('C.FK_ID_PROFESSOR', $profissional);
        $builder->where('C.FK_ID_TURMA', $id);
        if($data_inicial != ""){
            $builder->where('C.DATA >=', $data_inicial);
        }
        if($data_final != ""){
            $builder->where('C.DATA <=', $data_final);
        }
        return $builder->get()->getResult();
    }

    function getOcorrenciasDataGerais($escola, $id="", $profissional="", $data_inicial="", $data_final=""){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('ID_TURMA, ANO_LETIVO, ETAPA, NOME_TURMA, TIPO_ATENDIMENTO, ENTRADA, DESCRICAO, SAIDA, ID_TURMA, ID_OCORRENCIA, DATE_FORMAT(DATA, "%d/%m/%Y") as DATA, HORA, NOME_PROFISSIONAL');
        $builder->join('CAD_ANO_LETIVO AS B','B.ID_ANO_LETIVO = A.FK_ID_ANO_LETIVO', 'LEFT');
        $builder->join('CAD_OCORRENCIA AS C','C.FK_ID_TURMA = A.ID_TURMA', 'RIGHT');
        $builder->join('CAD_PROFISSIONAL AS D','D.ID_PROFISSIONAL = C.FK_ID_PROFESSOR', 'LEFT');
        $builder->where('C.FK_ID_ESCOLA', $escola);
        if($profissional != ""){
            $builder->where('C.FK_ID_PROFESSOR', $profissional);
        }
        if($id != ""){
            $builder->where('C.FK_ID_TURMA', $id);
        }
        if($data_inicial != ""){
            $builder->where('C.DATA >=', $data_inicial);
        }
        if($data_final != ""){
            $builder->where('C.DATA <=', $data_final);
        }
        return $builder->get()->getResult();

        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
    }

    function getOcorrenciasSimples($escola, $data_inicial, $data_final){
        $builder = $this->db->table('CAD_OCORRENCIA_SIMPLES');
        $builder->where('FK_ID_ESCOLA', $escola);
        if($data_inicial != ""){
            $builder->where('DATA >=', $data_inicial);
        }
        if($data_final != ""){
            $builder->where('DATA <=', $data_final);
        }
        return $builder->get()->getResult();
    }

    

    function getOcorrenciasAluno($profissional, $turma){
        $builder = $this->db->table('CAD_ENVOLVIDOS_OCORRENCIA e');
        $builder->select('CONCAT(a.NOME_ALUNO, " - ", COUNT(e.ID_ENVOLVIDOS_OCORRENCIA)) AS ALUNO_OCORRENCIA');
        $builder->join('CAD_OCORRENCIA o','e.FK_ID_OCORRENCIA = o.ID_OCORRENCIA', 'JOIN');
        $builder->join('CAD_ALUNO a ','e.FK_ID_ALUNO = a.ID_ALUNO', 'JOIN');
        $builder->where('o.FK_ID_PROFESSOR', $profissional);
        $builder->where('FK_ID_TURMA', $turma);
        $builder->groupBy('a.NOME_ALUNO');
        return $builder->get()->getResult();
    }


    function getOcorrenciaId($id){
        $builder = $this->db->table('CAD_OCORRENCIA');
        $builder->where('ID_OCORRENCIA', $id);
        return $builder->get()->getRow();
    }

    function getEnvolvidosOcorrencia($id, $aluno=""){
        $builder = $this->db->table('CAD_ENVOLVIDOS_OCORRENCIA AS A');
        $builder->select('B.NOME_ALUNO');
        $builder->join('CAD_ALUNO AS B','A.FK_ID_ALUNO = B.ID_ALUNO', 'JOIN');
        $builder->where('FK_ID_OCORRENCIA', $id);
        if($aluno != ""){
            $builder->where('FK_ID_ALUNO', $aluno);
        }
        return $builder->get()->getResult();
    }


    function getEnvolvidosOcorrenciaId($id){
        $builder = $this->db->table('CAD_ENVOLVIDOS_OCORRENCIA');
        $builder->where('FK_ID_OCORRENCIA', $id);
        return $builder->get()->getResult();
    }

    function getEnvolvidosOcorrenciaIdAlunos($id){
        $builder = $this->db->table('CAD_ENVOLVIDOS_OCORRENCIA AS A');
        $builder->join('CAD_ALUNO AS B','A.FK_ID_ALUNO = B.ID_ALUNO', 'JOIN');
        $builder->where('FK_ID_OCORRENCIA', $id);
        return $builder->get()->getResult();
    }


    function updateTurma($dados){
        $builder = $this->db->table('CAD_TURMA');
        $builder->where('ID_TURMA', $dados['ID_TURMA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function updateAcompanhamento($dados){
        $builder = $this->db->table('CAD_ACOMPANHAMENTO_ALUNO');
        $builder->where('ID_ACOMPANHAMENTO_ALUNO', $dados['ID_ACOMPANHAMENTO_ALUNO']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function updateRegistro($dados){
        $builder = $this->db->table('CAD_REGISTRO_ALUNO');
        $builder->where('ID_REGISTRO_ALUNO', $dados['ID_REGISTRO_ALUNO']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    function deleteTurma($id){
        $this->builder->where('ID_TURMA', $id)->delete();
        return $this->db->affectedRows();
    }

    function getProfessores($escola){
        $builder = $this->db->table('CAD_PROFISSIONAL');
        $builder->where('CARGO', '1');
        $builder->where('FK_ID_ESCOLA', $escola);
        return $builder->get()->getResult();
    }

    function getProfessoresGeral(){
        $builder = $this->db->table('CAD_PROFISSIONAL');
        $builder->where('CARGO', '1');
        return $builder->get()->getResult();
    }

    function getAnoLetivo(){
        $builder = $this->db->table('CAD_ANO_LETIVO');
        return $builder->get()->getResult();
    }

    function getAnoLetivoId($id){
        $builder = $this->db->table('CAD_ANO_LETIVO');
        $builder->where('ID_ANO_LETIVO', $id);
        return $builder->get()->getRow();
    }

    function getAnoLetivoAtual($ano, $escola){
        $builder = $this->db->table('CAD_ANO_LETIVO');
        $builder->where('ANO_LETIVO', $ano);
        $builder->where('FK_ID_ESCOLA', $escola);
        return $builder->get()->getRow();
    }

    function getAlunoTurma($id_turma){
        $builder = $this->db->table('CAD_ALUNO_TURMA');
        $builder->select('COUNT(*) AS QTD_ALUNO');
        $builder->where('FK_ID_TURMA', $id_turma);
        return $builder->get()->getRow();
    }

    function getAlunoVinculo($turno_turma, $id_aluno){
        $builder = $this->db->table('CAD_TURMA AS A');
        $builder->select('COUNT(*) AS QTD_ALUNO');
        $builder->join('CAD_ALUNO_TURMA AS B','A.ID_TURMA = B.FK_ID_TURMA', 'INNER');
        $builder->where('FK_ID_ALUNO', $id_aluno);
        $builder->where('TIPO_ATENDIMENTO', $turno_turma);
        
        $result = $builder->get()->getRow();
    
        // Capturar e exibir a última consulta SQL
        //$lastQuery = $this->db->getLastQuery();
        //echo $lastQuery;
        //die();
        return $result;
    }


    public function getDadosAutonomia($aluno, $profissional, $turma, $bimestre){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_AUTONOMIA');
        $builder->where('BIMESTRE', $bimestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    public function setAspectosAutonomia($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_AUTONOMIA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    public function updateAspectosAutonomia($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_AUTONOMIA');
        $builder->where('ID_ASPECTOS_AUTONOMIA', $dados['ID_ASPECTOS_AUTONOMIA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    public function getDadosCognitivos($aluno, $profissional, $turma, $bimestre){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_COGNITIVOS');
        $builder->where('BIMESTRE', $bimestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    public function setAspectosCognitivos($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_COGNITIVOS');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    public function updateAspectosCognitivos($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_COGNITIVOS');
        $builder->where('ID_ASPECTOS_COGNITIVOS', $dados['ID_ASPECTOS_COGNITIVOS']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    public function getDadosFisicos($aluno, $profissional, $turma, $bimestre){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_FISICOS');
        $builder->where('BIMESTRE', $bimestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    public function setAspectosFisicos($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_FISICOS');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    public function updateAspectosFisicos($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_FISICOS');
        $builder->where('ID_ASPECTOS_FISICOS', $dados['ID_ASPECTOS_FISICOS']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    public function getDadosMotoraFina($aluno, $profissional, $turma, $bimestre){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_MOTORA_FINA');
        $builder->where('BIMESTRE', $bimestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    public function setAspectosMotoraFina($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_MOTORA_FINA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    public function updateAspectosMotoraFina($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_MOTORA_FINA');
        $builder->where('ID_ASPECTOS_MOTORA_FINA', $dados['ID_ASPECTOS_MOTORA_FINA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    public function getDadosRelacaoFamiliaEscola($aluno, $profissional, $turma, $bimestre){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_RELACAO_FAMILIA_ESCOLA');
        $builder->where('BIMESTRE', $bimestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    public function setAspectosRelacaoFamiliaEscola($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_RELACAO_FAMILIA_ESCOLA');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    public function updateAspectosRelacaoFamiliaEscola($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_RELACAO_FAMILIA_ESCOLA');
        $builder->where('ID_ASPECTOS_RELACAO_FAMILIA_ESCOLA', $dados['ID_ASPECTOS_RELACAO_FAMILIA_ESCOLA']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    public function getDadosSociaisEmocionais($aluno, $profissional, $turma, $bimestre){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_SOCIAIS_EMOCIONAIS');
        $builder->where('BIMESTRE', $bimestre);
        $builder->where('FK_ID_ALUNO', $aluno);
        $builder->where('FK_ID_TURMA', $turma);
        return $builder->get()->getRow();
    }

    public function setAspectosSociaisEmocionais($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_SOCIAIS_EMOCIONAIS');
        $builder->insert($dados);
        $id = $this->db->insertID();
        return $id;
    }

    public function updateAspectosSociaisEmocionais($dados){
        $builder = $this->db->table('CAD_ALUNO_ASPECTOS_SOCIAIS_EMOCIONAIS');
        $builder->where('ID_ASPECTOS_SOCIAIS_EMOCIONAIS', $dados['ID_ASPECTOS_SOCIAIS_EMOCIONAIS']);
        $builder->update($dados);
        return $this->db->affectedRows();
    }

    

}
?>