
<x-livewire-tables::bs4.table.cell>
    {{ $row->name }}
</x-livewire-tables::bs4.table.cell>

<x-livewire-tables::bs4.table.cell>
    <a wire:click="$emit('edit-designation', {{$row->id}})" href="#" class="text-primary" >
        <i class="fa fa-edit"></i> Edit
    </a>

    <a wire:click="$emit('delete-designation', {{$row->id}})" href="#" class="p-lg-2 text-danger" >
        <i class="fa fa-trash"></i> Delete
    </a>
</x-livewire-tables::bs4.table.cell>


