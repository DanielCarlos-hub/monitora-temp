$(function(e) {
    "use strict";
	  $(".date-inputmask").inputmask("date", {
		  inputFormat: "yyyy-mm-dd",
		  outputFormat: "dd/mm/aaaa",
		  locale: "en-US"
      });
    $(".year").inputmask("9999"),
    $(".pis").inputmask("999.99999.99-9"),
    $(".cpf").inputmask("999.999.999-99"),
	$(".cnpj").inputmask("99.999.999/9999-99"),
	$(".ie").inputmask("999999999.99-99"),
    $(".rg").inputmask("99.999.999[-9]"),
    $(".titulo").inputmask("9999 9999 9999"),
    $(".zona").inputmask("999"),
    $(".secao").inputmask("9999"),
    $(".militar").inputmask("999999999999"),
    $(".cnh").inputmask("99999999999"),
    $(".cep").inputmask("99999999"),
	$(".num").inputmask("99999"),
    $(".codigo-5").inputmask("99999"),
    $(".codigo-8").inputmask("99999999"),
    $(".residencial").inputmask("(99) 9999-9999"),
    $(".celular").inputmask("(99) \\9-9999-9999"),
    $(".telefone").inputmask(["(99) 9999-9999", "(99) 9-9999-9999"]),
    $(".carga").inputmask("99"),
    $(".money").inputmask({
        'alias': 'numeric',
        'groupSeparator': '.',
        'autoGroup': true,
        'digits': 2,
        'radixPoint': ",",
        'digitsOptional': false,
        'allowMinus': false,
        'placeholder': '0',
        'clearMaskOnLostFocus': true
    }),
    $(".cnpj").inputmask("99.999.999/9999-99"),
    $(".uf").inputmask("AA"),
    $(".email-inputmask").inputmask({
    mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]"
    , greedy: !1
    , onBeforePaste: function (n, a) {
        return (e = e.toLowerCase()).replace("mailto:", "")
    }
    , definitions: {
        "*": {
            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]"
            , cardinality: 1
            , casing: "lower"
        }
    }
    })
});
