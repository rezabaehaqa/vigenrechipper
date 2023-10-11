<?php
// Fungsi untuk mengenkripsi teks menggunakan Vigenere Cipher
function vigenereEncrypt($text, $key)
{
  $text = strtoupper($text);
  $key = strtoupper($key);
  $textLength = strlen($text);
  $keyLength = strlen($key);
  $encryptedText = '';

  for ($i = 0; $i < $textLength; $i++) {
    $char = $text[$i];
    if (ctype_alpha($char)) {
      $charIndex = ord($char) - 65;
      $keyChar = $key[$i % $keyLength];
      $keyIndex = ord($keyChar) - 65;
      $encryptedChar = chr(((($charIndex + $keyIndex) % 26) + 65));
      $encryptedText .= $encryptedChar;
    } else {
      $encryptedText .= $char;
    }
  }

  return $encryptedText;
}

// Fungsi untuk mendekripsi teks menggunakan Vigenere Cipher
function vigenereDecrypt($text, $key)
{
  $text = strtoupper($text);
  $key = strtoupper($key);
  $textLength = strlen($text);
  $keyLength = strlen($key);
  $decryptedText = '';

  for ($i = 0; $i < $textLength; $i++) {
    $char = $text[$i];
    if (ctype_alpha($char)) {
      $charIndex = ord($char) - 65;
      $keyChar = $key[$i % $keyLength];
      $keyIndex = ord($keyChar) - 65;
      $decryptedChar = chr(((($charIndex - $keyIndex + 26) % 26) + 65));
      $decryptedText .= $decryptedChar;
    } else {
      $decryptedText .= $char;
    }
  }

  return $decryptedText;
}

// Data pengguna yang telah terenkripsi sebelumnya
$username = "contoh_user";
$encryptedPassword = vigenereEncrypt("passwordjj", "KUNCI");

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Algoritme Vigenere Chiper</title>
</head>

<body>
  <div class="card text-center bg-dark">
    <div class="card-header">
      <div class="d-flex justify-content-center">
        <a class="nav-link btn btn-warning" href="#"><b>SISTEM LOGIN DENGAN ENKRIPSI VIGENERE CHIPPER</b></a>
      </div>
    </div>

    <div class="card-body bg-light">
      <div class="container mt-5">
        <div class="row justify-content-center">
          <div class="col-md-6">
            <div class="card border border-dark">
              <div class="card-header border-dark">
                <h1><b>Login</b></h1>
              </div>
              <div class="card-body">
                <form id="loginForm" action="" method="POST">
                  <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                  </div>
                  <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                  </div>
                  <button type="submit" class="btn btn-primary">Login</button>
                </form>
                <br>

                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                  // Ambil input dari formulir
                  $inputUsername = $_POST['username'];
                  $inputPassword = $_POST['password'];

                  // Proses enkripsi password yang dimasukkan oleh pengguna
                  $encryptedInputPassword = vigenereEncrypt($inputPassword, "KUNCI");

                  // Bandingkan password yang dimasukkan oleh pengguna dengan password terenkripsi yang ada
                  if ($inputUsername === $username && $encryptedInputPassword === $encryptedPassword) {
                    echo "Login berhasil!<br>";
                    echo "Plaintext Kunci: KUNCI<br>";
                    echo "Password Terenkripsi: $encryptedPassword<br>";

                    // Mendekripsi password terenkripsi
                    $decryptedPassword = vigenereDecrypt($encryptedPassword, "KUNCI");
                    echo "Plaintext Password: $decryptedPassword";
                  } else {
                    echo "Login gagal. Silakan coba lagi.";
                  }
                }
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="card-footer text-muted">
      <p class="clearfix mb-0"><span class="float-md-start d-block d-md-inline-block mt-25">COPYRIGHT &copy; 2023<a data-bs-toggle="modal" class="me-2" href="#login" target="_blank">Reza Baehaqa</a><span class="d-none d-sm-inline-block">,
            All rights Reserved</span></span><span class="float-md-end d-none d-md-block">Hand-crafted & Made
          with<i class="fa fa-heart"></i></span></p>
    </div>
  </div>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
  </script>
</body>

</html>