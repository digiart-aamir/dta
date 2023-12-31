<?php
include "session.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
  <header>
    <nav>
      <div class="logo">
        <img src="images/logo_circle.png" alt="dta_logo">
        <img src="images/next.png" alt="dta_next">
        <img src="<?php echo $profile ?>" alt="profile" onclick="showPage('profile')">

      </div>
      <h2 class="hide">D T A</h2>
      <ul class="nav">
        <button onclick="showPage('home')"><img src="images/1.png" alt="home">
          <p class="button_text">Home</p>
        </button>
        <button onclick="showPage('your_t')"><img src="images/2.png" alt="your t">
          <p class="button_text">Your Threads</p>
        </button>
        <button onclick="showPage('create_t')"><img src="images/3.png" alt="create t">
          <p class="button_text">Create Threads</p>
        </button>
        <button onclick="showPage('logout')" id="logoutBtn"><img src="images/4.png" alt="logout">
          <p class="button_text">Logout</p>
        </button>
      </ul>
    </nav>
  </header>

  <main class="main">


    <section id="home">
      <?php include "home.php" ?>
    </section>

    <section id="your_t">
      <?php include "your_t.php"?>
    </section>

    <section id="create_t">
      <?php include "create_t.php" ?>
    </section>

    <section id="logout">

    </section>

    <section id="profile">
      <?php include "profile.php" ?>
    </section>

  </main>

  <script>
    function showPage(pageId) {


      // Hide all sections
      document.getElementById('home').style.display = 'none';
      document.getElementById('your_t').style.display = 'none';
      document.getElementById('create_t').style.display = 'none';
      document.getElementById('logout').style.display = 'none';
      document.getElementById('profile').style.display = 'none';

      // Show selected section
      document.getElementById(pageId).style.display = 'block';


      let activePage = 'home';

      function showPage(page) {
        document.querySelector('.nav .active')?.classList.remove('active');
        document.querySelector(`.nav button[onclick="showPage('${page}')"]`).classList.add('active');

        activePage = page;

        // Logic to show/hide pages

        console.log('Showing page:', activePage);
      }

    }

    // Default to show home page on load
    showPage('home');

    // Add click handler for logout button
    document.getElementById('logoutBtn').addEventListener('click', logout);

    function logout() {
      window.location.href = 'login.html';
    }
  </script>


</body>

</html>
