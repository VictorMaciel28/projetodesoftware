$(document).ready(function () {
renderReservas();
});

function renderReservas() {
$('#tbodyid').html('');
$.ajax({
    type: "POST",
    url: '../servidor/index.php/reservas',
    //O formato da resposta é Json:
    // {CD_Produto: "3", NM_Produto: "Óleo Shell Helix HX3 20W50", VR_Produto: "17,50", IM_Produto: "http://localhost/realcentercar/img/produtos/Oleo_20W50.jpg"}
    dataType: "json",
    success: function(data) {
    montarreservas(data);
    //tente logar data[1] ou data[1].NM_Produto ou data[2].IM_Produto
    //ProdutosTodos=data
    //QuantidadeDeTelas=Math.ceil(ProdutosTodos.length/ProdutosPorTela);
    //montarDivDePaginacao(QuantidadeDeTelas)
    //changeProdutosTodos(0);
    },
    error: function () {
    alert("Algum problema com a conectividade com o banco.");
    }
})
}

function montarreservas(data){
    data.forEach(function (obj, index) {
        var p1 = '<tr meuid="' + index + '"><td>' + obj.NR_VOO + '</td>'
        var p2 = '<td>' + obj.DT_SAIDA_VOO + '</td>'
        var p3 = '<td>0</td>'
        var p4 = '<td><a href="#deleteEmployeeModal" class="glyphicon glyphicon-ok" data-toggle="modal" >'
        var p5 = '</a></td></tr>'
        var finaldiv = p1 + p2 + p3 + p4 + p5;
        $('#tbodyid').append(finaldiv);
        //$( "tbody#tbodyid tr:eq(5)" ).css( "backgroundColor", "#ff0" );
    });
}

