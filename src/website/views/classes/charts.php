<?php

$servername = "localhost"; 
$username = "has_admin"; 
$password = "wc8KTRfrJrTpe8"; 
$database = "has_precast"; 
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$currentMonth = date('n');
$currentYear = date('Y');


$monthsToFetch = array(
    ($currentMonth - 2 + 12) % 12, 
    ($currentMonth - 1 + 12) % 12, 
    $currentMonth 
);
$salesData = array_fill(0, 3, 0);
foreach ($monthsToFetch as $key => $month) {
    $query = "
        SELECT 
            SUM(quotation) AS total_sales
        FROM 
            billing
        WHERE 
            status = 'closed'
            AND MONTH(created_at) = $month
            AND YEAR(created_at) = $currentYear
    ";

    
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

   
    $row = mysqli_fetch_assoc($result);
    $salesData[$key] = $row['total_sales'];

    
    mysqli_free_result($result);
}


for ($i = 0; $i < count($salesData); $i++) {
    if ($salesData[$i] === null) {
        $salesData[$i] = 0;
    }
}


$month_labels = array(
    date('F', mktime(0, 0, 0, $monthsToFetch[0], 1, $currentYear)), // Two months ago
    date('F', mktime(0, 0, 0, $monthsToFetch[1], 1, $currentYear)), // Previous month
    date('F', mktime(0, 0, 0, $monthsToFetch[2], 1, $currentYear))  // Current month
);
$overall_sales = round(array_sum($salesData), 2);
$two_months_ago_sales = $salesData[0];
$previous_month_sales = $salesData[1];
$current_month_sales = $salesData[2];

$month_labels_encoded = json_encode($month_labels);
$sales_data_encoded = json_encode($salesData);




$sql_billing_count = "SELECT status, COUNT(*) AS status_count FROM billing GROUP BY status";


$result_billing_count = mysqli_query($conn, $sql_billing_count);


$billing_counts = array();

while ($row = mysqli_fetch_assoc($result_billing_count)) {
    $billing_counts[$row['status']] = $row['status_count'];
}
$total_billings = array_sum($billing_counts);

//dito mo pwede baguhin kulay pre
$predefinedcolors=['aquamarine','pink','yellow'];


$chartLabels1 = array_keys($billing_counts);
$chartData1 = [
    'labels' => $chartLabels1,
    'datasets' => [
        [
            'data' => array_values($billing_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels1)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels1)),
            'borderWidth' => 1
        ]
    ]
];

$chartDataJSON = json_encode($chartData1);



$sql_users_count = "SELECT ac.type, COUNT(*) AS users_count 
                    FROM account a
                    INNER JOIN account_type ac ON a.type_id = ac.id
                    GROUP BY ac.type";


$result_users_count = mysqli_query($conn, $sql_users_count);


$users_counts = array();


while ($row = mysqli_fetch_assoc($result_users_count)) {
    $users_counts[$row['type']] = $row['users_count'];
}
$total_users = array_sum($users_counts); 


$predefinedcolors=['#3399FF','#cd7f32','#C0C0C0', '#FFD700'];

$chartLabels2 = array_keys($users_counts);
$chartData2 = [
    'labels' => $chartLabels2,
    'datasets' => [
        [
            'data' => array_values($users_counts),
            'backgroundColor' => [],
            'borderColor' => [],
            'borderWidth' => 1
        ]
    ]
];

foreach ($users_counts as $type => $count) {
    if (count($predefinedcolors) > 0) {
        $color = array_shift($predefinedcolors);
    } else {
        $color = generateRandomColor();
    }
    $chartData2['datasets'][0]['backgroundColor'][] = $color;
    $chartData2['datasets'][0]['borderColor'][] = $color;
}

$chartDataJSON2 = json_encode($chartData2);



$sql_design_count = "SELECT wfb.design_name, SUM(o.quantity) AS total_quantity
                     FROM wall_form_block wfb
                     LEFT JOIN `order` o ON wfb.id = o.wall_form_block_id
                     LEFT JOIN billing b ON o.billing_id = b.id
                     WHERE b.status = 'CLOSED'
                     GROUP BY wfb.design_name";


$result_design_count = mysqli_query($conn, $sql_design_count);

$design_counts = array();

while ($row = mysqli_fetch_assoc($result_design_count)) {
    $design_counts[$row['design_name']] = $row['total_quantity'];
}

$best_selling_design = '';
if (!empty($design_counts)) {
    $best_selling_design = array_search(max($design_counts), $design_counts);
} else {
    $best_selling_design = 'N/A';
}

$total_designs = array_sum($design_counts);
$chartLabels3 = array_keys($design_counts);
$chartData3= [
    'labels' => $chartLabels3,
    'datasets' => [
        [
            'data' => array_values($design_counts),
            'backgroundColor' => [],
            'borderColor' => [],
            'borderWidth' => 1
        ]
    ]
];

//dito mo pwede baguhin kulay pre
$predefinedcolors=['#F2E2CE','#A2D729','#B3D9FF'];


$predefinedColorCount = count($predefinedcolors);
$colorIndex = 0; 

$chartLabels3 = array_keys($design_counts);
$chartData3 = [
    'labels' => $chartLabels3,
    'datasets' => [
        [
            'data' => array_values($design_counts),
            'backgroundColor' => [],
            'borderColor' => [],
            'borderWidth' => 1
        ]
    ]
];


foreach ($design_counts as $design_name => $quantity) {
    if ($colorIndex < $predefinedColorCount) {
        $color = $predefinedcolors[$colorIndex];
    } else {
        $color = generateRandomColor();
    }
    $chartData3['datasets'][0]['backgroundColor'][] = $color;
    $chartData3['datasets'][0]['borderColor'][] = $color;

    $colorIndex++;
}

$chartDataJSON3 = json_encode($chartData3);




$sql_size_count = "SELECT size, SUM(quantity) AS size_count FROM `order` GROUP BY size";

$result_size_count = mysqli_query($conn, $sql_size_count);

$size_counts = array();

while ($row = mysqli_fetch_assoc($result_size_count)) {
    $size_counts[$row['size']] = $row['size_count'];
}


$best_selling_size = '';
if (!empty($size_counts)) {
    $best_selling_size = array_search(max($size_counts), $size_counts);
} else {
    $best_selling_size = 'N/A';
}


$total_size = array_sum($size_counts);


$chartLabels4 = array_keys($size_counts);
$chartData4 = [
    'labels' => $chartLabels4,
    'datasets' => [
        [
            'data' => array_values($size_counts),
            'backgroundColor' => [],
            'borderColor' => [],
            'borderWidth' => 1
        ]
    ]
];

//dito mo pwede baguhin kulay pre
$predefinedcolors=['#D9B3FF','#66C2FF','#C18E63'];


$predefinedColorCount = count($predefinedcolors);
$colorIndex = 0; 


foreach ($size_counts as $size => $quantity) {
    if ($colorIndex < $predefinedColorCount) {
        $color = $predefinedcolors[$colorIndex];
    } else {
        $color = generateRandomColor(); 
    }

    $chartData4['datasets'][0]['backgroundColor'][] = $color;
    $chartData4['datasets'][0]['borderColor'][] = $color;

    $colorIndex++;
}

$chartDataJSON4 = json_encode($chartData4);






function generateRandomColor(){
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}

//for table popup
$query = "SELECT
b.id AS billing_id,
b.quotation AS total_quotation,
b.created_at AS billing_date
FROM
billing b
CROSS JOIN
`order` o 
WHERE
b.status = 'CLOSED'
GROUP BY
b.id, b.created_at
ORDER BY billing_date;




";


$result = mysqli_query($conn, $query);
$tableData = mysqli_fetch_all($result, MYSQLI_ASSOC);


$query1 = "SELECT id,quotation,status,created_at 
          FROM billing";
$result1 = mysqli_query($conn, $query1);
$tableData1 = mysqli_fetch_all($result1, MYSQLI_ASSOC);


$query2 = "SELECT ac.id, CONCAT(ac.first_name, ' ', ac.last_name) AS full_name, a.type
           FROM account ac
           INNER JOIN account_type a ON ac.type_id = a.id";
$result2 = mysqli_query($conn, $query2);
$tableData2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);



$query3 = "SELECT o.id, wfb.design_name AS design_name, o.quantity 
FROM `order` o
INNER JOIN wall_form_block wfb ON o.wall_form_block_id = wfb.id
INNER JOIN billing b ON o.billing_id = b.id
WHERE b.status = 'CLOSED'
ORDER BY wfb.design_name;
";
$result3 = mysqli_query($conn, $query3);
$tableData3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

$query4 = "SELECT id,size,quantity 
          FROM `order` ORDER BY SIZE" ;
$result4 = mysqli_query($conn, $query4);
$tableData4 = mysqli_fetch_all($result4, MYSQLI_ASSOC);



mysqli_close($conn);



?>
