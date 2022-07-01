<div class="m-3 flex gap-0">
  <input
    type="date" name="fromDate" id="fromDate"
    class="z-10 rounded-l-lg border border-r-0 border-indigo-200 p-3 text-lg"
    value={{ $date[0] }}>
  <span class="z-0 inline-block border border-l-0 border-r-0 border-indigo-200 bg-gray-200 p-3 text-lg">Sampai</span>
  <input type="date" name="untilDate" id="untilDate"
    class="z-10 rounded-r-lg border border-l-0 border-indigo-200 p-3 text-lg"
    value={{ $date[1] }}>
</div>
<div id="chart" class="relative h-96">
  <canvas id="myChart"></canvas>
</div>
<script>
  var labels = @json($chart->pluck('waktu')->all());
  var data = {
    labels: labels,
    datasets: [
      @if ($key == 'tekanan_darah')
        {
          label: "{{ ucwords('sistole') }}",
          data: @json($chart->pluck('sistole')->all()),
          borderColor: 'rgba(160, 53, 235, 0.8)',
          backgroundColor: 'rgba(160, 53, 235, 0.8)',
          tension: 0.3
        }, {
          label: "{{ ucwords('diastole') }}",
          data: @json($chart->pluck('diastole')->all()),
          borderColor: 'rgba(53, 157, 235, 0.8)',
          backgroundColor: 'rgba(53, 157, 235, 0.8)',
          tension: 0.3
        }
      @else
        {
          label: "{{ ucwords(str_replace('_', ' ', $key)) }}",
          data: @json($chart->pluck('hasil')->all()),
          borderColor: 'rgba(160, 53, 235, 0.8)',
          backgroundColor: 'rgba(160, 53, 235, 0.8)',
          tension: 0.3
        }
      @endif
    ]
  };
  var ctx = document.getElementById('myChart');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: data,
    options: {
      maintainAspectRatio: false,
      responsive: true,
      plugins: {
        title: {
          display: 'auto',
          text: "{{ ucwords(str_replace('_', ' ', $key)) }}"
        },
        tooltip: {
          mode: 'index',
          titleFont: {
            size: 18
          },
          bodyFont: {
            size: 18
          }
        }
      },
      interaction: {
        intersect: false,
      },
      scales: {
        x: {
          display: true,
          title: {
            display: true,
            text: 'Tanggal'
          },
          ticks: {
            autoSkip: true,
            maxTicksLimit: 20
          }
        },
        y: {
          display: true,
          title: {
            display: true,
            text: 'Hasil'
          },
        },
      },
    }
  });
</script>
