<br /><br />
<div class="tabs-x tabs-above">
    <ul id="tabNav" class="nav nav-tabs" role="tablist">
        <li><a href="#install_dev_tab" role="tab" data-toggle="tab" id="installDevTab"><i class="glyphicon glyphicon-bullhorn"></i> Dev Status</a></li>
        <li class="active"><a href="#install_db_tab" role="tab" data-toggle="tab" id="installDBTab"><i id="installDBGlyph" class="glyphicon glyphicon-exclamation-sign"></i> Database</a></li>
        <li><a href="#install_theme_tab" role="tab-kv" data-toggle="" id="installThemeTab"><i id="installThemeGlyph" class="glyphicon glyphicon-exclamation-sign"></i> Application Theming</a></li>
        <li><a href="#install_server_tab" role="tab" data-toggle="" id="installServerTab"><i id="installServerGlyph" class="glyphicon glyphicon-exclamation-sign"></i> Server Side</a></li>
        <li><a href="#install_final_tab" role="tab" data-toggle="" id="installFinalTab"><i id="installFinalGlyph" class="glyphicon glyphicon-exclamation-sign"></i> Final</a></li>

    </ul>
    <div id="allTabs" class="tab-content">

    <div class="tab-pane fade" id="install_dev_tab" name="install_db_tab">
	<h2>Development Status</h2>
	<hr>
		<blockquote>
			<p>Here you can find the latest version and commit history.</p>
		</blockquote>
		<pre style="font-size:.8em;"><?php appDevStatus(); ?></pre>
	</div>
	    
    <div class="tab-pane fade in active" id="install_db_tab" name="install_db_tab">
	<a name="install_db_tab"></a>
	<h2>Database Configuration Step 1 of 4</h2>
	<div class="progress">
	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%;">
    25%
  	</div>
	</div>
	<hr>
		<blockquote>
			<p>Specify your MySQL database, username, password and host. You must create this before running the installer via your cPanel or the MySQL command line client. You must fill in ALL fields.</p>
		</blockquote>
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Database Name</span>
			<input type="text" class="form-control" placeholder="walletbrute" aria-describedby="sizing-addon1" id="installDB">
		</div>
		<br />
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Database Username</span>
			<input type="text" class="form-control" placeholder="walletbrute_db" aria-describedby="sizing-addon1" id="installUser">
		</div>
		<br />
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Database Password</span>
			<input type="password" class="form-control" placeholder="" aria-describedby="sizing-addon1" id="installPass">
		</div>
		<br />
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Database Host</span>
			<input type="text" class="form-control" placeholder="127.0.0.1" aria-describedby="sizing-addon1" id="installHost" value="127.0.0.1">
		</div>						
		<br />
		<div style="width:100%;text-align:left;">
			<button class="btn btn-danger" type="submit" onClick="$('#installDB,#installUser,#installPass,#installHost').val('');">Clear Fields</button>
			<button class="btn btn-success" type="submit" onClick="var installDB = $('#installDB').val();var installUser = $('#installUser').val();var installPass =  $('#installPass').val();var installHost = $('#installHost').val();installStepOne(installDB,installUser,installPass,installHost);">Go to the Next Step</button>
		</div>
	</div>
	

    <div class="tab-pane fade" id="install_theme_tab" name="install_theme_tab">
	<a name="install_theme_tab"></a>
	<h2>Application Theming Step 2 of 4</h2>
	<div class="progress">
	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%;">
    50%
  	</div>
	</div>
	<hr>
		<blockquote>
			<p>This page is for configuring your site information such as it's title and basic colors.</p>
		</blockquote>
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Site Title</span>
			<input type="text" class="form-control" placeholder="My Site Title" aria-describedby="sizing-addon1" id="installTitle">
		</div>						
		<br />
		<div style="width:100%;text-align:left;">
			<button class="btn btn-danger" type="submit" onClick="$('#installTitle').val('');">Clear Fields</button>
			<button class="btn btn-success" type="submit" onClick="var installTitle = $('#installTitle').val();installStepTwo(installTitle);">Go to the Next Step</button>
		</div>				
    </div>

    <div class="tab-pane fade" id="install_server_tab" name="install_server_tab">
	<a name="install_server_tab"></a>
	<h2>Sever Configuration Step 3 of 4</h2>
	<div class="progress">
	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
    75%
  	</div>
	</div>	
	<hr>
		<blockquote>
			<p>This page is for configuring your site information such as it's title and basic colors.</p>
		</blockquote>
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Site Domain</span>
			<input type="text" class="form-control" placeholder="www.mysite.com/myapplication" aria-describedby="sizing-addon1" id="installDomain">
		</div>						
		<br />
		<div class="input-group input-group">
			<span class="input-group-addon" id="sizing-addon1">Site Directory</span>
			<input type="text" class="form-control" placeholder="/var/www/www.mysite.com/myapplication" aria-describedby="sizing-addon1" id="installDir">
		</div>											
		<br />
		<div style="width:100%;text-align:left;">
			<button class="btn btn-danger" type="submit" onClick="$('#installDomain').val('');$('#installDir').val('');">Clear Fields</button>
			<button class="btn btn-success" type="submit" onClick="var installDomain = $('#installDomain').val();var installDir = $('#installDir').val();installStepThree(installDomain,installDir);">Go to the Next Step</button>
		</div>
	</div>	

    <div class="tab-pane fade" id="install_final_tab" name="install_final_tab">
	<a name="install_final_tab"></a>
	<h2>Final Step 5 of 5</h2>
	<div class="progress">
	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">
    100%
  	</div>
	</div>	
	<hr>
		<blockquote>
			<p>We are going to clean some things up and activate your newly created config. A button will appear when your application is ready.</p>
		</blockquote>
		<div id="walletCheckResults" style="width:100%;margin-top:20px;">
<pre style="font-size:.8em;" id="finalStepLog">
Cleaning temp install directory...
Removing install SQL files...
Moving newly created config file...
Activating newly created config file...
Activating application...
Verifying application...
Complete!
</pre>
		</div>
		<br />
		<div style="width:100%;text-align:left;">
			<button class="btn btn-success" type="submit" onClick="var installDomain = $('#installDomain').val();window.location.href='http://'+installDomain+'';">Take me to my Application</button>
		</div>
	</div>	
           
</div>
</div>
<script>
//Functions for Install
function installStepOne(installDB,installUser,installPass,installHost) {
	if(! installDB){
	 	$('#installDB').css('border-color','red');
 	} else {
	 	$('#installDB').css('border-color','green');
	}
	if(! installUser){
	 	$('#installUser').css('border-color','red');
 	} else {
	 	$('#installUser').css('border-color','green');
	}
	if(! installDB){
	 	$('#installPass').css('border-color','red');
 	} else {
	 	$('#installPass').css('border-color','green');
	}
	if(! installHost){
	 	$('#installHost').css('border-color','red');
 	} else {
	 	$('#installHost').css('border-color','green');
	}		 	
	$.ajax({
        type: 'POST',
		url: 'install_process.php?step=Install_Step_One&installDB='+installDB+'&installUser='+installUser+'&installPass='+installPass+'&installHost='+installHost,
        timeout: 99000,             
		success: function(response){
			$('#installDBGlyph').removeClass().addClass('glyphicon glyphicon-ok');
			$("#installDBTab").attr('data-toggle','');
			$("#installThemeTab").attr('data-toggle','tab');
			$("#installThemeTab")[0].click();
		},
		error: function(){
			$('#installStepOneErrorModal').modal('show');
		}
	});
}

function installStepTwo(installTitle) {
	if(! installTitle){
	 	$('#installTitle').css('border-color','red');
 	} else {
	 	$('#installTitle').css('border-color','green');
	} 	
	$.ajax({
        type: 'POST',
		url: 'install_process.php?step=Install_Step_Two&installTitle='+installTitle,
        timeout: 99000,             
		success: function(response){
			$('#installThemeGlyph').removeClass().addClass('glyphicon glyphicon-ok');
			$("#installThemeTab").attr('data-toggle','');
			$("#installServerTab").attr('data-toggle','tab');
			$("#installServerTab")[0].click();
		},
		error: function(){
			$('#installStepTwoErrorModal').modal('show');
		}
	});
}

function installStepThree(installDomain,installDir) {
	if(! installDomain){
	 	$('#installDomain').css('border-color','red');
 	} else {
	 	$('#installDomain').css('border-color','green');
	} 
	if(! installDir){
	 	$('#installDir').css('border-color','red');
 	} else {
	 	$('#installDir').css('border-color','green');
	} 
	$.ajax({
        type: 'POST',
		url: 'install_process.php?step=Install_Step_Three&installDomain='+installDomain+'&installDir='+installDir,
        timeout: 99000,             
		success: function(response){
			$('#installServerGlyph').removeClass().addClass('glyphicon glyphicon-ok');
			$("#installServerTab").attr('data-toggle','');
			$("#installFinalTab").attr('data-toggle','tab');
			$("#installFinalTab")[0].click();
		},
		error: function(){
			$('#installStepThreeErrorModal').modal('show');
		}
	});
	installStepFour()
}
function installStepFour() {			
	$.ajax({
        type: 'POST',
		url: 'install_process.php?step=Install_Step_Four',
        timeout: 99000,             
		success: function(response){
			$('#installFinalGlyph').removeClass().addClass('glyphicon glyphicon-ok');
			$('#finalStepLog').append(response).show();;
		},
		error: function(){
			alert('permission issue, display config for copying or have them attempt to correct');
		}
	});
}
</script>
