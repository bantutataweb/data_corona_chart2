<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Corona</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script
  src="https://code.jquery.com/jquery-3.6.0.js"
  integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@200&display=swap');

    *{
        font-family: 'Nunito', sans-serif;
    }
  </style>
</head>
<body>
    <div class="container">
        <br><br>
        <h1 class="text-center">Data Charts Coronavirus</h1>
        <h4 class="text-center">Update Data : <span id="date"></span></h4>
        <br>
        <div class="negara">
            <div class="dropdown">
                <a class="btn btn-info text-white dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    - Pilih Negara - 
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <?php 
                     $data = file_get_contents('https://raw.githubusercontent.com/samayo/country-json/master/src/country-by-population.json');
                     $data = json_decode($data, true);
                     foreach($data as $dt):
                    ?>
                        <button id="negara" class="dropdown-item" type="button"><?= $dt['country'] ?></button>
                     <?php endforeach; ?>
                </div>
            </div>
            <br>
            <p id="p"></p>
        </div>
        <br>
        <div class="chart">
            <div>
                <canvas id="myChart"></canvas>
            </div>
        </div>
        
    </div>

</body>
<script>
 $(document).ready(function(){
    $.getJSON('https://pomber.github.io/covid19/timeseries.json', function(data){
        $('button').on('click',function(){
            x = $(this).text()
            $('#p').html('<h2 style="text-align:center;">'+ x + '</h2>');
            var Negara = data[x];
        var yData = Negara.map(function(e){
            return e.confirmed
        })
        var xLabel = Negara.map(function(e){
            return e.date
        })
        var yData2 = Negara.map(function(e){
            return e.recovered
        })
        function daily_increase(Data) {
                var newDaily = []; // INI KUNCI mau BUAT ARRAY DALAM LOOP // Format di atas FOR
                for (i in Data) {
                    if (i == 0){
                        newDaily += Data[0] + ", ";
                    }
                    else {
                        newDaily += Data[i]-Data[i-1] + ", ";
                    }
                }
                return newDaily; // hubungkan dan cetak sumber var newDaily
         }
         Ydata = daily_increase(yData)
         Ydata2 = Ydata.split(", ");
         rData2 = Ydata2.length;
         YData2 = Ydata2.slice(0,rData2-1)
         console.log(YData2)
         console.log(xLabel)
        const ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: xLabel,
                datasets: [{
                    label: ['Kasus Baru'],
                    data: YData2,
                    backgroundColor: 'rgba(189, 228, 255)',
                    borderColor:'rgb(189, 228, 255)',
                    borderWidth: 4
                },  {    
                    type: 'line'  ,            
                    label: 'Sembuh',
                    data: yData2,
                    backgroundColor: 'transparent',
                    borderColor:'rgb(77, 179, 247)',
                    borderWidth: 4
                }
            ]
            },
                    });
        })
        x = $(this).text()
        $('#p').html('<h2 style="text-align:center;">Indonesia</h2>')
        var Negara = data.Indonesia;
        var yData = Negara.map(function(e){
            return e.confirmed
        })
        var xLabel = Negara.map(function(e){
            return e.date
        })
        var yData2 = Negara.map(function(e){
            return e.recovered
        })
        const ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: xLabel,
                datasets: [{
                    label: 'Seluruh Kasus',
                    data: yData,
                    backgroundColor: 'rgba(189, 228, 255)',
                    borderColor:'rgb(189, 228, 255)',
                    borderWidth: 4
                },{    
                    type: 'line'  ,            
                    label: 'Sembuh',
                    data: yData2,
                    backgroundColor: 'transparent',
                    borderColor:'rgb(77, 179, 247)',
                    borderWidth: 4
                }
            ]
            },
       });

    });  
        
 });
        // Mengubah Tanggal Ke dalam Bahsa Indonesia
		var get = document.getElementById('date')
        var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jum&#39;at', 'Sabtu'];
        var date = new Date();
        var day = date.getDate();
        var month = date.getMonth()
        var thisDay = date.getDay();
        thisDay = myDays[thisDay];
        var yy = date.getYear();
        var year = (yy < 1000) ? yy + 1900 : yy;
        get.innerHTML = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
</script>
</html>
