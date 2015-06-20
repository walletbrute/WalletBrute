<br /><br />
<div class="tabs-x tabs-above">
    <ul id="tabNav" class="nav nav-tabs" role="tablist">
        <li><a href="#home_tab" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-home"></i> Home</a></li>
        <li><a href="#about_tab" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-user"></i> About</a></li>
        <li><a href="#dev_tab" role="tab" data-toggle="tab" id="DevTab"><i class="glyphicon glyphicon-bullhorn"></i> Dev Status</a></li>
        <li><a href="#view_tab" role="tab-kv" data-toggle="tab"><i class="glyphicon glyphicon-search"></i> View</a></li>
        <li class="active"><a href="#add_tab" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-plus"></i> Add</a></li>
        <li><a href="#rates_tab" role="tab" data-toggle="tab"><i class="glyphicon glyphicon-scale"></i> Exchange Rates</a></li>

    </ul>
    <div id="allTabs" class="tab-content">
        
    <div class="tab-pane fade" id="home_tab">
		<h2>Home</h2>
		<hr>
		<?php include('home.php'); ?>
	</div>
	
	<div class="tab-pane fade" id="dev_tab" name="install_db_tab">
	<h2>Development Status</h2>
	<hr>
	<?php include('dev.php'); ?>
	</div>	

    <div class="tab-pane fade" id="view_tab">
	<h2>View the Database</h2>
	<hr>
	<?php include('view.php'); ?>
    </div>

    <div class="tab-pane fade" id="about_tab" name="about_tab">
	<a name="about_tab"></a>
	<h2>About</h2>
	<hr>
	<?php include('about.php'); ?>
    </div>

    <div class="tab-pane fade in active" id="add_tab" name="add_tab">
	<a name="add_tab"></a>
	<h2>Add to the Database</h2>
	<hr>
	<?php include('add.php'); ?>
    </div>

    <div class="tab-pane fade" id="rates_tab" name="rates_tab">
	<a name="rates_tab"></a>
	<h2>Exchange Rates</h2>
	<hr>
	<?php include('rates.php'); ?>
    </div>
        
</div>
</div>
