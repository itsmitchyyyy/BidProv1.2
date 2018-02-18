@extends('layouts.seekerapp')
@push('css')
    <style>
        #board {
            display: table;
            margin: 0;
            padding: 0;
            border-spacing: 5px;
        }
        .section {
            display: table-cell;
            margin: 0;
            border: 1px solid #666;
            padding: 5px;
            width: 500px;
        }
        .section.droppable {
            border: 1px dashed #666;
        }
        .section > h1 {
            margin: 0;
            border-bottom: 1px solid #999;
            padding: 0;
            font-size: 12pt;
            text-align: center;
        }
        .card-kanban {
            display: inline-block;
            vertical-align: top;
            margin: 10px 5px;
            padding: 10px;
            width: 100px;
            height: 100px;
            color: black;
            background: #ff8;
            cursor: move;
            text-align: center;
            font-family: "Helvetica Neue", Helvetica, Arial, "Lucida Grande", sans-serif;
            box-shadow: 2px 2px 2px #eee;
        }
        .wrap-word{
            max-width:40em;
            word-wrap:break-word;
        }
        .card-block{
            border:1px solid rgba(0,0,0,.15);
        }
        .gap-right{
            margin-right:10px;
        }
        .gap-left{
            margin-left:10px;
        }
        
    </style>
@endpush
@section('content')
@inject('modules','App\Http\Controllers\ModuleController')
@inject('users','App\Http\Controllers\RatingController')
<div class="container-fluid">
    @if($errors->has('progress-comment'))
        <div class="alert alert-danger alert-dismissable fade show" role="alert">
            <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
            {{ $errors->first('progress-comment') }}
        </div>
    @endif
    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissable fade show" role="alert">
            <button type="button" data-dismiss="alert" class="close"><span>&times;</span></button>
            {{ session()->get('success') }}
        </div>
    @endif
   <h3><b>{{ ucfirst($project->title) }}</b></h3>
    <div class="card-mt-15">
        <div class="card-block">
            <small><b>Project ID: {{ $project->id }}</b></small>
            <small class="pull-right">{{ Carbon\Carbon::parse($proposal->created_at)->diffForHumans() }}</small>
            <p class="card-text">Development Type {{ $project->category }}</p>
            @if($project->category == 'Mobile')
            <p class="card-text">Runs On {{ $project->type }}
            @else
            @if($project->category == 'Web')
           <br>Operating System {{ $project->os }}</p>
            @else
            @if($project->category == 'MobileWeb')
            <p class="card-text">Runs On {{ $project->type }}
            <br>Operating System {{ $project->os }}</p>
            @endif
            @endif
            @endif
           
           
            <h4 class="card-title"><b>Project Description</b></h4>
            <p class="card-text wrap-word">{{ $project->details }}</p>
            
        </div>
    </div>
    
    <div class="card">
        <div class="card-block">
            <div class="row">
                <div class="col-md-3 col-xs-6 b-r"><strong>Project Name</strong>
                <br><p class="text-muted">{{ ucfirst($project->title) }}</p>
                </div>
                <div class="col-md-3 col-xs-6 b-r"><strong>Developer</strong>
                <br><p class="text-muted">{{ $proposal->firstname }} {{ $proposal->lastname }}</p>
                </div>
                <div class="col-md-3 col-xs-6 b-r"><strong>Bid</strong>
                <br><p class="text-muted"><span>&#8369;</span> {{ $proposal->price }} in {{ $proposal->daysTodo }} days</p>
                </div>
            </div>
        </div>
    </div>
    <h2 class="m-t-15">PROJECT PROGRESS</h2>
    <div id="board" class="board w-100">
        <div id="todo" class="section">
            <h1>To Do</h1>
            @foreach($todo as $todos)
            <div id="c2" onclick="toggleModal(this,{{ $todos->module_id }})" data-mode="{{ $todos->module_id }}" data-tooltip="true" title="Click to view" data-proposal="{{ $todos->proposal_id }}" data-project="{{ $todos->project_id }}" data-name="{{ $todos->module_name }}" class="card-kanban">
            {{ $todos->module_name }}
            <h5>{{ $todos->percentDone}}% Complete</h5>
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-animated h-100" role="progressbar" aria-valuenow="{{ $todos->percentDone }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $todos->percentDone}}%"><span class="sr-only">{{ $todos->percentDone}}% Complete</span></div>
            </div>
            </div>
            <!-- <div id="c3" class="card"><em>Retire!</em></div> -->
            @endforeach
        </div>
        <div id="doing" class="section">
            <h1>Doing</h1>
            @foreach($doing as $doings)
            <div id="c1"  onclick="toggleModal(this,{{ $doings->module_id }})" data-mode="{{ $doings->module_id }}" data-status="{{ $doings->module_status }}" data-module="{{ $doings->id }}" data-tooltip="true" title="Click to view" data-proposal="{{ $doings->proposal_id }}" data-project="{{ $doings->project_id }}" data-name="{{ $doings->module_name }}" class="card-kanban">
            {{ $doings->module_name }}
            <h5>{{ $doings->percentDone}}% Complete</h5>
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-animated h-100" role="progressbar" aria-valuenow="{{ $doings->percentDone }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $doings->percentDone}}%"><span class="sr-only">{{ $doings->percentDone}}% Complete</span></div>
            </div>
           </div>
            @endforeach
        </div>
        <div id="done" class="section">
            <h1>Done</h1>
            @foreach($done as $dones)
            <div id="c3"  onclick="toggleModal(this,{{ $dones->module_id }})" data-mode="{{ $dones->module_id }}" data-status="{{ $dones->module_status }}"  data-module="{{ $dones->id }}" data-tooltip="true" title="Click to view" data-proposal="{{ $dones->proposal_id }}" data-project="{{ $dones->project_id }}" data-name="{{ $dones->module_name }}" class="card-kanban">
            {{ $dones->module_name }}
            <h5>{{ $dones->percentDone}}% Complete</h5>
            <div class="progress">
                <div class="progress-bar progress-bar-success progress-bar-animated h-100" role="progressbar" aria-valuenow="{{ $dones->percentDone }}" aria-valuemin="0" aria-valuemax="100" style="width:{{ $dones->percentDone}}%"><span class="sr-only">{{ $dones->percentDone}}% Complete</span></div>
            </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="p-1 pull-right">
   <!--  <form action="{{ route('payment', ['id' => $project->id, 'bid_id' => $project->bid_id, 'project_name' => $project->title, 'user_paypal' => $project->paypal]) }}" method="POST">
            <button class="btn btn-info wew">Pay Now</button>
        </form> -->
    </div>
    <div class="modal fade" id="toggleModal">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button class="close" type="button" data-dismiss="modal"><span>&times;</span></button>
                    <h3>View Module</h3>
                </div>
                <div class="modal-body">
                    <div id="options"></div>
                    <div id="data"></div>
                    <a href="#" id="collapseComment" data-toggle="collapse" data-target="#comment_section">
                        Show comments
                    </a>
                    <div id="comment_section"  class="clearfix collapse"></div>
                    <a href="#" id="addComment" class="pull-right">Add comment</a>
                    <div class="form-group" id="commentDiv">
                    <form method="post" action="{{ route('postComment') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="comment_proposal" id="comment_proposal" value="">
                        <input type="hidden" name="comment_project" id="comment_project" value="">
                        <input type="hidden" name="comment_module" id="comment_module" value="">
                    <textarea name="progress_comment" id="progress-comment" class="form-control progress-comment" style="height:auto;border:1px solid rgba(0,0,0,.25)" cols="4" rows="4" placeholder="Write a comment"></textarea>
                    <button type="submit" class="btn btn-info wew pull-right m-t-10">Add Comment</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('js/momment.js') }}"></script>
<script>
        $('#commentDiv').hide();
        $('#addComment').click(function(){
            $('#commentDiv').show();
           
        });
        $('#toggleModal').on('hidden.bs.modal', function(){
            $('.progress-comment').val('');
            $('#commentDiv').hide();   
            $('#comment_section').html('');
        });
</script>
<script>
function toggleComment(id){
    

        $.ajax({
        type: "get",
        url: "{{ route('viewComments', ['module_id']) }}",
        data: {module_id: id},
        dataType: "json",
        cache:false,
        success: function(data){
            var comments = '';
           
            for(var i = 0; i < data.length; i++){
                console.log(data[i].comment_date)
                if(data[i].role_type == 'seeker'){
                         comments += 
               `
               <img src="/`+data[i].avatar+`" alt="avatar" class="img-thumbnail pull-left gap-right" style="with:60px;height:60px">
               <div class="b-all">
                    <a href="">`+data[i].firstname.charAt(0).toUpperCase() + data[i].firstname.slice(1)+' '+data[i].lastname.charAt(0).toUpperCase() + data[i].lastname.slice(1)+`</a>
                        <p style="font-size:14px" class="word-wrap">`+data[i].message+`
                            <br>
                                <small>`+moment(data[i].comment_date, moment.ISO_8601).fromNow()+`</small>
                        </p>
                </div><br>
               `;   
                }
                else if(data[i].role_type == 'bidder'){
                    comments += 
                    `
                    <img src="/`+data[i].avatar+`" alt="avatar" class="img-thumbnail pull-right gap-left" style="with:60px;height:60px">
                    <div class="b-all text-right" >
                            <a href="" class="">`+data[i].firstname.charAt(0).toUpperCase() + data[i].firstname.slice(1)+' '+data[i].lastname.charAt(0).toUpperCase() + data[i].lastname.slice(1)+`</a>
                            <p style="font-size:14px" class="word-wrap">`+data[i].message+`
                                <br>
                                <small>`+moment(data[i].comment_date, moment.ISO_8601).fromNow()+`</small>
                            </p>
                        </div>
                    `;
                }
            }
            $('#comment_section').html(comments);
        }
    });
}

</script>

<script>
    function toggleModal(event,id,dataname){
      $(function(){
        var dataID = $(event).data('mode'); 
        var dataStatus = $(event).data('status');
        var tableName = $(event).data('name');
        var projectComment = $(event).data('project');
        var proposalComment = $(event).data('proposal');
        $.ajax({
            type: "get",
            url: "{{ route('viewModule',['module_id']) }}",
            data: {module_id: id},
            dataType: 'json',
            cache:false,
            success: function(response){
                 var myData = `<table class="table table-bordered table-striped" width="100%"><h2>Module Title: `+tableName+`</h2><tr><th>Description</th><th>Status</th></tr>`;
                 for(var i = 0; i < response.length; i++ ){
                $.each(response[i], function(key,value){
                    if(key == 'description' ){
                    myData += '<tr><td>'+ value +'</td>';
                }
                if(key == 'status' ){
                    myData += `<td>
                       `+value+`
                    </td></tr>`;
                }
                });
                 }
                 myData += '</table>';
                 if(dataStatus == 'done'){
                         options = `
                         <form action="{{ route('downloadFiles') }}" method="post">
                         {{ csrf_field() }}
                         <input type="hidden" value="`+dataID+`" name="module_id">
                         <button class="btn btn-info wew">Download Files</button>
                         </form>`;
                     }
                $('#options').html(options);
                $('#data').html(myData);
                $('#comment_module').val(id);
                $('#comment_project').val(projectComment);
                $('#comment_proposal').val(proposalComment);
                $('#toggleModal').modal('show');
                // console.log(id);
                // response = '';
                toggleComment(id);
            }
        });
    });
    }
</script>
<script>
    $("#collapseComment[data-toggle='collapse']").click(function(){
        if($(this).text() == 'Hide comments'){
            $(this).text('Show comments');
        }else{
            $(this).text('Hide comments');
        }
    });
</script>
<!-- <script>
        var cards = document.querySelectorAll('.card');
        for (var i = 0, n = cards.length; i < n; i++) {
            var card = cards[i];
            card.draggable = true;
        };
        var board = document.getElementById('board');
        var hideMe;
        board.onselectstart = function(e) {
            e.preventDefault();
        }
        board.ondragstart = function(e) {
            console.log('dragstart');
            hideMe = e.target;
            e.dataTransfer.setData('card', e.target.id);
            e.dataTransfer.effectAllowed = 'move';
        };
        board.ondragend = function(e) {
            e.target.style.visibility = 'visible';
        };
        var lastEneterd;
        board.ondragenter = function(e) {
            console.log('dragenter');
            if (hideMe) {
                hideMe.style.visibility = 'hidden';
                hideMe = null;
            }
            // Save this to check in dragleave.
            lastEntered = e.target;
            var section = closestWithClass(e.target, 'section');
            // TODO: Check that it's not the original section.
            if (section) {
                section.classList.add('droppable');
                e.preventDefault(); // Not sure if these needs to be here. Maybe for IE?
                return false;
            }
        };
        board.ondragover = function(e) {
            // TODO: Check data type.
            // TODO: Check that it's not the original section.
            if (closestWithClass(e.target, 'section')) {
                e.preventDefault();
            }
        };
        board.ondragleave = function(e) {
            // FF is raising this event on text nodes so only check elements.
            if (e.target.nodeType === 1) {
                // dragleave for outer elements can trigger after dragenter for inner elements
                // so make sure we're really leaving by checking what we just entered.
                // relatedTarget is missing in WebKit: https://bugs.webkit.org/show_bug.cgi?id=66547
                var section = closestWithClass(e.target, 'section');
                if (section && !section.contains(lastEntered)) {
                    section.classList.remove('droppable');
                }
            }
            lastEntered = null; // No need to keep this around.
        };
        board.ondrop = function(e) {
            var section = closestWithClass(e.target, 'section');
            var id = e.dataTransfer.getData('card');
            if (id) {
                var card = document.getElementById(id);
                // Might be a card from another window.
                if (card) {
                    if (section !== card.parentNode) {
                        // section.appendChild(card);
                        console.log(section.id);
                        if(section.id == 'done'){
                          alert(section.id);
                          section.appendChild(card);
                        }
                        if(section.id == 'doing'){
                          alert(section.id);
                          section.appendChild(card);
                        }
                        if(section.id == 'todo'){
                          alert(section.id);
                          section.appendChild(card);
                        }
                    }
                } else {
                    alert('couldn\'t find card #' + id);
                }
            }
            section.classList.remove('droppable');
            e.preventDefault();
        };
        function closestWithClass(target, className) {
            while (target) {
                if (target.nodeType === 1 &&
                    target.classList.contains(className)) {
                    return target;
                }
                target = target.parentNode;
            }
            return null;
        }
    </script> -->
@endpush