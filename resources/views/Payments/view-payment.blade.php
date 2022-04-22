@extends('layouts.main')
@section('content')

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
            <div class="widget-content widget-content-area br-6">
                <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
                    <div class="breadcrumb-title pe-3"><h5>Payment Details</h5></div>
                </div>
                
                <div class="col-lg-12 col-12 layout-spacing">
                    <div class="statbox widget box box-shadow">
                        <div class="widget-content widget-content-area">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <th scope="row">From City</th>
                                        <td>{{isset($getpayment->origin)?ucfirst($getpayment->origin):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Destination City</th>
                                        <td>{{isset($getpayment->destination)?ucfirst($getpayment->destination):'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payment Type</th>
                                        <td>
                                            <?php if($getpayment->payment_type == 1){
                                                echo "Advance";
                                            }else if($getpayment->payment_type == 2){
                                                echo "Pending";
                                            }else if($getpayment->payment_type == 3){
                                                echo "Other Charges";
                                            } else{ ?>
                                                 {{$getpayment->payment_type ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payment To</th>
                                        <td>
                                            <?php if($getpayment->payment_to == 1){
                                                echo "Broker/Owner";
                                            }else if($getpayment->payment_to == 2){
                                                echo "Driver";
                                            }else{ ?>
                                                 {{$getpayment->payment_to ?? "-"}}
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <?php if($getpayment->payment_to == 1){?>
                                        <th scope="row">Broker</th>
                                        <td>
                                        {{isset($getpayment->GetBroker->name) ? ucfirst($getpayment->GetBroker->name) : "-" }}
                                        </td>
                                        <?php }else if($getpayment->payment_to == 2){ ?>
                                        <th scope="row">Driver</th>
                                        <td>
                                        {{isset($getpayment->GetDriver->name) ? ucfirst($getpayment->GetDriver->name) : "-" }}
                                        </td>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <th scope="row">Vehicle Capacity</th>
                                        <td>
                                            {{isset($getpayment->GetVehicle->name) ? ucfirst($getpayment->GetVehicle->name) : "-" }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Number of stops</th>
                                        <td>{{isset($getpayment->number_stops)? $getpayment->number_stops:'-'}} </td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Purchase Price</th>
                                        <td>{{isset($getpayment->purchase_price)? $getpayment->purchase_price:'-'}} </td>
                                    </tr>
                                        
                                </tbody>
                            </table>
                            <div class="row mt-2">
                                <div class="col-md-5 col-sm">
                                    <p><b>Payment Details</b></p>
                                </div>
                                <div class="col-md-7 col-sm pl-2 ">
                                    <!-- <div class="btn-section px-0 text-right">
                                        <a class="btn-primary btn-cstm btn addpendingpayament" data-id="{{ $getpayment->id }}" data-purchaseprice="{{ $getpayment->purchase_price }}" data-pendingprice="{{ $paymentdetail['pending_payment'] }}" id="add_payment" data-toggle="modal" data-target="#createpayment" data-action = "<?php echo URL::to($prefix.'payments/get-addpayment'); ?>" href="javascript:void(0)"><span><i class="fa fa-plus"></i> Add Payment</span></a>
                                    </div> -->
                                    <table>
                                        <tr>
                                            <th>Advance Payment</th>
                                            <th>Pending Payment</th>
                                        </tr>
                                        @if ($getpayment->PaymentHistory->count())
                                        @foreach($getpayment->PaymentHistory as $value)
                                        <tr class="mr-3">
                                            <td>{{$value->advance_payment}}</td>
                                            <td>{{$value->pending_payment}}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        -
                                        @endif
                                    </table>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-12 col-sm">
                                    <p><b>Stop Details</b></p>
                                </div>
                                <div class="col-md-12 col-sm pl-2 ">
                                    <table>
                                        <tr>
                                            <th style="text-align: center;">LR Number</th>
                                            <th style="text-align: center;">LR Date</th>
                                            <th style="text-align: center;">Gross Weight</th>
                                            <th style="text-align: center;">Truck Number</th>
                                            <th style="text-align: center;">Invoice Number</th>
                                        </tr>
                                        @if ($getpayment->StopHistory->count())
                                        @foreach($getpayment->StopHistory as $value)
                                        <tr class="mr-3">
                                            <td style="text-align: center;">{{$value->lr_number}}</td>
                                            <td style="text-align: center;">{{$value->lr_date}}</td>
                                            <td style="text-align: center;">{{$value->gross_wt}}</td>
                                            <td style="text-align: center;">{{$value->truck_number}}</td>
                                            <td style="text-align: center;">{{$value->invoice_number}}</td>
                                        </tr>
                                        @endforeach
                                        @else
                                        -
                                        @endif
                                    </table>
                                </div>
                            </div>  
                            <a class="btn btn-primary" href="{{ route('payments.index') }}"> Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('models.creatependingpayment')
@endsection
@section('js')
<script type="text/javascript">
    // create payment page get pending payment
    $(".purchase_price, .advance_payment").keyup(function(){
        var purprice = $('.purchase_price').val();
        var advprice = $('.advance_payment').val();
        var pending  = purprice-advprice;
        $('.pending_payment').val(pending);
    });

    $(".purchase_price").keyup(function(){
        pur = $(this).val();
        if(pur>0){
            $('.advance_payment').attr("disabled", false);
        }else{
            $('.advance_payment').val('');
            $('.advance_payment').attr("disabled", true);
        }
    });

    $(".advance_payment").keyup(function(){
        adv =$(this).val();
        pend = $('.pending_payment').val();
        if ((parseInt(adv) > parseInt(pur))||(parseInt(pend)<0)) {
            $('.advance_payment').val('');
        }
    }); 

</script>
@endsection