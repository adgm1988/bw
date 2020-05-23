@extends('layout.main')

@section('contenido')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Reportes</h1>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>




<!-- Main content -->
<section class="content" >
  <div class="row">
    <div id="monthly_sale_by_product" class="col-md-6" style="height:300px;"></div>
    <div id="monthly_total_sale" class="col-md-6" style="height:300px;"></div>
  </div>
</section>
  <!-- /.content -->

@endsection

@section('script')
  <script>
   document.addEventListener('DOMContentLoaded', function () {
    var monthly_sale_by_product = Highcharts.chart('monthly_sale_by_product', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Ventas mensuales por producto'
      },
      xAxis: {
        categories: [
        @foreach($months as $month)
        "{{$month->month}}",
        @endforeach
        ]
      },
      yAxis: {
        title: {
          text: '$ MXN'
        }
      },
      series: [
      @foreach($products as $product)
      {
        name: '{{$product->product}}',
        data: [
          @foreach($months as $month)
            @php ($val = 0)
            @foreach($datas as $data)
              @if($data->product == $product->product)
                @if($data->month == $month->month)
                  @php ($val = $data->total_sales)
                @endif
              @endif
            @endforeach
          {{$val}},
          @endforeach
        ]},
      @endforeach
      ]

    });

    var monthly_total_sale = Highcharts.chart('monthly_total_sale', {
      chart: {
        type: 'column'
      },
      title: {
        text: 'Ventas mensuales total'
      },
      xAxis: {
        categories: [
        @foreach($months as $month)
        "{{$month->month}}",
        @endforeach
        ]
      },
      yAxis: {
        title: {
          text: '$ MXN'
        }
      },
      series: [
      {
        name: 'Venta',
        data: [
          @foreach($total_mensual as $total)
            {{$total->total_sales}},
          @endforeach
        ]},
      ]

    });

  });

  </script>

@endsection