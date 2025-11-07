<div>
    <x-slot:title>Eloquent Models: Part 2</x-slot:title>

    <h2 class="font-bold text-xl my-4">Records</h2>
    <div class="my-4">{{ $records->links() }}</div>
    <div class="grid grid-cols-1 xl:grid-cols-2 gap-4">
        @foreach ($records as $record)
            <div class="flex gap-4 shadow-md border border-zinc-300 dark:border-zinc-800 rounded-lg p-4 {{ $record->stock <= 0 ? 'bg-red-100 dark:bg-red-900' : 'dark:bg-zinc-700' }}">
                <img src="{{ $record->cover }}" alt="" class="w-48">
                <div class="flex-1 relative space-y-2">
                    <p class="text-lg font-medium">{{ $record->artist }}</p>
                    <p class="italic text-right pb-2 mb-2 border-b border-gray-300">{{ $record->title }}</p>
                    <p>{{ $record->genre_name }}</p>
                    <p>Price: {{ number_format($record->price, 2) }} €</p>
                    @if($record->stock > 0)
                        <p>Stock: {{ $record->stock }}</p>
                    @else
                        <p class="absolute bottom-4 right-0 -rotate-12 font-bold text-red-500">SOLD OUT</p>
                    @endif

                    {{-- Add the icon link here, below the stock information --}}
                    <a href="{{ $record->listenUrl }}" target="_blank" class="absolute bottom-0 left-0 text-zinc-500 hover:text-blue-600 dark:text-cyan-400 dark:hover:text-blue-400">
                        <flux:icon.speaker-wave variant="solid" class="w-6 h-6" />
                    </a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="my-4">{{ $records->links() }}</div>


    <h2 class="font-bold text-xl my-4">Genres with Records</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
        @foreach ($genres as $genre)
            <div
                class="flex gap-4 shadow-md border border-zinc-300 dark:border-zinc-800 dark:bg-zinc-700 rounded-lg p-4">
                <div class="flex-none w-36 border-r border-zink-300">
                    <h3 class="font-bold text-xl">{{ $genre->name }}</h3>
                    <p>Has {{ $genre->records->count() }} {{ Str::plural('record', $genre->records->count()) }}</p>
                </div>
                <div>
                    <ul class="list-disc list-outside ml-4 text-sm">
                        @foreach($genre->records as $record)
                            <li>
                                <span class="font-semibold">{{ $record->artist }}</span><br>
                                <span class="italic">{{ $record->title }}</span>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

    <x-itf.livewire-log :genres="$genres" :records="$records"/>
</div>
