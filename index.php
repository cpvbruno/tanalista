<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, user-scalable=no">
  <title>Ta na Lista ?</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.5/paper/bootstrap.min.css" rel="stylesheet">
    <link href="CSS/style.css" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-65856438-1', 'auto');
    ga('send', 'pageview');

  </script>

  <script>
function load() {
    $.ajaxPrefilter( function (options) {
    if (options.crossDomain && jQuery.support.cors) {
      var http = (window.location.protocol === 'http:' ? 'http:' : 'https:');
      options.url = http + '//cors-anywhere.herokuapp.com/' + options.url;
      //options.url = "http://cors.corsproxy.io/url=" + options.url;
    }
  });
  num = $("#num").val();
  url = $("#link").val();
  name = $("#name").val();
  found = 0;
  findNum = 0;
  isLoading = 0;
  url = url.replace("#comments","").replace("&cpage=","") + "&cpage=";
  i =1;

  function tryGet(i) {
      $.get(
          url + i + '#comments',
          function (response) {
            //  console.log("> ", response);
             $("#viewer").html(response);

            $(".comment-body:contains('"+ name +"')").each(function() {
                  $("#qtd").text("TÁ ! Encontramos esta pessoa na lista !");
                  $('#modal').modal('show');
                  found = 1;
                  i = num;
                  $(".ld").fadeOut();

            })

            $("#viewer").html("");

      })
      .done(function() {
        if(found == 0) {
          if(i <= num) {
            tryGet(i+1);
          }
          else {
              $(".ld").fadeOut();
              $("#qtd").text("TÁ NADA !");
              $('#modal').modal('show');
          }
        }
        else {
            $(".ld").fadeOut();
        }
      });
    }




  if($.isNumeric(num)) {
    $(".ld").fadeIn();

    tryGet(i);



  }
  else {
    alert("Digite um número de páginas");
  }
}
function closeLoader() {
  $(".ld").fadeOut();
}
  </script>


</head>
<body>
  <div class="loaderOverlay ld"></div>
  <div class="loader ld"><img src="img/loader.GIF" width="25px" />
  <p>Isso pode levar algum tempo , estamos consultando a lista.
  </p></div>
  <!-- Modal -->
  <div id="modal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onclick="closeLoader()">&times;</button>
          <h4 class="modal-title">Resultado:</h4>
        </div>
        <div class="modal-body">
          <div type="text" id="qtd">
            <p id="qtd">TÁ NADA !
            </p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeLoader()">Fechar</button>
        </div>
      </div>

    </div>
  </div>
  <div id="modalInfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" onclick="closeLoader()">&times;</button>
          <h4 class="modal-title">Atenção:</h4>
        </div>
        <div class="modal-body">
          Dunluce Irish Pub não tem nenhuma relação com esta aplicação. "Ta na Lista?" foi desenvolvido para auxílio a busca por colegas na lista do Dunluce.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal" onclick="closeLoader()">Fechar</button>
        </div>
      </div>

    </div>
  </div>

  <div class="card">
    <div style="
    width: 100%;
    text-align: center;
">
    <img src="img/logo.jpg" style="
    width: 80%;
">
  </div>
    <div class="form-group">

  </div>
  <div class="form-group">
  <input type="text" placeholder="Digite um nome..." id="name" class="form-control" required />
</div>
    <div class="form-group">
    <input type="text" placeholder="Link do evento do dia escolhido" id="link" class="form-control" required />
  </div>
  <div class="form-group">
  <input type="number" placeholder="Número de páginas que deseja inspecionar" required tooltip="Quantidade de páginas que iremos analisar para você" id="num" class="form-control" />
</div>
  <div class="alert  alert-warning">

  <h4>Atenção!</h4>
  <p>Insira o link do anuncio correto, que é a página onde encontram-se o anuncio juntamente aos comentários.</p>
  <p>ex: http://www.dunlucepub.com/?p=14477#comments</p>
</div>



  <a class="btn btn-primary pull-right" onclick="load()">Será que ta ?</a>
  <div class="clearfix"></div>

<div id="viewer" style="display:none !important" >

</div>

<div class="infobtn">
  <a href="#" data-target="#modalInfo" data-toggle="modal">
  <svg height="22px" version="1.1" viewBox="0 0 22 22" width="22px" xmlns="http://www.w3.org/2000/svg" xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" xmlns:xlink="http://www.w3.org/1999/xlink"><title/><defs><path d="M0,11 C0,4.92486745 4.92486745,0 11,0 C17.0751325,0 22,4.92486745 22,11 C22,17.0751325 17.0751325,22 11,22 C4.92486745,22 0,17.0751325 0,11 L0,11 Z M11.25,7.5 C11.940356,7.5 12.5,6.94035595 12.5,6.25 C12.5,5.55964405 11.940356,5 11.25,5 C10.559644,5 10,5.55964405 10,6.25 C10,6.94035595 10.559644,7.5 11.25,7.5 L11.25,7.5 Z M8.5,8.5 L8.5,9.5 L10,9.5 L10,16.5 L8.5,16.5 L8.5,17.5 L14,17.5 L14,16.5 L12.5,16.5 L12.5,8.5 L8.5,8.5 L8.5,8.5 Z" id="path-1"/></defs><g fill="none" fill-rule="evenodd" id="miu" stroke="none" stroke-width="1"><g id="circle_info_more-information_detail_glyph"><use fill="#000000" fill-rule="evenodd" xlink:href="#path-1"/><use fill="none" xlink:href="#path-1"/></g></g></svg>
</a>
</div>



</body>
</html>
