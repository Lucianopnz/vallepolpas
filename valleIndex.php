<!DOCTYPE html>
<html lang="pt-br">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <title>Valle Polpas</title>

    <style>
    .container-fluid{
      background: #dde1e7;
      height: 50px;
    }

    .barra{
      background: #00e600;
      height: 10px;
      margin: 0;
    }

    #cards{
      background: #dde1e7;
      border-radius: 10px;
      box-shadow: -5px -5px 20px #ffffff73,
                  5px 5px 20px rgba(94,104,121,0.288);
    }
    </style>

  </head>

  <body>

    <div class="container-fluid static-top">
      <div class="row">
        <img src="imagens/Logo.png" width="70px;" height="50px;" alt="">

        <ul class="navbar-nav ml-auto mt-2">
          <!-- Log out -->
          <li class="nav-item dropdown no-arrow mx-1">
            <a class="btn btn-dark btn-sm" href="con_logout.php" >
              <span class="glyphicon glyphicon-log-out"></span> Sair
            </a>
          </li>
        </ul>
      </div>


    </div>
    <div class="barra">

    </div>

    <div class="container">

      <div class="row">
        <div class="col-sm-4 mt-3">
          <div class="card" id="cards">
            <div class="card-body">
              <h5 class="card-title">Insumos</h5>
              <p class="card-text">Entrada de insumos, Frutas/Polpas.</p>
              <a href="valleInsumos.php" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-3">
          <div class="card" id="cards">
            <div class="card-body">
              <h5 class="card-title">Operação</h5>
              <p class="card-text">Processo de produção.</p>
              <a href="#" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
        <div class="col-sm-4 mt-3">
          <div class="card" id="cards">
            <div class="card-body">
              <h5 class="card-title">Controle</h5>
              <p class="card-text">Demanda, estoque, controles.</p>
              <a href="#" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>
      </div>

    </div>

    <div class="container">

      <div class="row">
        <div class="col-sm-6 mt-3">
          <!-- <h2>Insumos</h2> -->

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Lote</th>
        <th>Data</th>
        <th>Fruta/Polpa</th>
        <th>Selecionar</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>GH75656</td>
        <td>10/05/2020</td>
        <td>GOIABA</td>
        <td><button class="btn btn-success">Selecionar</button></td>
      </tr>
      <tr>
        <td>JH6665</td>
        <td>12/05/2020</td>
        <td>MANGA</td>
        <td><button class="btn btn-success">Selecionar</button></td>
      </tr>
      <tr>
        <td>KJ767676</td>
        <td>15/05/2020</td>
        <td>POLPA DE CAJU</td>
        <td><button class="btn btn-success">Selecionar</button></td>
      </tr>
    </tbody>
  </table>
        </div>
        <div class="col-sm-6 mt-3">
          <div class="card" id="cards">
            <div class="card-body">
              <h5 class="card-title">Operação</h5>
              <p class="card-text">Iniciar processo de produção.</p>
              <a href="#" class="btn btn-primary">Acessar</a>
            </div>
          </div>
        </div>

      </div>

    </div>





  </body>

  </html>
