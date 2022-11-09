//Deklarasi Variabel
var reloadData = 30; // dalam detik
var timer;
var globalklik = "btc_idr";
var relasi;
var arr = []

//Take ID data
tes = document.querySelector('#tes');
cari = document.querySelector('#cari');
icon = document.querySelector('#icon');
passing = document.querySelector('#passing')

//All Function Declaration
ambildata = () => {
  tes = document.querySelector('#tes')
}
function updateDataAPI() {
  $.ajax({
    url: 'https://indodax.com/api/summaries',
    success: function(data) {
      passingTable(data)
      clearTimeout(timer)
      $('#timer').html(reloadData)
      setTimeout(updateDataAPI, reloadData*1000)
      updateTimer()
    },
    error: function(err) {
      alert("Tidak bisa mengambil data API")
    }
  })
}
function findAPI(){
  $.ajax({
    url: 'https://indodax.com/api/summaries',
    success: function(data) {
      var row;
      passingByFind(data)
    },
    error: function(err) {
      alert("Tidak bisa mengambil data API")
    }
  })
}
function updateTimer() {
  a = parseInt($('#timer').html())
  $('#timer').html(a - 1)
  if (a > 0)
    timer = setTimeout(updateTimer, 1000)
}
function passingToPembayaran(){
  $.ajax({
    url: 'https://indodax.com/api/summaries',
    success: function(data) {
      var d = 0;
      $("#passing").html(`
                    <br>
                    <tr>
                    <th>Pairs</th>
                    <th>Harga Beli</th>
                    <th>Harga Jual</th>
                    </tr>
      `)
      for (var key in data.tickers) {
        if(globalklik==key){
          relasi = key
          d = data.tickers[key].buy;
          row = `<tr>
              <td style="color: blue;"> ${key.toUpperCase()}</td>
              <td> ${data.tickers[key].last} </td>
              <td> ${data.tickers[key].buy} </td>
            </tr>`
        $('#passing tr:last').after(row);
        $('#judul').html(`<b>${data.tickers[key].name}</b>`)
        $('#detail').html(`Koin dengan pairs <b>${key.toUpperCase()}</b> atau yang memiliki nama formal 
        <b>${data.tickers[key].name}</b> 
        adalah koin luar biasa yang dapat mendatangkan keuntungan berkali kali lipat 
        sedang memiliki harga beli <span style="color: green"><b>${data.tickers[key].buy}</b></span> dan 
        memiliki harga jual <span style="color: red"><b>${data.tickers[key].sell}</b></span> pada 
        hari ini sudah terjadi transaksi jual beli sebanyak <span style="color: blue"><b>${toFixed(data.tickers[key].vol_idr/data.tickers[key].last,2)}</b></span>
        atau jika dirupiahkan sama dengan <span style="color: blue"><b>${data.tickers[key].vol_idr}</b></span>`)
        }
      }
      
    },
    error: function(err) {
      alert("Tidak bisa mengambil data API")
    }
  })
  $.ajax({
    url : "https://indodax.com/api/pairs",
    success : function(data){
      for(var keyGambar = 0; keyGambar< data.length; keyGambar++){
        if(relasi==data[keyGambar].ticker_id)
        icon.src = data[keyGambar].url_logo_png
      }
    },
    error : function(err){
        alert("data gambar gagal di ambil")
    }
  })
}
function klikTable(a) {
  globalklik = a
  passingToPembayaran()
  console.log(globalklik)
  localStorage.setItem( 'objectToPass', globalklik );
  location.href=`halamanbeli.php?${a}`;
}
function klikTable2(a) {
  globalklik = a
  passingToPembayaran()
  console.log(globalklik)
}
function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("coins");
  switching = true;
  dir = "asc"; 
  while (switching) {
    switching = false;
    rows = table.rows;
    for (i = 1; i < (rows.length - 1); i++) {
      shouldSwitch = false;
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      if(n==0){
        if (dir == "asc") {
          if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
            shouldSwitch = true;
            break;
          }
        }
      }
      else if(n==6){
        if (dir == "asc") {
          
          if (parseFloat(x.innerHTML.slice(3,-4)) > parseFloat(y.innerHTML.slice(3,-4))) {
            shouldSwitch= true;
            break;
          }
        } else if (dir == "desc") {
          if (parseFloat(x.innerHTML.slice(3,-4)) < parseFloat(y.innerHTML.slice(3,-4))) {
            shouldSwitch = true;
            break;
          }
        }
      }
      else{
      if (dir == "asc") {
        
        if (parseFloat(x.innerHTML.toLowerCase()) > parseFloat(y.innerHTML.toLowerCase())) {
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (parseFloat(x.innerHTML.toLowerCase()) < parseFloat(y.innerHTML.toLowerCase())) {
          shouldSwitch = true;
          break;
        }
      }
      }
    }
    if (shouldSwitch) {
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      switchcount ++;      
    } else {
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
function toFixed(value, precision) {
  var precision = precision || 0,
      power = Math.pow(10, precision),
      absValue = Math.abs(Math.round(value * power)),
      result = (value < 0 ? '-' : '') + String(Math.floor(absValue / power));

  if (precision > 0) {
      var fraction = String(absValue % power),
          padding = new Array(Math.max(precision - fraction.length, 0) + 1).join('0');
      result += '.' + padding + fraction;
  }
  return result;
}
function passingTable(data){
  var comp = -999, jum = 0;
  $('#coins').html(`<tr style="cursor: pointer;">
                          <th onclick="sortTable(0)">Pairs&#x25b4;&#x25be;</th>
                          <th onclick="sortTable(1)">Harga&#x25b4;&#x25be;</th> 
                          <th onclick="sortTable(2)">Beli&#x25b4;&#x25be;</th> 
                          <th onclick="sortTable(3)">jual&#x25b4;&#x25be;</th> 
                          <th onclick="sortTable(4)">Tertinggi 24h&#x25b4;&#x25be;</th>
                          <th onclick="sortTable(5)">Terendah 24h&#x25b4;&#x25be;</th>
                          <th onclick="sortTable(6)">Persentase&#x25b4;&#x25be;</th>
                        </tr>`)
      for (var key in data.tickers) {
        if(key.includes(tes.value)){
        if(key.slice(-4,-3)=="_")
          var tx = 100 - data.prices_24h[key.slice(0,-4)+key.slice(-3)]/data.tickers[key].last*100
        else
          var tx = 100 - (parseFloat(data.tickers[key].high)+parseFloat(data.tickers[key].low))/2/data.tickers[key].buy*100
        
        arr.push([key,data.tickers[key].buy,data.tickers[key].sell,tx])

        tx = tx.toString().slice(0,4)
        row = `<tr id=${key} onclick='klikTable(id);' style="cursor: pointer; class="item">
              <td style="color: blue;">${key.toUpperCase()}</td>
              <td> ${data.tickers[key].last} </td>
              <td> ${data.tickers[key].buy} </td>
              <td> ${data.tickers[key].sell} </td>
              <td> ${data.tickers[key].high} </td>
              <td> ${data.tickers[key].low} </td>`
        if(tx>0)
        row = row + `<td style="color: green"><b> ${tx}%</b></td>
        </tr>`
        else if(tx==0)
        row = row + `<td style="color: grey"><b> ${tx}%</b></td>
        </tr>`
        else
        row = row + `<td style="color: red"><b> ${tx}%</b></td>
        </tr>`
        $('#coins tr:last').after(row);
      }
    }
    arr.sort(function(a,b) {
      return a[3]-b[3]
  });
    arr.reverse()
    $('#top').html(`<tr>
                      <th>Pairs</th>
                      <th>Harga Beli</th>
                      <th>Harga Jual</th>
                      <th>Persentase</th>
                    </tr>`)
    for(i=0; i<10; i++){
      row = `<tr id=${arr[i][0]} onclick='klikTable(id)' style="cursor: pointer; class="item">
              <td style="color: blue;">${arr[i][0].toUpperCase()}</td>
              <td> ${arr[i][1]} </td>
              <td> ${arr[i][2]} </td>
              <td style="color: green"><b> ${toFixed(arr[i][3],2)}%</b></td>
              </tr>`
              $('#top tr:last').after(row);
    }
    $('#loser').html(`<tr>
                        <th style="background-color: red;">Pairs</th>
                        <th style="background-color: red;">Harga</th>
                        <th style="background-color: red;">Beli</th>
                        <th style="background-color: red;">Persentase</th>
                      </tr>`)
    arr.reverse()
    for(i=0; i<10; i++){
      row = `<tr id=${arr[i][0]} onclick='klikTable(id)' style="cursor: pointer; class="item">
              <td style="color: blue;">${arr[i][0].toUpperCase()}</td>
              <td> ${arr[i][1]} </td>
              <td> ${arr[i][2]} </td>
              <td style="color: red"><b> ${toFixed(arr[i][3],2)}%</b></td>
              </tr>`
              $('#loser tr:last').after(row);
    }
    arr = []
}
function passingByFind(data){
  $('#coins').html(`<tr style="cursor: pointer;">
                          <th onclick="sortTable(0)">Pairs&#x25b4;&#x25be;</th>
                          <th onclick="sortTable(1)">Harga&#x25b4;&#x25be;</th> 
                          <th onclick="sortTable(2)">Beli&#x25b4;&#x25be;</th> 
                          <th onclick="sortTable(3)">jual&#x25b4;&#x25be;</th> 
                          <th onclick="sortTable(4)">Tertinggi 24h&#x25b4;&#x25be;</th>
                          <th onclick="sortTable(5)">Terendah 24h&#x25b4;&#x25be;</th>
                          <th onclick="sortTable(6)">Persentase&#x25b4;&#x25be;</th>
                        </tr>`)
      for (var key in data.tickers) {
        if(key.includes(tes.value)){
        if(key.slice(-4,-3)=="_")
          var tx = 100 - data.prices_24h[key.slice(0,-4)+key.slice(-3)]/data.tickers[key].last*100
        else
          var tx = 100 - (parseFloat(data.tickers[key].high)+parseFloat(data.tickers[key].low))/2/data.tickers[key].buy*100
        
        arr.push([key,data.tickers[key].buy,data.tickers[key].sell,tx])

        tx = tx.toString().slice(0,4)
        row = `<tr id=${key} onclick='klikTable(id);' style="cursor: pointer; class="item">
              <td style="color: blue;">${key.toUpperCase()}</td>
              <td> ${data.tickers[key].last} </td>
              <td> ${data.tickers[key].buy} </td>
              <td> ${data.tickers[key].sell} </td>
              <td> ${data.tickers[key].high} </td>
              <td> ${data.tickers[key].low} </td>`
        if(tx>0)
        row = row + `<td style="color: green"><b> ${tx}%</b></td>
        </tr>`
        else if(tx==0)
        row = row + `<td style="color: grey"><b> ${tx}%</b></td>
        </tr>`
        else
        row = row + `<td style="color: red"><b> ${tx}%</b></td>
        </tr>`
        $('#coins tr:last').after(row);
      }
    }
}
function myFunction() {
  let text = "Press a button!\nEither OK or Cancel.";

  if ((confirm(text) == true)) 
    location.href="detail.php"
  else{
    localStorage.setItem('cancel', 'true' );
    location.href="halamanbeli.php"
  }
}

$("#tes").on("change keyup paste", function(){
  findAPI()
})
$("#beli").on('click',function(){
  
  klikTable("btc_idr")
})
var slideIndex = 0;
function showSlides() {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("dot");
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
  }
  slideIndex++;
  if (slideIndex > slides.length) {slideIndex = 1}    
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " active";
  setTimeout(showSlides, 4000); // Change image every 2 seconds
}
$("#login-button").click(function(event){
  event.preventDefault();

$('form').fadeOut(500);
$('.wrapper').addClass('form-success');
});