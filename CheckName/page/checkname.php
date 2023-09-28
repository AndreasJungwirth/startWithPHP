<!DOCTYPE html>
<html>
<head>
  <title>Formularüberprüfung</title>
</head>
<body>
  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $vorname = $_POST["text_vname"];
      $nachname = $_POST["text_nname"];
      $email = $_POST["text_email"];
      $svrn = $_POST["text_svrn"];

      $fehler = array();

      // Überprüfung des Vornamens und Nachnamens
      if (!preg_match("/^[A-Za-z]+$/", $vorname)) {
          $fehler[] = "Der Vorname ist ungültig.";
      }
      if (!preg_match("/^[A-Za-z]+$/", $nachname)) {
          $fehler[] = "Der Nachname ist ungültig.";
      }

      // Überprüfung der E-Mail-Adresse
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $fehler[] = "Die E-Mail-Adresse ist ungültig.";
      }

      // Überprüfung der Sozialversicherungsnummer (angenommen, sie besteht aus 10 Ziffern)
      if (!preg_match("/^[0-9]{10}$/", $svrn)) {
          $fehler[] = "Die Sozialversicherungsnummer ist ungültig.";
      }

      if (empty($fehler)) {
          // Keine Fehler, alles ist korrekt
          echo "<img src=\"https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=Korrekt&amp;qzone=1&amp;margin=0&amp;size=400x400&amp;ecc=L\" alt=\"qr code\" />";

      } else {
          // Fehler vorhanden, Liste der Fehler ausgeben
          echo "<img src=\"https://api.qrserver.com/v1/create-qr-code/?color=000000&amp;bgcolor=FFFFFF&amp;data=Inkorrekt&amp;qzone=1&amp;margin=0&amp;size=400x400&amp;ecc=L\" alt=\"qr code\" />";
          echo "<br>";
          foreach ($fehler as $fehlermeldung) {
              echo $fehlermeldung . "<br>";
          }
      }
  }else{
  ?>

  <form method="post" action="">
    <div class="form-group">
      <label>Vorname *</label> <input type="text" class="form-control" name="text_vname" placeholder="Max" required="required">
    </div>

    <div class="form-group">
      <label>Nachname *</label> <input type="text" class="form-control" name="text_nname" placeholder="Mustermann" required="required">
    </div>

    <div class="form-group">
      <label>Email *</label> <input type="text" class="form-control" name="text_email" placeholder="Max.Mustermann@gmail.com" required="required">
    </div>

    <div class="form-group">
      <label>Sozialversicherungsnummer *</label> <input type="text" class="form-control" name="text_svrn" placeholder="1234231001" required="required">
    </div>

    <div class="form-group">
      <br>
      <input type="submit" class="btn btn-primary" name="button_submit" value="Senden">
    </div>
    <small>Felder markiert mit * sind Pflichtfelder.</small>
  </form>
</body>
</html>
<?php
}
