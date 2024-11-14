<?php

namespace App\Controllers;

use App\Models\UsuarioModel;
use App\Models\TurmaModel;
use App\Models\AlunoModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class Aplicativo extends BaseController
{
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);
        $this->usuarioModel = new UsuarioModel();
        $this->turmaModel = new TurmaModel();
        $this->alunoModel = new AlunoModel();
        $this->session = \Config\Services::session();
        $this->usuario = $this->session->get('dadoslogin');
        $this->escola = $this->session->get('escola');
        if($this->usuario == null){
            header('Location: /AplicativoLogin');
            exit(); 
        }
		date_default_timezone_set('America/Sao_Paulo');
        helper('complementos');
    }

    public function index()
    {
        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('home');
        echo view('commons_app/footer');
    }

    public function Chamada()
    {

        $dados = array();
        $dados['resultados'] = $this->turmaModel->getTurmaProfissional($this->escola->ID_ESCOLA, $this->usuario->FK_ID_PROFISSIONAL);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('turma', $dados);
        echo view('commons_app/footer');
    }

    public function ChamadaNovo($turma, $chamada)
    {

        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);

        if($chamada != 0){
            $dados['dados_chamada'] = $this->turmaModel->getchamadaId($chamada);
            $dados['dados_envolvidos_chamada'] = $this->turmaModel->getEnvolvidoschamadaId($chamada);
        }else{
            $dados['dados_chamada'] = "";
            $dados['dados_envolvidos_chamada'] = "";
        }

        //var_dump($dados);die();

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('nova_chamada', $dados);
        echo view('commons_app/footer');
    }

    public function ListaChamada($turma)
    {


        $data = "";
        if($this->request->getPost('pesquisar') == "S"){
            $data = $this->request->getPost('data_filtro');
        }


        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados_chamada'] = $this->turmaModel->getChamadasTurma($this->usuario->FK_ID_PROFISSIONAL, $turma, $data);

        //var_dump($dados);die();

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('lista_chamada', $dados);
        echo view('commons_app/footer');
    }

    public function ChamadaInserir(){

        $data = $this->request->getPost('dados');

        $data = $this->request->getPost('data');
        $profissional_codigo = $this->request->getPost('profissional_codigo');
        $hora = $this->request->getPost('hora');
        $descricao = $this->request->getPost('descricao');
        $alunos = $this->request->getPost('alunos');
        $turma = $this->request->getPost('turma');
        $observacoes = $this->request->getPost('observacoes');
        $dia_nao_letivo = $this->request->getPost('dia_nao_letivo');

        $existe_data = $this->turmaModel->getChamadaData($turma, $data);

        
        
        if($existe_data->QTD_DATA > 0 && $this->request->getPost('id_chamada') == ""){
            echo json_encode(array("msg"=>"error_data"));

        }else{

            $turma= $this->turmaModel->getTurmaID($turma);
    
            $dados_chamada['FK_ID_TURMA'] = $turma->ID_TURMA;
            $dados_chamada['FK_ID_PROFESSOR'] = $this->usuario->FK_ID_PROFISSIONAL;
            $dados_chamada['DATA'] = $data;
            $dados_chamada['HORA'] = $hora;
            $dados_chamada['DESCRICAO'] = $descricao;
            $dados_chamada['CODIGO'] = $profissional_codigo;
            $dados_chamada['OBSERVACOES'] = $observacoes;
            $dados_chamada['DIA_NAO_LETIVO'] = $dia_nao_letivo;
            
            if($this->request->getPost('id_chamada') != "" && $this->request->getPost('id_chamada') != null){
                $dados_chamada['ID_CHAMADA'] = $this->request->getPost('id_chamada');
                $this->turmaModel->updateChamada($dados_chamada);
                //$this->turmaModel->deleteChamadaAluno($this->request->getPost('id_chamada'));
                $insert_id = $this->request->getPost('id_chamada');
    
                if($dia_nao_letivo != "S"){
                    if (isset($alunos)) {
                        // Itera sobre cada aluno
                        foreach ($alunos as $aluno) {
                    
                            $dados_chamada_aluno['FK_ID_CHAMADA'] = $insert_id;
                            $dados_chamada_aluno['FK_ID_ALUNO'] = $aluno['id'];
                            $dados_chamada_aluno['PRESENTE'] = $aluno['status'];
                            $dados_chamada_aluno['OBSERVACOES'] = $aluno['justificativa'];
                    
                            $this->turmaModel->updateChamadaAluno($dados_chamada_aluno);
        
                            if($aluno['status'] == "N"){
                                $chamada_com_falta = true;
                            }
                        }
                    }
                }
    
    
            }else{
                $insert_id = $this->turmaModel->setChamada($dados_chamada);
    
                if($dia_nao_letivo != "S"){
                    if (isset($alunos)) {
                        // Itera sobre cada aluno
                        $chamada_com_falta = false;
                        foreach ($alunos as $aluno) {
                    
                            $dados_chamada_aluno['FK_ID_CHAMADA'] = $insert_id;
                            $dados_chamada_aluno['FK_ID_ALUNO'] = $aluno['id'];
                            $dados_chamada_aluno['PRESENTE'] = $aluno['status'];
                            $dados_chamada_aluno['OBSERVACOES'] = $aluno['justificativa'];
                    
                            $this->turmaModel->setChamadaAluno($dados_chamada_aluno);
        
                            if($aluno['status'] == "N"){
                                $chamada_com_falta = true;
                            }
                        }
        
                        if($chamada_com_falta){
                            $usuarios = $this->usuarioModel->getUsuariosEscola($turma->FK_ID_ESCOLA);
                            foreach ($usuarios as $usuario) {
                                $id_usuario = $usuario->ID_USUARIO;
                                
                                $dados_notificacao['FK_ID_CHAMADA'] = $insert_id;
                                $dados_notificacao['FK_ID_ESCOLA']  = $turma->FK_ID_ESCOLA;
                                $dados_notificacao['FK_ID_TURMA']   = $turma->ID_TURMA;
                                $dados_notificacao['FK_ID_USUARIO'] = $id_usuario;
                                $dados_notificacao['LIDO']          = "N";
                        
                                $this->turmaModel->setNotificacao($dados_notificacao);
                            }
                        }
                    }
                }
    
    
    
                
            }
    
    
            if($insert_id){
                echo json_encode(array("msg"=>"success"));
            }else{
                echo json_encode(array("msg"=>"error"));
            }
        }



    }

    public function Ocorrencia()
    {

        $dados = array();
        $dados['resultados'] = $this->turmaModel->getTurmaProfissional($this->escola->ID_ESCOLA, $this->usuario->FK_ID_PROFISSIONAL);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('turma_ocorrencia', $dados);
        echo view('commons_app/footer');
    }

    public function OcorrenciaNovo($turma, $ocorrencia)
    {

        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);
        if($ocorrencia != 0){
            $dados['dados_ocorrencia'] = $this->turmaModel->getOcorrenciaId($ocorrencia);
            $dados['dados_envolvidos_ocorrencia'] = $this->turmaModel->getEnvolvidosOcorrenciaId($ocorrencia);
        }else{
            $dados['dados_ocorrencia'] = "";
            $dados['dados_envolvidos_ocorrencia'] = "";
        }

        //var_dump($dados);die();

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('nova_ocorrencia', $dados);
        echo view('commons_app/footer');
    }

    public function ListaOcorrencia($turma)
    {

        $data = "";
        if($this->request->getPost('pesquisar') == "S"){
            $data = $this->request->getPost('data_filtro');
        }

        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados_ocorrencia'] = $this->turmaModel->getOcorrencias($this->usuario->FK_ID_PROFISSIONAL, $turma, $data);
        $dados['resultados_alunos'] = $this->turmaModel->getOcorrenciasAluno($this->usuario->FK_ID_PROFISSIONAL, $turma);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('lista_ocorrencia', $dados);
        echo view('commons_app/footer');
    }

    public function OcorrenciaInserir(){

        $data = $this->request->getPost('dados');

        $data = $this->request->getPost('data');
        $hora = $this->request->getPost('hora');
        $descricao = $this->request->getPost('descricao');
        $alunos = $this->request->getPost('alunos');
        $turma = $this->request->getPost('turma');

        $dados_ocorrencia['FK_ID_ESCOLA'] = $this->escola->ID_ESCOLA;
        $dados_ocorrencia['FK_ID_TURMA'] = $turma;
        $dados_ocorrencia['FK_ID_PROFESSOR'] = $this->usuario->FK_ID_PROFISSIONAL;
        $dados_ocorrencia['DATA'] = $data;
        $dados_ocorrencia['HORA'] = $hora;
        $dados_ocorrencia['DESCRICAO'] = $descricao;

        if($this->request->getPost('id_ocorrencia') != "" && $this->request->getPost('id_ocorrencia') != null){
            $dados_ocorrencia['ID_OCORRENCIA'] = $this->request->getPost('id_ocorrencia');
            $this->turmaModel->updateOcorrencia($dados_ocorrencia);
            $this->turmaModel->deleteOcorrenciaAluno($this->request->getPost('id_ocorrencia'));
            $insert_id = $this->request->getPost('id_ocorrencia');
        }else{
            $insert_id = $this->turmaModel->setOcorrencia($dados_ocorrencia);
        }



        if (isset($alunos)) {
            // Itera sobre cada aluno
            foreach ($alunos as $aluno) {
                if($aluno['status'] == "S"){
                    $dados_ocorrencia_aluno['FK_ID_OCORRENCIA'] = $insert_id;
                    $dados_ocorrencia_aluno['FK_ID_ALUNO'] = $aluno['id'];
            
                    $this->turmaModel->setOcorrenciaAluno($dados_ocorrencia_aluno);
                }
        
            }
        }

        if($insert_id){
            echo json_encode(array("msg"=>"success"));
        }else{
            echo json_encode(array("msg"=>"error"));
        }


    }

    public function Acompanhamento()
    {

        $dados = array();
        $dados['resultados'] = $this->turmaModel->getTurmaProfissional($this->escola->ID_ESCOLA, $this->usuario->FK_ID_PROFISSIONAL);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('turma_acompanhamento', $dados);
        echo view('commons_app/footer');
    }

    public function AcompanhamentoNovo($turma)
    {

        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('nova_acompanhamento', $dados);
        echo view('commons_app/footer');
    }

    public function AcompanhamentoPeriodo($aluno, $turma, $situacao)
    {

        $dados = array();
        $dados['aluno_primeiro_semestre'] = $this->turmaModel->getDadosAlunoSemestre(1, $aluno, $turma, $this->usuario->FK_ID_PROFISSIONAL);
        $dados['aluno_segundo_semestre'] = $this->turmaModel->getDadosAlunoSemestre(2, $aluno, $turma, $this->usuario->FK_ID_PROFISSIONAL);
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['aluno'] = $aluno;
        $dados['situacao'] = $situacao;
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('periodo_acompanhamento', $dados);
        echo view('commons_app/footer');
    }

    public function RegistrarAcompanhamento($periodo, $turma, $aluno)
    {

        $dados = array();
        $dados['dados_semestre'] = $this->turmaModel->getDadosAlunoSemestre($periodo, $aluno, $turma, $this->usuario->FK_ID_PROFISSIONAL);
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);
        $dados['semestre'] = $periodo;
        $dados['aluno'] = $aluno;
        $dados['dados_aluno'] = $this->alunoModel->getAlunoID($aluno);

        //var_dump($dados);die();

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('novo_acompanhamento', $dados);
        echo view('commons_app/footer');
    }

    public function AcompanhamentoInserir(){

        
        $dados_acompanhamento = array();
        $dados_acompanhamento['FK_ID_ALUNO'] = $this->request->getPost('aluno');
        $dados_acompanhamento['FK_ID_PROFISSIONAL'] = $this->usuario->FK_ID_PROFISSIONAL;
        $dados_acompanhamento['FK_ID_TURMA'] = $this->request->getPost('turma');
        $dados_acompanhamento['SEMESTRE'] = $this->request->getPost('semestre');
        $dados_acompanhamento['DATA'] = $this->request->getPost('data_acompanhamento');
        $dados_acompanhamento['EU_OUTROS_NOS'] = $this->request->getPost('eu_outros');
        $dados_acompanhamento['CORPO_GESTOS_MOVIMENTOS'] = $this->request->getPost('corpo_gestos');
        $dados_acompanhamento['TRACOS_SONS_CORES_FORMAS'] = $this->request->getPost('tracos_sons');
        $dados_acompanhamento['ESCUTA_FALA_PENSAMENTO_IMAGINACAO'] = $this->request->getPost('escuta_fala');
        $dados_acompanhamento['ESPACOS_TEMPOS_QUANTIDADES'] = $this->request->getPost('espaco_tempos');
        $dados_acompanhamento['ESTRATEGIAS_APOIO_INTERVENCOES'] = $this->request->getPost('estrategias');
        $dados_acompanhamento['RECOMENDACOES'] = $this->request->getPost('recomendacoes');

        if($this->request->getPost('acompanhamento_id') != "" && $this->request->getPost('acompanhamento_id') != null){
            $dados_acompanhamento['ID_ACOMPANHAMENTO_ALUNO'] = $this->request->getPost('acompanhamento_id');
            $insert_id = $this->turmaModel->updateAcompanhamento($dados_acompanhamento);
        }else{
            $insert_id = $this->turmaModel->setAcompanhamento($dados_acompanhamento);
        }

        if($insert_id){
            echo json_encode(array("msg"=>"success"));
        }else{
            echo json_encode(array("msg"=>"error"));
        }


    }

    /**DIAGNOTISCO */

    public function Registro()
    {

        $dados = array();
        $dados['resultados'] = $this->turmaModel->getTurmaProfissional($this->escola->ID_ESCOLA, $this->usuario->FK_ID_PROFISSIONAL);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('turma_registro', $dados);
        echo view('commons_app/footer');
    }

    public function RegistroNovo($turma)
    {

        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('nova_registro', $dados);
        echo view('commons_app/footer');
    }

    public function RegistroPeriodo($aluno, $turma, $situacao)
    {

        $dados = array();
        $dados['aluno_primeiro_semestre'] = $this->turmaModel->getDadosAlunoSemestreRegistro(1, $aluno, $turma, $this->usuario->FK_ID_PROFISSIONAL);
        $dados['aluno_segundo_semestre'] = $this->turmaModel->getDadosAlunoSemestreRegistro(2, $aluno, $turma, $this->usuario->FK_ID_PROFISSIONAL);
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['aluno'] = $aluno;
        $dados['situacao'] = $situacao;
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('registro_periodo_acompanhamento', $dados);
        echo view('commons_app/footer');
    }

    public function RegistrarRegistro($periodo, $turma, $aluno)
    {

        $dados = array();
        $dados['dados_semestre'] = $this->turmaModel->getDadosAlunoSemestreRegistro($periodo, $aluno, $turma, $this->usuario->FK_ID_PROFISSIONAL);
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);
        $dados['semestre'] = $periodo;
        $dados['aluno'] = $aluno;
        $dados['dados_aluno'] = $this->alunoModel->getAlunoID($aluno);

        //var_dump($dados);die();

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('novo_registro', $dados);
        echo view('commons_app/footer');
    }

    public function RegistroInserir(){

        
        $dados_registro = array();
        $dados_registro['FK_ID_ALUNO'] = $this->request->getPost('aluno');
        $dados_registro['FK_ID_PROFISSIONAL'] = $this->usuario->FK_ID_PROFISSIONAL;
        $dados_registro['FK_ID_TURMA'] = $this->request->getPost('turma');
        $dados_registro['SEMESTRE'] = $this->request->getPost('semestre');
        $dados_registro['DATA'] = $this->request->getPost('data_acompanhamento');
        $dados_registro['DESCRICAO'] = $this->request->getPost('descricao');

        if($this->request->getPost('registro_id') != "" && $this->request->getPost('registro_id') != null){
            $dados_registro['ID_REGISTRO_ALUNO'] = $this->request->getPost('registro_id');
            $insert_id = $this->turmaModel->updateRegistro($dados_registro);
        }else{
            $insert_id = $this->turmaModel->setRegistro($dados_registro);
        }

        if($insert_id){
            echo json_encode(array("msg"=>"success"));
        }else{
            echo json_encode(array("msg"=>"error"));
        }


    }

    /**FICHA DE OBSERVAÇÃO DO ALUNO */

    public function FichaAluno()
    {

        $dados = array();
        $dados['resultados'] = $this->turmaModel->getTurmaProfissional($this->escola->ID_ESCOLA, $this->usuario->FK_ID_PROFISSIONAL);

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('turma_fichaAluno', $dados);
        echo view('commons_app/footer');
    }

    public function FichaAlunoNovo($turma)
    {

        $dados = array();
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);

        //var_dump($dados['resultados']);die();
        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('nova_fichaAluno', $dados);
        echo view('commons_app/footer');
    }

    public function FichaAlunoPeriodo($aluno, $turma, $situacao)
    {

        $dados = array();
        $dados['aluno_primeiro_bimestre'] = $this->turmaModel->getDadosAutonomia($aluno, "", $turma, 1);
        $dados['aluno_segundo_bimestre'] = $this->turmaModel->getDadosAutonomia($aluno, "", $turma, 2);
        $dados['aluno_terceiro_bimestre'] = $this->turmaModel->getDadosAutonomia($aluno, "", $turma, 3);
        $dados['aluno_quarto_bimestre'] = $this->turmaModel->getDadosAutonomia($aluno, "", $turma, 4);
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['aluno'] = $aluno;
        $dados['situacao'] = $situacao;

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('fichaAluno_periodo_acompanhamento', $dados);
        echo view('commons_app/footer');
    }

    public function RegistrarFichaAluno($bimestre, $turma, $aluno)
    {

        $dados = array();
        $dados['dados_semestre'] = "";
        $dados['turma'] = $this->turmaModel->getTurmaID($turma);
        $dados['resultados'] = $this->turmaModel->getAlunoTurmaProfissional($turma);
        $dados['bimestre'] = $bimestre;
        $dados['aluno'] = $aluno;
        $dados['dados_aluno'] = $this->alunoModel->getAlunoID($aluno);
        $profissional = $this->usuario->FK_ID_PROFISSIONAL;

        // Buscar dados de autonomia
        $dados['dados_autonomia'] = $this->turmaModel->getDadosAutonomia($aluno, $profissional, $turma, $bimestre);

        // Buscar dados de aspectos cognitivos
        $dados['dados_cognitivos'] = $this->turmaModel->getDadosCognitivos($aluno, $profissional, $turma, $bimestre);
        
        // Buscar dados de aspectos físicos
        $dados['dados_fisicos'] = $this->turmaModel->getDadosFisicos($aluno, $profissional, $turma, $bimestre);
        
        // Buscar dados de motora fina
        $dados['dados_motora_fina'] = $this->turmaModel->getDadosMotoraFina($aluno, $profissional, $turma, $bimestre);
        
        // Buscar dados de relação família-escola
        $dados['dados_relacao_familia_escola'] = $this->turmaModel->getDadosRelacaoFamiliaEscola($aluno, $profissional, $turma, $bimestre);
        
        // Buscar dados de aspectos sociais e emocionais
        $dados['dados_sociais_emocionais'] = $this->turmaModel->getDadosSociaisEmocionais($aluno, $profissional, $turma, $bimestre);

        //var_dump($dados);die();

        echo view('commons_app/header');
        echo view('commons_app/navbartop');
        echo view('commons_app/navbarleft', getBarMenu($this->usuario));
        echo view('novo_FichaAluno', $dados);
        echo view('commons_app/footer');
    }

    public function FichaAlunoInserir(){

        
        // Coletar os dados principais
        $aluno = $this->request->getPost('aluno');
        $profissional = $this->usuario->FK_ID_PROFISSIONAL;
        $turma = $this->request->getPost('turma');
        $bimestre = $this->request->getPost('bimestre');
        $data_acompanhamento = $this->request->getPost('data_acompanhamento');

        // Coleta dos dados específicos para cada tabela e inserção
        $this->inserirAspectosAutonomia($aluno, $profissional, $turma, $bimestre, $data_acompanhamento);
        $this->inserirAspectosCognitivos($aluno, $profissional, $turma, $bimestre, $data_acompanhamento);
        $this->inserirAspectosFisicos($aluno, $profissional, $turma, $bimestre, $data_acompanhamento);
        $this->inserirAspectosMotoraFina($aluno, $profissional, $turma, $bimestre, $data_acompanhamento);
        $this->inserirAspectosRelacaoFamiliaEscola($aluno, $profissional, $turma, $bimestre, $data_acompanhamento);
        $this->inserirAspectosSociaisEmocionais($aluno, $profissional, $turma, $bimestre, $data_acompanhamento);

        echo json_encode(array("msg"=>"success"));


    }

    private function inserirAspectosAutonomia($aluno, $profissional, $turma, $bimestre, $data_acompanhamento) {
        $dados = array();
        $dados['UTILIZA_FRALDA'] = $this->request->getPost('utiliza_fralda');
        $dados['SE_LIMPA_SOZINHO'] = $this->request->getPost('se_limpa_sozinho');
        $dados['ESCOVA_DENTES_SOZINHO'] = $this->request->getPost('escova_dentes_sozinho');
        $dados['GUARDA_PERTENCES_SOZINHO'] = $this->request->getPost('guarda_pertences_sozinho');
        $dados['AMARRA_CADARCOS'] = $this->request->getPost('amarra_cadarcos');
        $dados['ABRE_MOCHILA_SEM_AUXILIO'] = $this->request->getPost('abre_mochila');
        $dados['INDEPENDENTE_REALIZACAO_ATIVIDADES'] = $this->request->getPost('independente_atividades');
        $dados['FK_ID_ALUNO'] = $aluno;
        $dados['FK_ID_PROFISSIONAL'] = $profissional;
        $dados['FK_ID_TURMA'] = $turma;
        $dados['BIMESTRE'] = $bimestre;
        $dados['DATA'] = $data_acompanhamento;
    
        if($this->request->getPost('aspectosautonomia_id') != "" && $this->request->getPost('aspectosautonomia_id') != null){
            $dados['ID_ASPECTOS_AUTONOMIA'] = $this->request->getPost('aspectosautonomia_id');
            $insert_id = $this->turmaModel->updateAspectosAutonomia($dados);
        }else{
            $insert_id = $this->turmaModel->setAspectosAutonomia($dados);
        }
    }

    
    private function inserirAspectosCognitivos($aluno, $profissional, $turma, $bimestre, $data_acompanhamento) {
        $dados = array();
        $dados['RECONHECE_IDENTIFICA_CORES'] = $this->request->getPost('reconhece_cores');
        $dados['RECONHECE_IDENTIFICA_NUMEROS'] = $this->request->getPost('reconhece_numeros');
        $dados['RECONHECE_IDENTIFICA_LETRAS'] = $this->request->getPost('reconhece_letras');
        $dados['DIFERENCIA_LETRAS_NUMEROS'] = $this->request->getPost('diferencia_letras_numeros');
        $dados['IDENTIFICA_LETRAS_NOME'] = $this->request->getPost('identifica_letras_nome');
        $dados['ESCREVE_NOME_SEM_AUXILIO'] = $this->request->getPost('escreve_nome_sem_auxilio');
        $dados['REALIZA_PAREAMENTO'] = $this->request->getPost('realiza_pareamento');
        $dados['MANTEM_ATENCAO_CONCENTRADA'] = $this->request->getPost('mantem_atencao');
        $dados['RECONHECE_SILABAS_ESTUDADAS'] = $this->request->getPost('reconhece_silabas');
        $dados['IDENTIFICA_PARTES_CORPO'] = $this->request->getPost('identifica_partes_corpo');
        $dados['NOMEIA_PESSOAS_FAMILIARES'] = $this->request->getPost('nomeia_pessoas_familiares');
        $dados['SEQUENCIA_LOGICA_FATOS'] = $this->request->getPost('apresenta_sequencia_fatos');
        $dados['RELACIONA_NUMEROS_QUANTIDADES'] = $this->request->getPost('relaciona_numeros_quantidades');
        $dados['COMUNICA_CLAREZA'] = $this->request->getPost('comunica_clareza');
        $dados['OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS'] = $this->request->getPost('observa_seme_dife');
        $dados['COMPREENDER_RESPONDE_IDADE'] = $this->request->getPost('compreende_idade');
        $dados['FK_ID_ALUNO'] = $aluno;
        $dados['FK_ID_PROFISSIONAL'] = $profissional;
        $dados['FK_ID_TURMA'] = $turma;
        $dados['BIMESTRE'] = $bimestre;
        $dados['DATA'] = $data_acompanhamento;
    
        if($this->request->getPost('aspectoscognitivos_id') != "" && $this->request->getPost('aspectoscognitivos_id') != null){
            $dados['ID_ASPECTOS_COGNITIVOS'] = $this->request->getPost('aspectoscognitivos_id');
            $insert_id = $this->turmaModel->updateAspectosCognitivos($dados);
        }else{
            $insert_id = $this->turmaModel->setAspectosCognitivos($dados);
        }
    }

    private function inserirAspectosFisicos($aluno, $profissional, $turma, $bimestre, $data_acompanhamento) {
        $dados = array();
        $dados['LATERALIDADE'] = $this->request->getPost('lateralidade');
        $dados['NOCAO_ESPACO'] = $this->request->getPost('nocao_espaco');
        $dados['EQUILIBRIO_AGILIDADE'] = $this->request->getPost('equilibrio_agilidade');
        $dados['PULA_UM_PE'] = $this->request->getPost('pula_um_pe');
        $dados['PULA_DOIS_PES'] = $this->request->getPost('pula_dois_pes');
        $dados['CORRE_LINHA_RETA'] = $this->request->getPost('corre_linha_reta');
        $dados['PERPASSA_OBSTACULOS'] = $this->request->getPost('perpassa_obstaculos');
        $dados['ANDA_PONTA_PES'] = $this->request->getPost('anda_ponta_pes');
        $dados['FK_ID_ALUNO'] = $aluno;
        $dados['FK_ID_PROFISSIONAL'] = $profissional;
        $dados['FK_ID_TURMA'] = $turma;
        $dados['BIMESTRE'] = $bimestre;
        $dados['DATA'] = $data_acompanhamento;
    
        if($this->request->getPost('aspectosfisicos_id') != "" && $this->request->getPost('aspectosfisicos_id') != null){
            $dados['ID_ASPECTOS_FISICOS'] = $this->request->getPost('aspectosfisicos_id');
            $insert_id = $this->turmaModel->updateAspectosFisicos($dados);
        }else{
            $insert_id = $this->turmaModel->setAspectosFisicos($dados);
        }
    }

    private function inserirAspectosMotoraFina($aluno, $profissional, $turma, $bimestre, $data_acompanhamento) {
        $dados = array();
        $dados['PEGA_CORRETAMENTE_LAPIS'] = $this->request->getPost('pega_lapis');
        $dados['UTILIZA_LAPIS_FACILIDADE'] = $this->request->getPost('utiliza_lapis');
        $dados['ESCREVE_FORMA_ESPELHADA'] = $this->request->getPost('escreve_espelhada');
        $dados['RECORTA_COM_MAOS'] = $this->request->getPost('recorta_maos');
        $dados['RECORTA_COM_TESOURA'] = $this->request->getPost('recorta_tesoura');
        $dados['PINTA_DENTRO_ESPACOS'] = $this->request->getPost('pinta_espacos');
        $dados['AMASSA'] = $this->request->getPost('amassa');
        $dados['DESENHA'] = $this->request->getPost('desenha');
        $dados['ALINHAVA'] = $this->request->getPost('alinhava');
        $dados['ABRE_EMBALAGENS'] = $this->request->getPost('abre_embalagens');
        $dados['ENROSCA'] = $this->request->getPost('enrosca');
        $dados['MONTA_DESMONTA'] = $this->request->getPost('monta_desmonta');
        $dados['FK_ID_ALUNO'] = $aluno;
        $dados['FK_ID_PROFISSIONAL'] = $profissional;
        $dados['FK_ID_TURMA'] = $turma;
        $dados['BIMESTRE'] = $bimestre;
        $dados['DATA'] = $data_acompanhamento;
    
        if($this->request->getPost('aspectosmotorafina_id') != "" && $this->request->getPost('aspectosmotorafina_id') != null){
            $dados['ID_ASPECTOS_MOTORA_FINA'] = $this->request->getPost('aspectosmotorafina_id');
            $insert_id = $this->turmaModel->updateAspectosMotoraFina($dados);
        }else{
            $insert_id = $this->turmaModel->setAspectosMotoraFina($dados);
        }
    }

    private function inserirAspectosRelacaoFamiliaEscola($aluno, $profissional, $turma, $bimestre, $data_acompanhamento) {
        $dados = array();
        $dados['PARTICIPA_REUNIOES_SOLICITADO'] = $this->request->getPost('participa_reunioes');
        $dados['UNIFORME_LIMPO'] = $this->request->getPost('uniforme_limpo');
        $dados['REALIZA_BANHO_DIARIO'] = $this->request->getPost('banho_diario');
        $dados['HIGIENIZA_PERTENCES_ALUNO'] = $this->request->getPost('higieniza_pertences');
        $dados['CUIDADO_MATERIAIS_ESCOLARES'] = $this->request->getPost('cuida_materiais');
        $dados['ALUNO_ASSIDUO'] = $this->request->getPost('aluno_assiduo');
        $dados['PONTUALIDADE_HORARIOS_ENTRADA_SAIDA'] = $this->request->getPost('pontualidade_horarios');
        $dados['FK_ID_ALUNO'] = $aluno;
        $dados['FK_ID_PROFISSIONAL'] = $profissional;
        $dados['FK_ID_TURMA'] = $turma;
        $dados['BIMESTRE'] = $bimestre;
        $dados['DATA'] = $data_acompanhamento;
        
    
        if($this->request->getPost('aspectosrelacaofamiliaescola_id') != "" && $this->request->getPost('aspectosrelacaofamiliaescola_id') != null){
            $dados['ID_ASPECTOS_RELACAO_FAMILIA_ESCOLA'] = $this->request->getPost('aspectosrelacaofamiliaescola_id');
            $insert_id = $this->turmaModel->updateAspectosRelacaoFamiliaEscola($dados);
        }else{
            $insert_id = $this->turmaModel->setAspectosRelacaoFamiliaEscola($dados);
        }
    }

    private function inserirAspectosSociaisEmocionais($aluno, $profissional, $turma, $bimestre, $data_acompanhamento) {
        $dados = array();
        $dados['BUSCA_ATENCAO_PARA_SI'] = $this->request->getPost('atencao');
        $dados['BUSCA_INTERAGIR_COLEGAS'] = $this->request->getPost('interage_colegas');
        $dados['COMPREENDE_ATENDE_REGRAS'] = $this->request->getPost('compreende_regras');
        $dados['ACEITA_SOLICITA_AJUDA'] = $this->request->getPost('aceita_ajuda');
        $dados['DIVIDE_COMPARTILHA_BRINQUEDOS'] = $this->request->getPost('divide_compartilha');
        $dados['PARTICIPA_MOMENTOS_GRUPO'] = $this->request->getPost('participa_grupo');
        $dados['EXPOE_ACONTECIMENTOS_COTIDIANO'] = $this->request->getPost('expor_cotidiano');
        $dados['BRINCA_FORMA_ISOLADA'] = $this->request->getPost('brinca_isolado');
        $dados['BRINCA_COM_COLEGAS'] = $this->request->getPost('brinca_colegas');
        $dados['ACEITA_CONTATO_FISICO'] = $this->request->getPost('contato_fisico');
        $dados['SE_ISOLA'] = $this->request->getPost('se_isola');
        $dados['SE_ZANGA_COM_FACILIDADE'] = $this->request->getPost('se_zanga');
        $dados['ALTERACOES_HUMOR_FREQUENCIA'] = $this->request->getPost('alteracoes_humor');
        $dados['FAZ_CONTATO_VISUAL'] = $this->request->getPost('contato_visual');
        $dados['SE_RECONHECE_FOTOS'] = $this->request->getPost('se_reconhece_fotos');
        $dados['RECONHECE_PESSOAS_FOTOS'] = $this->request->getPost('reconhece_pessoas_fotos');
        $dados['RECONHECE_COMPONENTES_FAMILIARES'] = $this->request->getPost('reconhece_componentes_familiares');
        $dados['FK_ID_ALUNO'] = $aluno;
        $dados['FK_ID_PROFISSIONAL'] = $profissional;
        $dados['FK_ID_TURMA'] = $turma;
        $dados['BIMESTRE'] = $bimestre;
        $dados['DATA'] = $data_acompanhamento;        
    
        if($this->request->getPost('aspectossociaiseemocionais_id') != "" && $this->request->getPost('aspectossociaiseemocionais_id') != null){
            $dados['ID_ASPECTOS_SOCIAIS_EMOCIONAIS'] = $this->request->getPost('aspectossociaiseemocionais_id');
            $insert_id = $this->turmaModel->updateAspectosSociaisEmocionais($dados);
        }else{
            $insert_id = $this->turmaModel->setAspectosSociaisEmocionais($dados);
        }
    }
    
}
