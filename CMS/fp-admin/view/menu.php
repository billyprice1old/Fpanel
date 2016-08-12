
<ul class="vertical dropdown menu" data-dropdown-menu>
  <?php
  if ($_SESSION['infos']['role'] == 'Admin'){
  ?>
  <li>
    <a href="#"><i class="fa fa-thumb-tack" aria-hidden="true"></i>Users</a>
    <ul class="menu">
      <li><a href="users_list.php">User's List</a></li>
      <li><a href="users_add.php">Add New</a></li>
    </ul>
  </li>
  <?php
  }
  ?>
<?php
  if ($_SESSION['infos']['role']== 'Admin' || $_SESSION['infos']['role']== 'Editor'){
?>
    <li>
    <a href="#"><i class="fa fa-thumb-tack" aria-hidden="true"></i>Appearance</a>
    <ul class="menu">
      <li><a href="themes.php">Themes</a></li>
      <li><a href="menu_admin.php">Menu</a></li>
      <li><a href="sidebar.php">Sidebar</a></li>
    </ul>
  </li>
<li>
    <a href="#"><i class="fa fa-thumb-tack" aria-hidden="true"></i>Pages</a>
    <ul class="menu">
      <li><a href="pages_list.php">Pages' List</a></li>
      <li><a href="pages_add.php">Add New</a></li>
    </ul>
  </li>
  <?php
  }
  ?>
  <li>
    <a href="#"><i class="fa fa-thumb-tack" aria-hidden="true"></i>Posts</a>
    <ul class="menu">
      <li><a href="posts_list.php">Posts' List</a></li>
      <li><a href="catergories_list.php">Categories</a></li>
      <li><a href="posts_add.php">Add New</a></li>
    </ul>
  </li>
  
</ul>