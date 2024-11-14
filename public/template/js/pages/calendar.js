!function ($) {
    "use strict";

    var CalendarApp = function () {
        this.$calendar = $('#calendar'), // O elemento onde o calendário será renderizado
            this.$calendarObj = null; // Inicializa o objeto do calendário
    };

    /* Inicializando */
    CalendarApp.prototype.init = function () {
        var $this = this;

        $.ajax({
            type: "POST",
            url: '/AnoLetivo/getAnosLetivo',
            data: {},
            dataType: 'json',
            success: function (data) {
                // Mapeia os dados para o formato de eventos do fullCalendar
                var events = data.map(function (item) {
                    return {
                        title: item.DESCRICAO_DATA, // Título do evento
                        start: item.DATA,           // Data de início do evento
                        color: item.COR_CALENDARIO  // Cor do evento no calendário
                    };
                });

                //* Inicializar o calendário */
                $this.$calendarObj = $this.$calendar.fullCalendar({
                    locale: 'pt-br', // Define o idioma para português
                    defaultView: 'month', // Visualização padrão
                    header: {
                        left: 'prev,next today', // Botões de navegação
                        center: 'title', // Título (mês e ano)
                        right: 'month,agendaWeek,agendaDay' // Opções de visualização
                    },
                    buttonText: {
                        today: 'Hoje',
                        month: 'Mês',
                        week: 'Semana',
                        day: 'Dia',
                        list: 'Lista'
                    },
                    dayNames: [ // Nomes dos dias da semana
                        'Domingo',
                        'Segunda-feira',
                        'Terça-feira',
                        'Quarta-feira',
                        'Quinta-feira',
                        'Sexta-feira',
                        'Sábado'
                    ],
                    dayNamesShort: [ // Nomes curtos dos dias da semana
                        'Dom',
                        'Seg',
                        'Ter',
                        'Qua',
                        'Qui',
                        'Sex',
                        'Sab'
                    ],
                    monthNames: [ // Nomes dos meses
                        'Janeiro',
                        'Fevereiro',
                        'Março',
                        'Abril',
                        'Maio',
                        'Junho',
                        'Julho',
                        'Agosto',
                        'Setembro',
                        'Outubro',
                        'Novembro',
                        'Dezembro'
                    ],
                    events: events,
                    editable: false,
                    droppable: false,
                    selectable: false,

                    // Define a cor de fundo para os finais de semana
                    dayRender: function (date, cell) {
                        var day = date.day(); // 0 = Domingo, 6 = Sábado
                        if (day === 0 || day === 6) {
                            cell.css("background-color", "#8b6f47"); // Cor cinza para sábados e domingos
                        }
                    },

                    // Função para abrir uma modal ao clicar no evento
                    eventClick: function (event) {
                        // Abre uma modal com as informações do evento
                        $('#eventModal .modal-title').html(`<h4 style="font-size: 15px!important; color: #2c4364;" >${event.start.format('DD/MM/YYYY')}</h4>`); // Define o título da modal
                        $('#eventModal .modal-body').html(
                            `<p style="font-size: 20px; color: #2c4364;" > ${event.title}</p>`
                        );
                        $('#eventModal').modal('show'); // Abre a modal
                    }
                });
            }
        });





    };


    // Inicializando o CalendarApp
    $.CalendarApp = new CalendarApp, $.CalendarApp.Constructor = CalendarApp;

}(window.jQuery),

    // Inicializando CalendarApp
    function ($) {
        "use strict";
        $.CalendarApp.init();

    }(window.jQuery);
