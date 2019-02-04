@foreach($question["ans"] as $key => $value)
    <p><input type="checkbox" name="{{ $Queskey }}[]" value="{{ $key }}">{{ $value }}</p>
@endforeach