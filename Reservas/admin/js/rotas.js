$(document).ready(function () {
renderRotas();
});

function renderRotas() {
$('#tbodyid').html('');
$.ajax({
    type: "POST",
    url: 'http://localhost/projetodesoftware/Reservas/admin/servidor/index.php/rotas',
    //O formato da resposta é Json:
    // {CD_Produto: "3", NM_Produto: "Óleo Shell Helix HX3 20W50", VR_Produto: "17,50", IM_Produto: "http://localhost/realcentercar/img/produtos/Oleo_20W50.jpg"}
    dataType: "json",
    success: function(data) {
    dados = data.slice(0, 15)
    montarrotas(dados);
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

function montarrotas(data){
    data.forEach(function (obj, index) {
        var p1 = '<tr meuid="' + index + '"><td>' + obj.NR_ROTA_VOO + '</td>'
        var p2 = '<td>' + obj.ITR_ARPT_CD_ORIG + '</td>'
        var p3 = '<td>'+ obj.ITR_ARPT_CD_DEST +'</td>'
        if (obj.VR_PASG!=null){var p4 = '<td>'+ obj.VR_PASG +'</td>'}else{var p4='<td>Sem dado</td>';}
        var p5 = '<td><a href="#deleteEmployeeModal" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a></td>'
        var p6 = '</a></td></tr>'
        var finaldiv = p1 + p2 + p3 + p4 + p5 + p6;
        $('#tbodyid').append(finaldiv);
        //$( "tbody#tbodyid tr:eq(5)" ).css( "backgroundColor", "#ff0" );
    });
}

