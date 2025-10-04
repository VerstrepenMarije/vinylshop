<x-layouts.vinylshop>
    <x-slot name="title">Records</x-slot>
    <x-slot name="description">All records in the shop</x-slot>
    <ul>
        @foreach ($records as $record)
            <li>{!! $record !!}</li>
        @endforeach
    </ul>
</x-layouts.vinylshop>
