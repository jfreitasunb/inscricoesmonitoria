<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
  <title>Inscrições Monitoria do MAT/UnB</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/css_monitoria.css') }}" rel="stylesheet">
</head>
<body>
  <div class="container">
    @yield('content')
    @include('templates.partials.alerts')
    @include('templates.partials.login_registrar')
  </div>
</body>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="{{ asset('jquery/jquery-3.1.1.min.js') }}"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/monitoria.js') }}"></script>
  

  <script type="text/javascript" src="{{ asset('bower_components/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/moment/min/moment.min.js')}}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/moment/locale/pt-br.js')}}"></script>
  <script type="text/javascript" src="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js')}}"></script>
  <link rel="stylesheet" href="{{ asset('bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css')}}" />
  <script src="{{ asset('bower_components/moment/locale/fr.js')}}"></script>
    

  <script type="text/javascript">
    $(function () {
        $('#inicio_inscricao').datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY'
        });
        $('#fim_inscricao').datetimepicker({
            locale: 'pt-br',
            format: 'DD/MM/YYYY'
        });
    }); 
  </script>
<script>
  $('#disciplinas').click(function() {
  var checkedStatus = this.checked;
  $('#disciplinas tbody tr').find('td :checkbox').each(function() {
    $(this).prop('checked', checkedStatus);
  });
});
</script>
</html>