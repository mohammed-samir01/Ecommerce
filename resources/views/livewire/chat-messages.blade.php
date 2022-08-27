<div wire:poll.10ms class="position-relative">
    <div class="py-2 px-4 border-bottom d-none d-lg-block">

        <div class="d-flex align-items-center py-1">
            <div class="position-relative">
                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
            </div>
            @foreach($user_info as $user)

            <div class="flex-grow-1 pl-3">
                <strong>{{$user->first_name}}</strong>
                <div class="text-muted small"><em>chating with...</em></div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="position-relative" style="height: 80%">
        <div class="chat-messages p-4" style="height:100%;" id="toscroll">
            @foreach($messages as $m)
            @if($m->user_id==1)
            <div class="chat-message-right mb-4">
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 mr-3">
                    {{$m->content}}
                    <div class="text-muted small text-nowrap mt-2">{{$m->created_at->diffForHumans(null,false,false)}}</div>
                </div>
            </div>
            @else
            <div class="chat-message-left pb-4">
                <div>
                    <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                    <div class="font-weight-bold mb-1">
                        @foreach($user_info as $user){{$user->first_name}}@endforeach</div>
                </div>
                <div class="flex-shrink-1 bg-light rounded py-2 px-3 ml-3">

                    {{$m->content}}
                    <div class="text-muted small text-nowrap mt-2">{{$m->created_at->diffForHumans(null,false,false)}}</div>

                </div>
            </div>
            @endif
            @endforeach
            </div>
    </div>

    <div class="flex-grow-0 py-3 px-4 border-top">
        <form wire:submit.prevent='sendmessage'>
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Type your message" name='content' wire:model.defer='mess'>
                <button class="btn btn-primary" type='submit'>Send</button>
            </div>
        </form>
    </div>
</div>
