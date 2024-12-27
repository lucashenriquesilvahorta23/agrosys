<?php

namespace App\Controllers;
use App\Models\EscolaModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\ProbLotesModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class ProbLotes extends BaseController
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
        $this->ProbLotesModel = new ProbLotesModel();
        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ProbLotesModel->getProbLotes();    
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('problote/problote.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Detalhes($id)
    {
        if($this->auth->checkAuth(21)){
            $dados['resultados'] = $this->ProbLotesModel->getDetalheProcedimento(base64_decode($id));    
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('problote/problote_detalhes.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getProblemasPorLote()
    {
        // Obtém problemas por lote
        $problemasPorLote = $this->ProbLotesModel->getProblemasPorLote();
        $dadosCompletos = [];
    
        // Para cada lote, obter detalhes dos problemas por tipo
        foreach ($problemasPorLote as $lote) {
            $idLote = $lote->id_lote; // Supondo que o campo 'id_lote' existe nos resultados
            $problemasPorTipo = $this->ProbLotesModel->getProblemasPorTipo($idLote);
    
            // Montar estrutura de dados
            $dadosCompletos[] = [
                'lote' => $lote,
                'problemasPorTipo' => $problemasPorTipo,
            ];
        }
    
        // Retornar os dados como JSON
        echo json_encode($dadosCompletos);
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
