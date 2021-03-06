<?php
    include_once("./verifica.php");
	include_once("./config/config.php");
    include_once("./menu.php");

    $min = 0;
    $option_min = "";
    while ($min <= 60) {
        $option_min .= "<option value=".str_pad($min,2,'0', STR_PAD_LEFT).">".str_pad($min,2,'0', STR_PAD_LEFT)."</option>\n";
        $min++;
    }
?>

<!doctype html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Página Inicio">
    <meta name="author" content="Miqueias Matias Caetano">
    <meta name="keywords" content="Página Inicio">
    <meta content="pt-br, pt, en" http-equiv="Content-Language">
    <meta name="revised" content="2019-01-28">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/stylesheet.css">
    <link rel="stylesheet" href="fontawesome-free-5.6.3-web/css/all.css">
    <link rel="stylesheet" href="css/jquery-ui.css">

    <!-- Optional Google Fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700">

    <!-- Optional JavaScript -->
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mask.js"></script>
    <script src="js/jquery-ui.js"></script>

    <script type="text/javascript">
        function removeEmail(i){
            $('#linha'+i).remove();
        }
        $( document ).ready(function() {
            var num_email = 0;
            $('#maisemail').click(function(){
                num_email++;
                $('#grupoemail').append(
                    '<div style="margin-bottom:10px" class="input-group flex-nowrap" id="linha'+num_email+'">'+
                      '<div class="input-group-prepend">'+
                        '<span onClick="removeEmail('+num_email+')" style="cursor:pointer" title="Excluir" class="input-group-text"><i class="fas fa-trash-alt"></i></span>'+
                      '</div>'+
                        '<input linha="'+num_email+'" type="text" class="form-control destinatario" id="email_destinatario'+num_email+'" placeholder="name@example.com">'+
                        '<input name="destinatario[]" type="hidden" class="form-control" id="iddestinatario'+num_email+'">'+
                    '</div>'
                );

                $("#email_destinatario"+num_email).autocomplete({
                    source: "./json_busca_destinatario.php?token_user=<?=$_SESSION['token_user'];?>",
                    minLength: 2,
                    select: function( event, ui ) {
                        $('#iddestinatario'+num_email).val(ui.item.id);
                        $(this).val(ui.item.value);
                    }
                });
            });

            var num_gpo = 0;
            $('#maisgrupo').click(function(){
                num_gpo++;
                $('#grupoDestinatario').append(
                    '<div style="margin-bottom:10px" class="input-group flex-nowrap" id="linha'+num_gpo+'">'+
                      '<div class="input-group-prepend">'+
                        '<span onClick="removeEmail('+num_gpo+')" style="cursor:pointer" title="Excluir" class="input-group-text"><i class="fas fa-trash-alt"></i></span>'+
                      '</div>'+
                        '<input linha="'+num_gpo+'" type="text" class="form-control grupo" id="nome_grupo'+num_gpo+'">'+
                        '<input name="grupo[]" type="hidden" class="form-control" id="idgrupo'+num_gpo+'">'+
                    '</div>'
                );

                $("#nome_grupo"+num_gpo).autocomplete({
                    source: "./json_busca_grupo_destinatario.php?token_user=<?=$_SESSION['token_user'];?>",
                    minLength: 1,
                    select: function( event, ui ) {
                        $('#idgrupo'+num_gpo).val(ui.item.id);
                        $(this).val(ui.item.value);
                    }
                });
            });

            $('.data').mask('99/99/9999');

            $('.data').css('text-align','center');

            $('.data').datepicker({
                dateFormat: 'dd/mm/yy',
                nextText: 'Próximo Mês',
                prevText: 'Mês Anterior',
                changeYear: true,
                yearRange: '2019:2100',
            });

            $('.horario').mask('99:99');

            $('.horario').css('text-align','center');

            bkLib.onDomLoaded(function() { nicEditors.allTextAreas() }); // convert all text areas to rich text editor on that page

            bkLib.onDomLoaded(function() {
                 new nicEditor({fullPanel : true}).panelInstance('mensagem');
            }); // convert text area with id area2 to rich text editor with full panel.


            $("#email_destinatario0").autocomplete({
                source: "./json_busca_destinatario.php?token_user=<?=$_SESSION['token_user'];?>",
                minLength: 2,
                select: function( event, ui ) {
                    $('#iddestinatario0').val(ui.item.id);
                    $(this).val(ui.item.value);
                }
            });

            $("#nome_grupo0").autocomplete({
                source: "./json_busca_grupo_destinatario.php?token_user=<?=$_SESSION['token_user'];?>",
                minLength: 1,
                select: function( event, ui ) {
                    $('#idgrupo0').val(ui.item.id);
                    $(this).val(ui.item.value);
                }
            });

      
        });
    </script>


    <title>MESSENGER HERMES</title>
  </head>
  <body>
    <div id="cabecalho_titulo">
        <div id="titulos">            
            CADASTRAR&nbsp;E-MAIL
        </div>            
    </div>
    <br>

    <div id="conteudo_sistema">

        <form method=post name='form' id='form' enctype='multipart/form-data' action="register_messenger.php">
            <input type="hidden" name="token_user" value="<?=$_SESSION['token_user']?>">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-4">                        
                        <label for="datainicio"><a class="minimo">Data de Envio</a></label>
                        <input name="data_inicio" type="text" class="form-control data" id="datainicio" placeholder="DD/MM/AAAA" required>
                    </div>
                    <!--<div class="col-md-4">                        
                        <label for="datafinal">Data Final de Envio</label>
                        <input name="data_final" type="text" class="form-control data" id="datafinal" placeholder="DD/MM/AAAA" required>
                    </div>-->
                    <div class="col-md-4">                        
                        <label for="horario"><a class="minimo">Horário de Envio</a></label>
                        <div class="row">
                            <div class="col-md-4">                                
                                <select class="form-control" id="hora" name="hora">
                                    <option value="00">00</option>
                                    <option value="01">01</option>
                                    <option value="02">02</option>
                                    <option value="03">03</option>
                                    <option value="04">04</option>
                                    <option value="05">05</option>
                                    <option value="06">06</option>
                                    <option value="07">07</option>
                                    <option value="08">08</option>
                                    <option value="09">09</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                    <option value="13">13</option>
                                    <option value="14">14</option>
                                    <option value="15">15</option>
                                    <option value="16">16</option>
                                    <option value="17">17</option>
                                    <option value="18">18</option>
                                    <option value="19">19</option>
                                    <option value="20">20</option>
                                    <option value="21">21</option>
                                    <option value="22">22</option>
                                    <option value="23">23</option>
                                </select>
                            </div>                              
                            <div class="col-md-4">                                
                                <select class="form-control" id="minuto" name="minuto">
                                    <?=$option_min?>
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <div class="col-md-4"> 
                        <div class="form-group">
                            <label for="exampleFormControlInput0"><a class="minimo">Assunto</a></label>
                            <input name="assunto" type="text" class="form-control" id="exampleFormControlInput0" placeholder="Digite aqui o assunto do e-mail..." required>
                        </div>
                    </div>                                       
                </div>
            </div>

            <div class="form-group">
               <!-- <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> -->

                <script type="text/javascript" src="js/nicEdit-latest.js"></script> 
                <script type="text/javascript">
                //<![CDATA[
                        bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
                  //]]>
                  </script>
                <label for="mensagem"><a class="minimo">Mensagem</a></label>
                <textarea name="mensagem" class="form-control" id="mensagem" rows="10"></textarea>
            </div>

            <div id="grupoemail">
              <div class="form-group">
                <label for="destinatario0"><a class="minimo">Destinatário</a></label>

                <input type="text" linha='0' class="form-control destinatario" id="email_destinatario0" placeholder="name@example.com">

                <input type="hidden" name="destinatario[]" class="form-control" id="iddestinatario0">
              </div>
            </div>

            <div id="grupoDestinatario">
              <div class="form-group">
                <label for="grupo0"><a class="minimo">Grupos</a></label>

                <input type="text" linha='0' class="form-control grupo" id="nome_grupo0">

                <input type="hidden" name="grupo[]" class="form-control" id="idgrupo0">
              </div>
            </div>
            <center>                
                <button style="margin-top: 10px" title="Adicionar E-mail" id="maisemail" class="pequeno_botao" type="button"><i class="fas fa-plus-circle"></i> Adicionar E-mail</button>
                <button style="margin-top: 10px" title="Adicionar Grupo" id="maisgrupo" class="pequeno_botao" type="button"><i class="fas fa-plus-circle"></i> Adicionar Grupo</button>

                <button style="margin-top: 10px" title="Enviar" id="enviar" class="pequeno_botao" type="submit"><i class="fas fa-check-circle"></i> Enviar</button>
            </center>
        </form>
            	
    </div>
    <br>
    <br>
    <br>



  </body>
</html>