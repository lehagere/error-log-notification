@component('mail::message')
    @component('mail::table')
        | Context | Level | Message | File | Line | Recorded on |
        | ------------- |:-------------:| --------:|
        @foreach ($errors as $error)
            | {{ $error->context }} | {{ $error->level }} | {{ $error->message }} | {{ $error->file }} | {{ $error->line }}|
            {{ $error->created_at->diffForHumans() }} |
        @endforeach
    @endcomponent
@endcomponent
