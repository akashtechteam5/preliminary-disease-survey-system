<?php include APPPATH.'views/layout/header.php'; ?>\
<script src="<?php echo $PUBLIC_URL . 'js/highcharts.js';?>"></script>
<script src="<?php echo $PUBLIC_URL . 'js/series-label.js';?>"></script>
<script src="<?php echo $PUBLIC_URL . 'js/exporting.js';?>"></script>
<script src="<?php echo $PUBLIC_URL . 'js/export-data.js';?>"></script>
<script src="<?php echo $PUBLIC_URL . 'js/accessibility.js';?>"></script>
<div class="covid-main">
    <div class="container">
<div class="row">
    <div class="col-sm-3">
        <div class="tile-covid">
            <h4>Total Users</h4>
            <p><?php echo $total_users_count;?></p>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-covid">
            <h4>Today's Users</h4>
            <p><?php echo $today_users_count;?></p>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-covid">
            <h4>No of Yellow</h4>
            <p><?php echo $yellow_users;?></p>
        </div>
    </div>
    <div class="col-sm-3">
        <div class="tile-covid">
            <h4>No of Red</h4>
            <p><?php echo $red_users;?></p>
        </div>
    </div>
</div>
</div>
</div>
<!--<div class="covid-main-chart">
    <div class="container">
<div class="row">
    <div class="col-sm-12">
<figure class="highcharts-figure">
    <div id="chart-line"></div>
    
</figure>
        </div>
</div>
                </div>
</div>-->
<script>
    Highcharts.chart('chart-line', {

    title: {
        text: 'PDSS Enrollment - 2020'
    },

    subtitle: {
        text: 'User Enrollment'
    },

    yAxis: {
        title: {
            text: 'Number of Users'
        }
    },

    xAxis: {
        accessibility: {
            rangeDescription: 'Range: 2020 to 2021'
        }
    },

    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'middle'
    },

    plotOptions: {
        series: {
            label: {
                connectorAllowed: false
            },
            pointStart: 2020
        }
    },

    series: [{
        name: 'Users',
        data: [1, 3, 5, 7, 9, 10, 15, 100]
    }, {
        name: 'Green',
        data: [1, 3, 5, 7, 9, 10, 15, 100]
    }, {
        name: 'Yellow',
        data: [1, 3, 5, 7, 9, 10, 15, 100]
    }, {
        name: 'Red',
        data: [1, 3, 5, 7, 9, 10, 15, 100]
    }],

    responsive: {
        rules: [{
            condition: {
                maxWidth: 500
            },
            chartOptions: {
                legend: {
                    layout: 'horizontal',
                    align: 'center',
                    verticalAlign: 'bottom'
                }
            }
        }]
    }

});
</script>
<style>
.tile-covid {
    background-color: #56cece;
    text-align: center;
    padding: 20px 0 20px;
    box-shadow: 0 0 2px 1px #00000029;
    
}
.tile-covid h4 {
    text-transform: uppercase;
    color: #333;
    font-weight: 600;
}
.covid-main {
    padding: 40px 0 40px;
    position: relative;
}
</style>

<?php include APPPATH.'views/layout/footer.php'; ?>