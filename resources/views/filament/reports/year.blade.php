<select name="filter_year">
    @foreach($years as $year)
        <option value="{{ $year }}">{{ $year }}</option>
    @endforeach
</select>
