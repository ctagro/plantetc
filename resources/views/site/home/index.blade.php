@extends('layouts.site')

@section('content')
<main>
<div class="container-fluid">
    <!-- slider -->
    <div id="mainSlider" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
        <li data-target="#mainSlider" data-slide-to="1"></li>
        <li data-target="#mainSlider" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/santaluiza/fsl09.jpeg" class="d-block w-100" alt="Projetos de e-commerce">

          <!-- tirar classe d-none -->

          <div class="carousel-caption d-nome d-md-block">
            <h2> Fazenda Santa Luiza</h5>
            <p>A sede</p>
            <a href="#" class="main-btn">Mais informações</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/santaluiza/fsl10.jpeg" class="d-block w-100" alt="Engenharia de software">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h5>
            <p>Cultura do Pimentão</p>
            <a href="#" class="main-btn">Mais informações</a>
          </div>
        </div>
        <div class="carousel-item">
          <img src="img/santaluiza/fsl11.jpeg" class="d-block w-100" alt="Manutenção em software">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h5>
            <p>Cultura do Abacate</p>
            <a href="#" class="main-btn">Mais informações</a>
          </div>
        </div>
      </div>
      <a class="carousel-control-prev" href="#mainSlider" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#mainSlider" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
</div>
</main>
@endsection
