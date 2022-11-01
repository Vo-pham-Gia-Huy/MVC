<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Students</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Test ">
    <meta name="author" content="pacificsoftdev@gmail.com">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link href="<?php echo RootREL; ?>media/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo RootREL; ?>media/css/main.css" rel="stylesheet">
	<?php echo html_helpers::cssHeader(); ?>
</head>
<body>
<header class="fixed-top">
<?php $categories = categorie_model::getInstance();
$this->categoriesQuery = $categories->getAllRecords();
$categoriesData = [];
$cate = [];
while ($row = mysqli_fetch_array($this->categoriesQuery, MYSQLI_ASSOC)) {
    array_push($categoriesData, $row);
}
$tree = array();
foreach ($categoriesData as $row1) {
    html_helpers::Tree($row1, $tree);
}
// echo '<pre>';
// print_r($tree);
// echo '</pre>';
?>
  <div class=" navbar-expand-md navbar-dark  bg-dark">
    <div class="container-fluid navbar">
      <a class="navbar-brand" href="#">Linh Duong</a>
      <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button> -->

        <label for="input-hamburger" class="hamburger "></label>
        <input type="checkbox" id="input-hamburger" hidden>
          <ul class="navbar-nav me-auto mb-2 mb-md-0 menu" id='menu1'>
            <li class="nav-item">
              <a class="menu-link active" aria-current="page" href="<?php echo html_helpers::url('/'); ?>">Home</a>
            </li>
            <li class="nav-item">
              <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'about']); ?>">About us</a>
            </li>
            <li class="nav-item">
              <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'tables']); ?>">Tables</a>
            </li>
            <li class="nav-item">
              <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'students']); ?>">Students</a>
            </li>
            <li class="nav-item has-dropdown">
              <a class="menu-link " >Categories and Products &nbsp;&nbsp;&nbsp;&nbsp;<span class="arrow"></span></a>
              <ul class="submenu">
                <li class="nav-item">
                  <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'categories']); ?>">Categories</a>
                </li>
                <li class="nav-item">
                  <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'products']); ?>">Products</a>
                </li>
              </ul> 
            </li>
            <li class="nav-item">
              <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'users']); ?>">Users</a>
            </li>
            <li class="nav-item has-dropdown">
              <a class="menu-link "  href="<?php echo html_helpers::url(['ctl' => 'menu']); ?>">Menu&nbsp;&nbsp;&nbsp;&nbsp;<span class="arrow"></span></a>
              <?php print_r(html_helpers::menu($tree));?>
            </li>
            <li class="nav-item">
              <a class="menu-link" href="<?php echo html_helpers::url(['ctl' => 'contact']); ?>">Contact us</a>
            </li>
            <li class="nav-item">
              <a class="menu-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
            </li>
          </ul>
          <div class="d-flex align-items-center">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
            <div class="d-flex align-items-center mx-3 flex-column text-center"><?php echo isset($_SESSION['login'])?'<img src="media/upload/users/'.$_SESSION["login"]["photo"].'" class="img-avatar text-center"></img><p class="ava-name text-white">'.$_SESSION['login']['fullname'].'</p>':'<img src="media/upload/users/'.$_SESSION["login"]["photo"].'"></img>' ?></div>
          </div>


    </div>
  </div>
</header>
<main>
  <div class="container pt-5">
