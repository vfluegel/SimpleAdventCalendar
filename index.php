<!DOCTYPE html>
<html>
    <head>
        <title>Adventskalender</title>
        <meta charset="utf-8"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>

    <body style="background-color: darkgreen;">
        
        <div id="heading">
            <h1 class="text-center align-middle my-4">Adventskalender 2024</h1>
            <button class="btn btn-light" style="float: right; position: fixed; top: 10px; right: 10px;" data-bs-toggle="modal" data-bs-target="#editModal">Bearbeiten</button>
        </div>

        <div class="container">

            <div class="row grid gap-4">
                <?php
                    for ($i = 1; $i <= 24; $i++) {
                        echo "<button type='button' id='0" . $i . "' class='col-2 btn btn-outline-light btn-lg py-2' data-bs-toggle='modal' data-bs-target='#doorModal'>" . $i . "</button>";
                        
                    }
                ?>
            </div>
      
            <!-- Repeat --> 
      
      </div>

    <!-- Pic Modal -->
    <div class="modal fade" id="doorModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="width: fit-content; max-width: 100vw;">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Türchen öffne dich...</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <img class="door-pic" src="https://picsum.photos/800/600"/>
            </div>
        </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" style="width: fit-content; max-width: 100vw;">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Bilder hochladen</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <ul class="nav nav-tabs" id="formTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="individual-tab" data-bs-toggle="tab" data-bs-target="#individual-tab-pane" type="button" role="tab" aria-controls="individual-tab-pane" aria-selected="true">Einzeln</button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="random-tab" data-bs-toggle="tab" data-bs-target="#random-tab-pane" type="button" role="tab" aria-controls="random-tab-pane" aria-selected="false">Zufällig</button>
                    </li>
                    
                  </ul>
                  <div class="tab-content pt-3" id="formTabContent">
                    <div class="tab-pane fade show active" id="individual-tab-pane" role="tabpanel" aria-labelledby="individual-tab" tabindex="0">
                        <form>
                            <div class="mb-3">
                            <label for="day-select" class="form-label">Tag auswählen</label>
                            <select class="form-select" id="day-select" aria-label="Day selection">
                            <?php
                                for ($j = 1; $j <= 24; $j++) {
                                    echo "<option value='0". $j ."'>". $j ."</option>";
                                    
                                }
                            ?>
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="pic-upload" class="form-label">Bild auswählen</label>
                                <input class="form-control" type="file" id="pic-upload">
                            </div>
                            <button type="submit" class="btn btn-secondary">Hochladen</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="random-tab-pane" role="tabpanel" aria-labelledby="random-tab" tabindex="0">
                        <div class="mb-3">
                            <label for="multi-pic-upload" class="form-label">Bilder auswählen</label>
                            <input class="form-control" type="file" id="multi-pic-upload" multiple>
                        </div>
                        <button type="submit" class="btn btn-secondary">Hochladen</button>
                    </div>
                  </div>

                
            </div>
        </div>
        </div>
    </div>

    <script>
        const doorModal = document.getElementById('doorModal');
        doorModal.addEventListener('show.bs.modal', event => {
            console.log(event);
            const button = event.relatedTarget
            // Extract info from data-bs-* attributes
            const file = button.id
             
            // If necessary, you could initiate an Ajax request here
            // and then do the updating in a callback.

            // Update the modal's content.
            const modalTitle = doorModal.querySelector('.modal-title')

            modalTitle.textContent = `Türchen ${button.innerText}`
        })

    </script>

    <style>
        .door-pic {
            max-width: 95vw;
        } 
        @media (min-width: 768px) { 
            .door-pic {
                max-width: 80vw;
            } 
         }
        @media (min-width: 1400px) { 
            .door-pic {
                max-width: 70vw;
            } 
         }


    </style>
    </body>
</html>