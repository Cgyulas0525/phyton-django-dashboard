<?php
use App\Models\Partner;
use App\Classes\JutalekRiport;
use App\Models\Offer;
use App\Models\Account;
use App\Classes\Aktiv;
use App\Classes\Atkotheto;

$ev = date("Y");
$szamlakezdo = date('Y-m-d', strtotime('first day of january 2016'));
$kezdo = date('Y-m-d', strtotime('first day of january this year'));
$veg   = date('Y-m-d', strtotime('last day of december this year'));

$data = Partner::PartnerJelzo();
$megye = Partner::PartnerMegye();

$penznem = array('EUR');
$jutalekeuro = JutalekRiport::TipusokEvenkent($penznem);
$penznem = array('HUF');
$jutalekhuf = JutalekRiport::TipusokEvenkent($penznem);
$jutaleksum = JutalekRiport::TipusokOsszesen();

$ajanlattermekdb = Offer::AjanlatTermekDB();

$szamlazo = array(1,2);
$szamlamindsum = number_format(Account::getSzamlazoSum($szamlakezdo, $veg, $szamlazo), 0, ",", "." );
$szamlaevsum = number_format(Account::getSzamlazoSum($kezdo, $veg, $szamlazo), 0, ",", "." );
$szamlazo = array(2);
$szamlapasum = number_format(Account::getSzamlazoSum($kezdo, $veg, $szamlazo), 0, ",", "." );
$szamlazo = array(1);
$szamlabtsum = number_format(Account::getSzamlazoSum($kezdo, $veg, $szamlazo), 0, ",", "." );

$szamlatomb = Account::getAccountYearMonthAll();

$dataoffer = Aktiv::getAktiv();
$aktivdb = count($dataoffer);
$dataoffer = Atkotheto::getAtkotheto();
$atkothetodb = count($dataoffer);
$dijszuneteltetett = Offer::getDijszuneteltetett();
$eloajanlat = Offer::getEloAjanlat();
$ajanlatszam = Offer::count();
?>
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="http://priestago.hu/padmin/public/css/datatables.css">
    <link rel="stylesheet" href="http://priestago.hu/padmin/public/css/app.css">
    <link rel="stylesheet" href="http://priestago.hu/padmin/public/css/Highcharts.css">
    <link rel="stylesheet" href="http://priestago.hu/padmin/public/css/panel.css">
    @include('layouts.costumcss')
    @include('naptar.naptarcss')
@endsection


@section('content')
    @include('layouts.header')
    <!-- Main content -->
    <section class="content">
        @include('dashboard.dbszamlaajanlat')
    <!-- Small boxes (Stat box) -->
    </section>
@endsection

@section('scripts')
  @include('layouts.highcharts_js')
  @include('naptar.naptarjs')
  <script type="text/javascript">
  $(function () {

      var data_szamlatomb = <?php echo $szamlatomb; ?>;
      var kategoria_szamla = ['Jan', 'Febr', 'Márc', 'Ápr', 'Máj', 'Jún', 'Júl', 'Aug', 'Szept', 'Okt', 'Nov', 'Dec'];
      var data_szamla = [];
      var data = [];
      for (i=2016;i<2021;i++){
          data = [];
          for (j = 0; j < data_szamlatomb.length; j++){
              if(data_szamlatomb[j].year == i){
                  osszeg = data_szamlatomb[j].osszeg;
                  data.push(osszeg);
              }
          }
          data_szamla.push({name: i, data: data});
      }
      var chart_szamlak = highchartLine( 'szamlak', 'line', 575, kategoria_szamla, data_szamla, 'Számlák', 'havi bontás', 'forint');
      chartSkin(chart_szamlak, '#FFFFFF', 25, 'lightgray', 3);

      /* oszlop diagrammok */
      var chart_at = HCCFeltolt(<?php echo $ajanlattermekdb; ?>, 'ajanlat_termek', 'column', 450, 25, 'lightgray', 3, 'Ajánlatok termékenként', 'Egyszerű', ' darab', false, false);
      HCCGomb('#plain_at', '#inverted_at', '#polar_at', chart_at)

      var chart = HCCFeltolt(<?php echo $data; ?>, 'container', 'column', 440, 25, 'lightgray', 3, 'Partner jelző', 'Egyszerű', ' darab', false, false);
      HCCGomb('#plain', '#inverted', '#polar', chart)

      var chart_megye = HCCFeltolt(<?php echo $megye; ?>, 'container_partnermegye', 'column', 450, 25, 'lightgray', 3, 'Partnerek megyénként', 'Poláris', ' darab', false, true);
      HCCGomb('#plain_m', '#inverted_m', '#polar_m', chart_megye)
      /* Jutalék chart */

      var chart_tipuseuro = HCCAreaData(<?php echo $jutalekeuro; ?>, 'container_euro', 'area', 570, 'Jutalékok EURO', 'Év/Típus', 'Euro', ' eur');
      var chart_tipushuf = HCCAreaData(<?php echo $jutalekhuf; ?>, 'container_huf', 'area', 700, 'Jutalékok HUF', 'Év/Típus', 'Forint', ' ft');
      HCCSmallBigButton('small_e', 'large_e', chart_tipuseuro);
      HCCSmallBigButton('small_h', 'large_h', chart_tipushuf);

      var kategoria = kategoriafeltolt(<?php echo $jutalekhuf; ?>);
      var pie_data = HCCPieData(HCCPieDataElokeszit(<?php echo $jutalekhuf; ?>), 5);
      var pie_data_e = HCCPieData(HCCPieDataElokeszit(<?php echo $jutalekeuro; ?>), 5);
      var pie_data_sum = HCCPieDataSum( <?php echo $jutaleksum; ?>)
      var chart_tipuseuropie = HighChartPie( 'container_tipuseuro', 'pie', 510, kategoria, pie_data_e, 'Jutalékok', 'Jutalékok EURO', 'Jutalék', 250);

      chartSkin(chart_tipushuf, '#FFFFFF', 25, 'lightgray', 3);
      chartSkin(chart_tipuseuro, '#FFFFFF', 25, 'lightgray', 3);
      chartSkin(chart_tipuseuropie, '#FFFFFF', 25, 'lightgray', 3);

      document.getElementById('pie_h').addEventListener('click', function () {
          chartUpdate(chart_tipuseuropie, 'Jutalékok HUF', pie_data);
      });
      document.getElementById('pie_e').addEventListener('click', function () {
          chartUpdate(chart_tipuseuropie, 'Jutalékok EURO', pie_data_e);
      });
      document.getElementById('pie_s').addEventListener('click', function () {
          chartUpdate(chart_tipuseuropie, 'Jutalékok Összesen', pie_data_sum);
      });

      var SITEURL = "{{url('/')}}";

      $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
      });

  /* initialize the calendar
   -----------------------------------------------------------------*/
  //Date for the calendar events (dummy data)
      var date = new Date()
      var d    = date.getDate(),
          m    = date.getMonth(),
          y    = date.getFullYear()
      var calendar = $('#calendar').fullCalendar({
          locale: 'hu',
          aspectRatio: 1.75,
          weekNumbers: true,
          weekNumbersWithinDays: true,
          weekNumberCalculation: 'ISO',

          plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
          header    : {
              left  : 'prev,next today',
              center: 'title',
              right : 'listDay, listWeek'
          },
          views: {
              listDay: { buttonText: 'Napi lista' },
              listWeek: { buttonText: 'Heti lista' }
          },
            defaultView: 'listWeek',
        //Random default events
          events    : SITEURL + "/fullcalendareventmaster",
          navLinks: true, // can click day/week names to navigate views
          selectable: true,
          selectHelper: true,
          editable  : true,
          droppable : true, // this allows things to be dropped onto the calendar !!!

      })

  });
  </script>

@endsection
