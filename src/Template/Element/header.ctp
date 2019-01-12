 <header>
  <nav class="navbar">
  
	<div class="container-fluid">
	<div class="navbar-header" >
	</div>
	  <div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>
		  <span class="icon-bar"></span>                        
		</button>
		           <?php echo $this->Html->image('logo.jpg', array('alt' => 'CakePHP', 'border' => '0', 'url' => ['controller' => 'Home', 'action' => 'display'])); ?>

		
				
	  </div>
	  <div class="collapse navbar-collapse" id="myNavbar">
		<ul class="nav navbar-nav navbar-right">
		  <li><a href="#">How it Works</a></li>
		  <li><a href="#">Talk to an Expert</a></li>
		  <li><a href="#">Community Forum</a></li>
		  <li><?php echo	$this->Html->link('Register', array('controller' => 'users', 'action' => 'add')); 
			?></li>
			 <li><?php echo	$this->Html->link('Enter into the website', array('controller' => 'users', 'action' => 'login')); 
			?></li></ul>
	  </div>
	</div>
  </nav> <!--header nav -->
</header> 