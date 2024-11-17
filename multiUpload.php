<?php
// Start the session to store error messages
session_start();

$uploadDir = "pics/";
$allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

$error = "";

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if files were uploaded
    if (isset($_FILES['multi-pic-upload'])) {
        $files = $_FILES['multi-pic-upload'];

        // Ensure exactly 24 files were uploaded
        if (count($files['name']) !== 24) {
            $error = "Bitte lade genau 24 Bilder hoch!";
        }

        // Create an array of numbers from 1 to 24 and shuffle it
        $randomNumbers = range(1, 24);
        shuffle($randomNumbers);

        // Process each uploaded file
        for ($i = 0; $i < 24; $i++) {
            if ($files['error'][$i] !== UPLOAD_ERR_OK) {
                switch ($file['error']) {
                      case UPLOAD_ERR_INI_SIZE:
                          $error = $files['name'][$i] . " ist zu groß.";
                          break;
                      case UPLOAD_ERR_FORM_SIZE:
                          $error = $files['name'][$i] . " ist zu groß.";
                          break;
                      default:
                          $error = "Ein unerwarteter Fehler ist beim Upload aufgetreten";
                  }
            }

            // Get the temporary file path
            $tmpFilePath = $files['tmp_name'][$i];

            // Assign a random number as filename
            $extension = pathinfo($files['name'][$i], PATHINFO_EXTENSION);
            // Validate the file type
            if (!in_array(strtolower($extension), $allowedExtensions)) {
                $error = "Dateityp von " . $files['name'][$i] . " nicht erlaubt.";
                break;
            }

            // Set the target file path
            $targetFilePath = $uploadDir . $randomNumbers[$i];

            // Move the uploaded file to the target directory
            if (!move_uploaded_file($tmpFilePath, $targetFilePath)) {
                $error = $files['name'][$i] . " konnte nicht gespeichert werden. ";
                break;
            }

        }

    } else {
        $error = "Kein Bild hochgeladen.";
    }
} else {
    $error = "Request Method ungültig.";
}

// Store the error message in the session and redirect back to the form
if ($error !== "") {
    $_SESSION['multi_upload_error'] = $error;
    $_SESSION['active_tab'] = 'random-tab-pane';
    header("Location: index.php"); // Replace with your form's file name
    exit();
}

// If no errors, display a success message
$_SESSION['multi_upload_success'] = "Alle Bilder erfolgreich hochgeladen!";
$_SESSION['active_tab'] = 'random-tab-pane';
header("Location: index.php"); // Replace with your form's file name
exit();
?>

?>
