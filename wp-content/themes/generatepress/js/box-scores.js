var monthData = {};

function parseBoxScore(boxScore) {
	console.log("Box Score: ", boxScore);
	var newRow = "<tr>";
	newRow += "<td>" + boxScore.name + "</td>";
	newRow += "<td>" + boxScore.game_date + "</td>";
	newRow += "<td>" + boxScore.opponent + "</td>";
	newRow += "<td>" + boxScore.total_points + "</td>";
	newRow += "</tr>";
	return newRow;
}

function prepareResultsTable(tabSelector) {
	var table = jQuery('#results-table table').parent().html();
	jQuery(tabSelector).append(table);
	return jQuery(tabSelector).find('table');
}

function parseBoxScores(tabSelector, boxScores) {
	console.log("Tab Selector: ", tabSelector);
	
	var resultsTable = prepareResultsTable(tabSelector);
	
	jQuery.each(boxScores, function(index, boxScore) {
		var newRow = parseBoxScore(boxScore);
		jQuery(resultsTable).append(newRow);
	})
}

function getBoxScores(startDate, endDate, tabSelector) {
  var url = 'http://www.player-database.com/api/v1/box_scores';
  if(monthData[tabSelector]) {
  	return;
  }
  
  jQuery.ajax({
  	url: url,
    headers: {
      'Authorization':'Token token="4232914410a48cc406ff6ba9ed9a683e"',
      'Content-Type':'application/json'
    },
    method: 'GET',
    data: {
    	start_date: startDate,
    	end_date: endDate
    },
    success: function(data) {
    	monthData[tabSelector] = data
    	parseBoxScores(tabSelector, data);
    },
    error: function(xhr, status, error) {
    	console.log(xhr, status, error);
    }
  })
}

jQuery(function(){

  getBoxScores('2016-11-01', '', '#season');
  
  jQuery('.entry-header').hide();
  
  jQuery('#monthTabs a').click(function (e) {
    var startDate = jQuery(this).data('start_date');
    var endDate = jQuery(this).data('end_date');
    var tabHref = jQuery(this).attr('href');
    
    getBoxScores(startDate, endDate, tabHref);
    
    e.preventDefault()  
    jQuery(this).tab('show')
  })
});