$(document).ready(function () {
montarreserva();
renderVoos();
});

function renderVoos() {
  $('#tbodyid').html('');
  $.ajax({
    type: "POST",
    url: '../servidor/index.php/voos',
    //O formato da resposta é Json:
    // {CD_Produto: "3", NM_Produto: "Óleo Shell Helix HX3 20W50", VR_Produto: "17,50", IM_Produto: "http://localhost/realcentercar/img/produtos/Oleo_20W50.jpg"}
    dataType: "json",
    success: function(data) {
      Variavelglobal=data
      voosmostrados = data.slice(0, 15)
      montatabela(voosmostrados);
      
      //tente logar data[1] ou data[1].NM_Produto ou data[2].IM_Produto
      //ProdutosTodos=data
      //QuantidadeDeTelas=Math.ceil(ProdutosTodos.length/ProdutosPorTela);
      //montarDivDePaginacao(QuantidadeDeTelas)
      //changeProdutosTodos(0);
    },
    error: function () {
      alert("Algum problema com a conectividade com o banco.");
    }
  }).responseText; 
}

function getid(){
  $.ajax({
    type: "POST",
    url: '../servidor/index.php/reservas',
    dataType: "json",
    success: function(data) {
      alert(data);
    }
  })
}

function montatabela(voosmostrados) {
  $('#tbodyid').html('');
  voosmostrados.forEach(function (obj, index) {
    var p1 = '<tr meuid="' + index + '"><td>' + obj.NR_VOO + '</td><td>' + obj.DT_SAIDA_VOO + '</td>'
    var p2 = '<td>' + obj.NR_ROTA_VOO + '</td>'
    var p3 = '<td>' + obj.CD_ARNV + '</td>'
    var p4 = '<td><button type="button" class="btn glyphicon glyphicon-ok"></button></td>'
    var p5 = '</tr>'
    var finaldiv = p1 + p2 + p3 + p4 + p5;

    $('#tbodyid').append(finaldiv);

    //$( "tbody#tbodyid tr:eq(5)" ).css( "backgroundColor", "#ff0" );       <a href="#deleteEmployeeModal" class="glyphicon glyphicon-ok" data-toggle="modal"></a>
  
  });
}

var col1;
var col2;
var col3;
var col4

function montarreserva(){
  $('.table tbody').on('click','.btn', function(){
    var currow = $(this).closest('tr');
    col1=currow.find('td:eq(0)').text();
    col2=currow.find('td:eq(1)').text();
    col3=currow.find('td:eq(2)').text();
    col4=currow.find('td:eq(3)').text();
    $('#deleteEmployeeModal').modal('show');
  })
}

function buscar(){
  campo = $("#campo").val();
  $.post({
    url: '../servidor/index.php/buscavoo',
    data:{'campo':campo},
    dataType: "json",
    success:function(data){
      voosmostrados = data.slice(0, 15)
      montatabela(data);
    }
  })
}

function reservar(){
  $.post({
    url: '../servidor/index.php/reservar',
    data:{'col1':col1,'col2':col2,'col3':col3},
    dataType: "text",
    success:function(data){
      alert(data)
    }
  })
}

  /*cole1 = JSON.stringify(col1);
  $.post({
    url: '../servidor/index.php/reservar',
    dataType: "json",
    success:function(response){
      alert("asdasd")
    },
    error: function () {
      alert("data");
    }
  })
}*/
