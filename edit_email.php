<?php
    include_once("./config/config.php");
    include_once("./class/class.destinatario.php");
    include_once("./class/class.grupo.php");

    $des = new Destinatario();
    $gpo = new Grupo();


    $destinatarios = $des->buscaDestinatario($id_destinatario, null, null, null, $token_user);
    $gruposDestinatario = $des->buscaGrupoDestinatario(null, $id_destinatario);

    $grupos = $gpo->buscaGrupo(null, null, $token_user);

    $destinatario = $destinatarios[0];

    $options_gpo = "";      
    if($grupos){
        foreach ($grupos as $i) {
            $options_gpo .= '<option value="'.$i['id_grupo'].'">'.$i['nome_grupo'].'</option>\\n';
        }            
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
    <script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script>

    <script type="text/javascript">
        var num_grupo = 0;
        function removeGrupo(i){
            $('#destinatario_grupo'+i).remove();
        }

        $( document ).ready(function() {
            <?php
                if ($gruposDestinatario) {                    
                    foreach ($gruposDestinatario as $key => $row) {
                        echo "$('#grupo".$key."').val('".$row['id_grupo']."');";
                    }
                }
            ?>

            $('#maisgrupo').click(function(){
                num_grupo++;
                $('#grupoDestinatario').append(
                    '<div class="input-group mb-3" id="destinatario_grupo'+num_grupo+'">'+
                      '<div class="input-group-prepend">'+
                        '<button onClick="removeGrupo('+num_grupo+')" style="cursor:pointer" title="Excluir" class="btn btn-outline-secondary" type="button"><i class="fas fa-trash-alt"></i></button>'+
                      '</div>'+
                      '<select name="grupo[]" class="custom-select grupo" id="grupo'+num_grupo+'" aria-label="Example select with button addon">'+
                        '<option value="" selected>SELECIONE</option>'+
                        '<?=$options_gpo?>'+
                      '</select>'+
                    '</div>'
                );
            });

            $('#alterar').click(function(){
                var retorno = true;

                $(".grupo").each(function(){
                    value = $(this).val();
                    if(value == ""){
                        $(this).css('border-color','red');
                        retorno = false;                   
                    }else{
                        $(this).css('border-color','');
                    }
                });

                if ($('#nome_destinatario').val() == '') {
                    $('#nome_destinatario').css('border-color','red');
                    retorno = false;
                }else{
                    $('#nome_destinatario').css('border-color','');
                }

                if ($('#email_destinatario').val() == '') {
                    $('#email_destinatario').css('border-color','red');
                    retorno = false;
                }else{
                    $('#email_destinatario').css('border-color','');
                }            

                if (!retorno) {
                    alert('Existem campos não preenchidos!');
                }
                else{
                    if(confirm('Deseja realmente salvar?')){
                        $("#form").submit();
                        return true;
                    }
                    return false;
                }
            });
        });
    </script>


    <title>MESSENGER HERMES</title>
  </head>
  <body>
    <?php include_once("./menu.php");?>
    <div class="main container">
        <h1>| EDITAR E-MAIL</h1>
        <form method=post name='form' id='form' enctype='multipart/form-data' action="update_email.php">
            <input type="hidden" name="token_user" value="<?=$token_user?>">
            <input type="hidden" name="id_destinatario" value="<?=$id_destinatario?>">

            <div class="form-group">
                <label for="nome_destinatario">Nome</label>
                <input name="nome_destinatario" type="text" class="form-control" id="nome_destinatario" value="<?=$destinatario['nome_destinatario']?>">
            </div>

            <div class="form-group">
                <label for="email_destinatario">E-Mail</label>
                <input type="email" name="email_destinatario" class="form-control" id="email_destinatario" value="<?=$destinatario['email_destinatario']?>">
            </div>
            

            <div id="grupoDestinatario">
                <label for="grupo0">Grupo</label>

                <?php
                    if ($gruposDestinatario) {
                        foreach ($gruposDestinatario as $key => $row) {
                            if ($key == 0) {          
                ?>  
                               <div class="input-group mb-3">
                                  <select name="grupo[]" class="custom-select grupo" id="grupo<?=$key?>">
                                    <option value="" selected>SELECIONE</option>
                                    <?=$options_gpo?>
                                  </select>
                                </div>
                <?php
                            }       
                            else{                                
                ?> 
                                <div class="input-group mb-3" id="destinatario_grupo<?=$key?>">
                                  <div class="input-group-prepend">
                                    <button onClick="removeGrupo('<?=$key?>')" style="cursor:pointer" title="Excluir" class="btn btn-outline-secondary" type="button"><i class="fas fa-trash-alt"></i></button>
                                  </div>
                                  <select name="grupo[]" class="custom-select grupo" id="grupo<?=$key?>" aria-label="Example select with button addon">
                                    <option value="" selected>SELECIONE</option>
                                    <?=$options_gpo?>
                                  </select>
                                </div>
                <?php
                            }
                        }
                    }
                    else{                        
                ?>
                        <div class="input-group mb-3">
                          <select name="grupo[]" class="custom-select grupo" id="grupo0">
                            <option value="" selected>SELECIONE</option>
                            <?=$options_gpo?>
                          </select>
                        </div>
                <?php   
                    }
                ?>
            </div>

            <button title="Adicionar Grupo" id="maisgrupo" class="btn btn-outline-secondary" type="button"><i class="fas fa-plus-circle"></i> Adicionar Grupo</button>
            <button title="Salvar Alteração" id="alterar" class="btn btn-outline-secondary" type="button"><i class="fas fa-check-circle"></i> Salvar Alteração</button>
        </form>            	
    </div>
    <br>
    <br>
    <br>



  </body>
</html>