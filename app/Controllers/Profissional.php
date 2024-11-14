<?php

namespace App\Controllers;
use App\Models\ProfissionalModel;
use App\Models\UsuarioModel;
use App\Models\ProfissaoModel;
use CodeIgniter\HTTP\RequestInterface;
use App\Models\DocumentoProfissionalModel;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Profissional extends BaseController
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
        $this->profissionalModel = new ProfissionalModel();
        $this->usuarioModel = new UsuarioModel();
        $this->profissaoModel = new ProfissaoModel();
        $this->documentoProfissionalModel = new DocumentoProfissionalModel();
        $this->auth = new Auth();
        helper('complementos');
    }


    public function index(){
        if($this->auth->checkAuth(17)){
            $dados = array();

            $situacao = "";
            $cargo = "";

            if($this->request->getPost('pesquisar') == "S"){
                $situacao = $this->request->getPost('situacao_profissional');
                $cargo = $this->request->getPost('profissional_cargo');
            }


            if($this->usuario->TIPO == "AD"){
                //$dados['resultados'] = $this->profissionalModel->getProfissional($situacao, $cargo);
                $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, $situacao, $cargo);

            }else{
                $dados['resultados'] = $this->profissionalModel->getProfissionalEscola($this->escola->ID_ESCOLA, $situacao, $cargo);
            }
            $dados['profissoes'] = $this->profissaoModel->getProfissao();
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('profissionais/profissional', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Foto($id){
        if($this->auth->CheckAuth(17)){
            $dados = array();
            $dados['resultados'] = $this->documentoProfissionalModel->getFotos(base64_decode($id));            
            $dados['id_profissional'] = base64_decode($id);
            $dados['profissional'] = $this->profissionalModel->getProfissionalID(base64_decode($id));
            
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('profissionais/foto', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoInserir($id){
        if($this->auth->CheckAuth(17)){

            $dados['id_profissional'] = $id;

            //var_dump($dados);die();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('profissionais/foto_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoStore(){
        $dados = array();   
        $id = $this->request->getPost('id_foto');
        $id_profissional = $this->request->getPost('id_profissional');

        if($id == ""){
            $arquivo = $this->request->getFile('aluno_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Profissional/Foto?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('aluno_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            $dados['DESCRICAO'] = $this->request->getPost('descricao');;
            $dados['FK_ID_PROFISSIONAL'] = $id_profissional;
            //var_dump($dados);die();
            $insert_id = $this->documentoProfissionalModel->setFoto($dados);

            if($insert_id){
                return redirect()->to('/Profissional/Foto/'.base64_encode($id_profissional).'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Profissional/Foto/'.base64_encode($id_profissional).'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}

        }else{

            $dados['ID_DOCUMENTO_PROFISSIONAL'] = $id;
            $dados['DESCRICAO'] = $this->request->getPost('descricao');
            $dados['FK_ID_PROFISSIONAL'] = $id_profissional;
            $arquivo = $this->request->getFile('aluno_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Profissional/Foto/'.base64_encode($id_profissional).'?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('aluno_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            $resp = $this->documentoProfissionalModel->updateFoto($dados);

            if($resp){
                return redirect()->to('/Profissional/Foto/'.base64_encode($id_profissional).'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Profissional/Foto/'.base64_encode($id_profissional).'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }
    }

    public function FotoEditar($id=""){
        if($this->auth->CheckAuth(17)){
            $dados['foto'] = $this->documentoProfissionalModel->getFotoID(base64_decode($id));
            $dados['id_profissional'] = $dados['foto']->FK_ID_PROFISSIONAL;

            //var_dump($dados);die();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('profissionais/foto_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoExcluir($id="", $id_profissional=""){
        if($this->auth->CheckAuth(17)){
            if($this->documentoProfissionalModel->deleteFoto(base64_decode($id))){
                return redirect()->to('/Profissional/Foto/'.$id_profissional.'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Profissional/Foto/'.$id_profissional.'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inserir(){
        if($this->auth->checkAuth(18)){
            $dados['username'] = $this->usuario->USUARIO;
            $dados['profissoes'] = $this->profissaoModel->getProfissao();
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('profissionais/profissional_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('profissional_id');
        if($id == ""){
            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
            $dados['NOME_PROFISSIONAL'] = $this->request->getPost('profissional_nome');
            $dados['DATA_NASCIMENTO'] = $this->request->getPost('profissional_data_nascimento');
            $dados['IDADE'] = $this->request->getPost('profissional_idade');
            $dados['SEXO'] = $this->request->getPost('profissional_sexo');
            $dados['NATURALIDADE'] = $this->request->getPost('profissional_naturalidade');
            $dados['ESTADO_NATURALIDADE'] = $this->request->getPost('profissional_estado_naturalidade');
            $dados['NACIONALIDADE'] = $this->request->getPost('profissional_nacionalidade'); 
            $dados['ESTADO_CIVIL'] = $this->request->getPost('profissional_estado_civil');
            $dados['CONJUGE'] = $this->request->getPost('profissional_conjuge');
            $dados['TELEFONE_CONJUGE'] = $this->request->getPost('telefone_conjuge');
            $dados['CPF'] = $this->request->getPost('profissional_cpf');
            $dados['DATA_EMISSAO'] = $this->request->getPost('profissional_data_emissao');
            $dados['ORGAO_EXPEDITOR'] = $this->request->getPost('profissional_orgao_expeditor');
            $dados['TITULO_ELEITOR'] = $this->request->getPost('profissional_titulo_eleitor');
            $dados['ZONA'] = $this->request->getPost('profissional_zona');
            $dados['SECAO'] = $this->request->getPost('profissional_secao');
            $dados['COR_RACA'] = $this->request->getPost('profissional_cor_raca');
            $dados['FILIACAO_1'] = $this->request->getPost('profissional_filiacao_1');
            $dados['FILIACAO_2'] = $this->request->getPost('profissional_filiacao_2');
            $dados['CEP'] = $this->request->getPost('profissional_cep');
            $dados['ENDERECO'] = $this->request->getPost('profissional_endereco');
            $dados['NUMERO'] = $this->request->getPost('profissional_numero');
            $dados['BAIRRO'] = $this->request->getPost('profissional_bairro');
            $dados['CIDADE'] = $this->request->getPost('profissional_cidade');
            $dados['ESTADO'] = $this->request->getPost('profissional_estado');
            $dados['TELEFONE_1'] = $this->request->getPost('profissional_telefone_1');
            $dados['TELEFONE_2'] = $this->request->getPost('profissional_telefone_2');
            $dados['EMAIL'] = $this->request->getPost('profissional_email');
            $dados['ESCOLARIDADE'] = $this->request->getPost('profissional_escolaridade');
            $dados['CURSO_SUPERIOR'] = $this->request->getPost('profissional_curso_superior');
            $dados['NIVEL_GRAU_ACADEMICO'] = $this->request->getPost('profissional_nivel_grau_academico');
            $dados['ESPECIALIZACAO_1'] = $this->request->getPost('profissional_especializacao_1');
            $dados['ESPECIALIZACAO_2'] = $this->request->getPost('profissional_especializacao_2');
            $dados['ESPECIALIZACAO_3'] = $this->request->getPost('profissional_especializacao_3');
            $dados['CARGO'] = $this->request->getPost('profissional_cargo');
            $dados['CARGA_HORARIA'] = $this->request->getPost('profissional_carga_horaria');
            $dados['HORARIO_ENTRADA'] = $this->request->getPost('profissional_horario_entrada');
            $dados['HORARIO_SAIDA'] = $this->request->getPost('profissional_horario_saida');
            $dados['INTERVALO'] = $this->request->getPost('profissional_intervalo');
            $dados['INTERVALO_HORA'] = $this->request->getPost('profissional_intervalo_hora');
            $dados['TIPO_VINCULO'] = $this->request->getPost('profissional_tipo_vinculo');
            $dados['DATA_ADMISSAO'] = $this->request->getPost('profissional_data_admissao');
            $dados['DATA_DESLIGAMENTO'] = $this->request->getPost('profissional_data_desligamento');

            $dados['FILHO'] = $this->request->getPost('profissional_filhos');
            $dados['QTD_FILHO'] = $this->request->getPost('profissional_qtd_filho');

            $dados['DEFICIENCIA'] = $this->request->getPost('profissional_deficiência');
            $dados['QUAL_DEFICIENCIA'] = $this->request->getPost('profissional_qual_deficiencia');

            $dados['DOENCA'] = $this->request->getPost('profissional_doenca');
            $dados['QUAL_DOENCA'] = $this->request->getPost('profissional_qual_doenca');
            

            $arquivo = $this->request->getFile('profissional_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[profissional_imagem]',
                        'mime_in[profissional_imagem,image/jpg,image/jpeg,image/png]',
                        'max_size[profissional_imagem,2048]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Profissional/index?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('profissional_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }

            $insert_id = $this->profissionalModel->setProfissional($dados);

            /* $user['NOME'] = $this->request->getPost('profissional_nome');
            $user['USUARIO'] = limpaCPF_CNPJ($this->request->getPost('profissional_cpf'));
            $user['SENHA'] = sha1(limpaString($this->request->getPost('profissional_data_nascimento'))); 
            $user['EMAIL'] = $this->request->getPost('profissional_email');
            $user['TELEFONE'] = limpaString($this->request->getPost('profissional_telefone_1'));
            $user['ATIVO'] = "A";
            $user['TIPO'] = $this->request->getPost('profissional_cargo');
            $this->usuarioModel->setUsuario($user); */

            if($insert_id){
                return redirect()->to('/Profissional/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Profissional/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
            $dados['ID_PROFISSIONAL'] = $this->request->getPost('profissional_id');
            $dados['NOME_PROFISSIONAL'] = $this->request->getPost('profissional_nome');
            $dados['DATA_NASCIMENTO'] = $this->request->getPost('profissional_data_nascimento');
            $dados['IDADE'] = $this->request->getPost('profissional_idade');
            $dados['SEXO'] = $this->request->getPost('profissional_sexo');
            $dados['NATURALIDADE'] = $this->request->getPost('profissional_naturalidade');
            $dados['ESTADO_NATURALIDADE'] = $this->request->getPost('profissional_estado_naturalidade');
            $dados['NACIONALIDADE'] = $this->request->getPost('profissional_nacionalidade'); 
            $dados['ESTADO_CIVIL'] = $this->request->getPost('profissional_estado_civil');
            $dados['CONJUGE'] = $this->request->getPost('profissional_conjuge');
            $dados['TELEFONE_CONJUGE'] = $this->request->getPost('telefone_conjuge');
            $dados['CPF'] = $this->request->getPost('profissional_cpf');
            $dados['DATA_EMISSAO'] = $this->request->getPost('profissional_data_emissao');
            $dados['ORGAO_EXPEDITOR'] = $this->request->getPost('profissional_orgao_expeditor');
            $dados['TITULO_ELEITOR'] = $this->request->getPost('profissional_titulo_eleitor');
            $dados['ZONA'] = $this->request->getPost('profissional_zona');
            $dados['SECAO'] = $this->request->getPost('profissional_secao');
            $dados['COR_RACA'] = $this->request->getPost('profissional_cor_raca');
            $dados['FILIACAO_1'] = $this->request->getPost('profissional_filiacao_1');
            $dados['FILIACAO_2'] = $this->request->getPost('profissional_filiacao_2');
            $dados['CEP'] = $this->request->getPost('profissional_cep');
            $dados['ENDERECO'] = $this->request->getPost('profissional_endereco');
            $dados['NUMERO'] = $this->request->getPost('profissional_numero');
            $dados['BAIRRO'] = $this->request->getPost('profissional_bairro');
            $dados['CIDADE'] = $this->request->getPost('profissional_cidade');
            $dados['ESTADO'] = $this->request->getPost('profissional_estado');
            $dados['TELEFONE_1'] = $this->request->getPost('profissional_telefone_1');
            $dados['TELEFONE_2'] = $this->request->getPost('profissional_telefone_2');
            $dados['EMAIL'] = $this->request->getPost('profissional_email');
            $dados['ESCOLARIDADE'] = $this->request->getPost('profissional_escolaridade');
            $dados['CURSO_SUPERIOR'] = $this->request->getPost('profissional_curso_superior');
            $dados['NIVEL_GRAU_ACADEMICO'] = $this->request->getPost('profissional_nivel_grau_academico');
            $dados['ESPECIALIZACAO_1'] = $this->request->getPost('profissional_especializacao_1');
            $dados['ESPECIALIZACAO_2'] = $this->request->getPost('profissional_especializacao_2');
            $dados['ESPECIALIZACAO_3'] = $this->request->getPost('profissional_especializacao_3');
            $dados['CARGO'] = $this->request->getPost('profissional_cargo');
            $dados['CARGA_HORARIA'] = $this->request->getPost('profissional_carga_horaria');
            $dados['HORARIO_ENTRADA'] = $this->request->getPost('profissional_horario_entrada');
            $dados['HORARIO_SAIDA'] = $this->request->getPost('profissional_horario_saida');
            $dados['INTERVALO'] = $this->request->getPost('profissional_intervalo');
            $dados['INTERVALO_HORA'] = $this->request->getPost('profissional_intervalo_hora');
            $dados['TIPO_VINCULO'] = $this->request->getPost('profissional_tipo_vinculo');
            $dados['DATA_ADMISSAO'] = $this->request->getPost('profissional_data_admissao');
            $dados['DATA_DESLIGAMENTO'] = $this->request->getPost('profissional_data_desligamento');

            $dados['FILHO'] = $this->request->getPost('profissional_filhos');
            $dados['QTD_FILHO'] = $this->request->getPost('profissional_qtd_filho');

            $dados['DEFICIENCIA'] = $this->request->getPost('profissional_deficiência');
            $dados['QUAL_DEFICIENCIA'] = $this->request->getPost('profissional_qual_deficiencia');

            $dados['DOENCA'] = $this->request->getPost('profissional_doenca');
            $dados['QUAL_DOENCA'] = $this->request->getPost('profissional_qual_doenca');


            $arquivo = $this->request->getFile('profissional_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[profissional_imagem]',
                        'mime_in[profissional_imagem,image/jpg,image/jpeg,image/png]',
                        'max_size[profissional_imagem,2048]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Profissional/index?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('profissional_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            
            if($this->profissionalModel->updateProfissional($dados)){
                return redirect()->to('/Profissional/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Profissional/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(19)){
            $dados['profissional'] = $this->profissionalModel->getProfissionalID(base64_decode($id));
            $dados['profissoes'] = $this->profissaoModel->getProfissao();
            $dados['username'] = $this->usuario->USUARIO;
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('profissionais/profissional_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(20)){
            if($this->profissionalModel->deleteProfissional(base64_decode($id))){
                return redirect()->to('/Profissional/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Profissional/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }
}
