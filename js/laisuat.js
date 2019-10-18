jQuery(document).ready(function ($) {

/*$('#amount').on('input', function() {
    updatePanel();
});
$('#month').on('input', function() {
    updatePanel();
});*/
/*$('#rate').on('input', function() {
    updatePanel();
});*/

$('.show').on('click', function() {
    $('.result-body').html('');
    //$('.result-body').appendTo($('.bangtinh'));
    updatePanel();
});
    
function updatePanel() {
    calServiceFees();
}
function daysInMonth(month,year) {
    return new Date(year, month, 0).getDate();
}
function commaSeparateNumber(val){
    while (/(\d+)(\d{3})/.test(val.toString())){
      val = val.toString().replace(/(\d+)(\d{3})/, '$1'+','+'$2');
    }
    return val;
}
function calServiceFees() {
            
            $('.total_price').html('<div id="rotatingDiv"></div>');
            var months = new Array( "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12");

            var LS = $('#rate').val();
            var G = $('#amount').val();
            var M = $('#month').val();
            var now = new Date();
            var d = new Date();

            var month = d.getMonth()+1;
            var day = d.getDate();

            var output = (day<10 ? '0' : '') + day + '/' +
                (month<10 ? '0' : '') + month + '/' +
                d.getFullYear(); 
            
            var N = daysInMonth(months[now.getMonth()],now.getFullYear());

            var tonglai = 0;
            var goc = parseInt($('#amount').val());

            var GM = Math.ceil(G/M);

            

            $('.ky-thanh-toan').html(output);
            $('.amount-start').html(commaSeparateNumber(G));


            $('<tr><td>0</td><td class="ky-thanh-toan">'+output+'</td><td></td><td class="amount-start">'+commaSeparateNumber(G)+'</td><td></td><td></td><td></td></tr>').appendTo($('.result-body'));

            for (i = 1; i <= M; i++) { 
                $total = Math.round(eval("(" + congthuc + ")"));
                $total = $total/100;

                var permonth = GM + $total;
                var parts = output.split("/");
                var d  = new Date(parts[2], parts[1] - 1, parts[0]);
                var n  = new Date(parts[2], parts[1], parts[0]);
                var month = d.setMonth(d.getMonth() + 1, 1);
                month = months[d.getMonth()];
                var nmonth = n.setMonth(n.getMonth() - 1, 1);
                N = daysInMonth(months[n.getMonth()],n.getFullYear());
                
                output = (day<10 ? '0' : '') + day + '/' +
                (month<10 ? '0' : '') + month + '/' +
                d.getFullYear();

                console.log('- Ky thanh toan: ' + output);
                console.log('  Tien goc phai tra: ' + commaSeparateNumber(GM) );

                permonth = Math.ceil(permonth);
                permonth = commaSeparateNumber(permonth);
                $total = Math.ceil($total);
                tonglai = tonglai + $total;
                $total = commaSeparateNumber($total);
                console.log('  Tien lai phai tra: ' + $total);
                G = G-GM;
                if(G<0) { G = 0; }
                console.log('  Tien con phai tra: ' + commaSeparateNumber(G) );
                
                $('<tr><td>'+i+'</td><td class="ky-thanh-toan'+i+'">'+output+'</td><td>'+N+'</td><td class="amount-start">'+commaSeparateNumber(G)+'</td><td>'+commaSeparateNumber(GM)+'</td><td>'+$total+'</td><td>'+ permonth +'</td></tr>').appendTo($('.result-body'));
            }

            $('.tong-lai-gop').html(commaSeparateNumber(tonglai));
            $('.tong-goc-lai-gop').html(commaSeparateNumber(tonglai + goc));
        }
});



