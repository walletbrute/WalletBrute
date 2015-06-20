<div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
  <strong>WARNING!</strong><br />Any wallet generated with this page or found in the database is <strong>NOT SECURE</strong>!<br />You will lose any actual currency associated with the address more than likely.
</div>
<blockquote>
	<p>Generate the brainwallet details associated with a passphrase.</p>
</blockquote>
<!-- Generator -->
<form action="/" class="form-horizontal" method="get">
<fieldset>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="pass">Passphrase</label>
    <div class="col-lg-10 controls">
      <div class="input-group">
        <input class="form-control" id="pass" placeholder="Enter a password or phrase..." type="text" autofocus/>
        <div class="input-group-btn">
            <button class="btn btn-primary" type="" id="submitWalletCheck" onClick="var guess = $('#pass').val(); var guessAddr = $('#addr').val(); checkWallet(guess,guessAddr); return false;">Lookup Wallet!</button>
        </div>
      </div> 
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="hash">Secret Exponent</label>
    <div class="col-lg-10 controls">
        <input class="form-control" id="hash" maxlength="64" readonly="readonly" type="text" spellcheck="false" title="SHA256(Passphrase), 256-bit ECDSA private key" type="text"/>
    </div>
  </div>
  <!--<div class="form-group">
    <label class="col-lg-2 control-label">Point Conversion</label>
    <div class="col-lg-10 controls">
      <div class="btn-group" data-toggle="buttons" id="gen_comp">
        <label class="btn btn-default active" title="Uncompressed keys (reference client)"><input name="uncompressed" type="radio" />Uncompressed</label> <label class="btn btn-default" title="Compressed keys (introduced in 0.5.99)"><input name="compressed" type="radio" />Compressed</label>
      </div>
    </div>
  </div>-->
  <div class="form-group">
    <label class="col-lg-2 control-label" for="sec">Private Key</label>
    <div class="col-lg-10 controls">
      <input class="form-control" id="sec" readonly="readonly" spellcheck="false" title="Wallet Import Format (Base58Check of Secret Exponent)" type="text" />
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="addr">Address</label>
    <div class="col-lg-10 controls">
      <input class="form-control" id="addr" readonly="readonly" title="Bitcoin Address (Base58Check of HASH160)" type="text" />
    </div>
  </div>
  <!--<div class="form-group">
    <label class="col-lg-2 control-label" for="genAddrQR">Address QR Code</label>
    <div class="col-lg-10 controls">
      <a href="#" id="genAddrURL" target="_blank" title="Click to view address history (external link)"><span id="genAddrQR"></span></a>
    </div>
  </div>
  <div class="form-group">
    <label class="col-lg-2 control-label" for="der">ASN.1 Key</label>
    <div class="col-lg-10 controls">
      <textarea class="form-control" id="der" readonly="readonly" rows="5" title="ASN.1 DER-encoded ECDSA private key (OpenSSL)"></textarea>
    </div>
  </div>-->
  <div class="form-group">
    <label class="col-lg-2 control-label" for="pub">Public Key</label>
    <div class="col-lg-10 controls">
      <textarea class="form-control" id="pub" readonly="readonly" rows="2" title="SEC1-encoded ECDSA public key (OpenSSL)"></textarea>
    </div>
  </div>
  <!--<div class="form-group">
    <label class="col-lg-2 control-label" for="h160">HASH160</label>
    <div class="col-lg-10 controls">
      <input class="form-control" id="h160" readonly="readonly" title="Hex-encoded address, RIPEMD160(SHA256(Public Key))" type="text" />
    </div>
  </div>-->
  <div class="form-group">
    <label class="col-lg-2 control-label" for="pub">Lookup Results</label>
    <div class="col-lg-10 controls">
	    <pre style="float:right;margin-left:5px;min-height:39px;"><a href="#" id="genAddrURL" target="_blank" title="Click to view address history (external link)"><span id="genAddrQR"></span></a></pre>
      	<pre id="walletCheckResults" style="">
		</pre>
    </div>
  </div>   
</fieldset>
</form>

<hr>

<blockquote>
    <p>Generate the brainwallet details (if any) associated with a passphrase file (in batch, each passphrase on a new line). It may  take some time, depending on server load. Please be patient with your request. Plain/Text mime type only. Basic usage limited to smaller files and single file operation.</p>
</blockquote>
<br>
<!-- The fileinput-button span is used to style the file input field as button -->
<span class="btn btn-primary fileinput-button">
    <i class="glyphicon glyphicon-plus"></i>
    <span>Select files...</span>
    <!-- The file input field used as target for the file upload widget -->
    <input id="fileupload" type="file" name="files[]" accept="text/plain">
</span>
<br>
<br>
<!-- The global progress bar -->
<div id="progress" class="progress" style="display:none;">
    <div class="progress-bar progress-bar-primary"></div>
</div>
<!-- The container for the uploaded files -->
<pre id="files" class="files" style="font-size:.8em;display:none;"></pre>
<br>