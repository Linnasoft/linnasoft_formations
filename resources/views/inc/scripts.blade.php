<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
<script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<!--<script src="{{ asset('bootstrap5/js/bootstrap.min.js') }}"></script>-->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script> 

@if ($page_name != 'error404' && $page_name != 'error500' && $page_name != 'error503' && $page_name != 'auth_boxed')
<script>
    window.User = {
        id: {{ optional(auth()->user())->id }}
    }
</script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/fusioncharts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/fusioncharts.charts.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/themes/fusioncharts.theme.fusion.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
@endif
<script src="{{ asset('assets/js/clipboard/clipboard.min.js') }}"></script>
<script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>
<script src="{{ asset('assets/js/elements/tooltip.js') }}"></script>
<script src="{{ asset('plugins/input-mask/jquery.inputmask.bundle.min.js') }}"></script>
<script src="{{ asset('plugins/input-mask/input-mask.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/custom-sweetalert.js') }}"></script>
<script src="{{ asset('assets/js/special.js') }}"></script>

<script>var _token = $('meta[name="csrf-token"]').attr('content');</script>
<script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('assets/js/components/notification/custom-snackbar.js') }}"></script>
<script src="{{ asset('assets/js/components/ui-accordions.js') }}"></script>
<script src="{{ asset('assets/js/jquery-tableedit/jquery.tabledit.min.js') }}"></script>
<script src="{{ asset('assets/js/elements/popovers.js') }}"></script>
<script src="{{ asset('plugins/jquery-sticky-table/dist/js/freeze-table.js') }}"></script>
<script src="{{ asset('plugins/tagInput/tags-input.js') }}"></script>
<script src="{{ asset('plugins/blockui/jquery.blockUI.min.js') }}"></script>
<script src="{{ asset('plugins/blockui/custom-blockui.js') }}"></script>

<script src="{{asset('plugins/editors/markdown/simplemde.min.js')}}"></script>
<script src="{{asset('plugins/editors/markdown/custom-markdown.js')}}"></script>

<script src="{{ asset('plugins/jquery-timepicker/cdn/jquery.slim.min.js') }}"></script>
<script src="{{ asset('plugins/jquery-timepicker/dist/js/timepicker.min.js') }}"></script>

<script src="https://js.pusher.com/4.1/pusher.min.js"></script>

<script>
        /**
        ************************************************************
        **/
            $(document).on('submit', '#secureForm', function(e){
                    e.preventDefault();

                    $.ajax({
                        url: 'confirm-password',
                        method: 'POST',
                        data: $(this).serialize(),
                        success:function(response)
                        {
                            if(response.type == 'error')
                            {
                                $('#secure_notification').html('<div class="alert alert-light-danger mb-4" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ec1c24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>'+response.msg+'</div>');
                            }
                            else
                            {
                                $('#secureModal').modal('hide');
                                $('#secureForm')[0].reset();
                                $('#secure_notification').empty();
                                Snackbar.show({
                                    text: '<b>'+response.msg+'</b>',
                                    duration: 2000,
                                    actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                    actionTextColor: '#fff',
                                    backgroundColor: '#4aa81f',
                                    pos: 'top-center'
                                });
                            }
                        }
                    });
            });
            
        /**
        ************************************************************
        **/
        
        function DateTime()
        {
            jQuery(function($){
                $.datepicker.regional['fr'] = {
                    closeText: 'Fermer',
                    prevText: '&#x3c;Préc',
                    nextText: 'Suiv&#x3e;',
                    currentText: 'Aujourd\'hui',
                    monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
                                'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
                    monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
                                'Jul','Aou','Sep','Oct','Nov','Dec'],
                    dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                    dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                    dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
                    weekHeader: 'Sm',
                    dateFormat: 'dd-mm-yyyy',
                    firstDay: 1,
                    isRTL: false,
                    showMonthAfterYear: true,
                    yearSuffix: '',
                    maxDate: '+12M +0D',
                    numberOfMonths: 1,
                    showButtonPanel: true
                };
            $.datepicker.setDefaults($.datepicker.regional['fr']);
        });

        $(function(){
            $(".datepicker" ).datepicker();
        });

        $(".datepicker").inputmask("99-99-9999");

        $(function () {
            $('.custom-timepicker').timepicker();
        });
        }

        jQuery(function($){
            $.datepicker.regional['fr'] = {
                closeText: 'Fermer',
                prevText: '&#x3c;Préc',
                nextText: 'Suiv&#x3e;',
                currentText: 'Aujourd\'hui',
                monthNames: ['Janvier','Fevrier','Mars','Avril','Mai','Juin',
                            'Juillet','Aout','Septembre','Octobre','Novembre','Decembre'],
                monthNamesShort: ['Jan','Fev','Mar','Avr','Mai','Jun',
                            'Jul','Aou','Sep','Oct','Nov','Dec'],
                dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
                dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
                dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
                weekHeader: 'Sm',
                dateFormat: 'dd-mm-yyyy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: true,
                yearSuffix: '',
                maxDate: '+12M +0D',
                numberOfMonths: 1,
                showButtonPanel: true
            };
            $.datepicker.setDefaults($.datepicker.regional['fr']);
        });

        $(function(){
            $(".datepicker" ).datepicker();
        });

        $(".datepicker").inputmask("99-99-9999");

        $(function () {
            $('.custom-timepicker').timepicker();
        });
</script>

@switch($page_name)
      @case('students_inscription')
            <script>
                $(document).ready(function(){
                    $(document).on('submit', '#students_inscription', function(e){
                        e.preventDefault();
                        let form_data = $(this).serialize();
                        let target = $(this).attr('target');

                        $.ajax({
                            url:"/register_student/"+target,
                            method:'POST',
                            data:form_data,
                            success:function(response)
                            {
                                if(response.type == 'error')
                                {
                                    swal('',response.msg,'error');
                                }
                                else
                                {
                                    $('#students_inscription')[0].reset();
                                    Snackbar.show({
                                            text: '<b>'+response.msg+'</b>',
                                            duration: 3000,
                                            actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                            actionTextColor: '#fff',
                                            backgroundColor: '#0076A8',
                                            pos: 'top-center'
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
      @break

      @case('formations')
            <script>
                $(document).ready(function(){
                    $("#formations_table").DataTable().destroy();
                    $('#formations_table')
                            .on('draw.dt', function(){ $('[data-toggle="popover"]').popover(); })
                            .DataTable({
                                "lengthMenu": [25,50,100,150],
                                "ordering": false,
                                "language": {
                                    "lengthMenu": "Résultats : _MENU_",
                                    "zeroRecords": 'Aucune formation trouvée !',
                                    "info": "Page _PAGE_ sur _PAGES_",
                                    "infoEmpty": "0 sur 0",
                                    "infoFiltered": "(filtre sur _MAX_ éléments)",
                                    "loadingRecords": "Chargement des données ...",
                                    "search":         "",
                                    "searchPlaceholder": 'Chercher une formation ...',
                                    "paginate": {
                                        "next":       '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>',
                                        "previous":   '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>'
                                    }
                                }         
                    });
                    $('[data-toggle="popover"]').popover(); 

                    $(document).on('click', '.btn_delete', function(){
                        let target = $(this).attr('data-target');

                        swal({
                            title: 'Voulez-vous supprimer cette formation ?',
                            text: "Cette action entraînera la suppression des étudiants et leurs paiements.",
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Oui, supprimer',
                            padding: '2em'
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    url:'delete-formation/'+target,
                                    type:"GET",
                                    data:{_token:_token},
                                    success:function(data)
                                    {
                                        $('#line'+target).remove();
                                        Snackbar.show({
                                            text: '<b>'+data+'</b>',
                                            duration: 2000,
                                            actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                            actionTextColor: '#fff',
                                            backgroundColor: '#0076A8',
                                            pos: 'top-center'
                                        });
                                    }
                                });
                            }
                        })
                    });

                    new SimpleMDE({
                        element: document.getElementById("description_field"),
                        spellChecker: false,
                    });

                    new SimpleMDE({
                        element: document.getElementById("requirements_field"),
                        spellChecker: false,
                    });

                    $(document).on('click', '#btn_new_formation', function(){
                        $('#addNewFormation')[0].reset();
                        $('#datesContent').empty();
                    });

                    var count_date = 1;

                    $(document).on('click', '#btn_add_date', function(){
                        count_date++;
                        $('#datesContent').append('<div class="form-row" id="date_line'+count_date+'"><div class="col-12 col-md-6 col-xl-3 mb-3"><label for="" class="text-dark">Date</label><input type="text" class="form-control datepicker" name="starton'+count_date+'" /></div><div class="col-4 col-md-3 col-xl-2 mb-3"><label for="" class="text-dark">De</label><input type="text" class="form-control custom-timepicker" name="startat'+count_date+'" /></div><div class="col-4 col-md-3 col-xl-2 mb-3"><label for="" class="text-dark text-uppercase">à</label><input type="text" class="form-control custom-timepicker" name="endat'+count_date+'" /></div><div class="col-3 col-md-3 col-xl-2 mb-3"><button class="btn-custom-light mt-5 text-danger bg-white btn_remove_date" type="button" id="'+count_date+'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button></div></div>');
                        DateTime();
                    });

                    $(document).on('click', '.btn_remove_date', function(){
                        let id = $(this).attr('id');

                        $('#date_line'+id).remove();
                    });

                    $(document).on('submit', '#addNewFormation', function(e){
                        e.preventDefault();
                        let form_data = $(this).serialize();

                        $.ajax({
                            url:"/add_new_formation/"+count_date,
                            method:'POST',
                            data:form_data,
                            success:function(response)
                            {
                                if(response.type == 'error')
                                {
                                    swal('',response.msg,'error');
                                }
                                else
                                {
                                    $('#addNewFormation')[0].reset();
                                    $('#formationModal').modal('hide');
                                    $('#formations_list').prepend('<tr id="line'+response.id+'"><td><div class="max-w-180 text-ellipsis inline-elements mt-1 text-warning">'+response.title+'</div></td><td nowrap>'+response.type+'</td><td nowrap><b>'+response.price+'</b></td><td>'+response.max_students+'</td><td>'+response.certification+'</td><td nowrap><b>'+response.state+'</b></td><td nowrap><button token="" id="" class="btn-custom-light btn_show_invoice" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></button><button class="btn-custom-light btn_delete" data-target="'+response.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></td></tr>');
                                    /*
                                    $("#formations_table").DataTable().destroy();
                                    $('#formations_table')
                                            .on('draw.dt', function(){ $('[data-toggle="popover"]').popover(); })
                                            .DataTable({
                                                "lengthMenu": [25,50,100,150],
                                                "ordering": false,
                                                "language": {
                                                    "lengthMenu": "Résultats : _MENU_",
                                                    "zeroRecords": 'Aucune formation trouvée !',
                                                    "info": "Page _PAGE_ sur _PAGES_",
                                                    "infoEmpty": "0 sur 0",
                                                    "infoFiltered": "(filtre sur _MAX_ éléments)",
                                                    "loadingRecords": "Chargement des données ...",
                                                    "search":         "",
                                                    "searchPlaceholder": 'Chercher une formation ...',
                                                    "paginate": {
                                                        "next":       '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>',
                                                        "previous":   '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>'
                                                    }
                                                }         
                                    });*/
                                    
                                    Snackbar.show({
                                            text: '<b>'+response.msg+'</b>',
                                            duration: 2000,
                                            actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                            actionTextColor: '#fff',
                                            backgroundColor: '#003B5B',
                                            pos: 'top-center'
                                    });
                                }
                            }
                        });
                    });

                    $(document).on('click', '.btn_show_formation', function(){
                        window.location.href = '/admin-formations/'+$(this).attr('data-target');
                    });

                    $(document).on('click', '.btn_delete_student', function(){
                        let target = $(this).attr('id');

                        swal({
                            title: 'Voulez-vous supprimer cet inscrit ?',
                            text: "Cette action entraînera la suppression des paiements.",
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Oui, supprimer',
                            padding: '2em'
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    url:'/delete-student/'+target,
                                    type:"GET",
                                    data:{_token:_token},
                                    success:function(data)
                                    {
                                        $('#student_line'+target).remove();
                                        let reg = parseInt($('#count_reg').text());
                                        $('#count_reg').text(reg-1);
                                        Snackbar.show({
                                            text: '<b>'+data+'</b>',
                                            duration: 2000,
                                            actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                            actionTextColor: '#fff',
                                            backgroundColor: '#0076A8',
                                            pos: 'top-center'
                                        });
                                    }
                                });
                            }
                        })
                    });

                    $(document).on('change', '.switch_formation_state', function(){
                        let target = $(this).attr('id');

                        $.ajax({
                            url:'/change-formation-state/'+target,
                            type:"GET",
                            data:{_token:_token},
                            success:function(response)
                            {
                                $('#formation'+target+'_state').html(response.state);
                                Snackbar.show({
                                    text: '<b>'+response.msg+'</b>',
                                    duration: 2000,
                                    actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                    actionTextColor: '#fff',
                                    backgroundColor: '#0076A8',
                                    pos: 'top-center'
                                });
                            }
                        });
                    });

                    $(document).on('click', '.btn_student_certificate', function(){
                        let target = $(this).attr('id');

                        let a= document.createElement('a');
                        a.href= '/get-student-certificate/'+target;
                        a.click();
                    });

                    $(document).on('click', '#btn_make_all_certificates', function(){
                        let target = $(this).attr('data-target');

                        swal({
                            title: 'Voulez-vous générer tous les certificats pour cette formation ?',
                            text: "",
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Oui',
                            padding: '2em'
                        }).then(function(result) {
                            if(result.value) {
                                let a= document.createElement('a');
                                a.href= '/get-all-certificates/'+target;
                                a.click();
                            }
                        })
                    });

                    $(document).on('click', '.btn_copy_formation_link', function(){
                        let target = $(this).attr('data-target');

                        $('#advanced-paragraph').html('<a href="/inscrivez-vous/'+target+'" target="_blank" class="text-primary text-underline">{{ config("app.website") }}/inscrivez-vous/'+target+'</a>');
                        $('#shareModal').modal('show');
                    });

                    var clipboard = new Clipboard('.btn-clipboard');

                    $(document).on('click', '.btn-clipboard', function(){
                        $(this).html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check"><polyline points="20 6 9 17 4 12"></polyline></svg> Lien copié');
                        setTimeout(
                            function(){ 
                                $('.btn-clipboard').html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-copy"><rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect><path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path></svg> Copier le lien');
                            }, 5000
                        );
                    });
                });
            </script>
      @break

      @case('transactions')
            <script>
                $(document).ready(function(){
                    $("#transactions_table").DataTable().destroy();
                    $('#transactions_table')
                            .on('draw.dt', function(){ $('[data-toggle="popover"]').popover(); })
                            .DataTable({
                                "lengthMenu": [25,50,100,150],
                                "ordering": false,
                                "language": {
                                    "lengthMenu": "Résultats : _MENU_",
                                    "zeroRecords": 'Aucune transaction trouvée !',
                                    "info": "Page _PAGE_ sur _PAGES_",
                                    "infoEmpty": "0 sur 0",
                                    "infoFiltered": "(filtre sur _MAX_ éléments)",
                                    "loadingRecords": "Chargement des données ...",
                                    "search":         "",
                                    "searchPlaceholder": 'Chercher une transaction ...',
                                    "paginate": {
                                        "next":       '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-right"><polyline points="13 17 18 12 13 7"></polyline><polyline points="6 17 11 12 6 7"></polyline></svg>',
                                        "previous":   '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-left"><polyline points="11 17 6 12 11 7"></polyline><polyline points="18 17 13 12 18 7"></polyline></svg>'
                                    }
                                }         
                    });
                    $('[data-toggle="popover"]').popover(); 

                    $(document).on('click', '.btn_delete_transaction', function(){
                        let target = $(this).attr('data-target');

                        swal({
                            title: 'Voulez-vous supprimer cette transaction ?',
                            text: "Cette action est définitive.",
                            type: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Oui, supprimer',
                            padding: '2em'
                        }).then(function(result) {
                            if (result.value) {
                                $.ajax({
                                    url:'delete-transaction/'+target,
                                    type:"GET",
                                    data:{_token:_token},
                                    success:function(data)
                                    {
                                        $('#line'+target).remove();
                                        Snackbar.show({
                                            text: '<b>'+data+'</b>',
                                            duration: 2000,
                                            actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                            actionTextColor: '#fff',
                                            backgroundColor: '#0076A8',
                                            pos: 'top-center'
                                        });
                                    }
                                });
                            }
                        })
                    });

                    $(document).on('click', '#btn_new_transaction', function(){
                        $('#addNewTransaction')[0].reset();
                    });

                    $(document).on('submit', '#addNewTransaction', function(e){
                        e.preventDefault();
                        let form_data = $(this).serialize();

                        $.ajax({
                            url:"/add_new_transaction/",
                            method:'POST',
                            data:form_data,
                            success:function(response)
                            {
                                if(response.type == 'error')
                                {
                                    swal('',response.msg,'error');
                                }
                                else
                                {
                                    $('#addNewTransaction')[0].reset();
                                    $('#transactionModal').modal('hide');
                                    $('#transactions_list').prepend('<tr id="line'+response.id+'"><td nowrap>'+response.date+'</td><td nowrap>'+response.amount+'</td><td class="text-warning">'+response.payment_mode+'</td><td><b>'+response.student+'</b></td><td nowrap>"<div class="max-w-180 text-ellipsis inline-elements mt-1">'+response.formation+'</div>"</td><td nowrap><button class="btn-custom-light btn_delete_transaction" data-target="'+response.id+'"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg></button></td></tr>');
                                    
                                    Snackbar.show({
                                            text: '<b>'+response.msg+'</b>',
                                            duration: 2000,
                                            actionText: '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>',
                                            actionTextColor: '#fff',
                                            backgroundColor: '#003B5B',
                                            pos: 'top-center'
                                    });
                                }
                            }
                        });
                    });
                });
            </script>
      @break
@endswitch