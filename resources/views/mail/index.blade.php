<x-layout title="Sent Mails">
    <x-ui-container maxWidth="lg">
        <x-ui-title level="h1" content="Sent mails" class="mt-4" /> 

        <ul>
            @foreach ($mails as $mail)
              <li class="border bg-white rounded-lg p-4">
                {{ $mail->getSignedURL() }}
              </li>          
            @endforeach
        </ul>
    </x-ui-container>
</x-ui-layout>