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
      <h1>logo</h1>
      <ul class="nav">
        <button onclick="showPage('home')">Popular threads</button>
        <button onclick="showPage('about')">new threads</button>
        <button onclick="showPage('contact')">your thread</button>
        <button onclick="showPage('contact')">add thread</button>
        <button onclick="showPage('contact')">profile</button>
        <button onclick="showPage('contact')">logout</button>
      </ul>
    </nav>
</header>	

  <main>


  <section id="home">
    <h1>Home</h1>
    <p>Home page content goes here...</p>
  </section>

  <section id="about">
    <h1>About</h1>
    <p>About page content goes here...</p>
  </section>

  <section id="contact">
    <h1>Contact</h1>
    <p>Contact page content goes here...</p>
  </section>

</main>

<script>
  function showPage(pageId) 
  {

    // Hide all sections
    document.getElementById('home').style.display = 'none';
    document.getElementById('about').style.display = 'none';
    document.getElementById('contact').style.display = 'none';

    // Show selected section
    document.getElementById(pageId).style.display = 'block';


    let activePage = 'home';

    function showPage(page) 
    {
      document.querySelector('.nav .active')?.classList.remove('active');
      document.querySelector(`.nav button[onclick="showPage('${page}')"]`).classList.add('active');
      
      activePage = page;
      
      // Logic to show/hide pages
      
      console.log('Showing page:', activePage); 
    }

  }

  // Default to show home page on load
  showPage('home');
</script>

  
</body>
</html>









 
 
<?php
    // echo "ID: $id <br>";
    // echo "First Name: $fname <br>"; 
    // echo "Last Name: $lname <br>";
    // echo "email $email <br>";
    // echo "Age: $age <br>";
    // echo "Category: $category <br>";
    // echo "Field: $field";

    // foreach ($topics as $topic)
    // {
    //   echo $topic;
    //   echo '<br>';
    // }


?>