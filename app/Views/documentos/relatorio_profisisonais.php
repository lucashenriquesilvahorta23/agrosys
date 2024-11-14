<p style="text-align: center;"><strong>RELATÓRIO DE PROFISSIONAIS</strong></p>

<?php 

    switch ($funcao) {
        case '1':
            $cargo = "PROFESSOR(A)";
            break;
        case '2':
            $cargo = "ORIENTADOR";
            break;
        case '3':
            $cargo = "GESTOR(A) ESCOLAR";
            break;
        default:
            $cargo = "Todos";
            break;
    }

    if($situacao != "A"){
        $situacao = "Desligado";
    }else if($situacao == "A"){
        $situacao = "Admitido";
    }else{
        $situacao = "Todos";
    }


?>


    <table>
        <thead>
            <tr>
                <th>Nº</th>
                <th>Nome</th>
                <th class="">Função</th>
                <th class="">CPF</th>
                <th class="">Telefone</th>
                <th class="">Situação</th>
            </tr>
        </thead>
        <tbody>
            <!-- Alunos data here -->
            <?php 
                $cont = 1;
                foreach ($resultados as $resultado) {                    

                    switch ($resultado->CARGO) {
                        case '1':
                            $cargo = "PROFESSOR(A)";
                            break;
                        case '2':
                            $cargo = "ORIENTADOR";
                            break;
                        case '3':
                            $cargo = "GESTOR(A) ESCOLAR";
                            break;
                        default:
                            $cargo = "";
                            break;
                    }


                    echo'<tr>';
                    echo'    <td>'.$cont.'</td>';
                    echo'    <td>'.$resultado->NOME_PROFISSIONAL.'</td>';
                    echo'    <td class="">'.$cargo.'</td>';
                    echo'    <td>'.$resultado->CPF.'</td>';
                    echo'    <td>'.$resultado->TELEFONE_1.'</td>';
                    if($resultado->DATA_DESLIGAMENTO != null && $resultado->DATA_DESLIGAMENTO != "0000-00-00"){
                        echo '	<td>Desligado</td>';
                    }else{
                        echo '	<td>Admitido</td>';
                    }


                    echo'</tr>';
                    $cont++;
                }

            ?>
            <!-- Repeat for more students -->
        </tbody>
    </table>

    <p>
        <?= $escola->MUNICIPIO ?> – <?= isset($resultados[0]) ? $resultados[0]->ESTADO_NATURALIDADE : "MA" ?>, <?= date("d/m/Y") ?>
    </p>

    <div class="signature">
        <div>
            ____________________________ <br>
            <?= $escola->GESTOR ?> <br>
            CPF: <?= $escola->CPF_GESTOR ?> <br>
            Gestor(a) Escolar
        </div>
    </div>


</body>
</html>
