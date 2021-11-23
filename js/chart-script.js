$(document).ready(function(){
     
    /*google.charts.load('current', {'packages':['corechart']});  
    google.charts.setOnLoadCallback(getchartData);  

    function getchartData() {
        $.ajax({
            type: 'POST',
            url: 'php-chart-script.php',
            data:{mode:'emp_sex', page:'2'},
            dataType: "json",
            success: function(respons) {
                drawPieChart(respons)
            }
        });
    }

    function drawPieChart(respons)  
    {  
        var pie = new google.visualization.DataTable();
        pie.addColumn('string', 'Sex');
        pie.addColumn('number', 'Count');

        $.each(respons, function(i, respons){
            var sex = respons.sex;
            var count = parseInt(respons.count);
            pie.addRow([sex, count]);
        })
            
        var header = {  
            title: 'Percentage of employee Sex',
            slices: {0: {color: '#666666'}, 1:{color: '#006EFF'}}
            };  
        var piechart = new google.visualization.PieChart(document.getElementById('piechart'));  
        piechart.draw(pie, header);  
    } 
 */

    google.charts.load('current', {packages: ['corechart', 'bar']});
    google.charts.setOnLoadCallback(getCustomerData);
    function getCustomerData() {
        $.ajax({
            type: 'POST',
            url: 'php-chart-script.php',
            data:{mode:'customer', page:'2'},
            dataType: "json",
            success: function(respons) {
                drawColumnChart(respons)
            }
        });
    }

    function drawColumnChart(respons) {
        var bar = new google.visualization.DataTable();
        bar.addColumn('string', 'Date');
        bar.addColumn('number', 'Customer');
        $.each(respons, function(i, respons){
            var date = respons.date;
            var count = parseInt(respons.count);
            bar.addRow([date, count]);
        })
        
        var header = {
        title: 'New Customers',
        bar: {groupWidth: "50%"},
        hAxis: { title: "Dates"},
        vAxis: { title: "No of Customer"}
        };
        var barchart = new google.visualization.ColumnChart(document.getElementById("columnchart"));
        barchart.draw(bar, header);
    }

    //////////// Load Inbox Message
    $('#load_inbox').load("php-chart-script.php?page=read_msg");

    //////////// Load Inbox Message
    $('#load_task').load("php-chart-script.php?page=assigned_task");

    //////////// Load Goals
    $('#load_goals').load("php-chart-script.php?page=loadgoals");
    

});
    /*google.charts.load('current', {packages:["orgchart"]});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Name');
        data.addColumn('string', 'Manager');
        data.addColumn('string', 'ToolTip');

        // For each orgchart box, provide the name, manager, and tooltip to show.
        data.addRows([
          [{'v':'Mike', 'f':'Mike<div style="color:red; font-style:italic">President</div>'},
           '', 'The President'],
          [{'v':'Jim', 'f':'Jim<div style="color:red; font-style:italic">Vice President</div>'},
           'Mike', 'VP'],
          ['Alice', 'Mike', ''],
          ['Bob', 'Jim', 'Bob Sponge'],
          ['Carol', 'Bob', '']
        ]);

        // Create the chart.
        var chart = new google.visualization.OrgChart(document.getElementById('chart_div'));
        // Draw the chart, setting the allowHtml option to true for the tooltips.
        chart.draw(data, {'allowHtml':true});
    }*/

    //https://developers.google.com/chart/interactive/docs/gallery/orgchart
