{{-- only visible for guests --}}
@guest
    <flux:button.group id="auth-buttons">
        <flux:button icon="user" href="{{ route('login') }}">Login</flux:button>
        <flux:button icon="user-plus" href="{{ route('register') }}">Register</flux:button>
    </flux:button.group>
@endguest

{{-- visible for all --}}
<flux:navlist variant="outline">
    <flux:navlist.item icon="disc-3" href="{{ route('shop') }}">Shop</flux:navlist.item>
    <flux:navlist.item icon="envelope" href="{{ route('contact') }}">Contact</flux:navlist.item>
    <flux:navlist.item icon="shopping-cart" href="#">Basket</flux:navlist.item>
</flux:navlist>

{{-- only visible for authenticated users --}}
@auth
    <flux:navlist variant="outline">
        <flux:navlist.item icon="list-bullet" href="#">Order history</flux:navlist.item>
    </flux:navlist>
    {{-- only visible for site administartors --}}
    @if (auth()->user()->admin)
        <flux:separator variant="subtle"/>
        <flux:navlist.group expandable heading="Admin">
            <flux:navlist.item href="#">Genres</flux:navlist.item>
            <flux:navlist.item href="{{ route('admin.records') }}">Records</flux:navlist.item>
            <flux:navlist.item href="{{ route('admin.covers') }}">Covers</flux:navlist.item>
            <flux:navlist.group expandable expanded="false" heading="Users">
                <flux:navlist.item href="#">Basic</flux:navlist.item>
                <flux:navlist.item href="#">Advanced</flux:navlist.item>
                <flux:navlist.item href="#">Expert</flux:navlist.item>
            </flux:navlist.group>
            <flux:navlist.item href="#">Orders</flux:navlist.item>
        </flux:navlist.group>
    @endif
@endauth
