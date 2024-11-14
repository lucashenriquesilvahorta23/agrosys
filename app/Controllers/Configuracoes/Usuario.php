<?php namespace App\Controllers\Configuracoes;

 use App\Models\UsuarioModel;
 use App\Models\ProfissionalModel;
 use CodeIgniter\Controller;
 use App\Models\TurmaModel;
 use App\Libraries\Auth;
 use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
 
 class Usuario extends Controller
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
        $this->profissionalModel = new ProfissionalModel();
        $this->turmaModel = new TurmaModel();
        $this->auth = new Auth();
        helper('complementos');  
    }

    public function usuarioConsultar(){
        if($this->auth->CheckAuth(2)){
            $dados = array();
            $dados['resultados'] = $this->usuarioModel->getUsuarios();
            echo view('commons/header');	
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('Configuracoes/Usuario/usuario', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->CheckAuth(3)){
            //$dados['professores'] = $this->turmaModel->getProfessores($this->escola->ID_ESCOLA);
            $dados['professores'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "A", "");


            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('Configuracoes/Usuario/usuario_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('usuario_id');
        if($id == ""){
            $dados['NOME'] = $this->request->getPost('usuario_nome');
            $dados['USUARIO'] = mb_strtoupper($this->request->getPost('usuario_login'),'UTF-8');
            $dados['SENHA'] = sha1(preg_replace('/[^[:alnum:]_]/', '',$this->request->getPost('usuario_senha'))); 
            $dados['EMAIL'] = $this->request->getPost('usuario_email');
            $dados['TELEFONE'] = $this->request->getPost('usuario_telefone');
            $dados['ATIVO'] = $this->request->getPost('usuario_status');
            $dados['TIPO'] = $this->request->getPost('usuario_tipo');
            $dados['FK_ID_PROFISSIONAL'] = $this->request->getPost('profissional_cargo');
            
            if($this->usuarioModel->setUsuario($dados)){
                return redirect()->to('/Configuracoes/Usuario/usuarioConsultar?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Configuracoes/Usuario/usuarioConsultar?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $alterar_senha = $this->request->getPost('alterar_senha');
            if($alterar_senha == "S"){
                $dados['ID_USUARIO'] = $this->request->getPost('usuario_id');
                if($this->request->getPost('usuario_senha') != "" && $this->request->getPost('usuario_senha') != null){
                    $dados['SENHA'] = sha1(preg_replace('/[^[:alnum:]_]/', '',$this->request->getPost('usuario_senha'))); 
                }
                
                if($this->usuarioModel->updateUsuario($dados)){
                    return redirect()->to('/Configuracoes/Usuario/AlterarSenha?tipo_msg=sucesso&msg=Ação realizada!');
                }else{
                    return redirect()->to('/Configuracoes/Usuario/AlterarSenha?tipo_msg=erro&msg=Erro ao realizar ação!');
                }
            }else{
                $dados['ID_USUARIO'] = $this->request->getPost('usuario_id');
                $dados['NOME'] = $this->request->getPost('usuario_nome');
                $dados['USUARIO'] = mb_strtoupper($this->request->getPost('usuario_login'),'UTF-8');
                $dados['EMAIL'] = $this->request->getPost('usuario_email');
                $dados['TELEFONE'] = $this->request->getPost('usuario_telefone');
                $dados['ATIVO'] = $this->request->getPost('usuario_status');
                $dados['TIPO'] = $this->request->getPost('usuario_tipo');
                $dados['FK_ID_PROFISSIONAL'] = $this->request->getPost('profissional_cargo');
                if($this->request->getPost('usuario_senha') != "" && $this->request->getPost('usuario_senha') != null){
                    $dados['SENHA'] = sha1(preg_replace('/[^[:alnum:]_]/', '',$this->request->getPost('usuario_senha'))); 
                }
                
                if($this->usuarioModel->updateUsuario($dados)){
                    return redirect()->to('/Configuracoes/Usuario/usuarioConsultar?tipo_msg=sucesso&msg=Ação realizada!');
                }else{
                    return redirect()->to('/Configuracoes/Usuario/usuarioConsultar?tipo_msg=erro&msg=Erro ao realizar ação!');
                }
            }
        }
    }

    public function Editar($id=""){
        if($this->auth->CheckAuth(4)){
            //$dados['professores'] = $this->turmaModel->getProfessores($this->escola->ID_ESCOLA);
            $dados['professores'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "A", "");
            $dados['usuario'] = $this->usuarioModel->getUsuarioID(base64_decode($id));
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('Configuracoes/Usuario/usuario_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function UsuarioVerificar(){
        echo json_encode($this->usuarioModel->usuarioVerificar($this->request->getPost('usuario')));
    }

    public function AlterarSenha($id=""){
        if($this->auth->CheckAuth(52)){
            $id = $this->usuario->ID_USUARIO;
            //$dados['professores'] = $this->turmaModel->getProfessores($this->escola->ID_ESCOLA);
            $dados['professores'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, "A", "");
            $dados['usuario'] = $this->usuarioModel->getUsuarioID($id);
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('Configuracoes/Usuario/usuario_senha', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }


}