$(document).ready(function(){

	$.ajax({
		url: "http://localhost/IMS2_new5/dashboard.php",
		type : "GET",
		success : function(data){
			console.log(data);

			var invoice_no = [];
			var grandtotal = [];
			var date 	   = [];

			for (var i in data) {
				
				date.push("Date " + data[i].date);
				grandtotal.push(data[i].GrandTotal);
				invoice_no.push(data[i].Invoice_No);
			}

			var chardata = {
				labels: date,
				datasets : [{

					label: "GrandTotal",
					fill: false,
					lineTension: 0.1,
					backgroundColor: "rgba(59, 89, 152, 0.75)",
					borderColor: "rgba(59, 89, 152, 1)",
					pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
					pointHoverBorderColor: "rgba(59, 89, 152, 1)",
					data: grandtotal
				}]

			};

			var ctx = $("#mycanvas");
			var LineGraph = new Chart(ctx, {
				type: 'line',
				data: chardata
			});

		},
		error : function(data){

		}
	});

});