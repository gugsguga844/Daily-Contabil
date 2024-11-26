<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha384-DyZ88mC6Up2uqS2hKH3A2E7FWO5UVKZ7tkEd3Q8cjgf7DSEf9mBjOeY6OTJ0i0ox" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="icon" type="image/x-icon" href="favicon.ico">
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body style="background-color: #ffffff; color: white; overflow-y: hidden">
    <header>
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #D1972C;">
            
          
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#"> Início <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tutoriais</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Empresas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="#">Cadastrar Empresa</a>
                            <a class="dropdown-item" href="#">Listar Empresas</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">a</a>
                        </div>
                    </li>
                </ul>
                <li class="nav-item dropdown" style="list-style-type: none;">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                        <i class="fa-solid fa-circle-user fa-2xl" style="color: white; font-weight: bold;"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-sm-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Dados Pessoais</a>
                        <a class="dropdown-item" href="#"></a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="login.html" style="color: red">Sair</a>
                    </div>
                </li>
            </div>
        </nav>
    </header>
    <div class="container-fluid">
        <div class="row vh-100">
            <div class="col-md-6 d-flex flex-column justify-content-center align-items-center">
                <div class="card text-center justify-content-center border-0" style="width: 60%; height: 50%">
                    <div class="ratio ratio-16x9">
                        <iframe width="100%" height="300vh" src="https://www.youtube.com/embed/NAMvdbS4lk4" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title" style="color: black;">Como cadastrar uma empresa</h5>
                    </div>
                </div>
                <div class="input-group justify-content-center" style="padding-top: 15vh;">
                    <div class="form-outline">
                        <input type="search" id="form1" class="form-control" style="width: 50vh; height: 5vh" placeholder="O que deseja aprender?"/>
                        <label class="form-label" for="form1">Search</label>
                    </div>
                    <button type="button" class="btn" style="height: 5vh; background-color: #D1972C">
                        <i class="fa-solid fa-magnifying-glass" style="color: #ffffff;"></i>
                    </button>
                </div>
                <a href="#"><span style="color: black; text-decoration: underline;">Acessar Tutoriais</span></a>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-center" style="height: calc(100vh - 3vh)">
                <div class="text-bold card mb-4" style="border-radius: 20px; overflow: hidden; width: 45vw; height: 90vh">
                    <div class="card-header text-white font-weight-bold d-flex justify-content-between align-items-center" style="background-color: #D1972C;">
                        <h5 class="mb-0">Agenda Fiscal - Outubro/2024</h5>
                        <i class="fa-solid fa-plus fa-2xl" style="color: #ffffff;"></i>
                    </div>
                    <div class="card-body text-dark" style="overflow-y: auto;">
                        <ul class="list-group list-group-flush font-weight-bold">
                            <li class="list-group-item" style="border-bottom: 2px solid #ccc;">
                                <span class="btn btn-primary bg-white border-0 text-dark font-weight-bold" data-toggle="collapse" href="#collapseExample1" aria-expanded="false" aria-controls="collapseExample1">
                                    <i class="fa-solid fa-caret-right fa-2xl toggle-icon"></i>
                                        10/10/2024 - EFD-Contribuições
                                </span>
                                <ul class="collapse mt-2 ms-3" id="collapseExample1">
                                    <li>Empresa 1</li>
                                    <li>Empresa 2</li>
                                </ul>
                            </li>
                            <li class="list-group-item" style="border-bottom: 2px solid #ccc;">
                                <span class="btn btn-primary bg-white border-0 text-dark font-weight-bold" data-toggle="collapse" href="#collapseExample2" aria-expanded="false" aria-controls="collapseExample2">
                                    <i class="fa-solid fa-caret-right fa-2xl toggle-icon"></i>
                                        15/10/2024 - DCTFWeb
                                </span>
                                <ul class="collapse mt-2 ms-3" id="collapseExample2">
                                    <li>Empresa 1</li>
                                    <li>Empresa 2</li>
                                </ul>
                            </li>
                            <li class="list-group-item border-bottom" style="border-bottom: 2px solid #ccc;">
                                <span class="btn btn-primary bg-white border-0 text-dark font-weight-bold" data-toggle="collapse" href="#collapseExample3" aria-expanded="false" aria-controls="collapseExample3">
                                    <i class="fa-solid fa-caret-right fa-2xl toggle-icon"></i>
                                        20/10/2024 - Obrigação 3
                                </span>
                                <ul class="collapse mt-2 ms-3" id="collapseExample3">
                                    <li>Empresa 1</li>
                                    <li>Empresa 2</li>
                                </ul>
                            </li>
                            <!-- Continue adicionando obrigações -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>   


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/15c8bda6b4.js" crossorigin="anonymous"></script>
    <script src="/assets/js/application.js"></script>
</body>
</html>