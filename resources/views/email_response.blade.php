<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donation Confirmation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

@php
    $isSuccess = in_array($donation->status, ['succeeded', 'paid', 'approved']);
    $mainColorClass = $isSuccess ? 'bg-green-600' : 'bg-red-600';
    $mainTextColorClass = $isSuccess ? 'text-green-600' : 'text-red-600';
    $preheader = $isSuccess ? 'Thank you! Your donation was successful.' : 'There was an issue with your donation.';
    $title = $isSuccess ? 'Obrigado Pela Sua Doação!' : 'Falha na Tentativa de Doação';
    $greeting = 'Olá ' . $donation->member->user->name . ',';
    $message = $isSuccess
        ? 'Somos imensamente gratos pelo seu apoio. Sua doação foi processada com sucesso e nos ajudará a continuar nossa missão.'
        : 'Lamentamos, mas houve um problema ao processar sua recente tentativa de doação. Por favor, revise os detalhes abaixo. Nenhum valor foi cobrado.';
    $ctaText = $isSuccess ? 'Ver Histórico de Doações' : 'Tentar Doar Novamente';
@endphp

<body class="bg-gray-100 font-sans">
    <!-- Preheader text for inbox preview -->
    <span class="hidden text-transparent">{{ $preheader }}</span>

    <div class="max-w-2xl mx-auto p-4 sm:p-6 lg:p-8">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">

            <!-- HEADER / STATUS BANNER -->
            <div class="{{ $mainColorClass }} p-8 text-center">
                <h1 class="text-3xl font-bold text-white">{{ $title }}</h1>
            </div>

            <!-- MAIN CONTENT SECTION -->
            <div class="p-8">
                <p class="text-lg text-gray-800 mb-6">{{ $greeting }}</p>
                <p class="text-base text-gray-600 leading-relaxed mb-8">{{ $message }}</p>

                <!-- TRANSACTION DETAILS -->
                <div class="border-t border-gray-200 pt-6 space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">ID da Transação:</span>
                        <span class="font-bold text-gray-800">{{ $donation->id }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Data:</span>
                        <span class="font-bold text-gray-800">{{ $donation->formated_date() }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-500">Valor:</span>
                        <span class="font-bold text-gray-800">{{$donation->moeda}} {{ number_format($donation->doacao / 100, 2, ',', '.') }}</span>
                    </div>
                     <div class="flex justify-between items-center">
                        <span class="text-gray-500">Status:</span>
                        <span class="font-bold capitalize {{ $mainTextColorClass }}">{{ $donation->status }}</span>
                    </div>
                </div>
            </div>

            <!-- FOOTER -->
            <div class="bg-gray-50 p-6 text-center text-sm text-gray-500 border-t border-gray-200">
                <p class="mb-1">Se tiver alguma dúvida, por favor, entre em contato com nossa equipe de suporte.</p>
                <p>Causa em Foco &copy; {{ date('Y') }} | Bento Gonçalves, RS, Brasil</p>
            </div>
        </div>
    </div>
</body>
</html>
