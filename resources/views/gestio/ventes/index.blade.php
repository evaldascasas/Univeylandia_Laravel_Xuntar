@extends("layouts.gestio")

@section("navbarIntranet")
@endsection
@section("menuIntranet")
@endsection
@section("content")
<style>
    .uper {
        margin-top: 40px;
    }
</style>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Ventes</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group mr-2">
            <button class="btn btn-sm btn-outline-secondary" value="Exportar" data-toggle="modal" data-target="#exampleModal">
                <span data-feather="save"></span>
                Exportar PDF
            </button>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Exportar ventes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post">
          <input class="form-control" style="width:80%;display: inline-block;text-align: center;" type="text" name="daterange" value="{{$primer_dia_mes}} - {{$data_actual}}" />
          @csrf
          @method('POST')
          <button style="float: right;" class="btn btn-primary" type="submit">Exportar</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Fi Modal -->

<div class="table-responsive">
    <table
        class="table table-bordered table-hover table-sm dt-responsive nowrap dataTable no-footer dtr-inline collapsed"
        id="results_table_ordenats_id_desc" role="grid">
        <thead class="thead-light">
            <tr>
                <td>#</td>
                <td>Usuari</td>
                <td>Email</td>
                <td>Número document</td>
                <td>Preu total</td>
                <td>Realització de la compra</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            @foreach($ventes as $venta)
            @if ($venta->estat === 0)
            <tr style="color:lightgrey;">
                @else
            <tr>
                @endif
                <td>{{$venta->id}}</td>
                <td>{{$venta->nom}} {{$venta->cognom1}} {{$venta->cognom2}}</td>
                <td>{{$venta->email}}</td>
                <td>{{$venta->numero_document}}</td>
                <td>{{$venta->preu}}</td>
                <td>{{$venta->temps_compra}}</td>
                <td>
                  <a href="{{ route('ventes.edit',$venta->id)}}" class="btn btn-outline-primary btn-sm">Detalls</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
<script>
$(function() {
  $('input[name="daterange"]').daterangepicker({
    opens: 'left',
    "locale": {
       "format": "DD/MM/YYYY",
       "separator": " - ",
       "applyLabel": "Aplicar",
       "cancelLabel": "Cancelar",
       "fromLabel": "De",
       "toLabel": "A",
       "customRangeLabel": "Custom",
       "daysOfWeek": [
           "",
           "Lu",
           "Ma",
           "Mi",
           "Ju",
           "Vi",
           "Sa",
           "Do"
       ],
       "monthNames": [
           "Gener",
           "Febrer",
           "Març",
           "Abril",
           "Maig",
           "Juny",
           "Juliol",
           "Agost",
           "Septembre",
           "Octubre",
           "Novembre",
           "Decembre"
       ],
       "firstDay": 1
   }
  }, function(start, end, label) {
    console.log("Nova selecció de data: " + start.format('DD-MM-YYYY') + ' a ' + end.format('DD-MM-YYYY'));
  });
});

</script>
@endsection
