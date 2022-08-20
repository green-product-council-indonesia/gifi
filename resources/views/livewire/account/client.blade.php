<div class="p-4 space-y-4 bg-white rounded-md shadow-md">
    <div class="pt-1">
        <div class="flex justify-between">
            <label class="mb-2 label">Sertifikasi Terdaftar</label>
            <p class="font-semibold">{{ count($data) }}</p>
        </div>

        <div class="flex h-2 overflow-hidden text-xs bg-purple-200 rounded">
            <div style="width: 100%"
                class="flex flex-col justify-center text-center text-white bg-purple-500 shadow-none whitespace-nowrap">
            </div>
        </div>
    </div>
    <div class="pt-1 ">
        <div class="flex justify-between">
            <label class="mb-2 label">Sertifikasi Dalam Proses Penilaian</label>
            <p class="font-semibold">{{ $data_on_process }} / {{ count($data) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-green-200 rounded">
            @if ($data_on_process != 0)
                <div style="width: {{ round(($data_on_process / count($data)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-green-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
    <div class="pt-1 ">
        <div class="flex justify-between">
            <label class="mb-2 label">Sertifikasi Pengajuan Baru</label>
            <p class="font-semibold">{{ $data_baru }} / {{ count($data) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-blue-200 rounded">
            @if ($data_baru != 0)
                <div style="width: {{ round(($data_baru / count($data)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-blue-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
    <div class="pt-1">
        <div class="flex justify-between">
            <label class="mb-2 label">Sertifikasi Renewal</label>
            <p class="font-semibold">{{ $data_renewal }} / {{ count($data) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-yellow-200 rounded">
            @if ($data_renewal != 0)
                <div style="width: {{ round(($data_renewal / count($data)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-yellow-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
</div>
