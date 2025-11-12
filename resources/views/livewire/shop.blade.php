<div>
    <x-slot:title>Shop</x-slot:title>
    <x-slot:description>Welcome to our shop</x-slot:description>

    {{-- Filter section will go here --}}
    <div class="grid grid-cols-10 gap-4">
        {{-- Filter inputs will be added later --}}
    </div>
    <flux:separator variant="subtle" class="mb-4"/>

    {{-- Master section: cards with pagination links --}}
    <div class="@container">
        <div class="my-4">{{ $records->links() }}</div>
        <div class="grid grid-cols-1 @4xl:grid-cols-2 @7xl:grid-cols-3 gap-8 mt-8">
            @foreach($records as $record)
            <div
                wire:key="{{ $record->id }}"
                class="flex border border-zinc-200 dark:border-zinc-700 shadow-md rounded-lg overflow-hidden">
                <img class="w-52 h-52 border-r border-zinc-200 dark:border-zinc-700 object-cover"
                     src="{{ $record->cover}}"
                     alt="{{ $record->title }}"
                     title="{{ $record->title }}" />
                <div class="flex-1 flex flex-col">
                    <div class="flex-1 p-4">
                        <p class="text-lg font-medium">{{ $record->artist }}</p>
                        <p class="text-sm italic pb-2">{{ $record->title }}</p>
                        <p class="italic font-thin text-right">{{ $record->genre_name }}</p>
                    </div>
                    <div
                        class="flex items-center justify-between border-t border-zinc-200 dark:border-zinc-700 bg-zinc-50 dark:bg-zinc-800 px-4 py-2">
                        <div>{{ Number::currency($record->price, in: 'EUR', locale: 'nl') }}</div>
                        <div class="flex space-x-2">
                            @if($record->stock > 0)
                            <flux:button
                                wire:click="addToBasket({{ $record->id }})"                                icon="shopping-bag" tooltip="Add to basket" variant="subtle"
                                class="cursor-pointer border border-zinc-200 dark:border-zinc-700"/>
                            @else
                                <flux:button
                                    icon="shopping-bag" tooltip="Out of stock" variant="subtle"
                                    class="cursor-pointer border border-zinc-200 dark:border-zinc-700 text-red-200! dark:text-red-700/75!"/>
                            @endif
                            <flux:button
                                wire:click="showTracks({{ $record->id }})"
                                icon="musical-note" tooltip="Show tracks" variant="subtle"
                                class="cursor-pointer border border-zinc-200 dark:border-zinc-700"/>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="my-4">{{ $records->links() }}</div>
    </div>

    {{-- Detail Modal will go here --}}
    <flux:modal name="tracksModal" class="w-[500px]">
        <div class="flex items-top border-b border-zinc-300 pb-2 gap-4">
            <img class="size-24"
                 src="{{ $selectedRecord->cover ?? asset('storage/covers/no-cover.png') }}" alt="">
            <div>
                <flux:heading size="lg">{{ $selectedRecord->artist ?? '' }}</flux:heading>
                <flux:subheading>{{ $selectedRecord->title ?? '' }}</flux:subheading>
            </div>
        </div>
        @isset($selectedRecord->tracks)
            <x-itf.table cols="w-8, w-auto, w-24">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Track</th>
                    <th>Length</th>
                </tr>
                </thead>
                <tbody>
                @foreach($selectedRecord->tracks as $track)
                    <tr class="border-t border-zinc-100">
                        <td>{{ $track['position'] }}</td>
                        <td>{{ $track['title'] }}</td>
                        <td>{{ $track['length'] }}</td>
                    </tr>
                @endforeach
                </tbody>
            </x-itf.table>
        @endif
    </flux:modal>
    {{-- No records found message will go here --}}

    <x-itf.livewire-log :records="$records"/>
</div>
