<?php

namespace App\Controllers;
use App\Models\EscolaModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\ComprasModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Compras extends BaseController
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
        $this->ComprasModel = new ComprasModel();
        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ComprasModel->getcompras();    
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('compras/compras.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Detalhes($id)
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ComprasModel->getDetalheProcedimento(base64_decode($id));    
            $dados['idProcedimento'] = base64_decode($id);

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('compras/compras_detalhes.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getQuantidadeAnimaisPorProcedimento(){

        echo json_encode($this->ComprasModel->getQuantidadeAnimaisPorProcedimento());
    } 

    public function getAnimaisMaisPesadosPorProcedimento(){

        $idProcedimento = $this->request->getPost('idProcedimento');

        echo json_encode($this->ComprasModel->getAnimaisMaisPesadosPorProcedimento($idProcedimento));
    } 


}
