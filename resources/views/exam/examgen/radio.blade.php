@foreach($question["ans"] as $key => $value)
    <p><input type="radio" name="{{ $Queskey }}[]" value="{{ $key }}">{{ $value }}</p>
@endforeach