/* global $ */

$(function() {


    //var prevEle;//This is used to track the previous element when dealing with changes
    var subTotalData = 0;
    var shippingTotal = 0;


    init_page();



    $("#shippingType").change(function(e) {
        calcShipping();
        calcTotal();
    });

    $("#viewCartItemList").change(function(e) {
        var target = $(e.target);


        if (target.is("select") || (target.is("input") && target.attr("type") == "number")) {
            var pId = e.target.id.split("|")[1];
            var parentEle = $(target).closest(".content");


            //error checking for quantity
            if ((target.is("input") && target.attr("type") == "number")) {
                if (target.val() < 1) {
                    target.val(1);
                }
            }


            calcBaseTotal(pId);
            calcSubTotal();
            calcShipping();
            calcTotal();

        }



    });


/**
 * Initialize the page and its components
 * 
 */
    function init_page() {
        $.each($("#viewCartItemList .item"), function(i, item) {
            var pId = item.id.split("|")[1];
            calcBaseTotal(pId);
        })
        calcSubTotal();
        calcShipping();
        calcTotal();
    }


/**
 * Calculate the base total for each painting
 * 
 * @return number base cost of a painting
 */
    function calcBaseTotal(pId) {
        var frameCost = parseFloat(document.getElementById('frameID|' + pId).value.split(":")[1]);
        var mattCost = parseFloat(document.getElementById('mattID|' + pId).value.split(":")[1]);
        var glassCost = parseFloat(document.getElementById('glassID|' + pId).value.split(":")[1]);
        var msrp = parseFloat(document.getElementById('msrp|' + pId).textContent);
        var quantity = parseFloat(document.getElementById('quantity|' + pId).value);
        var baseCost = quantity * (msrp + glassCost + mattCost + frameCost);
        var baseCostDataEle = document.getElementById("costData|" + pId);
        var baseCostEle = document.getElementById("cost|" + pId);

        baseCostEle.textContent =  commaSeparateNumber(baseCost.toFixed(2));
        baseCostDataEle.textContent = baseCost;

        return baseCost;
    }


    /**
     * Calculate the sub total
     */
    function calcSubTotal() {

        var items = $("#viewCartItemList .item");
        var subTotal = 0;
        $.each(items, function(i, item) {
            var pId = item.id.split("|")[1];
            var baseCostDataEle = parseFloat(document.getElementById("costData|" + pId).textContent);
            subTotal += baseCostDataEle;

        });

        subTotalData = subTotal;
        $("#subTotalValue").text(commaSeparateNumber(subTotal.toFixed(2)));

    }


    /**
     * calculate the shipping cost
     * 
     */
    function calcShipping() {
        var shippingEle = $("#shippingValue");
        var shippingType = $("#shippingType").val();
        shippingTotal = 0;




        if ((subTotalData < 2500)) {
            if (subTotalData < 1500 && !isShippingExpress()) {
                //caculate standard shipping
                $.each($("#viewCartItemList .item"), function(i, item) {
                    //unable to use jquery find as it doesn't like | inside the id
                    var pId = item.id.split("|")[1];
                    var cost = parseFloat(document.getElementById("cost|" + pId).textContent);
                    var quantity = parseFloat(document.getElementById("quantity|" + pId).value);

                    shippingTotal += 25 * quantity;

                });

            }
            else {
                if (isShippingExpress()) {


                    //caculate standard shipping
                    $.each($("#viewCartItemList .item"), function(i, item) {
                        //unable to use jquery find as it doesn't like | inside the id
                        var pId = item.id.split("|")[1];
                        var cost = parseFloat(document.getElementById("cost|" + pId).textContent);
                        var quantity = parseFloat(document.getElementById("quantity|" + pId).value);
                        shippingTotal += 50 * quantity;

                    });

                }
            }



        }


        $("#shippingValue").text(shippingTotal);

        /**
         * Check if express shipping is selected
         */
        function isShippingExpress() {
            var result = false;
            if (shippingType == "express")
                result = true;

            return result;
        }

    }


    /**
     * Calculate the total of the cart
     */
    function calcTotal() {
        var total = $("#totalValue");
        total.text(commaSeparateNumber((subTotalData + shippingTotal).toFixed(2)))
    }






    /**
     * Given a number will format it using commas to seperate the number in throusands, millions, and so on
     * 
     * @val NUMBER to seperate with comma
     */
    function commaSeparateNumber(val) {
        while (/(\d+)(\d{3})/.test(val.toString())) {
            val = val.toString().replace(/(\d+)(\d{3})/, '$1' + ',' + '$2');
        }
        return val;
    }

});
