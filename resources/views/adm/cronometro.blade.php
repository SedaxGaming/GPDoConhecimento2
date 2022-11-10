@extends('includes/requireLogin')
<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

if (session()->get('nperm') < 11) {
  header("location: ../adm");
  exit;
}

$etapaAtual = DB::table('etapas')->where('etapaAtual', 1)->first();
if ($etapaAtual != null) {
  $contador = (strtotime($etapaAtual->dataFim) - strtotime(Carbon::now('America/Sao_Paulo')));
} else $contador = 0;

?>
<script src="../js/Jquery.js"></script>
<link rel="stylesheet" href="/css/cronometro.css">
<link rel="stylesheet" href="/css/bootstrap/bootstrap.css">

<div id="tempo" style="display: none;">{{$contador}}</div>
<div id="timer" class="center font-weight-bold"></div>


<div class="container">
  <div id="countdown">
    <ul>
      <li><span id="days"></span>Dias</li>
      <li><span id="hours"></span>Horas</li>
      <li><span id="minutes"></span>Minutos</li>
      <li><span id="seconds"></span>Segundos</li>
    </ul>
  </div>
</div>

<script>
  const second = 1,
      minute = second * 60,
      hour = minute * 60,
      day = hour * 24;
      distance = document.getElementById('tempo').innerHTML;
      
      (function() {
        x = setInterval(function() {

      document.getElementById("days").innerText = Math.floor(distance / (day)),
        document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
        document.getElementById("minutes").innerText = Math.floor((distance % (hour)) / (minute)),
        document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);

      if (distance < 0) {
        $('#countdown').text('ACABOU O TEMPO!!')
        clearInterval(x);
      }
      distance -= 1;
    }, 1000)
  }());
</script>