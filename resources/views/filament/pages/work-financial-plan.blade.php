<x-filament-panels::page
    @class([
        'fi-resource-create-record-page',
        'fi-resource-' . str_replace('/', '-', $this->getResource()::getSlug()),
    ])
>
    <x-filament-panels::form
        :wire:key="$this->getId() . '.forms.' . $this->getFormStatePath()"
        wire:submit="create"
    >
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />

    
    <!-- Include jQuery library if not already included -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- <script src="{{ asset('vendor/filament/filament.js') }}"></script> --}}
    {{-- <livewire:scripts />
   --}}
   
    <script>
         $(document).ready(function() {
            $('#cost_placeholder').on('DOMSubtreeModified', function() {
                var costValue = $(this).text(); // Get the text content of the span
                $('#cost').val(costValue); // Use .val() to set the value of the input field
            });
            
            $('#total_placeholder').on('DOMSubtreeModified', function() {
                var costValue = $(this).text(); // Get the text content of the span
                $('#total').val(costValue); // Use .val() to set the value of the input field

            });
        });

             
    </script>
        
    </x-filament-panels::form>
</x-filament-panels::page>