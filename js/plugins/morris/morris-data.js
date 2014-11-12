$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2014 Q1',
            Cortinas: 1,
            Alfombras: null,
            Persianas: 3
        }, {
            period: '2014 Q2',
            Cortinas: 2,
            Alfombras: 3,
            Persianas: 4
        }, {
            period: '2014 Q3',
            Cortinas: 1,
            Alfombras: 2,
            Persianas: 3
        }, {
            period: '2014 Q4',
            Cortinas: 2,
            Alfombras: 3,
            Persianas: 4
        }, {
            period: '2014 Q5',
            Cortinas: 2,
            Alfombras: 1,
            Persianas: 5
        }, {
            period: '2014 Q6',
            Cortinas: 3,
            Alfombras: 4,
            Persianas: 1
        }],
        xkey: 'period',
        ykeys: ['Cortinas', 'Alfombras', 'Persianas'],
        labels: ['Cortinas', 'Alfombras', 'Persianas'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });

    Morris.Donut({
        element: 'morris-donut-chart',
        data: [{
            label: "Nuevos Pedidos",
            value: 12
        }, {
            label: "Ordenes En Proceso",
            value: 30
        }, {
            label: "Ordenes Enviadas",
            value: 20
        }],
        resize: true
    });

    Morris.Bar({
        element: 'morris-bar-chart',
        data: [ {
            y: 'Julio',
            a: 75,
            b: 65
        }, {
            y: 'Agosto',
            a: 50,
            b: 40
        }, {
            y: 'Septiembre',
            a: 100,
            b: 90
        }],
        xkey: 'y',
        ykeys: ['a', 'b'],
        labels: ['Series A', 'Series B'],
        hideHover: 'auto',
        resize: true
    });

});
