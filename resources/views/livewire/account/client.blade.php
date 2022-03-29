<div class="p-4 space-y-4 bg-white rounded-md shadow-md">
    <div class="pt-1">
        <div class="flex justify-between">
            <label class="mb-2 label">Brand Terdaftar</label>
            <p class="font-semibold">{{ count($brand) }}</p>
        </div>

        <div class="flex h-2 overflow-hidden text-xs bg-purple-200 rounded">
            <div style="width: 100%"
                class="flex flex-col justify-center text-center text-white bg-purple-500 shadow-none whitespace-nowrap">
            </div>
        </div>
    </div>
    <div class="pt-1 ">
        <div class="flex justify-between">
            <label class="mb-2 label">Brand Dalam Proses Penilaian</label>
            <p class="font-semibold">{{ $brand_on_process }} / {{ count($brand) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-green-200 rounded">
            @if ($brand_on_process != 0)
                <div style="width: {{ round(($brand_on_process / count($brand)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
    <div class="pt-1 ">
        <div class="flex justify-between">
            <label class="mb-2 label">Brand Pengajuan Baru</label>
            <p class="font-semibold">{{ $brand_baru }} / {{ count($brand) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-blue-200 rounded">
            @if ($brand_baru != 0)
                <div style="width: {{ round(($brand_baru / count($brand)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-blue-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
    <div class="pt-1">
        <div class="flex justify-between">
            <label class="mb-2 label">Brand Renewal</label>
            <p class="font-semibold">{{ $brand_renewal }} / {{ count($brand) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-yellow-200 rounded">
            @if ($brand_renewal != 0)
                <div style="width: {{ round(($brand_renewal / count($brand)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-yellow-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
</div>
