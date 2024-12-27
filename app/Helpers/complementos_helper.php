<?php

    function limpaCPF_CNPJ($valor){
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        return $valor;
    }

    function mask($val, $mask) {
        $maskared = '';
        $k = 0;
        for($i = 0; $i<=strlen($mask)-1; $i++) {
            if($mask[$i] == '#') {
                if(isset($val[$k])) $maskared .= $val[$k++];
            } else {
                if(isset($mask[$i])) $maskared .= $mask[$i];
            }
        }
        return $maskared;
    }


    function status($s){
        if($s == 'I'){
            return '<span class="text-write-50 badge badge-info">Inativo</span</span>';
        }else if($s == 'A'){
            return '<span class="text-write-50 badge badge-success">Ativo</span</span>';
        }
    }

    function tipo($s){
        if($s == 'C'){
            return '<span class="text-write-50 badge badge-info">Cliente</span</span>';
        }else if($s == 'F'){
            return '<span class="text-write-50 badge badge-success">Fornecedor</span</span>';
        }
    }

    function sn($s){
        if($s == 'N'){
            return '<span class="text-write-50 badge badge-danger">Não</span</span>';
        }else if($s == 'S'){
            return '<span class="text-write-50 badge badge-success">Sim</span</span>';
        }
    }

    function pg($s){
        if($s == 'CC'){
            return '<span class="text-write-50 badge badge-warning">Cartão de crédito</span</span>';
        }else if($s == 'BB'){
            return '<span class="text-write-50 badge badge-success">Boleto</span</span>';
        }else if($s== 'GR'){
            return '<span class="text-write-50 badge badge-info">Ambos</span</span>';
        }else{
            return '<span class="text-write-50 badge badge-danger">Grátis</span</span>';
        }
    }

    function cargo($s){
        if($s == 'PR'){
            return 'Professor';
        }else if($s == 'DR'){
            return 'Diretor';
        }else if($s == 'AD'){
            return 'Administrador';
        }else if($s == 'CO'){
            return 'Coordenador';
        }else if($s == 'PE'){
            return 'Pedagogo';
        }else if($s == 'OR'){
            return 'Orientador';
        }else if($s == 'GT'){
            return 'Gestão';
        }else if($s == 'AM'){
            return 'Administrativo';
        }
    }

    function validar_cpf($cpf) {

        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
    
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
            return false;
        }
    
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }
    
        // Faz o calculo para validar o CPF
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return false;
            }
        }
        
        return true;
    
    }

    function validar_cnpj($cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            return false;
        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return false;
        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }
        $resto = $soma % 11;
        return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }
	
	function frm_moeda($valor){
        $x = number_format($valor,2,",",".");
        return $x;
    }

    function tirarAcentos($string){
        // matriz de entrada
        $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','Ã','Õ','ñ','Ñ','ç','Ç','-','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º','¬','.','£','©');
    
        // matriz de saída
        $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','A','O','n','n','c','C','','','','','','','','','','','','','','','','','','','','','','','','','','');
    
        // devolver a string
        return str_replace($what, $by, $string);
    }
    
    function inverterData($data){
        if(count(explode("/",$data)) > 1){
            return implode("-",array_reverse(explode("/",$data)));
        }elseif(count(explode("-",$data)) > 1){
            return implode("/",array_reverse(explode("-",$data)));
        }
    }

    function Countdata($data){
		$sodata = substr($data, 0, 10);
		$datainvertida = inverterData($sodata);
		$hora = substr($data, 10);
		$dataehora = $datainvertida." ".$hora;

		return ($dataehora);

	}

    function inverterDataHora($data){
		$sodata = substr($data, 0, 10);
		$datainvertida = inverterData($sodata);
		$hora = substr($data, 10);
		$dataehora = $datainvertida." ".$hora;

		return ($dataehora);

    }

    function getBarMenu($usuario){
        $session = \Config\Services::session();
        $usuario = $session->get('dadoslogin');
        $escola = $session->get('escola');
        $usuariosModel = new \App\Models\UsuarioModel;
		$dadosnavleft['permissaomenu'] = $usuariosModel->getPermissaoMenu($usuario->ID_USUARIO, $escola->ID_ESCOLA);
		$i = 0;
		foreach ($dadosnavleft['permissaomenu']->getResult() as $menu) {
			if($dadosnavleft['permissaomenu']->getResult()[$i]->ID_MENU == $menu->ID_MENU){
				$dadosnavleft['permissaomenu']->getResult()[$i]->submenu = $usuariosModel->getPermissaoSubmenu($usuario->ID_USUARIO, $escola->ID_ESCOLA,$menu->ID_MENU);
			}
			$i++;
		}
		return $dadosnavleft;
    }

    function sys_log($usuario, $comando, $tabela){
        $dados['FK_ID_USUARIO'] = $usuario;
        $dados['COMANDO'] = $comando;
        $dados['DATA'] = date('Y-m-d H:i:s');
        $dados['TABELA'] = $tabela;
        $usuariosModel = new \App\Models\UsuarioModel;
        $usuariosModel->setLog($dados);
    }

    function getFrequenciaAluno($id_chamada, $id_aluno){
        $turmaModel = new \App\Models\TurmaModel;
        $resp = $turmaModel->getFrequenciaAluno($id_chamada, $id_aluno);
        if(isset($resp)){
            if($resp->PRESENTE == "S"){
                return "P";
            }else if($resp->PRESENTE == "N"){
                if($resp->OBSERVACOES != "" && $resp->OBSERVACOES != null){
                    return "FJ";
                }else{
                    return "F";
                }
            }

        }else{
            return "-";
        }
        
    }

    function getJustificativas($id_chamada){
        $turmaModel = new \App\Models\TurmaModel;
        return $turmaModel->getJustificativas($id_chamada);
        
    }

    function getNotifcacoes(){
        $session = \Config\Services::session();
        $usuario = $session->get('dadoslogin');
        $escola = $session->get('escola');
        $turmaModel = new \App\Models\TurmaModel;
        $resp = $turmaModel->getNotificacoes($usuario->ID_USUARIO, $escola->ID_ESCOLA);
        if($resp != ""){
            return true;
        }else{
            return false;
        }
        
    }

    function getTurma($id_escola){
        $turmaModel = new \App\Models\TurmaModel;
        return $turmaModel->getTurma($id_escola);        
    }

    function getChamadas($id_turma){
        $session = \Config\Services::session();
        $usuario = $session->get('dadoslogin');
        $turmaModel = new \App\Models\TurmaModel;
        return $turmaModel->getChamadaTurma($id_turma, $usuario->ID_USUARIO);    
    }

    function getAlunosChamadas($id_chamada){
        $session = \Config\Services::session();
        $usuario = $session->get('dadoslogin');
        $turmaModel = new \App\Models\TurmaModel;
        return $turmaModel->getAlunosChamadas($id_chamada);    
    }

    function mostrarDados($id, $tipo){
        $ProcLotesModel = new \App\Models\ProcLotesModel;
        if($tipo == "vacinas"){
            $dados = $ProcLotesModel->getDadosVacina($id);   
            if($dados != null){
                $resposta = ""; 
                foreach ($dados as $dado) {
                    $resposta .= $dado->nome.", ";
                }
    
                // Remove a vírgula e o espaço final
                return rtrim($resposta, ", ");
            }   
        }else{
            $dados = $ProcLotesModel->getDadosMedicacao($id);   
            if($dados != null){
                $resposta = ""; 
                foreach ($dados as $dado) {
                    $resposta .= $dado->nome.", ";
                }
    
                // Remove a vírgula e o espaço final
                return rtrim($resposta, ", ");
            } 
        }
    }
    

    function turno($str){
        switch ($str) {
            case 'IN':
                return 'Integral';
            case 'PM':
                return 'Parcial Matutino';
            case 'PV':
                return 'Parcial Vespertino';
            case 'PA':
                return 'Parcial';
            case 'ND':
                return 'Noturno';
            case 'DU':
                return 'Dupla Jornada';
            case 'SE':
                return 'Semi-integral';
            default:
                return 'Não informado';
        }
    }

    function situacao($str){
        switch ($str) {
            case 'CO':
                return 'Progressão Direta';
            case 'TR':
                return 'Transferido';
            case 'EV':
                return 'Evadido';
            case 'FL':
                return 'Falecido';
            default:
                return 'Cursando';
        }
    }

    function categoria($str){
        switch ($str) {
            case 'DE':
                return 'Deficiência';
            case 'TR':
                return 'Transtorno';
            case 'IA':
                return 'Intolerância alimentar';
            case 'AL':
                return 'Alergia';
            case 'MC':
                return 'Medicamento contínuo';
            case 'TE':
                return 'Tratamento especializado';
            case 'DC':
                return 'Doenças crônicas';
            case 'AH':
                return 'Superdotação';
            default:
                return 'Código inválido';
        }
    }

    function limpaString($valor){
        $valor = trim($valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace(",", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("/", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace(" ", "", $valor);
        return $valor;
    }

    function encryptData($data) {
        $cipherMethod = 'AES-256-CBC';
        $encryptionKey = ENCRYPTION_KEY;
        $ivLength = openssl_cipher_iv_length($cipherMethod);
        $iv = openssl_random_pseudo_bytes($ivLength);
        $encryptedData = openssl_encrypt($data, $cipherMethod, $encryptionKey, OPENSSL_RAW_DATA, $iv);
        $encryptedData = base64_encode($iv . $encryptedData); // Combine IV com os dados criptografados
        return $encryptedData;
    }
    
    // Função para descriptografar dados
    function decryptData($encryptedData) {
        $cipherMethod = 'AES-256-CBC';
        $encryptionKey = ENCRYPTION_KEY;
        $encryptedData = base64_decode($encryptedData);
        $ivLength = openssl_cipher_iv_length($cipherMethod);
        $iv = substr($encryptedData, 0, $ivLength);
        $encryptedPayload = substr($encryptedData, $ivLength);
        $decryptedData = openssl_decrypt($encryptedPayload, $cipherMethod, $encryptionKey, OPENSSL_RAW_DATA, $iv);
        return $decryptedData;
    }

    function getCityNameById($cityId) {
        $url = "https://servicodados.ibge.gov.br/api/v1/localidades/municipios/{$cityId}";
    
        // Inicializar cURL
        $ch = curl_init();
    
        // Configurar a URL e retornar o resultado
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
        // Executar a requisição
        $response = curl_exec($ch);
    
        // Fechar cURL
        curl_close($ch);
    
        // Decodificar a resposta JSON
        $cityData = json_decode($response, true);
    
        // Retornar o nome da cidade
        return isset($cityData['nome']) ? $cityData['nome'] : 'Cidade não encontrada';
    }
    
?>