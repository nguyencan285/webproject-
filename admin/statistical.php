<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://cdn-icons-png.flaticon.com/128/2206/2206368.png" type="image/x-icon">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <title>Statistical</title>
</head>
<body>
<canvas id="myChart"></canvas>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');

        // Sử dụng AJAX hoặc Fetch API để gọi file PHP và lấy dữ liệu
        fetch('data.php')
            .then(function(response) {
                return response.json();
            })
            .then(function(data) {
                var orderDates = data.map(item => item.orderdate);
                var quantities = data.map(item => item.quantity);

                var chart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: orderDates,
                        datasets: [{
                            label: 'Số lượng sản phẩm đặt hàng',
                            data: quantities,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            borderWidth: 2
                        }]
                    },
                    options: {
                        scales: {
                            x: {
                                type: 'time', // Đánh dấu trục x là kiểu thời gian
                                time: {
                                    unit: 'day' // Đơn vị thời gian (ngày)
                                }
                            },
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
    </script>
</body>
</html>
