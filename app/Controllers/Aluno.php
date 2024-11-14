<?php

namespace App\Controllers;
use App\Models\AlunoModel;
use App\Models\TurmaModel;
use App\Models\EscolaModel;
use App\Models\DocumentoAlunoModel;
use App\Models\AnoLetivoModel;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;
use App\Libraries\Auth;
use \DateTime;

class Aluno extends BaseController
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
        $this->alunoModel = new AlunoModel();
        $this->anoLetivoModel = new AnoLetivoModel();
        $this->auth = new Auth();
        helper('complementos');
        $this->turmaModel = new TurmaModel();
        $this->escolaModel = new EscolaModel();
        $this->documentoAlunoModel = new DocumentoAlunoModel();
    }


    public function index(){
        if($this->auth->checkAuth(25)){
            $dados = array();
            $dados['resultados'] = $this->alunoModel->getAluno($this->escola->ID_ESCOLA);
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/aluno', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function getAlunoturma($id=""){
        if($this->auth->checkAuth(25)){
            $dados = array();
            $dados['resultados'] = $this->alunoModel->getAlunoTurma(base64_decode($id));
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/aluno', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Foto($id){
        if($this->auth->CheckAuth(25)){
            $dados = array();
            $dados['resultados'] = $this->documentoAlunoModel->getFotos(base64_decode($id));            
            $dados['id_aluno'] = base64_decode($id);
            $dados['aluno'] = $this->alunoModel->getAlunoID(base64_decode($id));
            
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/foto', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoInserir($id){
        if($this->auth->CheckAuth(25)){

            $dados['id_aluno'] = $id;

            //var_dump($dados);die();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/foto_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoStore(){
        $dados = array();   
        $id = $this->request->getPost('id_foto');
        $id_aluno = $this->request->getPost('id_aluno');

        if($id == ""){
            $arquivo = $this->request->getFile('aluno_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Aluno/Foto?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('aluno_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            $dados['DESCRICAO'] = $this->request->getPost('descricao');;
            $dados['FK_ID_ALUNO'] = $id_aluno;
            //var_dump($dados);die();
            $insert_id = $this->documentoAlunoModel->setFoto($dados);

            if($insert_id){
                return redirect()->to('/Aluno/Foto/'.base64_encode($id_aluno).'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Aluno/Foto/'.base64_encode($id_aluno).'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}

        }else{

            $dados['ID_DOCUMENTO_ALUNO'] = $id;
            $dados['DESCRICAO'] = $this->request->getPost('descricao');
            $dados['FK_ID_ALUNO'] = $id_aluno;
            $arquivo = $this->request->getFile('aluno_imagem');

            if($arquivo != "" && $arquivo != null){
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                    ]
                ]);
                    
                if (!$input) {
                    return redirect()->to('/Aluno/Foto/'.base64_encode($id_aluno).'?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    $img = $this->request->getFile('aluno_imagem');
    
                    $nome_aleatorio = $img->getRandomName();
                    $img->move($_SERVER['DOCUMENT_ROOT'].'/uploads',$nome_aleatorio);
    
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;        
                }
            }
            $resp = $this->documentoAlunoModel->updateFoto($dados);

            if($resp){
                return redirect()->to('/Aluno/Foto/'.base64_encode($id_aluno).'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Aluno/Foto/'.base64_encode($id_aluno).'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }
    }

    public function FotoEditar($id=""){
        if($this->auth->CheckAuth(25)){
            $dados['foto'] = $this->documentoAlunoModel->getFotoID(base64_decode($id));
            $dados['id_aluno'] = $dados['foto']->FK_ID_ALUNO;

            //var_dump($dados);die();

            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/foto_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function FotoExcluir($id="", $id_aluno=""){
        if($this->auth->CheckAuth(25)){
            if($this->documentoAlunoModel->deleteFoto(base64_decode($id))){
                return redirect()->to('/Aluno/Foto/'.$id_aluno.'?tipo_msg=sucesso&msg=Ação realizada!');
			}else{
                return redirect()->to('/Aluno/Foto/'.$id_aluno.'?tipo_msg=erro&msg=Erro ao realizar ação!');
			}
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Matriculas(){
        if($this->auth->checkAuth(25)){
            $dados = array();
            $dados['resultados'] = $this->alunoModel->getAlunoTurmatotalAlunos($this->escola->ID_ESCOLA);
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/aluno', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Inscritos(){
        if($this->auth->checkAuth(25)){
            $dados = array();
            $dados['resultados'] = $this->alunoModel->getAlunosSemTurma($this->escola->ID_ESCOLA);
            echo view('commons/header');	          
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));	
            echo view('alunos/aluno', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    

    public function Inserir(){
        if($this->auth->checkAuth(26)){
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('alunos/aluno_cadastro');
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Store(){
        $dados = array();
        $id = $this->request->getPost('aluno_id');
        if($id == ""){
            $dados['NIS_ALUNO'] = $this->request->getPost('aluno_nis'); 
            $dados['NOME_ALUNO'] = $this->request->getPost('aluno_nome'); 
            $dados['DATA_NASCIMENTO'] = $this->request->getPost('aluno_data_nascimento'); 
            $dados['IDADE'] = $this->request->getPost('aluno_idade'); 
            $dados['SEXO'] = $this->request->getPost('aluno_sexo'); 
            $dados['NATURALIDADE'] = $this->request->getPost('aluno_naturalidade'); 
            $dados['ESTADO_NATURALIDADE'] = $this->request->getPost('aluno_estado_naturalidade'); 
            $dados['NACIONALIDADE'] = $this->request->getPost('aluno_nacionalidade'); 
            $dados['CPF'] = $this->request->getPost('aluno_cpf'); 
            $dados['DATA_EMISSAO'] = $this->request->getPost('aluno_data_emissao'); 
            $dados['ORGAO_EXPEDITOR'] = $this->request->getPost('aluno_orgao_expeditor'); 
            $dados['CARTAO_SUS'] = $this->request->getPost('aluno_sus'); 
            $dados['NUMERO_MATRICULA'] = $this->request->getPost('aluno_numero_matricula'); 
            $dados['COR_RACA'] = $this->request->getPost('aluno_cor_raca'); 
            $dados['FILIACAO_1'] = $this->request->getPost('aluno_filiacao_1'); 
            $dados['FILIACAO_1_VIVO'] = $this->request->getPost('aluno_filiacao_1_vivo'); 
            $dados['FILIACAO_1_TELEFONE'] = $this->request->getPost('aluno_filiacao_1_telefone'); 
            $dados['FILIACAO_1_PROFISSAO'] = $this->request->getPost('aluno_filiacao_1_profissao'); 
            $dados['FILIACAO_2'] = $this->request->getPost('aluno_filiacao_2'); 
            $dados['FILIACAO_2_VIVO'] = $this->request->getPost('aluno_filiacao_2_vivo'); 
            $dados['FILIACAO_2_TELEFONE'] = $this->request->getPost('aluno_filiacao_2_telefone'); 
            $dados['FILIACAO_2_PROFISSAO'] = $this->request->getPost('aluno_filiacao_2_profissao'); 
            $dados['RESPONSAVEL_LEGAL'] = $this->request->getPost('aluno_responsavel_legal'); 
            $dados['RESPONSAVEL_LEGAL_NOME'] = $this->request->getPost('aluno_responsavel_legal_nome'); 
            $dados['GRAU_PARENTESCO'] = $this->request->getPost('aluno_grau_parentesco'); 
            $dados['RESPONSAVEL_LEGAL_TELEFONE'] = $this->request->getPost('aluno_responsavel_legal_telefone'); 
            $dados['RESPONSAVEL_LEGAL_PROFISSAO'] = $this->request->getPost('aluno_responsavel_legal_profissao'); 
            $dados['ENDERECO'] = $this->request->getPost('aluno_endereco'); 
            $dados['NUMERO'] = $this->request->getPost('aluno_numero'); 
            $dados['CEP'] = $this->request->getPost('aluno_cep'); 
            $dados['BAIRRO'] = $this->request->getPost('aluno_bairro'); 
            $dados['CIDADE'] = $this->request->getPost('aluno_cidade'); 
            $dados['ESTADO'] = $this->request->getPost('aluno_estado'); 
            $dados['POSSUI_DEFICIENCIA'] = $this->request->getPost('aluno_possui_deficiencia'); 
            $dados['POSSUI_TRANSTORNO'] = $this->request->getPost('aluno_possui_transtorno'); 
            $dados['POSSUI_DOENCAS_CRONICAS'] = $this->request->getPost('aluno_possui_doencas_cronicas'); 
            $dados['POSSUI_SUPERDOTACAO'] = $this->request->getPost('aluno_possui_superdotacao'); 
            $dados['POSSUI_INTOLERANCIA'] = $this->request->getPost('aluno_possui_intolerancia'); 
            $dados['POSSUI_ALERGIA'] = $this->request->getPost('aluno_possui_alergia'); 
            $dados['POSSUI_MEDICAMENTO'] = $this->request->getPost('aluno_possui_medicamento'); 
            $dados['POSSUI_TRATAMENTO'] = $this->request->getPost('aluno_possui_tratamento'); 
            $dados['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;

            // Verificar se foi feito upload tradicional ou captura via webcam
            $arquivo = $this->request->getFile('aluno_imagem');
            $imagemBase64 = $this->request->getPost('aluno_imagem_base64');

            if ($arquivo && $arquivo->isValid() && !$arquivo->hasMoved()) {
                // Validação do upload de arquivo
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                        'mime_in[aluno_imagem,image/jpg,image/jpeg,image/png]',
                        'max_size[aluno_imagem,2048]',
                    ]
                ]);

                if (!$input) {
                    return redirect()->to('/Aluno/index?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    // Salvar o arquivo enviado
                    $nome_aleatorio = $arquivo->getRandomName();
                    $arquivo->move($_SERVER['DOCUMENT_ROOT'] . '/uploads', $nome_aleatorio);
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;
                }
            } elseif (!empty($imagemBase64)) {
                // Processar a imagem em Base64
                $imagemBase64 = str_replace('data:image/png;base64,', '', $imagemBase64);
                $imagemBase64 = base64_decode($imagemBase64);

                // Gerar um nome aleatório para o arquivo
                $nome_aleatorio = uniqid() . '.png';
                $caminho_arquivo = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $nome_aleatorio;

                // Salvar a imagem decodificada
                file_put_contents($caminho_arquivo, $imagemBase64);

                // Armazenar o nome do arquivo para salvar no banco de dados
                $dados['NOME_ALEATORIO'] = $nome_aleatorio;
            }


            $insert_id = $this->alunoModel->setAluno($dados);

            if($this->request->getPost('aluno_possui_deficiencia') == "S"){
                $deficiencia = array();
                $deficiencia['FK_ID_ALUNO'] = $insert_id;
                $deficiencia['BAIXA_VISAO'] = $this->request->getPost('aluno_baixa_visao');
                $deficiencia['DEFICIENCIA_FISICA'] = $this->request->getPost('aluno_deficiencia_fisica');
                $deficiencia['SURDOCEGUEIRA'] = $this->request->getPost('aluno_surdocegueira');
                $deficiencia['CEGUEIRA'] = $this->request->getPost('aluno_cegueira');
                $deficiencia['INTELECTUAL'] = $this->request->getPost('aluno_intelectual');
                $deficiencia['MULTIPLA'] = $this->request->getPost('aluno_multipla');
                $deficiencia['AUDITIVA'] = $this->request->getPost('aluno_auditiva');
                $deficiencia['SURDEZ'] = $this->request->getPost('aluno_surdez');
                $deficiencia['OUTROS'] = $this->request->getPost('aluno_outros');
                $this->alunoModel->setDeficiencia($deficiencia);
            }

            if($this->request->getPost('aluno_possui_transtorno') == "S"){
                $transtorno = array();
                $transtorno['FK_ID_ALUNO'] = $insert_id;
                $transtorno['AUSTISMO'] = $this->request->getPost('aluno_autismo');
                $transtorno['TDAH'] = $this->request->getPost('aluno_tdah');
                $transtorno['OUTROS'] = $this->request->getPost('aluno_outros_transtornos');
                $this->alunoModel->setTranstorno($transtorno);
            }

            if($this->request->getPost('aluno_possui_intolerancia') == "S"){
                $intolerancia = array();
                $intolerancia['FK_ID_ALUNO'] = $insert_id;
                $intolerancia['OUTROS'] = $this->request->getPost('aluno_intolerancia');
                $this->alunoModel->setIntolerancia($intolerancia);
            }

            if($this->request->getPost('aluno_possui_alergia') == "S"){
                $alergia = array();
                $alergia['FK_ID_ALUNO'] = $insert_id;
                $alergia['OUTROS'] = $this->request->getPost('aluno_alergia');
                $this->alunoModel->setAlergia($alergia);
            }


            if($this->request->getPost('aluno_possui_medicamento') == "S"){
                $medicamento = array();
                $medicamento['FK_ID_ALUNO'] = $insert_id;
                $medicamento['OUTROS'] = $this->request->getPost('aluno_medicamento');
                $this->alunoModel->setMedicamento($medicamento);
            }

            if($this->request->getPost('aluno_possui_tratamento') == "S"){
                $transtorno = array();
                $transtorno['FK_ID_ALUNO'] = $insert_id;
                $transtorno['PSICOLOGO'] = $this->request->getPost('aluno_psicologo');
                $transtorno['FONOAUDIOLOGO'] = $this->request->getPost('aluno_fonoaudiologo');
                $transtorno['TERAPIA'] = $this->request->getPost('aluno_terapia');
                $transtorno['OUTROS'] = $this->request->getPost('aluno_outros_tratamento');
                $this->alunoModel->setTratamento($transtorno);
            }

            if($this->request->getPost('aluno_possui_doencas_cronicas') == "S"){
                $doencas_cronicas = array();
                $doencas_cronicas['FK_ID_ALUNO'] = $insert_id;
                $doencas_cronicas['DIEABETE'] = $this->request->getPost('aluno_diabete');
                $doencas_cronicas['RESPIRATORIA'] = $this->request->getPost('aluno_respiratoria');
                $doencas_cronicas['NEUROLOGIA'] = $this->request->getPost('aluno_neurologia');
                $doencas_cronicas['OBESIDADE'] = $this->request->getPost('aluno_obesidade');
                $doencas_cronicas['OUTROS'] = $this->request->getPost('aluno_outros_cronicas');
                $this->alunoModel->setDoencaCronica($doencas_cronicas);
            }

            if($insert_id){
                return redirect()->to('/Aluno/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_ALUNO'] = $this->request->getPost('aluno_id'); 
            $dados['NIS_ALUNO'] = $this->request->getPost('aluno_nis'); 
            $dados['NOME_ALUNO'] = $this->request->getPost('aluno_nome'); 
            $dados['DATA_NASCIMENTO'] = $this->request->getPost('aluno_data_nascimento'); 
            $dados['IDADE'] = $this->request->getPost('aluno_idade'); 
            $dados['SEXO'] = $this->request->getPost('aluno_sexo'); 
            $dados['NATURALIDADE'] = $this->request->getPost('aluno_naturalidade'); 
            $dados['ESTADO_NATURALIDADE'] = $this->request->getPost('aluno_estado_naturalidade'); 
            $dados['NACIONALIDADE'] = $this->request->getPost('aluno_nacionalidade'); 
            $dados['CPF'] = $this->request->getPost('aluno_cpf'); 
            $dados['DATA_EMISSAO'] = $this->request->getPost('aluno_data_emissao'); 
            $dados['ORGAO_EXPEDITOR'] = $this->request->getPost('aluno_orgao_expeditor'); 
            $dados['CARTAO_SUS'] = $this->request->getPost('aluno_sus'); 
            $dados['NUMERO_MATRICULA'] = $this->request->getPost('aluno_numero_matricula'); 
            $dados['COR_RACA'] = $this->request->getPost('aluno_cor_raca'); 
            $dados['CAD_ALUNOcol'] = $this->request->getPost('aluno_cad_alunocol'); 
            $dados['FILIACAO_1'] = $this->request->getPost('aluno_filiacao_1'); 
            $dados['FILIACAO_1_VIVO'] = $this->request->getPost('aluno_filiacao_1_vivo'); 
            $dados['FILIACAO_1_TELEFONE'] = $this->request->getPost('aluno_filiacao_1_telefone'); 
            $dados['FILIACAO_1_PROFISSAO'] = $this->request->getPost('aluno_filiacao_1_profissao'); 
            $dados['FILIACAO_2'] = $this->request->getPost('aluno_filiacao_2'); 
            $dados['FILIACAO_2_VIVO'] = $this->request->getPost('aluno_filiacao_2_vivo'); 
            $dados['FILIACAO_2_TELEFONE'] = $this->request->getPost('aluno_filiacao_2_telefone'); 
            $dados['FILIACAO_2_PROFISSAO'] = $this->request->getPost('aluno_filiacao_2_profissao'); 
            $dados['RESPONSAVEL_LEGAL'] = $this->request->getPost('aluno_responsavel_legal'); 
            $dados['RESPONSAVEL_LEGAL_NOME'] = $this->request->getPost('aluno_responsavel_legal_nome'); 
            $dados['GRAU_PARENTESCO'] = $this->request->getPost('aluno_grau_parentesco'); 
            $dados['RESPONSAVEL_LEGAL_TELEFONE'] = $this->request->getPost('aluno_responsavel_legal_telefone'); 
            $dados['RESPONSAVEL_LEGAL_PROFISSAO'] = $this->request->getPost('aluno_responsavel_legal_profissao'); 
            $dados['ENDERECO'] = $this->request->getPost('aluno_endereco'); 
            $dados['NUMERO'] = $this->request->getPost('aluno_numero'); 
            $dados['BAIRRO'] = $this->request->getPost('aluno_bairro'); 
            $dados['CIDADE'] = $this->request->getPost('aluno_cidade'); 
            $dados['ESTADO'] = $this->request->getPost('aluno_estado'); 
            $dados['POSSUI_DEFICIENCIA'] = $this->request->getPost('aluno_possui_deficiencia'); 
            $dados['POSSUI_TRANSTORNO'] = $this->request->getPost('aluno_possui_transtorno'); 
            $dados['POSSUI_DOENCAS_CRONICAS'] = $this->request->getPost('aluno_possui_doencas_cronicas'); 
            $dados['POSSUI_SUPERDOTACAO'] = $this->request->getPost('aluno_possui_superdotacao'); 
            $dados['POSSUI_INTOLERANCIA'] = $this->request->getPost('aluno_possui_intolerancia'); 
            $dados['POSSUI_ALERGIA'] = $this->request->getPost('aluno_possui_alergia'); 
            $dados['POSSUI_MEDICAMENTO'] = $this->request->getPost('aluno_possui_medicamento'); 
            $dados['POSSUI_TRATAMENTO'] = $this->request->getPost('aluno_possui_tratamento'); 

            // Verifique se foi feito upload tradicional ou captura via webcam
            $arquivo = $this->request->getFile('aluno_imagem');
            $imagemBase64 = $this->request->getPost('aluno_imagem_base64');

            if ($arquivo && $arquivo->isValid() && !$arquivo->hasMoved()) {
                // Validação do upload de arquivo
                $input = $this->validate([
                    'file' => [
                        'uploaded[aluno_imagem]',
                        'mime_in[aluno_imagem,image/jpg,image/jpeg,image/png]',
                        'max_size[aluno_imagem,2048]',
                    ]
                ]);

                if (!$input) {
                    return redirect()->to('/Aluno/index?tipo_msg=erro&msg=Arquivo inválido!');
                } else {
                    // Salvar o arquivo enviado
                    $nome_aleatorio = $arquivo->getRandomName();
                    $arquivo->move($_SERVER['DOCUMENT_ROOT'] . '/uploads', $nome_aleatorio);
                    $dados['NOME_ALEATORIO'] = $nome_aleatorio;
                }
            } elseif (!empty($imagemBase64)) {
                // Processar a imagem em Base64
                $imagemBase64 = str_replace('data:image/png;base64,', '', $imagemBase64);
                $imagemBase64 = base64_decode($imagemBase64);

                // Gerar um nome aleatório para o arquivo
                $nome_aleatorio = uniqid() . '.png';
                $caminho_arquivo = $_SERVER['DOCUMENT_ROOT'] . '/uploads/' . $nome_aleatorio;

                // Salvar a imagem decodificada
                file_put_contents($caminho_arquivo, $imagemBase64);

                // Armazenar o nome do arquivo para salvar no banco de dados
                $dados['NOME_ALEATORIO'] = $nome_aleatorio;
            }

            $this->alunoModel->updateAluno($dados);

            $this->alunoModel->deleteDeficiencia($id);
            if($this->request->getPost('aluno_possui_deficiencia') == "S"){
                $deficiencia = array();
                $deficiencia['FK_ID_ALUNO'] = $id;
                $deficiencia['BAIXA_VISAO'] = $this->request->getPost('aluno_baixa_visao');
                $deficiencia['DEFICIENCIA_FISICA'] = $this->request->getPost('aluno_deficiencia_fisica');
                $deficiencia['SURDOCEGUEIRA'] = $this->request->getPost('aluno_surdocegueira');
                $deficiencia['CEGUEIRA'] = $this->request->getPost('aluno_cegueira');
                $deficiencia['INTELECTUAL'] = $this->request->getPost('aluno_intelectual');
                $deficiencia['MULTIPLA'] = $this->request->getPost('aluno_multipla');
                $deficiencia['AUDITIVA'] = $this->request->getPost('aluno_auditiva');
                $deficiencia['SURDEZ'] = $this->request->getPost('aluno_surdez');
                $deficiencia['OUTROS'] = $this->request->getPost('aluno_outros');
                $this->alunoModel->setDeficiencia($deficiencia);
            }

            $this->alunoModel->deleteTranstorno($id);
            if($this->request->getPost('aluno_possui_transtorno') == "S"){
                $transtorno = array();
                $transtorno['FK_ID_ALUNO'] = $id;
                $transtorno['AUSTISMO'] = $this->request->getPost('aluno_autismo');
                $transtorno['TDAH'] = $this->request->getPost('aluno_tdah');
                $transtorno['OUTROS'] = $this->request->getPost('aluno_outros_transtornos');
                $this->alunoModel->setTranstorno($transtorno);
            }

            $this->alunoModel->deleteIntolerancia($id);
            if($this->request->getPost('aluno_possui_intolerancia') == "S"){
                $intolerancia = array();
                $intolerancia['FK_ID_ALUNO'] = $id;
                $intolerancia['OUTROS'] = $this->request->getPost('aluno_intolerancia');
                $this->alunoModel->setIntolerancia($intolerancia);
            }

            $this->alunoModel->deleteAlergia($id);
            if($this->request->getPost('aluno_possui_alergia') == "S"){
                $alergia = array();
                $alergia['FK_ID_ALUNO'] = $id;
                $alergia['OUTROS'] = $this->request->getPost('aluno_alergia');
                $this->alunoModel->setAlergia($alergia);
            }


            $this->alunoModel->deleteMedicamento($id);
            if($this->request->getPost('aluno_possui_medicamento') == "S"){
                $medicamento = array();
                $medicamento['FK_ID_ALUNO'] = $id;
                $medicamento['OUTROS'] = $this->request->getPost('aluno_medicamento');
                $this->alunoModel->setMedicamento($medicamento);
            }

            $this->alunoModel->deleteTratamento($id);
            if($this->request->getPost('aluno_possui_tratamento') == "S"){
                $transtorno = array();
                $transtorno['FK_ID_ALUNO'] = $id;
                $transtorno['PSICOLOGO'] = $this->request->getPost('aluno_psicologo');
                $transtorno['FONOAUDIOLOGO'] = $this->request->getPost('aluno_fonoaudiologo');
                $transtorno['TERAPIA'] = $this->request->getPost('aluno_terapia');
                $transtorno['OUTROS'] = $this->request->getPost('aluno_outros_tratamento');
                $this->alunoModel->setTratamento($transtorno);
            }

            $this->alunoModel->deleteDoencaCronica($id);
            if($this->request->getPost('aluno_possui_doencas_cronicas') == "S"){
                $doencas_cronicas = array();
                $doencas_cronicas['FK_ID_ALUNO'] = $id;
                $doencas_cronicas['DIEABETE'] = $this->request->getPost('aluno_diabete');
                $doencas_cronicas['RESPIRATORIA'] = $this->request->getPost('aluno_respiratoria');
                $doencas_cronicas['NEUROLOGIA'] = $this->request->getPost('aluno_neurologia');
                $doencas_cronicas['OBESIDADE'] = $this->request->getPost('aluno_obesidade');
                $doencas_cronicas['OUTROS'] = $this->request->getPost('aluno_outros_cronicas');
                $this->alunoModel->setDoencaCronica($doencas_cronicas);
            }

            if($id){
                return redirect()->to('/Aluno/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function Editar($id=""){
        if($this->auth->checkAuth(27)){
            $dados['aluno'] = $this->alunoModel->getAlunoID(base64_decode($id));
            $dados['aluno_deficiencia'] = $this->alunoModel->getDeficiencia(base64_decode($id));
            $dados['aluno_transtorno'] = $this->alunoModel->getTranstorno(base64_decode($id));
            $dados['aluno_doencas_cronicas'] = $this->alunoModel->getDoenca(base64_decode($id));
            $dados['aluno_intolerancia'] = $this->alunoModel->getIntolerancia(base64_decode($id));
            $dados['aluno_alergia'] = $this->alunoModel->getAlergia(base64_decode($id));
            $dados['aluno_medicamento'] = $this->alunoModel->getMedicamento(base64_decode($id));
            $dados['aluno_tratamento'] = $this->alunoModel->getTratamento(base64_decode($id));

            //var_dump($dados);die();

            
            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('alunos/aluno_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function Excluir($id=""){
        if($this->auth->checkAuth(28)){
            if($this->alunoModel->deleteAluno(base64_decode($id))){
                return redirect()->to('/Aluno/index?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/index?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }


    public function Vinculo($id=""){
        if($this->auth->checkAuth(29)){
            $dados['resultados'] = $this->alunoModel->getAlunoVinculo(base64_decode($id));
            $dados['id_aluno'] = $id;
            $dados['aluno'] = $this->alunoModel->getAlunoID(base64_decode($id));

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('alunos/aluno_vinculo', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function InserirVinculo($id=""){
        if($this->auth->checkAuth(29)){
            $dados['anos'] = $this->anoLetivoModel->getAnoLetivo($this->escola->ID_ESCOLA);
            $dados['turmas'] = $this->turmaModel->getTurmasSimples();
            $dados['id_aluno'] = $id;

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('alunos/aluno_vinculo_cadastro', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    }

    /* public function TransferenciaVinculo($id_vinculo){
        if($this->auth->checkAuth(29)){
            $dados['turmas'] = $this->turmaModel->getTurmasSimples();
            $dados['aluno_vinculo'] = $this->alunoModel->getAlunoVinculoId(base64_decode($id_vinculo));
            $dados['id_aluno'] = $dados['aluno_vinculo']->FK_ID_ALUNO;

            echo view('commons/header');
            echo view('commons/navbartop');
            echo view('commons/navbarleft', getBarMenu($this->usuario));
            echo view('alunos/aluno_vinculo_tranferencia', $dados);
            echo view('commons/footer');
        }else{
            return redirect()->to('/Acesso');
        }
    } */

    public function StoreVinculo(){
        $dados = array();
        $id = $this->request->getPost('aluno_vinculo_id');
        if($id == ""){
            $dados['FK_ID_ALUNO'] = base64_decode($this->request->getPost('aluno_id'));
            $dados['FK_ID_TURMA'] = $this->request->getPost('turma');
            $dados['DATA_MATRICULA'] = $this->request->getPost('data_matricula');
            $dados['SITUACAO'] = "CU";
            $dados['DATA_CADASTRO'] = date('Y-m-d');

            $insert_id = $this->alunoModel->setAlunoVinculo($dados);

            if($insert_id){
                return redirect()->to('/Aluno/Vinculo/'.$this->request->getPost('aluno_id').'?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/Vinculo/'.$this->request->getPost('aluno_id').'?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            $dados['ID_ALUNO_TURMA'] = $this->request->getPost('aluno_vinculo_id');
            $dados['FK_ID_ALUNO'] = $this->request->getPost('aluno_id');
            $dados['FK_ID_TURMA'] = $this->request->getPost('turma');
            $dados['SITUACAO'] = "TR";

            if($this->alunoModel->updateAlunoVinculo($dados)){
                return redirect()->to('/Aluno/Vinculo/'.base64_encode($this->request->getPost('aluno_id')).'?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/Vinculo/'.base64_encode($this->request->getPost('aluno_id')).'?tipo_msg=erro&msg=Erro ao realizar ação!');
            }

        }
    }

    public function TransferenciaVinculo($id="", $status=""){
        if($this->auth->checkAuth(30)){
            $dados['ID_ALUNO_TURMA'] = base64_decode($id);
            $dados['SITUACAO'] = $status;
            $dados['DATA_ALTERACAO_SITUACAO'] = date("Y-m-d");

            

            $aluno_vinculo = $this->alunoModel->getAlunoVinculoId(base64_decode($id));

            if($this->alunoModel->updateAlunoVinculo($dados)){
                return redirect()->to('/Aluno/Vinculo/'.base64_encode($aluno_vinculo->FK_ID_ALUNO).'?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/Vinculo/'.base64_encode($aluno_vinculo->FK_ID_ALUNO).'?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function ConcluirAluno($id=""){
        if($this->auth->checkAuth(30)){
            $dados['ID_ALUNO_TURMA'] = base64_decode($id);
            $dados['SITUACAO'] = "CO";
            $dados['DATA_ALTERACAO_SITUACAO'] = date("Y-m-d");

            $aluno_vinculo = $this->alunoModel->getAlunoVinculoId(base64_decode($id));

            if($this->alunoModel->updateAlunoVinculo($dados)){
                return redirect()->to('/Aluno/Vinculo/'.base64_encode($aluno_vinculo->FK_ID_ALUNO).'?tipo_msg=sucesso&msg=Ação realizada!');
            }else{
                return redirect()->to('/Aluno/Vinculo/'.base64_encode($aluno_vinculo->FK_ID_ALUNO).'?tipo_msg=erro&msg=Erro ao realizar ação!');
            }
        }else{
            return redirect()->to('/Acesso');
        }
    }

    public function ExcluirVinculo($id=""){
        if($this->alunoModel->deleteAlunoVinculo(base64_decode($id))){
            $aluno_vinculo = $this->alunoModel->getAlunoVinculoId(base64_decode($id));
            return redirect()->to('/Aluno/index?tipo_msg=sucesso&msg=Ação realizada!');
        }else{
            return redirect()->to('/Aluno/index?tipo_msg=erro&msg=Erro ao realizar ação!');
        }
    }

    public function DeclaracaoConclusao($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/declaracao_conclusao');
    }

    public function DeclaracaoFrequencia($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/declaracao_frequencia_aluno');
    }

    public function DeclaracaoTransferencia($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/declaracao_transferencia');
    }

    public function Encaminhamento($id=""){

        $dados['aluno'] = $this->alunoModel->getAlunoVinculoIdCompleto(base64_decode($id));
        $dados['turma'] = $this->turmaModel->getTurmaID($dados['aluno']->FK_ID_TURMA);
        $dados['escola'] = $this->escolaModel->getEscolaID($dados['aluno']->FK_ID_ESCOLA);

        echo view('commons/header_impressao', $dados);
        echo view('alunos/encaminhamento');
    }

    
}
