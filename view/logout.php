<?php
   unset($_SESSION['pass']);
   unset($_SESSION['error']);
   header("Location: ".VIRTUAL_PATH."index.php/index.php");