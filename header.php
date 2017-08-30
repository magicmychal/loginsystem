<!-- As a heading -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <span class="h1" class="navbar-brand mb-0">SC</span>
  
  <a class="navbar-brand" href="index.php">Secret society</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <?php

					if (!empty($_SESSION['userid'])){
						echo "<a class='nav-link disabled' href='#'>Hi ".$_SESSION['person']."!</a>";
					}
					else {}
		  ?>
      </li>
      <li class="nav-item">
        <?php

					if (!empty($_SESSION['userid'])){
						echo "<a class='nav-link' href='logout.php'>Log out</a>";
					}
					else {}
		  ?>
      </li>
    </ul>
  </div>
  
  
</nav>
