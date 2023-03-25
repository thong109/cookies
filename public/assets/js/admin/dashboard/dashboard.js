$(document).ready(function () {
    DashboardModules.InitEvents();
});

var DashboardModules = (function () {
    var InitEvents = function () {
        try {
            chart60day();
            Donut();
            // Click button save
            $('#btn-save').on('click', function () {
                SaveBlog();
            });
            $('.dashboard-filter').change(function () {
                Filter($(this));
            });
            $('#btn-dashboard-filter').on('click', function () {
                FilterFrom();
            });
        } catch (e) {
            console.log('InitEvents: ' + e.message);
        }
    }

    var FilterFrom = function () {
        var from_date = $('#datepicker').val();
        var to_date = $('#datepicker2').val();
        $.ajax({
            url: urls.filterByDate,
            method: 'POST',
            dataType: 'JSON',
            data: {
                from_date: from_date,
                to_date: to_date
            },
            success: function (data) {
                chart.setData(data);
            }
        });
    }

    var chart = new Morris.Line({
        element: 'chart',
        lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3'],
        hideHover: 'auto',
        parseTime: false,
        xkey: 'period',
        ykeys: ['order', 'sales', 'profit', 'quantity'],
        labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng']
    });

    var Filter = function (btn) {
        var dashboard_value = btn.val();
        $.ajax({
            url: urls.dashboardFilter,
            method: 'POST',
            dataType: 'JSON',
            data: {
                dashboard_value: dashboard_value
            },
            success: function (data) {
                chart.setData(data);
            }
        });
    }

    var chart60day = function () {
        try {
            $.ajax({
                url: urls.dayOrders,
                method: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    chart.setData(data);
                }
            });
        } catch (e) {
            console.log("SaveBlog: " + e.message);
        }
    }

    var Donut = function () {
        try {
            $.ajax({
                url: urls.donut,
                method: 'POST',
                dataType: 'JSON',
                success: function (res) {
                    var colorDanger = "#FF1744";
                    Morris.Donut({
                        element: 'donut',
                        resize: true,
                        colors: [
                            '#E0F7FA',
                            '#B2EBF2',
                            '#80DEEA',
                            '#4DD0E1',
                            '#26C6DA',
                            '#00BCD4',
                            '#00ACC1',
                            '#0097A7',
                            '#00838F',
                            '#006064'
                        ],
                        data: [{
                            label: "Sản phẩm",
                            value: res.product,
                            color: colorDanger
                        },
                        {
                            label: "Đơn hàng",
                            value: res.appOrder,
                        },
                        {
                            label: "Khách hàng",
                            value: res.appCustomer,
                        }
                        ]
                    });
                }
            });
        } catch (e) {
            console.log("SaveBlog: " + e.message);
        }
    }

    return {
        InitEvents: InitEvents
    };
})();
