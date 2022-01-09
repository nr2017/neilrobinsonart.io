// Author: neil robinson
// Function to calculate total price of artwork
// Date: 30th May 2021
// Revision: 9th January 2022

// Calculate button
	window.addEventListener("load", function() {
    var button = document.getElementById("totalPriceButton");
	button.addEventListener("click", function() {
		
		// Framing/Mounting & Production costs
		var prodCostsElem = document.getElementById("prodCosts");
		var mountFrameCostsElem = document.getElementById("mountFrameCosts");
		
		// Gallery commission and desired profit	
		var galleryCommElem = document.getElementById("galleryCommission");
		var desiredProfitElem = document.getElementById("desiredProfit");
		
		// Method for working out total of commission, desired profit and production costs
		var framing = parseFloat(mountFrameCostsElem.value);
		var production = parseFloat(prodCostsElem.value);
		var commission = parseFloat(galleryCommElem.value);				
		var profit = parseFloat(desiredProfitElem.value);
		
		// Calculations and roundings
		var result = parseFloat(production) + parseFloat(framing);
		var total = parseFloat(result * commission) / 100 + parseFloat(result) + parseFloat(profit);
		var rounded = Math.ceil(total/5)*5;
		
		// Output and error handling
		var totalOutputElem = document.getElementById("totalOutput");
		var roundedOutputElem = document.getElementById("roundedOutput");
		var errorElem = document.getElementById("error");
		var commissionErrorElem = document.getElementById("percentage");
		
		let = percentage;
		if (isNaN(commission) || (commission) < 1 ) {
			  commissionErrorElem.innerHTML = "Enter a minimum of 1% commission.";
		
		} else if (commission > 60 ) {
			  commissionErrorElem.innerHTML = "Enter a maximum of 60% commission.";
		
		} else {	
			   commissionErrorElem.innerHTML = "";	
		}   
		let = error;
		if (isNaN(total) || (total) < 1 ) {
			  errorElem.innerHTML = "Enter amounts above. Where no amount is required input zero. " + "<br>" + "Decimal points accepted, no commas allowed.";
		
		} else if (total > 10000 ) {
			  errorElem.innerHTML = "Warning: A total of &pound" + Math.round(total) + " will require extra insurance cover if over £10k.";
		
		} else {	
			   errorElem.innerHTML = "";
		
		totalOutputElem.innerHTML = "Production & Framing costs = &pound" + result.toFixed(2) + "<br>" + "<br>"
		+ "Total costs (including gallery commission and desired profit) = &pound" + total.toFixed(2);
		
		roundedOutputElem.innerHTML = "&pound" + rounded;
		}
}, false);
}, false);