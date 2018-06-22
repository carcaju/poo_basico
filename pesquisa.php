

<div class="container">    
        
        <div id="signupbox" style=" margin-top:50px" class="mainbox col-md-10 col-md-offset-2 col-sm-10 col-sm-offset-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <div class="panel-title">Pesquisa</div>
                    <div style="float:right; font-size: 85%; position: relative; top:-10px"></div>
                </div>  
                <div class="panel-body" >
                    <form method="post" action=".">
                        <div id="div_id_gender" class="form-group required">


<?php

foreach($perguntas as $pergunta) {

    $idpergunta = $pergunta['idpergunta'];
    $textopergunta = $pergunta['pergunta'];

    $respostas = $dados->lista_respostas($idpergunta);
    ?>
                            <label for="id_gender"  class="control-label col-md-4  requiredField"><?php echo $textopergunta; ?></label>

        <?php
            foreach($respostas as $resposta) {
                $idresposta = $resposta['idresposta'];
                $textoresposta = $resposta['resposta'];
                ?>

                            <div class="controls col-md-8 "  style="margin-bottom: 10px">
                                <label class="radio-inline"> <input type="radio" name="resposta<?php echo $idpergunta;?>" value="<?php echo $idresposta;?>"><?php echo $textoresposta; ?></label>
                            </div>
                <?php 
                }
                ?>
            <?php
            }
            ?>
                           </div>
                        <div class="form-group"> 
                            <div class="aab controls col-md-4 "></div>
                            <div class="controls col-md-8 ">
                            <button class="btn btn-primary" type="submit">Enviar</button>
                            </div>
                        </div> 
                    </form>
                </div>
            </div>
        </div> 
    </div>
</div>   

<a href="index.php?modulo=resultado">Veja o resultado</a>


