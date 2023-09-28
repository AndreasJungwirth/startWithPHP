<!DOCTYPE html>

<!-- Formular der Website -->

<html lang="en">
  <?php include("Head.php"); ?>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center">
    <h1 class="logo me-auto"><a href="index.php">Kogseder<span>.</span></h1></a>
      <!-- Uncomment below if you prefer to use an image logo -->

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          <a class="nav-link" aria-current="page" href="index.php">Start</a>
          <li><a class="nav-link scrollto" href="#contact">Contact</a></li>
          <a href="Formular.php">
          <button type="button" class="btn btn-danger">Formular</button>
          </a>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->
    </div>
  </header><!-- End Header -->
 <div class="Ueberschrift"></div>
  <main id="main">
</b><i><h1 class="Ueberschrift">Formular</h1><b></i>

    <form>
      <label class="label2" for="Vorname">Vorname:
      <input type="text" id="vname" name="vname" placeholder="Ihr Vorname">
      </label>

      <label  class="label2" for="Nachname">Nachname:
      <input type="text" id="nname" name="nname" placeholder="Ihr Nachname">
      </label>

  <label class="label2"  for="Nat">Nationalität:
  <select name="Nat" id="Nat">
    <option value="AT">Austria</option>
    <option value="DE">German</option>
    <option value="CH">Switzerland</option>
    <option value="USA">Amerika</option>
  </select>
  </label>

      <label for="buch">Welche der folgenden Bücher haben Sie schon gelesen?</label>
      <br>
      <input type="checkbox" name="Buch" value="Koran" id="check1" checked>
      <label for="check1">Koran</label>
<br>
      <input type="checkbox" name="Buch" value="Bibel" id="check2">
      <label for="check2">Bibel</label>
<br>
       <input type="checkbox" name="Buch" value="Ringe" id="check3">
       <label for="check3">Herr der Ringe</label>
       </div>
       </label>

<br><br>

<div class="label2">
  <label for="newsletteran">Wollen Sie unseren Newsletter Abonnieren?:
    <br>
  <input type="radio" id="ja" name="ja" value="ja" checked>
  <label for="ja">Ja</label>
<br>
  <input type="radio" id="nein" name="nein" value="nein">
  <label for="nein">Nein</label>
  </label>

<br><br>

<div class="label2">
  <label for="newsletteran">Wie ist ihre Laune Gerade?:
    <br>
  <input type="radio" id="gut" name="laune" value="gut" checked>
  <label for="gut">Gut</label>
<br>
  <input type="radio" id="Schlecht" name="laune" value="Schlecht">
  <label for="Schlecht">Schlecht</label>
  </label>
</div>

<label class="label2" for="message">Nachricht:
    <textarea id="message" name="message" placeholder="Ihre Nachricht"></textarea>
    </label>

      <label class="label2">
      <input type="submit" value="Senden">
      </label>
      
    </form>
  </main>

  <?php include("footer.php"); ?>
</body>
</html>
