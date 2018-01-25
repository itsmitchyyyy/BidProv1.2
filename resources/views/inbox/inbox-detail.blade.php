@extends('layouts.bidderapp')
@section('content')
<div class="container-fluid m-t-15">
<div class="row">
                    <!-- Left sidebar -->
                    <div class="col-md-12">
                        <div class="white-box">
                            <div class="row">
                                <div class="col-lg-2 col-md-3  col-sm-4 col-xs-12 inbox-panel">
                                    <div> <a href="#" class="btn btn-custom btn-block waves-effect waves-light">Compose</a>
                                        <div class="list-group mail-list m-t-20"> <a href="inbox.html" class="list-group-item active">Inbox <span class="label label-rouded label-success pull-right">5</span></a> <a href="#" class="list-group-item ">Starred</a> <a href="#" class="list-group-item">Draft <span class="label label-rouded label-warning pull-right">15</span></a> <a href="#" class="list-group-item">Sent Mail</a> <a href="#" class="list-group-item">Trash <span class="label label-rouded label-default pull-right">55</span></a> </div>
                                        <hr class="m-t-5">
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-9 col-sm-8 col-xs-12 mail_listing">
                                    <div class="media m-b-30 p-t-20">
                                        <h4 class="font-bold m-t-0">Your message title goes here</h4>
                                        <hr>
                                        <a class="pull-left" href="#"> <img class="media-object thumb-sm img-circle" src="../plugins/images/users/pawandeep.jpg" alt=""> </a>
                                        <div class="media-body"> <span class="media-meta pull-right">07:23 AM</span>
                                            <h4 class="text-danger m-0">Pavan kumar</h4>
                                            <small class="text-muted">From: jonathan@domain.com</small> </div>
                                    </div>
                                    <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                                    <p>enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar,</p>
                                    <hr>
                                    <h4> <i class="fa fa-paperclip m-r-10 m-b-10"></i> Attachments <span>(3)</span> </h4>
                                    <div class="row">
                                        <div class="col-sm-2 col-xs-4">
                                            <a href="#"> <img class="img-thumbnail img-responsive" alt="attachment" src="../plugins/images/img1.jpg"> </a>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <a href="#"> <img class="img-thumbnail img-responsive" alt="attachment" src="../plugins/images/img2.jpg"> </a>
                                        </div>
                                        <div class="col-sm-2 col-xs-4">
                                            <a href="#"> <img class="img-thumbnail img-responsive" alt="attachment" src="../plugins/images/img3.jpg"> </a>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="b-all p-20">
                                        <p id="ptag" class="p-b-20">click here to <a href="#" id="reply">Reply</a> or <a href="#">Forward</a></p>
                                        <textarea name="textqw" id="textqw" class="hidden" cols="30" rows="10"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
@endsection
@section('scripts')

<script>
$('html').click(function(e){
    if(e.target.id == 'reply'){
        $('#textqw').removeClass("hidden").addClass("show");
        $('#ptag').addClass("hidden");
        $('#textqw').focus();
        e.preventDefault();
    }else{
        $('#textqw').removeClass("show").addClass("hidden");
        $('#ptag').removeClass("hidden").addClass("show");
        e.preventDefault();
    }
});
</script>
@endsection