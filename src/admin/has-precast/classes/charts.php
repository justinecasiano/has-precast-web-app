<?php

$servername = "localhost"; 
$username = "has_admin"; 
$password = "wc8KTRfrJrTpe8"; 
$database = "has_precast"; 
$conn = mysqli_connect($servername, $username, $password, $database);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$currentYear = date('Y');

// Define the years to fetch data for
$yearsToFetch = array($currentYear - 2, $currentYear - 1, $currentYear);

// Initialize an array to hold the sales data for each year
$yearlySalesData = array_fill(0, 3, 0);

foreach ($yearsToFetch as $key => $year) {
    $query = "
        SELECT 
            SUM(quotation) AS total_sales
        FROM 
            billing
        WHERE 
            status = 'closed'
            AND YEAR(created_at) = $year
    ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $yearlySalesData[$key] = $row['total_sales'] ?? 0;

    mysqli_free_result($result);
}

// Assign sales data for each year to variables
$two_years_ago_sales = $yearlySalesData[0];
$prev_year_sales = $yearlySalesData[1];
$curr_year_sales = $yearlySalesData[2];

// Format the year labels
$yearLabels = array($yearsToFetch[0], $yearsToFetch[1], $yearsToFetch[2]);

$overallSalesLast3Years = round(array_sum($yearlySalesData), 2);

$yearLabelsEncoded = json_encode($yearLabels);
$yearlySalesDataEncoded = json_encode($yearlySalesData);



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
$currentMonth = date('n');
$currentYear = date('Y');

// Get the first and last day of the current month
$firstDayOfMonth = date('Y-m-01');
$lastDayOfMonth = date('Y-m-t');

// Calculate the number of weeks in the current month
$numberOfWeeks = ceil((strtotime($lastDayOfMonth) - strtotime($firstDayOfMonth)) / (7 * 86400));

$weeklySalesData = array_fill(0, $numberOfWeeks, 0); // Initialize array for the number of weeks in the month

for ($i = 0; $i < $numberOfWeeks; $i++) {
    // Calculate the start and end dates of each week
    $weekStart = date('Y-m-d', strtotime("$firstDayOfMonth +$i week"));
    $weekEnd = date('Y-m-d', strtotime("$weekStart +6 days"));
    
    $query = "
        SELECT 
            SUM(quotation) AS total_sales
        FROM 
            billing
        WHERE 
            status = 'closed'
            AND DATE(created_at) BETWEEN '$weekStart' AND '$weekEnd'
    ";

    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $weeklySalesData[$i] = $row['total_sales'] ?? 0;

    mysqli_free_result($result);
}

// Generate labels dynamically
$week_labels = [];
for ($i = 1; $i <= $numberOfWeeks; $i++) {
    $week_labels[] = "Week $i";
}
$totalWeeklySales = array_sum($weeklySalesData);
$two_weeks_ago_sales = $weeklySalesData[$numberOfWeeks - 3] ?? 0;
$prev_week_sales = $weeklySalesData[$numberOfWeeks - 2] ?? 0;
$current_week_sales = $weeklySalesData[$numberOfWeeks - 1] ?? 0;
$week_labels_encoded = json_encode($week_labels);
$weekly_sales_encoded = json_encode($weeklySalesData);



$currentDate = new DateTime();



$previousDate = (clone $currentDate)->modify('-1 day');
$previous2Date = (clone $currentDate)->modify('-2 days');

$datesToFetch = array(
    $previous2Date->format('Y-m-d'),
    $previousDate->format('Y-m-d'),
    $currentDate->format('Y-m-d')
);

// Initialize an array to hold the sales data
$salesData2 = array();

foreach ($datesToFetch as $date) {
    $query = "
        SELECT 
            SUM(quotation) AS total_sales
        FROM 
            billing
        WHERE 
            status = 'closed'
            AND DATE(created_at) = '$date'
    ";

    $result = mysqli_query($conn, $query);
    if (!$result) {
        die("Error in query: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($result);
    $salesData2[] = array(
        'date' => $date,
        'total_sales' => $row['total_sales'] ?? 0
    );

    mysqli_free_result($result);
}

// Format the data for display
$day_labels = array_map(function($day) {
    return date('M d', strtotime($day['date']));
}, $salesData2);

$daily_sales = array_column($salesData2, 'total_sales');
$totalDailySales = array_sum($daily_sales);
$prev_2day_sales = $daily_sales[count($daily_sales) - 3] ?? 0;
$prev_day_sales = $daily_sales[count($daily_sales) - 2] ?? 0;
$current_day_sales = $daily_sales[count($daily_sales) - 1] ?? 0;
$day_labels= json_encode($day_labels);
$daily_sales= json_encode($daily_sales);


















// Original query for all billings
        $sql_billing_count = "SELECT status, COUNT(*) AS status_count FROM billing GROUP BY status";

        // New query for monthly billings
        $currentMonth = date('m');
        $currentYear = date('Y');
        $sql_monthly_billing_count = "SELECT status, COUNT(*) AS status_count FROM billing WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear GROUP BY status";

        // New query for weekly billings
        $currentWeek = date('W');
$currentYear = date('Y');

// Calculate the start and end dates of the current week
$startOfWeek = date('Y-m-d', strtotime($currentYear . 'W' . str_pad($currentWeek, 2, '0', STR_PAD_LEFT)));
$endOfWeek = date('Y-m-d', strtotime($startOfWeek . ' +6 days'));

// Use the start and end dates in the SQL query
$sql_weekly_billing_count = "SELECT status, COUNT(*) AS status_count FROM billing WHERE created_at BETWEEN '$startOfWeek' AND '$endOfWeek' GROUP BY status";

        // New query for daily billings
        $currentDate = date('Y-m-d');
        $sql_daily_billing_count = "SELECT status, COUNT(*) AS status_count FROM billing WHERE DATE(created_at) = '$currentDate' GROUP BY status";

        $result_billing_count = mysqli_query($conn, $sql_billing_count);
        $result_monthly_billing_count = mysqli_query($conn, $sql_monthly_billing_count);
        $result_weekly_billing_count = mysqli_query($conn, $sql_weekly_billing_count);
        $result_daily_billing_count = mysqli_query($conn, $sql_daily_billing_count);

        $billing_counts = array();
        $monthly_billing_counts = array();
        $weekly_billing_counts = array();
        $daily_billing_counts = array();

        while ($row = mysqli_fetch_assoc($result_billing_count)) {
            $billing_counts[$row['status']] = $row['status_count'];
        }

        while ($row = mysqli_fetch_assoc($result_monthly_billing_count)) {
            $monthly_billing_counts[$row['status']] = $row['status_count'];
        }

        while ($row = mysqli_fetch_assoc($result_weekly_billing_count)) {
            $weekly_billing_counts[$row['status']] = $row['status_count'];
        }

        while ($row = mysqli_fetch_assoc($result_daily_billing_count)) {
            $daily_billing_counts[$row['status']] = $row['status_count'];
        }

    $total_billings = array_sum($billing_counts);
    $total_monthly_billings = array_sum($monthly_billing_counts);
    $total_weekly_billings = array_sum($weekly_billing_counts);
    $total_daily_billings = array_sum($daily_billing_counts);
    

    //dito mo pwede baguhin kulay pre
    $predefinedcolors=['aquamarine','pink','yellow'];

    $chartLabels1 = array_keys($billing_counts);
    $chartLabelsMonthly = array_keys($monthly_billing_counts);
    $chartLabelsWeekly = array_keys($weekly_billing_counts);
    $chartLabelsDaily = array_keys($daily_billing_counts);

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

$chartDataMonthly = [
    'labels' => $chartLabelsMonthly,
    'datasets' => [
        [
            'data' => array_values($monthly_billing_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabelsMonthly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabelsMonthly)),
            'borderWidth' => 1
        ]
    ]
];

$chartDataWeekly = [
    'labels' => $chartLabelsWeekly,
    'datasets' => [
        [
            'data' => array_values($weekly_billing_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabelsWeekly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabelsWeekly)),
            'borderWidth' => 1
        ]
    ]
];

$chartDataDaily = [
    'labels' => $chartLabelsDaily,
    'datasets' => [
        [
            'data' => array_values($daily_billing_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabelsDaily)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabelsDaily)),
            'borderWidth' => 1
        ]
    ]
];
function handleZeroCounts($counts, $labels, $colors) {
    $data = [
        'labels' => $labels,
        'datasets' => []
    ];

    if (array_sum($counts) == 0) {
        // If all counts are zero, assign a default color to the dataset
        $data['datasets'][] = [
            'data' => $counts,
            'backgroundColor' => 'gray', // Default color
            'borderColor' => 'gray', // Default color
            'borderWidth' => 1
        ];
    } else {
        // If counts are not all zero, use predefined colors
        $data['datasets'][] = [
            'data' => array_values($counts),
            'backgroundColor' => array_slice($colors, 0, count($labels)),
            'borderColor' => array_slice($colors, 0, count($labels)),
            'borderWidth' => 1
        ];
    }

    return $data;
}

$chartData1 = handleZeroCounts($billing_counts, $chartLabels1, $predefinedcolors);
$chartDataMonthly = handleZeroCounts($monthly_billing_counts, $chartLabelsMonthly, $predefinedcolors);
$chartDataWeekly = handleZeroCounts($weekly_billing_counts, $chartLabelsWeekly, $predefinedcolors);
$chartDataDaily = handleZeroCounts($daily_billing_counts, $chartLabelsDaily, $predefinedcolors);

$chartDataJSON = json_encode($chartData1);
$chartDataJSONMonthly = json_encode($chartDataMonthly);
$chartDataJSONWeekly = json_encode($chartDataWeekly);
$chartDataJSONDaily = json_encode($chartDataDaily);



$sql_users_count = "SELECT ac.type as users, COUNT(*) AS users_count 
                    FROM account a
                    INNER JOIN account_type ac ON a.type_id = ac.id
                    GROUP BY ac.type";


        // New query for monthly billings
        $currentMonth = date('m');
        $currentYear = date('Y');
        $sql_monthly_users_count = "SELECT ac.type as users, COUNT(*) AS users_count FROM account a INNER JOIN account_type ac ON a.type_id = ac.id WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear GROUP BY ac.type";

        // New query for weekly billings
        $currentWeek = date('W');
$currentYear = date('Y');

// Calculate the start and end dates of the current week
$startOfWeek = date('Y-m-d', strtotime($currentYear . 'W' . str_pad($currentWeek, 2, '0', STR_PAD_LEFT)));
$endOfWeek = date('Y-m-d', strtotime($startOfWeek . ' +6 days'));

// Use the start and end dates in the SQL query
$sql_weekly_users_count = "SELECT ac.type as users, COUNT(*) AS users_count FROM account a INNER JOIN account_type ac ON a.type_id = ac.id  WHERE created_at BETWEEN '$startOfWeek' AND '$endOfWeek' GROUP BY ac.type";

        // New query for daily billings
        $currentDate = date('Y-m-d');
        $sql_daily_users_count = "SELECT ac.type as users, COUNT(*) AS users_count FROM account a INNER JOIN account_type ac ON a.type_id = ac.id WHERE DATE(created_at) = '$currentDate' GROUP BY ac.type";

        $result_users_count = mysqli_query($conn, $sql_users_count);
        $result_monthly_users_count = mysqli_query($conn, $sql_monthly_users_count);
        $result_weekly_users_count = mysqli_query($conn, $sql_weekly_users_count);
        $result_daily_users_count = mysqli_query($conn, $sql_daily_users_count);

        $users_counts = array();
        $monthly_users_counts = array();
        $weekly_users_counts = array();
        $daily_users_counts = array();

        while ($row = mysqli_fetch_assoc($result_users_count)) {
            $users_counts[$row['users']] = $row['users_count'];
        }

        while ($row = mysqli_fetch_assoc($result_monthly_users_count)) {
            $monthly_users_counts[$row['users']] = $row['users_count'];
        }

        while ($row = mysqli_fetch_assoc($result_weekly_users_count)) {
            $weekly_users_counts[$row['users']] = $row['users_count'];
        }

        while ($row = mysqli_fetch_assoc($result_daily_users_count)) {
            $daily_users_counts[$row['users']] = $row['users_count'];
        }

    $total_users = array_sum($users_counts);
    $total_monthly_users = array_sum($monthly_users_counts);
    $total_weekly_users = array_sum($weekly_users_counts);
    $total_daily_users = array_sum($daily_users_counts);
    

    //dito mo pwede baguhin kulay pre
    $predefinedcolors=['aquamarine','pink','yellow'];

    $chartLabels2 = array_keys($users_counts);
    $chartLabels2Monthly = array_keys($monthly_users_counts);
    $chartLabels2Weekly = array_keys($weekly_users_counts);
    $chartLabels2Daily = array_keys($daily_users_counts);

$chartData2 = [
    'labels' => $chartLabels2,
    'datasets' => [
        [
            'data' => array_values($users_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels2)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels2)),
            'borderWidth' => 1
        ]
    ]
];

$chartData2Monthly = [
    'labels' => $chartLabels2Monthly,
    'datasets' => [
        [
            'data' => array_values($monthly_users_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels2Monthly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels2Monthly)),
            'borderWidth' => 1
        ]
    ]
];

$chartData2Weekly = [
    'labels' => $chartLabels2Weekly,
    'datasets' => [
        [
            'data' => array_values($weekly_users_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels2Weekly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels2Weekly)),
            'borderWidth' => 1
        ]
    ]
];

$chartData2Daily = [
    'labels' => $chartLabels2Daily,
    'datasets' => [
        [
            'data' => array_values($daily_users_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels2Daily)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels2Daily)),
            'borderWidth' => 1
        ]
    ]
];
function handleZeroCounts2($counts2, $labels2, $colors2) {
    $data2 = [
        'labels' => $labels2,
        'datasets' => []
    ];

    if (array_sum($counts2) == 0) {
        // If all counts are zero, assign a default color to the dataset
        $data2['datasets'][] = [
            'data' => $counts2,
            'backgroundColor' => 'gray', // Default color
            'borderColor' => 'gray', // Default color
            'borderWidth' => 1
        ];
    } else {
        // If counts are not all zero, use predefined colors
        $data2['datasets'][] = [
            'data' => array_values($counts2),
            'backgroundColor' => array_slice($colors2, 0, count($labels2)),
            'borderColor' => array_slice($colors2, 0, count($labels2)),
            'borderWidth' => 1
        ];
    }

    return $data2;
}

$chartData2 = handleZeroCounts2($users_counts, $chartLabels2, $predefinedcolors);
$chartData2Monthly = handleZeroCounts2($monthly_users_counts, $chartLabels2Monthly, $predefinedcolors);
$chartData2Weekly = handleZeroCounts2($weekly_users_counts, $chartLabels2Weekly, $predefinedcolors);
$chartData2Daily = handleZeroCounts2($daily_users_counts, $chartLabels2Daily, $predefinedcolors);

$chartData2JSON = json_encode($chartData2);
$chartData2JSONMonthly = json_encode($chartData2Monthly);
$chartData2JSONWeekly = json_encode($chartData2Weekly);
$chartData2JSONDaily = json_encode($chartData2Daily);



$sql_design_count = "SELECT wfb.design_name as design, SUM(o.quantity) AS total_quantity
                     FROM wall_form_block wfb
                     LEFT JOIN `order` o ON wfb.id = o.wall_form_block_id
                     LEFT JOIN billing b ON o.billing_id = b.id
                     WHERE b.status = 'CLOSED'
                     GROUP BY wfb.design_name";

        $currentMonth = date('m');
        $currentYear = date('Y');
        $sql_monthly_design_count = "SELECT wfb.design_name as design, SUM(o.quantity) AS total_quantity
                     FROM wall_form_block wfb
                     LEFT JOIN `order` o ON wfb.id = o.wall_form_block_id
                     LEFT JOIN billing b ON o.billing_id = b.id WHERE b.status = 'CLOSED' AND MONTH(b.created_at) = $currentMonth AND YEAR(created_at) = $currentYear  GROUP BY wfb.design_name";

    
        $currentWeek = date('W');
$currentYear = date('Y');
$startOfWeek = date('Y-m-d', strtotime($currentYear . 'W' . str_pad($currentWeek, 2, '0', STR_PAD_LEFT)));
$endOfWeek = date('Y-m-d', strtotime($startOfWeek . ' +6 days'));

// Use the start and end dates in the SQL query
$sql_weekly_design_count = "SELECT wfb.design_name as design, SUM(o.quantity) AS total_quantity
FROM wall_form_block wfb
LEFT JOIN `order` o ON wfb.id = o.wall_form_block_id
LEFT JOIN billing b ON o.billing_id = b.id WHERE b.status = 'CLOSED' AND b.created_at BETWEEN '$startOfWeek' AND '$endOfWeek' GROUP BY wfb.design_name";

        // New query for daily billings
        $currentDate = date('Y-m-d');
        $sql_daily_design_count = "SELECT wfb.design_name as design, SUM(o.quantity) AS total_quantity
        FROM wall_form_block wfb
        LEFT JOIN `order` o ON wfb.id = o.wall_form_block_id
        LEFT JOIN billing b ON o.billing_id = b.id WHERE b.status = 'CLOSED' AND DATE(b.created_at) = '$currentDate' GROUP BY wfb.design_name";

        $result_design_count = mysqli_query($conn, $sql_design_count);
        $result_monthly_design_count = mysqli_query($conn, $sql_monthly_design_count);
        $result_weekly_design_count = mysqli_query($conn, $sql_weekly_design_count);
        $result_daily_design_count = mysqli_query($conn, $sql_daily_design_count);

        $design_counts = array();
        $monthly_design_counts = array();
        $weekly_design_counts = array();
        $daily_design_counts = array();

        while ($row = mysqli_fetch_assoc($result_design_count)) {
            $design_counts[$row['design']] = $row['total_quantity'];
        }

        while ($row = mysqli_fetch_assoc($result_monthly_design_count)) {
            $monthly_design_counts[$row['design']] = $row['total_quantity'];
        }

        while ($row = mysqli_fetch_assoc($result_weekly_design_count)) {
            $weekly_design_counts[$row['design']] = $row['total_quantity'];
        }

        while ($row = mysqli_fetch_assoc($result_daily_design_count)) {
            $daily_design_counts[$row['design']] = $row['total_quantity'];
        }

    $total_design = array_sum($design_counts);
    $best_selling_design = key($design_counts);
    $total_monthly_design = array_sum($monthly_design_counts);
    $total_weekly_design = array_sum($weekly_design_counts);
    $total_daily_design= array_sum($daily_design_counts);
    // Find the most sold design for the overall period
$most_sold_design_overall = !empty($design_counts) ? key($design_counts) : "N/A";

// Find the most sold design for the current month
$most_sold_design_monthly = !empty($monthly_design_counts) ? key($monthly_design_counts) : "N/A";

// Find the most sold design for the current week
$most_sold_design_weekly = !empty($weekly_design_counts) ? key($weekly_design_counts) : "N/A";

// Find the most sold design for the current day
$most_sold_design_daily = !empty($daily_design_counts) ? key($daily_design_counts) : "N/A";

    //dito mo pwede baguhin kulay pre
    $predefinedcolors=['aquamarine','pink','yellow'];

    $chartLabels3 = array_keys($design_counts);
    $chartLabels3Monthly = array_keys($monthly_design_counts);
    $chartLabels3Weekly = array_keys($weekly_design_counts);
    $chartLabels3Daily = array_keys($daily_design_counts);

$chartData3 = [
    'labels' => $chartLabels3,
    'datasets' => [
        [
            'data' => array_values($design_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels3)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels3)),
            'borderWidth' => 1
        ]
    ]
];

$chartData3Monthly = [
    'labels' => $chartLabels3Monthly,
    'datasets' => [
        [
            'data' => array_values($monthly_design_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels3Monthly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels3Monthly)),
            'borderWidth' => 1
        ]
    ]
];

$chartData3Weekly = [
    'labels' => $chartLabels3Weekly,
    'datasets' => [
        [
            'data' => array_values($weekly_design_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels3Weekly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels3Weekly)),
            'borderWidth' => 1
        ]
    ]
];

$chartData3Daily = [
    'labels' => $chartLabels3Daily,
    'datasets' => [
        [
            'data' => array_values($daily_design_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels3Daily)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels3Daily)),
            'borderWidth' => 1
        ]
    ]
];
function handleZeroCounts3($counts3, $labels3, $colors3) {
    $data3 = [
        'labels' => $labels3,
        'datasets' => []
    ];

    if (array_sum($counts3) == 0) {
        // If all counts are zero, assign a default color to the dataset
        $data3['datasets'][] = [
            'data' => $counts3,
            'backgroundColor' => 'gray',
            'borderColor' => 'gray', 
            'borderWidth' => 1
        ];
    } else {
        // If counts are not all zero, use predefined colors
        $data3['datasets'][] = [
            'data' => array_values($counts3),
            'backgroundColor' => array_slice($colors3, 0, count($labels3)),
            'borderColor' => array_slice($colors3, 0, count($labels3)),
            'borderWidth' => 1
        ];
    }

    return $data3;
}

$chartData3 = handleZeroCounts3($design_counts, $chartLabels3, $predefinedcolors);
$chartData3Monthly = handleZeroCounts3($monthly_design_counts, $chartLabels3Monthly, $predefinedcolors);
$chartData3Weekly = handleZeroCounts3($weekly_design_counts, $chartLabels3Weekly, $predefinedcolors);
$chartData3Daily = handleZeroCounts3($daily_design_counts, $chartLabels3Daily, $predefinedcolors);

$chartData3JSON = json_encode($chartData3);
$chartData3JSONMonthly = json_encode($chartData3Monthly);
$chartData3JSONWeekly = json_encode($chartData3Weekly);
$chartData3JSONDaily = json_encode($chartData3Daily);




$sql_size_count = "SELECT o.size, SUM(o.quantity) AS size_count FROM `order` o  LEFT JOIN billing b ON o.billing_id = b.id
WHERE b.status = 'CLOSED' GROUP BY size";

        $currentMonth = date('m');
        $currentYear = date('Y');
        $sql_monthly_size_count = "SELECT o.size, SUM(o.quantity) AS size_count FROM `order` o  LEFT JOIN billing b ON o.billing_id = b.id
        WHERE b.status = 'CLOSED' AND MONTH(b.created_at) = $currentMonth AND YEAR(created_at) = $currentYear  GROUP BY size";

    
        $currentWeek = date('W');
$currentYear = date('Y');
$startOfWeek = date('Y-m-d', strtotime($currentYear . 'W' . str_pad($currentWeek, 2, '0', STR_PAD_LEFT)));
$endOfWeek = date('Y-m-d', strtotime($startOfWeek . ' +6 days'));

// Use the start and end dates in the SQL query
$sql_weekly_size_count = "SELECT o.size, SUM(o.quantity) AS size_count FROM `order` o  LEFT JOIN billing b ON o.billing_id = b.id WHERE b.status = 'CLOSED' AND b.created_at BETWEEN '$startOfWeek' AND '$endOfWeek' GROUP BY size";

        // New query for daily billings
        $currentDate = date('Y-m-d');
        $sql_daily_size_count = "SELECT o.size, SUM(o.quantity) AS size_count FROM `order` o  LEFT JOIN billing b ON o.billing_id = b.id WHERE b.status = 'CLOSED' AND DATE(b.created_at) = '$currentDate' GROUP BY size";

        $result_size_count = mysqli_query($conn, $sql_size_count);
        $result_monthly_size_count = mysqli_query($conn, $sql_monthly_size_count);
        $result_weekly_size_count = mysqli_query($conn, $sql_weekly_size_count);
        $result_daily_size_count = mysqli_query($conn, $sql_daily_size_count);

        $size_counts = array();
        $monthly_size_counts = array();
        $weekly_size_counts = array();
        $daily_size_counts = array();

        while ($row = mysqli_fetch_assoc($result_size_count)) {
            $size_counts[$row['size']] = $row['size_count'];
        }

        while ($row = mysqli_fetch_assoc($result_monthly_size_count)) {
            $monthly_size_counts[$row['size']] = $row['size_count'];
        }

        while ($row = mysqli_fetch_assoc($result_weekly_size_count)) {
            $weekly_size_counts[$row['size']] = $row['size_count'];
        }

        while ($row = mysqli_fetch_assoc($result_daily_size_count)) {
            $daily_size_counts[$row['size']] = $row['size_count'];
        }

    $total_size = array_sum($size_counts);
    $best_selling_size = key($size_counts);
    $total_monthly_size = array_sum($monthly_size_counts);
    $total_weekly_size = array_sum($weekly_size_counts);
    $total_daily_size= array_sum($daily_size_counts);
    // Find the most sold design for the overall period
$most_sold_size_overall = !empty($size_counts) ? key($size_counts) : "N/A";

// Find the most sold design for the current month
$most_sold_size_monthly = !empty($monthly_size_counts) ? key($monthly_size_counts) : "N/A";

// Find the most sold design for the current week
$most_sold_size_weekly = !empty($weekly_size_counts) ? key($weekly_size_counts) : "N/A";

// Find the most sold design for the current day
$most_sold_size_daily = !empty($daily_size_counts) ? key($daily_size_counts) : "N/A";

    //dito mo pwede baguhin kulay pre
    $predefinedcolors=['aquamarine','pink','yellow'];

    $chartLabels4 = array_keys($size_counts);
    $chartLabels4Monthly = array_keys($monthly_size_counts);
    $chartLabels4Weekly = array_keys($weekly_size_counts);
    $chartLabels4Daily = array_keys($daily_size_counts);

$chartData4 = [
    'labels' => $chartLabels4,
    'datasets' => [
        [
            'data' => array_values($size_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels4)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels4)),
            'borderWidth' => 1
        ]
    ]
];

$chartData4Monthly = [
    'labels' => $chartLabels4Monthly,
    'datasets' => [
        [
            'data' => array_values($monthly_size_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels4Monthly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels4Monthly)),
            'borderWidth' => 1
        ]
    ]
];

$chartData4Weekly = [
    'labels' => $chartLabels4Weekly,
    'datasets' => [
        [
            'data' => array_values($weekly_size_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels4Weekly)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels4Weekly)),
            'borderWidth' => 1
        ]
    ]
];

$chartData4Daily = [
    'labels' => $chartLabels4Daily,
    'datasets' => [
        [
            'data' => array_values($daily_size_counts),
            'backgroundColor' => array_slice($predefinedcolors, 0, count($chartLabels4Daily)),
            'borderColor' => array_slice($predefinedcolors, 0, count($chartLabels4Daily)),
            'borderWidth' => 1
        ]
    ]
];
function handleZeroCounts4($counts4, $labels4, $colors4) {
    $data4 = [
        'labels' => $labels4,
        'datasets' => []
    ];

    if (array_sum($counts4) == 0) {
        // If all counts are zero, assign a default color to the dataset
        $data4['datasets'][] = [
            'data' => $counts4,
            'backgroundColor' => 'gray',
            'borderColor' => 'gray', 
            'borderWidth' => 1
        ];
    } else {
        // If counts are not all zero, use predefined colors
        $data4['datasets'][] = [
            'data' => array_values($counts4),
            'backgroundColor' => array_slice($colors4, 0, count($labels4)),
            'borderColor' => array_slice($colors4, 0, count($labels4)),
            'borderWidth' => 1
        ];
    }

    return $data4;
}

$chartData4 = handleZeroCounts4($size_counts, $chartLabels4, $predefinedcolors);
$chartData4Monthly = handleZeroCounts3($monthly_size_counts, $chartLabels4Monthly, $predefinedcolors);
$chartData4Weekly = handleZeroCounts3($weekly_size_counts, $chartLabels4Weekly, $predefinedcolors);
$chartData4Daily = handleZeroCounts3($daily_size_counts, $chartLabels4Daily, $predefinedcolors);

$chartData4JSON = json_encode($chartData4);
$chartData4JSONMonthly = json_encode($chartData4Monthly);
$chartData4JSONWeekly = json_encode($chartData4Weekly);
$chartData4JSONDaily = json_encode($chartData4Daily);










function generateRandomColor(){
    return sprintf('#%06X', mt_rand(0, 0xFFFFFF));
}


$currentMonth = date('m');
$currentYear = date('Y');
$currentWeek = date('W');
$currentYear = date('Y');
$startOfWeek = date('Y-m-d', strtotime($currentYear . 'W' . str_pad($currentWeek, 2, '0', STR_PAD_LEFT)));
$endOfWeek = date('Y-m-d', strtotime($startOfWeek . ' +6 days'));
//for table 
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
$overall_data = mysqli_fetch_all($result, MYSQLI_ASSOC);

$querymonthly = "SELECT
b.id AS billing_id,
b.quotation AS total_quotation,
b.created_at AS billing_date
FROM
billing b
CROSS JOIN
`order` o 
WHERE
b.status = 'CLOSED' AND MONTH(b.created_at) = $currentMonth AND YEAR(created_at) = $currentYear
GROUP BY
b.id, b.created_at
ORDER BY billing_date;


";

$resultmonthly = mysqli_query($conn, $querymonthly);
$monthly_data = mysqli_fetch_all($resultmonthly, MYSQLI_ASSOC);


$queryweekly = "SELECT
b.id AS billing_id,
b.quotation AS total_quotation,
b.created_at AS billing_date
FROM
billing b
CROSS JOIN
`order` o 
WHERE
b.status = 'CLOSED' AND b.created_at BETWEEN '$startOfWeek' AND '$endOfWeek'
GROUP BY
b.id, b.created_at
ORDER BY billing_date;


";

$resultweekly= mysqli_query($conn, $queryweekly);
$weekly_data = mysqli_fetch_all($resultweekly, MYSQLI_ASSOC);


$querydaily = "SELECT
b.id AS billing_id,
b.quotation AS total_quotation,
b.created_at AS billing_date
FROM
billing b
CROSS JOIN
`order` o 
WHERE
b.status = 'CLOSED' AND DATE(b.created_at) = '$currentDate'
GROUP BY
b.id, b.created_at
ORDER BY billing_date;


";

$resultdaily = mysqli_query($conn, $querydaily);
$daily_data = mysqli_fetch_all($resultdaily, MYSQLI_ASSOC);

$overall_json = json_encode($overall_data);
$monthly_json = json_encode($monthly_data);
$weekly_json = json_encode($weekly_data);
$daily_json = json_encode($daily_data);





$query2 = "SELECT b.id, CONCAT(a.first_name, ' ', a.last_name) AS full_name, b.payment_method, b.payment_reference, b.payment_status, b.payment_date
FROM billing b
INNER JOIN account a ON b.account_id = a.id
WHERE b.status = 'CLOSED'
GROUP BY b.id";

$result2 = mysqli_query($conn, $query2);
$overall_data2 = mysqli_fetch_all($result2, MYSQLI_ASSOC);

$querymonthly2 = "SELECT b.id, CONCAT(a.first_name, ' ', a.last_name) AS full_name, b.payment_method, b.payment_reference, b.payment_status, b.payment_date
FROM billing b
INNER JOIN account a ON b.account_id = a.id
WHERE b.status = 'CLOSED' AND MONTH(b.created_at) = $currentMonth AND YEAR(b.created_at) = $currentYear
GROUP BY b.id, b.created_at
ORDER BY payment_date";

$resultmonthly2 = mysqli_query($conn, $querymonthly2);
$monthly_data2 = mysqli_fetch_all($resultmonthly2, MYSQLI_ASSOC);

$queryweekly2 = "SELECT b.id, CONCAT(a.first_name, ' ', a.last_name) AS full_name, b.payment_method, b.payment_reference, b.payment_status, b.payment_date
FROM billing b
INNER JOIN account a ON b.account_id = a.id
WHERE b.status = 'CLOSED' AND b.created_at BETWEEN '$startOfWeek' AND '$endOfWeek'
GROUP BY b.id, b.created_at
ORDER BY payment_date";

$resultweekly2 = mysqli_query($conn, $queryweekly2);
$weekly_data2 = mysqli_fetch_all($resultweekly2, MYSQLI_ASSOC);

$querydaily2 = "SELECT b.id, CONCAT(a.first_name, ' ', a.last_name) AS full_name, b.payment_method, b.payment_reference, b.payment_status, b.payment_date
FROM billing b
INNER JOIN account a ON b.account_id = a.id
WHERE b.status = 'CLOSED' AND DATE(b.created_at) = '$currentDate'
GROUP BY b.id, b.created_at
ORDER BY payment_date";

$resultdaily2 = mysqli_query($conn, $querydaily2);
$daily_data2 = mysqli_fetch_all($resultdaily2, MYSQLI_ASSOC);

$overall_json2 = json_encode($overall_data2);
$monthly_json2 = json_encode($monthly_data2);
$weekly_json2 = json_encode($weekly_data2);
$daily_json2 = json_encode($daily_data2);










$query3= "SELECT id,quotation,status,created_at 
FROM billing";
$result3 = mysqli_query($conn, $query3);
$overall_data3 = mysqli_fetch_all($result3, MYSQLI_ASSOC);

$querymonthly3 = "SELECT id,quotation,status,created_at 
FROM billing WHERE MONTH(created_at) = $currentMonth AND YEAR(created_at) = $currentYear
GROUP BY
id, created_at 
ORDER BY created_at;


";

$resultmonthly3 = mysqli_query($conn, $querymonthly3);
$monthly_data3 = mysqli_fetch_all($resultmonthly3, MYSQLI_ASSOC);


$queryweekly3= "SELECT id,quotation,status,created_at 
FROM billing WHERE created_at BETWEEN '$startOfWeek' AND '$endOfWeek'
GROUP BY
id, created_at
ORDER BY created_at;


";

$resultweekly3= mysqli_query($conn, $queryweekly3);
$weekly_data3 = mysqli_fetch_all($resultweekly3, MYSQLI_ASSOC);


$querydaily3 = "SELECT id,quotation,status,created_at 
FROM billing WHERE DATE(created_at) = '$currentDate'
GROUP BY
id, created_at
ORDER BY created_at;


";

$resultdaily3= mysqli_query($conn, $querydaily3);
$daily_data3= mysqli_fetch_all($resultdaily3, MYSQLI_ASSOC);

$overall_json3 = json_encode($overall_data3);
$monthly_json3 = json_encode($monthly_data3);
$weekly_json3 = json_encode($weekly_data3);
$daily_json3 = json_encode($daily_data3);




$query4= "SELECT ac.id, CONCAT(ac.first_name, ' ', ac.last_name) AS full_name, a.type,ac.created_at
FROM account ac
INNER JOIN account_type a ON ac.type_id = a.id";
$result4 = mysqli_query($conn, $query4);
$overall_data4 = mysqli_fetch_all($result4, MYSQLI_ASSOC);

$querymonthly4= "SELECT ac.id, CONCAT(ac.first_name, ' ', ac.last_name) AS full_name, a.type,ac.created_at
FROM account ac
INNER JOIN account_type a ON ac.type_id = a.id WHERE MONTH(ac.created_at) = $currentMonth AND YEAR(ac.created_at) = $currentYear
GROUP BY
ac.id, ac.created_at 
ORDER BY ac.created_at;


";

$resultmonthly4 = mysqli_query($conn, $querymonthly4);
$monthly_data4= mysqli_fetch_all($resultmonthly4, MYSQLI_ASSOC);


$queryweekly4= "SELECT ac.id, CONCAT(ac.first_name, ' ', ac.last_name) AS full_name, a.type,ac.created_at
FROM account ac
INNER JOIN account_type a ON ac.type_id = a.id WHERE ac.created_at BETWEEN '$startOfWeek' AND '$endOfWeek'
GROUP BY
ac.id, ac.created_at
ORDER BY ac.created_at;


";

$resultweekly4= mysqli_query($conn, $queryweekly4);
$weekly_data4 = mysqli_fetch_all($resultweekly4, MYSQLI_ASSOC);


$querydaily4 = "SELECT ac.id, CONCAT(ac.first_name, ' ', ac.last_name) AS full_name, a.type,ac.created_at
FROM account ac
INNER JOIN account_type a ON ac.type_id = a.id WHERE DATE(ac.created_at) = '$currentDate'
GROUP BY
ac.id, ac.created_at
ORDER BY ac.created_at;


";

$resultdaily4= mysqli_query($conn, $querydaily4);
$daily_data4= mysqli_fetch_all($resultdaily4, MYSQLI_ASSOC);

$overall_json4 = json_encode($overall_data4);
$monthly_json4 = json_encode($monthly_data4);
$weekly_json4 = json_encode($weekly_data4);
$daily_json4 = json_encode($daily_data4);







$query5 = "SELECT o.id, wfb.design_name AS design_name, o.quantity, b.quotation as price,  b.created_at
    FROM `order` o
    INNER JOIN wall_form_block wfb ON o.wall_form_block_id = wfb.id
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED'
    ORDER BY wfb.design_name";

$result5 = mysqli_query($conn, $query5);
$overall_data5 = mysqli_fetch_all($result5, MYSQLI_ASSOC);

$querymonthly5 = "SELECT o.id, wfb.design_name AS design_name, o.quantity, b.quotation as price, b.created_at
    FROM `order` o
    INNER JOIN wall_form_block wfb ON o.wall_form_block_id = wfb.id
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED' AND MONTH(b.created_at) = $currentMonth AND YEAR(b.created_at) = $currentYear
    GROUP BY o.id, b.created_at
    ORDER BY b.created_at";

$resultmonthly5 = mysqli_query($conn, $querymonthly5);
$monthly_data5 = mysqli_fetch_all($resultmonthly5, MYSQLI_ASSOC);

$queryweekly5 = "SELECT o.id, wfb.design_name AS design_name, o.quantity,b.quotation as price,  b.created_at
    FROM `order` o
    INNER JOIN wall_form_block wfb ON o.wall_form_block_id = wfb.id
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED' AND b.created_at BETWEEN '$startOfWeek' AND '$endOfWeek'
    GROUP BY o.id, b.created_at
    ORDER BY b.created_at";

$resultweekly5 = mysqli_query($conn, $queryweekly5);
$weekly_data5 = mysqli_fetch_all($resultweekly5, MYSQLI_ASSOC);

$querydaily5 = "SELECT o.id, wfb.design_name AS design_name, o.quantity,b.quotation as price,  b.created_at
    FROM `order` o
    INNER JOIN wall_form_block wfb ON o.wall_form_block_id = wfb.id
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED' AND DATE(b.created_at) = '$currentDate'
    GROUP BY o.id, b.created_at
    ORDER BY b.created_at";

$resultdaily5 = mysqli_query($conn, $querydaily5);
$daily_data5 = mysqli_fetch_all($resultdaily5, MYSQLI_ASSOC);

$overall_json5 = json_encode($overall_data5);
$monthly_json5 = json_encode($monthly_data5);
$weekly_json5 = json_encode($weekly_data5);
$daily_json5 = json_encode($daily_data5);







$query6 = "SELECT o.id, o.size AS size_name, o.quantity,b.quotation as price, b.created_at
    FROM `order` o
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED'
    ORDER BY o.size";

$result6 = mysqli_query($conn, $query6);
$overall_data6= mysqli_fetch_all($result6, MYSQLI_ASSOC);

$querymonthly6 = "SELECT o.id, o.size AS size_name, o.quantity,b.quotation as price, b.created_at
    FROM `order` o
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED' AND MONTH(b.created_at) = $currentMonth AND YEAR(b.created_at) = $currentYear
    GROUP BY o.id, b.created_at
    ORDER BY b.created_at";

$resultmonthly6= mysqli_query($conn, $querymonthly6);
$monthly_data6= mysqli_fetch_all($resultmonthly6, MYSQLI_ASSOC);

$queryweekly6 = "SELECT o.id, o.size AS size_name, o.quantity,b.quotation as price, b.created_at
    FROM `order` o
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED' AND b.created_at BETWEEN '$startOfWeek' AND '$endOfWeek'
    GROUP BY o.id, b.created_at
    ORDER BY b.created_at";

$resultweekly6= mysqli_query($conn, $queryweekly5);
$weekly_data6 = mysqli_fetch_all($resultweekly5, MYSQLI_ASSOC);

$querydaily6 = "SELECT o.id, o.size AS size_name, o.quantity,b.quotation as price, b.created_at
    FROM `order` o
    INNER JOIN billing b ON o.billing_id = b.id
    WHERE b.status = 'CLOSED' AND DATE(b.created_at) = '$currentDate'
    GROUP BY o.id, b.created_at
    ORDER BY b.created_at";

$resultdaily6 = mysqli_query($conn, $querydaily5);
$daily_data6 = mysqli_fetch_all($resultdaily5, MYSQLI_ASSOC);

$overall_json6 = json_encode($overall_data6);
$monthly_json6 = json_encode($monthly_data6);
$weekly_json6 = json_encode($weekly_data6);
$daily_json6= json_encode($daily_data6);








mysqli_close($conn);



?>
