<blockquote>
	<p>Generate the brainwallet details (if any) associated with a passphrase. It may  take some time, depending on server load. Please be patient with your request.</p>
</blockquote>
<form id="checkWalletForm" onSubmit="return false;">
<div class="input-group" id="walletCheckInput">
	<input id="guessPhrase" name="guessPhrase" type="text" class="form-control" placeholder="Take a guess...">
	<span class="input-group-btn">
      		<button class="btn btn-primary" type="submit" onClick="submitPhraseCheck();">Check Wallet!</button>
        </span>
</div>
</form>

<div id="walletCheckResults" style="display:none;margin-top:20px;">
</div>

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

<script>
/*jslint unparam: true */
/*global window, $ */
$(function () {
    'use strict';
    // Change this to the location of your server-side upload handler:
    var url = window.location.origin+'/includes/uploads/';
    $('#fileupload').fileupload({
        url: url,
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
		var outputDiv = $('#files');
		outputDiv.html('');
		outputDiv.show();
                outputDiv.append('Uploading file and renaming to '+file.name+'...\n');
                outputDiv.append('Creating session for new temporary file '+file.name+'...\n');
            });
        },
        progressall: function (e, data) {
		$('#progress').show();
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>
