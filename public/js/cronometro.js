function startTimer(duration, display) {
    var timer = duration, minutes, seconds;
    setInterval(function () {
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);
        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;
        display.textContent = minutes + ":" + seconds;
        if (--timer < 0) {
            timer = 0;
            $("#conteudo").hide();
            $('#timer').show()
            $('#timer').text('Acabou o tempo! Aguarde o resultado e atualize a página assim que for autorizado.')
        }
    }, 1000);
}
window.onload = function () {
    var duration = document.getElementById('tempo').innerHTML;
        display = document.querySelector('#timer'); // selecionando o timer
        $('#timer').hide()
    startTimer(duration, display); // iniciando o timer
};
