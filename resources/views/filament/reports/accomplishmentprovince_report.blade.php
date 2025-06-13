<x-filament-panels::page>
    <h1>{{ request()->year }}</h1>
    <x-filament-panels::form wire:submit.prevent="updateSelectorYear">
        <label for="selectYear">Select Year:</label>
        <select id="selectYear" wire:model="selectedYear" wire:change="updateSelectorYear">
            @foreach (range(date('Y'), 2000) as $year)
                <option value="{{ $year }}" {{ $year == request()->year ? 'selected' : '' }}>{{ $year }}</option>
            @endforeach
        </select>
    </x-filament-panels::form>

    <iframe id="reportFrame" src="{{ route('pdf.accomplishmentprovince.report', ['year' => $selectedYear]) }}" width="100%" height="600"></iframe>
</x-filament-panels::page>
