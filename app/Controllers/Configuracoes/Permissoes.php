<?php namespace App\Controllers\Configuracoes;

 use App\Models\UsuarioModel;
 use App\Models\EscolaModel;
 use CodeIgniter\Controller;
 use App\Libraries\Auth;
 use CodeIgniter\HTTP\RequestInterface;
 use CodeIgniter\HTTP\ResponseInterface;
 use Psr\Log\LoggerInterface;
 
 class Permissoes extends Controller
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
        $this->usuariosModel = new UsuarioModel();
        $this->escolaModel = new EscolaModel();
        $this->auth = new Auth();
        helper('complementos'); 
    }

	public function permissoesConsultar(){
        if($this->auth->CheckAuth(5)){
            $dados = array();
            $dados['usuarios'] = $this->usuariosModel->getUsuariosPermissao($this->usuario->ID_USUARIO);
            $dados['escolas'] = $this->escolaModel->getEscolas();
            $dados['perfis'] = $this->usuariosModel->getPerfisPermissao();

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('Configuracoes/Permissoes/permissoes', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function permissoesInserir(){
        if($this->auth->CheckAuth(6)){
            $this->usuariosModel->setPermissoesUsuario($this->request->getPost('checkperm'), $this->request->getPost('permissoes_usuarios'), $this->request->getPost('profissional_escola'));
            return redirect()->to('/Configuracoes/Permissoes/permissoesConsultar?tipo_msg=sucesso&msg=Ação realizada!');
        }
    }

    public function permissoesConsultarUsuario(){
        echo json_encode($this->usuariosModel->getPermissoesUsuario($this->request->getPost('usuario')));
    }
}