@section('title', 'Sertifikat GLI')
<div class="">
    <div id="content" class="block m-auto bg-white border border-gray-400 "
        style="width: 842px; height: 595px; background: #e9f4b1;">
        <div class="grid min-h-full grid-cols-12">
            <div class="col-span-2 ">
                <div class="relative font-serif"
                    style=" height: 100%; background-image: linear-gradient(#2d8c52, #0c2917);">
                    @if ($brand->scoring_id == 1)
                        <p class="absolute inset-y-0 tracking-widest uppercase transform -rotate-90 left-full bottom"
                            style="font-size: 64px; color:#cd7f32; margin-left: 30px;">
                            Bronze
                        </p>
                    @elseif($brand->scoring_id == 2)
                        <p class="absolute inset-y-0 tracking-widest uppercase transform -rotate-90 left-full bottom"
                            style="font-size: 77px; color: #cccccc; margin-left: 12px;">
                            Silver
                        </p>
                    @elseif($brand->scoring_id == 3)
                        <p class="absolute inset-y-0 tracking-widest uppercase transform -rotate-90 left-full bottom"
                            style="color: #ffd700;font-size: 84px; margin-left: 30px;">
                            Gold
                        </p>
                    @endif
                </div>
            </div>
            <div class="relative col-span-10 ml-2">
                <div class="absolute" style="right: 20px; top: 20px">
                    {!! QrCode::backgroundColor(233, 244, 177)->style('round')->size(100)->merge('/public/img/gpci.png')->generate(Request::url()) !!}
                </div>
                <div class="absolute" style="left: 20px; top: 20px">
                    <p class="text-xl font-semibold uppercase opacity-30">This Page is Only a Copy</p>
                </div>
                <img src="{{ asset('img/gpci.png') }}" class="absolute inset-0 mx-auto mt-32 opacity-20"
                    style="width: 50%;">
                <div class="absolute top-1/4 -left-10" style="left: 225px; right: 250px; width: 9cm;">
                </div>
                <img src="{{ asset('img/gli.png') }}" class="block m-auto mt-2" style="width: 28mm">
                <p class="font-serif text-xl font-bold text-center" style="color: #edbb45;">CERTIFICATE of <br> GREEN
                    LABEL
                    INDONESIA</p>
                <p class="font-serif text-center" style="font-size: 12pt; margin-bottom: 5px;">
                    {{ $brand->no_sertifikat }}
                </p>
                <p class="text-center teks" style="font-size: 12pt; margin-bottom: 0;">Awarded to : </p>
                <p class="font-serif text-center uppercase teks" style="font-size: 20pt; margin-bottom: 8px;">
                    <b>{{ $brand->plant->perusahaan->nama_perusahaan }}</b>
                </p>
                <p class="text-center teks" style="font-size: 12pt; margin-bottom: 0;">For The Product Of :</p>
                <p class="font-serif text-center uppercase" style="font-size: 20pt; margin-bottom: 0px;">
                    <b>{{ $brand->nama_brand }}</b>
                </p>
                <p class="font-serif text-center uppercase" style="font-size: 12pt; margin-bottom: 8px;">
                    <b> {{ $brand->kategoriProduk->categories }}</b>
                </p>
                <p class="text-center teks" style="font-size: 12pt; margin-bottom: 0;">Plant Address :</p>
                <p class="mb-2 text-center" style="font-size: 14pt;">
                    <b>{{ Str::limit($brand->plant->alamat_plant, 100) }}</b>
                </p>
                <p class="text-center teks" style="font-size: 12pt; margin-bottom: 2px;">Validity :</p>
                <p class="text-center teks" style="font-size: 11pt; margin-bottom: 0;">
                    <b>{{ \Carbon\Carbon::parse($brand->tgl_approve)->locale('id')->isoFormat('D MMMM Y') .
                        ' - ' .
                        \Carbon\Carbon::parse($brand->tgl_masa_berlaku)->locale('id')->isoFormat('D MMMM Y') }}</b>
                </p>

                <div class="absolute" style="bottom: 6%; width: 7cm;">
                    <img src="{{ asset('img/ttd.png') }}" class="ml-10" style="width: 45mm; left: 20px">
                    <p class="text-center" style="font-size: 10pt; margin-bottom: 0;">
                        <b>
                            Hendrata Atmoko
                        </b>
                    </p>
                    <hr style="margin-top: 0px; margin-bottom: 0;">
                    <p class="text-center" style="font-size: 10pt; margin-bottom: 0;">Chairman</p>
                    <p style="font-size: 10pt; margin-bottom: 0; color: #0c2917;" class="arial">
                        <b> GREEN PRODUCT COUNCIL INDONESIA </b>
                    </p>
                    <p style="font-size: 8pt; margin-bottom: 0;" class="arial">Jl. Ciputat Raya 27A, Pondok
                        Pindang <br>
                        Kebayoran Lama - Jakarta Selatan 12310</p>
                </div>
                <div class="absolute" style="bottom: 6%; right: -14%; width: 6cm;">
                    <img src="{{ asset('img/gen.png') }}" class="gen-img" style="width: 34mm">
                </div>

                <div class="absolute" style="bottom: 0; left: -3%;">
                    <div class="footer-tabs"
                        style="width: 17.5cm; height: 9mm; background-image: linear-gradient(to right,rgba(14, 46, 26, 1),rgba(14, 46, 26, 1),rgba(14, 46, 26, 0));">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <button class="fixed bottom-0 right-0 px-3 py-1 m-4 text-white bg-blue-500 rounded-md shadow-md hover:bg-blue-600"
        onclick="print()">
        Print
    </button>
    {{-- <div class="fixed top-0 left-0">
        <div
            class="flex items-center justify-center px-2 py-1 m-4 font-medium text-red-700 bg-red-100 border border-red-300 rounded-md m -4">
            <div slot="avatar items-center flex">
                <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="w-5 h-5 mx-2 feather feather-alert-octagon">
                    <polygon points="7.86 2 16.14 2 22 7.86 22 16.14 16.14 22 7.86 22 2 16.14 2 7.86 7.86 2"></polygon>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
            </div>
            <div class="items-center flex-initial max-w-full text-xl font-normal">
                <span class="error">This Page is Only a Copy</span>
            </div>
        </div>
    </div> --}}
</div>
