@extends('layouts.main')
@section('content')
<style> 
 .table_wrapper{
    display: block;
    overflow-x: auto;
    white-space: nowrap;
}
</style>

<div class="layout-px-spacing">
    <form id="createpayment" class="general_form" method="POST" action="{{url($prefix.'payments')}}" enctype="multipart/form-data">
    @csrf
        <div class="row layout-top-spacing">
        	<div class="col-xl-4 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-two">
                    <div class="widget-heading">
                        <h5 class="">Create Payment</h5>
                    </div>
                    <div class="widget-content">
                        <div class="card-body">
                            <div class="col-md-12 mb-2">
                                <label>From City</label>
                                <input class="form-control" id="from_places" placeholder=""/>
                                <input id="origin" name="origin" required="" type="hidden"/>
                            </div>
                            <div class="col-md-12" id="fo" style="display:none;">

                            </div>
                            <div class="col-md-12 mb-2"><label>Destination: </label>
                                <input class="form-control" id="to_places" placeholder=""/>
                                <input id="destination" name="destination" required="" type="hidden"/>
                            </div>
                            <div class="col-md-12" id="trndest" style="display:none;">

                            </div>
                            <div class="col-md-12 mb-2">
                                <label>Payment Type</label>
                                <select class="form-control" name="payment_type">
                                    <option value="">Select</option>
                                    <option value="1">Advance</option>
                                    <option value="2">Pending</option>
                                    <option value="3">Other Charges</option>
                                </select>
                            </div>
                            
                            <!-- <div class="col-md-12"> -->
                            <div class="mb-2 card-header addtrnplist" id="addtrnp" style="width: 100%;"><h6><i class="fadeIn animated bx bx-car"></i>Add Transporter + </h6></div>
                            <div class="col-md-12 mb-2 trnplist">
                                <label for="exampleFormControlSelect1">Payment To</label>
                                <select class="form-control" name="payment_to">
                                    <option value="">Select</option>
                                    <option value="1">Broker/Owner</option>
                                    <option value="2">Driver</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-2 trnplist">
                                <label>Vehicle Capacity</label>
                                <select class="form-control" name="vehcapacity_id">
                                    <option value="">Select</option>
                                    <?php 
                                    if(count($vehicle_capacity)>0) {
                                        foreach ($vehicle_capacity as $key => $vehicle)
                                        {
                                    ?>
                                        <option value="{{ $key }}">{{ucwords($vehicle->name)}}</option>
                                      <?php 
                                        }
                                    }
                                    ?>                    
                                </select>
                            </div>
                            <!-- </div> -->

                            <div class="mb-2 card-header addvehiclesList" id="invc" style="width: 100%;"><h6> <i class="fadeIn animated bx bx-news"></i> Add Invoice Details + </h6></div>
                            <div class="col-md-12 mb-2 vehiclesList">
                                <label>Purchase Price</label>
                                <input type="number" class="form-control mbCheckNm purchase_price" name="purchase_price" placeholder="">
                            </div>
                            <div class="col-md-12 mb-2 vehiclesList">
                                <label>Advance payment</label>
                                <input type="number" class="form-control mbCheckNm advance_payment" name="advance_payment" placeholder="" disabled>
                            </div>
                            <div class="col-md-12 mb-2 vehiclesList">
                                <label>Pending</label>
                                <input style="color:#3b3f5c;" type="number" class="form-control pending_payment" name="pending_payment" placeholder="" readonly>
                            </div>
                            <div class="col-12 mb-2">
                                <label for="inputAddress2" class="form-label">Number of stops</label>
                                <input type="text" id="numstops" class="form-control mbCheckNm" name="number_stops" maxlength="1">
                            </div>
                            
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary px-5">Save</button>
                            </div>
                		</div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                <div class="widget widget-chart-one" id="map" style="height: 500px; width: 660px;">
                    
                </div>
                <div class="table_wrapper">
                    <table class="stopstable" style="display:none; width:100%;">
                        <thead>
                            <tr>
                                <th>LR Number</th>
                                <th>LR Date</th>
                                <th>Gross Weight</th>
                                <th>Truck Number</th>
                                <th>Invoice Number</th>
                            </tr>
                        </thead>
                        <tbody class="stops-add">
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </form>
</div>

@endsection
@section('js')
<script>
    jQuery("#numstops").keyup(function(){
        $(".stopstable").css("display","block");
        max_fields = $(this).val();

        var rows = '';
        for(i = 1; i <= max_fields; i++) {
            rows+='<tr><td><input type="text" name="lr_number[]" autocomplete="off"></td>';
            rows+='<td><input type="date" name="lr_date[]"></td>';
            rows+='<td><input type="text" name="gross_wt[]"></td>';
            rows+='<td><input type="text" name="truck_number[]"></td>';
            rows+='<td><input type="text" name="invoice_number[]"></td></tr>';
        }
        $('.stopstable').find('tbody').empty();
        $('.stopstable').find('tbody').append(rows);

    });

    jQuery(document).ready(function(){
        $(".vehiclesList").css("display","none");
        $(".trnplist").css("display","none");
    });

    $(".addvehiclesList, .addtrnplist").click(function(){
        $(".vehiclesList").css("display","block");
        $(".trnplist").css("display","none");
    });

    $(".addtrnplist").click(function(){
        $(".trnplist").css("display","block");
        $(".vehiclesList").css("display","none");
    });

    // google map integration code
    $(function () {

        var origin, destination, map, directionsDisplay, directionsService;

        // add input listeners
        google.maps.event.addDomListener(window, 'load', function (listener)
        {
            setDestination();
            initMap();
        });

        // init or load map
        function initMap() {
            var myLatLng = {
                lat: 30.7333,
                lng: 76.7794
            };
            map = new google.maps.Map(document.getElementById('map'), {zoom: 8, center: myLatLng,});
        }

        function setDestination() {
            var from_places = new google.maps.places.Autocomplete(document.getElementById('from_places'));
            var to_places = new google.maps.places.Autocomplete(document.getElementById('to_places'));

            google.maps.event.addListener(from_places, 'place_changed', function ()
            {
                var from_place = from_places.getPlace();
                var from_address = from_place.formatted_address;
                var from_lat = from_place.geometry.location.lat();
                var from_lng = from_place.geometry.location.lng();
                var from_cords = from_lat+','+from_lng;
            // console.log(cords);
                $('#origin').val(from_address);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: 'get-assigned',
                    data:'org='+from_address,
                    beforeSend: function(){
                      
                    },
                    success: function(data){
                        // alert(data);
                        $("#fo").show();
                        $("#fo").html(data.error_msg);
                    }
                });
            });

            google.maps.event.addListener(to_places, 'place_changed', function () {
                var to_place = to_places.getPlace();
                var to_address = to_place.formatted_address;
                var to_lat = to_place.geometry.location.lat();
                var to_lng = to_place.geometry.location.lng();
                var to_cords = to_lat+','+to_lng;
                $('#destination').val(to_address);
                var origin = $('#origin').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: 'get-destination',
                    data:'dest='+to_address,
                    beforeSend: function(){
                     map = new google.maps.Map(document.getElementById('map'), {zoom: 8, center: 'Delhi',});
                    },
                    success: function(data){
                        $("#trndest").show();
                        $("#trndest").html(data);
                        var destination = $('#destination').val();
                        // alert(destination);
                        var travel_mode = "DRIVING";    
                        var directionsDisplay = new google.maps.DirectionsRenderer();
                        var directionsService = new google.maps.DirectionsService();
                        displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay);
                    }
                });

             });

        }

        function displayRoute(travel_mode, origin, destination, directionsService, directionsDisplay) {
            directionsService.route({
                origin: origin,
                destination: destination,
                travelMode: travel_mode,
                avoidTolls: true
            }, function (response, status) {
                if (status === 'OK') {
                    directionsDisplay.setMap(map);
                    directionsDisplay.setDirections(response);
                } else {
                    directionsDisplay.setMap(null);
                    directionsDisplay.setDirections(null);
                    alert('Could not display directions due to: ' + status);
                }
            });
        }
    });

    // get current Position
    function getCurrentPosition() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(setCurrentPosition);
        } else {
            alert("Geolocation is not supported by this browser.")
        }
    }

    function switchText(){
        let obj1 = document.getElementById("from_places");
        let obj2 = document.getElementById("to_places");
        let obj3 = document.getElementById("origin");
        let obj4 = document.getElementById("destination");
        
        let temp = obj1.value;
        obj1.value = obj2.value;
        obj2.value = temp;

        let temphidden = obj3.value;
        obj3.value = obj4.value;
        obj4.value = temphidden;
    }

    // get formatted address based on current position and set it to input
    function setCurrentPosition(pos) {
        var geocoder = new google.maps.Geocoder();
        var latlng = {lat: parseFloat(pos.coords.latitude), lng: parseFloat(pos.coords.longitude)};
        geocoder.geocode({ 'location' :latlng  }, function (responses) {
            console.log(responses);
            if (responses && responses.length > 0) {
                $("#origin").val(responses[1].formatted_address);
                $("#from_places").val(responses[1].formatted_address);
                //    console.log(responses[1].formatted_address);
            } else {
                alert("Cannot determine address at this location.")
            }
        });
    }

    // $(document).ready(function () {
    //     $location_input = $("#location");
    //     autocomplete = new google.maps.places.Autocomplete($location_input.get(0));    
    //     google.maps.event.addListener(autocomplete, 'place_changed', function() {
    //         var data = $("#search_form").serialize();
    //         console.log('blah')
    //         alert(data);
    //         return false;
    //     });
    // });

</script>

@endsection