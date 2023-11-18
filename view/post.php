<!DOCTYPE html>
<html>

<head>
  <title>Mapa de postagens</title>
  <meta charset="UTF-8">
  <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
    integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="shortcut icon" href="img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="css/post.css" />
</head>

<body>
  <div id="loader">
    <div class="spinner"></div>
  </div>

  <header>
    <div class="logout">
      <a href="logout">
        <i class="material-icons">exit_to_app</i>Sair
      </a>
    </div>

    <div class="logo">
      <a href="menu">
        <img src="img/vizin.io.png" width="100px" />
      </a>
    </div>
  </header>

  <div id="content">
    <p style='font-size:14px'>Clique nos marcadores em laranja para visualizar os posts já incluídos ou em qualquer
      lugar do mapa para incluir um novo post.</p>
    <div id="map"></div>
  </div>

  <div id="sidebar">
    <i id="close-sidebar" class="material-icons">close</i>

    <div id='div-novo'>
      <div class="form-group">
        <i class="material-icons">place</i>
        <span id='place'></label>
      </div>

      <form id='novo-post' action='post/add'>
        <label for="local">Local:</label>
        <input type="text" id="local" name="local">

        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required>

        <label for="assunto">Assunto:</label>
        <input type="text" id="assunto" name="assunto" required>

        <label for="descricao">Descrição:</label>
        <textarea id="descricao" name="descricao" required></textarea>

        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">

        <button type="submit">Salvar</button>
      </form>
    </div>
  </div>

  <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
    integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
  <script src="js/post.js"></script>
</body>

</html>