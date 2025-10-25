<x-layouts.vinylshop title="Playground">

    <h2 class="text-md font-bold italic my-4 pb-2">Range slider component</h2>

    <div class="grid grid-cols-2 gap-4">
        <x-itf.range-slider min="200" max="500" step="1" name="price" id="id2" label="Price ≤" suffix="€"/>
        <x-itf.range-slider value="6" name="Nr_of_items" step="2" hide-min-max class="border p-2 shadow-xl"/>
    </div>
    ...
</x-layouts.vinylshop>
