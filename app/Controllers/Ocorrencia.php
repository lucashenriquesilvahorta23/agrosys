<?php

namespace App\Controllers;
use App\Models\OcorrenciaModel;
use App\Models\AnoLetivoModel;
use App\Models\TurmaModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Ocorrencia extends BaseController
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
        $this->ocorrenciaModel = new OcorrenciaModel();
        $this->anoLetivoModel = new AnoLetivoModel();
        $this->turmaModel = new TurmaModel();

        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ocorrenciaModel->getOcorrencia($this->escola->ID_ESCOLA);
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('ocorrencia/ocorrencia.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->checkAuth(22)){
            $dados['anos'] = $this->anoLetivoModel->getAnoLetivo($this->escola->ID_ESCOLA);
            $dados['dados_ocorrencia'] = "";
            $dados['dados_envolvidos_ocorrencia'] = "";

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('ocorrencia/ocorrencia_cadastro.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('ocorrencia_id');



        $data = $this->request->getPost('data');
        $hora = $this->request->getPost('hora');
        $descricao = $this->request->getPost('descricao');
        $alunos = $this->request->getPost('alunos');
        $turma = $this->request->getPost('turma');
        

        $dados_ocorrencia['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
        $dados_ocorrencia['FK_ID_TURMA'] = $turma;
        $dados_ocorrencia['FK_ID_PROFESSOR'] = $this->usuario->FK_ID_PROFISSIONAL;
        $dados_ocorrencia['DATA'] = $data;
        $dados_ocorrencia['HORA'] = $hora;
        $dados_ocorrencia['DESCRICAO'] = $descricao;

        if($this->request->getPost('ocorrencia_id') != "" && $this->request->getPost('ocorrencia_id') != null){
            $dados_ocorrencia['ID_OCORRENCIA'] = $this->request->getPost('ocorrencia_id');
            $this->turmaModel->updateOcorrencia($dados_ocorrencia);
            $this->turmaModel->deleteOcorrenciaAluno($this->request->getPost('ocorrencia_id'));
            $insert_id = $this->request->getPost('ocorrencia_id');
        }else{
            $insert_id = $this->turmaModel->setOcorrencia($dados_ocorrencia);
        }



        if (isset($alunos)) {
            // Itera sobre cada aluno
            foreach ($alunos as $aluno) {
                $dados_ocorrencia_aluno['FK_ID_OCORRENCIA'] = $insert_id;
                $dados_ocorrencia_aluno['FK_ID_ALUNO'] = $aluno;
        
                $this->turmaModel->setOcorrenciaAluno($dados_ocorrencia_aluno);
        
            }
        }






        if($insert_id != ""){
            return redirect()->to('/Ocorrencia/index?tipo_msg=sucesso&msg=Ação realizada!');
        }else{
            return redirect()->to('/Ocorrencia/index?tipo_msg=erro&msg=Erro ao realizar ação!');

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(23)){
            $dados['ocorrencia'] = $this->ocorrenciaModel->getOcorrenciaID(base64_decode($id));
            $dados['anos'] = $this->anoLetivoModel->getAnoLetivo($this->escola->ID_ESCOLA);
            $dados['dados_envolvidos_ocorrencia'] = $this->turmaModel->getEnvolvidosOcorrenciaIdAlunos(base64_decode($id));



            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('ocorrencia/ocorrencia_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(24)){
            if($this->ocorrenciaModel->deleteOcorrencia(base64_decode($id))){
                return redirect()->to('/Ocorrencia/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Ocorrencia/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }
}
