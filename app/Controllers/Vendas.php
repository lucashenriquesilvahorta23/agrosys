<?php

namespace App\Controllers;
use App\Models\EscolaModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\VendaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Vendas extends BaseController
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
        $this->vendaModel = new VendaModel();
        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->vendaModel->getVendas();    
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('vendas/vendas.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Detalhes($id)
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->vendaModel->getDetalheProcedimento(base64_decode($id));    
            $dados['idProcedimento'] = base64_decode($id);
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('vendas/vendas_detalhes.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getQuantidadeAnimaisPorProcedimento(){

        echo json_encode($this->vendaModel->getQuantidadeAnimaisPorProcedimento());
    } 

    public function getAnimaisMaisPesadosPorProcedimento(){

        $idProcedimento = $this->request->getPost('idProcedimento');

        echo json_encode($this->vendaModel->getAnimaisMaisPesadosPorProcedimento($idProcedimento));
    } 


}
