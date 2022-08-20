<div class="space-y-2">
    <div class="bg-white divide-y divide-gray-200">
        <div class="flex items-center justify-between px-5 py-4 bg-white">
            <div class="flex items-center space-x-4">
                <p class="text-xl font-semibold text-gray-800">
                    Detail Skor Sertifikasi
                </p>
            </div>
            <button class="text-gray-400 hover:text-gray-600" wire:click="$emit('closeModal')">
                <svg class="w-4 transition duration-150 fill-current" xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 512.001 512.001">
                    <path
                        d="M284.286 256.002L506.143 34.144c7.811-7.811 7.811-20.475 0-28.285-7.811-7.81-20.475-7.811-28.285 0L256 227.717 34.143 5.859c-7.811-7.811-20.475-7.811-28.285 0-7.81 7.811-7.811 20.475 0 28.285l221.857 221.857L5.858 477.859c-7.811 7.811-7.811 20.475 0 28.285a19.938 19.938 0 0014.143 5.857 19.94 19.94 0 0014.143-5.857L256 284.287l221.857 221.857c3.905 3.905 9.024 5.857 14.143 5.857s10.237-1.952 14.143-5.857c7.811-7.811 7.811-20.475 0-28.285L284.286 256.002z" />
                </svg>
            </button>
        </div>
        @php
            $sum_total = 0;
        @endphp
        <div class="grid grid-cols-3 divide-y divide-gray-200">
            @foreach ($scoring as $item)
                <div class="md:col-span-2 col-span-3 px-8 py-2 border-r border-gray-200">
                    <p class="text-xs">
                        {{ $item->nama_kategori_dokumen }}
                    </p>
                </div>
                <div class="md:col-span-1 col-span-3 px-8 py-2">
                    <p class="text-xs font-semibold">
                        @php
                            $sum_score = 0;
                            $sum_target = 0;
                        @endphp
                        @foreach ($item->dokumen as $result)
                            @php
                                $sum_score += $result->registration[0]->pivot->score;
                                $sum_target += $result->bobot;
                            @endphp
                        @endforeach

                        @if ($sum_score && $sum_target != 0)
                            {{ round(($sum_score / $sum_target) * $item->kategori[0]->pivot->total_bobot, 2) }} %
                        @else
                            -
                        @endif
                    </p>
                </div>
                @if ($sum_score && $sum_target != 0)
                    @php
                        $sum_total += ($sum_score / $sum_target) * $item->kategori[0]->pivot->total_bobot;
                    @endphp
                @endif
            @endforeach
            <div class="md:col-span-2 col-span-3 px-8 py-2 border-r border-gray-200 bg-gray-300">
                <p class="font-semibold text-md">
                    Total
                </p>
            </div>
            <div class="md:col-span-1 col-span-3 px-8 py-2 bg-gray-300">
                <p class="text-md font-bold">
                    {{ round($sum_total, 2) }} %
                </p>
            </div>
        </div>
    </div>
    <div class="flex justify-end px-4 py-3 bg-white">
        <button type="button" wire:click.prevent="$emit('closeModal')"
            class="inline-flex justify-center w-full px-4 py-2 mt-3 text-base font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
            Kembali
        </button>
    </div>
</div>
