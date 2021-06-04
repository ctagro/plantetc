@extends('layouts.site')

@section('content')
<main>
<div id="carrosel-main"class="container-fluid">
    <!-- slider -->
    <div id="mainSlider" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <li data-target="#mainSlider" data-slide-to="0" class="active"></li>
        <li data-target="#mainSlider" data-slide-to="1"></li>
        <li data-target="#mainSlider" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="carousel-item active">
          <img src="img/santaluiza/Casa_Faz.jpg" class="img-responsive" alt="Casa da Fazenda">

          <!-- tirar classe d-none -->

          <div class="carousel-caption d-nome d-md-block">
            <h2> Fazenda Santa Luiza</h2>
            <h3>A sede</h3>
    <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>
       
        <div class="carousel-item">
          <img src="img/santaluiza/plantando_estufa1.jpeg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Plantando estufa 1</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/arado_estufa4.jpeg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Arando para implantação das estufas 4 e 5</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/externa_estufa3.jpg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Visão externa da estufa 3</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/interna_estufa3.jpg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Visão interna da estufa 3</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/vagner_na_estufa.jpeg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Colaborador Vagner</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/camionete2_pim_am.jpeg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Pimentões colhidos prontos para embalagem</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/trator_e_estufas.jpg" class="d-block w-100" alt="Cultura de Pimentão">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Pimentões colhidos que serão transportados para embalamento 3</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
          </div>
        </div>

        <div class="carousel-item">
          <img src="img/santaluiza/abacate_hass.jpeg" class="d-block w-100" alt="Cultura de Abacate">
          <div class="carousel-caption d-md-block">
            <h2>Fazenda Santa Luiza</h2>
            <h3>Cultura do Abacate</h3>
           <!--        <a href="#" class="main-btn">Mais informações</a> -->
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
