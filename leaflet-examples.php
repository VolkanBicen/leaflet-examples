

<html>
<head>
  <meta charset=utf-8 />
  <title>Leaflet Control.Layers</title>
  <meta name='viewport' content='initial-scale=1,maximum-scale=1,user-scalable=no' />

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
  integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
  crossorigin=""/>
  <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
  integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
  crossorigin=""></script>

  <script src="https://unpkg.com/esri-leaflet@2.2.4/dist/esri-leaflet.js"
  integrity="sha512-tyPum7h2h36X52O2gz+Pe8z/3l+Y9S1yEUscbVs5r5aEY5dFmP1WWRY/WLLElnFHa+k1JBQZSCDGwEAnm2IxAQ=="
  crossorigin=""></script>

 <link rel="stylesheet" href="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.css"
    integrity="sha512-v5YmWLm8KqAAmg5808pETiccEohtt8rPVMGQ1jA6jqkWVydV5Cuz3nJ9fQ7ittSxvuqsvI9RSGfVoKPaAJZ/AQ=="
    crossorigin="">
  <script src="https://unpkg.com/esri-leaflet-geocoder@2.2.14/dist/esri-leaflet-geocoder.js"
    integrity="sha512-uK5jVwR81KVTGe8KpJa1QIN4n60TsSV8+DPbL5wWlYQvb0/nYNgSOg9dZG6ViQhwx/gaMszuWllTemL+K+IXjg=="
    crossorigin=""></script>

  <style>
    body { margin:0; padding:0; }
    #map { position: absolute; top:0; bottom:0; right:0; left:0; }
</style>
</head>
<body>

<style>
  1 {
    position: absolute;
    top: 100px;
    right: 10px;
    z-index: 400;
    padding: 1em;
    background: white;
  }
</style>

<div id="map"></div>
<div id="info-pane" class="leaflet-bar"></div>

  <script>
// map başlangıç lokasyonumuz ve zoom değerimiz tanımlanır.
   var gray = L.layerGroup();
  
   var map = L.map('map').setView([39.436, 34.069], 6);
   //map altlığımız tanımlanır
 L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="https://osm.org/copyright">OpenStreetMap</a> contributors'
  }).addTo(map);

//altlığın üzerine gelecek olan tabakamızın url verilir sorgumuz yazılır
   var il = L.esri.featureLayer({
    url: "Url",
    simplifyFactor: 0.35,
    precision: 50,
    fields: ['fields1', 'fields2 ', 'fields3'],
    style: {
      color: '#A9A9A9',
      weight: 1
  }
});
//altlığın üzerine gelecek olan tabakamızın url verilir sorgumuz yazılır
var ilce = L.esri.featureLayer({
    url: "Url",
    simplifyFactor: 0.35,
    precision: 50,
    fields: ['fields4', 'fields5','fields6'],
    style: {
      color: '#A9A9A9',
      weight: 1
  }
});


//mouseout eventi ile imlec lokasyondan ayrıldıktan sonra değerler sıfırlanır.

var oldId;

il.on('mouseout', function(e){
    document.getElementById('info-pane').innerHTML = ' ';
    il.resetFeatureStyle(oldId);
  });
//mouseover eventi ile imleç lokasyonun üzerindeyken sorgudan çekilen veriler gösterilir.
  il.on('mouseover', function(e){
    oldId = e.layer.feature.id;
    document.getElementById('info-pane').innerHTML = e.layer.feature.properties.fields2 + ' ' + e.layer.feature.properties.fields3;
    il.setFeatureStyle(e.layer.feature.id, {
      color: '#9D78D2',
      weight: 3,
      opacity: 1
    });
  });


var id;
ilce.on('mouseout', function(e){
    document.getElementById('info-pane').innerHTML = ' ';
    ilce.resetFeatureStyle(id);
  });

  ilce.on('mouseover', function(e){
    id = e.layer.feature.id;
    document.getElementById('info-pane').innerHTML = e.layer.feature.properties.fields4 + '-' + e.layer.feature.properties.fields5;
    ilce.setFeatureStyle(e.layer.feature.id, {
      color: '#FC0404',
      weight: 3,
      opacity: 1
    });
  });

  //ana katman ve alt katmanlar başlatılır.

   var baseLayers = {
    "Streetmap": gray
};

var overlays = {
    "İller": il,
    "İlçeler":ilce
   
};
L.control.layers(baseLayers, overlays).addTo(map);
</script>

</body>
</html>

