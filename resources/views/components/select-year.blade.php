@php
    $currentYear = date('Y');
    $years = range($currentYear, 1990);
@endphp

<select name=year>
    <option value="">Year</option>
    @foreach ($years as $year)
        <option value="{{ $year }}">{{ $year }}</option>
    @endforeach
</select>
