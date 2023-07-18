<script src="js/eventi.js" type="text/javascript"></script>
Admin Eventi<br>


<?php include dirname(__FILE__)."/aggiuntaEvento.php";?>

<div class="row  float-right">
    <div class="dataTables_filter d-flex justify-content-end">
        <button id="showOverlayButton2" class="btn btn-secondary">
            <span style="font-size: 16px;">
                <i class="fas fa-plus"></i>
            </span>
            Aggiungi
        </button>
    </div>
</div>



<div class="row">
    <div class="col-md-9"><div id='calendar'></div></div>
    <div class="col-md-3"><?php include dirname(__FILE__)."/ricercaEvento.php ";?></div>
</div>


<div class="overlay" id="Eventioverlay3">
    <div class="overlayContent-event" id="overlayContent3">
        <div class="card text-left" id="eventModal">
                <div class="modal-content text-left" style="padding-left: 20px;">
                        <div class="text-right" style="text-align: right;font-size: 40px;">
                            <span class="close" style="margin-right:15px;margin-top:15px;color:#CC0000"><i class="fas fa-times"></i></span>
                        </div>
                    
                    <h2 id="modalTitle"></h2>
                    <p id="modalStart"></p>
                    <p id="modalEnd"></p>
                    <p id="modalDescription"></p>
            </div>
        </div>
    </div>
</div>
        
<!--
<div class="Datatable_container">

    <table class="Datatable_table" id='table_eventi'>
        <div class="dataTables_wrapper" style="margin-bottom:5px;">
            <div class="dataTables_filter">

                <button id="showOverlayButton2" class="btn btn-secondary">
                    <span style="font-size: 16px;">
                        <i class="fas fa-plus"></i>
                    </span>
                    Aggiungi
                </button>

                <button id="showOverlayButton" class="btn btn-primary">
                    <span style="font-size: 16px;">
                        <i class="fas fa-search"></i>
                    </span>
                    Approfondita
                </button>
            </div>

        </div>
        <thead>
            <tr>
                <th>Id</th>
                <th>Giorno-ora</th>
                <th>Slots</th>
                <th>Locale</th>
                <th>Attività</th>
                <th>Disciplina</th>
                <th>Ente1</th>
                <th>Ente2</th>
                <th>Pubblico</th>
                <th>Arbitro</th>
                <th>RespSicurezza</th>
                <th>Note</th>

            </tr>
         
        </thead>
        <tbody>
        </tbody>
        <tfoot>
        </tfoot>
    </table>
</div>-->
<script>
  //initDataTableEventi()
  initCalendarEventi()
  loadTableEventi()
  getDiscipline()
  getLocali()
  getAttivita()
  getEnti()
</script>




<BR><br>
Far si che gli eventi vengono caricati solo per il mese corrente, successivo e precedente<br>
quando cambi pagina vengono caricati altri eventi se cambi mese<br>

<br>
<br>
viste<br>
aggiungere una vista che mostra sia gli eventi inseriti in blu che quelli non inseriti in grigio<br>
aggiungere una vista a parte che mostra gli eventi non inseriti in una lista a parte<br>
vista eventi inseriti in blu<br>
mostrare solo eventi di una certa ente<br>
mostrare solo eventi di un certo sport<br>
mostrare eventi solo di una certa squadra<br>



<br>
<br>
controlli<br>
gli eventi che non possono essere insertiti vengono ordinati per created at<br>

<br>
Quando clicchi su un singolo evento viene mostrato dal database con un overlay e se vuoi lo puoi modificare<br>
se è di riferimento viene modificato anche il suo duplicato<br>
