@extends('includes/requireLogin')

<link rel="stylesheet" href="../../js/datatables/dataTables.bootstrap4.min.css">
<script src="../../js/Jquery.js"></script>
<script src="../../js/datatables/jquery.dataTables.min.js"></script>
<script src="../../js/datatables/dataTables.bootstrap4.min.js"></script>
<script src="../../js/datatables/datatables-demo.js"></script>

<header class="text-center h4 pb-5 mt-3">

    PROVA ATUAL:

</header>

<div class="table-responsive">
  <table class="table table-bordered" id="" width="100%" cellspacing="0">
    <thead>
      <tr class="text-center">
        <th>Nome da prova: PROVA</th>
        <th>Pontuação total da prova: XXXX</th>
      </tr>
        <tr>
            <th class="text-center" colspan="5">PERGUNTAS:</th>
        </tr>
    </thead>
    <tbody>
       <tr>
            <td class="text-center" colspan="4">pergunta</td>
       </tr>
            <th class="text-center" colspan="5">PARTICIPANTES:</th>
       <tr>
       <td class="text-center" colspan="4">Participantes</td>
       </tr>
    </tbody>
  </table>


</div>