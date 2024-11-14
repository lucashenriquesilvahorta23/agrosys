<?php

namespace App\Controllers;
use App\Models\AlunoModel;
use App\Models\TurmaModel;
use App\Models\EscolaModel;
use App\Models\ProfissaoModel;
use App\Models\ProfissionalModel;
use App\Models\AnoLetivoModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Documento extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
        $this->escola = $this->session->get('escola');
        if($this->usuario == null){
            header('Location: '.base_url());
            exit(); 
        }
		date_default_timezone_set('America/Sao_Paulo');
        $this->alunoModel = new AlunoModel();
        $this->anoLetivoModel = new AnoLetivoModel();
        $this->auth = new Auth();
        helper('complementos');
        $this->turmaModel = new TurmaModel();
        $this->escolaModel = new EscolaModel();
        $this->profissionalModel = new ProfissionalModel();
        $this->profissaoModel = new ProfissaoModel();
    }


    public function AtaDeResultadosFinais() {
        if ($this->auth->checkAuth(35)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/ata_resultado_final', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioAtaDeResultadosFinais() {
        if ($this->auth->checkAuth(35)) {
            $id = $this->request->getPost('turma');
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['turma']->FK_ID_ESCOLA);
            $dados['resultados'] = $this->alunoModel->getAlunoTurma($id);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID($dados['turma']->FK_ID_PROFISSIONAL);

    
            echo view('commons/header_impressao', $dados);
            echo view('turma/ata_resultado_final');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function FichaDeDiagnosticoDeAlunosComPatologiasEspecificas() {
        
    }

    public function FichaDeSaude() {
        
    }

    public function DeclaracaoDeConclusao() {
        if ($this->auth->checkAuth(36)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/declaracao_conslusao', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeclaracaoDeConclusao() {
        if ($this->auth->checkAuth(36)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $dados['turma']->ANO_LETIVO.$numeros;
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/declaracao_conclusao');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function HistoricoEscolar() {
        if ($this->auth->checkAuth(36)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();
            $dados['alunos'] = $this->alunoModel->getAluno($this->escola->ID_ESCOLA);


            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/historico_escolar', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioHistoricoEscolar() {
        if ($this->auth->checkAuth(36)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $dados['turma']->ANO_LETIVO.$numeros;

            $dados['resultados'] = $this->alunoModel->getAlunoTurmaID($id);;
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/historico_escolar');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function ComprovanteMatricula() {
        if ($this->auth->checkAuth(36)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/comprovante_matricula', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioComprovanteMatricula() {
        if ($this->auth->checkAuth(36)) {
            $id = $this->request->getPost('aluno');
            $turma = $this->request->getPost('turma');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $dados['resultados'] = $this->alunoModel->getAlunoTurmaIDUnico($id, $turma);
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/comprovante_matricula');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DeclaracaoDeFrequencia() {
        if ($this->auth->checkAuth(37)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/declaracao_frequencia', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeclaracaoDeFrequencia() {
        if ($this->auth->checkAuth(37)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $dados['turma']->ANO_LETIVO.$numeros;
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/declaracao_frequencia_aluno');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DeclaracaoParaTransferenciaEmCurso() {
        if ($this->auth->checkAuth(38)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/declaracao_transferencia', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeclaracaoParaTransferenciaEmCurso() {
        if ($this->auth->checkAuth(38)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $dados['turma']->ANO_LETIVO.$numeros;
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/declaracao_transferencia');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function EncaminhamentoNIS() {
        if ($this->auth->checkAuth(39)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/declaracao_nis', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioEncaminhamentoNIS() {
        if ($this->auth->checkAuth(39)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $dados['turma']->ANO_LETIVO.$numeros;
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/encaminhamento');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function FichaDeMatricula() {
        if ($this->auth->checkAuth(41)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/ficha_matricula', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioFichaDeMatricula($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
            $dados['aluno_deficiencia'] = $this->alunoModel->getDeficiencia($id);
            $dados['aluno_transtorno'] = $this->alunoModel->getTranstorno($id);
            $dados['aluno_doencas_cronicas'] = $this->alunoModel->getDoenca($id);
            $dados['aluno_intolerancia'] = $this->alunoModel->getIntolerancia($id);
            $dados['aluno_alergia'] = $this->alunoModel->getAlergia($id);
            $dados['aluno_medicamento'] = $this->alunoModel->getMedicamento($id);
            $dados['aluno_tratamento'] = $this->alunoModel->getTratamento($id);

            //var_dump($dados);die();
    
    
            echo view('commons/header_impressao_ficha', $dados);
            echo view('alunos/ficha_matricula');
        } else {
            return redirect()->to('/Acesso');
        }
    }
    

    public function FichaSaude() {
        if ($this->auth->checkAuth(41)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/ficha_saude', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioFichaSaude($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
            $dados['aluno_deficiencia'] = $this->alunoModel->getDeficiencia($id);
            $dados['aluno_transtorno'] = $this->alunoModel->getTranstorno($id);
            $dados['aluno_doencas_cronicas'] = $this->alunoModel->getDoenca($id);
            $dados['aluno_intolerancia'] = $this->alunoModel->getIntolerancia($id);
            $dados['aluno_alergia'] = $this->alunoModel->getAlergia($id);
            $dados['aluno_medicamento'] = $this->alunoModel->getMedicamento($id);
            $dados['aluno_tratamento'] = $this->alunoModel->getTratamento($id);

            //var_dump($dados);die();
    
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/ficha_saude');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function FichaDeProfissional() {
        if ($this->auth->checkAuth(41)) {
            $dados = array();

            $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "", "");


            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/ficha_profissional', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioFichaDeProfissional($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('profissional');
            $dados['aluno'] = $this->profissionalModel->getProfissionalID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);


            //var_dump($dados);die();
    
    
            echo view('commons/header_impressao_ficha_profisisonal', $dados);
            echo view('alunos/ficha_professor');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function PontoDeProfissional() {
        if ($this->auth->checkAuth(41)) {
            $dados = array();

            $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "", "");


            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/ponto_profissional', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioPontoDeProfissional($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('profissional');
            $ano = $this->request->getPost('ano');
            $mes = $this->request->getPost('mes');
            $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
            $dados['profissoes'] = $this->profissaoModel->getProfissao();
            
            $dados['ano'] = $ano;
            $dados['mes'] = $mes;
            
            if($this->request->getPost('profissional') != ""){
                $dados['profisisonais'] = $this->profissionalModel->getProfissionalIDArray($id);
            }else{
                $dados['profisisonais'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "", "");
            }


            //var_dump($dados);die();
    
            echo view('turma/ponto_profissional', $dados);
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function Carteirinha() {
        if ($this->auth->checkAuth(41)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/carteirinha', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioCarteirinha($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
            $dados['aluno_deficiencia'] = $this->alunoModel->getDeficiencia($id);
            $dados['aluno_transtorno'] = $this->alunoModel->getTranstorno($id);
            $dados['aluno_doencas_cronicas'] = $this->alunoModel->getDoenca($id);
            $dados['aluno_intolerancia'] = $this->alunoModel->getIntolerancia($id);
            $dados['aluno_alergia'] = $this->alunoModel->getAlergia($id);
            $dados['aluno_medicamento'] = $this->alunoModel->getMedicamento($id);
            $dados['aluno_tratamento'] = $this->alunoModel->getTratamento($id);

            //var_dump($dados);die();
    
    
            echo view('alunos/carteirinha_nova', $dados);
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RegistroDasVivenciasDesenvolvidas() {
        if ($this->auth->checkAuth(42)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/registro_vivencia', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRegistroDasVivenciasDesenvolvidas() {
        if ($this->auth->checkAuth(48)) {
            $id = $this->request->getPost('turma');
            $data_inicial = $this->request->getPost('data_inicial'); 
            $data_final = $this->request->getPost('data_final'); 

            // Crie os objetos DateTime
            $dataInicio = new DateTime($data_inicial);
            $dataFim = new DateTime($data_final);

            // Calcule a diferença
            $diferenca = $dataInicio->diff($dataFim);

            // Obtenha a quantidade de dias
            $quantidadeDias = $diferenca->days;

            $dados['qtd_dias'] = $quantidadeDias;

            $dados['data_inicial'] = $data_inicial;
            $dados['data_final'] = $data_final;
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['turma']->FK_ID_ESCOLA);

            $dados['chamadas'] = $this->turmaModel->getChamadasTurmaData($id, $data_inicial, $data_final);
            $dados['alunos'] = $this->alunoModel->getAlunoTurma($id);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID($dados['turma']->FK_ID_PROFISSIONAL);

    
            echo view('commons/header_impressao', $dados);
            echo view('turma/registro_vivencia');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RegistroIndividual() {
        if ($this->auth->checkAuth(42)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_individual', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRegistroIndividual() {
        if ($this->auth->checkAuth(48)) {
            $id = $this->request->getPost('aluno');
            $semestre = $this->request->getPost('semestre');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
            $dados['aluno_acompanhamento'] = $this->turmaModel->getDadosAlunoSemestre($semestre, $id, $dados['turma']->ID_TURMA, $dados['turma']->FK_ID_PROFISSIONAL);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID($dados['turma']->FK_ID_PROFISSIONAL);
            $dados['periodo'] = $semestre;
            

            //var_dump($dados);die();
    
    
            //echo view('commons/header_impressao_ficha', $dados);
            echo view('alunos/relatorio_individual', $dados);
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function FichaObs() {
        if ($this->auth->checkAuth(42)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/ficha_obs', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoFichaObs() {
        if ($this->auth->checkAuth(48)) {
            $id = $this->request->getPost('aluno');
            $bimestre = $this->request->getPost('bimestre');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID($dados['turma']->FK_ID_PROFISSIONAL);
            $dados['bimestre'] = $bimestre;
            $profissional = $dados['turma']->FK_ID_PROFISSIONAL;

            // Buscar dados de autonomia
            $dados['dados_autonomia'] = $this->turmaModel->getDadosAutonomia($dados['aluno']->ID_ALUNO, $profissional, $dados['aluno']->FK_ID_TURMA, $bimestre);

            // Buscar dados de aspectos cognitivos
            $dados['dados_cognitivos'] = $this->turmaModel->getDadosCognitivos($dados['aluno']->ID_ALUNO, $profissional, $dados['aluno']->FK_ID_TURMA, $bimestre);
            
            // Buscar dados de aspectos físicos
            $dados['dados_fisicos'] = $this->turmaModel->getDadosFisicos($dados['aluno']->ID_ALUNO, $profissional, $dados['aluno']->FK_ID_TURMA, $bimestre);
            
            // Buscar dados de motora fina
            $dados['dados_motora_fina'] = $this->turmaModel->getDadosMotoraFina($dados['aluno']->ID_ALUNO, $profissional, $dados['aluno']->FK_ID_TURMA, $bimestre);
            
            // Buscar dados de relação família-escola
            $dados['dados_relacao_familia_escola'] = $this->turmaModel->getDadosRelacaoFamiliaEscola($dados['aluno']->ID_ALUNO, $profissional, $dados['aluno']->FK_ID_TURMA, $bimestre);
            
            // Buscar dados de aspectos sociais e emocionais
            $dados['dados_sociais_emocionais'] = $this->turmaModel->getDadosSociaisEmocionais($dados['aluno']->ID_ALUNO, $profissional, $dados['aluno']->FK_ID_TURMA, $bimestre);

            //var_dump($dados);die();

            //print_r($dados);die();
    
            echo view('commons/header_impressao', $dados);
            echo view('turma/ficha_obs');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function IndicadoresFicha() {
        if ($this->auth->checkAuth(42)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/indicadores_ficha', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RegistroIndividualSala() {
        if ($this->auth->checkAuth(42)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_individual_sala', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRegistroIndividualSala() {
        if ($this->auth->checkAuth(48)) {
            $id = $this->request->getPost('turma');
            $semestre = $this->request->getPost('semestre');
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['turma']->FK_ID_ESCOLA);
            $dados['resultados'] = $this->alunoModel->getAlunoTurmaDiagnostico($id, $semestre);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID($dados['turma']->FK_ID_PROFISSIONAL);
            $dados['periodo'] = $semestre;


            //print_r($dados);die();
    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_diagnostico_Sala');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeAlunoPorTurma() {
        if ($this->auth->checkAuth(43)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/alunos_por_turma', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRelatorioDeAlunoPorTurma() {
        if ($this->auth->checkAuth(43)) {
            $id = $this->request->getPost('turma');
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['turma']->FK_ID_ESCOLA);
            $dados['resultados'] = $this->alunoModel->getAlunoTurma($id);

            $dados['resultados_matricula_inicial_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","", $dados['turma']->DATA_INICIAL_MATRICULA, $dados['turma']->DATA_FINAL_MATRICULA);
            $dados['resultados_matricula_inicial_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M","", $dados['turma']->DATA_INICIAL_MATRICULA, $dados['turma']->DATA_FINAL_MATRICULA);


            $dados['resultados_aluno_evadidos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","EV", "", "");
            $dados['resultados_aluno_evadidos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "EV", "", "");

            $dados['resultados_aluno_falecidos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","FL", "", "");
            $dados['resultados_aluno_falecidos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "FL", "", "");

            $dados['resultados_aluno_novos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","", $dados['turma']->DATA_FINAL_MATRICULA, $dados['turma']->DATA_FINAL);
            $dados['resultados_aluno_novos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "", $dados['turma']->DATA_FINAL_MATRICULA, $dados['turma']->DATA_FINAL);

            $dados['resultados_aluno_transferidos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F", "TR", "", "");
            $dados['resultados_aluno_transferidos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "TR", "", "");

            //print_r($dados);die();
    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_aluno_turma');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeAlunos() {
        if ($this->auth->checkAuth(43)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_alunos', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRelatorioDeAluno() {
        if ($this->auth->checkAuth(43)) {
            
            $ano_letivo = $this->request->getPost('ano_letivo');
            $id = $this->request->getPost('turma');
            $sexo = $this->request->getPost('sexo');
            $situacao = $this->request->getPost('situacao_aluno');
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
            $dados['resultados'] = $this->alunoModel->getRelatorioAlunos($id, $sexo, $situacao,$this->escola->ID_ESCOLA);
            $dados['ano'] = $this->turmaModel->getAnoLetivoId($ano_letivo);


            //print_r($dados);die();
    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_alunos');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeAlunosComPatologiasEspecificas() {
        if ($this->auth->checkAuth(43)) {
            $dados = array();
            $dados_turma = array();
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_saude', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeSaude(){
        if ($this->auth->checkAuth(43)) {
            $id = $this->request->getPost('doenca');
            $ano = $this->request->getPost('ano_letivo');
            $dados['categoria'] = $id;
            $dados['ano'] = $this->turmaModel->getAnoLetivoId($ano);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['ano']->FK_ID_ESCOLA);
            if($id == "DE"){
                $dados['resultados'] = $this->alunoModel->getAlunosDeficiencia($ano);
            }else if($id == "TR"){
                $dados['resultados'] = $this->alunoModel->getAlunosTranstorno($ano);
            }else if($id == "IA"){
                $dados['resultados'] = $this->alunoModel->getAlunosIntolerancia($ano);
            }else if($id == "AL"){
                $dados['resultados'] = $this->alunoModel->getAlunosAlergia($ano);
            }else if($id == "MC"){
                $dados['resultados'] = $this->alunoModel->getAlunosMedicamento($ano);
            }else if($id == "TE"){
                $dados['resultados'] = $this->alunoModel->getAlunosTratamento($ano);
            }else if($id == "DC"){
                $dados['resultados'] = $this->alunoModel->getAlunosDoencas($ano);
            }else if($id == "AH"){
                $dados['resultados'] = $this->alunoModel->getAlunosSuper($ano);
            }
            echo view('commons/header_impressao', $dados);
            echo view('alunos/relatorio_saude');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeFrequencia() {
        if ($this->auth->checkAuth(46)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_frequencia', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRelatorioDeFrequencia() {
        if ($this->auth->checkAuth(48)) {
            $id = $this->request->getPost('turma');
            $data_inicial = $this->request->getPost('data_inicial'); 
            $data_final = $this->request->getPost('data_final'); 

            // Crie os objetos DateTime
            $dataInicio = new DateTime($data_inicial);
            $dataFim = new DateTime($data_final);

            // Calcule a diferença
            $diferenca = $dataInicio->diff($dataFim);

            // Obtenha a quantidade de dias
            $quantidadeDias = $diferenca->days;

            $dados['qtd_dias'] = $quantidadeDias;

            $dados['data_inicial'] = $data_inicial;
            $dados['data_final'] = $data_final;
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['turma']->FK_ID_ESCOLA);

            $dados['chamadas'] = $this->turmaModel->getChamadasTurmaData($id, $data_inicial, $data_final);
            $dados['dia_nao_letivo'] = $this->turmaModel->getChamadasTurmaDataNaoLetivo($id, $data_inicial, $data_final);

            $dados['alunos'] = $this->alunoModel->getAlunoTurma($id);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID($dados['turma']->FK_ID_PROFISSIONAL);
            $dados['resultados'] = $this->alunoModel->getAlunoTurma($id);
            
            $dados['resultados_matricula_inicial_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","", $dados['turma']->DATA_INICIAL_MATRICULA, $dados['turma']->DATA_FINAL_MATRICULA);
            $dados['resultados_matricula_inicial_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M","", $dados['turma']->DATA_INICIAL_MATRICULA, $dados['turma']->DATA_FINAL_MATRICULA);


            $dados['resultados_aluno_evadidos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","EV", "", "");
            $dados['resultados_aluno_evadidos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "EV", "", "");

            $dados['resultados_aluno_falecidos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","FL", "", "");
            $dados['resultados_aluno_falecidos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "FL", "", "");

            $dados['resultados_aluno_novos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F","", $dados['turma']->DATA_FINAL_MATRICULA, $dados['turma']->DATA_FINAL);
            $dados['resultados_aluno_novos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "", $dados['turma']->DATA_FINAL_MATRICULA, $dados['turma']->DATA_FINAL);

            $dados['resultados_aluno_transferidos_feminino'] = $this->alunoModel->getAlunoTurmatotal($id, "F", "TR", "", "");
            $dados['resultados_aluno_transferidos_masculino'] = $this->alunoModel->getAlunoTurmatotal($id, "M", "TR", "", "");

    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_frequencia');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    

    public function RelatorioDeOcorrencias() {
        if ($this->auth->checkAuth(47)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_ocorrencia', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRelatorioDeOcorrencias() {
        if ($this->auth->checkAuth(47)) {
            $id = $this->request->getPost('turma');
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
            $data_inicial = $this->request->getPost('data_inicial'); 
            $data_final = $this->request->getPost('data_final'); 
            $aluno = $this->request->getPost('aluno'); 



            $dados['resultados'] = $this->alunoModel->getAlunoTurma($id);


            $dados_ocorrencia = array();
            if($dados['turma'] != ""){

                $resultados = $this->turmaModel->getOcorrenciasData($id, $dados['turma']->FK_ID_PROFISSIONAL, $data_inicial, $data_final);
    
                for($i=0;$i<count($resultados);$i++){
    
                    $alunos = $this->turmaModel->getEnvolvidosOcorrencia($resultados[$i]->ID_OCORRENCIA, $aluno);
    
                    if(count($alunos) > 0){
                        $alunos = $this->turmaModel->getEnvolvidosOcorrencia($resultados[$i]->ID_OCORRENCIA, "");
                        $dados_ocorrencia[$i]['ANO_LETIVO'] = $resultados[$i]->ANO_LETIVO;
                        $dados_ocorrencia[$i]['ID_OCORRENCIA'] = $resultados[$i]->ID_OCORRENCIA;
                        $dados_ocorrencia[$i]['TIPO_ATENDIMENTO'] = $resultados[$i]->TIPO_ATENDIMENTO;
                        $dados_ocorrencia[$i]['ETAPA'] = $resultados[$i]->ETAPA;
        
                        $dados_ocorrencia[$i]['NOME_TURMA'] = $resultados[$i]->NOME_TURMA;
                        $dados_ocorrencia[$i]['NOME_PROFISISONAL'] = $resultados[$i]->NOME_PROFISSIONAL;
                        $dados_ocorrencia[$i]['DATA_OCORRENCIA'] = $resultados[$i]->DATA . " " . $resultados[$i]->HORA;
                        $dados_ocorrencia[$i]['ALUNOS_OCORRENCIA'] = $alunos;
                        $dados_ocorrencia[$i]['DESCRICAO'] = $resultados[$i]->DESCRICAO;
                    }
    
    
                }
            }

            $dados['resultados'] = $dados_ocorrencia;

            $dados['ocorrencias_simples'] = $this->turmaModel->getOcorrenciasSimples($this->escola->ID_ESCOLA, $data_inicial, $data_final);




    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_ocorrencias');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeOcorrenciasgerais() {
        if ($this->auth->checkAuth(47)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_ocorrencia_gerais', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DocumentoRelatorioDeOcorrenciasgerais() {
        if ($this->auth->checkAuth(47)) {
            $id = $this->request->getPost('turma');
            $ano_letivo_filtrado = $this->request->getPost('ano_letivo');
            $ano_letivo_filtrado = $this->turmaModel->getAnoLetivoId($ano_letivo_filtrado);
            $ano_letivo_filtrado = $ano_letivo_filtrado->ANO_LETIVO;
            
            $dados['turma'] = $this->turmaModel->getTurmaID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
            $data_inicial = $this->request->getPost('data_inicial'); 
            $data_final = $this->request->getPost('data_final'); 
            $aluno = $this->request->getPost('aluno'); 



            $dados['resultados'] = $this->alunoModel->getAlunoTurma($id);


            $dados_ocorrencia = array();
            $profissional = "";
            if(isset($dados['turma'])){
                $profissional = $dados['turma']->FK_ID_PROFISSIONAL;
            }
            $resultados = $this->turmaModel->getOcorrenciasDataGerais($this->escola->ID_ESCOLA, $id, $profissional, $data_inicial, $data_final);


            for($i=0;$i<count($resultados);$i++){

                

                $alunos = $this->turmaModel->getEnvolvidosOcorrencia($resultados[$i]->ID_OCORRENCIA, $aluno);

                if(count($alunos) > 0){
                    $alunos = $this->turmaModel->getEnvolvidosOcorrencia($resultados[$i]->ID_OCORRENCIA, "");
                    $dados_ocorrencia[$i]['ALUNOS_OCORRENCIA'] = $alunos;
                }
                $dados_ocorrencia[$i]['ANO_LETIVO'] = $resultados[$i]->ANO_LETIVO;
                $dados_ocorrencia[$i]['ID_OCORRENCIA'] = $resultados[$i]->ID_OCORRENCIA;
                $dados_ocorrencia[$i]['TIPO_ATENDIMENTO'] = $resultados[$i]->TIPO_ATENDIMENTO;
                $dados_ocorrencia[$i]['ETAPA'] = $resultados[$i]->ETAPA;

                $dados_ocorrencia[$i]['NOME_TURMA'] = $resultados[$i]->NOME_TURMA;
                $dados_ocorrencia[$i]['NOME_PROFISISONAL'] = $resultados[$i]->NOME_PROFISSIONAL;
                $dados_ocorrencia[$i]['DATA_OCORRENCIA'] = $resultados[$i]->DATA . " " . $resultados[$i]->HORA;
                $dados_ocorrencia[$i]['DESCRICAO'] = $resultados[$i]->DESCRICAO;


            }

            $dados['resultados'] = $dados_ocorrencia;
            $dados['ano_letivo_filtrado'] = $ano_letivo_filtrado;






    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_ocorrencias_gerais');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeProfissionais() {
        if ($this->auth->checkAuth(48)) {
            $dados = array();

            $situacao = "";
            $cargo = "";
        

            if($this->request->getPost('pesquisa') == "S"){
                $situacao = $this->request->getPost('situacao_profissional');
                $cargo = $this->request->getPost('profissional_cargo');
            }

            if($this->usuario->TIPO == "AD"){
                $dados['resultados'] = $this->profissionalModel->getProfissional($situacao, $cargo);
            }else{
                $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, $situacao, $cargo);
            }
            $dados['profissoes'] = $this->profissaoModel->getProfissao();
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/profissional', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioProfissional(){
        
        
        $situacao = "";
        $cargo = "";
    

        if($this->request->getPost('pesquisa') == "S"){
            $situacao = $this->request->getPost('situacao_profissional');
            $cargo = $this->request->getPost('profissional_cargo');
        }

        if($this->usuario->TIPO == "AD"){
            $dados['resultados'] = $this->profissionalModel->getProfissional($situacao, $cargo);
        }else{
            $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, $situacao, $cargo);
        }

        $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
        $dados['funcao'] = $cargo;
        $dados['situacao'] = $situacao;

        echo view('commons/header_impressao', $dados);
        echo view('documentos/relatorio_profisisonais');
    }

    public function RelatorioDeTurmas() {
        if ($this->auth->checkAuth(49)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/relatorio_turmas', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioDeTurmasDocumento() {
        if ($this->auth->checkAuth(49)) {
            $id = $this->request->getPost('ano_letivo');
            $dados['resultados'] = $this->alunoModel->getTurmaAlunoAno($id, $this->escola->ID_ESCOLA);
            $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
    
            echo view('commons/header_impressao', $dados);
            echo view('turma/relatorio_turmas_alunos');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function TermoDeAutorizacaoParaUsoDeImagem() {
        if ($this->auth->checkAuth(50)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/autorizacao_imagem', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }
    
    public function RelatorioTermoDeAutorizacaoParaUsoDeImagem() {
        if ($this->auth->checkAuth(50)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/autorizacao_imagem');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function TermoDeCompromisso() {
        if ($this->auth->checkAuth(51)) {
            $dados = array();
            $dados_turma = array();
            $dados['turmas'] = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('documentos/termo_compromisso', $dados);
            echo view('commons/footer');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function RelatorioTermoDeCompromisso() {
        if ($this->auth->checkAuth(50)) {
            $id = $this->request->getPost('aluno');
            $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto($id);
            $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/termo_compromisso');
        } else {
            return redirect()->to('/Acesso');
        }
    }


    public function DeclaracaoConclusao($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/declaracao_conclusao');
    }

    public function DeclaracaoProfissionalAdmitido(){
        $dados = array();

        $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "A", "");


        echo view('commons/header');	          
        echo view('commons/navbartop');
        echo view('commons/navbarleft', getBarMenu($this->usuario));	
        echo view('documentos/declaracao_admitido', $dados);
        echo view('commons/footer');

        
    }

    public function RelatorioDeclaracaoProfissionalAdmitido($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('profissional');
            $dados['aluno'] = $this->profissionalModel->getProfissionalID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $numeros;


            //var_dump($dados);die();
    
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/declaracao_admitido');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DeclaracaoProfissionalDesligado(){
        $dados = array();

        $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "", "");


        echo view('commons/header');	          
        echo view('commons/navbartop');
        echo view('commons/navbarleft', getBarMenu($this->usuario));	
        echo view('documentos/declaracao_dispensado', $dados);
        echo view('commons/footer');

        
    }

    public function RelatorioDeclaracaoProfissionalDispensado($id="") {
        if ($this->auth->checkAuth(41)) {
            $id = $this->request->getPost('profissional');
            $dados['aluno'] = $this->profissionalModel->getProfissionalID($id);
            $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $numeros;


            //var_dump($dados);die();
    
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/declaracao_dispensado');
        } else {
            return redirect()->to('/Acesso');
        }
    }

    public function DeclaracaoComparecimento(){
        $dados = array();

        $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "", "");


        echo view('commons/header');	          
        echo view('commons/navbartop');
        echo view('commons/navbarleft', getBarMenu($this->usuario));	
        echo view('documentos/declaracao_comparecimento', $dados);
        echo view('commons/footer');

        
    }

    public function RelatorioDeclaracaoComparecimento($id="") {
        if ($this->auth->checkAuth(41)) {

            $nome_pessoa = $this->request->getPost('nome_pessoa'); 
            $profissional_cpf = $this->request->getPost('profissional_cpf'); 
            $motivo_reuniao = $this->request->getPost('motivo_reuniao'); 
            $data = $this->request->getPost('data'); 

            $dados['escola'] = $this->escolaModel->getEscolaID($this->escola->ID_ESCOLA);
            $dados['nome_pessoa'] = $nome_pessoa;
            $dados['profissional_cpf'] = $profissional_cpf;
            $dados['motivo_reuniao'] = $motivo_reuniao;
            $dados['data'] = $data;

            $numeros = '';

            for ($i = 0; $i < 5; $i++) {
                $numeros .= rand(0, 9); // Gera um número aleatório entre 0 e 9
            }

            $dados['codigo'] = $numeros;


            //var_dump($dados);die();
    
    
            echo view('commons/header_impressao', $dados);
            echo view('alunos/declaracao_comparecimento');
        } else {
            return redirect()->to('/Acesso');
        }
    }


    public function DeclaracaoFrequencia($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/declaracao_frequencia_aluno');
    }

    public function DeclaracaoTransferencia($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/declaracao_transferencia');
    }

    public function Encaminhamento($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/encaminhamento');
    }

    
}
