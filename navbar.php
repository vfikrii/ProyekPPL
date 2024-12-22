<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&family=Montserrat:wght@500&family=PT+Sans&display=swap" rel="stylesheet">
  <style>
   body {
  margin: 0;
  padding: 0;
  background-color: #f5f5f5;
  font-family: 'Josefin Sans', sans-serif;
}

nav {
  background-color: #4caf50;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

nav .logo {
  font-size: 24px;
  font-weight: bold;
  color: white;
}

nav .menu {
  list-style: none;
  padding: 0;
  margin: 0;
  display: flex;
  flex-wrap: wrap;
  position: relative; /* Tambahkan posisi relative agar dropdown absolute tetap dalam konteks */
}

nav .menu li {
  margin: 0 15px;
  position: relative; /* Untuk memastikan dropdown tetap dalam konteks elemen menu */
}

nav .menu li a,
nav .menu li span {
  color: white;
  text-decoration: none;
  font-size: 16px;
  transition: color 0.3s;
}

nav .menu li a:hover,
nav .menu li span:hover {
  color: #ffeb3b;
}

/* Dropdown */
nav .custom-dd {
  display: none;
  position: absolute;
  top: 100%; /* Letakkan dropdown di bawah menu */
  left: 0;
  background-color: #6abf69;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  z-index: 1050; /* Tambahkan z-index lebih tinggi */
  min-width: 200px;
  overflow: hidden; /* Hindari konten dropdown meluber */
}

nav .custom-dd li {
  padding: 10px 15px;
  text-align: left;
  cursor: pointer;
  white-space: nowrap; /* Agar teks tidak terpotong */
}

nav .custom-dd li:hover {
  background-color: #5ba35b;
}

nav .custom-dd li hr {
  margin: 5px 0;
  border-top: 1px solid #ffffff;
}

nav .custom-dd a {
  color: white;
  text-decoration: none;
  display: block;
}

/* Tampilkan dropdown saat class aktif */
nav .custom-dd-show {
  display: block;
}

/* Responsif Styling */
@media (max-width: 768px) {
  nav .menu {
    flex-direction: column;
    align-items: flex-start;
    display: none; /* Sembunyikan menu, akan digantikan toggle */
  }

  nav .menu.show {
    display: flex; /* Tampilkan menu saat toggle aktif */
  }

  nav .menu li {
    margin: 10px 0;
    position: relative; /* Pastikan dropdown tetap dalam konteks elemen induk */
  }

  nav .custom-dd {
    position: relative; /* Gunakan posisi relative di layar kecil */
    width: 100%; /* Buat dropdown memenuhi lebar menu */
    top: auto; /* Hapus posisi vertikal */
    left: 0;
    margin-top: 10px; /* Beri jarak kecil di bawah menu */
    border-radius: 0; /* Hapus radius di layar kecil untuk tampilan lebih rapi */
  }
}
  </style>
</head>
<body>
  <!-- Navigasi -->
  <nav class="d-flex align-items-center justify-content-between px-3 py-2">
    <div class="logo">AHP</div>
    <button class="btn text-white d-md-none" id="toggleMenu">
      <i class="bi bi-list" style="font-size: 1.5rem;"></i>
    </button>
    <ul class="menu d-md-flex">
      <li><a href="index.php">Home</a></li>
      <li><a href="guide.php">Guide</a></li>
      <li><a href="kriteria.php">Kriteria</a></li>
      <li><a href="alternatif.php">Alternatif</a></li>
      <li><a href="bobot_kriteria.php">Perbandingan Kriteria</a></li>
      <li>
        <span id="dropdownToggle">Perbandingan Alternatif</span>
        <ul class="custom-dd" id="custom">
          <?php
						if (getJumlahKriteria() > 0) {
							for ($i=0; $i <= (getJumlahKriteria()-1); $i++) { 
								echo "<a class='item' href='bobot.php?c=".($i+1)."'><li>".getKriteriaNama($i)."<hr></li></a>";
							}
						}
					?>
        </ul>
      </li>
      <li><a href="hasil.php">Ranking</a></li>
      <li><a href="login.php">Logout</a></li>
    </ul>
  </nav>

  <script>
    // Dropdown toggle logic
    const dropdownToggle = document.getElementById("dropdownToggle");
    const dropdownMenu = document.getElementById("custom");
    const toggleMenuButton = document.getElementById("toggleMenu");
    const menu = document.querySelector("nav .menu");

    // Toggle dropdown menu
    dropdownToggle.addEventListener("click", () => {
      dropdownMenu.classList.toggle("custom-dd-show");
    });

    // Toggle menu for mobile
    toggleMenuButton.addEventListener("click", () => {
      menu.classList.toggle("show");
    });

    // Close dropdown when clicking outside
    document.addEventListener("click", (event) => {
      if (!dropdownToggle.contains(event.target) && !dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.remove("custom-dd-show");
      }
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
</body>
</html>
