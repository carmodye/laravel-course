@php
    $currentYear = date('Y');
    $years = range($currentYear, 1990);
@endphp

<select name=year>
    <option value="">Year</option>
      @for ($i = $year; $i >= 1970; $i--)
        <option value="{{ $i }}"
                @selected($attributes->get('value') == $i)>{{ $i }}</option>
    @endfor
</select>
