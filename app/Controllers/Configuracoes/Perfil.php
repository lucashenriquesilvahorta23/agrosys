<?php namespace App\Controllers\Configuracoes;

 use App\Models\UsuarioModel;
 use CodeIgniter\Controller;
 use App\Models\PerfilModel;
 use App\Libraries\Auth;
 use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
 
 class Perfil extends Controller
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
        $this->usuarioModel = new UsuarioModel();
        $this->perfilModel = new PerfilModel();
        $this->auth = new Auth();
        helper('complementos');  
    }

    public function perfilConsultar(){
        if($this->auth->CheckAuth(7)){
            $dados = array();
            $dados['resultados'] = $this->perfilModel->getPerfis($this->request->getPost("id")); 

            echo view('commons/header');	
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('Configuracoes/Perfil/perfil', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function perfilCriar(){
        if($this->auth->CheckAuth(7)){
            echo view('commons/header');	
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('Configuracoes/Perfil/perfil_cadastro');
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function perfilInserir(){
        $dados = array();
        $id = $this->request->getPost('perfil_id');
        if($id == ""){
            $dados['DESCRICAO'] = $this->request->getPost('perfil_descricao');
            $dados['DATA'] = date('Y-m-d');

            $result = $this->perfilModel->setPerfil($dados);
            $this->perfilModel->setPerfilPermissao($this->request->getPost('checkperm'), $result);
            return redirect()->to('/Configuracoes/Perfil/perfilConsultar?tipo_msg=sucesso&msg=Ação realizada!');
        }else{
            $dados['ID_PERFIL'] = $id;
            $dados['DESCRICAO'] = $this->request->getPost('perfil_descricao');
            $result = $this->perfilModel->updatePerfil($dados);
            $this->perfilModel->setPerfilPermissao($this->request->getPost('checkperm'), $id);
            return redirect()->to('/Configuracoes/Perfil/perfilConsultar?tipo_msg=sucesso&msg=Ação realizada!');
        }
    }

    public function perfilEditar($id=""){
        if($this->auth->CheckAuth(7)){
            $dados['perfil'] = $this->perfilModel->getPerfilID(base64_decode($id));
            echo view('commons/header');	
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('Configuracoes/Perfil/perfil_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function perfilExcluir($id=""){
        if($this->auth->CheckAuth(7)){
            if($this->perfilModel->excluirPerfil(base64_decode($id))){
                return redirect()->to('/Configuracoes/Perfil/perfilConsultar?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Configuracoes/Perfil/perfilConsultar?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function perfilConsultarPermissoes(){
        echo json_encode($this->perfilModel->perfilConsultarPermissoes($this->request->getPost('id')));
    }
}