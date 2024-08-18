<?php
session_start();

if (isset($_GET['userid'])) {
  $_SESSION['userid'] = $_GET['userid'];
  $_SESSION['userAccountType'] = $_GET['userAccountType'];
}

if (isset($_SESSION['userAccountType'])) {
  if ($_SESSION['userAccountType'] === 'Editor') {
    header("location: /has-precast/content-management.php?");
    exit;
  }
} else {
  header("location: /has-precast/admin-log-in.php?");
  exit;
}

$_SESSION["current"] = "dashboard";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>H&As' Precast</title>

  <!-- Site icon here -->

  <!-- Fonts used are downloaded here -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <!-- CSS stylesheets -->
  <link rel="stylesheet" href="styles/admin-global.css">
  <link rel="stylesheet" href="styles/dashboard.css">
  <link rel="stylesheet" href="styles/reports.css">
  <script src="scripts/global.js"></script>
  <!-- Insert webpage specific stylesheets here -->

</head>

<body>

  <?php
  include("includes/admin-editor-header-sidebar.php");
  ?>

  <main>
    <div class="main-header">
      <h1>Dashboard</h1>
      <button class="print">Print</button>
    </div>

  <?php include 'classes/charts.php'; ?>
  <section class="reports">
    <div class="overallcontents">
        <div class="linecontainer">
        <form id="filterForm">
            <select id="filter" onchange="updateChart()">
            <option value="overall">Yearly</option>
                <option value="monthly">Monthly</option>
                <option value="weekly">Weekly</option>
                <option value="daily">Daily</option>
            </select>
        </form>
            <h2 id="mon">Total Sales&nbsp-&nbspP<?php echo $overallSalesLast3Years?></h2>
            <div class="chartBox">
                <canvas id="myChart" onclick="showTable()"></canvas>
            </div>
            <div class="adddetails">
                <p id="det1">2 Months Ago&nbsp-&nbspP<?php echo $two_months_ago_sales !== 0 ? $two_months_ago_sales :0?></p>
                <p id="det2">Previous Month&nbsp-&nbspP<?php echo $previous_month_sales?></p>
                <p id="det3">Current Month&nbsp-&nbspP<?php echo $current_month_sales?></p>
            </div>
        </div>
        <div class="piecontainer">
            <div class="pie1">
              <form id="filterPie1">
                      <select id="filter1" onchange="updatePieChart()">
                      <option value="overall">Overall</option>
                          <option value="monthly">Monthly</option>
                          <option value="weekly">Weekly</option>
                          <option value="daily">Daily</option>
                      </select>
            </form>
                <h2 id="totalBillingsTitle">Total Billings&nbsp-&nbsp<?php echo $total_billings; ?></h2>
                <div class="chartBox1">
                    <canvas id="myChart1"></canvas>
                    
                </div>
                <div class="legend" id="legendContent">
                        <?php
                        foreach ($chartLabels1 as $index => $label) {
                            echo '<div class="legend-item">';
                            echo '<span class="legend-color" style="background-color:' . $chartData1['datasets'][0]['backgroundColor'][$index] . '"></span>';
                            echo '<span class="legend-label">' . $label . ' - ' . $chartData1['datasets'][0]['data'][$index] . '</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
            </div>
            <div class="pie1">
            <form id="filterPie2">
                      <select id="filter2" onchange="updatePieChart2()">
                      <option value="overall">Overall</option>
                          <option value="monthly">Monthly</option>
                          <option value="weekly">Weekly</option>
                          <option value="daily">Daily</option>
                      </select>
            </form>
                <h2 id="totalusersTitle">Engagements&nbsp-&nbsp<?php echo $total_users; ?></h2>
                <div class="chartBox1">
                    <canvas id="myChart2"></canvas>
                    
                </div>
                <div class="legend" id="legendContent2">
                        <?php
                        // Generate legend dynamically
                        foreach ($chartLabels2 as $index => $label) {
                            echo '<div class="legend-item">';
                            echo '<span class="legend-color" style="background-color:' . $chartData2['datasets'][0]['backgroundColor'][$index] . '"></span>';
                            echo '<span class="legend-label">' . $label . ' - ' . $chartData2['datasets'][0]['data'][$index] . '</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
            </div>
            <div class="pie1">
            <form id="filterPie3">
                      <select id="filter3" onchange="updatePieChart3()">
                      <option value="overall">Overall</option>
                          <option value="monthly">Monthly</option>
                          <option value="weekly">Weekly</option>
                          <option value="daily">Daily</option>
                      </select>
            </form>
                <h2 id="designcount">Most Sold Design&nbsp-&nbsp<?php echo $most_sold_design_overall ?></h2>
                <div class="chartBox1">
                    <canvas id="myChart3" onclick="showTable3()"></canvas>
                    
                </div>
                <div class="legend" id="legendContent3">
                        <?php
                        // Generate legend dynamically
                        foreach ($chartLabels3 as $index => $label) {
                            echo '<div class="legend-item">';
                            echo '<span class="legend-color" style="background-color:' . $chartData3['datasets'][0]['backgroundColor'][$index] . '"></span>';
                            echo '<span class="legend-label">' . $label . ' - ' . $chartData3['datasets'][0]['data'][$index] . '</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
            </div>
            <div class="pie1">
            <form id="filterPie4">
                      <select id="filter4" onchange="updatePieChart4()">
                      <option value="overall">Overall</option>
                          <option value="monthly">Monthly</option>
                          <option value="weekly">Weekly</option>
                          <option value="daily">Daily</option>
                      </select>
            </form>
                <h2 id="sizecount">Most Sold Size&nbsp-&nbsp<?php echo $most_sold_size_overall?></h2>
                <div class="chartBox1">
                    <canvas id="myChart4" onclick="showTable4()"></canvas>
                    
                </div>
                <div class="legend" id="legendContent4">
                        <?php
                        // Generate legend dynamically
                        foreach ($chartLabels4 as $index => $label) {
                            echo '<div class="legend-item">';
                            echo '<span class="legend-color" style="background-color:' . $chartData4['datasets'][0]['backgroundColor'][$index] . '"></span>';
                            echo '<span class="legend-label">' . $label . ' - ' . $chartData4['datasets'][0]['data'][$index] . '</span>';
                            echo '</div>';
                        }
                        ?>
                    </div>
            </div>
        </div>
    </div>
</section>
    <section class="dashboard">
        <div class="dashboardcontents">
            <div class="lowercontent">
                <div class="quicklinks">
                    <h2 style="color: var(--clr-secondary);">Quick Links</h2>
                    <ul>
                        <li onclick="window.location.href='edit-content.php?page=products';"><img src="images/dashboard/Group 86.svg" alt="icon"/><h2>Add Products</h2></a></li>
                        <li onclick="window.location.href='edit-content.php?page=hero';"><img src="images/dashboard/Image File Add.svg" alt="icon"/><h2>Add Hero Image</h2></a></li>
                        <li onclick="window.location.href='edit-content.php?page=projects';"><img src="images/dashboard/Constructing.svg" alt="icon"/><h2>Add Project</h2></a></li>
                        <li onclick="window.location.href='add-editor.php';"><img src="images/dashboard/Photo Editor.svg" alt="icon"/><h2>Add Editor</h2></a></li>
                        <li onclick="window.location.href='account-management-client.php';"><img src="images/dashboard/Businessman.svg" alt="icon"/><h2>Edit Clients</h2></a></li>
                        <li onclick="window.location.href='reports.php';"><img src="images/dashboard/Project.svg" alt="icon"/><h2>View More Reports</h2></a></li>
                    </ul>

                </div>
            </div>
        </div>
    </section>

    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.umd.min.js"></script>
    <script>
       const overlabels = <?php echo $yearLabelsEncoded; ?>;
const oversalesDatamonth = <?php echo $yearlySalesDataEncoded; ?>;
const labels = <?php echo json_encode($month_labels); ?>;
const salesDatamonth = <?php echo json_encode($salesData); ?>;
const weekLabels = <?php echo $week_labels_encoded; ?>;
const weeklySales = <?php echo $weekly_sales_encoded; ?>;
const dailyLabels = <?php echo $day_labels; ?>;
const dailySales = <?php echo $daily_sales; ?>;

const salesData = {
    overall: oversalesDatamonth,
    daily: dailySales,
    weekly: weeklySales,
    monthly: salesDatamonth
};

const labelsforline = {
    overall: overlabels,
    daily: dailyLabels,
    weekly: weekLabels,
    monthly: labels
};

const ctx = document.getElementById('myChart').getContext('2d');
let salesChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: overlabels, // Set yearly labels as default
        datasets: [{
            label: 'Yearly Sales',
            data: oversalesDatamonth, // Set yearly sales as default
            borderWidth: 1,
            borderColor: 'red'
        }]
    },
    options: {
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

function updateChart() {
    const filter = document.getElementById('filter').value;
    const newLabels = labelsforline[filter];
    const newData = salesData[filter];

    salesChart.data.labels = newLabels;
    salesChart.data.datasets[0].data = newData;
    salesChart.data.datasets[0].label = filter.charAt(0).toUpperCase() + filter.slice(1) + ' Sales';

    let totalSales;
    let det1Text = ''; 
    let det2Text = '';
    let det3Text = '';

    // Update chart data and total billings based on filter value
    switch (filter) {
        case 'overall':
            totalSales = <?php echo $overallSalesLast3Years; ?>;
            det1Text = 'Last 2 Years Ago - P' + <?php echo $two_years_ago_sales !== 0 ? $two_years_ago_sales :0?>;
            det2Text = 'Previous Year - P' + <?php echo $prev_year_sales !== 0 ? $prev_year_sales:0?>;
            det3Text = 'Current Year - P' + <?php echo $curr_year_sales !== 0 ? $curr_year_sales :0?>;
            break;
        case 'monthly':
            totalSales = <?php echo $overall_sales; ?>;
            det1Text = '2 Months Ago - P' + <?php echo $two_months_ago_sales !== 0 ? $two_months_ago_sales :0?>;
            det2Text = 'Previous Month - P' + <?php echo $previous_month_sales !== 0 ? $previous_month_sales :0?>;
            det3Text = 'Current Month - P' + <?php echo $current_month_sales !== 0 ? $current_month_sales :0?>;
            break;
        case 'weekly':
            totalSales = <?php echo $totalWeeklySales; ?>;
            det1Text = '2 Weeks Ago - P' + <?php echo $two_weeks_ago_sales?>;
            det2Text = 'Previous Week - P' + <?php echo $prev_week_sales?>;
            det3Text = 'Current Week - P' + <?php echo $current_week_sales?>;
            break;
        case 'daily':
            totalSales = <?php echo $totalDailySales; ?>;
            det1Text = '2 Days Ago - P' + <?php echo $prev_2day_sales?>;
            det2Text = 'Previous Day - P' + <?php echo $prev_day_sales?>;
            det3Text = 'Current Day- P' + <?php echo $current_day_sales?>;
            break;
        default:
            totalSales = <?php echo $overallSalesLast3Years; ?>; 
            det1Text = 'Last 2 Years Ago - P' + <?php echo $two_months_ago_sales !== 0 ? $two_months_ago_sales :0?>;
            det1Text = 'Previous Year - P' + <?php echo $two_months_ago_sales !== 0 ? $two_months_ago_sales :0?>;
            det1Text = 'Current Year Ago - P' + <?php echo $two_months_ago_sales !== 0 ? $two_months_ago_sales :0?>;
    }

    salesChart.update();

    document.getElementById('mon').innerText = 'Total Sales - ' + totalSales;
    document.getElementById('det1').innerText = det1Text; 
    document.getElementById('det2').innerText = det2Text; 
    document.getElementById('det3').innerText = det3Text; 
}

document.addEventListener('DOMContentLoaded', (event) => {
    updateChart();
});

    const chartData1 = <?php echo $chartDataJSON; ?>;
    const chartData1monthly = <?php echo $chartDataJSONMonthly; ?>;
    const chartData1weekly = <?php echo $chartDataJSONWeekly; ?>;
    const chartData1daily = <?php echo $chartDataJSONDaily; ?>;

    const config1 = {
        type: 'pie',
        data: chartData1,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    };

    // Render the initial chart
    const myChart1 = new Chart(
        document.getElementById('myChart1'),
        config1
    );

    // Function to update the chart based on selected filter
    function updatePieChart() {
    const filterValue = document.getElementById('filter1').value;
    let newData;
    let totalBillings;

    // Update chart data and total billings based on filter value
    switch (filterValue) {
        case 'overall':
            newData = chartData1;
            totalBillings = <?php echo $total_billings; ?>;
            break;
        case 'monthly':
            newData = chartData1monthly;
            totalBillings = <?php echo $total_monthly_billings; ?>;
            break;
        case 'weekly':
            newData = chartData1weekly;
            totalBillings = <?php echo $total_weekly_billings; ?>;
            break;
        case 'daily':
            newData = chartData1daily;
            totalBillings = <?php echo $total_daily_billings; ?>;
            break;
        default:
            newData = chartData1;
            totalBillings = <?php echo $total_billings; ?>;
    }

    // Update the chart with new data
    myChart1.data = newData;
    myChart1.update();

    // Update total billings title
    document.getElementById('totalBillingsTitle').innerText = 'Total Billings - ' + totalBillings;

    // Update legend content
    const legendContent = document.getElementById('legendContent');
    legendContent.innerHTML = ''; // Clear previous content
    newData.labels.forEach((label, index) => {
        legendContent.innerHTML += '<div class="legend-item">' +
            '<span class="legend-color" style="background-color:' + newData.datasets[0].backgroundColor[index] + '"></span>' +
            '<span class="legend-label">' + label + ' - ' + newData.datasets[0].data[index] + '</span>' +
            '</div>';
    });
}


const chartData2 = <?php echo $chartData2JSON; ?>;
    const chartData2monthly = <?php echo $chartData2JSONMonthly; ?>;
    const chartData2weekly = <?php echo $chartData2JSONWeekly; ?>;
    const chartData2daily = <?php echo $chartData2JSONDaily; ?>;

    const config2 = {
        type: 'pie',
        data: chartData2,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    };

    // Render the initial chart
    const myChart2 = new Chart(
        document.getElementById('myChart2'),
        config2
    );

    // Function to update the chart based on selected filter
    function updatePieChart2() {
    const filterValue = document.getElementById('filter2').value;
    let newData2;
    let totalusers;

    // Update chart data and total users based on filter value
    switch (filterValue) {
        case 'overall':
            newData2 = chartData2;
            totalusers = <?php echo $total_users; ?>;
            break;
        case 'monthly':
            newData2 = chartData2monthly;
            totalusers = <?php echo $total_monthly_users; ?>;
            break;
        case 'weekly':
            newData2 = chartData2weekly;
            totalusers = <?php echo $total_weekly_users; ?>;
            break;
        case 'daily':
            newData2 = chartData2daily;
            totalusers = <?php echo $total_daily_users; ?>;
            break;
        default:
            newData2 = chartData2;
            totalusers = <?php echo $total_users; ?>;
    }

    // Update the chart with new data
    myChart2.data = newData2;
    myChart2.update();

    // Update total users title
    document.getElementById('totalusersTitle').innerText = 'Engagements - ' + totalusers;

    // Update legend content
    const legendContent2 = document.getElementById('legendContent2');
    legendContent2.innerHTML = ''; // Clear previous content
    newData2.labels.forEach((label, index) => {
        legendContent2.innerHTML += '<div class="legend-item">' +
            '<span class="legend-color" style="background-color:' + newData2.datasets[0].backgroundColor[index] + '"></span>' +
            '<span class="legend-label">' + label + ' - ' + newData2.datasets[0].data[index] + '</span>' +
            '</div>';
    });
}
    

const chartData3 = <?php echo $chartData3JSON; ?>;
    const chartData3monthly = <?php echo $chartData3JSONMonthly; ?>;
    const chartData3weekly = <?php echo $chartData3JSONWeekly; ?>;
    const chartData3daily = <?php echo $chartData3JSONDaily; ?>;

    const config3 = {
        type: 'pie',
        data: chartData3,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    };

    // Render the initial chart
    const myChart3 = new Chart(
        document.getElementById('myChart3'),
        config3
    );


    
    const overalldes=<?php echo json_encode($most_sold_design_overall); ?>;
    const monthlydes=<?php echo json_encode($most_sold_design_monthly); ?>;
    const weeklydes=<?php echo json_encode($most_sold_design_weekly); ?>;
    const dailydes=<?php echo json_encode($most_sold_design_daily); ?>;

    // Function to update the chart based on selected filter
    function updatePieChart3() {
    const filterValue = document.getElementById('filter3').value;
    let newData3;
    let count;

    // Update chart data and total users based on filter value
    switch (filterValue) {
        case 'overall':
            newData3 = chartData3;
            count = overalldes;
            break;
        case 'monthly':
            newData3= chartData3monthly;
            count= monthlydes;
            break;
        case 'weekly':
            newData3 = chartData3weekly;
            count = weeklydes;
            break;
        case 'daily':
            newData3 = chartData3daily;
            count = dailydes;
            break;
        default:
            newData3 = chartData3;
            count =  overalldes;
    }

  
    myChart3.data = newData3;
    myChart3.update();


    document.getElementById('designcount').innerText = 'Most Sold Design - ' + count;

   
    const legendContent3 = document.getElementById('legendContent3');
    legendContent3.innerHTML = ''; // Clear previous content
    newData3.labels.forEach((label, index) => {
        legendContent3.innerHTML += '<div class="legend-item">' +
            '<span class="legend-color" style="background-color:' + newData3.datasets[0].backgroundColor[index] + '"></span>' +
            '<span class="legend-label">' + label + ' - ' + newData3.datasets[0].data[index] + '</span>' +
            '</div>';
    });
}





 
const chartData4 = <?php echo $chartData4JSON; ?>;
    const chartData4monthly = <?php echo $chartData4JSONMonthly; ?>;
    const chartData4weekly = <?php echo $chartData4JSONWeekly; ?>;
    const chartData4daily = <?php echo $chartData4JSONDaily; ?>;

    const config4 = {
        type: 'pie',
        data: chartData4,
        options: {
            plugins: {
                legend: {
                    display: false
                }
            },
        }
    };

    // Render the initial chart
    const myChart4 = new Chart(
        document.getElementById('myChart4'),
        config4
    );
    const overallsize=<?php echo json_encode($most_sold_size_overall); ?>;
    const monthlysize=<?php echo json_encode($most_sold_size_monthly); ?>;
    const weeklysize=<?php echo json_encode($most_sold_size_weekly); ?>;
    const dailysize=<?php echo json_encode($most_sold_size_daily ); ?>;

    // Function to update the chart based on selected filter
    function updatePieChart4() {
    const filterValue = document.getElementById('filter4').value;
    let newData4;
    let scount;

    // Update chart data and total users based on filter value
    switch (filterValue) {
        case 'overall':
            newData4 = chartData4;
            scount = overallsize;
            break;
        case 'monthly':
            newData4= chartData4monthly;
            scount= monthlysize;
            break;
        case 'weekly':
            newData4= chartData4weekly;
            scount = weeklysize;
            break;
        case 'daily':
            newData4 = chartData4daily;
            scount = dailysize;
            break;
        default:
            newData4 = chartData4;
            scount =  overallsize;
    }

    // Update the chart with new data
    myChart4.data = newData4;
    myChart4.update();

    // Update total users title
    document.getElementById('sizecount').innerText = 'Most Sold Size - ' + scount;

    // Update legend content
    const legendContent4 = document.getElementById('legendContent4');
    legendContent4.innerHTML = ''; // Clear previous content
    newData4.labels.forEach((label, index) => {
        legendContent4.innerHTML += '<div class="legend-item">' +
            '<span class="legend-color" style="background-color:' + newData4.datasets[0].backgroundColor[index] + '"></span>' +
            '<span class="legend-label">' + label + ' - ' + newData4.datasets[0].data[index] + '</span>' +
            '</div>';
    });
}
 
 
</script>

</main>
  <script src="https://unpkg.com/jspdf@latest/dist/jspdf.umd.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/jspdf-html2canvas@latest/dist/jspdf-html2canvas.min.js"></script>

<script>
        // Track the initial width and height
        let initialWidth = window.innerWidth;
        let initialHeight = window.innerHeight;

        // Function to check for zoom
        function checkZoom() {
            // Compare current dimensions with initial dimensions
            if (window.innerWidth !== initialWidth || window.innerHeight !== initialHeight) {
                // Reload the page if dimensions have changed (indicating a possible zoom)
                location.reload();
            }
        }

        // Listen for resize events
        window.addEventListener('resize', checkZoom);

    let btn = document.querySelector('.print');
    let content = document.querySelector('.reports');

    btn.addEventListener('click', function() {
      html2PDF(content, {
        jsPDF: {
          format: 'letter',
        },
        imageType: 'image/jpeg',
        output: 'dashboard.pdf'
      });
    });

    </script>
  
</body>

</html>