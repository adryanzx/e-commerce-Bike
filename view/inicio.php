

<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>
  <meta name="description" content="Bicicletas elétricas de alta precisão e qualidade, feitas sob medida para o cliente. Explore o mundo na sua velocidade com a Bikcraft.">
  <link rel="preload" href="../css/style.css" as="style">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;1,600&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
        integrity="sha512-s3QAG/Rg9BYLllDZ7tL0JCUUDvb/W+gJxvh+yMTxOKWpsqmM2axfChazddWJW6WA29oQmbpWzOyjUhQb5tbqWQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <style>
body {
      font-family: 'Poppins', sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .grid-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      padding: 40px;
      max-width: 1200px;
      margin: 0 auto;
    }

    .card {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-5px);
    }

    .card img {
      width: 100%;
      height: 200px;
      object-fit: cover;
    }

    .card-content {
      padding: 20px;
    }

    .card-title {
      font-size: 1.5em;
      color: #333;
      margin: 0 0 10px;
    }

    .card-description {
      font-size: 1em;
      color: #666;
      line-height: 1.5;
      margin: 0;
    }

    @media (max-width: 768px) {
      .grid-container {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 480px) {
      .grid-container {
        grid-template-columns: 1fr;
      }
    }
    .testimonials {
    background-color: #fff;
    padding: 40px 20px;
    text-align: center;
  }

  .section-title {
    font-size: 2em;
    color: #333;
    margin-bottom: 20px;
  }

  .testimonial-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
  }

  .testimonial-card {
    background-color: #f9f9f9;
    border-radius: 8px;
    padding: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    text-align: center;
  }

  .testimonial-image {
    border-radius: 50%;
    width: 100px;
    height: 100px;
    object-fit: cover;
    margin-bottom: 15px;
  }

  .testimonial-text {
    font-style: italic;
    margin-bottom: 10px;
  }

  .testimonial-author {
    font-weight: bold;
    color: #333;
  }

  .cta {
    background-color: #333;
    color: #fff;
    padding: 40px 20px;
    text-align: center;
  }

  .cta-title {
    font-size: 2em;
    margin-bottom: 10px;
  }

  .cta-description {
    font-size: 1.2em;
    margin-bottom: 20px;
  }

  .cta-button {
    background-color: #f4c542;
    color: #333;
    padding: 15px 25px;
    text-decoration: none;
    font-size: 1.2em;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  .cta-button:hover {
    background-color: #e0b836;
  }

  </style>
</head>
<body>
  <header class="header-bg">
    <div class="header container">
      <a href="inicio.php">
        <img src="../imagens/logo.png" alt="Logo" class="logo">
      </a>      
      <nav aria-label="primaria">
        <ul class="header-menu font-1-m cor-0"> 
          <li><a href="clienteVerProduto.php">Nossos Produtos</a></li>
          <li>
                    <a href="clienteCarrinho.php">
                        <i class="fa fa-shopping-cart"></i>
                        <span class="cart-badge">0</span> <!-- Círculo com o número -->
                    </a>
                </li>
                <li><a href="clienteGerenciaUsuario.php"><i class="fa fa-user"></i></a></li>
                <li><a href="../processamento/sair.php">Sair</a></li>
              
        </ul>
      </nav>
    </div>
  </header>
  <body>
  <!-- <section class="cta">
  <div class="container">
    <h2 class="cta-title">Pronto para explorar o mundo com a Bikcraft?</h2>
    <p class="cta-description">Entre em contato conosco hoje mesmo e descubra como nossas bicicletas podem transformar suas viagens.</p>
    <a href="./contato.php" class="cta-button">Fale Conosco</a>
  </div>
</section> -->

  <div class="grid-container">
    <div class="card">
      <img src="../imagens/magic.jpg" alt="Imagem do Card 1">
  <div class="card-content">
        <h2 class="card-title">Magic</h2>
        <p class="card-description">Explore a cidade com estilo e eficiência com a nossa Bicicleta Elétrica Urban Pro. Projetada para oferecer um desempenho superior em ambientes urbanos, esta bicicleta combina potência e conforto em um design elegante</p>
      </div>
    </div>
    <div class="card">
      <img src="../imagens/nebula.jpg" alt="Imagem do Card 2">
      <div class="card-content">
        <h2 class="card-title">Nebula</h2>
        <p class="card-description">Explore a cidade com estilo e eficiência com a nossa Bicicleta Elétrica Urban Pro. Projetada para oferecer um desempenho superior em ambientes urbanos, esta bicicleta combina potência e conforto em um design elegante</p>
      </div>
    </div>
    <div class="card">
      <img src="../imagens/nimbus.jpg" alt="Imagem do Card 3">
      <div class="card-content">
        <h2 class="card-title">Nimbus</h2>
        <p class="card-description">Explore a cidade com estilo e eficiência com a nossa Bicicleta Elétrica Urban Pro. Projetada para oferecer um desempenho superior em ambientes urbanos, esta bicicleta combina potência e conforto em um design elegante</p>
      </div>
    </div>
    <div class="card">
      <img src="../imagens/oculos1.jpg" alt="Imagem do Card 4">
      <div class="card-content">
        <h2 class="card-title">Oculos Oakley</h2>
        <p class="card-description">Proteja seus olhos com classe e sofisticação usando os Óculos de Sol Solar Elite. Com lentes polarizadas de alta qualidade, esses óculos oferecem proteção completa contra os raios UV e reduzem o brilho, proporcionando uma visão clara e confortável</p>
      </div>
    </div>
    <div class="card">
      <img src="../imagens/oculos2.jpg" alt="Imagem do Card 5">
      <div class="card-content">
        <h2 class="card-title">Oculos Tanel</h2>
        <p class="card-description">Proteja seus olhos com classe e sofisticação usando os Óculos de Sol Solar Elite. Com lentes polarizadas de alta qualidade, esses óculos oferecem proteção completa contra os raios UV e reduzem o brilho, proporcionando uma visão clara e confortável</p>
      </div>
    </div>
    <div class="card">
      <img src="../imagens/oculos3.jpg" alt="Imagem do Card 6">
      <div class="card-content">
        <h2 class="card-title">Oculos Tanel</h2>
        <p class="card-description">Proteja seus olhos com classe e sofisticação usando os Óculos de Sol Solar Elite. Com lentes polarizadas de alta qualidade, esses óculos oferecem proteção completa contra os raios UV e reduzem o brilho, proporcionando uma visão clara e confortável</p>
      </div>
    </div>
  </div>
  <section class="testimonials">
  <div class="container">
    <h2 class="section-title">O que nossos clientes dizem</h2>
    <div class="testimonial-grid">
      <div class="testimonial-card">
        <img src="../imagens/mulher.jpeg" alt="Cliente 1" class="testimonial-image">
        <blockquote class="testimonial-text">
          "As bicicletas da Bikescriptzx são incríveis! A qualidade é excelente e o atendimento é de primeira."
        </blockquote>
        <cite class="testimonial-author">Maria Silva</cite>
      </div>
      <div class="testimonial-card">
        <img src="../imagens/homem1.jpeg" alt="Cliente 2" class="testimonial-image">
        <blockquote class="testimonial-text">
          "Eu recomendo a Bikescriptzx para todos os meus amigos. Eles realmente sabem como fazer uma bicicleta perfeita!"
        </blockquote>
        <cite class="testimonial-author">João Pereira</cite>
      </div>
      <div class="testimonial-card">
        <img src="../imagens/mulher1.jpeg" alt="Cliente 3" class="testimonial-image">
        <blockquote class="testimonial-text">
          "A melhor experiência de compra que já tive. Qualidade e serviço excepcionais!"
        </blockquote>
        <cite class="testimonial-author">Ana Costa</cite>
      </div>
    </div>
  </div>
</section>
</body>
</html>
<?php
  include "layout/rodape.php";
?>