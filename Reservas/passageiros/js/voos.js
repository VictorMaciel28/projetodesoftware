$(document).ready(function () {
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
    url: 'servidor/index.php/id',
    dataType: "json",
    success: function(data) {
      console.log(data);
    }
  })
}

function montatabela(voosmostrados) {
  $('#tbodyid').html('');
  voosmostrados.forEach(function (obj, index) {
    var p1 = '<tr meuid="' + index + '"><td>' + obj.DT_SAIDA_VOO + '</td>'
    var p2 = '<td>' + obj.NR_ROTA_VOO + '</td>'
    var p3 = '<td>' + obj.CD_ARNV + '</td>'
    var p4 = '<td><a href="#deleteEmployeeModal" class="glyphicon glyphicon-ok" data-toggle="modal" >'
    var p5 = '</a></td></tr>'
    var finaldiv = p1 + p2 + p3 + p4 + p5;

    $('#tbodyid').append(finaldiv);

    //$( "tbody#tbodyid tr:eq(5)" ).css( "backgroundColor", "#ff0" );
  
  });
}
