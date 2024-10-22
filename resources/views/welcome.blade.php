<!doctype html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="A Hornet Bier é especializada na instalação e manutenção de dispensadores de cerveja, fornecendo serviços de primeira linha para bares, restaurantes e outros estabelecimentos que servem cerveja. Entre em contato conosco!" />
        <meta name="robots" content="index, follow">
        <meta name="keywords" content="Chopeira, Instalação de chopeiras, Manutenção de chopeiras, Distribuidor de cerveja, Sistema de cerveja, Instalação de sistema de chope, Manutenção do sistema de chope, Reparo do sistema de chope, Sistema de chope">

        <title>Hornet Bier</title>
        <link rel="icon" type="image/x-icon" href="images/favicon2.ico">
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css" />

        <!-- Bootstrap 5.2.3 -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        
        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/responsivo.css">

        <!-- Google tag (gtag.js) -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-EHTGHMWRMK"></script>
        <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-EHTGHMWRMK');
        </script>
    </head>
    <body id="home">
        @include('sweetalert::alert')
        <nav class="navbar navbar-expand-lg bg-secondary text-uppercase fixed-top" id="mainNav">
            <div class="container">
                <a href="#inicio" class="navbar-brand">
                    <img class="" src="images/nova-logo.png" alt="Logo" style="width: 120px;margin-top: -8%;margin-bottom: -8%;"/>
                </a>
                <button class="navbar-toggler text-uppercase font-weight-bold bg-primary text-white rounded" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item mx-0 mx-lg-1"><a href="#inicio" class="nav-link py-3 px-0 px-lg-3 rounded">Início</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a href="#sobre" class="nav-link py-3 px-0 px-lg-3 rounded">Sobre</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a href="#produtos" class="nav-link py-3 px-0 px-lg-3 rounded">Produtos</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a href="#servicos" class="nav-link py-3 px-0 px-lg-3 rounded">Serviços</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a href="#autorizada" class="nav-link py-3 px-0 px-lg-3 rounded">Autorizadas</a></li>
                        <li class="nav-item mx-0 mx-lg-1"><a href="#contato" class="nav-link py-3 px-0 px-lg-3 rounded">Contato</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <header class="masthead text-white text-center" id="inicio">
            <div class="container d-flex align-items-center flex-column">
                <img class="masthead-avatar mb-5" src="images/nova-logo.png" alt="..." />
                <p class="masthead-subheading font-weight-light mb-0">Manutenção - Vendas e Projetos</p>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fas fa-beer"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
            </div>
        </header>
        <!-- Sobre -->
        <section class="page-section mb-0" id="sobre">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Sobre nós</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-address-card"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row content">
                    <div class="col-lg-6">
                        <p>
                            Na <strong>Chopeiras HornetBier</strong>, nos orgulhamos de nossa Experiência, Ótimo Atendimento e Serviço Qualificado, que nos diferenciam dos demais. <br>
                            Nosso principal objetivo é entregar Qualidade aos nossos clientes, fomentando parcerias de longo prazo, fidelidade e altos índices de satisfação com nossos serviços. <br>
                            Com uma dedicação em fornecer serviços de manutenção de alto nível para cervejarias, bares e clientes particulares.
                        </p>
                        
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0">
                        <ul>
                            <li><i class="ri-check-double-line"></i> Garantir que as Chopeiras estejam funcionando corretamente, fornecendo Chopp de alta qualidade aos clientes.</li>
                            <li><i class="ri-check-double-line"></i> fornecer um excelente atendimento ao cliente, ouvir o feedback do cliente e garantir que ele esteja satisfeito com os serviços prestados.</li>
                            <li><i class="ri-check-double-line"></i> Conduzir negócios com honestidade, transparência e integridade e garantir que todas as interações com clientes e parceiros sejam éticas e respeitosas.</li>
                            <li><i class="ri-check-double-line"></i> Comprometimento com excelência</li>
                        </ul>
                    </div>
                    <div class="row" style="margin-top: 35px;">
                        <h4 class="text-center">Nosso Valores</h4>
                        <div class="col-md-4">
                            <button class="card-valores">Respeito nas Relações</button>
                        </div>
                        <div class="col-md-4">
                            <button class="card-valores card-valores-2">Honestidade</button>
                        </div>
                        <div class="col-md-4">
                            <button class="card-valores">Agilidade com Competência</button>
                        </div>
                        <div class="col-md-4">
                            <button class="card-valores card-valores-2">Confiança</button>
                        </div>
                        <div class="col-md-4">
                            <button class="card-valores">Compromentimento com Excelência</button>
                        </div>
                        <div class="col-md-4">
                            <button class="card-valores card-valores-2">Empatia</button>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Produtos -->
        <section class="page-section bg-primary text-white mb-0 portfolio" id="produtos">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-white mb-0">Produtos</h2>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-briefcase"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <!-- Produtos -->
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal3">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><img class="" src="images/logo-ruwer.png" alt="..." style="width: 25%;"/></div>
                            </div>
                            <img class="img-fluid" src="images/chopeira-ruver-2.png" alt="..." />
                        </div>
                        <div><br>
                            <a href="https://www.chopeirasruver.com.br/" target="_blank" style="text-decoration: none;text-align: center;color: #ffffff;margin-top: 10px;">
                                <h4><strong>Chopeiras Ruver</strong></h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><img class="" src="images/logo-memo.png" alt="..." style="width: 100%;"/></div>
                            </div>
                            <img class="img-fluid" src="images/chopeira-eletrica-mimo-30.jpg" alt="..." />
                        </div>
                        <div><br>
                            <a href="https://memo.ind.br/" target="_blank" style="text-decoration: none;text-align: center;color: #ffffff;margin-top: 10px;">
                                <h4><strong>Chopeiras Memo</strong></h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#portfolioModal1">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><img class="" src="images/logo-top-service.png" alt="..." style="width: 90%;"/></div>
                            </div>
                            <img class="img-fluid" src="images/chopeira-tsi-2.jpg" alt="..." />
                        </div>
                        <div><br>
                            <a href="https://www.chopeirastsi.com.br/" target="_blank" style="text-decoration: none;text-align: center;color: #ffffff;margin-top: 10px;">
                                <h4><strong>Chopeiras Top Service Industrial</strong></h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Serviços -->
        <section class="page-section portfolio" id="servicos">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary">Serviços</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa fa-gear"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#servicoModal1">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/manutencao.png" alt="..." />
                        </div>
                        <div><br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#servicoModal1" target="_blank" style="text-decoration: none;text-align: center;color: #000000;margin-top: 10px;">
                                <h4><strong>Manutenção</strong></h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#servicoModal2">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <img class="img-fluid" src="images/assepsia.jpg" alt="..." />
                        </div>
                        <div><br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#servicoModal2" target="_blank" style="text-decoration: none;text-align: center;color: #000000;margin-top: 10px;">
                                <h4><strong>Assepsia</strong></h4>
                            </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4 mb-5">
                        <div class="portfolio-item mx-auto" data-bs-toggle="modal" data-bs-target="#servicoModal3">
                            <div class="portfolio-item-caption d-flex align-items-center justify-content-center h-100 w-100">
                                <div class="portfolio-item-caption-content text-center text-white"><i class="fas fa-plus fa-3x"></i></div>
                            </div>
                            <div class="d-flex align-items-center justify-content-center">
                                <img class="img-fluid" src="images/instalacao.png" alt="..." style="max-height: 330px;"/>
                            </div>
                        </div>
                        <div><br>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#servicoModal3" target="_blank" style="text-decoration: none;text-align: center;color: #000000;margin-top: 10px;">
                                <h4><strong>Instalação</strong></h4>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Autorizada -->
        <section class="page-section bg-primary text-white mb-0" id="autorizada">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-white mb-0">Assistência Téc. Autorizada</h2>
                <div class="divider-custom divider-light">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-handshake"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 box4-parceria">
                        <div id="box-parceria" class="height-lista-parceria">
                            <div class="box-parceria-img">
                                <a href="https://www.chopeirasruver.com.br/" target="_blank">
                                    <img src="images/logo-ruwer.png" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="https://www.chopeirasruver.com.br/" target="_blank" style="text-decoration: none;">
                                    <h4><strong>Chopeiras Ruver</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 box4-parceria">
                        <div id="box-parceria" class="height-lista-parceria">
                            <div class="box-parceria-img">
                                <a href="https://memo.ind.br/" target="_blank">
                                    <img src="images/logo-memo-footer.png" alt="" width="85">
                                </a>
                            </div>
                            <div>
                                <a href="https://memo.ind.br/" target="_blank" style="text-decoration: none;">
                                    <h4><strong>Memo</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-3 box4-parceria">
                        <div id="box-parceria" class="height-lista-parceria">
                            <div class="box-parceria-img">
                                <a href="https://www.chopeirastsi.com.br/" target="_blank">
                                    <img src="images/logo-top-service.png" alt="">
                                </a>
                            </div>
                            <div>
                                <a href="https://www.chopeirastsi.com.br/" target="_blank" style="text-decoration: none;">
                                    <h4><strong>Top Service Industrial</strong></h4>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contato -->
        <section class="page-section text-white mb-0" id="contato">
            <div class="container">
                <h2 class="page-section-heading text-center text-uppercase text-secondary mb-0">Entre em Contato</h2>
                <div class="divider-custom">
                    <div class="divider-custom-line"></div>
                    <div class="divider-custom-icon"><i class="fa-solid fa-message"></i></div>
                    <div class="divider-custom-line"></div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-xl-7">
                        <div style="text-align: center;">
                            <h5>Fone/Whatsapp: <a href="https://api.whatsapp.com/send?phone=5551999446655&text=Olá+é+da+Hornet+Bier?" target="_blank" style="text-decoration: none;color: #8e1b1b;">(51) 99944-6655</a></h5><br>
                            <h5>E-mail: <a href="mailto:contato@hornetbier.com.br?subject=Assunto do email&body=Olá" style="text-decoration: none;color: #8e1b1b;">contato@hornetbier.com.br</a></h5><br>
                            <h5>Horário de Atendimento<br>
                                Segunda à sexta das 09:00h às 21:00h<br>
                                Sábado das 09:00h às 19:00h</h5><br>
                            <h5>Hornetbier Chopeiras e Manutenção<br>
                            CNPJ: 50.934.088/0001-97<br>
                            Sapucaia do Sul/RS</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>
       
        <footer class="footer text-center">
            <div class="container">
                <div class="row">
                    <!-- Footer endereço -->
                    <div class="col-lg-4 mb-5 mb-lg-0 footer-links">
                        <h4 class="text-uppercase mb-4">Links Úteis</h4>
                        <ul>
                          <li><a href="#sobre">Sobre</a></li>
                          <li><a href="#produtos">Produtos</a></li>
                          <li><a href="#servicos">Serviços</a></li>
                          <li><a href="#autorizada">Autorizadas</a></li>
                          <li><a href="#contato">Contato</a></li>
                        </ul>
                    </div>
                    <!-- Footer Social -->
                    <div class="col-lg-4 mb-5 mb-lg-0">
                        <h4 class="text-uppercase mb-4">Redes Sociais</h4>
                        <p>Quer ficar por dentro das nossas últimas notícias, promoções e atualizações? Siga-nos em nossos canais de mídia social</p>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://www.facebook.com/hornetbier/" target="_blank"><i class="fab fa-fw fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social mx-1" href="https://www.instagram.com/hornetbier/"><i class="fab fa-fw fa-instagram"></i></a>
                    </div>
                    <!-- Footer Parceiros -->
                    <div class="col-lg-4">
                        <h4 class="text-uppercase mb-4">Assistência Téc. Autorizada</h4>
                        <a href="https://www.chopeirasruver.com.br/" target="_blank"><img class="" src="images/logo-ruwer.png" alt="Chopeiras Ruwer" style="width: 80px;margin: 0px 10px;"/></a>
                        <a href="https://memo.ind.br/" target="_blank"><img class="" src="images/logo-memo-footer.png" alt="Memo" style="width: 85px;margin: 0px 10px;"/></a>
                        <a href="https://www.chopeirastsi.com.br/" target="_blank"><img class="" src="images/logo-top-service.png" alt="Chopeiras Top Service" style="width: 90px;margin: 0px 10px;"/></a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Copyright -->
        <div class="copyright py-2 text-center text-white" style="margin-top: -40px;">
            <div class="container"><small>Copyright &copy; Hornet Bier 2024</small></div>
        </div>
        <!-- Produtos Modal 1-->
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" aria-labelledby="portfolioModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Chopeira Elétrica 30 L/H Sem Kit Extração</h2>
                                    <!-- Icon Divider-->
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-beer-mug-empty"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5" src="images/chopeira-tsi-2.jpg" alt="..." />
                                    <p class="mb-4">Acesse o fornecedor desta chopeira para localizar mais produtos semelhantes à este.</p>
                                    <div class="text-center mt-4">
                                        <a class="btn btn-primary" href="https://www.chopeirastsi.com.br/" target="_blank">
                                            Top Service Industrial
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Produto Modal 2-->
        <div class="portfolio-modal modal fade" id="portfolioModal2" tabindex="-1" aria-labelledby="portfolioModal2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Chopeira Elétrica Mimo 30</h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-beer-mug-empty"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5" src="images/chopeira-eletrica-mimo-30.jpg" alt="..." />
                                    <p class="mb-4">Acesse o fornecedor desta chopeira para localizar mais produtos semelhantes à este. </p>
                                    <div class="text-center mt-4">
                                        <a class="btn btn-primary" href="https://memo.ind.br/" target="_blank">
                                            Memo
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Produto Modal 3-->
        <div class="portfolio-modal modal fade" id="portfolioModal3" tabindex="-1" aria-labelledby="portfolioModal3" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">CHOPEIRA INOX 1 TORNEIRA - BCK HOME</h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-beer-mug-empty"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5" src="images/chopeira-ruver-2.png" alt="..." />
                                    <p class="mb-4">Acesse o fornecedor desta chopeira para localizar mais produtos semelhantes à este.</p>
                                    <div class="text-center mt-4">
                                        <a class="btn btn-primary" href="https://www.chopeirasruver.com.br/" target="_blank">
                                            Chopeiras Ruver
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Servico Modal 1-->
        <div class="portfolio-modal modal fade" id="servicoModal1" tabindex="-1" aria-labelledby="servicoModal1" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Manutenção</h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-gear"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5" src="images/manutencao-sem-corte.png" alt="..." />
                                    <p class="mb-4" style="margin-bottom: 4.5rem !important;">Nosso serviço de assistência técnica / manutenção preventiva e corretiva, você entra em contato e agendamos o melhor dia para a retirada ou entrega do seu equipamento.
                                        Tá precisando de assistência técnica / manutenção ou instalação? Chama a Hornetbier!!!!!
                                        Agendamento e informações,  chama no WhatsApp (51) 999446655.</p>
                                    <!-- START Widget WhastApp -->
                                    <div class="text-center">
                                        <a href="https://api.whatsapp.com/send?phone=5551999446655&text=Olá!%20Gostaria%20de%20mais%20informações%20sobre%20esse%20serviço" class="bt-whatsApp" target="_blank" style="right:39%; position: absolute; width:60px;height:60px;bottom:40px;z-index:100;">
                                            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMjYxOSA1MDYgMTIwIDEyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48c3R5bGU+CiAgICAgIC5jbHMtMSB7CiAgICAgICAgZmlsbDogIzI3ZDA0NTsKICAgICAgfQoKICAgICAgLmNscy0yLCAuY2xzLTUgewogICAgICAgIGZpbGw6IG5vbmU7CiAgICAgIH0KCiAgICAgIC5jbHMtMiB7CiAgICAgICAgc3Ryb2tlOiAjZmZmOwogICAgICAgIHN0cm9rZS13aWR0aDogNXB4OwogICAgICB9CgogICAgICAuY2xzLTMgewogICAgICAgIGZpbGw6ICNmZmY7CiAgICAgIH0KCiAgICAgIC5jbHMtNCB7CiAgICAgICAgc3Ryb2tlOiBub25lOwogICAgICB9CiAgICA8L3N0eWxlPjwvZGVmcz48ZyBkYXRhLW5hbWU9Ikdyb3VwIDM2IiBpZD0iR3JvdXBfMzYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDIzMDAgNzMpIj48Y2lyY2xlIGNsYXNzPSJjbHMtMSIgY3g9IjYwIiBjeT0iNjAiIGRhdGEtbmFtZT0iRWxsaXBzZSAxOCIgaWQ9IkVsbGlwc2VfMTgiIHI9IjYwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgzMTkgNDMzKSIvPjxnIGRhdGEtbmFtZT0iR3JvdXAgMzUiIGlkPSJHcm91cF8zNSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjU0IDM4NikiPjxnIGRhdGEtbmFtZT0iR3JvdXAgMzQiIGlkPSJHcm91cF8zNCI+PGcgY2xhc3M9ImNscy0yIiBkYXRhLW5hbWU9IkVsbGlwc2UgMTkiIGlkPSJFbGxpcHNlXzE5IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg5NCA3NSkiPjxjaXJjbGUgY2xhc3M9ImNscy00IiBjeD0iMzEuNSIgY3k9IjMxLjUiIHI9IjMxLjUiLz48Y2lyY2xlIGNsYXNzPSJjbHMtNSIgY3g9IjMxLjUiIGN5PSIzMS41IiByPSIyOSIvPjwvZz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik0xNDI0LDE5MWwtNC42LDE2LjMsMTYuOS00LjcuOS01LjItMTEsMy41LDIuOS0xMC41WiIgZGF0YS1uYW1lPSJQYXRoIDEyNiIgaWQ9IlBhdGhfMTI2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTMyNSAtNjgpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTI2Niw5MGMwLS4xLDMuNS0xMS43LDMuNS0xMS43bDguNCw3LjlaIiBkYXRhLW5hbWU9IlBhdGggMTI3IiBpZD0iUGF0aF8xMjciIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMTY1IDQzKSIvPjwvZz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik0xNDM5LjMsMTYwLjZhOS40LDkuNCwwLDAsMC0zLjksNi4xYy0uNSwzLjksMS45LDcuOSwxLjksNy45YTUwLjg3Niw1MC44NzYsMCwwLDAsOC42LDkuOCwzMC4xODEsMzAuMTgxLDAsMCwwLDkuNiw1LjEsMTEuMzc4LDExLjM3OCwwLDAsMCw2LjQuNiw5LjE2Nyw5LjE2NywwLDAsMCw0LjgtMy4yLDkuODUxLDkuODUxLDAsMCwwLC42LTIuMiw1Ljg2OCw1Ljg2OCwwLDAsMCwwLTJjLS4xLS43LTcuMy00LTgtMy44cy0xLjMsMS41LTIuMSwyLjYtMS4xLDEuNi0xLjksMS42LTQuMy0xLjQtNy42LTQuNGExNS44NzUsMTUuODc1LDAsMCwxLTQuMy02cy42LS43LDEuNC0xLjhhNS42NjQsNS42NjQsMCwwLDAsMS4zLTIuNGMwLS41LTIuOC03LjYtMy41LTcuOUExMS44NTIsMTEuODUyLDAsMCwwLDE0MzkuMywxNjAuNloiIGRhdGEtbmFtZT0iUGF0aCAxMjgiIGlkPSJQYXRoXzEyOCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTEzMjYuMzMyIC02OC40NjcpIi8+PC9nPjwvZz48L3N2Zz4=" alt="" width="60px">
                                        </a>
                                        <span id="alertWapp" style="right:435px; visibility: hidden; position:absolute;	width:17px;	height:17px;bottom:90px; background:red;z-index:101; font-size:11px;color:#fff;text-align:center;border-radius: 50px; font-weight:bold;line-height: normal; "> 1 </span>
                                        <div id="msg1" style="right: 45%; visibility: visible; background: #1EBC59; color: #fff; position: absolute; width: 200px; bottom: 52px; text-align: center; font-size: 13px; line-height: 31px; height: 32px; border-radius: 100px; z-index: 100; ">Solicite um orçamento via Whatsapp</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Servico Modal 2-->
        <div class="portfolio-modal modal fade" id="servicoModal2" tabindex="-1" aria-labelledby="servicoModal2" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Assepsia</h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-flask"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                    <img class="img-fluid rounded mb-5" src="images/assepsia.jpg" alt="..." />
                                    <p class="mb-4" style="margin-bottom: 4.5rem !important;">Assepsia da Chopeira é um processo de limpeza interna da serpentina, por onde passa o chopp, com auxilio de uma máquina que faz a recirculação dos líquidos peracéticos. Essa ação tem por função eliminar todos os organismos que ficam armazenados durante o uso do equipamento. Agende o serviço para sua chopeira. </p>
                                    <!-- START Widget WhastApp -->
                                    <div class="text-center">
                                        <a href="https://api.whatsapp.com/send?phone=5551999446655&text=Olá!%20Gostaria%20de%20mais%20informações%20sobre%20esse%20serviço" class="bt-whatsApp" target="_blank" style="right:39%; position: absolute; width:60px;height:60px;bottom:40px;z-index:100;">
                                            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMjYxOSA1MDYgMTIwIDEyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48c3R5bGU+CiAgICAgIC5jbHMtMSB7CiAgICAgICAgZmlsbDogIzI3ZDA0NTsKICAgICAgfQoKICAgICAgLmNscy0yLCAuY2xzLTUgewogICAgICAgIGZpbGw6IG5vbmU7CiAgICAgIH0KCiAgICAgIC5jbHMtMiB7CiAgICAgICAgc3Ryb2tlOiAjZmZmOwogICAgICAgIHN0cm9rZS13aWR0aDogNXB4OwogICAgICB9CgogICAgICAuY2xzLTMgewogICAgICAgIGZpbGw6ICNmZmY7CiAgICAgIH0KCiAgICAgIC5jbHMtNCB7CiAgICAgICAgc3Ryb2tlOiBub25lOwogICAgICB9CiAgICA8L3N0eWxlPjwvZGVmcz48ZyBkYXRhLW5hbWU9Ikdyb3VwIDM2IiBpZD0iR3JvdXBfMzYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDIzMDAgNzMpIj48Y2lyY2xlIGNsYXNzPSJjbHMtMSIgY3g9IjYwIiBjeT0iNjAiIGRhdGEtbmFtZT0iRWxsaXBzZSAxOCIgaWQ9IkVsbGlwc2VfMTgiIHI9IjYwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgzMTkgNDMzKSIvPjxnIGRhdGEtbmFtZT0iR3JvdXAgMzUiIGlkPSJHcm91cF8zNSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjU0IDM4NikiPjxnIGRhdGEtbmFtZT0iR3JvdXAgMzQiIGlkPSJHcm91cF8zNCI+PGcgY2xhc3M9ImNscy0yIiBkYXRhLW5hbWU9IkVsbGlwc2UgMTkiIGlkPSJFbGxpcHNlXzE5IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg5NCA3NSkiPjxjaXJjbGUgY2xhc3M9ImNscy00IiBjeD0iMzEuNSIgY3k9IjMxLjUiIHI9IjMxLjUiLz48Y2lyY2xlIGNsYXNzPSJjbHMtNSIgY3g9IjMxLjUiIGN5PSIzMS41IiByPSIyOSIvPjwvZz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik0xNDI0LDE5MWwtNC42LDE2LjMsMTYuOS00LjcuOS01LjItMTEsMy41LDIuOS0xMC41WiIgZGF0YS1uYW1lPSJQYXRoIDEyNiIgaWQ9IlBhdGhfMTI2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTMyNSAtNjgpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTI2Niw5MGMwLS4xLDMuNS0xMS43LDMuNS0xMS43bDguNCw3LjlaIiBkYXRhLW5hbWU9IlBhdGggMTI3IiBpZD0iUGF0aF8xMjciIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMTY1IDQzKSIvPjwvZz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik0xNDM5LjMsMTYwLjZhOS40LDkuNCwwLDAsMC0zLjksNi4xYy0uNSwzLjksMS45LDcuOSwxLjksNy45YTUwLjg3Niw1MC44NzYsMCwwLDAsOC42LDkuOCwzMC4xODEsMzAuMTgxLDAsMCwwLDkuNiw1LjEsMTEuMzc4LDExLjM3OCwwLDAsMCw2LjQuNiw5LjE2Nyw5LjE2NywwLDAsMCw0LjgtMy4yLDkuODUxLDkuODUxLDAsMCwwLC42LTIuMiw1Ljg2OCw1Ljg2OCwwLDAsMCwwLTJjLS4xLS43LTcuMy00LTgtMy44cy0xLjMsMS41LTIuMSwyLjYtMS4xLDEuNi0xLjksMS42LTQuMy0xLjQtNy42LTQuNGExNS44NzUsMTUuODc1LDAsMCwxLTQuMy02cy42LS43LDEuNC0xLjhhNS42NjQsNS42NjQsMCwwLDAsMS4zLTIuNGMwLS41LTIuOC03LjYtMy41LTcuOUExMS44NTIsMTEuODUyLDAsMCwwLDE0MzkuMywxNjAuNloiIGRhdGEtbmFtZT0iUGF0aCAxMjgiIGlkPSJQYXRoXzEyOCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTEzMjYuMzMyIC02OC40NjcpIi8+PC9nPjwvZz48L3N2Zz4=" alt="" width="60px">
                                        </a>
                                        <span id="alertWapp" style="right:435px; visibility: hidden; position:absolute;	width:17px;	height:17px;bottom:90px; background:red;z-index:101; font-size:11px;color:#fff;text-align:center;border-radius: 50px; font-weight:bold;line-height: normal; "> 1 </span>
                                        <div id="msg1" style="right: 45%; visibility: visible; background: #1EBC59; color: #fff; position: absolute; width: 200px; bottom: 52px; text-align: center; font-size: 13px; line-height: 31px; height: 32px; border-radius: 100px; z-index: 100; ">Solicite um orçamento via Whatsapp</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Servico Modal 3-->
        <div class="portfolio-modal modal fade" id="servicoModal3" tabindex="-1" aria-labelledby="servicoModal3" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header border-0"><button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button></div>
                    <div class="modal-body text-center pb-5">
                        <div class="container">
                            <div class="row justify-content-center">
                                <div class="col-lg-8">
                                    <h2 class="portfolio-modal-title text-secondary text-uppercase mb-0">Instalação</h2>
                                    <div class="divider-custom">
                                        <div class="divider-custom-line"></div>
                                        <div class="divider-custom-icon"><i class="fa-solid fa-faucet-drip"></i></div>
                                        <div class="divider-custom-line"></div>
                                    </div>
                                
                                    <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="images/servico-instalacao/foto1.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto2.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto3.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto4.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto7.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto8.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto9.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto10.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <div class="carousel-item">
                                                <img src="images/servico-instalacao/foto11.jpg" class="img-fluid rounded mb-5 img-servico3" alt="...">
                                            </div>
                                            <!--Vídeo <Slide key="12">
                                            <div class="carousel-item">
                                                <video width="700" height="700" controls>
                                                    <source src="images/servico-instalacao/video3.mp4" type="video/mp4">
                                                    Seu navegador não suporta a tag de vídeo.
                                                </video>
                                            </div>
                                            </Slide>-->
                                        </div>
                                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Previous</span>
                                        </button>
                                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="visually-hidden">Next</span>
                                        </button>
                                    </div>
                                    <p class="mb-4" style="margin-bottom: 4.5rem !important; margin-top:20px;">Trabalhamos com instalação de Najas, Traves, Projetos, residenciais e comerciais entre outros.</p>
                                    <!-- START Widget WhastApp -->
                                    <div class="text-center">
                                        <a href="https://api.whatsapp.com/send?phone=5551999446655&text=Olá!%20Gostaria%20de%20mais%20informações%20sobre%20esse%20serviço" class="bt-whatsApp" target="_blank" style="right:39%; position: absolute; width:60px;height:60px;bottom:40px;z-index:100;">
                                            <img src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pjxzdmcgdmlld0JveD0iMjYxOSA1MDYgMTIwIDEyMCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZGVmcz48c3R5bGU+CiAgICAgIC5jbHMtMSB7CiAgICAgICAgZmlsbDogIzI3ZDA0NTsKICAgICAgfQoKICAgICAgLmNscy0yLCAuY2xzLTUgewogICAgICAgIGZpbGw6IG5vbmU7CiAgICAgIH0KCiAgICAgIC5jbHMtMiB7CiAgICAgICAgc3Ryb2tlOiAjZmZmOwogICAgICAgIHN0cm9rZS13aWR0aDogNXB4OwogICAgICB9CgogICAgICAuY2xzLTMgewogICAgICAgIGZpbGw6ICNmZmY7CiAgICAgIH0KCiAgICAgIC5jbHMtNCB7CiAgICAgICAgc3Ryb2tlOiBub25lOwogICAgICB9CiAgICA8L3N0eWxlPjwvZGVmcz48ZyBkYXRhLW5hbWU9Ikdyb3VwIDM2IiBpZD0iR3JvdXBfMzYiIHRyYW5zZm9ybT0idHJhbnNsYXRlKDIzMDAgNzMpIj48Y2lyY2xlIGNsYXNzPSJjbHMtMSIgY3g9IjYwIiBjeT0iNjAiIGRhdGEtbmFtZT0iRWxsaXBzZSAxOCIgaWQ9IkVsbGlwc2VfMTgiIHI9IjYwIiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgzMTkgNDMzKSIvPjxnIGRhdGEtbmFtZT0iR3JvdXAgMzUiIGlkPSJHcm91cF8zNSIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoMjU0IDM4NikiPjxnIGRhdGEtbmFtZT0iR3JvdXAgMzQiIGlkPSJHcm91cF8zNCI+PGcgY2xhc3M9ImNscy0yIiBkYXRhLW5hbWU9IkVsbGlwc2UgMTkiIGlkPSJFbGxpcHNlXzE5IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSg5NCA3NSkiPjxjaXJjbGUgY2xhc3M9ImNscy00IiBjeD0iMzEuNSIgY3k9IjMxLjUiIHI9IjMxLjUiLz48Y2lyY2xlIGNsYXNzPSJjbHMtNSIgY3g9IjMxLjUiIGN5PSIzMS41IiByPSIyOSIvPjwvZz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik0xNDI0LDE5MWwtNC42LDE2LjMsMTYuOS00LjcuOS01LjItMTEsMy41LDIuOS0xMC41WiIgZGF0YS1uYW1lPSJQYXRoIDEyNiIgaWQ9IlBhdGhfMTI2IiB0cmFuc2Zvcm09InRyYW5zbGF0ZSgtMTMyNSAtNjgpIi8+PHBhdGggY2xhc3M9ImNscy0xIiBkPSJNMTI2Niw5MGMwLS4xLDMuNS0xMS43LDMuNS0xMS43bDguNCw3LjlaIiBkYXRhLW5hbWU9IlBhdGggMTI3IiBpZD0iUGF0aF8xMjciIHRyYW5zZm9ybT0idHJhbnNsYXRlKC0xMTY1IDQzKSIvPjwvZz48cGF0aCBjbGFzcz0iY2xzLTMiIGQ9Ik0xNDM5LjMsMTYwLjZhOS40LDkuNCwwLDAsMC0zLjksNi4xYy0uNSwzLjksMS45LDcuOSwxLjksNy45YTUwLjg3Niw1MC44NzYsMCwwLDAsOC42LDkuOCwzMC4xODEsMzAuMTgxLDAsMCwwLDkuNiw1LjEsMTEuMzc4LDExLjM3OCwwLDAsMCw2LjQuNiw5LjE2Nyw5LjE2NywwLDAsMCw0LjgtMy4yLDkuODUxLDkuODUxLDAsMCwwLC42LTIuMiw1Ljg2OCw1Ljg2OCwwLDAsMCwwLTJjLS4xLS43LTcuMy00LTgtMy44cy0xLjMsMS41LTIuMSwyLjYtMS4xLDEuNi0xLjksMS42LTQuMy0xLjQtNy42LTQuNGExNS44NzUsMTUuODc1LDAsMCwxLTQuMy02cy42LS43LDEuNC0xLjhhNS42NjQsNS42NjQsMCwwLDAsMS4zLTIuNGMwLS41LTIuOC03LjYtMy41LTcuOUExMS44NTIsMTEuODUyLDAsMCwwLDE0MzkuMywxNjAuNloiIGRhdGEtbmFtZT0iUGF0aCAxMjgiIGlkPSJQYXRoXzEyOCIgdHJhbnNmb3JtPSJ0cmFuc2xhdGUoLTEzMjYuMzMyIC02OC40NjcpIi8+PC9nPjwvZz48L3N2Zz4=" alt="" width="60px">
                                        </a>
                                        <span id="alertWapp" style="right:435px; visibility: hidden; position:absolute;	width:17px;	height:17px;bottom:90px; background:red;z-index:101; font-size:11px;color:#fff;text-align:center;border-radius: 50px; font-weight:bold;line-height: normal; "> 1 </span>
                                        <div id="msg1" style="right: 45%; visibility: visible; background: #1EBC59; color: #fff; position: absolute; width: 200px; bottom: 52px; text-align: center; font-size: 13px; line-height: 31px; height: 32px; border-radius: 100px; z-index: 100; ">Solicite um orçamento via Whatsapp</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Botão whatsapp-->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
        <a href="https://api.whatsapp.com/send?phone=5551999446655&text=Olá+é+da+Hornet+Bier?" target="_blank">
            <div class="btn-whatsapp pulsaDelay"><i class="fab fa-whatsapp"></i></div>
        </a>
     
        <script src="js/site.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
        
    </body>
</html>