$(document).ready(function() {
    $('.btn-plus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = $parentNode.find('#price').text().replace('kyats', '') * 1;
        $qty = $parentNode.find('#qty').val() * 1;
        $total = $price * $qty;
        $total = $parentNode.find('#total').html($total + ' kyats');

        summaryCalculation();
    })

    $('.btn-minus').click(function() {
        $parentNode = $(this).parents('tr');
        $price = $parentNode.find('#price').text().replace('kyats', '') * 1;
        $qty = $parentNode.find('#qty').val() * 1;
        $total = $price * $qty;
        $total = $parentNode.find('#total').html($total + ' kyats');

        summaryCalculation();
    })

    // $('.btnRemove').click(function() {
    //     $parentNode = $(this).parents('tr');
    //     $parentNode.remove();
    //     summaryCalculation();
    // })

    function summaryCalculation() {
        //total price summary
        $totalPrice = 0;
        $('#dataTable tbody tr').each(function(index, row) {
            $totalPrice += $(row).find('#total').text().replace('kyats', '') * 1
            $('#subTotalPrice').html(`${$totalPrice} kyats`)
            $('#finalPrice').html(`${$totalPrice+3000}kyats`)
        })
    }
})