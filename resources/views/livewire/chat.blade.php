<div wire:poll>
     <div class="chat">
    <div class="chat-header clearfix">
        <div class="row">
            <div class="col-lg-6">
                <a href="javascript:void(0);" data-toggle="modal" data-target="#view_info">
                    <img src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="avatar">
                </a>

            </div>
        </div>
    </div>
    <div class="chat-history">
        <ul class="m-b-0">
            @forelse($message as $m)
            @if($m->user_id==1)
            
            <li class="clearfix">
                <div class="message-data text-right ">
                    <span class="message-data-time ">{{$m->created_at}}</span>
                </div>
                <div class="message other-message float-right"> {{$m->content}} </div>

            </li>
            @else
            <li class="clearfix">
                <div class="message-data">
                    <span class="message-data-time">{{$m->created_at}}</span>
                </div>
                <div class="message my-message">{{$m->content}}</div>
            </li> @endif
            @empty
            @endforelse
        </ul>

    </div>

    <div class="chat-message clearfix">
        <form wire:submit.prevent='m'>
            <div class="input-group mb-0">
            <input type="text" class="form-control" placeholder="Enter text here..." name='content' wire:model.defer='mess'>
            <div class="input-group-prepend">
                <button class='btn btn-outline-primary' type='submit'>send</button></div>
            </div>
        </form>
    </div>
</div>
</div>

