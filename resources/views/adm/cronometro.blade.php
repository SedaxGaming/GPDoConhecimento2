@extends('includes/requireLogin') 
<?php

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

 if(session()->get('nperm') < 11) {
  header("location: ../adm");
  exit;
}

  $etapaAtual = DB::table('etapas')->where('etapaAtual', 1)->first();
  if($etapaAtual != null){
    $contador = (strtotime($etapaAtual->dataFim) - strtotime(Carbon::now('America/Sao_Paulo')));
  } else $contador = 0;

?>
<script src="../js/cronometro.js"></script>

<div id="tempo" style="display: none;">{{$contador}}</div>
<div id="timer" class="center font-weight-bold"></div>
