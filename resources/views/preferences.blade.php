@extends('layouts.app')
@section('content')

<div class="max-w-xl mx-auto p-8">
    <h1 class="text-3xl mb-6">
        Preferences
    </h1>
    <form id="prefForm">
        @csrf
        <div class="mb-4">
            <label>Theme</label>
            <select
                name="theme"
                class="w-full border p-3 rounded"
            >
                <option value="light">
                    Light
                </option>
                <option value="dark">
                    Dark
                </option>
                <option value="system">
                    System
                </option>
            </select>
        </div>

        <div class="mb-4">
            <label>Font Size</label>
            <select
                name="font_size"
                class="w-full border p-3 rounded"
            >
                <option value="small">
                    Small
                </option>
                <option value="medium">
                    Medium
                </option>
                <option value="large">
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
    <p id="message" class="mt-4"></p>
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
});

</script>
@endsection