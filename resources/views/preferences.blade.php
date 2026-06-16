@extends('layouts.app')
@section('content')

<div class="max-w-xl mx-auto p-8">
    <h1 class="text-3xl mb-6 dark:text-white">
        Preferences
    </h1>
    <form id="prefForm">
        @csrf
        @php
            $currentTheme = request()->cookie('theme', 'system');
            $currentFontSize = request()->cookie('font_size', 'medium');
        @endphp
        <div class="mb-4">
            <label>Theme</label>
            <select
                name="theme"
                class="w-full border p-3 rounded dark:bg-gray-800 dark:border-gray-600 dark:text-white"
            >
                <option value="light" @selected($currentTheme === 'light')>
                    Light
                </option>
                <option value="dark" @selected($currentTheme === 'dark')>
                    Dark
                </option>
                <option value="system" @selected($currentTheme === 'system')>
                    System
                </option>
            </select>
        </div>

        <div class="mb-4">
            <label>Font Size</label>
            <select
                name="font_size"
                class="w-full border p-3 rounded dark:bg-gray-800 dark:border-gray-600 dark:text-white"
            >
                <option value="small" @selected($currentFontSize === 'small')>
                    Small
                </option>
                <option value="medium" @selected($currentFontSize === 'medium')>
                    Medium
                </option>
                <option value="large" @selected($currentFontSize === 'large')>
                    Large
                </option>
            </select>
        </div>

        <button
            class="bg-black text-white px-5 py-3 rounded"
        >
            Save Preferences
        </button>
    </form>
    <p id="message" class="mt-4 dark:text-white"></p>
</div>
<script>

document.getElementById('prefForm')
.addEventListener('submit', async function(e){
    e.preventDefault();
    const formData = new FormData(this);
    const response = await fetch(
        '/save-preferences',
        {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN':
                    document.querySelector(
                        'meta[name="csrf-token"]'
                    ).content
            },
            body: formData
        }
    );

    const data = await response.json();
    document.getElementById('message')
        .innerText = data.message;

    // Apply the chosen theme right away (cookie is already
    // saved by the server in the response above)
    if(
        document.documentElement
            .classList.contains('dark')
    ){
        document.cookie =
            "theme=dark; path=/; max-age=2592000";
    }else{
        document.cookie =
            "theme=light; path=/; max-age=2592000";
    }

    if(typeof updateThemeButton === 'function'){
        updateThemeButton();
    }
});

</script>
@endsection