<?php

namespace App\Controllers;
use App\Models\EscolaModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\ProcLotesModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class ProcLotes extends BaseController
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
        $this->escolaModel = new EscolaModel();
        $this->ProcLotesModel = new ProcLotesModel();
        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ProcLotesModel->getProcLotes();    
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('proclote/proclote.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Detalhes($id)
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ProcLotesModel->getDetalheProcedimento(base64_decode($id));    
            $dados['idProcedimento'] = base64_decode($id);


            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('proclote/proclote_detalhes.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getProcedimentosPorLote(){

        echo json_encode($this->ProcLotesModel->getProcedimentosPorLote());
    } 

    public function getVacinasAgrupadas(){

        $id_procedimento_curral_animal = $this->request->getPost('idProcedimento');

        echo json_encode($this->ProcLotesModel->getVacinasAgrupadasPorProcedimento($id_procedimento_curral_animal));
    } 

    public function getMedicamentoAgrupadas(){

        $id_procedimento_curral_animal = $this->request->getPost('idProcedimento');

        echo json_encode($this->ProcLotesModel->getMedicacoesAgrupadasPorProcedimento($id_procedimento_curral_animal));
    } 


}
