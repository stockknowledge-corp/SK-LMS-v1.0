<div class="container-fluid">
  <div class="row" id="header">
    <div class="col-8" id="logo">
    	<a href="<?php echo $home_url;?>"><img src="<?php echo $home_url;?>/images/sk-logo.png"></a>
    </div>
    <div class="col-4 text-right">
      <?php if($loggedin){?>
        <div class="mobile-menu-container" onclick="menuToggle(this)">
          <div class="bar1"></div>
          <div class="bar2"></div>
          <div class="bar3"></div>
        </div>
      <?php } ?>
    </div>
  </div>
  <div class="row">
    <?php if($loggedin){?>
    <div class="col-2" id="sidebar">
    	<ul>
        <li><a href="<?php echo $home_url;?>">Home</a></li>
        <li><a href="<?php echo $home_url."/sk_users/edit.php?id=".$loggedin;?>">My Profile</a></li>
        <li><a href="<?php echo $home_url;?>/sk_history">History</a></li>
        <li><a href="<?php echo $home_url;?>/sk_leaderboards">Leaderboards</a></li>
        <li><a href="<?php echo $home_url;?>/sk_topics">Topics</a></li>
<?php
if($usertype==1){
  ?>
        <li><a href="<?php echo $home_url;?>/sk_teachers">Teachers</a></li>
        <li><a href="<?php echo $home_url;?>/sk_students">Students</a></li>
        <li><a href="<?php echo $home_url;?>/sk_subjects">Subjects</a></li>
        <li><a href="<?php echo $home_url;?>/sk_modes">Modes</a></li>
        <li><a href="<?php echo $home_url;?>/sk_users">Users</a></li>
<!--         <li><a href="<?php echo $home_url;?>/sk_user_types">User Types</a></li> -->
<?php } ?>

<?php
if($usertype==2){
  ?>
        <li><a href="<?php echo $home_url;?>/sk_students">Students</a></li>
        <li><a href="<?php echo $home_url;?>/sk_subjects">Subjects</a></li>
<?php } ?>

<?php
if($usertype==3){
  ?>
<?php } ?>
        <li><a href="<?php echo $home_url;?>/logout.php">Logout</a></li>

    	</ul>
    </div>
    <div class="col-10 pr-3">
    <?php } else { ?>
    <div class="col-12 pr-3">
    <?php } ?>