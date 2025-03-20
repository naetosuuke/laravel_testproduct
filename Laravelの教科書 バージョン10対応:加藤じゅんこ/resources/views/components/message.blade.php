<div>
    <!-- Because you are alive, everything is possible. - Thich Nhat Hanh -->
    @props(['message']) {{-- propsを使用してビューに渡せば、app/view/componentsでviewの呼出する必要はない --}}
    @if ($message)
        <div class="p-4 m-2 rounded bg-green-100">
            {{ $message }}
        </div>
    @endif
</div>