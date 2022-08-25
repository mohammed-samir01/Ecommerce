<div wire:poll>
  @foreach($last_message as $message)
  @if(count($message)){
  <small>no messages</small>
  @else
  <small>{{$message->content}}</small>
  @endif
  @endforeach
</div>
