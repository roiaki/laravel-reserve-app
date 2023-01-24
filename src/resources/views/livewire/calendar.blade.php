<div>
  カレンダー
    <input id="calendar" 
    class="block mt-1 w-full" 
    type="text" 
    name="calendar" 
    value="{{ $currentDate }}" 
    wire:change="getDate($event.target.value)"/>
  {{ $currentDate }}<br>

  @foreach($events as $event)
    {{ $event->start_date }}<br>
  @endforeach
  
</div>