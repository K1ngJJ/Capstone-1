

// https://apexcharts.com/javascript-chart-demos/dashboards/modern/
document.addEventListener('DOMContentLoaded', () => {
  
  // Extracting data
  const dailyRevenue = JSON.parse(document.querySelector('#generated-revenue').dataset.daily);
  const totalRevenue = parseFloat(document.querySelector('#generated-revenue').dataset.total);
  const dailyOrders = JSON.parse(document.querySelector('#order-revenue-chart').dataset.daily);
  const categoricalSales = JSON.parse(document.querySelector('#category-sales-chart').dataset.sales);
  const productSales = JSON.parse(document.querySelector('#best-selling-product-chart').dataset.sales);
  // const totalOrders = parseInt(document.querySelector('#order-revenue-chart').dataset.total);
  // dailyOrders.map(order => console.log(order.date, order.orders));

  Apex.grid = {
    padding: { right: 0, left: 0 }
  }
  Apex.dataLabels = { enabled: false }
  

  // Chart 1 - Revenue Area Chart
  var revenue = {
    chart: {
      id: 'sparkline1',
      group: 'sparklines',
      type: 'area',
      height: 160,
      sparkline: { enabled: true },
    },
    stroke: { curve: 'straight' },
    fill: { opacity: 1 },
    series: [{
      name: 'Revenue',
      data: dailyRevenue.map(record => (
        typeof(record.revenue) == 'string' ? parseInt(record.revenue).toFixed(2) : record.revenue.toFixed(2))
        ),
    }],
    labels: dailyRevenue.map(record => record.date),
    yaxis: { min: 0 },
    xaxis: { type: 'datetime' },
    colors: ['#DCE6EC'],
    title: {
      text: `₱ ${totalRevenue.toFixed(2)}`,
      offsetX: 30,
      style: { fontSize: '24px', cssClass: 'apexcharts-yaxis-title' }
    },
    subtitle: {
      text: 'Revenue',
      offsetX: 30,
      style: { fontSize: '14px', cssClass: 'apexcharts-yaxis-title'  }
    }
  }

  
  // Chart 7 - Order-Revenue Mixed bar line chart
  var orderRevenue = {
    series: [{
    name: 'Orders',
    type: 'column',
    data: dailyOrders.map(record => record.orders),
  }, {
    name: 'Revenue',
    type: 'line',
    data: dailyRevenue.map(record => (
      typeof(record.revenue) == 'string' ? parseInt(record.revenue).toFixed(2) : record.revenue.toFixed(2))
      ),
  }],
    chart: {
    height: 350,
    type: 'line',
  },
  stroke: {
    width: [0, 4]
  },
  title: {
    text: 'Orders and Revenue',
    style: { fontSize: '18px', cssClass: 'apexcharts-yaxis-title' }
  },
  dataLabels: {
    enabled: false,
    enabledOnSeries: [1]
  },
  labels: dailyOrders.map(record => record.date),
  xaxis: {
    type: 'datetime'
  },
  yaxis: [{
    title: {
      text: 'Orders',
      style: { fontSize: '14px', cssClass: 'apexcharts-yaxis-title' }
    },
  
  }, {
    opposite: true,
    title: {
      text: 'Revenue',
      style: { fontSize: '14px', cssClass: 'apexcharts-yaxis-title' }
    }
  }]
  };


var productCategorySales = {
  chart: {
    type: 'donut',
    height: 350,
  },
  series: categoricalSales.map(sale => parseFloat(sale)),
  labels: ['Appetizer', 'Bento', 'Beverage', 'Dessert', 'Ramen', 'Sushi', 'Temaki'],
  title: {
    text: 'Product Category Sales',
    style: { fontSize: '18px', cssClass: 'apexcharts-yaxis-title' }
  },
  dataLabels: {
    enabled: true,
    formatter: function (val) {
      return Math.round(val) + "%"
    },
  }
}

var bestSellingProduct = {
  chart: {
    type: 'bar',
    height: 350,
  },
  series: [{
    name: 'Sale Count',
    data: (productSales.length > 10 ? productSales.slice(0, 10) : productSales)
  }],
  title: {
    text: 'Top 10 Best Selling Products',
    style: { fontSize: '18px', cssClass: 'apexcharts-yaxis-title' }
  },
  yaxis: [{
    title: {
      text: 'Sale Count',
      style: { fontSize: '14px', cssClass: 'apexcharts-yaxis-title' }
    },
  }]
}



  // Render charts
  new ApexCharts(document.querySelector("#generated-revenue"), revenue).render();
  new ApexCharts(document.querySelector("#order-revenue-chart"), orderRevenue).render();
  new ApexCharts(document.querySelector("#category-sales-chart"), productCategorySales).render();
  new ApexCharts(document.querySelector("#best-selling-product-chart"), bestSellingProduct).render();
})
