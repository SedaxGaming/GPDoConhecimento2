@extends('includes/requireLogin') 


<link rel="stylesheet" href="../css/painel.css">

<main class="site-wrapper">
  <div class="pt-table desktop-768">
    <div class="pt-tablecell page-home relative" style="background-image: url(../imagens/logoGPgrande.png);
    background-position: center;
    background-size: cover;">

      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-md-offset-1 col-md-10 col-lg-offset-2 col-lg-8">            
            <div class="hexagon-menu clear">
            <div class="hexagon-item">
                <div class="hex-item"></div>
                <div class="hex-item"></div>
                <a class="hex-content"></a>
              </div>
              <div class="hexagon-item">
                <div class="hex-item"></div>
                <div class="hex-item"></div>
                <a class="hex-content"></a>
              </div>
              <div class="hexagon-item">
                <div class="hex-item"></div>
                <div class="hex-item"></div>
                <a class="hex-content"></a>
              </div>
              <div class="hexagon-item">
                <div class="hex-item"></div>
                <div class="hex-item"></div>
                <a class="hex-content"></a>
              </div>
              <div class="hexagon-item">
                <div class="hex-item"></div>
                <div class="hex-item"></div>
                <a class="hex-content"></a>
              </div>
              @if(session()->get('nperm') >= 33)
              <div onclick="cadastros()" class="hexagon-item">
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <a class="hex-content">
                  <span class="hex-content-inner">
                    <span class="icon">
                      <i class="fa fa-universal-access"></i>
                    </span>
                    <span class="title"> Cadastros</span>
                  </span>
                  <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path>
                  </svg>
                </a>
              </div>
              @endif
              @if(session()->get('nperm') >= 22)
              <div onclick="juri()" class="hexagon-item">
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <a class="hex-content">
                  <span class="hex-content-inner">
                    <span class="icon">
                      <i class="fa fa-bullseye"></i>
                    </span>
                    <span  class="title">Juri</span>
                  </span>
                  <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path>
                  </svg>
                </a>
              </div>
              @endif
              <div class="hexagon-item">
                <div class="hex-item"></div>
                <div class="hex-item"></div>
                <a class="hex-content"></a>
              </div>
              @if(session()->get('nperm') >= 0)
              <div onclick="placar()" class="hexagon-item">
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <a class="hex-content">
                  <span class="hex-content-inner">
                    <span class="icon">
                      <i class="fa fa-id-badge"></i>
                    </span>
                    <span  class="title">Placar</span>
                  </span>
                  <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path>
                  </svg>
                </a>
              </div>
              @endif
              @if(session()->get('nperm') >= 11)
              <div onclick="cronometro()" class="hexagon-item">
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <div class="hex-item">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
                <a class="hex-content">
                  <span class="hex-content-inner">
                    <span class="icon">
                      <i class="fa fa-clipboard"></i>
                    </span>
                    <span class="title">Cronometro</span>
                  </span>
                  <svg viewBox="0 0 173.20508075688772 200" height="200" width="174" version="1.1" xmlns="http://www.w3.org/2000/svg">
                    <path d="M86.60254037844386 0L173.20508075688772 50L173.20508075688772 150L86.60254037844386 200L0 150L0 50Z" fill="#1e2530"></path>
                  </svg>
                </a>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  function cadastros(){
    window.location.href = "/painel/cadastros"
  }
  function juri(){
    window.location.href = "/painel/juri"
  }
  function placar(){
    window.location.href = "/placar"
  }
  function cronometro(){
    window.location.href = "/cronometro"
  }

</script>