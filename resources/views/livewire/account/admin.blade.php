<div class="p-4 space-y-4 bg-white rounded-md shadow-md">

    <div class="pt-1">
        <div class="flex justify-between">
            <label class="mb-2 label">User Belum Disetujui</label>
            <p class="font-semibold">{{ $user }}</p>
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
            <label class="mb-2 label">Brand yang Sudah Dinilai</label>
            <p class="font-semibold">{{ $data_success }} / {{ count($data) }}
            </p>
        </div>
        <div class="flex h-2 overflow-hidden text-xs bg-yellow-200 rounded">
            @if ($data_success != 0)
                <div style="width: {{ round(($data_success / count($data)) * 100) }}%"
                    class="flex flex-col justify-center text-center text-white bg-yellow-500 shadow-none whitespace-nowrap">
                </div>
            @endif
        </div>
    </div>
</div>
