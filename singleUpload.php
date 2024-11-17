<?php
// Start the session to store error messages
session_start();

$uploadDir = 'pics/';
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the uploaded file information
    if(isset($_FILES['pic-upload'])) {
        $file = $_FILES['pic-upload'];

        // Get the desired filename
        $picName = trim($_POST['day-select']);

        // Check if file was uploaded
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Get the original filename and extension
            $originalName = basename($file['name']);
            $extension = pathinfo($originalName, PATHINFO_EXTENSION);

            // Validate the file type
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                $error = "Dateityp nicht erlaubt.";
            }
            else {
                // Move the uploaded file
                try {
                    if (!move_uploaded_file($file['tmp_name'], $uploadDir . $picName)) {
                        $error = "Bild konnte nicht gespeichert werden.";
                    }
                } catch (Exception $e) {
                    $error = "Fehler: " . $e->getMessage();
                }
            }


        } else {
            // Handle upload errors
            switch ($file['error']) {
                case UPLOAD_ERR_INI_SIZE:
                    $error = "Das Bild ist zu groß.";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    $error = "Das Bild ist zu groß.";
                    break;
                default:
                    $error = "Ein unerwarteter Fehler ist beim Upload aufgetreten.";
            }
        }
    }
    else {
        $error = "Kein Bild hochgeladen.";
    }
}

// Store the error message in the session and redirect back to the form
if ($error !== "") {
    $_SESSION['upload_error'] = $error;
    $_SESSION['active_tab'] = 'individual-tab-pane';
    header("Location: index.php"); // Replace with your form's file name
    exit();
}

// If no errors, display a success message
$_SESSION['upload_success'] = "Bild erfolgreich hochgeladen!";
$_SESSION['active_tab'] = 'individual-tab-pane';
header("Location: index.php"); // Replace with your form's file name
exit();
?>