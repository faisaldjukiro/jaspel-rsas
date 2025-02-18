var optionsProfileVisit = {
  chart: {
    type: "bar",
    height: 300,
  },
  dataLabels: {
    enabled: false,
  },
  series: [
    {
      name: "Total Jasa",
      data: [9, 20, 30, 20, 10, 20, 30, 20, 10, 20, 30, 20],
    },
  ],
  colors: ["#0D30AFFF"],
  xaxis: {
    categories: [
      "Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ],
  },
};

var chartProfileVisit = new ApexCharts(
  document.querySelector("#chart-profile-visit"),
  optionsProfileVisit
);

chartProfileVisit.render();
