//CAIXA PRINT
var total = document.getElementById("total");
var total_valor = 0.00;
var itens = document.getElementById("itens");
var itens_valor = 0.00;
var troco = document.getElementById("troco");
var troco_valor = 0.00;
var total_nota = document.getElementById("total_nota");
var valor_pago_nota = document.getElementById("valor_pago_nota");
var troco_nota = document.getElementById("troco_nota");
var form = document.getElementById("form");
var data;
var form_pagamento = document.getElementById("form_pagamento");
var form_deleta = document.getElementById("form_deleta");
//DELETA
form_deleta.onsubmit = function(event){
    event.preventDefault();
    senha = $("#senha").val();
}
//PAGAMENTO
form_pagamento.onsubmit = function(event){
    event.preventDefault();
    valor_pago = $("#valor").val();
    if(valor_pago < total_valor){
        alert("Valor insuficiente.");
    }else{
        $.ajax({
            url: 'http://localhost/acouguedofiel/php/selectproduto.php',
            method: 'GET',
            datatype: 'json',
            }).done(function select(result){
                var data = result;
                for(var i = 0; i < data.length ; i++){
                    var id = result[i][0];
                    var codigo = result[i][1];
                    var descricao = result[i][2];
                    var preco = parseFloat(result[i][3]);
                    var quantidade = parseFloat(1);
                    var valor_total = preco*quantidade;
                    preco = preco.toFixed(2);
                    quantidade = quantidade.toFixed(2);
                    $('#tabela-nota').append('<tr class="produto_nota"> <th>' + quantidade + '</th> <th>' + descricao +'</th> <th> R$' + preco + '</th> <th>R$' + valor_total.toFixed(2) + '</th> <th style="display: none;" class="id">' + id + '</th> </tr>');
                    total_nota.innerHTML = "Total: R$" + total_valor.toFixed(2);
                }
            })
        $.ajax({
            url: 'http://localhost/acouguedofiel/php/pagamento.php',
            method: 'GET',
            datatype: 'json',
        }).done(function(result){
            console.log(valor_pago)
            troco_valor = valor_pago - total_valor;
            total.innerHTML = "Total: R$ 0.00";
            itens.innerHTML = "Itens: 0";
            troco.innerHTML = "Troco: R$ " + troco_valor.toFixed(2);
            valor_pago_nota.innerHTML = "Valor Pago: R$" + valor_pago;
            troco_nota.innerHTML = "Troco: R$" + troco_valor.toFixed(2);
            var tabela = document.getElementById("printable");
            print(tabela);
            var modal = document.getElementById('modal-dinheiro');
            modal.classList.remove('mostrar');
            $('.produto').remove();
            $('.produto_nota').remove()
            total_nota.innerHTML = "Total: R$ 0.00"
            total_valor = 0;
            itens_valor = 0;
        })
    }
};
//ENVIA FORMULARIO SEM REFRESH
form.onsubmit = function(event){
    event.preventDefault()
    var _codigo = document.getElementById("codigo").value;
    form.reset();
    document.getElementById('codigo').focus();
    $.ajax({
        url: 'http://localhost/acouguedofiel/php/enviaCaixa.php',
        method: 'POST',
        data: {codigo: _codigo},
        datatype: 'json',
    }).done(function(result){
        console.log(result)
        if(result === 'invalid'){
            alert('Código Inválido');
        }else{
            getcurrentcaixa();
        }
    })
    };
//PEGA TODOS OS DADOS AO CARREGAR A PÁGINA
function getcaixa(){
    $.ajax({
        url: 'http://localhost/acouguedofiel/php/selectproduto.php',
        method: 'GET',
        datatype: 'json',
        }).done(function select(result){
            var data = result;
            for(var i = 0; i < data.length ; i++){
                var id = result[i][0];
                var codigo = result[i][1];
                var descricao = result[i][2];
                var preco = parseFloat(result[i][3]);
                var quantidade = parseFloat(1);
                var valor_total = preco*quantidade;
                total_valor = total_valor + valor_total;
                itens_valor = itens_valor + quantidade;
                preco = preco.toFixed(2);
                quantidade = quantidade.toFixed(2);
                $('#tabela').append('<tr class="produto"><th>' + codigo +'</th>' + '<th>' + descricao + '</th> <th>' + quantidade +'</th> <th class="preco">' + preco + '</th> <th style="display: none;" class="id">' + id + '</th><th><img src="img/delete2.png"/></th></tr>');
                total.innerHTML = "Total: R$ " + total_valor.toFixed(2);
                itens.innerHTML = "Itens: " + itens_valor;
                total_nota.innerHTML = "Total: R$" + total_valor.toFixed(2);
            }
        $(".produto").each(function(){
            var tr = $(this)
            var img = $(this).find('img');
            var id = $(this).find('.id').text();
            var preco = $(this).find('.preco').text()
            img.click(function(){
                mostramodal2();
                form_deleta.onsubmit = function(event){
                    event.preventDefault();
                    senha = $("#senha").val();
                    if(senha === '1234'){
                    total_valor = total_valor - preco;
                    total.innerHTML = "Total: R$ " + total_valor.toFixed(2);
                    itens_valor--
                    itens.innerHTML = "Itens: " + itens_valor; 
                    $.ajax({
                        url: 'http://localhost/acouguedofiel/php/deleta.php',
                        method: 'POST',
                        data: {id: id},
                        datatype: 'json',
                    }).done(function deleta(){
                        tiramodal2();
                        tr.remove();
                    })
                    }else{
                        alert("Senha incorreta!");
                    }
                }
            })
        });
    });
}
//PEGA O PRODUTO QUE ACABOU DE SER LANÇADO
function getcurrentcaixa(){
    $.ajax({
    url: 'http://localhost/acouguedofiel/php/selectproduto.php',
    method: 'GET',
    datatype: 'json',
    }).done(function select(result){
        var data = result;
        var id = result[data.length - 1][0];
        var codigo = result[data.length - 1][1];
        var descricao = result[data.length - 1][2];
        var preco = parseFloat(result[data.length - 1][3]);
        var quantidade = parseFloat(1);
        var valor_total = preco*quantidade;
        total_valor = total_valor + valor_total;
        itens_valor = itens_valor + quantidade;
        preco = preco.toFixed(2);
        quantidade = quantidade.toFixed(2);
        $('#tabela').append('<tr class="produto"><th>' + codigo +'</th>' + '<th>' + descricao + '</th> <th>' + quantidade +'</th> <th>' + preco + '</th> <th style="display: none;" class="id">' + id + '</th><th><img src="img/delete2.png"/></th></tr>');
        total.innerHTML = "Total: R$ " + total_valor.toFixed(2);
        itens.innerHTML = "Itens: " + itens_valor;
        total_nota.innerHTML = "Total: R$" + total_valor.toFixed(2);
        var last_child = $(".produto:last-child")
        var img = last_child.find('img');
        var id = last_child.find('.id').text();
        img.click(function(){
            mostramodal2();
            form_deleta.onsubmit = function(event){
                event.preventDefault();
                senha = $("#senha").val();
                if(senha === '1234'){
                total_valor = total_valor - preco;
                total.innerHTML = "Total: R$ " + total_valor.toFixed(2);
                itens_valor--
                itens.innerHTML = "Itens: " + itens_valor; 
                $.ajax({
                    url: 'http://localhost/acouguedofiel/php/deleta.php',
                    method: 'POST',
                    data: {id: id},
                    datatype: 'json',
                }).done(function deleta(){
                    tiramodal2();
                    last_child.remove();
                })
                }else{
                    alert("Senha incorreta!");
                }
            }
        })
    });
}

//MODAL PAGAMENTO E DELETA
function mostramodal1(){
    var modal = document.getElementById('modal-dinheiro');
    modal.classList.add('mostrar');  
    var input = document.getElementById('valor');
    input.focus();
    input.value = total_valor.toFixed(2);
    input.select();
}
function mostramodal2(){
    var modal = document.getElementById('modal-deleta');
    modal.classList.add('mostrar');  
    var input = document.getElementById('senha');
    input.focus();
    input.value = '';
}
function tiramodal(){
    var modal = document.getElementById('modal-dinheiro');
    modal.classList.remove('mostrar');
}
function tiramodal2(){
    var input = document.getElementById('senha');
    var modal = document.getElementById('modal-deleta');
    modal.classList.remove('mostrar');
    input.value = '';
}
//END PRINT
getcaixa();