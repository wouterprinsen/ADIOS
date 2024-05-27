<?php
     //achterhaal op welke knop is gedrukt
	 $focus=0;
	 if(isset($_POST['btn_opdracht1'])) {$focus=1;}
	 if(isset($_POST['btn_opdracht2'])) {$focus=2;}
	 if(isset($_POST['btn_opdracht3'])) {$focus=3;}
	 if(isset($_POST['btn_opdracht4'])) {$focus=4;}
	 if(isset($_POST['btn_opdracht5'])) {$focus=5;}
	 if(isset($_POST['btn_opdracht6'])) {$focus=6;}
	 if(isset($_POST['btn_opdracht7'])) {$focus=7;}
	 if(isset($_POST['btn_opdracht8'])) {$focus=8;}
	 if(isset($_POST['btn_opdracht9'])) {$focus=9;} 
	 
	 if($focus==1)
	 {
	     $url="http://10.0.2.10:5000/opdracht1";
		 $html=file_get_contents($url); 
	 }
	 if($focus==2)
	 {
	     $url="http://10.0.2.10:5000/opdracht2";
		 $html=file_get_contents($url); 
	 }
	 if($focus==3)
	 {
	     $url="http://10.0.2.10:5000/opdracht3";
		 $html=file_get_contents($url); 
	 }
	 if($focus==4)
	 {
	     $url="http://10.0.2.10:5000/opdracht4";
		 $html=file_get_contents($url); 
	 }
	 if($focus==5)
	 {
	     $url="http://10.0.2.10:5000/opdracht5";
		 $html=file_get_contents($url); 
	 }
	 if($focus==6)
	 {
	     $url="http://10.0.2.10:5000/opdracht6/" . $_POST['txt_container'];
		 $html=file_get_contents($url); 
	 }
	 if($focus==7)
	 {
	     $url="http://10.0.2.10:5000/opdracht7/" . $_POST['txt_imagenaam'] . "/"
		                                                                . $_POST['txt_commando'] . "/"
		                                                                . $_POST['txt_hostvolume'] . "/"
		                                                                . $_POST['txt_containervolume'] . "/"
		                                                                . $_POST['txt_hostpoort'] . "/"
		                                                                . $_POST['txt_containerpoort'] . "/"
		                                                                . $_POST['txt_containernaam'] ;
	         $html=file_get_contents($url);	     
	 }
	 if($focus==8)
	 {
             $url="http://10.0.2.10:5000/opdracht8/" . $_POST['txt_username'] . "/"
                                                                                . $_POST['password'] . "/"
										. $_POST['txt_image'] . "/"
										. $_POST['txt_tag'] . "/"
										. $_POST['txt_repository'] ;
                 $html=file_get_contents($url);
	 }
         if($focus==9)
         {
             $url="http://10.0.2.10:5000/opdracht9/" . $_POST['cont_prestatie'];
                 $html=file_get_contents($url);
         }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=<device-width>, initial-scale=1.0">
    <title>DockerDash</title>
    <style>
        /*ALGEMENE SETTINGS*/
        /*=======================================================================*/
        * {box-sizing: border-box; position: relative;}
        html, body, main{margin:0px; width:100%;height:100%; position: relative;}
/*-----------------------------------------------------------------------*/
        section{
            border: 4px solid black;
        }
        main{
            width:100%; height:100%;border: black solid 2px;
            display:grid;
            grid-template-columns:  1fr 1fr 1fr;
            grid-template-rows   :  50px 1fr 1fr  1fr;
        }
        #docker_opdracht_titel{
            background-color: aqua;overflow: auto;
            grid-row: 1/2;grid-column: 1/4;
            text-align: center; font-size: 40px; font-family: fantasy;
        }
        #docker_opdracht2{
            background-color: lightcoral;overflow:auto;
        }
        #docker_opdracht3{
            background-color:lightgoldenrodyellow;overflow: auto;
        }
        #docker_opdracht4{
            background-color:lightsteelblue;overflow: auto;
        }
        #docker_opdracht5{
            background-color:rgb(222, 176, 198);overflow: auto;
        }
        #docker_opdracht6{
            background-color:lawngreen;overflow: auto;
        }
        #docker_opdracht7{
            background-color:blanchedalmond;overflow: auto;
        }
        #docker_opdracht8{
            background-color:lightcyan;overflow: auto;
        }
        #docker_opdracht9{
            background-color:lightsalmon;overflow: auto;
        }
        .koptekst{text-align: center; font-weight: bold; border:1px solid black;}
        .form{border:1px solid black;}
        .output{border:1px solid black;}
        .label7{width: 200px; text-align: right; display: inline-block;margin-bottom: 4px;}
		/* opmaak voor opdracht 1 tabel */
		/* ----------------------------------------------------------------------------------------------------------------------------------------*/
		.tabelopdracht1{border:1px solid black; padding-left:20px;padding-right:20px;width:100%; } 
		.tabelopdracht1 td{border:1px solid black; }
		.tabelopdracht1 th{border:1px solid black;background-color: lightsteelblue; }
		/* ----------------------------------------------------------------------------------------------------------------------------------------*/
    </style>
</head>
<body>
    <main>
        <section id="docker_opdracht_titel">
            BP1: Een DOCKER DASHBOARD
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht1">
            <div class="koptekst">opdr1: overzicht van alle images</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht01" id="opdracht01">
                    <!-- <input type="hidden" id="imagelijst" name="imagelijst" value="haal_image_lijst_op"> 
                    <input type="submit" value="Haal alle images op" name="btn_opdracht1" value="btn_opdracht1"> -->
                    <select id="imagelijst" name="imagelijst" value="haal_image_lijst_op">
                        <option id=></option>                        
                    </select>
                    <input type="submit" value="Haal alle images op" name="btn_opdracht1" value="btn_opdracht1">
                </form>
            </div>
            <div class="output" id="output_opdracht01" >
			<?php
			    if($focus==1) 
			    {
					echo($html);
				}
				else
				{
					echo("output");
				}
			?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht2">
            <div class="koptekst">opdr2: overzicht van alle containers</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht02" id="opdracht02">
                    <input type="hidden" id="containerlijst" name="containerlijst" value="haal_container_lijst_op"> 
                    <input type="submit" value="Haal alle containers op" name="btn_opdracht2" value="btn_opdracht2" >
                </form>
            </div>
            <div class="output" id="output_opdracht02">
			<?php
			    if($focus==2) 
			    {
					echo("$html");
				}
				else
				{
					echo("output");
				}
			?>
            </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht3">
            <div class="koptekst">opdr3: Stop alle lopende containers</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht03" id="opdracht03">
                    <input type="hidden" id="stopcontainers" name="stopcontainers" value="stop_containers"> 
                    <input type="submit" value="Stop alle lopende containers" name="btn_opdracht3" value="btn_opdracht3" >
                </form>
            </div>
            <div class="output" id="output_opdracht03">
			<?php
			    if($focus==3) 
			    {
					echo("$html");
				}
				else
				{
					echo("output");
				}
			?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht4">
            <div class="koptekst">opdr4: Verwijder stilstaande containers</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht04" id="opdracht04">
                    <input type="hidden" id="verwijdercontainers" name="verwijdercontainers" value="verwijder_containers"> 
                    <input type="submit" value="Verwijder alle stilstaande containers" name="btn_opdracht4" value="btn_opdracht4" >
                </form>
            </div>
            <div class="output" id="output_opdracht04">
			<?php
			    if($focus==4) 
			    {
					echo("$html");
				}
				else
				{
					echo("output");
				}
			?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht5">
            <div class="koptekst">opdr5: start een standaard ubuntu container.</br> (docker run -d --name ubu01 ubuntu sleep 1d)</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht05" id="opdracht05">
                    <input type="hidden" id="starcontainer1" name="startcontainer1" value="start_container1"> 
                    <input type="submit" value="Start een ubuntu container" name="btn_opdracht5" value="btn_opdracht5" >
                </form>
            </div>
            <div class="output" id="output_opdracht05">
			<?php
			    if($focus==5) 
			    {
					echo("$html");
				}
				else
				{
					echo("output");
				}
			?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht6">
            <div class="koptekst">opdr6: Verwijder een lopende of stilstaande container op naam</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht06" id="opdracht06">
                    <input type="hidden" id="verwijdercontaineropnaam" name="verwijdercontaineropnaam" value="verwijder_container_opnaam">
                    Container Naam</br>
                    <input type="text" name="txt_container" id="txt_container" width="210px" value="Cnaam"> </br></br>
                    <input type="submit" value="Verwijder container op naam" name="btn_opdracht6" value="btn_opdracht6" >
                </form>
            </div>
            <div class="output" id="output_opdracht06">
			<?php
			    if($focus==6) 
			    {
					echo("$html");
				}
				else
				{
					echo("output");
				}
			?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id="docker_opdracht7">
            <div class="koptekst">opdr7: start een container op basis van de hieronder ingevulde gegevens</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" onsubmit="modifyAndSubmit();" action="" name="opdracht06" id="opdracht07">
                    <input type="hidden" id="startcontainer2" name="startcontainer2" value="start_container2">
                    <span class="label7">Image naam:</span> 
                    <input type="text" name="txt_imagenaam" id="txt_imagenaam" width="210px" value="none"> </br>
                    <span class="label7">Start commando:</span> 
                    <input type="text" name="txt_commando" id="txt_commando" width="210px" value="none"> </br>
                    <span class="label7">Host volume:</span> 
                    <input type="text" name="txt_hostvolume" id="txt_hostvolume" width="210px" value="none"> </br>
                    <span class="label7">Container volume:</span> 
                    <input type="text" name="txt_containervolume" id="txt_containervolume" width="210px" value="none"> </br>
                    <span class="label7">Host poort:</span> 
                    <input type="text" name="txt_hostpoort" id="txt_hostpoort" width="210px" value="none"> </br>
                    <span class="label7">Container poort:</span> 
                    <input type="text" name="txt_containerpoort" id="txt_containerpoort" width="210px" value="none"> </br>
                    <span class="label7">Container naam:</span> 
                    <input type="text" name="txt_containernaam" id="txt_containernaam" width="210px" value="none"> </br>
                    <input type="submit" value="Start container" name="btn_opdracht7" value="btn_opdracht7" >
                </form>
            </div>
            <div class="output" id="output_opdracht07">
			<?php
			    if($focus==7) 
			    {
					echo("$html");
				}
				else
				{
					echo("NB: spaties en forward slashes kun je niet doorgeven");
				}
			?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id=docker_opdracht8>
            <div class="koptekst">opdr8: push een image naar Docker Hub</div>
            <div class="form" style="text-align: center; padding:5px;">
		<form method="POST" onsubmit="modifyAndSubmit();" action="" name="opdracht06" id="opdracht08">
                    <span class="label7">Gebruikersnaam:</span>
                    <input type="text" name="txt_username" id="txt_username" width="210px"> </br>
                    <span class="label7">Wachtwoord:</span>
                    <input type="password" name="password" id="password" width="210px"> </br>
                    <span class="label7">Image naam:</span>
		    <input type="text" name="txt_image" id="txt_image" width="210px"> </br>
                    <span class="label7">Tag:</span>
		    <input type="text" name="txt_tag" id="txt_tag" width="210px"> </br>
                    <span class="label7">Repository:</span>
                    <input type="text" name="txt_repository" id="txt_repository" width="210px"> </br>
                    <input type="submit" value="Push image" name="btn_opdracht8" value="btn_opdracht8" >
                </form>
            </div>
            <div class="output" id="output_opdracht08">
                        <?php
                            if($focus==8)
                            {
                                        echo("$html");
                                }
                                else
                                {
                                        echo("output");
                                }
                        ?>
             </div>
        </section>
<!----------------------------------------------------------------------------------------------------->
        <section id=docker_opdracht9>
            <div class="koptekst">opdr9: Geef performance statistieken weer van een container</div>
            <div class="form" style="text-align: center; padding:5px;">
                <form method="POST" action="" name="opdracht09" id="opdracht09">
		    <input type="hidden" id="cont_prestatie_naam" name="cont_prestatie_naam" value="cont_prestatie_naam">Container Naam</br>
                    <input type="text" name="cont_prestatie" id="cont_prestatie" width="210px" value="Cnaam"> </br></br>
                    <input type="submit" value="Geef prestaties weer" name="btn_opdracht9" value="btn_opdracht9" >
                </form>
            </div>
            <div class="output" id="output_opdracht09">
                        <?php
                            if($focus==9)
                            {
                                        echo("$html");
                                }
                                else
                                {
                                        echo("output");
                                }
                        ?>
             </div>

        </section>
    </main>
    <script>
      function modifyAndSubmit() {
	  let inmData = document.getElementById('txt_imagenaam');
          let cmdData = document.getElementById('txt_commando');
          let hostVolData = document.getElementById('txt_hostvolume');
	  let contVolData = document.getElementById('txt_containervolume');
	  let repoData = document.getElementById('txt_repository');
          
	  modifyInput(inmData);
          modifyInput(cmdData);
          modifyInput(hostVolData);
	  modifyInput(contVolData);
	  modifyInput(repoData);
      }  

      function modifyInput(inputElement) {
          let postData = inputElement.value;
          postData = postData.replace(/ /g, '-').replace(/\//g, "-");
          inputElement.value = postData;
      }
    </script>

</body>
</html>
