<div wire:poll class="h-100 position-relative w-100">
    <div class="px-4 d-none d-md-block" style="height:10%">
        <div class="d-flex align-items-center">
            <div class="flex-grow-1">
                <input wire:model="search" type="search" class="form-control my-3" placeholder="Search...">
            </div>
        </div>
    </div>
    <div style="overflow-y:auto; position: absolute; height:90%; width: 100%">
        @foreach($chats as $chat)
        <a href="{{route('admin.messages',['id'=>$chat->id])}}" class="list-group-item list-group-item-action border-0">
            <div class="d-flex align-items-start">
                <img src="https://bootdey.com/img/Content/avatar/avatar3.png" class="rounded-circle mr-1" alt="Jennifer Chang" width="40" height="40">
                <div class="flex-grow-1 ml-3">
                    {{$chat->first_name . ' ' . $chat->last_name}}
                </div>
            </div>
        </a>
        @endforeach
    </div>
    <hr class="d-block d-lg-none mt-1 mb-0">
</div>
