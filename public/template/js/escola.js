/* Funções da tabela Configuracoes/Funcionario */
window.onload = function () {

  $('form').on('keydown', function (event) {
    if (event.key === 'Enter') {
      event.preventDefault();
    }
  });
  // Exemplo de uso

  // Inicialize o DataTable
  var table = $('#tabela_padrao_datatable').DataTable({
    "language": {
      "sEmptyTable": "Nenhum registro encontrado",
      "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
      "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
      "sInfoFiltered": "(Filtrados de _MAX_ registros)",
      "sLengthMenu": "_MENU_ resultados por página",
      "sLoadingRecords": "Carregando...",
      "sProcessing": "Processando...",
      "sZeroRecords": "Nenhum registro encontrado",
      "sSearch": "",
      "oPaginate": {
        "sNext": "Próximo",
        "sPrevious": "Anterior",
        "sFirst": "Primeiro",
        "sLast": "Último"
      },
      "oAria": {
        "sSortAscending": ": Ordenar colunas de forma ascendente",
        "sSortDescending": ": Ordenar colunas de forma descendente"
      }
    },
    responsive: true,
    searchDelay: 500,
    ordering: true,
    dom: 'Bfrtip',
    select: true,
    buttons: [
      'csv', 'excel', 'pdf', 'print'
    ],
    "lengthMenu": [[100, 200, 500, 1000, 10000, 100000], [100, 200, 500, 1000, 10000, "Todos"]]
  });

  // Remova o conteúdo de pesquisa padrão do DataTables
  $('#tabela_padrao_datatable_filter label').contents().filter(function () {
    return this.nodeType === 3;
  }).remove();

  // Adicione a estrutura com o ícone de lupa e o campo de pesquisa
  $('#tabela_padrao_datatable_filter').html(`
  <div class="input-icon-container">
    <span class="search-icon"><img src="/template/img/lupa.png" alt="lupa" /></span>
    <input type="search" class="form-control" placeholder="Pesquisar" aria-controls="tabela_padrao_datatable">
  </div>
`);

  // Vincule o evento de pesquisa ao input customizado
  $('#tabela_padrao_datatable_filter input').on('keyup', function () {
    table.search(this.value).draw();
  });


  $('.select2').select2();


  $('#profissional_cep').on('change', function () {
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        $("#profissional_endereco").val("...");
        $("#profissional_bairro").val("...");
        $("#profissional_cidade").val("...");
        $("#profissional_estado").val("...");

        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

          if (!("erro" in dados)) {
            console.log(dados)
            //Atualiza os campos com os valores da consulta.
            $("#profissional_endereco").val(dados.logradouro);
            $("#profissional_bairro").val(dados.bairro);
            $("#profissional_cidade").val(dados.localidade);
            $("#profissional_estado").val(dados.uf);
          } //end if.

        });
      } //end if.
    } //end if.
  })

  $('.cpf').on('blur', function () {
    const cpf = $(this).val();
    if (!validarCPF(cpf)) {
      Swal.fire({
        title: "Erro!",
        text: "CPF inválido",
        icon: "error",
        confirmButtonColor: "#415e4a",
      }).then((result) => {

      });
      $(this).val("")
    }
  });

  $('.cnpj').on('blur', function () {
    const cnpj = $(this).val();
    if (!validarCNPJ(cnpj)) {
      Swal.fire({
        title: "Erro!",
        text: "CNPJ inválido",
        icon: "error",
        confirmButtonColor: "#415e4a",
      }).then((result) => {

      });
      $(this).val("")
    }
  });

  function validarCPF(cpf) {
    cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres que não são números

    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
      return false; // Verifica se o CPF tem 11 dígitos e não é uma sequência de números iguais
    }

    let soma = 0;
    let resto;

    // Validação do primeiro dígito verificador
    for (let i = 1; i <= 9; i++) {
      soma += parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    soma = 0;

    // Validação do segundo dígito verificador
    for (let i = 1; i <= 10; i++) {
      soma += parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(10, 11))) return false;

    return true;
  }

  function validarCNPJ(cnpj) {
    cnpj = cnpj.replace(/[^\d]+/g, ''); // Remove caracteres que não são números

    if (cnpj.length !== 14 || /^(\d)\1+$/.test(cnpj)) {
      return false; // Verifica se o CNPJ tem 14 dígitos e não é uma sequência de números iguais
    }

    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;

    // Validação do primeiro dígito verificador
    for (let i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2) pos = 9;
    }

    let resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)) return false;

    soma = 0;
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    pos = tamanho - 7;

    // Validação do segundo dígito verificador
    for (let i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2) pos = 9;
    }

    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)) return false;

    return true;
  }

  $('#aluno_cep').on('change', function () {
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        $("#aluno_endereco").val("...");
        $("#aluno_bairro").val("...");
        $("#aluno_cidade").val("...");
        $("#aluno_estado").val("...");

        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

          if (!("erro" in dados)) {
            console.log(dados)
            //Atualiza os campos com os valores da consulta.
            $("#aluno_endereco").val(dados.logradouro);
            $("#aluno_bairro").val(dados.bairro);
            $("#aluno_cidade").val(dados.localidade);
            $("#aluno_estado").val(dados.uf);
          } //end if.

        });
      } //end if.
    } //end if.
  })

  // if(document.querySelector('form[name="profissional"]').addEventListener('submit', function(event) {
  //   var escolaridade = document.querySelector('input[name="profissional_escolaridade"]:checked');
  //   if (escolaridade && escolaridade.value === 'S') {
  //       var grauAcademico = document.querySelector('input[name="profissional_nivel_grau_academico"]:checked');
  //       if (!grauAcademico) {
  //           alert('Por favor, selecione o Nível / Grau Acadêmico.');
  //           event.preventDefault(); // Impede o envio do formulário
  //       }
  //   }
  // }));

  $('#cep').on('change', function () {
    //Nova variável "cep" somente com dígitos.
    var cep = $(this).val().replace(/\D/g, '');

    //Verifica se campo cep possui valor informado
    if (cep != "") {

      //Expressão regular para validar o CEP.
      var validacep = /^[0-9]{8}$/;

      //Valida o formato do CEP.
      if (validacep.test(cep)) {

        //Preenche os campos com "..." enquanto consulta webservice.
        $("#endereco").val("...");
        $("#bairro").val("...");
        $("#cidade").val("...");
        $("#estado").val("...");

        //Consulta o webservice viacep.com.br/
        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function (dados) {

          if (!("erro" in dados)) {
            console.log(dados)
            //Atualiza os campos com os valores da consulta.
            $("#endereco").val(dados.logradouro);
            $("#bairro").val(dados.bairro);
            $("#cidade").val(dados.localidade);
            $("#estado").val(dados.uf);
          } //end if.

        });
      } //end if.
    } //end if.
  })

  $('#limpafrmpesquisa').click(function () {
    console.log('teste');
    $("#frm_pesquisa")[0].reset();
    $('#frm_pesquisa input').val(""); //coloca todos valores de todos inputs do form como vazio
    $('#frm_pesquisa select').val(""); //coloca todos valores de todos inputs do form como vazio
    $(":checkbox").prop('checked', false);
    $(':checkbox').find('checked').remove();
  });

  $('#enviafrmpesquisa').click(function () {
    $("#frm_pesquisa")[0].submit();
  });

  $('#gravar').click(function () {
    Swal.fire({
      title: "Deseja salvar?",
      text: "Certifique-se de ter verificado todos os dados antes de efetuar a ação!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Sim, pode salvar!"
    }).then((result) => {
      if (result.isConfirmed) {
        $('#frm').submit();
      } else {
        swal("Cancelado", "Operação cancelada! Dados não gravados", "error");
      }
    });
  });

  document.addEventListener('gesturestart', function (e) {
    e.preventDefault();
  });

  /*   $('#gravar_acompanhamento').click(function () {
      Swal.fire({
        title: "Deseja salvar acompanhamento?",
        text: "Certifique-se de ter verificado todos os dados antes de efetuar a ação!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, pode salvar!"
      }).then((result) => {
        if (result.isConfirmed) {
          $('#frm').submit();
        } else {
          swal("Cancelado", "Operação cancelada! Dados não gravados", "error");
        }
      });
    }); */

  $('#profissional_estado_naturalidade').on('change', function () {
    var uf = $(this).val();
    var savedCityId = $('#profissional_naturalidade_hidden').val();

    $.ajax({
      type: "GET",
      url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf + '/municipios',
      dataType: 'json',
      success: function (data) {
        if (!data || !Array.isArray(data)) return; // Verifica se 'data' é um array

        var select = $('#profissional_naturalidade');
        select.empty(); // Limpa as opções existentes

        select.append('<option value="">Selecione uma cidade</option>'); // Adiciona a opção padrão

        // Percorre o array de cidades retornado e adiciona cada uma ao select
        $.each(data, function (index, cidade) {
          var option = $('<option></option>').attr('value', cidade.id).text(cidade.nome);
          select.append(option);

        });

        // Seleciona a cidade salva, se existir
        if (savedCityId) {
          select.val(savedCityId);
        }
      }
    });
  }).trigger('change');


  $('#aluno_estado_naturalidade').on('change', function () {
    var uf = $(this).val();
    var savedCityId = $('#aluno_naturalidade_hidden').val();

    console.log(savedCityId)
    $.ajax({
      type: "GET",
      url: 'https://servicodados.ibge.gov.br/api/v1/localidades/estados/' + uf + '/municipios',
      dataType: 'json',
      success: function (data) {
        if (!data || !Array.isArray(data)) return; // Verifica se 'data' é um array

        console.log(data);
        var select = $('#aluno_naturalidade');
        select.empty(); // Limpa as opções existentes

        select.append('<option value="">Selecione uma cidade</option>'); // Adiciona a opção padrão

        // Percorre o array de cidades retornado e adiciona cada uma ao select
        $.each(data, function (index, cidade) {
          var option = $('<option></option>').attr('value', cidade.id).text(cidade.nome);
          select.append(option);
        });

        // Seleciona a cidade salva, se existir
        if (savedCityId) {
          select.val(savedCityId);
        }
      }
    });
  }).trigger('change');

  $('#profissional_data_nascimento').on('change', function () {
    var data_nascimento = $(this).val();

    var hoje = new Date();
    var dataNasc = new Date(data_nascimento);
    var idade = hoje.getFullYear() - dataNasc.getFullYear();
    var diferencaMes = hoje.getMonth() - dataNasc.getMonth();

    if (diferencaMes < 0 || (diferencaMes === 0 && hoje.getDate() < dataNasc.getDate())) {
      idade--;
    }
    $('#profissional_idade').val(idade);

  })

  $('#ano_vinculo').on('change', function () {
    var ano = $(this).val();

    $.ajax({
      type: "GET",
      url: base_url + 'Turma/getTurmaAno',
      dataType: 'json',
      data: {
        'ano': ano
      },
      success: function (data) {

        var select = $('#turma_vinculo');
        select.empty(); // Limpa as opções existentes

        select.append('<option value="">Selecione uma turma</option>'); // Adiciona a opção padrão

        // Percorre o array de cidades retornado e adiciona cada uma ao select
        $.each(data, function (index, turma) {
          var option = $('<option></option>').attr('value', turma.ID_TURMA).text(turma.NOME_TURMA);
          select.append(option);
        });
      }
    });
  }).trigger('change');

  $('#etapa_escolar').on('change', function () {
    var etapa_escolar = $("#etapa_escolar").val();
    var aluno_id = $("#aluno_id").val();
    console.log("aluno_id")
    console.log(aluno_id)
    if (aluno_id != undefined) {
      $.ajax({
        type: "POST",
        url: base_url + 'Turma/getValidacaoMatricula',
        dataType: 'json',
        data: {
          'etapa_escolar': etapa_escolar,
          'aluno_id': aluno_id
        },
        success: function (data) {

          if (data) {
            Swal.fire({
              title: "Atenção!",
              text: "A idade do(a) aluno(a) não está de acordo com a etapa escolhida! Verifique se realmente deseja continuar.",
              icon: "warning",
              confirmButtonColor: "#415e4a",
            }).then((result) => {

            });
          }
        }
      });
    }

  });

  $('#turma').on('change', function () {
    var turma = $(this).val();
    var ano_vinculo = $("#ano_vinculo").val();
    var aluno_id = $("#aluno_id").val();

    $.ajax({
      type: "GET",
      url: base_url + 'Turma/getAlunoVinculo',
      dataType: 'json',
      data: {
        'ano': ano_vinculo,
        'turma': turma,
        'aluno_id': aluno_id
      },
      success: function (data) {

        if (data.QTD_ALUNO > 0) {
          Swal.fire({
            title: "Atenção!",
            text: "Esse aluno já possui vínculo para esse turno, conflito de horários! verifique se realmente deseja continuar!",
            icon: "warning",
            confirmButtonColor: "#415e4a",
          }).then((result) => {

          });
        }
      }
    });
  })

  $('#aluno_data_nascimento').on('change', function () {
    var data_nascimento = $(this).val();

    var hoje = new Date();
    var dataNasc = new Date(data_nascimento);
    var idade = hoje.getFullYear() - dataNasc.getFullYear();
    var diferencaMes = hoje.getMonth() - dataNasc.getMonth();

    if (diferencaMes < 0 || (diferencaMes === 0 && hoje.getDate() < dataNasc.getDate())) {
      idade--;
    }
    $('#aluno_idade').val(idade);

  })

  $(".divCursoSuperior").hide();
  var profissional_escolaridade = $('input[name="profissional_escolaridade"]:checked').val();


  if (profissional_escolaridade == "S") {
    $(".divCursoSuperior").show();
  }

  $('input[name="profissional_escolaridade"]').change(function () {
    var profissional_escolaridade = $('input[name="profissional_escolaridade"]:checked').val();
    if (profissional_escolaridade == "S") {
      $(".divCursoSuperior").show();
    } else {
      $(".divCursoSuperior").hide();
    }
  });


  $(".divHora").hide();
  var profissional_intervalo = $('input[name="profissional_intervalo"]:checked').val();


  if (profissional_intervalo == "S") {
    $(".divHora").show();
  }

  $('input[name="profissional_intervalo"]').change(function () {
    var profissional_intervalo = $('input[name="profissional_intervalo"]:checked').val();
    if (profissional_intervalo == "S") {
      $(".divHora").show();
    } else {
      $(".divHora").hide();
    }
  });

  $(".divDeficienciaProf").hide();
  var profissional_deficiência = $('input[name="profissional_deficiência"]:checked').val();


  if (profissional_deficiência == "S") {
    $(".divDeficienciaProf").show();
  }

  $('input[name="profissional_deficiência"]').change(function () {
    var profissional_deficiência = $('input[name="profissional_deficiência"]:checked').val();
    if (profissional_deficiência == "S") {
      $(".divDeficienciaProf").show();
    } else {
      $(".divDeficienciaProf").hide();
      $("#profissional_qual_deficiencia").val("");
    }
  });


  $(".divFilho").hide();
  var profissional_filhos = $('input[name="profissional_filhos"]:checked').val();


  if (profissional_filhos == "S") {
    $(".divFilho").show();
  }

  $('input[name="profissional_filhos"]').change(function () {
    var profissional_filhos = $('input[name="profissional_filhos"]:checked').val();
    if (profissional_filhos == "S") {
      $(".divFilho").show();
    } else {
      $(".divFilho").hide();
      $("#profissional_qtd_filho").val("");
    }
  });

  $(".divDoenca").hide();
  var profissional_doenca = $('input[name="profissional_doenca"]:checked').val();


  if (profissional_doenca == "S") {
    $(".divDoenca").show();
  }

  $('input[name="profissional_doenca"]').change(function () {
    var profissional_doenca = $('input[name="profissional_doenca"]:checked').val();
    if (profissional_doenca == "S") {
      $(".divDoenca").show();
    } else {
      $(".divDoenca").hide();
      $("#profissional_qual_doenca").val("");
    }
  });

  $(".divConjuge").hide();
  var profissional_estado_civil = $('input[name="profissional_estado_civil"]:selected').val();


  var profissional_estado_civil = $("#profissional_estado_civil").val();
  if (profissional_estado_civil === "CA") {
    $(".divConjuge").show();
  } else {
    $(".divConjuge").hide();
  }

  // Alteração da exibição da div ao mudar o valor do select
  $('#profissional_estado_civil').change(function () {
    var profissional_estado_civil = $(this).val();
    if (profissional_estado_civil === "CA") {
      $(".divConjuge").show();
    } else {
      $(".divConjuge").hide();
      $("#profissional_conjuge").val("");

    }
  });


  $(".divDeficiencia").hide();
  var aluno_possui_deficiencia = $('#aluno_possui_deficiencia').val();


  if (aluno_possui_deficiencia == "S") {
    $(".divDeficiencia").show();
  }

  $('#aluno_possui_deficiencia').change(function () {
    var aluno_possui_deficiencia = $('#aluno_possui_deficiencia').val();
    if (aluno_possui_deficiencia == "S") {
      $(".divDeficiencia").show();
    } else {
      $(".divDeficiencia").hide();
    }
  });


  $(".divTranstorno").hide();
  var aluno_possui_transtorno = $('#aluno_possui_transtorno').val();


  if (aluno_possui_transtorno == "S") {
    $(".divTranstorno").show();
  }

  $('#aluno_possui_transtorno').change(function () {
    var aluno_possui_transtorno = $('#aluno_possui_transtorno').val();
    if (aluno_possui_transtorno == "S") {
      $(".divTranstorno").show();
    } else {
      $(".divTranstorno").hide();
    }
  });

  $(".divIntolerancia").hide();
  var aluno_possui_intolerancia = $('#aluno_possui_intolerancia').val();


  if (aluno_possui_intolerancia == "S") {
    $(".divIntolerancia").show();
  }

  $('#aluno_possui_intolerancia').change(function () {
    var aluno_possui_intolerancia = $('#aluno_possui_intolerancia').val();
    if (aluno_possui_intolerancia == "S") {
      $(".divIntolerancia").show();
    } else {
      $(".divIntolerancia").hide();
    }
  });


  $(".divAlergia").hide();
  var aluno_possui_alergia = $('#aluno_possui_alergia').val();


  if (aluno_possui_alergia == "S") {
    $(".divAlergia").show();
  }

  $('#aluno_possui_alergia').change(function () {
    var aluno_possui_alergia = $('#aluno_possui_alergia').val();
    if (aluno_possui_alergia == "S") {
      $(".divAlergia").show();
    } else {
      $(".divAlergia").hide();
    }
  });


  $(".divMedicamento").hide();
  var aluno_possui_medicamento = $('#aluno_possui_medicamento').val();


  if (aluno_possui_medicamento == "S") {
    $(".divMedicamento").show();
  }

  $('#aluno_possui_medicamento').change(function () {
    var aluno_possui_medicamento = $('#aluno_possui_medicamento').val();
    if (aluno_possui_medicamento == "S") {
      $(".divMedicamento").show();
    } else {
      $(".divMedicamento").hide();
    }
  });

  $(".divTratamento").hide();
  var aluno_possui_tratamento = $('#aluno_possui_tratamento').val();


  if (aluno_possui_tratamento == "S") {
    $(".divTratamento").show();
  }

  $('#aluno_possui_tratamento').change(function () {
    var aluno_possui_tratamento = $('#aluno_possui_tratamento').val();
    if (aluno_possui_tratamento == "S") {
      $(".divTratamento").show();
    } else {
      $(".divTratamento").hide();
    }
  });

  $(".divDoencas").hide();
  var aluno_possui_doencas_cronicas = $('#aluno_possui_doencas_cronicas').val();


  if (aluno_possui_doencas_cronicas == "S") {
    $(".divDoencas").show();
  }

  $('#aluno_possui_doencas_cronicas').change(function () {
    var aluno_possui_doencas_cronicas = $('#aluno_possui_doencas_cronicas').val();
    if (aluno_possui_doencas_cronicas == "S") {
      $(".divDoencas").show();
    } else {
      $(".divDoencas").hide();
    }
  });
  /* 
  
    var aluno_filiacao_1 = $('#aluno_filiacao_1').val();
    var aluno_filiacao_2 = $('#aluno_filiacao_2').val();
  
    if (aluno_filiacao_1 == "" || aluno_filiacao_2 == "") {
      $(".divResponsaveis").show();
    } else {
      $(".divResponsaveis").hide();
    }
  
    $('#aluno_filiacao_1').change(function () {
      var aluno_filiacao_1 = $('#aluno_filiacao_1').val();
      if (aluno_filiacao_1 != "") {
        $(".divResponsaveis").hide();
      } else {
        $(".divResponsaveis").show();
      }
    });
  
    $('#aluno_filiacao_2').change(function () {
      var aluno_filiacao_2 = $('#aluno_filiacao_2').val();
      if (aluno_filiacao_2 != "") {
        $(".divResponsaveis").hide();
      } else {
        $(".divResponsaveis").show();
      }
    }); */

  $('.divResponsaveis').hide();
  $('#aluno_responsavel_legal').on('change', function () {
    if ($(this).val() == "O") {
      $('.divResponsaveis').show();
    } else {
      $('.divResponsaveis').hide();
    }
  })

  if ($('#aluno_responsavel_legal').val() == "O") {
    $('.divResponsaveis').show();
  }


  var username = $('#username').val();
  var profisisonal_escola_id = $('#profisisonal_escola_id').val();
  $.ajax({
    type: "POST",
    url: '/Login/getEscolas',
    data: {
      'usuario': username
    },
    dataType: 'json',
    success: function (data) {
      var select = $('#profissional_fazenda');
      select.empty(); // Limpa as opções existentes

      select.append('<option value="">Selecione uma fazenda</option>'); // Adiciona a opção padrão

      // Percorre o array de escolas retornado e adiciona cada uma ao select
      $.each(data, function (index, escola) {
        select.append($('<option></option>').attr('value', escola.ID_ESCOLA).text(escola.ESCOLA));
      });

      if (profisisonal_escola_id) {
        select.val(profisisonal_escola_id);
      }
    }
  });

  //JS do App

  // Evento de clique no botão Salvar
  $('.btn.btn-danger.mb-5').on('click', function () {
    // Capturando data, hora e descrição
    // Capturando data
    var data = $('input[type="date"]').val();

    if (!data) {
      $('#modal-danger .modal-body p').text('Por favor, preencha a data antes de salvar.');
      $('#modal-danger').modal('show');
      return; // Interrompe o processo de salvamento
    }
    var hora = $('input[name="profissional_horario_saida"]').val();
    var profissional_codigo = $('input[name="profissional_codigo"]').val();
    if ($("#dia_nao_letivo").is(":checked")) {
      var dia_nao_letivo = "S";
    } else {
      var dia_nao_letivo = "N";
    }
    console.log("dia_nao_letivo")
    console.log(dia_nao_letivo)
    var descricao = $('#textarea').val();
    var observacoes = $('#observacoes').val();
    var turma = $('#turma').val();
    var tipo = $('#tipo').val();
    var id_ocorrencia = $('#id_ocorrencia').val();
    var id_chamada = $('#id_chamada').val();

    // Capturando os alunos e suas justificativas
    var alunos = [];
    var temFaltaSemJustificativa = false;

    $('input[type="checkbox"]').each(function () {
      var alunoId = $(this).attr('id').split('-')[1];
      if (alunoId !== undefined && dia_nao_letivo != "S") {
        var status = $(this).is(':checked') ? "S" : "N";
        var justificativa = $(this).closest('.form-group').data('justificativa') || "";

        // Verifica se o aluno tem status "N" e não possui justificativa
        if (status === "N" && justificativa === "") {
          temFaltaSemJustificativa = true;
        }

        alunos.push({ id: alunoId, status: status, justificativa: justificativa });
      }
    });

    if (temFaltaSemJustificativa && tipo != "O") {
      Swal.fire({
        title: "Atenção?",
        text: "Existem alunos que não possuem justificativa preenchida, deseja continuar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, pode salvar!"
      }).then((result) => {
        if (result.isConfirmed) {
          if (tipo == "O") {
            $.ajax({
              type: "POST",
              url: '/Aplicativo/OcorrenciaInserir',
              data: {
                data: data,
                hora: hora,
                descricao: descricao,
                alunos: alunos,
                turma: turma,
                id_ocorrencia: id_ocorrencia
              },
              dataType: 'json',
              success: function (data) {
                if (data.msg == "success") {

                  Swal.fire({
                    title: "Sucesso!",
                    text: "Ocorrência salva!",
                    icon: "success",
                    confirmButtonColor: "#415e4a",
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                      window.location.href = '/Aplicativo/ListaOcorrencia/' + turma; // Substitua pela URL de destino
                    } else if (result.isDenied) {
                      window.location.href = '/Aplicativo/ListaOcorrencia/' + turma; // Substitua pela URL de destino
                    }
                  });
                }
              }
            });
          } else {
            $.ajax({
              type: "POST",
              url: '/Aplicativo/ChamadaInserir',
              data: {
                data: data,
                hora: hora,
                profissional_codigo: profissional_codigo,
                descricao: descricao,
                alunos: alunos,
                turma: turma,
                id_chamada: id_chamada,
                observacoes: observacoes,
                dia_nao_letivo: dia_nao_letivo
              },
              dataType: 'json',
              success: function (data) {
                if (data.msg == "error_data") {
                  Swal.fire({
                    title: "Erro!",
                    text: "Ja existe chamada pra essa data!",
                    icon: "error",
                    confirmButtonColor: "#415e4a",
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                    } else if (result.isDenied) {
                    }
                  });
                } else if (data.msg == "success") {
                  Swal.fire({
                    title: "Sucesso!",
                    text: "Chamada salva!",
                    icon: "success",
                    confirmButtonColor: "#415e4a",
                  }).then((result) => {
                    /* Read more about isConfirmed, isDenied below */
                    if (result.isConfirmed) {
                      window.location.href = '/Aplicativo/Chamada'; // Substitua pela URL de destino
                    } else if (result.isDenied) {
                      window.location.href = '/Aplicativo/Chamada'; // Substitua pela URL de destino
                    }
                  });
                }
              }
            });
          }
        } else {
          //swal("Cancelado", "Operação cancelada! Dados não gravados", "error");
        }
      });
    } else {
      if (tipo == "O") {
        $.ajax({
          type: "POST",
          url: '/Aplicativo/OcorrenciaInserir',
          data: {
            data: data,
            hora: hora,
            descricao: descricao,
            alunos: alunos,
            turma: turma,
            id_ocorrencia: id_ocorrencia
          },
          dataType: 'json',
          success: function (data) {
            if (data.msg == "success") {

              Swal.fire({
                title: "Sucesso!",
                text: "Ocorrência salva!",
                icon: "success",
                confirmButtonColor: "#415e4a",
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  window.location.href = '/Aplicativo/ListaOcorrencia/' + turma; // Substitua pela URL de destino
                } else if (result.isDenied) {
                  window.location.href = '/Aplicativo/ListaOcorrencia/' + turma; // Substitua pela URL de destino
                }
              });
            }
          }
        });
      } else {
        $.ajax({
          type: "POST",
          url: '/Aplicativo/ChamadaInserir',
          data: {
            data: data,
            hora: hora,
            profissional_codigo: profissional_codigo,
            descricao: descricao,
            alunos: alunos,
            turma: turma,
            id_chamada: id_chamada,
            observacoes: observacoes,
            dia_nao_letivo: dia_nao_letivo
          },
          dataType: 'json',
          success: function (data) {
            if (data.msg == "error_data") {
              Swal.fire({
                title: "Erro!",
                text: "Ja existe chamada pra essa data!",
                icon: "error",
                confirmButtonColor: "#415e4a",
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                } else if (result.isDenied) {
                }
              });
            } else if (data.msg == "success") {
              Swal.fire({
                title: "Sucesso!",
                text: "Chamada salva!",
                icon: "success",
                confirmButtonColor: "#415e4a",
              }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                  window.location.href = '/Aplicativo/Chamada'; // Substitua pela URL de destino
                } else if (result.isDenied) {
                  window.location.href = '/Aplicativo/Chamada'; // Substitua pela URL de destino
                }
              });
            }
          }
        });
      }
    }






  });

  var situacao = $("#situacao").val()

  if (situacao != undefined && situacao != "CU") {
    Swal.fire({
      title: "Atenção!",
      text: "Esse aluno não está mais cursando, certifique-se de que realmente deseja continuar!",
      icon: "warning",
      confirmButtonColor: "#415e4a",
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
      } else if (result.isDenied) {
      }
    });
  }


  $('#pesquisar').on('click', function () {
    var data_filtro = $("#data_filtro").val();
    var turma = $('#turma').val();

    window.location.href = '/Aplicativo/ListaChamada/' + turma + '/' + data_filtro;

    /* $.ajax({
      type: "POST",
      url: '/Aplicativo/ChamadaInserir/'+turma,
      data: {
        data_filtro: data_filtro,
        turma: turma
      },
      dataType: 'json',
      success: function (data) {
        if(data.msg == "success"){
          $('#modal-success .modal-body p').text('Chamada salva!');
          $('#modal-success').modal('show');
        }
      }
    }); */
  })





  // Evento de clique no botão Salvar
  $('#gravar_acompanhamento').on('click', function () {

    var data_acompanhamento = $("#data_acompanhamento").val();
    var turma = $("#turma").val();
    var semestre = $("#semestre").val();
    var aluno = $("#aluno").val();
    var eu_outros = $("#eu_outros").val();
    var corpo_gestos = $("#corpo_gestos").val();
    var tracos_sons = $("#tracos_sons").val();
    var escuta_fala = $("#escuta_fala").val();
    var espaco_tempos = $("#espaco_tempos").val();
    var estrategias = $("#estrategias").val();
    var recomendacoes = $("#recomendacoes").val();
    var acompanhamento_id = $("#acompanhamento_id").val();



    $.ajax({
      type: "POST",
      url: '/Aplicativo/AcompanhamentoInserir',
      data: {
        data_acompanhamento: data_acompanhamento,
        turma: turma,
        semestre: semestre,
        aluno: aluno,
        eu_outros: eu_outros,
        corpo_gestos: corpo_gestos,
        tracos_sons: tracos_sons,
        escuta_fala: escuta_fala,
        espaco_tempos: espaco_tempos,
        estrategias: estrategias,
        recomendacoes: recomendacoes,
        acompanhamento_id: acompanhamento_id
      },
      dataType: 'json',
      success: function (data) {
        if (data.msg == "success") {
          Swal.fire({
            title: "Sucesso!",
            text: "Acompanhamento salvo!",
            icon: "success",
            confirmButtonColor: "#415e4a",
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              window.location.href = '/Aplicativo/AcompanhamentoNovo/' + turma; // Substitua pela URL de destino
            } else if (result.isDenied) {
              window.location.href = '/Aplicativo/AcompanhamentoNovo/' + turma; // Substitua pela URL de destino
            }
          });
        }
      }
    });
  });



  $('#gravar_registro').on('click', function () {

    var data_acompanhamento = $("#data_acompanhamento").val();
    var turma = $("#turma").val();
    var semestre = $("#semestre").val();
    var aluno = $("#aluno").val();
    var descricao = $("#descricao").val();



    $.ajax({
      type: "POST",
      url: '/Aplicativo/RegistroInserir',
      data: {
        data_acompanhamento: data_acompanhamento,
        turma: turma,
        semestre: semestre,
        aluno: aluno,
        descricao: descricao
      },
      dataType: 'json',
      success: function (data) {
        if (data.msg == "success") {
          Swal.fire({
            title: "Sucesso!",
            text: "Diagnóstico da sala salvo!",
            icon: "success",
            confirmButtonColor: "#415e4a",
          }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
              window.location.href = '/Aplicativo/RegistroNovo/' + turma; // Substitua pela URL de destino
            } else if (result.isDenied) {
              window.location.href = '/Aplicativo/RegistroNovo/' + turma; // Substitua pela URL de destino
            }
          });
        }
      }
    });
  });

  $('#gravar_ficha').on('click', function () {

    var data_acompanhamento = $("#data_acompanhamento").val();
    var turma = $("#turma").val();
    var bimestre = $("#bimestre").val();
    var aluno = $("#aluno").val();
    var aspectosautonomia_id = $("#aspectosautonomia_id").val();
    var aspectoscognitivos_id = $("#aspectoscognitivos_id").val();
    var aspectosfisicos_id = $("#aspectosfisicos_id").val();
    var aspectosmotorafina_id = $("#aspectosmotorafina_id").val();
    var aspectosrelacaofamiliaescola_id = $("#aspectosrelacaofamiliaescola_id").val();
    var aspectossociaiseemocionais_id = $("#aspectossociaiseemocionais_id").val();

    // Capturar valores dos radio buttons
    var lateralidade = $('input[name="lateralidade"]:checked').val();
    var nocao_espaco = $('input[name="nocao_espaco"]:checked').val();
    var equilibrio_agilidade = $('input[name="equilibrio_agilidade"]:checked').val();
    var pula_um_pe = $('input[name="pula_um_pe"]:checked').val();
    var pula_dois_pes = $('input[name="pula_dois_pes"]:checked').val();
    var corre_linha_reta = $('input[name="corre_linha_reta"]:checked').val();
    var perpassa_obstaculos = $('input[name="perpassa_obstaculos"]:checked').val();
    var anda_ponta_pes = $('input[name="anda_ponta_pes"]:checked').val();

    // Capturar valores dos campos de coordenação
    var pega_lapis = $('input[name="pega_lapis"]:checked').val();
    var utiliza_lapis = $('input[name="utiliza_lapis"]:checked').val();
    var escreve_espelhada = $('input[name="escreve_espelhada"]:checked').val();
    var recorta_maos = $('input[name="recorta_maos"]:checked').val();
    var recorta_tesoura = $('input[name="recorta_tesoura"]:checked').val();
    var pinta_espacos = $('input[name="pinta_espacos"]:checked').val();
    var amassa = $('input[name="amassa"]:checked').val();
    var desenha = $('input[name="desenha"]:checked').val();
    var alinhava = $('input[name="alinhava"]:checked').val();
    var abre_embalagens = $('input[name="abre_embalagens"]:checked').val();
    var enrosca = $('input[name="enrosca"]:checked').val();
    var monta_desmonta = $('input[name="monta_desmonta"]:checked').val();

    // Capturar valores dos campos emocionais
    var atencao = $('input[name="atencao"]:checked').val();
    var interage_colegas = $('input[name="interage_colegas"]:checked').val();
    var compreende_regras = $('input[name="compreende_regras"]:checked').val();
    var aceita_ajuda = $('input[name="aceita_ajuda"]:checked').val();
    var divide_compartilha = $('input[name="divide_compartilha"]:checked').val();
    var participa_grupo = $('input[name="participa_grupo"]:checked').val();
    var expor_cotidiano = $('input[name="expor_cotidiano"]:checked').val();
    var brinca_isolado = $('input[name="brinca_isolado"]:checked').val();
    var brinca_colegas = $('input[name="brinca_colegas"]:checked').val();
    var contato_fisico = $('input[name="contato_fisico"]:checked').val();
    var se_isola = $('input[name="se_isola"]:checked').val();
    var se_zanga = $('input[name="se_zanga"]:checked').val();
    var alteracoes_humor = $('input[name="alteracoes_humor"]:checked').val();
    var contato_visual = $('input[name="contato_visual"]:checked').val();
    var se_reconhece_fotos = $('input[name="se_reconhece_fotos"]:checked').val();
    var reconhece_pessoas_fotos = $('input[name="reconhece_pessoas_fotos"]:checked').val();
    var reconhece_componentes_familiares = $('input[name="reconhece_componentes_familiares"]:checked').val();

    // Capturar valores dos campos de autonomia
    var utiliza_fralda = $('input[name="utiliza_fralda"]:checked').val();
    var se_limpa_sozinho = $('input[name="se_limpa_sozinho"]:checked').val();
    var escova_dentes_sozinho = $('input[name="escova_dentes_sozinho"]:checked').val();
    var guarda_pertences_sozinho = $('input[name="guarda_pertences_sozinho"]:checked').val();
    var amarra_cadarcos = $('input[name="amarra_cadarcos"]:checked').val();
    var abre_mochila = $('input[name="abre_mochila"]:checked').val();
    var independente_atividades = $('input[name="independente_atividades"]:checked').val();

    // Capturar valores dos campos cognitivos
    var reconhece_cores = $('input[name="reconhece_cores"]:checked').val();
    var reconhece_numeros = $('input[name="reconhece_numeros"]:checked').val();
    var reconhece_letras = $('input[name="reconhece_letras"]:checked').val();
    var diferencia_letras_numeros = $('input[name="diferencia_letras_numeros"]:checked').val();
    var identifica_letras_nome = $('input[name="identifica_letras_nome"]:checked').val();
    var escreve_nome_sem_auxilio = $('input[name="escreve_nome_sem_auxilio"]:checked').val();
    var realiza_pareamento = $('input[name="realiza_pareamento"]:checked').val();
    var mantem_atencao = $('input[name="mantem_atencao"]:checked').val();
    var reconhece_silabas = $('input[name="reconhece_silabas"]:checked').val();
    var identifica_partes_corpo = $('input[name="identifica_partes_corpo"]:checked').val();
    var nomeia_pessoas_familiares = $('input[name="nomeia_pessoas_familiares"]:checked').val();
    var apresenta_sequencia_fatos = $('input[name="apresenta_sequencia_fatos"]:checked').val();
    var relaciona_numeros_quantidades = $('input[name="relaciona_numeros_quantidades"]:checked').val();
    var comunica_clareza = $('input[name="comunica_clareza"]:checked').val();
    var observa_seme_dife = $('input[name="observa_seme_dife"]:checked').val();
    var compreende_idade = $('input[name="compreende_idade"]:checked').val();

    // Capturar valores dos campos familiares
    var participa_reunioes = $('input[name="participa_reunioes"]:checked').val();
    var uniforme_limpo = $('input[name="uniforme_limpo"]:checked').val();
    var banho_diario = $('input[name="banho_diario"]:checked').val();
    var higieniza_pertences = $('input[name="higieniza_pertences"]:checked').val();
    var cuida_materiais = $('input[name="cuida_materiais"]:checked').val();
    var aluno_assiduo = $('input[name="aluno_assiduo"]:checked').val();
    var pontualidade_horarios = $('input[name="pontualidade_horarios"]:checked').val();


    if (lateralidade != undefined && lateralidade != "" &&
      nocao_espaco != undefined && nocao_espaco != "" &&
      equilibrio_agilidade != undefined && equilibrio_agilidade != "" &&
      pula_um_pe != undefined && pula_um_pe != "" &&
      pula_dois_pes != undefined && pula_dois_pes != "" &&
      corre_linha_reta != undefined && corre_linha_reta != "" &&
      perpassa_obstaculos != undefined && perpassa_obstaculos != "" &&
      anda_ponta_pes != undefined && anda_ponta_pes != "" &&
      pega_lapis != undefined && pega_lapis != "" &&
      utiliza_lapis != undefined && utiliza_lapis != "" &&
      escreve_espelhada != undefined && escreve_espelhada != "" &&
      recorta_maos != undefined && recorta_maos != "" &&
      recorta_tesoura != undefined && recorta_tesoura != "" &&
      pinta_espacos != undefined && pinta_espacos != "" &&
      amassa != undefined && amassa != "" &&
      desenha != undefined && desenha != "" &&
      alinhava != undefined && alinhava != "" &&
      abre_embalagens != undefined && abre_embalagens != "" &&
      enrosca != undefined && enrosca != "" &&
      monta_desmonta != undefined && monta_desmonta != "" &&
      atencao != undefined && atencao != "" &&
      interage_colegas != undefined && interage_colegas != "" &&
      compreende_regras != undefined && compreende_regras != "" &&
      aceita_ajuda != undefined && aceita_ajuda != "" &&
      divide_compartilha != undefined && divide_compartilha != "" &&
      participa_grupo != undefined && participa_grupo != "" &&
      expor_cotidiano != undefined && expor_cotidiano != "" &&
      brinca_isolado != undefined && brinca_isolado != "" &&
      brinca_colegas != undefined && brinca_colegas != "" &&
      contato_fisico != undefined && contato_fisico != "" &&
      se_isola != undefined && se_isola != "" &&
      se_zanga != undefined && se_zanga != "" &&
      alteracoes_humor != undefined && alteracoes_humor != "" &&
      contato_visual != undefined && contato_visual != "" &&
      se_reconhece_fotos != undefined && se_reconhece_fotos != "" &&
      reconhece_pessoas_fotos != undefined && reconhece_pessoas_fotos != "" &&
      reconhece_componentes_familiares != undefined && reconhece_componentes_familiares != "" &&
      utiliza_fralda != undefined && utiliza_fralda != "" &&
      se_limpa_sozinho != undefined && se_limpa_sozinho != "" &&
      escova_dentes_sozinho != undefined && escova_dentes_sozinho != "" &&
      guarda_pertences_sozinho != undefined && guarda_pertences_sozinho != "" &&
      amarra_cadarcos != undefined && amarra_cadarcos != "" &&
      abre_mochila != undefined && abre_mochila != "" &&
      independente_atividades != undefined && independente_atividades != "" &&
      reconhece_cores != undefined && reconhece_cores != "" &&
      reconhece_numeros != undefined && reconhece_numeros != "" &&
      reconhece_letras != undefined && reconhece_letras != "" &&
      diferencia_letras_numeros != undefined && diferencia_letras_numeros != "" &&
      identifica_letras_nome != undefined && identifica_letras_nome != "" &&
      escreve_nome_sem_auxilio != undefined && escreve_nome_sem_auxilio != "" &&
      realiza_pareamento != undefined && realiza_pareamento != "" &&
      mantem_atencao != undefined && mantem_atencao != "" &&
      reconhece_silabas != undefined && reconhece_silabas != "" &&
      identifica_partes_corpo != undefined && identifica_partes_corpo != "" &&
      nomeia_pessoas_familiares != undefined && nomeia_pessoas_familiares != "" &&
      apresenta_sequencia_fatos != undefined && apresenta_sequencia_fatos != "" &&
      relaciona_numeros_quantidades != undefined && relaciona_numeros_quantidades != "" &&
      comunica_clareza != undefined && comunica_clareza != "" &&
      observa_seme_dife != undefined && observa_seme_dife != "" &&
      compreende_idade != undefined && compreende_idade != "" &&
      participa_reunioes != undefined && participa_reunioes != "" &&
      uniforme_limpo != undefined && uniforme_limpo != "" &&
      banho_diario != undefined && banho_diario != "" &&
      higieniza_pertences != undefined && higieniza_pertences != "" &&
      cuida_materiais != undefined && cuida_materiais != "" &&
      aluno_assiduo != undefined && aluno_assiduo != "" &&
      pontualidade_horarios != undefined && pontualidade_horarios != "") {
      // Enviar via AJAX
      $.ajax({
        type: "POST",
        url: '/Aplicativo/FichaAlunoInserir',
        data: {
          data_acompanhamento: data_acompanhamento,
          turma: turma,
          bimestre: bimestre,
          aluno: aluno,
          lateralidade: lateralidade,
          nocao_espaco: nocao_espaco,
          equilibrio_agilidade: equilibrio_agilidade,
          pula_um_pe: pula_um_pe,
          pula_dois_pes: pula_dois_pes,
          corre_linha_reta: corre_linha_reta,
          perpassa_obstaculos: perpassa_obstaculos,
          anda_ponta_pes: anda_ponta_pes,
          pega_lapis: pega_lapis,
          utiliza_lapis: utiliza_lapis,
          escreve_espelhada: escreve_espelhada,
          recorta_maos: recorta_maos,
          recorta_tesoura: recorta_tesoura,
          pinta_espacos: pinta_espacos,
          amassa: amassa,
          desenha: desenha,
          alinhava: alinhava,
          abre_embalagens: abre_embalagens,
          enrosca: enrosca,
          monta_desmonta: monta_desmonta,
          atencao: atencao,
          interage_colegas: interage_colegas,
          compreende_regras: compreende_regras,
          aceita_ajuda: aceita_ajuda,
          divide_compartilha: divide_compartilha,
          participa_grupo: participa_grupo,
          expor_cotidiano: expor_cotidiano,
          brinca_isolado: brinca_isolado,
          brinca_colegas: brinca_colegas,
          contato_fisico: contato_fisico,
          se_isola: se_isola,
          se_zanga: se_zanga,
          alteracoes_humor: alteracoes_humor,
          contato_visual: contato_visual,
          se_reconhece_fotos: se_reconhece_fotos,
          reconhece_pessoas_fotos: reconhece_pessoas_fotos,
          reconhece_componentes_familiares: reconhece_componentes_familiares,
          utiliza_fralda: utiliza_fralda,
          se_limpa_sozinho: se_limpa_sozinho,
          escova_dentes_sozinho: escova_dentes_sozinho,
          guarda_pertences_sozinho: guarda_pertences_sozinho,
          amarra_cadarcos: amarra_cadarcos,
          abre_mochila: abre_mochila,
          independente_atividades: independente_atividades,
          reconhece_cores: reconhece_cores,
          reconhece_numeros: reconhece_numeros,
          reconhece_letras: reconhece_letras,
          diferencia_letras_numeros: diferencia_letras_numeros,
          identifica_letras_nome: identifica_letras_nome,
          escreve_nome_sem_auxilio: escreve_nome_sem_auxilio,
          realiza_pareamento: realiza_pareamento,
          mantem_atencao: mantem_atencao,
          reconhece_silabas: reconhece_silabas,
          identifica_partes_corpo: identifica_partes_corpo,
          nomeia_pessoas_familiares: nomeia_pessoas_familiares,
          apresenta_sequencia_fatos: apresenta_sequencia_fatos,
          relaciona_numeros_quantidades: relaciona_numeros_quantidades,
          comunica_clareza: comunica_clareza,
          observa_seme_dife: observa_seme_dife,
          compreende_idade: compreende_idade,
          participa_reunioes: participa_reunioes,
          uniforme_limpo: uniforme_limpo,
          banho_diario: banho_diario,
          higieniza_pertences: higieniza_pertences,
          cuida_materiais: cuida_materiais,
          aluno_assiduo: aluno_assiduo,
          pontualidade_horarios: pontualidade_horarios,
          aspectosautonomia_id: aspectosautonomia_id,
          aspectoscognitivos_id: aspectoscognitivos_id,
          aspectosfisicos_id: aspectosfisicos_id,
          aspectosmotorafina_id: aspectosmotorafina_id,
          aspectosrelacaofamiliaescola_id: aspectosrelacaofamiliaescola_id,
          aspectossociaiseemocionais_id: aspectossociaiseemocionais_id
        },
        success: function (data) {
          console.log(data.msg)
          if (data.msg != "") {
            Swal.fire({
              title: "Sucesso!",
              text: "Ficha de Aluno salvo!",
              icon: "success",
              confirmButtonColor: "#415e4a",
            }).then((result) => {
              /* Read more about isConfirmed, isDenied below */
              if (result.isConfirmed) {
                window.location.href = '/Aplicativo/FichaAlunoNovo/' + turma; // Substitua pela URL de destino
              } else if (result.isDenied) {
                window.location.href = '/Aplicativo/FichaAlunoNovo/' + turma; // Substitua pela URL de destino
              }
            });
          }
        }
      });
    } else {
      Swal.fire({
        title: "Erro!",
        text: "Existem campos não preenchidos",
        icon: "error",
        confirmButtonColor: "#415e4a",
      }).then((result) => {

      });
    }
  });

  $('#modal-success').on('hidden.bs.modal', function () {
    var tipo = $('#tipo').val();
    var turma = $('#turma').val();
    if (tipo == "O") {
      window.location.href = '/Aplicativo/ListaOcorrencia/' + turma; // Substitua pela URL de destino
    } else if (tipo == "A") {
      window.location.href = '/Aplicativo/AcompanhamentoNovo/' + turma; // Substitua pela URL de destino
    } else {
      window.location.href = '/Aplicativo/Chamada'; // Substitua pela URL de destino
    }
  });


  // Pegar o valor do input hidden
  var alunosJustificativas = $('#alunos_justificativas').val();


  if (alunosJustificativas != undefined) {

    // Converter o valor para um objeto JSON
    var alunosJustificativasArray = JSON.parse(alunosJustificativas);

    // Percorrer o array e exibir informações
    alunosJustificativasArray.forEach(function (aluno) {
      // Faça o que precisar com os dados
      $('#checkbox_1-' + aluno.id_aluno).closest('.form-group').data('justificativa', aluno.justificativa);
    });
  }


  $('#gerar_grafico').on('click', function () {

    var aspectos = $("#aspectos").val();
    var turma = $("#turma").val();
    var bimestre = $("#bimestre").val();

    if (aspectos == 1) {
      criarGraificoAspectoFisico(turma, bimestre);
    } else if (aspectos == 2) {
      criarGraficoCoordenacaoMotoraFina(turma, bimestre);
    } else if (aspectos == 3) {
      criarGraficoSociaisEmocionais(turma, bimestre);
    } else if (aspectos == 4) {
      criarGraficoAutonomia(turma, bimestre);
    } else if (aspectos == 5) {
      criarGraficoCognitivos(turma, bimestre);
    } else if (aspectos == 6) {
      criarGraficoRelacaoFamiliaEscola(turma, bimestre);
    }


  });

  function criarGraificoAspectoFisico(turma, bimestre) {
    // Lógica para gerar gráfico de Aspectos Físicos

    // Array para armazenar os dados de cada coluna
    let chartData = [];

    // Colunas com descrições associadas
    let colunas = [
      { key: 'LATERALIDADE', label: 'Lateralidade (diferencia esquerda e direita)' },
      { key: 'NOCAO_ESPACO', label: 'Noção de espaço' },
      { key: 'EQUILIBRIO_AGILIDADE', label: 'Equilíbrio e agilidade ao se locomover' },
      { key: 'PULA_UM_PE', label: 'Pula com um pé só' },
      { key: 'PULA_DOIS_PES', label: 'Pula com os dois pés' },
      { key: 'CORRE_LINHA_RETA', label: 'Corre em linha reta' },
      { key: 'PERPASSA_OBSTACULOS', label: 'Perpassa obstáculos' },
      { key: 'ANDA_PONTA_PES', label: 'Anda na ponta dos pés' }
    ];

    // Função para buscar os dados de cada coluna e criar o JSON
    colunas.forEach(function (coluna) {
      $.ajax({
        type: "POST",
        url: '/Turma/getHabilidades',
        data: {
          coluna: coluna.key,
          tabela: "CAD_ALUNO_ASPECTOS_FISICOS",
          bimestre: bimestre
        },
        dataType: 'json',
        success: function (data) {
          // Montar o chartEntry com os dados que você recebeu
          let chartEntry = {
            category: coluna.label,  // Usar a descrição correspondente à coluna
            sim: parseInt(data.qtd_sim.QTD), // Acessa 'QTD' dentro de 'qtd_sim'
            nao: parseInt(data.qtd_nao.QTD), // Acessa 'QTD' dentro de 'qtd_nao'
            parcialmente: parseInt(data.qtd_parcialmente.QTD), // Acessa 'QTD' dentro de 'qtd_parcialmente'
            naoSeAplica: parseInt(data.nao_aplica.QTD) // Acessa 'QTD' dentro de 'nao_aplica'
          };

          // Adiciona a entrada ao array chartData
          chartData.push(chartEntry);

          // Quando todas as colunas forem processadas
          if (chartData.length === colunas.length) {
            // Dividir os dados em 4 partes (cada uma com 4 colunas)
            let chunkedData = [];
            let chunkSize = 4;

            for (let i = 0; i < chartData.length; i += chunkSize) {
              chunkedData.push(chartData.slice(i, i + chunkSize));
            }

            // Criar gráficos para cada parte em divs separadas
            chunkedData.forEach((chunk, index) => {
              createChart(chunk, index + 1); // Passar o índice + 1 para criar divs como chartdiv1, chartdiv2, etc.
            });
          }
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });
    });
  }

  // Função para criar gráficos em cada div
  function createChart(data, chartIndex) {
    am4core.ready(function () {
      // Themes begin
      am4core.useTheme(am4themes_animated);
      // Themes end

      // Criar o gráfico
      var chart = am4core.create(`chartdiv${chartIndex}`, am4charts.XYChart);
      chart.colors.step = 2;

      chart.legend = new am4charts.Legend();
      chart.legend.position = 'top';
      chart.legend.paddingBottom = 20;
      chart.legend.labels.template.maxWidth = 95;

      // Ajustar o espaçamento vertical entre as legendas
      chart.legend.itemContainers.template.paddingBottom = 10; // Aumentar o espaçamento entre as legendas
      chart.legend.itemContainers.template.paddingTop = 10;

      var xAxis = chart.xAxes.push(new am4charts.CategoryAxis());
      xAxis.dataFields.category = 'category';
      xAxis.renderer.cellStartLocation = 0.1;
      xAxis.renderer.cellEndLocation = 0.9;
      xAxis.renderer.grid.template.location = 0;
      xAxis.renderer.labels.template.fontSize = 9; // Ajuste o valor para o tamanho de fonte desejado


      var yAxis = chart.yAxes.push(new am4charts.ValueAxis());
      yAxis.min = 0;

      function createSeries(value, name) {
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = value;
        series.dataFields.categoryX = 'category';
        series.name = name;

        series.events.on("hidden", arrangeColumns);
        series.events.on("shown", arrangeColumns);

        var bullet = series.bullets.push(new am4charts.LabelBullet());
        bullet.interactionsEnabled = false;
        bullet.dy = 30;
        bullet.label.text = '{valueY}';
        bullet.label.fill = am4core.color('#ffffff');

        return series;
      }

      // Definir os dados para o gráfico
      chart.data = data;

      createSeries('sim', 'Sim');
      createSeries('nao', 'Não');
      createSeries('parcialmente', 'Parcialmente');
      createSeries('naoSeAplica', 'Não se Aplica');

      function arrangeColumns() {
        var series = chart.series.getIndex(0);

        var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
        if (series.dataItems.length > 1) {
          var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
          var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");
          var delta = ((x1 - x0) / chart.series.length) * w;
          if (am4core.isNumber(delta)) {
            var middle = chart.series.length / 2;

            var newIndex = 0;
            chart.series.each(function (series) {
              if (!series.isHidden && !series.isHiding) {
                series.dummyData = newIndex;
                newIndex++;
              } else {
                series.dummyData = chart.series.indexOf(series);
              }
            });
            var visibleCount = newIndex;
            var newMiddle = visibleCount / 2;

            chart.series.each(function (series) {
              var trueIndex = chart.series.indexOf(series);
              var newIndex = series.dummyData;

              var dx = (newIndex - trueIndex + middle - newMiddle) * delta;

              series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
              series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
            });
          }
        }
      }
    }); // end am4core.ready()
  }


  function criarGraficoCoordenacaoMotoraFina(turma, bimestre) {
    // Lógica para gerar gráfico de Aspectos Físicos

    // Array para armazenar os dados de cada coluna
    let chartData = [];

    // Colunas com descrições associadas
    const colunas = [
      { key: 'PEGA_CORRETAMENTE_LAPIS', label: 'Pega corretamente o lápis.' },
      { key: 'UTILIZA_LAPIS_FACILIDADE', label: 'Utiliza o lápis com facilidade.' },
      { key: 'ESCREVE_FORMA_ESPELHADA', label: 'Escreve de forma espelhada.' },
      { key: 'RECORTA_COM_MAOS', label: 'Recorta com as mãos.' },
      { key: 'RECORTA_COM_TESOURA', label: 'Recorta com tesoura.' },
      { key: 'PINTA_DENTRO_ESPACOS', label: 'Pinta dentro dos espaços.' },
      { key: 'AMASSA', label: 'Amassa.' },
      { key: 'DESENHA', label: 'Desenha.' },
      { key: 'ALINHAVA', label: 'Alinhava.' },
      { key: 'ABRE_EMBALAGENS', label: 'Abre embalagens de objetos.' },
      { key: 'ENROSCA', label: 'Enrosca.' },
      { key: 'MONTA_DESMONTA', label: 'Monta e desmonta.' }
    ];


    // Função para buscar os dados de cada coluna e criar o JSON
    colunas.forEach(function (coluna) {
      $.ajax({
        type: "POST",
        url: '/Turma/getHabilidades',
        data: {
          coluna: coluna.key,
          tabela: "CAD_ALUNO_ASPECTOS_MOTORA_FINA",
          bimestre: bimestre
        },
        dataType: 'json',
        success: function (data) {
          // Montar o chartEntry com os dados que você recebeu
          let chartEntry = {
            category: coluna.label,  // Usar a descrição correspondente à coluna
            sim: parseInt(data.qtd_sim.QTD), // Acessa 'QTD' dentro de 'qtd_sim'
            nao: parseInt(data.qtd_nao.QTD), // Acessa 'QTD' dentro de 'qtd_nao'
            parcialmente: parseInt(data.qtd_parcialmente.QTD), // Acessa 'QTD' dentro de 'qtd_parcialmente'
            naoSeAplica: parseInt(data.nao_aplica.QTD) // Acessa 'QTD' dentro de 'nao_aplica'
          };

          // Adiciona a entrada ao array chartData
          chartData.push(chartEntry);

          // Quando todas as colunas forem processadas
          if (chartData.length === colunas.length) {
            // Dividir os dados em 4 partes (cada uma com 4 colunas)
            let chunkedData = [];
            let chunkSize = 4;

            for (let i = 0; i < chartData.length; i += chunkSize) {
              chunkedData.push(chartData.slice(i, i + chunkSize));
            }

            // Criar gráficos para cada parte em divs separadas
            chunkedData.forEach((chunk, index) => {
              createChart(chunk, index + 1); // Passar o índice + 1 para criar divs como chartdiv1, chartdiv2, etc.
            });
          }
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });
    });
  }

  function criarGraficoSociaisEmocionais(turma, bimestre) {
    // Array para armazenar os dados de cada coluna
    let chartData = [];

    // Colunas com descrições associadas
    let colunas = [
      { key: 'BUSCA_ATENCAO_PARA_SI', label: 'Busca atenção para si' },
      { key: 'BUSCA_INTERAGIR_COLEGAS', label: 'Busca interagir com os colegas' },
      { key: 'COMPREENDE_ATENDE_REGRAS', label: 'Compreende e atende regras e comandos' },
      { key: 'ACEITA_SOLICITA_AJUDA', label: 'Aceita e solicita ajuda' },
      { key: 'DIVIDE_COMPARTILHA_BRINQUEDOS', label: 'Divide e compartilha brinquedos e materiais' },
      { key: 'PARTICIPA_MOMENTOS_GRUPO', label: 'Participa de momentos em grupo' },
      { key: 'EXPOE_ACONTECIMENTOS_COTIDIANO', label: 'Expõe acontecimentos do seu cotidiano' },
      { key: 'BRINCA_FORMA_ISOLADA', label: 'Brinca de forma isolada' },
      { key: 'BRINCA_COM_COLEGAS', label: 'Brinca com os colegas' },
      { key: 'ACEITA_CONTATO_FISICO', label: 'Aceita contato físico' },
      { key: 'SE_ISOLA', label: 'Se isola' },
      { key: 'SE_ZANGA_COM_FACILIDADE', label: 'Se zanga com facilidade' },
      { key: 'ALTERACOES_HUMOR_FREQUENCIA', label: 'Alterações de humor com frequência' },
      { key: 'FAZ_CONTATO_VISUAL', label: 'Faz contato visual' },
      { key: 'SE_RECONHECE_FOTOS', label: 'Se reconhece em fotos' },
      { key: 'RECONHECE_PESSOAS_FOTOS', label: 'Reconhece pessoas em fotos' },
      { key: 'RECONHECE_COMPONENTES_FAMILIARES', label: 'Reconhece componentes familiares' }
    ];



    // Função para buscar os dados de cada coluna e criar o JSON
    colunas.forEach(function (coluna) {
      $.ajax({
        type: "POST",
        url: '/Turma/getHabilidades',
        data: {
          coluna: coluna.key,
          tabela: "CAD_ALUNO_ASPECTOS_SOCIAIS_EMOCIONAIS",
          bimestre: bimestre
        },
        dataType: 'json',
        success: function (data) {
          // Montar o chartEntry com os dados que você recebeu
          let chartEntry = {
            category: coluna.label,  // Usar a descrição correspondente à coluna
            sim: parseInt(data.qtd_sim.QTD), // Acessa 'QTD' dentro de 'qtd_sim'
            nao: parseInt(data.qtd_nao.QTD), // Acessa 'QTD' dentro de 'qtd_nao'
            parcialmente: parseInt(data.qtd_parcialmente.QTD), // Acessa 'QTD' dentro de 'qtd_parcialmente'
            naoSeAplica: parseInt(data.nao_aplica.QTD) // Acessa 'QTD' dentro de 'nao_aplica'
          };

          // Adiciona a entrada ao array chartData
          chartData.push(chartEntry);

          // Quando todas as colunas forem processadas
          if (chartData.length === colunas.length) {
            // Dividir os dados em 4 partes (cada uma com 4 colunas)
            let chunkedData = [];
            let chunkSize = 4;

            for (let i = 0; i < chartData.length; i += chunkSize) {
              chunkedData.push(chartData.slice(i, i + chunkSize));
            }

            // Criar gráficos para cada parte em divs separadas
            chunkedData.forEach((chunk, index) => {
              createChart(chunk, index + 1); // Passar o índice + 1 para criar divs como chartdiv1, chartdiv2, etc.
            });
          }
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });
    });
  }

  function criarGraficoAutonomia(turma, bimestre) {
    // Array para armazenar os dados de cada coluna
    let chartData = [];

    // Colunas com descrições associadas
    let colunas = [
      { key: 'UTILIZA_FRALDA', label: 'Utiliza fralda' },
      { key: 'SE_LIMPA_SOZINHO', label: 'Se limpa sozinho(a)' },
      { key: 'ESCOVA_DENTES_SOZINHO', label: 'Escova os dentes sozinho(a)' },
      { key: 'GUARDA_PERTENCES_SOZINHO', label: 'Guarda seus pertences sozinho(a)' },
      { key: 'AMARRA_CADARCOS', label: 'Amarra cadarços' },
      { key: 'ABRE_MOCHILA_SEM_AUXILIO', label: 'Abre mochila/estojo/lancheira sem auxílio' },
      { key: 'INDEPENDENTE_REALIZACAO_ATIVIDADES', label: 'É independente na realização das atividades' }
    ];




    // Função para buscar os dados de cada coluna e criar o JSON
    colunas.forEach(function (coluna) {
      $.ajax({
        type: "POST",
        url: '/Turma/getHabilidades',
        data: {
          coluna: coluna.key,
          tabela: "CAD_ALUNO_ASPECTOS_AUTONOMIA",
          bimestre: bimestre
        },
        dataType: 'json',
        success: function (data) {
          // Montar o chartEntry com os dados que você recebeu
          let chartEntry = {
            category: coluna.label,  // Usar a descrição correspondente à coluna
            sim: parseInt(data.qtd_sim.QTD), // Acessa 'QTD' dentro de 'qtd_sim'
            nao: parseInt(data.qtd_nao.QTD), // Acessa 'QTD' dentro de 'qtd_nao'
            parcialmente: parseInt(data.qtd_parcialmente.QTD), // Acessa 'QTD' dentro de 'qtd_parcialmente'
            naoSeAplica: parseInt(data.nao_aplica.QTD) // Acessa 'QTD' dentro de 'nao_aplica'
          };

          // Adiciona a entrada ao array chartData
          chartData.push(chartEntry);

          // Quando todas as colunas forem processadas
          if (chartData.length === colunas.length) {
            // Dividir os dados em 4 partes (cada uma com 4 colunas)
            let chunkedData = [];
            let chunkSize = 4;

            for (let i = 0; i < chartData.length; i += chunkSize) {
              chunkedData.push(chartData.slice(i, i + chunkSize));
            }

            // Criar gráficos para cada parte em divs separadas
            chunkedData.forEach((chunk, index) => {
              createChart(chunk, index + 1); // Passar o índice + 1 para criar divs como chartdiv1, chartdiv2, etc.
            });
          }
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });
    });
  }

  function criarGraficoCognitivos(turma, bimestre) {
    // Array para armazenar os dados de cada coluna
    let chartData = [];

    // Colunas com descrições associadas
    let colunas = [
      { key: 'RECONHECE_IDENTIFICA_CORES', label: 'Reconhece e identifica as cores estudadas' },
      { key: 'RECONHECE_IDENTIFICA_NUMEROS', label: 'Reconhece e identifica os números estudados' },
      { key: 'RECONHECE_IDENTIFICA_LETRAS', label: 'Reconhece e identifica as letras estudadas' },
      { key: 'DIFERENCIA_LETRAS_NUMEROS', label: 'Diferencia letras de números' },
      { key: 'IDENTIFICA_LETRAS_NOME', label: 'Identifica as letras do nome' },
      { key: 'ESCREVE_NOME_SEM_AUXILIO', label: 'Escreve o próprio nome sem auxílio' },
      { key: 'REALIZA_PAREAMENTO', label: 'Realiza pareamento' },
      { key: 'MANTEM_ATENCAO_CONCENTRADA', label: 'Mantém atenção concentrada' },
      { key: 'RECONHECE_SILABAS_ESTUDADAS', label: 'Reconhece as sílabas estudadas' },
      { key: 'IDENTIFICA_PARTES_CORPO', label: 'Identifica as partes do corpo' },
      { key: 'NOMEIA_PESSOAS_FAMILIARES', label: 'Nomeia pessoas ao seu redor e familiares' },
      { key: 'SEQUENCIA_LOGICA_FATOS', label: 'Apresenta sequência lógica dos fatos' },
      { key: 'RELACIONA_NUMEROS_QUANTIDADES', label: 'Relaciona números as suas respectivas quantidades' },
      { key: 'COMUNICA_CLAREZA', label: 'Comunica-se com clareza' },
      { key: 'OBSERVA_SEMELHANCA_DIFERENCA_OBJETOS', label: 'Percebe semelhanças e diferenças entre objetos.' },
      { key: 'COMPREENDER_RESPONDE_IDADE', label: 'Responde sua idade quando perguntado(a).' }
    ];





    // Função para buscar os dados de cada coluna e criar o JSON
    colunas.forEach(function (coluna) {
      $.ajax({
        type: "POST",
        url: '/Turma/getHabilidades',
        data: {
          coluna: coluna.key,
          tabela: "CAD_ALUNO_ASPECTOS_COGNITIVOS",
          bimestre: bimestre
        },
        dataType: 'json',
        success: function (data) {
          // Montar o chartEntry com os dados que você recebeu
          let chartEntry = {
            category: coluna.label,  // Usar a descrição correspondente à coluna
            sim: parseInt(data.qtd_sim.QTD), // Acessa 'QTD' dentro de 'qtd_sim'
            nao: parseInt(data.qtd_nao.QTD), // Acessa 'QTD' dentro de 'qtd_nao'
            parcialmente: parseInt(data.qtd_parcialmente.QTD), // Acessa 'QTD' dentro de 'qtd_parcialmente'
            naoSeAplica: parseInt(data.nao_aplica.QTD) // Acessa 'QTD' dentro de 'nao_aplica'
          };

          // Adiciona a entrada ao array chartData
          chartData.push(chartEntry);

          // Quando todas as colunas forem processadas
          if (chartData.length === colunas.length) {
            // Dividir os dados em 4 partes (cada uma com 4 colunas)
            let chunkedData = [];
            let chunkSize = 4;

            for (let i = 0; i < chartData.length; i += chunkSize) {
              chunkedData.push(chartData.slice(i, i + chunkSize));
            }

            // Criar gráficos para cada parte em divs separadas
            chunkedData.forEach((chunk, index) => {
              createChart(chunk, index + 1); // Passar o índice + 1 para criar divs como chartdiv1, chartdiv2, etc.
            });
          }
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });
    });
  }

  function criarGraficoRelacaoFamiliaEscola(turma, bimestre) {
    // Array para armazenar os dados de cada coluna
    let chartData = [];

    // Colunas com descrições associadas
    let colunas = [
      { key: 'PARTICIPA_REUNIOES_SOLICITADO', label: 'Participa das reuniões quando solicitado' },
      { key: 'UNIFORME_LIMPO', label: 'Deixa o aluno(a) na escola com o uniforme limpo' },
      { key: 'REALIZA_BANHO_DIARIO', label: 'Realiza banho diário' },
      { key: 'HIGIENIZA_PERTENCES_ALUNO', label: 'Higieniza os pertences pessoais do aluno(a)' },
      { key: 'CUIDADO_MATERIAIS_ESCOLARES', label: 'Cuidado com os materiais escolares do aluno(a)' },
      { key: 'ALUNO_ASSIDUO', label: 'É um aluno assíduo' },
      { key: 'PONTUALIDADE_HORARIOS_ENTRADA_SAIDA', label: 'Pontualidade nos horários de entrada e saída do aluno(a)' }
    ];






    // Função para buscar os dados de cada coluna e criar o JSON
    colunas.forEach(function (coluna) {
      $.ajax({
        type: "POST",
        url: '/Turma/getHabilidades',
        data: {
          coluna: coluna.key,
          tabela: "CAD_ALUNO_ASPECTOS_RELACAO_FAMILIA_ESCOLA",
          bimestre: bimestre
        },
        dataType: 'json',
        success: function (data) {
          // Montar o chartEntry com os dados que você recebeu
          let chartEntry = {
            category: coluna.label,  // Usar a descrição correspondente à coluna
            sim: parseInt(data.qtd_sim.QTD), // Acessa 'QTD' dentro de 'qtd_sim'
            nao: parseInt(data.qtd_nao.QTD), // Acessa 'QTD' dentro de 'qtd_nao'
            parcialmente: parseInt(data.qtd_parcialmente.QTD), // Acessa 'QTD' dentro de 'qtd_parcialmente'
            naoSeAplica: parseInt(data.nao_aplica.QTD) // Acessa 'QTD' dentro de 'nao_aplica'
          };

          // Adiciona a entrada ao array chartData
          chartData.push(chartEntry);

          // Quando todas as colunas forem processadas
          if (chartData.length === colunas.length) {
            // Dividir os dados em 4 partes (cada uma com 4 colunas)
            let chunkedData = [];
            let chunkSize = 4;

            for (let i = 0; i < chartData.length; i += chunkSize) {
              chunkedData.push(chartData.slice(i, i + chunkSize));
            }

            // Criar gráficos para cada parte em divs separadas
            chunkedData.forEach((chunk, index) => {
              createChart(chunk, index + 1); // Passar o índice + 1 para criar divs como chartdiv1, chartdiv2, etc.
            });
          }
        },
        error: function (error) {
          console.error('Erro ao buscar dados para a coluna:', coluna.key, error);
        }
      });
    });
  }


  // Lógica para capturar a justificativa ao abrir a modal
  // Lógica para capturar a justificativa ao abrir a modal
  $('img[data-toggle="modal"]').on('click', function () {
    var alunoId = $(this).closest('.form-group').find('input[type="checkbox"]').attr('id').split('-')[1];

    // Recupera a justificativa já existente para o aluno, se houver
    var justificativaExistente = $('#checkbox_1-' + alunoId).closest('.form-group').data('justificativa') || "";

    // Carrega a justificativa existente na modal
    $('#modal-center textarea').val(justificativaExistente);

    $('#modal-center .btn.btn-primary.float-right').off('click').on('click', function () {
      var justificativa = $('#modal-center textarea').val();

      // Adiciona ou atualiza a justificativa para o aluno
      $('#checkbox_1-' + alunoId).closest('.form-group').data('justificativa', justificativa);

      // Fecha a modal
      $('#modal-center').modal('hide');
    });
  });


  // Quando o ano letivo é alterado
  $('#ano_letivo').on('change', function () {
    atualizarTurmas();
  });

  // Quando a etapa é alterada
  $('#etapa_escolar').on('change', function () {
    atualizarTurmas();
  });

  // Função para atualizar as turmas com base no ano letivo e na etapa escolar selecionados
  function atualizarTurmas() {
    var ano = $('#ano_letivo').val();
    var etapa = $('#etapa_escolar').val();

    $.ajax({
      type: "POST",
      url: '/Turma/getTurmaAnoLetivoEtapa',
      data: {
        ano: ano,
        etapa: etapa
      },
      dataType: 'json',
      success: function (data) {
        var $selectTurma = $('#turma');
        $selectTurma.empty().append('<option value="">Escolha uma turma</option>');

        // Adiciona as novas opções de turma filtradas
        $.each(data, function (index, turma) {
          var nome_turma = turma.NOME_TURMA;
          var etapaDescricao;

          switch (turma.ETAPA) {
            case 'I1':
              etapaDescricao = 'Etapa: Infantil I – 4 Anos';
              break;
            case 'I2':
              etapaDescricao = 'Etapa: Infantil II – 5 Anos';
              break;
            case 'C1':
              etapaDescricao = 'Etapa: Creche I – 1 Ano';
              break;
            case 'C2':
              etapaDescricao = 'Etapa: Creche II – 2 Anos';
              break;
            case 'C3':
              etapaDescricao = 'Etapa: Creche III – 3 Anos';
              break;
            case 'F1':
              etapaDescricao = 'Etapa: Fundamental I';
              break;
            case 'F2':
              etapaDescricao = 'Etapa: Fundamental II';
              break;
            case 'M1':
              etapaDescricao = 'Etapa: Médio I';
              break;
            case 'M2':
              etapaDescricao = 'Etapa: Médio II';
              break;
            default:
              etapaDescricao = 'Etapa: -';
              break;
          }

          var option = $('<option></option>')
            .val(turma.ID_TURMA)
            .text(nome_turma);
          $selectTurma.append(option);
        });
      }
    });
  }

  $('#turma').change(function () {

    var turma = $(this).val();

    $.ajax({
      type: "POST",
      url: '/Turma/getTurmaAluno',
      data: {
        turma: turma
      },
      dataType: 'json',
      success: function (data) {
        // Seleciona o elemento select
        var $select = $('#aluno');

        // Limpa as opções atuais, exceto a primeira
        $select.empty().append('<option value="">Escolha um aluno</option>');

        // Adiciona as novas opções
        $.each(data, function (index, aluno) {
          var option = $('<option></option>')
            .val(aluno.ID_ALUNO)
            .text(aluno.NOME_ALUNO);
          $select.append(option);
        });
      }
    });
  });

  $('#turma_professor').change(function () {

    var turma = $(this).val();

    $.ajax({
      type: "POST",
      url: '/Turma/getTurmaProfessor',
      data: {
        turma: turma
      },
      dataType: 'json',
      success: function (data) {
        // Seleciona o elemento select
        var $select = $('#professor');

        // Limpa as opções atuais, exceto a primeira
        $select.empty().append('<option value="">Escolha um professor</option>');

        // Adiciona as novas opções
        $.each(data, function (index, aluno) {
          var option = $('<option></option>')
            .val(aluno.ID_PROFESSOR)
            .text(aluno.NOME_PROFISISONAL);
          $select.append(option);
        });
      }
    });
  });



}
