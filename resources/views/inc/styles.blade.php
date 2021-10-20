<link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/js/loader.js')}}"></script>

<!-- BEGIN GLOBAL MANDATORY STYLES -->
<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
<link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<!--<link href="{{asset('bootstrap5/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />-->

<!-- END GLOBAL MANDATORY STYLES -->
<link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/scrollspyNav.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/elements/avatar.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/components/tabs-accordian/custom-tabs.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/tables/table-basic.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/forms/switches.css')}}" rel="stylesheet" type="text/css">

<link rel="stylesheet" type="text/css" href="{{ asset('plugins/bootstrap-select/bootstrap-select.min.css') }}">
<link href="{{asset('assets/css/elements/breadcrumb.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>
<link href="{{asset('plugins/jquery-ui/jquery-ui.min.css')}}" rel="stylesheet" type="text/css" />
<script src="{{ asset('assets/css/colorPicker/jquery.minicolors.js') }}"></script>
<link href="{{asset('assets/css/colorPicker/jquery.minicolors.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/css/elements/tooltip.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
<link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
<script src="{{asset('plugins/sweetalerts/promise-polyfill.js')}}"></script>
<link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/tagInput/tags-input.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/notification/snackbar/snackbar.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/loaders/custom-loader.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/css/components/tabs-accordian/custom-accordions.css')}}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="{{ asset('assets/css/components/cards/card.css') }}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/elements/alert.css')}}">
<link href="{{asset('assets/css/components/custom-list-group.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('assets/css/elements/popover.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/elements/custom-pagination.css')}}" rel="stylesheet" type="text/css" />

<link href="{{asset('assets/css/structure.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/main.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/css/linnasoft.css')}}" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="{{asset('plugins/font-icons/fontawesome/web/css/regular.css')}}">
<link rel="stylesheet" href="{{asset('plugins/font-icons/fontawesome/web/css/brands.css')}}">
<link rel="stylesheet" href="{{asset('plugins/font-icons/fontawesome/web/css/solid.css')}}">
<link rel="stylesheet" href="{{asset('plugins/font-icons/fontawesome/web/css/all.css')}}">
<link rel="stylesheet" href="{{asset('plugins/editors/markdown/simplemde.min.css')}}">

<link rel="stylesheet" href="{{asset('plugins/jquery-timepicker/dist/css/timepicker.min.css')}}">

 <script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js"></script>
<!-- jQuery-FusionCharts -->
<script type="text/javascript" src="https://rawgit.com/fusioncharts/fusioncharts-jquery-plugin/develop/dist/fusioncharts.jqueryplugin.min.js"></script>
<!-- Fusion Theme -->
<script type="text/javascript" src="https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js"></script>
    <!----------------------------------- JQUERY FUSIONCHARTS --------------------------------------->
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
@switch($page_name)

    @case('error404')
      <link href="{{asset('assets/css/pages/error/style-400.css')}}" rel="stylesheet" type="text/css" />
      <style>
          #content {
              width: 100%;
              margin-top: 0;
              margin-left: 0;
          }
      </style>
    @break

    @case('utilisateurs')
        <link href="{{asset('assets/css/apps/contacts.css')}}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
        <link href="{{asset('/assets/css/components/custom-modal.css')}}" rel="stylesheet" type="text/css" />
    @break

    @case('single_client')
        <link href="{{ asset('plugins/table/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('plugins/table/datatable/jquery.dataTables.min.js') }}"></script>   
        <script src="{{ asset('plugins/table/datatable/dataTables.bootstrap4.min.js') }}"></script>
        <link rel="stylesheet" type="text/css" href="{{asset('assets/css/widgets/modules-widgets.css')}}">
    @break

    @case('formations')
    @case('transactions')
        <link href="{{asset('assets/css/apps/invoice.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('plugins/table/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
        <script src="{{ asset('plugins/table/datatable/jquery.dataTables.min.js') }}"></script>   
        <script src="{{ asset('plugins/table/datatable/dataTables.bootstrap4.min.js') }}"></script>
    @break

    @default
        <script>console.log('No custom Styles available.')</script>
@endswitch
<!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->