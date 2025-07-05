<link rel="stylesheet" href="search-form/css/jquery-ui.css">
<script src="search-form/js/jquery-ui.js"></script>
<script src="search-form/js/search-form.js"></script>
<script src="search-form/js/flight.js"></script>
<script>
    jQuery(function($) {
        $("#datepicker").datepicker({
            minDate: 'D',
            dateFormat: "dd-M-yy",
            numberOfMonths: Resolution(),
            onClose: function(selectedDate) {
                var departureDate = $(this).datepicker('getDate');

                $("#datepicker2").datepicker("option", "minDate", departureDate);

                var returnDate = $("#datepicker2").datepicker('getDate');
                if (returnDate && returnDate < departureDate) {
                    $("#datepicker2").val('');
                }

                if ($('input[name="JType"]:checked').val() === 'roundtrip') {
                    $("#datepicker2").focus();
                }
            }
        });

        // Return date picker
        $("#datepicker2").datepicker({
            minDate: '+1D',
            dateFormat: "dd-M-yy",
            numberOfMonths: Resolution(),
            onClose: function(selectedDate) {
                var departureDate = $("#datepicker").datepicker('getDate');
                var returnDate = $(this).datepicker('getDate');

                if (departureDate && returnDate < departureDate) {
                    alert("Return date must be after departure date");
                    $(this).val('');
                }
            }
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#btm_clk").click(function() {
            $(".psg_dls").toggle(1000);
        });
        $(".btn_done").click(function() {

            var total = all_pesenger();
            $("#btm_clk").val('Passengers ' + total);
            $(".psg_dls").hide(1000);
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#total_hotel_passenger").click(function() {
            $("#psg_dls_hotel").toggle(1000);
        });
        $(".btn_doneH").click(function() {

            var total = all_pesenger();
            $("#btm_clkH").val('Adults/child ' + total);
            $(".psg_dls").hide(1000);
        });
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.number-spinner a', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinner').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 1;
            }
        }
        btn.closest('.number-spinner').find('input').val(newVal);
    });

    $(document).on('click', '.number-spinnerinf a', function() {
        var btn = $(this),
            oldValue = btn.closest('.number-spinnerinf').find('input').val().trim(),
            newVal = 0;

        if (btn.attr('data-dir') == 'up') {
            newVal = parseInt(oldValue) + 1;
        } else {
            if (oldValue > 1) {
                newVal = parseInt(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        btn.closest('.number-spinnerinf').find('input').val(newVal);
    });
</script>
<script type="text/javascript">
    function show_date(data) {

        if (data == 'oneway') {
            document.getElementById("datepicker2").disabled = true;
            var a = document.getElementById("datepicker2");
            document.getElementById("datepicker2").removeAttribute("required");
            document.getElementById("datepicker2").value = '';
            a.removeAttribute("required");
        } else if (data == 'roundtrip') {
            document.getElementById("datepicker2").disabled = false;
            var b = document.getElementById("datepicker2");
            b.setAttribute("required", true);
        }

    }
</script>
<script>
    function close_btn(id) {
        var array = id.split("_");
        var content = array[0];
        document.getElementById(content).value = '';
        document.getElementById(id).style.display = 'none';
        var label_id = content + '_label';
        if (content == 'location') {
            $('#' + label_id).php('City Name');
            $("#location").attr("placeholder", "Airport");

        } else if (content == 'location2') {
            $('#' + label_id).php('City Name');
            $("#location2").attr("placeholder", "Airport");
        }

    }
</script>
<script>
    function add_rt_passenger() {
        var infow = $("#InfantsRT").val();
        var childow = $("#ChildrenRT").val();
        var adultow = $("#AdultsRT").val();
        var total = +infow + +childow + +adultow;
        return total;
    }

    function all_pesenger() {

        var infow = $("#InfantsRT").val();
        var childow = $("#ChildrenRT").val();
        var adultow = $("#AdultsRT").val();
        var total = +infow + +childow + +adultow;
        return total;
    }

    function increase_adult_rt() {
        var adult_pass = add_rt_passenger();
        var adult_rt = document.getElementById("AdultsRT").value;
        if (adult_pass < 9) {

            var k = parseInt(adult_rt) + 1;
            document.getElementById("AdultsRT").value = adult_rt++;
        }

    }

    function Seprease_adult_rt() {
        var adult_rt = document.getElementById("AdultsRT").value;
        var InfantsRT = document.getElementById("InfantsRT").value;
        if (adult_rt != '1') {
            var k = parseInt(adult_rt) - 1;
            document.getElementById("AdultsRT").value = adult_rt--;

            if (InfantsRT >= adult_rt) {
                var k = parseInt(InfantsRT) - 1;
                document.getElementById("InfantsRT").value = InfantsRT--;
            }

        }
    }

    function increase_child_rt() {
        var adult_pass = add_rt_passenger();
        var adult_rt = document.getElementById("ChildrenRT").value;
        if (adult_pass < 9) {

            var k = parseInt(adult_rt) + 1;
            document.getElementById("ChildrenRT").value = adult_rt++;
        }

    }

    function Seprease_child_rt() {
        var adult_rt = document.getElementById("ChildrenRT").value;
        if (adult_rt != '0') {
            var k = parseInt(adult_rt) - 1;
            document.getElementById("ChildrenRT").value = adult_rt--;
        }
    }

    function increase_infant_rt() {

        var total_pass = add_rt_passenger();

        var adult_rt = document.getElementById("AdultsRT").value;
        var InfantsRT = document.getElementById("InfantsRT").value;

        if (total_pass < 9 && InfantsRT < adult_rt) {
            var k = parseInt(InfantsRT) + 1;
            document.getElementById("InfantsRT").value = InfantsRT--;
        }

    }

    function Seprease_infant_rt() {
        var InfantsRT = document.getElementById("InfantsRT").value;
        if (InfantsRT != '0') {
            var k = InfantsRT--;
            $("#InfantsRT").val(k);
            if (InfantsRT == 0) {
                $("#InfantsRT").val(0);
                // document.getElementById("InfantsRT").value = '0';
            }
        }

    }

    function Resolution() {
        if (window.innerWidth < 780) {
            return 1;
        } else {
            return 2;
        }
    }
</script>