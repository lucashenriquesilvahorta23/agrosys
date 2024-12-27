<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\AlunoModel;
use App\Models\TurmaModel;
use App\Models\ProbLotesModel;
use App\Models\ProfissionalModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Home extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->usuarioModel = new UsuarioModel();
        $this->alunoModel = new AlunoModel();
        $this->turmaModel = new TurmaModel();
        $this->ProbLotesModel = new ProbLotesModel();
        $this->profissionalModel = new ProfissionalModel();
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
        $this->escola = $this->session->get('escola');
        if($this->usuario == null){
            header('Location: '.base_url());
            exit(); 
        }
		date_default_timezone_set('America/Sao_Paulo');
        helper('complementos');
    }

    public function index()
    {
        

        echo view('commons/header');
        echo view('commons/navbartop');
        echo view('commons/navbarleft', getBarMenu($this->usuario));
        echo view('dash');
        echo view('commons/footer');
    }

    public function marcarComoLido($id){
        $dados = array();
        $dados['ID_NOTIFICACAO_FALTA_CHAMADA'] = $id;
        $dados['LIDO'] = "S";

        $insert_id = $this->turmaModel->updateNotificacao($dados);

        if($insert_id){
            return redirect()->to('/Home/index?tipo_msg=sucesso&msg=Ação realizada!');
        }else{
            return redirect()->to('/Home/index?tipo_msg=erro&msg=Erro ao realizar ação!');
        }
            
    }

    public function getProblemasPorLote()
    {
        // Obtém problemas por lote
        echo json_encode($this->ProbLotesModel->getProblemasPorLote());

    }

    public function getProblemasRecorrentes(){
        echo json_encode($this->ProbLotesModel->getProblemasRecorrentes());

    }

    public function getMedicamentos(){
        echo json_encode($this->ProbLotesModel->getMedicamentos());

    }

    public function getVacina(){
        echo json_encode($this->ProbLotesModel->getVacina());

    }


    public function getAnimaisMaisPesadosPorProcedimento(){

        echo json_encode($this->ProbLotesModel->getAnimaisMaisPesadosPorProcedimento());
    } 
}
