<?php

namespace App\Controllers;
use App\Models\EscolaModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\DocumentoEscolaModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Escola extends BaseController
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
        $this->documentoEscolaModel = new DocumentoEscolaModel();
        $this->auth = new Auth();
        helper('complementos');
    }

    public function index()
    {
        if($this->auth->checkAuth(21)){
            if($this->usuario->TIPO == "AD"){
                $dados['resultados'] = $this->escolaModel->getEscolas();    
            }else{
                $dados['resultados'] = $this->escolaModel->getEscolasProfissional($this->escola->ID_ESCOLA);
            }
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('escola/escola.php', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Foto($id){
        if($this->auth->CheckAuth(21)){
            $dados = array();
            $dados['resultados'] = $this->documentoEscolaModel->getFotos(base64_decode($id));            
            $dados['id_escola'] = base64_decode($id);
            $dados['escola'] = $this->escolaModel->getEscolaID(base64_decode($id));
            
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('escola/foto', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoInserir($id){
        if($this->auth->CheckAuth(21)){

            $dados['id_escola'] = $id;

            //var_dump($dados);die();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('escola/foto_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoStore(){
        $dados = array();   
        $id = $this->request->getPost('id_foto');
        $id_escola = $this->request->getPost('id_escola');

        if($id == ""){
            $arquivo = $this->request->getFile('aluno_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Escola/Foto?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('aluno_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            $dados['DESCRICAO'] = $this->request->getPost('descricao');;
            $dados['FK_ID_ESCOLA'] = $id_escola;
            //var_dump($dados);die();
            $insert_id = $this->documentoEscolaModel->setFoto($dados);

            if($insert_id){
                return redirect()->to('/Escola/Foto/'.base64_encode($id_escola).'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Escola/Foto/'.base64_encode($id_escola).'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}

        }else{

            $dados['ID_DOCUMENTO_ESCOLA'] = $id;
            $dados['DESCRICAO'] = $this->request->getPost('descricao');
            $dados['FK_ID_ESCOLA'] = $id_escola;
            $arquivo = $this->request->getFile('aluno_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Escola/Foto/'.base64_encode($id_escola).'?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('aluno_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            $resp = $this->documentoEscolaModel->updateFoto($dados);

            if($resp){
                return redirect()->to('/Escola/Foto/'.base64_encode($id_escola).'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Escola/Foto/'.base64_encode($id_escola).'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }
    }

    public function FotoEditar($id=""){
        if($this->auth->CheckAuth(21)){
            $dados['foto'] = $this->documentoEscolaModel->getFotoID(base64_decode($id));
            $dados['id_escola'] = $dados['foto']->FK_ID_ESCOLA;

            //var_dump($dados);die();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('escola/foto_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoExcluir($id="", $id_escola=""){
        if($this->auth->CheckAuth(21)){
            if($this->documentoEscolaModel->deleteFoto(base64_decode($id))){
                return redirect()->to('/Escola/Foto/'.$id_escola.'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Escola/Foto/'.$id_escola.'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->checkAuth(22)){
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('escola/escola_cadastro.php');
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('escola_id');
        $dados['INEP'] = $this->request->getPost('inep');
        $dados['CME'] = $this->request->getPost('cme');
        $dados['ESCOLA'] = $this->request->getPost('nome');
        $dados['MANTEDORA'] = $this->request->getPost('mantedora');
        $dados['CNPJ'] = $this->request->getPost('cnpj');
        $dados['FUNCIONAMENTO'] = $this->request->getPost('funcionamento');
        $dados['CEP'] = $this->request->getPost('cep');
        $dados['LOGRADOURO'] = $this->request->getPost('endereco');
        $dados['MUNICIPIO'] = $this->request->getPost('cidade');
        $dados['BAIRRO'] = $this->request->getPost('bairro');
        $dados['TELEFONE'] = $this->request->getPost('tel');
        $dados['EMAIL'] = $this->request->getPost('email');
        $dados['GESTOR'] = $this->request->getPost('gestor');
        $dados['CELULAR_GESTOR'] = $this->request->getPost('tel_g');
        $dados['CPF_GESTOR'] = $this->request->getPost('escola_cpf');
        $dados['COORDENADOR'] = $this->request->getPost('coordenador');
        $dados['CELULAR_COORDENADOR'] = $this->request->getPost('tel_c');
        $dados['CPF_COORDENADOR'] = $this->request->getPost('coordenador_cpf');
        $dados['ENTRADA'] = $this->request->getPost('horario_entrada');
        $dados['SAIDA'] = $this->request->getPost('horario_saida');
        $dados['ENTRADA_TARDE'] = $this->request->getPost('horario_entrada_tarde');
        $dados['SAIDA_TARDE'] = $this->request->getPost('horario_saida_tarde');
        $arquivo = $this->request->getFile('foto_escola');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[foto_escola]',
                        'mime_in[foto_escola,image/jpg,image/jpeg,image/png]',
                        'max_size[foto_escola,2048]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Escola/index?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('foto_escola');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
        if($id == ""){
            if($this->escolaModel->setEscola($dados)){
                return redirect()->to('/Escola/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Escola/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_ESCOLA'] = $this->request->getPost('escola_id');
            if($this->escolaModel->updateEscola($dados)){
                return redirect()->to('/Escola/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Escola/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(23)){
            $dados['escola'] = $this->escolaModel->getEscolaID(base64_decode($id));
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('escola/escola_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(24)){
            if($this->escolaModel->deleteEscola(base64_decode($id))){
                return redirect()->to('/Escola/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Escola/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }
}
