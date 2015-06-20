<blockquote>
	<p>Exchange rates worldwide for Bitcoin. Last updated <span style="border-bottom:1px dashed #000;background-color:#ddd;"><?php $fileTime = filemtime(APP_INCLUDES.'/temp/rates'); echo date('F jS, Y \a\t g:i:s A', $fileTime); ?></span>.</p>
</blockquote>
<table id="world_rates" class="display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Currency Code</th>
            <th>Currency Name</th>
            <th>Bitcoin Rate</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>Currency Code</th>
            <th>Currency Name</th>
            <th>Bitcoin Rate</th>
        </tr>
    </tfoot>
</table>
<hr>
<h2>BitCoin Value</h2>
<hr>
<div id="btcPriceGraphContainer" style=""></div>
<br />
<script>
    var divWidth = $('#allTabs').width() - 0;   
    //var divWidth = "500";
    $('#btcPriceGraphContainer').html('<div id="btcPriceGraph" class="" style="width:'+divWidth+';"></div>');
	
	var container = $("#btcPriceGraph");

	// Determine how many data points to keep based on the placeholder's initial size;
	// this gives us a nice high-res plot while avoiding more than one point per pixel.

	var maximum = container.outerWidth() / 2 || 300;

	//

	var data = [];

    function getRandomData() {

        if (data.length) {
            data = data.slice(1);
        }

        while (data.length < maximum) {
            var previous = data.length ? data[data.length - 1] : 50;
            var y = previous + Math.random() * 10 - 5;
            data.push(y < 0 ? 0 : y > 100 ? 100 : y);
        }

        // zip the generated y values with the x values

        var res = [];
        for (var i = 0; i < data.length; ++i) {
            res.push([i, data[i]])
        }

        return res;
    }

	//

	series = [{
		data: getRandomData(),
		lines: {
			fill: true
		}
	}];

	//

	var plot = $.plot(container, series, {
		grid: {
			borderWidth: 1,
			minBorderMargin: 0,
			labelMargin: 0,
			backgroundColor: {
				colors: ["#fff", "#e4f4f4"]
			},
			margin: {
				top: 0,
				bottom: 0,
				left: 0
			},
			markings: function(axes) {
				var markings = [];
				var xaxis = axes.xaxis;
				for (var x = Math.floor(xaxis.min); x < xaxis.max; x += xaxis.tickSize * 2) {
					markings.push({ xaxis: { from: x, to: x + xaxis.tickSize }, color: "rgba(232, 232, 255, 0.2)" });
				}
				return markings;
			}
		},
		xaxis: {
			tickFormatter: function() {
				return "";
			}
		},
		yaxis: {
			tickFormatter: function() {
				return "";
			}
		},
		legend: {
			show: false
		}
	});

	setInterval(function updateRandom() {
		series[0].data = getRandomData();
		plot.setData(series);
		plot.draw();
	}, 40);
	
</script>
