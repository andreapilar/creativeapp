<?php
var_dump();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <title>Videos </title>

    <link href="css/bootstrap.css" rel="stylesheet" />
    <link href="css/coming-sssoon.css" rel="stylesheet" />

    <!--     Fonts     -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Grand+Hotel' rel='stylesheet' type='text/css'>
    <style>

    </style>
</head>

<body>
<nav class="navbar navbar-transparent navbar-fixed-top menu_videos" role="navigation">
    <div class="container">
        <input type="hidden" name="" class="id_session">
        <input type="hidden" name="" class="type_test" value="pre_test">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="dropdown ">
                    <a href="#" class="dropdown-toggle menu_videos_select" data-toggle="dropdown">

                        Videos
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
<!--                        <li data_video="https://www.youtube-nocookie.com/embed/Rn8Wyqxr3fM" data_time="5"><a href="#"><img src=""/> Amarillo</a></li>-->
<!--                        <li data_video="https://www.youtube-nocookie.com/embed/LyM1iVcjRVA" data_time="5"><a href="#"><img src=""/> Rojo</a></li>-->
<!--                        <li data_video="https://www.youtube-nocookie.com/embed/AvC4SBQ3z8o" data_time="5"><a href="#"><img src=""/> Naranja</a></li>-->

                        <li data_video="https://www.youtube.com/embed/GElrhuRvXTg" data_time="628"><a href="#"><img src=""/> Amarillo</a></li>
                        <li data_video="https://www.youtube.com/embed/k4IYOPTKYlM" data_time="628"><a href="#"><img src=""/> Rojo</a></li>
                        <li data_video="https://www.youtube.com/embed/QJNoYqfBjMM" data_time="628"><a href="#"><img src=""/> Naranja</a></li>


                    </ul>
                </li>

            </ul>
            <!--      <ul class="nav navbar-nav navbar-right">-->
            <!--            <li>-->
            <!--                <a href="#"> -->
            <!--                    <i class="fa fa-facebook-square"></i>-->
            <!--                    Share-->
            <!--                </a>-->
            <!--            </li>-->
            <!--             <li>-->
            <!--                <a href="#"> -->
            <!--                    <i class="fa fa-twitter"></i>-->
            <!--                    Tweet-->
            <!--                </a>-->
            <!--            </li>-->
            <!--             <li>-->
            <!--                <a href="#"> -->
            <!--                    <i class="fa fa-envelope-o"></i>-->
            <!--                    Email-->
            <!--                </a>-->
            <!--            </li>-->
            <!--       </ul>-->

        </div><!-- /.navbar-collapse -->
    </div><!-- /.container -->
</nav>
<div class="main" style="background-image: url('images/fondo.jpg');">

    <iframe id="video_background" width="560" height="315" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

    <!--    Change the image source '/images/default.jpg' with your favourite image.     -->

    <div class="cover black" data-color="black"></div>

    <!--   You can change the black color for the filter with those colors: blue, green, red, orange       -->

    <div class="container ">
        <h1 class="logo cursive elementos_adicionales">
            Desarrolla Habilidades Creativas
        </h1>
        <!--  H1 can have 2 designs: "logo" and "logo cursive"           -->
        <input type="button" value="POST TEST" class="post_test btn-danger btn btn-lg fixed-plugin elementHide">
        <div class="content">

            <h4 class="motto elementos_adicionales">En esta aplicaci??n podr?? desarrollar sus habilidades creativas desde la inmersi??n virtual</h4>
            <div class="subscribe elementos_adicionales">
                <h5 class="info-text ">

                    Por favor Llene los siguientes datos para continuar.
                </h5>
                <div class="row contenedor_formulario_1">

                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">

                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Nombre</label>
                            <input type="email" class="form-control transparent NameClient" placeholder="Tu nombre aqu??">
                        </div>


                    </div>

                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Apellido</label>
                            <input type="email" class="form-control transparent ApellClient" placeholder="Tu apellido  aqu??">
                        </div>


                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">celular</label>
                            <input type="email" class="form-control transparent phoneTable" placeholder="Tu celular aqu??">
                        </div>


                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Edad</label>
                            <input type="email" class="form-control transparent edad" placeholder="Tu edad aqu??">
                        </div>


                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <label class="color_blanco" for="exampleInputEmail2">Seleccion genero</label>
                            <select name="" class="form-control transparent genero" id="">
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                            </select>
                        </div>


                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">Correo</label>
                            <input type="email" class="form-control transparent correo" placeholder="Tu correo aqu??">
                        </div>


                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-fill jsBtnCreateClient">Resgistrarme</button>
                        </div>


                    </div>



                </div>
                <div class="row contenedor_formulario_2 elementHide">

                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">

                        <div class="form-group">
                            <hr>
                            <label  for="exampleInputEmail2" class="color_blanco"><b>Pregunta 1:</b> Descargue el siguiente archivo</label>
                            <a href="images/test3.pdf" download="" class="">Descargar plantilla</a>
                        </div>


                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">

                        <div class="form-group">
                            <form  method="post" enctype="multipart/form-data">
                                <label  for="exampleInputEmail2" class="color_blanco">Suba el archivo con los requisitos realizados</label>
                                <input type="file" name="" id="JSFile_1">
                            </form>
                        </div>


                    </div>

                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <hr>
                        <div class="form-group">
                            <label class="color_blanco " for="exampleInputEmail2"><b>Pregunta 2:</b> En 5 minutos invente usted t??tulos adecuados para la siguiente historia:
                                Un hombre extremadamente celoso y bastante mayor, tanto que su edad doblaba la de su
                                mujer, encontr?? un m??dico cirujano que fue capaz de regresar su figura a una apariencia de
                                la mitad de sus a??os. pero la mujer sin conocer la decisi??n de su marido al mismo tiempo
                                para tranquilizar a su esposo, se hizo una cirug??a de envejecimiento corporal. as?? que el
                                hombre quedo ahora con la apariencia de la mitad de los a??os de su esposa y la mujer con
                                apariencia de tanta que doblaba la edad de su marido y parec??a ser su madre</label>
                        </div>
                    </div>

                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">T??tulo
                            1</label><input type="text" name="" id="" class="form-control transparent titulos_input"
                                            placeholder="T??tulo 1">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">T??tulo
                            2</label><input type="text" name="" id="" class="form-control transparent titulos_input"
                                            placeholder="T??tulo 2">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">T??tulo
                            3</label><input type="text" name="" id="" class="form-control transparent titulos_input"
                                            placeholder="T??tulo 3">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">T??tulo
                            4</label><input type="text" name="" id="" class="form-control transparent titulos_input"
                                            placeholder="T??tulo 4">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">T??tulo
                            5</label><input type="text" name="" id="" class="form-control transparent titulos_input"
                                            placeholder="T??tulo 5">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">T??tulo
                            6</label><input type="text" name="" id="" class="form-control transparent titulos_input"
                                            placeholder="T??tulo 6">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <hr>
                        <div class="form-group">
                            <label class="color_blanco" for="exampleInputEmail2"><b>Pregunta 3:</b>
                                Construya en 5 minutos diferentes (alfabetos) a partir de series num??ricos.
                                Convierta las letras en n??meros y construya diferentes alfabetos secretos, de tal manera que
                                solo podr??an ser descifrados teniendo las equivalencias de los n??meros con las letras.
                                Ejemplos: en la fila cod.1 A=1, B= 2, C=3, D=4, Etc. c??d. 2.  Z=1, Y=2, X= 3, W=4, v=5,
                                u=6 etc.; c??d. 3 A=2, B=4, C=6, ETC. Recuerde, conc??ntrese en elaborar los c??digos, no
                                requiere dar ejemplo con frases o palabras. Designe en cada numeral el c??digo num??rico
                                con varias de sus equivalencias con el alfabeto
                            </label>
                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 1</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 1">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 2</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 2">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 3</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 3">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 4</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 4">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 5</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 5">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 6</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 6">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 7</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 7">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 8</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 8">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 9</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 9">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 10</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 10">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 11</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 11">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 12</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 12">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 13</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 13">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 14</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 14">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <br>
                        <label for="" class="sr-only">C??digo 15</label>
                        <input type="text" name="" id="" class="form-control transparent codigo_input"
                               placeholder="C??digo 15">
                    </div>


                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3">
                        <hr>
                        <img src="images/pregunta_4.jpeg" class="img img-thumbnail img img-responsive" alt="">
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <div class="form-group">
                            <br>
                            <label class="color_blanco" for="exampleInputEmail2"><b>De que se trata la imagen?</b></label>
                            <textarea type="text" name="" cols="12" id="" class="form-control transparent descripcion"
                                      placeholder="Respuesta"></textarea>

                        </div>
                    </div>
                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <div class="form-group">
                            <br>
                            <label class="color_blanco" for="exampleInputEmail2"><b>Que consecuencias tendr??a.</b></label>
                            <textarea type="text" name="" cols="12" id="" class="form-control transparent descripcion"
                                      placeholder="Respuesta"></textarea>

                        </div>
                    </div>


                    <div class="col-md-4 col-md-offset-4 col-sm6-6 col-sm-offset-3 ">
                        <br>
                        <div class="form-group">
                            <button type="button" class="btn btn-danger btn-fill js_pre_text">Env??ar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--    <div class="footer ">-->
    <!--        <div class="container">-->
    <!--           Desaarrollado por Ivan-->
    <!--        </div>-->
    <!--    </div>-->
</div>
</body>

<script src="js/jquery-1.10.2.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<!--<script src="js/notify.js" type="text/javascript"></script>-->
<script src="js/bootstrap-notify.js" type="text/javascript"></script>
<script src="js/companyClientCrudScripts.js" type="text/javascript"></script>
<script src="js/validationDataGeneral.js" type="text/javascript"></script>
</html>

