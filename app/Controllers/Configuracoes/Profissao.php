<?php namespace App\Controllers\Configuracoes;

 use App\Models\ProfissaoModel;
 use CodeIgniter\Controller;
 use App\Libraries\Auth;
 use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
 
 class Profissao extends Controller
 {

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
        if($this->usuario == null){
            header('Location: '.base_url());
            exit(); 
        }
		date_default_timezone_set('America/Sao_Paulo');
        $this->profissaoModel = new ProfissaoModel();
        $this->auth = new Auth();
        helper('complementos');  
    }

    public function index(){
        if($this->auth->CheckAuth(31)){
            $dados = array();
            $dados['resultados'] = $this->profissaoModel->getProfissao();
            echo view('commons/header');	
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('Configuracoes/Profissao/profissao', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->CheckAuth(32)){
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('Configuracoes/Profissao/profissao_cadastro');
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('profissao_id');
        $dados['NOME'] = $this->request->getPost('profissao_nome');
        if($id == ""){
            if($this->profissaoModel->setProfissao($dados)){
                return redirect()->to('/Configuracoes/Profissao/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Configuracoes/Profissao/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_PROFISSAO'] = $this->request->getPost('profissao_id');
            
            if($this->profissaoModel->updateProfissao($dados)){
                return redirect()->to('/Configuracoes/Profissao/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Configuracoes/Profissao/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }
    }

    public function Editar($id=""){
        if($this->auth->CheckAuth(33)){
            $dados['profissao'] = $this->profissaoModel->getProfissaoID(base64_decode($id));
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('Configuracoes/Profissao/profissao_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(34)){
            if($this->profissaoModel->deleteProfissao(base64_decode($id))){
                return redirect()->to('/Configuracoes/Profissao/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Configuracoes/Profissao/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }


}