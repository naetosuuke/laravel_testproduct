<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            フォーム
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6">
        @if(session('message'))
            <div class="text-red-600 font-bold">
                {{session('message')}}
            </div>
        @endif
        <form method="post" action="{{ route('post.update', $post) }}">
            @csrf {{-- csrfトークン 発行しないと処理止める --}}
            @method('PATCH') {{-- formメソッド指定 --}}
            <div class="mt-8">
                <div class="w-full flex flex-col">
                    <label for="title" class="font-semibold mt-4">件名</label>
                    <x-input-error :messages="$errors->get('title')" class="mt-2" /> {{-- エラーメッセージ表示処理 --}}
                    <input type="text" id="title" name="title" class="w-auto py-2 border border-gray-300 rounded-md" value="{{old('title '), $post->title }}"> {{-- old関数 第二引数にデフォルト値を設定できる --}}
                </div>
            </div>

            <div class="w-full flex flex-col">
                <label for="title" class="font-semibold mt-4">本文</label>
                <x-input-error :messages="$errors->get('body')" class="mt-2" /> {{-- エラーメッセージ表示処理 --}}
                <textarea id="body" name="body" class="w-auto py-2 border border-gray-300 rounded-md" cols="30" rows="5" value="{{ old('body'), $post->body }}">
                </textarea>
            </div>

            <x-primary-button class="mt-4">
                送信する
            </x-primary-button>
        </form>
    </div>
</x-app-layout>
