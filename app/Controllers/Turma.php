<?php

namespace App\Controllers;
use App\Models\TurmaModel;
use App\Models\EscolaModel;
use App\Models\AlunoModel;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Turma extends BaseController
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
        $this->turmaModel = new TurmaModel();
        $this->escolaModel = new EscolaModel();
        $this->alunoModel = new AlunoModel();

        $this->auth = new Auth();
        helper('complementos');
    }


    public function index(){
        if($this->auth->checkAuth(13)){
            $dados = array();
            $dados_turma = array();
            $resultados = $this->turmaModel->getTurma($this->escola->ID_ESCOLA);

            for($i=0;$i<count($resultados);$i++){

                $dados_turma[$i]['ID_TURMA'] = $resultados[$i]->ID_TURMA;
                $dados_turma[$i]['ANO_LETIVO'] = $resultados[$i]->ANO_LETIVO;
                $dados_turma[$i]['ETAPA'] = $resultados[$i]->ETAPA;
                $dados_turma[$i]['NOME_TURMA'] = $resultados[$i]->NOME_TURMA;
                $dados_turma[$i]['TIPO_ATENDIMENTO'] = $resultados[$i]->TIPO_ATENDIMENTO;
                $dados_turma[$i]['ENTRADA'] = $resultados[$i]->ENTRADA;
                $dados_turma[$i]['SAIDA'] = $resultados[$i]->SAIDA;
                $dados_turma[$i]['PROFESSOR'] = $resultados[$i]->PROFESSOR;
                $qtd_aluno = $this->turmaModel->getAlunoTurma($resultados[$i]->ID_TURMA);
                $dados_turma[$i]['QTD_ALUNO'] = $qtd_aluno->QTD_ALUNO;
                $dados_turma[$i]['QTD_VAGAS'] = $resultados[$i]->QTD_VAGAS;


            }

            $dados['resultados'] = $dados_turma;


            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('turma/turma', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->checkAuth(14)){
            $dados['professores'] = $this->turmaModel->getProfessores($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('turma/turma_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('turma_id');
        if($id == ""){
            $dados['FK_ID_ANO_LETIVO'] = $this->request->getPost('ano_letivo');
            $dados['FK_ID_PROFISSIONAL'] = $this->request->getPost('profissional_cargo');
            $dados['ETAPA'] = $this->request->getPost('etapa_escolar');
            $dados['NOME_TURMA'] = $this->request->getPost('nome_turma');
            $dados['TIPO_ATENDIMENTO'] = $this->request->getPost('tipo_atendimento');
            $dados['ENTRADA'] = $this->request->getPost('horario_entrada');
            $dados['SAIDA'] = $this->request->getPost('horario_saida');
            $dados['DATA_INICIO_ANO_LETIVO'] = $this->request->getPost('inicio_ano');
            $dados['DATA_FINAL_ANO_LETIVO'] = $this->request->getPost('final_ano');
            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
            $dados['QTD_VAGAS'] = $this->request->getPost('qtd_vagas');

            $insert_id = $this->turmaModel->setTurma($dados);

            if($insert_id){
                return redirect()->to('/Turma/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Turma/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_TURMA'] = $this->request->getPost('turma_id');
            $dados['FK_ID_ANO_LETIVO'] = $this->request->getPost('ano_letivo');
            $dados['FK_ID_PROFISSIONAL'] = $this->request->getPost('profissional_cargo');
            $dados['ETAPA'] = $this->request->getPost('etapa_escolar');
            $dados['NOME_TURMA'] = $this->request->getPost('nome_turma');
            $dados['TIPO_ATENDIMENTO'] = $this->request->getPost('tipo_atendimento');
            $dados['ENTRADA'] = $this->request->getPost('horario_entrada');
            $dados['SAIDA'] = $this->request->getPost('horario_saida');
            $dados['DATA_INICIO_ANO_LETIVO'] = $this->request->getPost('inicio_ano');
            $dados['DATA_FINAL_ANO_LETIVO'] = $this->request->getPost('final_ano');
            $dados['QTD_VAGAS'] = $this->request->getPost('qtd_vagas');

            if($this->turmaModel->updateTurma($dados)){
                return redirect()->to('/Turma/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Turma/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(15)){
            $dados['turma'] = $this->turmaModel->getTurmaID(base64_decode($id));
            $dados['professores'] = $this->turmaModel->getProfessores($this->escola->ID_ESCOLA);
            $dados['ano_letivo'] = $this->turmaModel->getAnoLetivo();
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('turma/turma_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(16)){
            if($this->turmaModel->deleteTurma(base64_decode($id))){
                return redirect()->to('/Turma/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Turma/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getTurmaAno(){
        echo json_encode($this->turmaModel->getTurmaAno($this->request->getGet('ano')));
    }

    public function getTurmaAnoLetivoEtapa(){
        echo json_encode($this->alunoModel->getTurmaAnoLetivo($this->request->getPost('ano'), $this->request->getPost('etapa'), $this->escola->ID_ESCOLA));
    }

    public function getTurmaAluno(){
        echo json_encode($this->alunoModel->getAlunoTurma($this->request->getPost('turma')));
    }

    public function getTurmaProfessor(){
        echo json_encode($this->turmaModel->getTurmaProfessor($this->request->getPost('turma')));
    }

    public function getValidacaoMatricula(){
        $etapa = $this->request->getPost('etapa_escolar');

        if($etapa == "I1"){
            $idade_corte =  "4";
        } else if($etapa == "I2"){
            $idade_corte =  "5";
        } else if($etapa == "C1"){
            $idade_corte =  "1";
        } else if($etapa == "C2"){
            $idade_corte =  "2";
        } else if($etapa == "C3"){
            $idade_corte =  "3";
        }


        $aluno = $this->alunoModel->getAlunoID(base64_decode($this->request->getPost('aluno_id')));
        $idade = $this->calcularIdade($aluno->DATA_NASCIMENTO);
        
        if($idade != $idade_corte){
            echo json_encode(true);
        }else{
            echo json_encode(false);
        }

    }

    function calcularIdade($dataNascimento) {
        // Define o último dia de março do ano atual
        $dataAtual = new DateTime(date('Y') . '-03-31');
        // Converte a data de nascimento em um objeto DateTime
        $nascimento = new DateTime($dataNascimento);
        // Calcula a diferença entre as datas
        $idade = $nascimento->diff($dataAtual);
        return $idade->y;
    }
    

    public function getAlunoVinculo(){
        $turma = $this->turmaModel->getTurmaID($this->request->getGet('turma'));
        $turno_turma = $turma->TIPO_ATENDIMENTO;
        echo json_encode($this->turmaModel->getAlunoVinculo($turno_turma, base64_decode($this->request->getGet('aluno_id'))));
    }   

    public function getHabilidades(){
        $qtd_sim            = $this->turmaModel->getHabilidades($this->request->getPost('coluna'),"sim", $this->request->getPost('tabela'), $this->request->getPost('bimestre'));
        $qtd_nao            = $this->turmaModel->getHabilidades($this->request->getPost('coluna'),"nao", $this->request->getPost('tabela'), $this->request->getPost('bimestre'));
        $qtd_parcialmente   = $this->turmaModel->getHabilidades($this->request->getPost('coluna'),"parcialmente", $this->request->getPost('tabela'), $this->request->getPost('bimestre'));
        $nao_aplica         = $this->turmaModel->getHabilidades($this->request->getPost('coluna'), "naoaplica", $this->request->getPost('tabela'), $this->request->getPost('bimestre'));
        echo json_encode(array("qtd_sim" => $qtd_sim, "qtd_nao" => $qtd_nao, "qtd_parcialmente" => $qtd_parcialmente, "nao_aplica" => $nao_aplica));
    }   
    
    

    public function AtaResultadoFinal($id=""){

        $dados['turma'] = $this->turmaModel->getTurmaID(base64_decode($id));
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['turma']->FK_ID_ESCOLA);
        $dados['resultados'] = $this->alunoModel->getAlunoTurma(base64_decode($id));

        echo view('commons/header_impressao', $dados);
        echo view('turma/ata_resultado_final');
    }

    public function Alunos($id){
        if($this->auth->checkAuth(25)){
            $dados = array();
            $dados['resultados'] = $this->alunoModel->getAlunoTurma(base64_decode($id));
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/aluno', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }
}
