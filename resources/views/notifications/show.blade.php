<!DOCTYPE html>
<html class="h-full overflow-x-hidden" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <x-application-favicon />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CineStar') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @stack('vite')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="h-full font-sans antialiased overflow-x-hidden">
    <div class="h-full bg-gray-50 p-4">
        @if ($notification->type == 'reschedule')
            <h1 class="font-bold text-lg mb-4">Subject: Apology for Movie Rescheduling</h1>
            <h2 class="font-semibold mb-6">Dear: {{ Auth::user()->name }}</h2>

            <p class="mb-4">We hope this message finds you well. We regret to inform you that the screening of the
                movie <span class="font-bold">{{ $notification->filmHall->film->name }}</span>has been scheduled for
                <span class="font-bold">{{ $notification->filmHall->date }}</span> due to unforeseen circumstances
                beyond
                our control.
            </p>

            <p class="mb-4">
                We understand the inconvenience this may cause and sincerely apologize for any disruption to your plans.
                Our team is working diligently to ensure a smooth transition to the new screening date.
            </p>
            <p class="mb-4">
                Your current reservation for the movie will automatically be
                transferred to the rescheduled date. If you are unable to attend the new
                screening, please contact us at <span class="font-bold">CineStar@contact.com</span> to arrange for a
                refund or alternative options.
            </p>
            <p class="mb-4">
                Once again, we apologize for any inconvenience caused and appreciate your understanding and continued
                support.
            </p>
            <p>
                Thank you for your cooperation.
            </p>
            <p class="mb-2">
                Best regards,
            </p>
            <p>
                <span class="font-bold">CineStar</span>
            </p>
        @else
            <h1 class="font-bold text-lg mb-4">Subject: Notification of Movie Screening Cancellation</h1>
            <h2 class="font-semibold mb-6">Dear: {{ Auth::user()->name }}</h2>
            <p class="mb-4">
                We regret to inform you that the screening of the movie <span
                    class="font-bold">{{ $notification->filmHall->film->name }}</span> scheduled for <span
                    class="font-bold">{{ $notification->filmHall->film->date }}</span> at <span
                    class="font-bold">{{ $notification->filmHall->hall->name }}</span> has been canceled. We sincerely
                apologize for any inconvenience this may cause.
            </p>

            <p class="mb-4">
                Due to unforeseen circumstances, we have had to make the difficult decision to cancel the screening. We
                understand the disappointment this may bring, and we share in your frustration.
            </p>
            <p class="mb-4">
                Rest assured, we are working diligently to address the situation and ensure that such cancellations are
                minimized in the future. We appreciate your understanding and patience during this time.
                If you have already made a reservation for the screening, we will process a full refund for your ticket
                purchase.
            </p>
            <p class="mb-4">
                We apologize once again for any inconvenience caused and thank you for your continued support. If you
                have any questions or concerns, please do not hesitate to contact us at <span
                    class="font-bold">CineStar@contact.com</span>.
            </p>
            <p>
                Thank you for your understanding.
            </p>
            <p class="mb-2">
                Best regards,
            </p>
            <p>
                <span class="font-bold">CineStar</span>
            </p>
        @endif
    </div>
</body>

</html>
