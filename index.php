<?php
session_start();
// Set the active tab based on the session or default to the first tab
$activeTab = isset($_SESSION['active_tab']) ? $_SESSION['active_tab'] : 'individual-tab-pane';
unset($_SESSION['active_tab']); // Clear the session variable after use
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Adventskalender</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/@cycjimmy/canvas-snow@3/dist/canvas-snow.umd.min.js"></script>
    </head>

    <body style="background-color: #036f3e;">

        <div id="snowfall" style="position: fixed; height: 100vh; width: 100vw; z-index: -1;"></div>

        <div class="d-flex justify-content-end">
            <button class="btn btn-light m-2" data-bs-toggle="modal" data-bs-target="#editModal">Bearbeiten</button>
        </div>
        <div id="heading">
            <h1 class="text-center align-middle text-light my-4 display-1" style="font-family: Garamond, serif;">Adventskalender 2024</h1>
        </div>

        <div class="container-fluid text-center px-2 px-md-5 py-4" >

            <div class="row gap-3 justify-content-center bg-black py-3" style="--bs-bg-opacity: .4;">
                <?php
                    for ($i = 1; $i <= 24; $i++) {
                        echo "<button type='button' id='" . $i . "' class='col-5 col-lg-3 btn btn-outline-light btn-lg py-4' data-bs-toggle='modal' data-bs-target='#doorModal'>" . $i . "</button>";
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
            <div class="modal-body d-flex justify-content-center">
                <img style="object-fit: contain;" class="door-pic"/>
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
                        <!-- Display error or success messages -->
                            <?php
                            if (isset($_SESSION['upload_error'])) {
                                echo "<div class='alert alert-danger alert-dismissible m-3' role='alert'>" . $_SESSION['upload_error'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                            }
                            if (isset($_SESSION['upload_success'])) {
                                echo "<div class='alert alert-success alert-dismissible m-3' role='alert'>" . $_SESSION['upload_success'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                            }
                            ?>
                        <form action="singleUpload.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                            <label for="day-select" class="form-label">Tag auswählen</label>
                            <select class="form-select" id="day-select" name="day-select" aria-label="Day selection">
                            <?php
                                for ($j = 1; $j <= 24; $j++) {
                                    echo "<option value='". $j ."'>". $j ."</option>";
                                    
                                }
                            ?>
                            </select>
                            </div>
                            <div class="mb-3">
                                <label for="pic-upload" class="form-label">Bild auswählen</label>
                                <input class="form-control" type="file" id="pic-upload" name="pic-upload">
                            </div>
                            <button type="submit" class="btn btn-secondary">Hochladen</button>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="random-tab-pane" role="tabpanel" aria-labelledby="random-tab" tabindex="0">
                        <!-- Display error or success messages -->
                            <?php
                            if (isset($_SESSION['multi_upload_error'])) {
                                echo "<div class='alert alert-danger alert-dismissible m-3' role='alert'>" . $_SESSION['multi_upload_error'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                            }
                            if (isset($_SESSION['multi_upload_success'])) {
                                echo "<div class='alert alert-success m-3' alert-dismissible role='alert'>" . $_SESSION['multi_upload_success'] . "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";

                            }
                            ?>
                        <form action="multiUpload.php" method="POST" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label for="multi-pic-upload" class="form-label">Bilder auswählen</label>
                                <input class="form-control" type="file" id="multi-pic-upload" name="multi-pic-upload[]" multiple>
                            </div>
                        <button type="submit" class="btn btn-secondary">Hochladen</button>
                        </form>
                    </div>
                  </div>

                
            </div>
        </div>
        </div>
    </div>

    <script>

          const canvasSnow = new CanvasSnow({
            context: '#snowfall',
            cell: 70
          }).init();

          canvasSnow.start();

        const doorModal = document.getElementById('doorModal');
        doorModal.addEventListener('show.bs.modal', event => {
            console.log(event);
            const button = event.relatedTarget

            // Update the modal's content.
            const modalTitle = doorModal.querySelector('.modal-title')
            modalTitle.textContent = `Türchen ${button.innerText}`

            const modalImg = doorModal.querySelector('.door-pic')
            modalImg.src = `pics/${button.id}`
        })

        document.addEventListener('DOMContentLoaded', function () {

            <?php if (isset($_SESSION['upload_error']) || isset($_SESSION['upload_success']) ||
                        isset($_SESSION['multi_upload_error']) || isset($_SESSION['multi_upload_success'])): ?>
                console.log("Trying to reopen the modal");
                var uploadModal = new bootstrap.Modal(document.getElementById('editModal'));
                uploadModal.show();

                // Activate the correct tab
                var activeTab = "<?php echo $activeTab; ?>";
                if (activeTab) {
                    var tabTrigger = document.querySelector(`[data-bs-target="#${activeTab}"]`);
                    if (tabTrigger) {
                        var tab = new bootstrap.Tab(tabTrigger);
                        tab.show();
                    }
                }
            <?php endif; ?>
            <?php
                unset($_SESSION['upload_success']);
                unset($_SESSION['multi_upload_success']);
                unset($_SESSION['upload_error']);
                unset($_SESSION['multi_upload_error']);
            ?>
        });
    </script>

    <style>
        .door-pic {
            max-height: 90vh;
            max-width: 97vw;
            width: 100%;
            height: auto;
            margin: 0;
            padding: 0;
            display: block;
        } 
        @media (min-width: 768px) { 
            .door-pic {
                max-height: 90vh;
                max-width: 80vw;
            } 
         }
        @media (min-width: 1400px) { 
            .door-pic {
                max-height: 80vh;
                max-width: 70vw;
            } 
         }

    </style>
    </body>
</html>