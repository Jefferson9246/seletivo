<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="./css/d"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/af-2.3.7/cr-1.5.5/r-2.2.9/sc-2.0.5/datatables.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.13.1/dist/css/uikit.min.css" />
    <title>Document</title>
</head>

<body>
    <div class="uk-text-center">
        <div class="uk-text-lead" id="teste">
            Listando produtos
        </div>
        <div class="uk-grid uk-padding uk-align-center" style="max-width: 600px;">
            <ul class="uk-switcher uk-margin">
                <li class="uk-active">
                    <div class="uk-overflow-auto uk-card">

                        <table id="myTable" class=" uk-table uk-table-hover uk-table-divider uk-align-center" class="display" style="width:100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Data Inserido</th>
                                    <th>Descrição</th>
                                    <th>Valor</th>
                                </tr>
                            </thead>
                            <tbody id="table_prod">

                            </tbody>
                        </table>

                    </div>
                </li>

            </ul>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/autofill/2.3.9/js/dataTables.autoFill.min.js"></script> -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/jq-3.6.0/dt-1.11.5/af-2.3.7/cr-1.5.5/r-2.2.9/sc-2.0.5/datatables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.13.1/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.13.1/dist/js/uikit-icons.min.js"></script>
</body>

</html>
<script>
    $(document).ready(function() {

        function adicionaZero(numero) {
            if (numero <= 9)
                return "0" + numero;
            else
                return numero;
        }

        function formatar_data(data) {
            let dataAtual = new Date(data); //29/01/2020
            let dataAtualFormatada = (adicionaZero(dataAtual.getDate().toString()) + "/" + (adicionaZero(dataAtual.getMonth() + 1).toString()) + "/" + dataAtual.getFullYear());
            return dataAtualFormatada;
        }

        const Table = $('#myTable').DataTable({
            scrollY: 300,
            paging: false,
            stateSave: true,
            "language": {
                "zeroRecords": "Nenhum registro encontrado",
                "info": "Mostrando páginas _PAGE_ de _PAGES_",
                "infoEmpty": "Nenhum registro encontrado"
            }
        })

        $.ajax({
            url: 'get_prod',
            method: 'GET',
            success: function(data) {
                console.log('chegando', data)
                $('#table_prod>').remove()
                $(data.produtos).each(function(index, valor) {
                    console.log('valor antes', valor.Valor)
                    let val_format = parseFloat(valor.Valor).toLocaleString('pt-BR', {
                        minimumFractionDigits: 2
                    })
                    console.log('valor depois', val_format)
                    Table.row.add([
                        valor.Id,
                        formatar_data(valor.DataAquisicao),
                        valor.Descricao,
                        val_format
                    ]).draw(false)
                })

            }
        })
    });
</script>