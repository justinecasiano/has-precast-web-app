<?php
  session_start();

  $_SESSION["current"] = "reports";
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
  <link href="https://fonts.googleapis.com/css2?family=Inter+Tight:wght@200;300;400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- CSS stylesheets -->
  <link rel="stylesheet" href="styles/admin-global.css">
  <link rel="stylesheet" href="styles/reports.css">
  <!-- Insert webpage specific stylesheets here -->

</head>

<body>

<?php
  include("includes/admin-editor-header-sidebar.php");
?>

  

  <main>
    <div class="main-header">
      <h1>Reports</h1>
      <button class="print">Print</button>
    </div>

    <?php include 'classes/charts.php'; ?>
<section class="tablewrap">
    <div class="table">
    <form>
        <select  name="filtertab" id="filtertab"  onchange="updateTable()">
            <option value="overall">Overall</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
            <option value="daily">Daily</option>
        </select>
    </form>
        <h2>Sales</h2>
      
        <table id="dataTable">
            <thead>
            <tr><th>Billing ID</th><th>Sales</th><th>Billing Date</th></tr>
</thead>
<tbody>
            <?php
    
    foreach ($overall_data as $row) {
        echo "<tr>";
        echo "<td>" . $row['billing_id'] . "</td>";
        echo "<td>" . $row['total_quotation'] . "</td>";
        echo "<td>" . $row['billing_date'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
        </table>
    </div>


    <div class="table">
    <form>
        <select  name="filtertab2" id="filtertab2"  onchange="updateTable2()">
            <option value="overall">Overall</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
            <option value="daily">Daily</option>
        </select>
    </form>
    <h2>Payments</h2>
   
        <table id="dataTable2">
            <thead>
            <tr><th>Billing ID</th><th>Name</th><th>Payment Method</th><th>Payment Reference</th><th>Payment Status</th><th>Payment Date</th></tr>
</thead>
<tbody>
            <?php
    
    foreach ($overall_data2 as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['payment_method'] . "</td>";
        echo "<td>" . $row['payment_reference'] . "</td>";
        echo "<td>" . $row['payment_status'] . "</td>";
        echo "<td>" . $row['payment_date'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
        </table>
    </div>


    <div class="table">
    <form>
        <select  name="filtertab3" id="filtertab3"  onchange="updateTable3()">
            <option value="overall">Overall</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
            <option value="daily">Daily</option>
        </select>
    </form>
    <h2>Current Billings</h2>
    
        <table id="dataTable3">
            <thead>
            <tr><th>Billing ID</th><th>Sales</th><th>Status</th><th>Billing Date</th></tr>
</thead>
<tbody>
            <?php
    
    foreach ($overall_data3 as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['quotation'] . "</td>";
        echo "<td>" . $row['status'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
        </table>
    </div>





    <div class="table">
    <form>
        <select  name="filtertab4" id="filtertab4"  onchange="updateTable4()">
            <option value="overall">Overall</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
            <option value="daily">Daily</option>
        </select>
    </form>
    <h2>Clients</h2>
   
        <table id="dataTable4">
            <thead>
            <tr><th>Account ID</th><th>Name</th><th>Account Type</th><th>Date Created</th></tr>
</thead>
<tbody>
            <?php
    
    foreach ($overall_data4 as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['full_name'] . "</td>";
        echo "<td>" . $row['type'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
        </table>
    </div>


    <div class="table">
    <form>
        <select  name="filtertab5" id="filtertab5"  onchange="updateTable5()">
            <option value="overall">Overall</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
            <option value="daily">Daily</option>
        </select>
    </form>
    <h2>Designs Sold</h2>
   




        <table id="dataTable5">
            <thead>
            <tr><th>Billing ID</th><th>Design Name</th><th>Quantity</th><th>Price</th><th>Date Created</th></tr>
</thead>
<tbody>
            <?php
    
    foreach ($overall_data5 as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['design_name'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
        </table>
    </div>




    <div class="table">
    <form>
        <select  name="filtertab6" id="filtertab6"  onchange="updateTable6()">
            <option value="overall">Overall</option>
            <option value="monthly">Monthly</option>
            <option value="weekly">Weekly</option>
            <option value="daily">Daily</option>
        </select>
    </form>
    <h2>Sizes Sold</h2>
  
        <table id="dataTable6">
            <thead>
            <tr><th>Order ID</th><th>Size</th><th>Quantity</th><th>Price</th><th>Order Date</th></tr>
</thead>
<tbody>
            <?php
    
    foreach ($overall_data6 as $row) {
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['size_name'] . "</td>";
        echo "<td>" . $row['quantity'] . "</td>";
        echo "<td>" . $row['price'] . "</td>";
        echo "<td>" . $row['created_at'] . "</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
        </table>
    </div>
</section>
<script>
var overallData = <?php echo $overall_json; ?>;
    var monthlyData = <?php echo $monthly_json; ?>;
    var weeklyData = <?php echo $weekly_json; ?>;
    var dailyData = <?php echo $daily_json; ?>;

    function updateTable() {
        var filter = document.getElementById("filtertab").value;
        var data;

        switch (filter) {
            case "monthly":
                data = monthlyData;
                break;
            case "weekly":
                data = weeklyData;
                break;
            case "daily":
                data = dailyData;
                break;
            default:
                data = overallData;
                break;
        }

        var table = document.getElementById("dataTable");
        var tbody = table.getElementsByTagName("tbody")[0];
        tbody.innerHTML = ""; // Clear table body

        // Populate table with filtered data
        data.forEach(function(rowData) {
            var row = document.createElement("tr");

            Object.values(rowData).forEach(function(value) {
                var cell = document.createElement("td");
                cell.textContent = value;
                row.appendChild(cell);
            });

            tbody.appendChild(row);
        });
    }


    var overallData2 = <?php echo $overall_json2; ?>;
    var monthlyData2 = <?php echo $monthly_json2; ?>;
    var weeklyData2 = <?php echo $weekly_json2; ?>;
    var dailyData2= <?php echo $daily_json2; ?>;

    function updateTable2() {
        var filter = document.getElementById("filtertab2").value;
        var data2;

        switch (filter) {
            case "monthly":
                data2 = monthlyData2;
                break;
            case "weekly":
                data2 = weeklyData2;
                break;
            case "daily":
                data2 = dailyData2;
                break;
            default:
                data2 = overallData2;
                break;
        }

        var table = document.getElementById("dataTable2");
        var tbody = table.getElementsByTagName("tbody")[0];
        tbody.innerHTML = ""; // Clear table body

        // Populate table with filtered data
        data2.forEach(function(rowData) {
            var row = document.createElement("tr");

            Object.values(rowData).forEach(function(value) {
                var cell = document.createElement("td");
                cell.textContent = value;
                row.appendChild(cell);
            });

            tbody.appendChild(row);
        });
    }





    var overallData3 = <?php echo $overall_json3; ?>;
    var monthlyData3 = <?php echo $monthly_json3; ?>;
    var weeklyData3 = <?php echo $weekly_json3; ?>;
    var dailyData3 = <?php echo $daily_json3; ?>;

    function updateTable3(){
    var filter = document.getElementById("filtertab3").value;
    var data3;

    switch (filter) {
        case "monthly":
            data3 = monthlyData3;
            break;
        case "weekly":
            data3 = weeklyData3;
            break;
        case "daily":
            data3 = dailyData3;
            break;
        default:
            data3 = overallData3;
            break;
    }

    var table = document.getElementById("dataTable3");
    var tbody = table.getElementsByTagName("tbody")[0]; // Changed index to 0

    // Clear table body
    tbody.innerHTML = "";

    // Populate table with filtered data
    data3.forEach(function(rowData) { // Changed data to data3
        var row = document.createElement("tr");

        Object.values(rowData).forEach(function(value) {
            var cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });
}

var overallData4= <?php echo $overall_json4; ?>;
    var monthlyData4 = <?php echo $monthly_json4; ?>;
    var weeklyData4= <?php echo $weekly_json4; ?>;
    var dailyData4 = <?php echo $daily_json4; ?>;

    function updateTable4(){
    var filter = document.getElementById("filtertab4").value;
    var data4;

    switch (filter) {
        case "monthly":
            data4 = monthlyData4;
            break;
        case "weekly":
            data4 = weeklyData4;
            break;
        case "daily":
            data4 = dailyData4;
            break;
        default:
            data4 = overallData4;
            break;
    }

    var table = document.getElementById("dataTable4");
    var tbody = table.getElementsByTagName("tbody")[0]; // Changed index to 0

    // Clear table body
    tbody.innerHTML = "";

    // Populate table with filtered data
    data4.forEach(function(rowData) { 
        var row = document.createElement("tr");

        Object.values(rowData).forEach(function(value) {
            var cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });
}

var overallData5= <?php echo $overall_json5 ?>;
    var monthlyData5 = <?php echo $monthly_json5; ?>;
    var weeklyData5= <?php echo $weekly_json5; ?>;
    var dailyData5 = <?php echo $daily_json5; ?>;

    function updateTable5(){
    var filter = document.getElementById("filtertab5").value;
    var data5;

    switch (filter) {
        case "monthly":
            data5 = monthlyData5;
            break;
        case "weekly":
            data5 = weeklyData5;
            break;
        case "daily":
            data5 = dailyData5;
            break;
        default:
            data5 = overallData5;
            break;
    }

    var table = document.getElementById("dataTable5");
    var tbody = table.getElementsByTagName("tbody")[0]; // Changed index to 0

    // Clear table body
    tbody.innerHTML = "";

    // Populate table with filtered data
    data5.forEach(function(rowData) { 
        var row = document.createElement("tr");

        Object.values(rowData).forEach(function(value) {
            var cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });
}




var overallData6= <?php echo $overall_json6 ?>;
    var monthlyData6 = <?php echo $monthly_json6; ?>;
    var weeklyData6= <?php echo $weekly_json6; ?>;
    var dailyData6 = <?php echo $daily_json6; ?>;

    function updateTable6(){
    var filter = document.getElementById("filtertab6").value;
    var data6;

    switch (filter) {
        case "monthly":
            data6 = monthlyData6;
            break;
        case "weekly":
            data6= weeklyData6;
            break;
        case "daily":
            data6 = dailyData6;
            break;
        default:
            data6 = overallData6;
            break;
    }

    var table = document.getElementById("dataTable6");
    var tbody = table.getElementsByTagName("tbody")[0]; // Changed index to 0

    // Clear table body
    tbody.innerHTML = "";

    // Populate table with filtered data
    data6.forEach(function(rowData) { 
        var row = document.createElement("tr");

        Object.values(rowData).forEach(function(value) {
            var cell = document.createElement("td");
            cell.textContent = value;
            row.appendChild(cell);
        });

        tbody.appendChild(row);
    });
}
    document.querySelector('.print').addEventListener('click', function() {
    const printArea = document.querySelector('.tablewrap');
      document.body.innerHTML = printArea.innerHTML;
      setTimeout(() => window.print(), 200);
    });
    window.addEventListener('afterprint', () => location.reload());
</script>
</body>
</html>

