{{-- resources/views/emails/reminder.blade.php --}}

<h1>Blah уже скоро!</h1>
{{-- <h1>{{ $event }}</h1> --}}

<p>
{{-- <img src="{{ $message->embed(public_path() . '/images/cat3.jpg') }}" alt="Real Cat" width="200px"> --}}

{{-- <img src="data:image/jpeg;base64, {{ base64_encode(file_get_contents(public_path() . '/images/cat3.jpg')) }}" alt="Real Cat"> --}}
</p>

<p>Lorem ipsum.</p>

<img src="{{ asset('storage/thumbnail.jpg') }}">


